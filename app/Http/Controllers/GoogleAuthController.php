<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function loginWithGoogle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'google_id' => 'required|string',
            'fcm_token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // If user exists, update fcm and google_id
            $user->update([
                'fcm_token' => $request->fcm_token,
                'google_id' => $request->google_id,
            ]);
        } else {
            // If user doesn't exist, register new one with default or empty values
            $user = User::create([
                'name' => $request->name, // Or get from Google profile if available
                'email' => $request->email,
                'password' => Hash::make('lifelink@123'),
                'google_id' => $request->google_id,
                'fcm_token' => $request->fcm_token,
                'phone' => null,
                'dob' => null,
                'gender' => null,
                'blood_group' => null,
                'is_donor' => false,
                'is_ambulance_provider' => false,
                'is_milk_donor' => false,
                'country_code' => null,
                'location' => null,
                'coordinate' => null,
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user->makeHidden(['coordinate'])->toArray(),
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

}

