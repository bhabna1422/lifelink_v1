<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BreastMilk;
use Illuminate\Support\Facades\Http;
use App\Models\MilkDonorReqValidation;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Models\DonorReqValidation;
use App\Models\Blood;
use App\Models\BloodRequest;
use App\Models\BloodDonor;
use App\Models\BloodRequestValidation;
//fcm token
use App\Models\FCMToken;
use Illuminate\Support\Facades\Log;

class BreastMilkController extends Controller
{
    //


public function addBreastMilk(Request $request)
{
    $request->validate([
        'name'           => 'required|string|max:255',
        'gender'         => 'required|string|max:10',
        'phone'          => 'required|string|max:20',
        'location'       => 'required|string|max:255',
        'milk_quantity'  => 'required|string|max:255',
        'expires_at'     => 'date',
        'lat'            => 'required|numeric',
        'long'           => 'required|numeric',
        'milk_for'       => 'nullable|numeric',
        'country_code'   => 'nullable|string|max:10',
        'milk_type'      => 'nullable|string|max:255',
    ]);

    try {
        DB::beginTransaction();

        $breastMilk = new BreastMilk();
        $breastMilk->requester_id   = auth()->id();
        $breastMilk->name           = $request->name;
        $breastMilk->gender         = $request->gender;
        $breastMilk->phone          = $request->phone;
        $breastMilk->location       = $request->location;
        $breastMilk->milk_quantity  = $request->milk_quantity;
        $breastMilk->expires_at     = $request->expires_at;
        $breastMilk->status         = 'requested';
        $breastMilk->is_verified    = false;
        $breastMilk->milk_for       = $request->milk_for;
        $breastMilk->country_code   = $request->country_code;
        $breastMilk->milk_type      = $request->milk_type;
        $breastMilk->save();

        // Store coordinates
        DB::statement("UPDATE breast_milk SET coordinate = ST_GeomFromText(?, 4326) WHERE id = ?", [
            'POINT(' . $request->long . ' ' . $request->lat . ')',
            $breastMilk->id
        ]);

        // Send OTP
        $otpResponse = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/{$request->phone}/AUTOGEN");

        if (!$otpResponse->ok() || !isset($otpResponse['Details'])) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to send OTP.'], 500);
        }

        $breastMilk->otp_session_id = $otpResponse['Details'];
        $breastMilk->save();

        DB::commit();

        return response()->json([
            'status'     => 'success',
            'message'    => 'Breast milk request saved and OTP sent.',
            'request_id' => $breastMilk->id,
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status'  => 'error',
            'message' => 'Something went wrong. Please try again later.',
        ], 500);
    }
}


