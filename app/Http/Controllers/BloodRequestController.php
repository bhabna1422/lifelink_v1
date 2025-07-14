<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\BloodRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DonorReqValidation;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Exists;
use App\Services\FCMService; // Ensure you have this service for FCM notifications
 use Illuminate\Support\Facades\Log;

class BloodRequestController extends Controller
{
    // Step 1: Save data and send OTP
 

public function sendOtp(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'blood_group' => 'required|string',
        'expires_at' => 'date',
        'dob' => 'date',
        'gender' => 'required|string',
        'phone' => 'required|string',
        'address' => 'required|string',
        'location' => 'required|string',
        'lat' => 'numeric|required',
        'long' => 'numeric|required',
        'country_code' => 'nullable|string|max:10',
        'blood_for' => 'nullable|numeric',
        'message_to_donor' => 'nullable|string|max:255',
    ]);

    try {
        $bloodRequest = BloodRequest::create([
            'requester_id' => auth()->id(),
            'name' => $request->name,
            'blood_group' => $request->blood_group,
            'expires_at' => $request->expires_at,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'location' => $request->location,
            'status' => 'requested',
            'is_verified' => false,
            'country_code' => $request->country_code,
            'blood_for' => $request->blood_for,
            'message_to_donor' => $request->message_to_donor,
        ]);

        DB::statement("UPDATE blood SET coordinate = ST_GeomFromText(?, 4326) WHERE id = ?", [
            'POINT(' . $request->long . ' ' . $request->lat . ')',
            $bloodRequest->id
        ]);

        $otpUrl = "https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/{$request->phone}/AUTOGEN";
        $response = Http::get($otpUrl);

        if (!$response->ok() || !isset($response['Details'])) {
            $retryResponse = Http::get($otpUrl);

            if (!$retryResponse->ok() || !isset($retryResponse['Details'])) {
                $bloodRequest->delete();
                return response()->json(['message' => 'Failed to send OTP after retry.'], 500);
            }

            $response = $retryResponse;
        }

        $bloodRequest->otp_session_id = $response['Details'];
        $bloodRequest->save();

        return response()->json([
            'message' => 'OTP sent successfully.',
            'request_id' => $bloodRequest->id
        ]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Something went wrong.', 'error' => $e->getMessage()], 500);
    }
}

