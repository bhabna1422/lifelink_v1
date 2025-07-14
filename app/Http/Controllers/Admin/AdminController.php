<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\MealStaff;
use App\Models\Meal;
use DB;
use Illuminate\Support\Facades\Log; // Import Log facade for logging\
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;


class AdminController extends Controller
{
    //
    public function adminlogin(){
        return view("adminlogin");
    }
   // Authenticate function
public function adminauthenticate(Request $request)
{
    // Validate the request data
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    // Extract email and password from the request
    $credentials = $request->only('email', 'password');

    // Attempt to authenticate the admin using the 'admins' guard
    if (Auth::guard('admins')->attempt($credentials)) {
        // Authentication passed, redirect to the admin dashboard
        return redirect()->intended('/admin/dashboard');
    } else {
        // Authentication failed, redirect back with error message
        return redirect()->back()->withInput()->withErrors([
            'login_error' => 'Invalid email or password',
        ]);
    }
}

    public function dashboard()
    {
      $ambulanceCount = \App\Models\Ambulance::whereNull('deleted_at')->count();
    $bloodDonorCount = \App\Models\User::where('is_donor', 1)->count();
    $milkDonorCount = \App\Models\User::where('is_milk_donor', 1)->count();
    $ambulanceProviderCount = \App\Models\User::where('is_ambulance_provider', 1)->count();

    return view('admin/dashboard', compact(
        'ambulanceCount',
        'bloodDonorCount',
        'milkDonorCount',
        'ambulanceProviderCount'
    ));
        //  return view('admin/dashboard');
    }
       
    
// public function showSubmitData(Request $request)
// {
//     $code = $request->input('code');
//     // Assuming the QR code contains JSON data
//     $data = json_decode($code, true);

//     return view('admin.submit-data', [
//         'unique_code' => $data['unique_code'] ?? '',
//         'name' => $data['name'] ?? '',
//         'ref_id' => $data['ref_id'] ?? '',
//         'type' => $data['type'] ?? '',
//     ]);
// }


    // public function saveUserData(Request $request)
    // {
    //     $request->validate([
    //         'date' => 'required|date',
    //         'unique_code' => 'required|string',
    //         'name' => 'required|string',
    //         'meal' => 'required|string',
    //     ]);