public function verifyOtpBreastMilk(Request $request)
{
    $request->validate([
        'request_id' => 'required|integer|exists:breast_milk,id',
        'otp'        => 'required|string',
    ]);

    $milkRequest = BreastMilk::findOrFail($request->request_id);

    $verify = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/VERIFY/{$milkRequest->otp_session_id}/{$request->otp}");

    if (!$verify->ok() || $verify['Details'] !== 'OTP Matched') {
        return response()->json(['message' => 'Invalid OTP.'], 400);
    }

    $milkRequest->is_verified = true;
    $milkRequest->save();

    // Notify donors after verification (exclude requester from notification)
    $coordinate = DB::selectOne("SELECT ST_AsText(coordinate) as point FROM breast_milk WHERE id = ?", [$milkRequest->id]);

    if ($coordinate && preg_match('/POINT\(([-\d.]+) ([-\d.]+)\)/', $coordinate->point, $matches)) {
        $lng = $matches[1];
        $lat = $matches[2];
        $point = "POINT($lng $lat)";

        $nearbyDonors = DB::select("
            SELECT id, fcm_token
            FROM users
            WHERE is_donor = 1 
              AND coordinate IS NOT NULL
              AND fcm_token IS NOT NULL
              AND fcm_token != ''
              AND id != ?
              AND ST_Distance_Sphere(coordinate, ST_GeomFromText(?, 4326)) <= 50000
        ", [$milkRequest->requester_id, $point]); // exclude requester

        $tokens = collect($nearbyDonors)
            ->pluck('fcm_token')
            ->filter(fn($token) => !empty(trim($token)))
            ->unique()
            ->values()
            ->all();

        if (!empty($tokens)) {
            try {
               app(\App\Services\FCMService::class)->sendToTokens(
                    $tokens,
                    'Breast Milk Request Near You!',
                    'A new breast milk request has been posted near your area. Please consider donating.',
                    [
                        'type' => 'Donate Milk',
                        // optionally you can add other useful data like request ID
                        // 'request_id' => $milkRequest->id,
                    ]
                );

            } catch (\Throwable $e) {
                // Silent fail for notification issues
            }
        }
    }

    return response()->json([
        'message' => 'OTP verified successfully.',
        'data' => [
            'id'           => $milkRequest->id,
            'name'         => $milkRequest->name,
            'phone'        => $milkRequest->phone,
            'milk_type'    => $milkRequest->milk_type,
            'is_verified'  => $milkRequest->is_verified,
        ],
    ]);
}




    public function resendOrVerifyOtpBreastMilk(Request $request)
    {
        try{

        
        $request->validate([
            'id'    => 'required|integer|exists:breast_milk,id',
            'phone' => 'required|string|max:20',
            'otp'   => 'nullable|string',
        ]);
    
        $breastMilk = BreastMilk::where('id', $request->id)
            ->where('phone', $request->phone)
            ->where('requester_id', auth()->id()) // Ensure the requester is the authenticated user
            ->first();
    
        if (!$breastMilk) {
            return response()->json([
                'message' => 'Record not found with given ID and phone.',
                'status'  => false,
            ], 404);
        }
    
        // If OTP is provided, attempt verification
        if ($request->filled('otp')) {
            $verifyResponse = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/VERIFY/{$breastMilk->otp_session_id}/{$request->otp}");
    
            if (!$verifyResponse->ok() || $verifyResponse['Details'] !== 'OTP Matched') {
                return response()->json([
                    'message' => 'Invalid OTP.',
                    'status'  => false,
                ], 400);
            }
    
            $breastMilk->is_verified = true;
            $breastMilk->save();
    
            return response()->json([
                'message' => 'OTP verified successfully.',
                'status'  => true,
                'data'    => [
                    'id'           => $breastMilk->id,
                    'name'         => $breastMilk->name,
                    'phone'        => $breastMilk->phone,
                    'is_verified'  => $breastMilk->is_verified,
                ]
            ]);
        }
    
        // Else: Resend OTP
        $otpResponse = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/{$request->phone}/AUTOGEN");
    
        if (!$otpResponse->ok() || !isset($otpResponse['Details'])) {
            return response()->json([
                'message' => 'Failed to send OTP.',
                'status'  => false,
            ], 500);
        }
    
        $breastMilk->otp_session_id = $otpResponse['Details'];
        $breastMilk->is_verified    = false;
        $breastMilk->save();
    
        return response()->json([
            'message'    => 'OTP resent successfully. Please verify using the same API.',
            'request_id' => $breastMilk->id,
            'status'     => true,
            'is_verified'=> false,
        ]);
    }
        catch(\Exception $e){
            return response()->json([
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
                'status'  => false,
            ], 500);
        }
    }

public function getBreastMilkById($id)
{
    $breastMilk = BreastMilk::findOrFail($id);

    if ($breastMilk->requester_id !== auth()->id()) {
        return response()->json(['message' => 'Unauthorized access.'], 404);
    }

    return response()->json([
        'message' => 'Breast milk request fetched successfully.',
        'data' => $breastMilk
    ]);
}
public function updateBreastMilk(Request $request, $id)
{
    $breastMilk = BreastMilk::findOrFail($id);

    // Ensure the authenticated user is the owner
    if ((int) $breastMilk->requester_id !== (int) auth()->id()) {
        return response()->json(['message' => 'Unauthorized access.'], 403);
    }

    // Validate input
    $validated = $request->validate([
        'name'           => 'required|string|max:255',
        'gender'         => 'required|string|max:10',
        'phone'          => 'required|string|max:20',
        'location'       => 'required|string|max:255',
        'milk_quantity'  => 'required|string|max:255',
        'expires_at'     => 'date|nullable',
        'lat'            => 'required|numeric',
        'long'           => 'required|numeric',
        'milk_for'       => 'nullable|numeric',
        'country_code'   => 'nullable|string|max:10',
        'milk_type'      => 'nullable|string|max:255',
    ]);

    try {
        DB::beginTransaction();

        $breastMilk->update([
            'name'           => $validated['name'],
            'gender'         => $validated['gender'],
            'phone'          => $validated['phone'],
            'location'       => $validated['location'],
            'milk_quantity'  => $validated['milk_quantity'],
            'expires_at'     => $validated['expires_at'] ?? null,
            'milk_for'       => $validated['milk_for'] ?? null,
            'country_code'   => $validated['country_code'] ?? null,
            'milk_type'      => $validated['milk_type'] ?? null,
        ]);

        // Update coordinates as POINT
        DB::statement("UPDATE breast_milk SET coordinate = ST_GeomFromText(?, 4326) WHERE id = ?", [
            'POINT(' . $validated['long'] . ' ' . $validated['lat'] . ')',
            $breastMilk->id
        ]);

        DB::commit();

        return response()->json([
            'message' => 'Breast milk request updated successfully.',
            'data' => $breastMilk->fresh()
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'message' => 'Update failed.',
            'error' => $e->getMessage()
        ], 500);
    }
}

// public function updateBreastMilk(Request $request)
// {
//     $request->validate([
//         'id'             => 'required|exists:breast_milk,id',
//         'name'           => 'required|string|max:255',
//         'gender'         => 'required|string|max:10',
//         'phone'          => 'required|string|max:20',
//         'location'       => 'required|string|max:255',
//         'milk_quantity'  => 'required|string|max:255',
//         'expires_at'     => 'date|nullable',
//         'lat'            => 'required|numeric',
//         'long'           => 'required|numeric',
//         'milk_for'       => 'nullable|numeric',
//         'country_code'   => 'nullable|string|max:10',
//         'milk_type'      => 'nullable|string|max:255',
//     ]);

//     try {
//         DB::beginTransaction();

//         $breastMilk = BreastMilk::findOrFail($request->id);

//         if ($breastMilk->requester_id !== auth()->id()) {
//             return response()->json(['message' => 'Unauthorized access.'], 403);
//         }

//         $breastMilk->update([
//             'name'           => $request->name,
//             'gender'         => $request->gender,
//             'phone'          => $request->phone,
//             'location'       => $request->location,
//             'milk_quantity'  => $request->milk_quantity,
//             'expires_at'     => $request->expires_at,
//             'milk_for'       => $request->milk_for,
//             'country_code'   => $request->country_code,
//             'milk_type'      => $request->milk_type,
//         ]);

//         DB::statement("UPDATE breast_milk SET coordinate = ST_GeomFromText(?, 4326) WHERE id = ?", [
//             'POINT(' . $request->long . ' ' . $request->lat . ')',
//             $breastMilk->id
//         ]);

//         DB::commit();

//         return response()->json([
//             'message' => 'Breast milk request updated successfully.',
//             'data' => $breastMilk
//         ]);
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return response()->json(['message' => 'Update failed.', 'error' => $e->getMessage()], 500);
//     }
// }

public function deleteBreastMilk($id)
{
    $breastMilk = BreastMilk::findOrFail($id);

    if ($breastMilk->requester_id !== auth()->id()) {
        return response()->json(['message' => 'Unauthorized access.'], 404);
    }

    try {
        $breastMilk->delete();

        return response()->json([
            'message' => 'Breast milk request deleted successfully.'
        ]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Delete failed.', 'error' => $e->getMessage()], 500);
    }
}

   public function getBreastMilkList()
{
    $user = auth()->user();

    $requests = BreastMilk::where('requester_id', $user->id)
        ->where('is_verified', true)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($milkRequest) {
            $milkRequest->donor_email = null;
            $milkRequest->donor_phone = null;
            $milkRequest->donor_name = null;

            if ($milkRequest->donor_id) {
                // Check if the donor has verified OTP for this milk request
                $validation = \App\Models\MilkDonorReqValidation::where('breast_milk_id', $milkRequest->id)
                    ->where('donor_id', $milkRequest->donor_id)
                    ->where('is_verified', true)
                    ->first();

                if ($validation) {
                    $donor = \App\Models\User::find($milkRequest->donor_id);
                    if ($donor) {
                        $milkRequest->donor_email = $donor->email;
                        $milkRequest->donor_phone = $donor->phone;
                        $milkRequest->donor_name = $donor->name;
                    }
                }
            }

            return $milkRequest;
        });

    return response()->json([
        'message' => 'Breast Milk list fetched successfully.',
        'status' => true,
        'data' => $requests
    ]);
}
public function getNearbyBreastMilkRequests(Request $request)
{
    $user = auth()->user();

    if (!$user || !$user->is_milk_donor || !$user->coordinate) {
        return response()->json(['message' => 'Unauthorized or donor location not available.'], 403);
    }

    // Get the user's coordinate (POINT format)
    $userLocation = DB::selectOne("SELECT ST_AsText(coordinate) as point FROM users WHERE id = ?", [$user->id]);

    if (!$userLocation || !preg_match('/POINT\(([-\d.]+) ([-\d.]+)\)/', $userLocation->point, $matches)) {
        return response()->json(['message' => 'Invalid user location.'], 400);
    }

    $userLong = $matches[1];
    $userLat = $matches[2];

    // Find nearby breast milk requests within 5 km, excluding user's own requests
    $requests = DB::select("
        SELECT 
            id,
            name,
            requester_id,
            milk_quantity,
            milk_type,
            milk_for,
            expires_at,
            phone,
            location,
            status,
            ST_AsText(coordinate) as coordinate,
            ST_Distance_Sphere(coordinate, ST_GeomFromText(?, 4326)) AS distance
        FROM breast_milk
        WHERE coordinate IS NOT NULL
          AND status = 'requested'
          AND is_verified = 1
          AND requester_id != ?
          AND ST_Distance_Sphere(coordinate, ST_GeomFromText(?, 4326)) <= 5000
        ORDER BY created_at DESC
    ", [
        "POINT($userLong $userLat)",
        $user->id,
        "POINT($userLong $userLat)"
    ]);

    return response()->json([
        'message' => 'Nearby breast milk requests retrieved successfully.',
        'data' => $requests
    ]);
}