public function verifyOtp(Request $request)
{
    $request->validate([
        'request_id' => 'required|integer|exists:blood,id',
        'otp' => 'required|string',
    ]);

    $bloodRequest = BloodRequest::findOrFail($request->request_id);

    if (!$bloodRequest->otp_session_id) {
        return response()->json(['message' => 'OTP session not found.'], 400);
    }

    \Log::info('OTP verification started', ['request_id' => $request->request_id, 'otp' => $request->otp]);

    $url = "https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/VERIFY/{$bloodRequest->otp_session_id}/{$request->otp}";
    \Log::info('Sending OTP verification request', ['url' => $url]);

    $verify = Http::get($url);

    \Log::info('2Factor OTP API response', [
        'status' => $verify->status(),
        'body' => $verify->body(),
        'json' => $verify->json()
    ]);

    if (!$verify->ok() || $verify['Details'] !== 'OTP Matched') {
        return response()->json(['message' => 'Invalid OTP.'], 400);
    }

    // Mark the request as verified
    $bloodRequest->is_verified = true;
    $bloodRequest->save();

    \Log::info('OTP verified and request marked as verified', ['request_id' => $bloodRequest->id]);

    // Fetch coordinates for notification
    $longitude = DB::table('blood')->where('id', $bloodRequest->id)->value(DB::raw('ST_X(coordinate)'));
    $latitude  = DB::table('blood')->where('id', $bloodRequest->id)->value(DB::raw('ST_Y(coordinate)'));
    $point     = "POINT($longitude $latitude)";
    \Log::info('Coordinate built for notification', ['point' => $point]);

    // Notify nearby donors (excluding the requester)
    $nearbyDonors = DB::select("
        SELECT id, fcm_token
        FROM users
        WHERE is_donor = 1 
          AND coordinate IS NOT NULL
          AND fcm_token IS NOT NULL
          AND fcm_token != ''
          AND id != ?
          AND ST_Distance_Sphere(coordinate, ST_GeomFromText(?, 4326)) <= 50000
    ", [$bloodRequest->requester_id, $point]);

    \Log::info('Donors selected for FCM', ['count' => count($nearbyDonors)]);

    $tokens = collect($nearbyDonors)
        ->pluck('fcm_token')
        ->filter(fn($token) => !empty(trim($token)))
        ->unique()
        ->values()
        ->all();

    if (!empty($tokens)) {
        try {
            \Log::info('Firebase messaging service initialized successfully.');
            app(\App\Services\FCMService::class)->sendToTokens(
                $tokens,
                'New Blood Request Near You!',
                'A blood request has been posted in your area. Please consider donating.',
                [
                    'type' => 'Donate Blood',
                    // 'request_id' => (string) $bloodRequest->id, // optional: include if app needs to identify request
                ]
            );
            \Log::info('FCM notification sent to donors.');
        } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
            \Log::error('Failed to send FCM to token.', [
                'token' => $token ?? 'unknown',
                'error' => $e->getMessage()
            ]);
        } catch (\Throwable $e) {
            \Log::error('Error sending FCM', ['error' => $e->getMessage()]);
        }
    } else {
        \Log::info('No valid FCM tokens available for notification.');
    }

    return response()->json([
        'message' => 'OTP verified successfully.',
        'data' => $bloodRequest,
    ]);
}




    public function cancelBloodRequest(Request $request)
    {
        $request->validate([
            'request_id' => 'required|integer|exists:blood,id',
        ]);

        $bloodRequest = BloodRequest::find($request->request_id);

        // if ($bloodRequest->status !== 'requested') {
        //     return response()->json([
        //         'message' => 'Only requests with status "requested" can be cancelled.',
        //     ], 400);
        // }

        $bloodRequest->status = 'canceled';
        $bloodRequest->save();

        return response()->json([
            'message' => 'Blood request has been cancelled successfully.',
            'data' => $bloodRequest,
        ]);
    }

    public function getUserBloodRequests(Request $request)
{
    $user = Auth::user();

    $requests = BloodRequest::where('requester_id', $user->id)
        ->orderByDesc('created_at')
        ->where('is_verified', true)
        ->get()
        ->map(function ($request) {
            // Default: no donor info
            $request->donor_email = null;
            $request->donor_phone = null;
            $request->donor_name = null;

            if ($request->donor_id) {
                // Check if donor has verified OTP for this request
                $validation = DonorReqValidation::where('blood_id', $request->id)
                    ->where('donor_id', $request->donor_id)
                    ->where('is_verified', true)
                    ->first();

                if ($validation) {
                    // Fetch donor user info
                    $donor = \App\Models\User::find($request->donor_id);
                    if ($donor) {
                        $request->donor_email = $donor->email;
                        $request->donor_phone = $donor->phone;
                        $request->donor_name = $donor->name;
                    }
                }
            }

            return $request;
        });

    return response()->json([
        'message' => 'Blood requests retrieved successfully.',
        'data' => $requests
    ]);
}

    public function resendOrVerifyOtpBloodRequest(Request $request)
{
    $request->validate([
        'id'    => 'required|integer|exists:blood,id',
        'phone' => 'required|string|max:20',
        'otp'   => 'nullable|string',
    ]);

    $bloodRequest = BloodRequest::where('id', $request->id)
        ->where('phone', $request->phone)
        ->where('requester_id', auth()->id()) // Ensure the requester is the authenticated user
        ->first();

    if (!$bloodRequest) {
        return response()->json([
            'message' => 'Blood request not found with given ID and phone.',
            'status'  => false,
        ], 404);
    }

    // If OTP is present – verify it
    if ($request->filled('otp')) {
        $verifyResponse = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/VERIFY/{$bloodRequest->otp_session_id}/{$request->otp}");

        if (!$verifyResponse->ok() || $verifyResponse['Details'] !== 'OTP Matched') {
            return response()->json([
                'message' => 'Invalid OTP.',
                'status'  => false,
            ], 400);
        }

        $bloodRequest->update(['is_verified' => true]);

        return response()->json([
            'message' => 'OTP verified successfully.',
            'status'  => true,
            'data'    => [
                'id'          => $bloodRequest->id,
                'name'        => $bloodRequest->name,
                'phone'       => $bloodRequest->phone,
                'is_verified' => $bloodRequest->is_verified,
            ]
        ]);
    }

    // If OTP not provided – resend OTP
    $otpResponse = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/{$request->phone}/AUTOGEN");

    if (!$otpResponse->ok() || !isset($otpResponse['Details'])) {
        return response()->json([
            'message' => 'Failed to resend OTP.',
            'status'  => false,
        ], 500);
    }

    $bloodRequest->otp_session_id = $otpResponse['Details'];
    $bloodRequest->is_verified    = false;
    $bloodRequest->save();

    return response()->json([
        'message'     => 'OTP resent successfully. Please verify using the same API.',
        'request_id'  => $bloodRequest->id,
        'status'      => true,
        'is_verified' => false,
    ]);
}
public function getBloodRequestById($id)
{
    $bloodRequest = BloodRequest::where('id', $id)
        ->where('requester_id', auth()->id()) // Ensure the requester is the authenticated user
        ->first();

    if (!$bloodRequest) {
        return response()->json(['message' => 'Blood request not found.'], 404);
    }

    return response()->json([
        'message' => 'Blood request retrieved successfully.',
        'data' => $bloodRequest
    ]);
}