    //     // Save the data to the meals table
    //     \DB::table('meals')->insert([
    //         'date' => $request->input('date'),
    //         'unique_code' => $request->input('unique_code'),
    //         'name' => $request->input('name'),
    //         'meal' => $request->input('meal'),
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //     return redirect()->back()->with('success', 'User data saved successfully!');
    // }
// public function showSubmitData(Request $request)
// {
//     // Retrieve the query parameters directly
//     $uniqueCode = $request->input('unique_code');
//     $name = $request->input('name');
//     $refId = $request->input('ref_id');
//     $type = $request->input('type');

//     // Log the received data for debugging purposes
//     \Log::info("Received Data: Unique Code: $uniqueCode, Name: $name, Ref ID: $refId, Type: $type");

//     // Check if all necessary parameters are present
//     if (!$uniqueCode || !$name || !$refId || !$type) {
//         \Log::error('Missing required QR code data.');
//         return back()->withErrors('Missing required QR code data.');
//     }

//     // Fetch the current date
//     $currentDate = date('Y-m-d');

//     // Fetch the meals the user has already selected for today
//     $selectedMeals = Meal::where('unique_code', $uniqueCode)
//         ->where('date', $currentDate)
//         ->pluck('meal') // Get only the 'meal' column
//         ->toArray(); // Convert result to array

//     // Log the selected meals for debugging
//     \Log::info('Selected meals: ', $selectedMeals);

//     // Pass the data and selected meals to the view
//     return view('admin.submit-data', [
//         'unique_code' => $uniqueCode,
//         'name' => $name,
//         'ref_id' => $refId,
//         'type' => $type,
//         'selectedMeals' => $selectedMeals, // Pass already selected meals to the view
//     ]);
// }

public function showSubmitData(Request $request)
{
    // Retrieve the query parameters directly
    $uniqueCode = $request->input('unique_code');
    $name = $request->input('name');
    $refId = $request->input('ref_id');
    $type = $request->input('type');

    // Log the received data for debugging purposes
    \Log::info("Received Data: Unique Code: $uniqueCode, Name: $name, Ref ID: $refId, Type: $type");

    // Check if all necessary parameters are present
    if (!$uniqueCode || !$name || !$refId || !$type) {
        \Log::error('Missing required QR code data.');
        return back()->withErrors('Missing required QR code data.');
    }

    // Fetch the current date
    $currentDate = date('Y-m-d');

    // Fetch the meals the user has already selected for today, based on the type
    if ($type === 'IPCA_staff' || $type === 'pharma_staff') {
        // For IPCA_staff and pharma_staff, fetch from meals_staff table
        $selectedMeals = MealStaff::where('unique_code', $uniqueCode)
            ->where('date', $currentDate)
            ->pluck('meal') // Get only the 'meal' column
            ->toArray(); // Convert result to array
    } else {
        // For other types, fetch from meals table
        $selectedMeals = Meal::where('unique_code', $uniqueCode)
            ->where('date', $currentDate)
            ->pluck('meal') // Get only the 'meal' column
            ->toArray(); // Convert result to array
    }

    // Log the selected meals for debugging
    \Log::info('Selected meals: ', $selectedMeals);

    // Pass the data and selected meals to the view
    return view('admin.submit-data', [
        'unique_code' => $uniqueCode,
        'name' => $name,
        'ref_id' => $refId,
        'type' => $type,
        'selectedMeals' => $selectedMeals, // Pass already selected meals to the view
    ]);
}




        
    //  public function saveUserData(Request $request)
    // {
    //     $uniqueCode = $request->input('unique_code');
    //     $type = $request->input('type');
    //     $meal = $request->input('meal');
    //     $currentDate = date('Y-m-d');
    
    //     // Fetch the meals the user has already selected for today
    //     $mealCount = Meal::where('unique_code', $uniqueCode)
    //         ->where('type', $type)
    //         ->where('date', $currentDate)
    //         ->count();
    
    //     // Check if the selected meal is already taken by the user for today
    //     if (Meal::where('unique_code', $uniqueCode)
    //         ->where('meal', $meal)
    //         ->where('date', $currentDate)
    //         ->exists()) {
    //         return redirect()->route('dashboard')->with('error', 'You have already selected this meal for today.');
    //     }
    
    //     // Check meal limits based on type (Doctor: 4 meals, Accompany: 3 meals)
    //     if (($type === 'doctor' && $mealCount >= 4) || ($type === 'accompany' && $mealCount >= 3)) {
    //         return redirect()->route('dashboard')->with('error', 'You have reached the maximum meal selections for today.');
    //     }
    
    //     // Save the new meal selection
    //     $mealRecord = new Meal();
    //     $mealRecord->unique_code = $uniqueCode;
    //     $mealRecord->name = $request->input('name');
    //     $mealRecord->ref_id = $request->input('ref_id');
    //     $mealRecord->type = $type;
    //     $mealRecord->meal = $meal;
    //     $mealRecord->date = $currentDate;
    //     $mealRecord->save();
    
