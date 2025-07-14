<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\BloodBankController;
use App\Http\Controllers\ForgotPasswordController;

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\BreastMilkController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/reset-link', [AuthController::class, 'sendResetLink']);


Route::post('/google-login', [GoogleAuthController::class, 'loginWithGoogle']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/user/delete', [AuthController::class, 'deleteUser']);

   

});
// Route::post('/find-ambulance', [AmbulanceController::class, 'findNearbyAmbulances']);
Route::middleware('auth:sanctum')->post('/find-ambulance', [AmbulanceController::class, 'findNearbyAmbulances']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/add_ambulance_provider', [AmbulanceController::class, 'addAmbulanceProvider']);
    Route::post('/verify_otp_ambulance', [AmbulanceController::class, 'verifyOtpAmbulance']);
    Route::post('/ambulance-provider-status', [AmbulanceController::class, 'updateAmbulanceProviderStatus']);
    Route::post('/ambulance/update/{id}', [AmbulanceController::class, 'updateAmbulanceProvider']);
    Route::get('/ambulance-provider/{id}', [AmbulanceController::class, 'getAmbulanceById']);
    Route::delete('/ambulance/delete/{id}', [AmbulanceController::class, 'deleteAmbulanceProvider']);
    Route::get('/ambulance/list', [AmbulanceController::class, 'getMyAmbulanceProviders']);
    Route::post('/resend_or_verify_otp_ambulance', [AmbulanceController::class, 'resendOrVerifyOtpAmbulance']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/add_breast_milk', [BreastMilkController::class, 'addBreastMilk']);
    Route::get('/breast_milk/{id}', [BreastMilkController::class, 'getBreastMilkById']);
    Route::post('/breast_milk/update/{id}', [BreastMilkController::class, 'updateBreastMilk']);
    Route::delete('/breast_milk/delete/{id}', [BreastMilkController::class, 'deleteBreastMilk']);

    
    Route::post('/verify_otp_breast_milk', [BreastMilkController::class, 'verifyOtpBreastMilk']);
    
    Route::post('/resend-otp-breast-milk', [BreastMilkController::class, 'resendOrVerifyOtpBreastMilk']);

    Route::get('/breast_milk-list', [BreastMilkController::class, 'getBreastMilkList']);
    Route::get('/donate-breast-milk-list', [BreastMilkController::class, 'getNearbyBreastMilkRequests']);
    Route::post('/accept-breast-milk-request', [BreastMilkController::class, 'acceptBreastMilkRequest']);
    Route::post('/verify-breast-milk-otp', [BreastMilkController::class, 'verifyMilkDonorOtp']);
    Route::get('/donate-breast-milk-history', [BreastMilkController::class, 'getDonatedBreastMilkHistory']);
Route::post('/cancel-breast-milk-request/{id}', [BreastMilkController::class, 'cancelBreastMilkRequest']);

});
// routes/api.php


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/request-blood', [BloodRequestController::class, 'sendOtp']);
    Route::post('/verify-blood-otp', [BloodRequestController::class, 'verifyOtp']);
    Route::post('/cancel-blood-request', [BloodRequestController::class, 'cancelBloodRequest']);

    Route::get('/request_blood_list', [BloodRequestController::class, 'getUserBloodRequests']);
    Route::post('/resend-otp-blood', [BloodRequestController::class, 'resendOrVerifyOtpBloodRequest']);
    Route::get('/blood-request/{id}', [BloodRequestController::class, 'getBloodRequestById']);
    // update blood request
    Route::post('/update-blood-request/{id}', [BloodRequestController::class, 'updateBloodRequest']);
    Route::delete('/delete-blood-request/{id}', [BloodRequestController::class, 'deleteBloodRequest']);
    Route::get('/donate-blood-list', [BloodRequestController::class, 'donateBloodList']);
    Route::post('/accept-blood-request', [BloodRequestController::class, 'acceptBloodRequest']);
    Route::post('/verify-donor-otp', [BloodRequestController::class, 'verifyDonorOtp']);
    Route::get('/donate-blood-history', [BloodRequestController::class, 'getDonatedBloodHistory']);
    // Route::get('/cancel-blood-request/{id}', [BloodRequestController::class, 'cancelBloodRequest']);


});

