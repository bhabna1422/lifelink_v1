<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\ResetPasswordMail;

use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
   // ✅ Register
   public function register(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'name'                  => 'required|string|max:255',
           'email'                 => 'required|string|email|max:255|unique:users',
           'password'              => 'required|string|min:6|confirmed',
           'phone'                 => 'nullable|string|max:255',
           'dob'                   => 'nullable|date',
           'gender'                => 'nullable|string|max:255',
           'blood_group'           => 'nullable|string|max:255',
           'is_donor'              => 'boolean',
           'is_ambulance_provider' => 'boolean',
           'is_milk_donor' => 'boolean',
           'fcm_token'             => 'nullable|string',
           'country_code'         => 'nullable|string|max:10',
       ]);

       if ($validator->fails()) {
           return response()->json([
               'message' => 'Validation failed',
               'status' => false,
               'data' => $validator->errors()
           ], 422);
       }

       $user = User::create([
           'name'                  => $request->name,
           'email'                 => $request->email,
           'password'              => Hash::make($request->password),
           'phone'                 => $request->phone,
           'dob'                   => $request->dob,
           'gender'                => $request->gender,
           'blood_group'           => $request->blood_group,
           'is_donor'              => $request->is_donor ?? false,
           'is_ambulance_provider' => $request->is_ambulance_provider ?? false,
           'is_milk_donor'          => $request->is_milk_donor ?? false,
           'fcm_token'             => $request->fcm_token,
            'country_code'          => $request->country_code,
       ]);

       $token = $user->createToken('auth_token')->plainTextToken;

       return response()->json([
           'message' => 'User registered successfully',
           'status' => true,
           'data' => [
               'user' => $user,
               'access_token' => $token,
               'token_type' => 'Bearer'
           ]
       ]);
   }

   // ✅ Login
   public function login(Request $request)
   {
       $request->validate([
           'email'      => 'required|email',
           'password'   => 'required|string',
           'fcm_token'  => 'nullable|string'
       ]);
   
       $user = User::where('email', $request->email)->first();
   
       // Check user existence and password
       if (!$user || !Hash::check($request->password, $user->password)) {
           return response()->json([
               'message' => 'Invalid email or password',
               'status' => false,
               'data' => null
           ], 422);
       }
   
       // Check if user is marked deleted
       if ($user->delete_status === 'deleted') {
           return response()->json([
               'message' => 'This account has been deleted.',
               'status' => false,
               'data' => null
           ], 403);
       }
   
       // Update FCM token if provided
       if ($request->fcm_token) {
           $user->fcm_token = $request->fcm_token;
           $user->save();
       }
   
       $token = $user->createToken('auth_token')->plainTextToken;
   
       return response()->json([
           'message' => 'Login successful',
           'status' => true,
           'data' => [
               'user' => $user->makeHidden(['coordinate'])->toArray(),
               'access_token' => $token,
               'token_type' => 'Bearer'
           ]
       ]);
   }
   

   // ✅ Get Profile
   public function profile(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'User not found or unauthorized',
                'status' => false,
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'User profile fetched successfully',
            'status' => true,
            'data' => [
                'user' => $user,
               
            ]
        ]);
    }

   // ✅ Update Profile

   public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name'                  => 'nullable|string|max:255',
            'email'                 => 'nullable|email|max:255',
            'password'              => 'nullable|string|min:6|confirmed',
            'phone'                 => 'nullable|string|max:255',
            'dob'                   => 'nullable|date',
            'gender'                => 'nullable|string|max:255',
            'blood_group'           => 'nullable|string|max:255',
            'fcm_token'             => 'nullable|string',
            'location'              => 'nullable|string|max:255',
            'lat'                   => 'nullable|numeric',
            'long'                  => 'nullable|numeric',
            'is_donor'              => 'nullable|boolean',
            'is_ambulance_provider' => 'nullable|boolean',
            'is_milk_donor'         => 'nullable|boolean',
            'country_code'          => 'nullable|string|max:10',
            'google_id'             => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status'  => false,
                'data'    => $validator->errors()
            ], 422);
        }

        // Get only fillable fields from the request
        $data = $request->only($user->getFillable());

        // Hash password if being updated
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Update user
        $user->update($data);

        // Update coordinates if provided
        if ($request->filled('lat') && $request->filled('long')) {
            DB::statement("UPDATE users SET coordinate = ST_GeomFromText(?, 4326) WHERE id = ?", [
                'POINT(' . $request->long . ' ' . $request->lat . ')',
                $user->id,
            ]);
        }

        // Reload updated user
        $user->refresh();

        return response()->json([
            'message' => 'Profile updated successfully',
            'status'  => true,
            'data'    => [
                'user' => $user,
            ]
        ]);
    }

   

   // ✅ Logout
   public function logout(Request $request)
{
    $user = $request->user();

    // Remove the FCM token
    $user->fcm_token = null;
    $user->save();

    // Delete the current access token
    $user->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logout successful',
        'status' => true,
        'data' => null
    ]);
}