    //     return redirect()->route('dashboard')->with('success', 'Meal selection saved successfully.');
    // }

public function saveUserData(Request $request)
{
    $uniqueCode = $request->input('unique_code');
    $type = $request->input('type');
    $meal = $request->input('meal');
    $currentDate = date('Y-m-d');

    // Determine which table to check and save data into based on the type
    $mealModel = ($type === 'IPCA_staff' || $type === 'pharma_staff') ? new MealStaff() : new Meal();

    // Fetch the meals the user has already selected for today from the appropriate table
    $mealCount = $mealModel::where('unique_code', $uniqueCode)
        ->where('type', $type)
        ->where('date', $currentDate)
        ->count();

    // Check if the selected meal is already taken by the user for today
    if ($mealModel::where('unique_code', $uniqueCode)
        ->where('meal', $meal)
        ->where('date', $currentDate)
        ->exists()) {
        return redirect()->route('dashboard')->with('error', 'You have already selected this meal for today.');
    }

    // Check meal limits based on type (Doctor: 4 meals, Accompany: 3 meals)
    if (($type === 'doctor' && $mealCount >= 4) || ($type === 'accompany' && $mealCount >= 3)) {
        return redirect()->route('dashboard')->with('error', 'You have reached the maximum meal selections for today.');
    }

    // Save the new meal selection in the appropriate table
    $mealModel->unique_code = $uniqueCode;
    $mealModel->name = $request->input('name');
    $mealModel->ref_id = $request->input('ref_id');
    $mealModel->type = $type;
    $mealModel->meal = $meal;
    $mealModel->date = $currentDate;
    $mealModel->save();

    return redirect()->route('dashboard')->with('success', 'Meal selection saved successfully.');
}


public function adminlogout(Request $request)
{
    \Log::info('Admin logout triggered'); // Log to check if this method is called

    Auth::guard('admins')->logout(); // Use the 'admins' guard

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('adminlogin'); // Redirect to admin login page
}
public function contactList()
{
    $contacts = DB::table('contacts')->orderBy('created_at', 'desc')->get();
    return view('admin.contactlist', compact('contacts'));


}


public function showForgotPasswordForm()
{
    return view('admin.auth.forgot-password');
}

public function handleForgotPassword(Request $request)
{
    $request->validate([
        'identity' => 'required'
    ]);

    $input = $request->identity;

    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        // Email Flow
        $admin = Admin::where('email', $input)->first();
        if (!$admin) return back()->withErrors(['identity' => 'Admin with this email not found.']);

        $token = \Str::random(64);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $admin->email],
            ['token' => $token, 'created_at' => now()]
        );
        $resetUrl = url('/admin/password/reset/' . $token . '?email=' . urlencode($admin->email));

        Mail::send('emails.admin-reset', [
            'token' => $token,
            'admin' => $admin,
            'resetLink' => $resetUrl,
        ], function ($message) use ($admin) {
            $message->to($admin->email);
            $message->subject("Reset Password for Lifelink Admin");
        });

        return back()->with('status', 'Reset link sent to your email.');
    } else {
        // OTP Flow
        $admin = Admin::where('phone', $input)->first();
        if (!$admin) return back()->withErrors(['identity' => 'Admin with this phone not found.']);

        $otpResponse = Http::get("https://2factor.in/API/V1/" . env('OTP_TWO_FACTOR') . "/SMS/{$admin->phone}/AUTOGEN");

        if (!$otpResponse->ok() || !isset($otpResponse['Details'])) {
            return back()->withErrors(['identity' => 'OTP failed to send.']);
        }

        $admin->otp_session_id = $otpResponse['Details'];
        $admin->save();

        return redirect()->route('admin.otp.verify.form', $admin->id);
    }
}
public function showOtpVerifyForm($id)
{
    $admin = Admin::findOrFail($id);
    return view('admin.auth.otp-verify', compact('admin'));
}

public function verifyOtpAndReset(Request $request, $id)
{
    $admin = Admin::findOrFail($id);
    $request->validate([
        'otp' => 'required',
        'password' => 'required|min:6|confirmed'
    ]);

    $otpStatus = Http::get("https://2factor.in/API/V1/" . env('OTP_TWO_FACTOR') . "/SMS/VERIFY/{$admin->otp_session_id}/{$request->otp}");

    if ($otpStatus['Status'] !== 'Success') {
        return back()->withErrors(['otp' => 'Invalid OTP']);
    }

    $admin->password = bcrypt($request->password);
    $admin->otp_session_id = null;
    $admin->save();

    return redirect()->route('adminlogin')->with('status', 'Password reset successful!');
}


}