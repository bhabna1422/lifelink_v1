<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ambulance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AmbulanceController extends Controller
{
    public function findNearbyAmbulances(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
    
        $lat = $request->latitude;
        $lng = $request->longitude;
        $distance = 5; // kilometers
    
        $ambulances = DB::table('ambulances')
            ->select(
                'id',
                'name',
                'phone',
                'address',
                'landmark',
                'reg_number',
                'group',
                DB::raw("ST_X(coordinate) as longitude"),
                DB::raw("ST_Y(coordinate) as latitude"),
                DB::raw("ST_Distance_Sphere(coordinate, ST_GeomFromText('POINT($lng $lat)', 4326)) / 1000 as distance")
            )
            ->whereNotNull('coordinate')
            ->where('is_verified', true)
            ->whereNull('deleted_at')
            ->having('distance', '<=', $distance)
            ->orderBy('distance')
            ->get()
            ->map(function ($ambulance) {
                // Map group values to their corresponding labels
                $groupMap = [
                    1 => 'Basic',
                    2 => 'Cardiac',
                    3 => 'Infectious',
                ];
    
                $ambulance->group_name = $groupMap[$ambulance->group] ?? 'Unknown';
                return $ambulance;
            });
    
        return response()->json([
            'message' => 'Nearby ambulances fetched successfully',
            'total_count' => $ambulances->count(),
            'data' => $ambulances
        ]);
    }
    

    public function addAmbulanceProvider(Request $request)
    {
        $request->validate([
            'name'       => 'required|string',
            'address'    => 'required|string',
            'landmark'   => 'required|string',
            'lat'        => 'required|numeric',
            'long'       => 'required|numeric',
            'phone'      => 'required|string',
            'reg_number' => 'required|string',
            // 'group'      => 'required|string',
            'group'      => 'required|in:1,2,3', // 1: Basic, 2: Cardiac, 3: Infectious
            'is_verified' => 'boolean',
            // 'creater' => 'required|integer|exists:users,id',
            "country_code" => 'nullable|string|max:10',
        ]);
    
        try {
            DB::beginTransaction();
    
            // Save initial data without coordinate
            $ambulance = new Ambulance();
            $ambulance->name         = $request->name;
            $ambulance->address      = $request->address;
            $ambulance->landmark     = $request->landmark;
            $ambulance->phone        = $request->phone;
            $ambulance->reg_number   = $request->reg_number;
            $ambulance->group        = $request->group;
            $ambulance->is_verified  = false;
            $ambulance->country_code = $request->country_code;
            $ambulance->creator   = auth()->id();
            $ambulance->save();
    
            // Store coordinate as POINT with SRID 4326 using raw SQL
            DB::statement("UPDATE ambulances SET coordinate = ST_GeomFromText(?, 4326) WHERE id = ?", [
                'POINT(' . $request->long . ' ' . $request->lat . ')',
                $ambulance->id
            ]);
    
            // Send OTP via 2Factor
            $otpResponse = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/{$request->phone}/AUTOGEN");
           
            // Log::info('2Factor OTP API Response:', ['body' => $response->body()]);
            // dd($response->body());
            if (!$otpResponse->ok() || !isset($otpResponse['Details'])) {
                DB::rollBack();
                return response()->json(['message' => 'Failed to send OTP.'], 500);
            }
    
            $ambulance->otp_session_id = $otpResponse['Details'];
            $ambulance->save();
    
            DB::commit();
    
            return response()->json([
                'message'    => 'Ambulance provider data saved and OTP sent.',
                'request_id' => $ambulance->id,
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    public function verifyOtpAmbulance(Request $request)
    {
        $request->validate([
            'request_id' => 'required|integer|exists:ambulances,id',
            'otp'        => 'required|string',
        ]);

        $ambulance = Ambulance::findOrFail($request->request_id);

        $verify = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/VERIFY/{$ambulance->otp_session_id}/{$request->otp}");
        
            
        if (!$verify->ok() || $verify['Details'] !== 'OTP Matched') {
            return response()->json(['message' => 'Invalid OTP.'], 400);
        }

        $ambulance->update([
            'is_verified' => true,
        ]);

        return response()->json([
            'message' => 'OTP verified successfully.',
            'data' => [
                'id' => $ambulance->id,
                'name' => $ambulance->name,
                'phone' => $ambulance->phone,
                'group' => $ambulance->group,
                'is_verified' => $ambulance->is_verified,
            ],
        ]);
        
    }

    public function updateAmbulanceProviderStatus(Request $request)
    {
        $request->validate([
            'is_ambulance_provider' => 'required|boolean',
        ]);

        $user = $request->user();

        $user->is_ambulance_provider = $request->is_ambulance_provider;
        $user->save();

        return response()->json([
            'message' => 'Ambulance provider status updated successfully',
            'status' => true,
            'data' => [
                'is_ambulance_provider' => $user->is_ambulance_provider,
            ],
        ]);
    }

   
    public function getAmbulanceById($id)
    {
        $ambulance = Ambulance::find($id);

        if (!$ambulance) {
            return response()->json([
                'message' => 'Ambulance not found.',
                'status'  => false,
            ], 404);
        }

        return response()->json([
            'message' => 'Ambulance details fetched successfully.',
            'status'  => true,
            'data'    => $ambulance->makeHidden(['coordinate']),
        ]);
    }
    public function updateAmbulanceProvider(Request $request, $id)
    {
        $request->validate([
            'phone'       => 'string',
            'reg_number'  => 'string',
            'group'       => 'in:1,2,3', // 1: Basic, 2: Cardiac, 3: Infectious
        ]);

        try {
            $ambulance = Ambulance::where('id', $id)
                ->where('creator', auth()->id()) // Ensure user owns this ambulance
                ->first();

            if (!$ambulance) {
                return response()->json([
                    'message' => 'Ambulance not found or access denied.',
                    'status' => false
                ], 404);
            }

            $ambulance->update($request->only(['phone', 'reg_number', 'group']));

            return response()->json([
                'message' => 'Ambulance details updated successfully.',
                'status' => true,
                'data' => $ambulance->makeHidden(['coordinate'])->toArray()
            ]);
            

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update ambulance.',
                'error'   => $e->getMessage(),
                'status' => false
            ], 500);
        }
    }

    public function deleteAmbulanceProvider($id)
    {
        $ambulance = Ambulance::where('id', $id)
            ->where('creator', auth()->id())
            ->first();

        if (!$ambulance) {
            return response()->json([
                'message' => 'Ambulance not found or unauthorized.',
                'status' => false
            ], 404);
        }

        $ambulance->deleted_at = now(); // Soft delete
        $ambulance->save();

        return response()->json([
            'message' => 'Ambulance deleted successfully.',
            'status' => true
        ]);
    }

    public function getMyAmbulanceProviders()
    {
        $ambulances = Ambulance::where('creator', auth()->id())
            ->whereNull('deleted_at') // Exclude deleted ones
            ->where('is_verified', true) // Only verified ambulances
            ->get();

        return response()->json([
            'message' => 'Ambulance list fetched successfully.',
            'status' => true,
            'data' => $ambulances
        ]);
    }
    public function resendOrVerifyOtpAmbulance(Request $request)
    {
        $request->validate([
            'id'    => 'required|integer|exists:ambulances,id',
            'phone' => 'required|string|max:20',
            'otp'   => 'nullable|string',
        ]);

        $ambulance = Ambulance::where('id', $request->id)
            ->where('phone', $request->phone)
            ->where('creator', auth()->id()) // Ensure the requester is the authenticated user
            ->first();

        if (!$ambulance) {
            return response()->json([
                'message' => 'Ambulance provider not found with given ID and phone.',
                'status'  => false,
            ], 404);
        }

        // If OTP is present – verify it
        if ($request->filled('otp')) {
            $verifyResponse = Http::get("https://2factor.in/API/V1/6bedbd64-0e3e-11eb-9fa5-0200cd936042/SMS/VERIFY/{$ambulance->otp_session_id}/{$request->otp}");

            if (!$verifyResponse->ok() || $verifyResponse['Details'] !== 'OTP Matched') {
                return response()->json([
                    'message' => 'Invalid OTP.',
                    'status'  => false,
                ], 400);
            }

            $ambulance->update(['is_verified' => true]);

            return response()->json([
                'message' => 'OTP verified successfully.',
                'status'  => true,
                'data'    => [
                    'id'          => $ambulance->id,
                    'name'        => $ambulance->name,
                    'phone'       => $ambulance->phone,
                    'group'       => $ambulance->group,
                    'is_verified' => $ambulance->is_verified,
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

        $ambulance->otp_session_id = $otpResponse['Details'];
        $ambulance->is_verified    = false;
        $ambulance->save();

        return response()->json([
            'message'     => 'OTP resent successfully. Please verify using the same API.',
            'request_id'  => $ambulance->id,
            'status'      => true,
            'is_verified' => false,
        ]);
    }





}