public function acceptBreastMilkRequest(Request $request)
{
    $request->validate([
        'breast_milk_id' => 'required|exists:breast_milk,id',
    ]);

    $user = auth()->user();

    if (!$user || !$user->is_milk_donor) {
        return response()->json(['message' => 'Unauthorized donor.'], 403);
    }

    $milkRequest = BreastMilk::find($request->breast_milk_id);

    if (!$milkRequest) {
        return response()->json(['message' => 'Breast milk request not found.'], 404);
    }

    // Send OTP to donor's phone using 2Factor
    $response = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/{$user->phone}/AUTOGEN");

    if (!$response->ok() || !isset($response['Details'])) {
        return response()->json(['message' => 'Failed to send OTP.'], 500);
    }

    $otpSessionId = $response['Details'];

    // Save OTP validation session
    $validation = MilkDonorReqValidation::create([
        'donor_id' => $user->id,
        'breast_milk_id' => $milkRequest->id,
        'otp_session_id' => $otpSessionId,
        'is_verified' => false
    ]);

    return response()->json([
        'message' => 'OTP sent successfully.',
        'otp_session_id' => $otpSessionId,
        'validation_id' => $validation->id
    ]);
}
public function verifyMilkDonorOtp(Request $request)
{
    $request->validate([
        'validation_id' => 'required|exists:milk_donor_req_validation,id',
        'otp' => 'required|string',
    ]);

    $validation = MilkDonorReqValidation::findOrFail($request->validation_id);

    if (!$validation->otp_session_id) {
        return response()->json(['message' => 'OTP session not found.'], 400);
    }

    // Verify OTP using 2Factor
    $verify = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/VERIFY/{$validation->otp_session_id}/{$request->otp}");

    if (!$verify->ok() || $verify['Details'] !== 'OTP Matched') {
        return response()->json(['message' => 'Invalid OTP.'], 400);
    }

    // Mark validation as verified
    $validation->is_verified = true;
    $validation->save();

    // Update breast milk request status and donor_id
    $breastMilk = BreastMilk::find($validation->breast_milk_id);
    $breastMilk->status = 'Processed';
    $breastMilk->donor_id = $validation->donor_id;
    $breastMilk->save();

    return response()->json([
        'message' => 'OTP verified successfully.',
        'data' => $validation
    ]);
}