public function deleteUser()
{
    $user = auth()->user();

    if (!$user) {
        return response()->json([
            'message' => 'User not found.',
            'status' => false
        ], 404);
    }

    try {
        DB::beginTransaction();

        $userId = $user->id;

        $ambulanceDeleted = DB::table('ambulances')->where('creator', $userId)->delete();
        $bloodDeleted = DB::table('blood')->where('requester_id', $userId)->delete();
        $milkDeleted = DB::table('breast_milk')->where('requester_id', $userId)->delete();
       $milkValidationDeleted = DB::table('milk_donor_req_validation')
                ->where('donor_id', $userId)
                ->orWhere('breast_milk_id', $userId)
                ->delete();
            
            $donorValidationDeleted = DB::table('donor_req_validation')
                ->where('donor_id', $userId)
                ->orWhere('blood_id', $userId)
                ->delete();


        // Log deleted rows
        if ($ambulanceDeleted) {
            Log::info("Deleted $ambulanceDeleted ambulance(s) for user ID $userId");
        }
        if ($bloodDeleted) {
            Log::info("Deleted $bloodDeleted blood request(s) for user ID $userId");
        }
        if ($milkDeleted) {
            Log::info("Deleted $milkDeleted breast milk request(s) for user ID $userId");
        }
        if ($milkValidationDeleted) {
            Log::info("Deleted $milkValidationDeleted milk donor validations for user ID $userId");
        }
        if ($donorValidationDeleted) {
            Log::info("Deleted $donorValidationDeleted donor request validations for user ID $userId");
        }

        // Permanently delete the user
        $user->delete(); // This will perform hard delete if User model does NOT use SoftDeletes trait

        Log::info("User ID $userId permanently deleted from users table.");

        DB::commit();

        return response()->json([
            'message' => 'User account and all related data deleted successfully.',
            'status' => true
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error("User deletion failed for ID {$user->id}: " . $e->getMessage());

        return response()->json([
            'message' => 'Failed to delete user and related data.',
            'status' => false,
            'error' => $e->getMessage()
        ], 500);
    }
}




    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = hash('sha256', Str::random(60));
        $email = $request->email;

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::to($email)->send(new ResetPasswordMail($token, $email));

        return response()->json(['message' => 'Reset password link sent successfully']);
    }

    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');
    
        if (!$email) {
            return redirect('/')->with('error', 'Invalid password reset link. Email is missing.');
        }
    
        return view('auth.passwords.reset', [
            'token' => $token,
            'email' => $email,
        ]);
    }
    

    public function submitReset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $record = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if (!$record || Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            return back()->withErrors(['email' => 'This password reset token is invalid or expired.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        // return redirect('/login')->with('status', 'Password reset successfully. Please log in.');
       return view('password-reset-success');

    }
 
}