public function updateBloodRequest(Request $request, $id)
{
    // Validate input
    $request->validate([
        'name' => 'nullable|string',
        'blood_group' => 'nullable|string',
        'expires_at' => 'nullable|date',
        'dob' => 'nullable|date',
        'gender' => 'nullable|string',
        'phone' => 'nullable|string',
        'address' => 'nullable|string',
        'location' => 'nullable|string',
        'country_code' => 'nullable|string',
        'blood_for' => 'nullable|numeric',
        'message_to_donor' => 'nullable|string',
        'lat' => 'nullable|numeric',
        'long' => 'nullable|numeric',
    ]);

    // Find the existing blood request
    $bloodRequest = BloodRequest::find($id);

    if (!$bloodRequest) {
        return response()->json(['message' => 'Blood request not found.'], 404);
    }

    // Update fields
    $bloodRequest->update([
        'requester_id' => auth()->id(),
        'name' => $request->name,
        'blood_group' => $request->blood_group,
        'expires_at' => $request->expires_at,
        'dob' => $request->dob,
        'gender' => $request->gender,
        'phone' => $request->phone,
        'address' => $request->address,
        'location' => $request->location,
        'status' => $request->status ?? $bloodRequest->status,
        'is_verified' => $bloodRequest->is_verified,
        'country_code' => $request->country_code,
        'blood_for' => $request->blood_for,
        'message_to_donor' => $request->message_to_donor,
    ]);

    // Update coordinate as POINT with SRID 4326
    DB::statement("UPDATE blood SET coordinate = ST_GeomFromText(?, 4326) WHERE id = ?", [
        'POINT(' . $request->long . ' ' . $request->lat . ')',
        $bloodRequest->id
    ]);

    return response()->json([
        'message' => 'Blood request updated successfully.',
        'data' => $bloodRequest
    ]);
}
public function donateBloodList(Request $request)
{
    $user = auth()->user();

    if (!$user || $user->is_donor != 1 || !$user->coordinate) {
        return response()->json(['message' => 'Unauthorized or donor location not available.'], 403);
    }

    // Get the user's coordinate (POINT)
    $userLocation = DB::selectOne("SELECT ST_AsText(coordinate) as point FROM users WHERE id = ?", [$user->id]);

    if (!$userLocation || !preg_match('/POINT\(([-\d.]+) ([-\d.]+)\)/', $userLocation->point, $matches)) {
        return response()->json(['message' => 'Invalid user location.'], 400);
    }

    $userLong = $matches[1];
    $userLat = $matches[2];

    // Get blood requests within 50km excluding the logged-in user's own requests
    $bloodRequests = DB::select("
        SELECT 
            id,
            name,
            blood_group,
            dob,
            gender,
            phone,
            address,
            location,
            status,
            country_code,
            blood_for,
            message_to_donor,
            ST_AsText(coordinate) as coordinate, 
            ST_Distance_Sphere(coordinate, ST_GeomFromText(?, 4326)) AS distance
        FROM blood
        WHERE coordinate IS NOT NULL 
          AND status = 'requested'
          AND is_verified = 1
          AND requester_id != ?
          AND ST_Distance_Sphere(coordinate, ST_GeomFromText(?, 4326)) <= 50000
        ORDER BY created_at DESC
    ", [
        "POINT($userLong $userLat)",
        $user->id,
        "POINT($userLong $userLat)"
    ]);

    if (empty($bloodRequests)) {
        return response()->json(['message' => 'No nearby blood requests found.'], 200);
    }

    return response()->json([
        'message' => 'Nearby blood requests fetched successfully.',
        'data' => $bloodRequests
    ]);
}