public function getDonatedBreastMilkHistory()
{
    $donorId = auth()->id(); // Get the currently logged-in user's ID

    $history = MilkDonorReqValidation::with(['donor', 'breastMilk.requester'])
                ->where('donor_id', $donorId)
                ->where('is_verified', true) // Only fetch verified donations
                ->orderBy('created_at', 'desc')
                ->get();

    return response()->json([
        'success' => true,
        'message' => 'Your donated breast milk history fetched successfully.',
        'data' => $history->map(function ($item) {
            $requester = optional(optional($item->breastMilk)->requester);
            return [
                'id' => $item->breast_milk_id,
                'donor_id' => $item->donor_id,
                'donor_name' => optional($item->donor)->name,
                'donor_email' => optional($item->donor)->email,

                'breast_milk_id' => $item->breast_milk_id,
                'baby_name' => optional($item->breastMilk)->name,
                 'gender' => $item->breastMilk->gender,
                'milk_quantity' => $item->breastMilk->milk_quantity,
                'expires_at' => $item->breastMilk->expires_at,
                'status' => $item->breastMilk->status,
                'milk_for' => $item->breastMilk->milk_for,
                'milk_type' => $item->breastMilk->milk_type,
                // 'required_date' => optional($item->breastMilk)->required_date,

                'otp_session_id' => $item->otp_session_id,
                'is_verified' => $item->is_verified,

                'requester_id' => $requester->id,
                'requester_name' => $requester->name,
                'requester_email' => $requester->email,
                'requester_phone' => $requester->phone,
                'requester_location' => $item->breastMilk->location,

                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        }),
    ]);
}
public function cancelBreastMilkRequest($id)
{
    $userId = auth()->id(); // Currently authenticated user

    $breastMilk = BreastMilk::where('id', $id)
        // ->where('requester_id', $userId) // Ensure the user owns the request
        ->first();

    if (!$breastMilk) {
        return response()->json([
            'success' => false,
            'message' => 'Breast milk request not found or unauthorized.',
        ], 404);
    }

    if ($breastMilk->status === 'cancelled') {
        return response()->json([
            'success' => false,
            'message' => 'This request is already cancelled.',
        ], 400);
    }

    $breastMilk->status = 'cancelled';
    $breastMilk->save();

    return response()->json([
        'success' => true,
        'message' => 'Breast milk request cancelled successfully.',
        'data' => $breastMilk,
    ]);
}


}