public function acceptBloodRequest(Request $request)
{
    $request->validate([
        'blood_id' => 'required|exists:blood,id',
    ]);

    $user = auth()->user();

    if (!$user || $user->is_donor != 1) {
        return response()->json(['message' => 'Unauthorized donor.'], 403);
    }

    $bloodRequest = DB::table('blood')->where('id', $request->blood_id)->first();

    if (!$bloodRequest) {
        return response()->json(['message' => 'Blood request not found.'], 404);
    }

    // ✅ Send OTP to the donor (authenticated user)
    $response = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/{$user->phone}/AUTOGEN");

    if (!$response->ok() || !isset($response['Details'])) {
        return response()->json(['message' => 'Failed to send OTP.'], 500);
    }

    // Save to donor_req_validation
    $otpSessionId = $response['Details'];

    $validation = DonorReqValidation::create([
        'donor_id' => $user->id,
        'blood_id' => $request->blood_id,
        'otp_session_id' => $otpSessionId,
        'is_verified' => false
    ]);

    return response()->json([
        'message' => 'OTP sent successfully to your number.',
        'otp_session_id' => $otpSessionId,
        'validation_id' => $validation->id
    ]);
}

public function verifyDonorOtp(Request $request)
{
    $request->validate([
        'validation_id' => 'required|exists:donor_req_validation,id',
        'otp' => 'required|string',
    ]);

    $validation = DonorReqValidation::findOrFail($request->validation_id);

    if (!$validation->otp_session_id) {
        return response()->json(['message' => 'OTP session not found.'], 400);
    }

    // Verify with 2Factor
    $verify = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/VERIFY/{$validation->otp_session_id}/{$request->otp}");

    if (!$verify->ok() || $verify['Details'] !== 'OTP Matched') {
        return response()->json(['message' => 'Invalid OTP.'], 400);
    }

    // ✅ Mark validation as verified
    $validation->is_verified = 1;
    $validation->save();

    // ✅ Update blood request: set status to 'processed' and donor_id
    DB::table('blood')
        ->where('id', $validation->blood_id)
        ->update([
            'status' => 'Processed',
            'donor_id' => $validation->donor_id
        ]);

    return response()->json([
        'message' => 'OTP verified successfully, donor assigned and blood request marked as processed.',
        'data' => $validation
    ]);
}


    public function deleteBloodRequest($id)
    {
        $bloodRequest = BloodRequest::find($id);
        // dd($bloodRequest->requester_id , auth()->id());

        if (!$bloodRequest) {
            return response()->json(['message' => 'Blood request not found.'], 404);
        }

        // Ensure the requester is the authenticated user
        if ($bloodRequest->requester_id != auth()->id()) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }


        $bloodRequest->delete();

        return response()->json(['message' => 'Blood request deleted successfully.']);  
    }
  public function getDonatedBloodHistory()
{
    $donorId = auth()->id(); // Authenticated user ID

    $history = DonorReqValidation::with(['donor', 'blood'])
        ->where('donor_id', $donorId)
        ->where('is_verified', true)
        ->get();

    return response()->json([
        'success' => true,
        'message' => 'Donated blood history fetched successfully.',
        'data' => $history->map(function ($item) {
            $blood = optional($item->blood);
            $donor = optional($item->donor);

            return [
                'id' => $item->blood_id,
                'donor_id' => $item->donor_id,
                // 'donor_name' => $donor->name,
                // 'donor_email' => $donor->email,
                
                'status' => $blood->status,
                'date' => $blood->created_at,
                'address' => $blood->address,
                
                'request_id' => $item->blood_id,
                'name' => $blood->name,
                'blood_group' => $blood->blood_group,
                'expires_at' => $blood->expires_at,
                'dob' => $blood->dob,
                'gender' => $blood->gender,
                'phone' => $blood->phone,
                'blood_for' => $blood->blood_for,
                'message_to_donor' => $blood->message_to_donor,

                'otp_session_id' => $item->otp_session_id,
                'is_verified' => (bool) $item->is_verified,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        }),
    ]);
}


}
