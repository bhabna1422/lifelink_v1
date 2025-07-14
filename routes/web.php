<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\SuperAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AmbulanceController;
use App\Http\Controllers\BloodController as AdminBloodController;
use App\Http\Controllers\Admin\DonorReqController;
use App\Http\Controllers\Admin\MilkDnorReqController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\Admin\RecipientController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\BloodController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BreastMilkController;

use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return response()->json(['message' => 'Cache, config, route, and view cleared successfully']);
});
Route::get('/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/reset-password', [AuthController::class, 'submitReset'])->name('password.reset.submit');
## super admin login
Route::controller(SuperAdminController::class)->group(function() {
        
    Route::get('superadmin/', 'superadminlogin')->name('superadminlogin');
    Route::post('superadmin/authenticate', 'superadminauthenticate')->name('superadminauthenticate');
    Route::get('superadmin/dashboard', 'dashboard')->name('dashboard');
    Route::post('superadmin/logout', 'superadminlogout')->name('superadminlogout');
});


##super admin routes
Route::prefix('superadmin')->middleware(['superadmin'])->group(function () {
    Route::controller(SuperAdminController::class)->group(function() {
        
        Route::get('superadmin/dashboard', 'dashboard')->name('dashboard');
    });
    Route::get('/addadmin', [SuperAdminController::class, 'addadmin']);
    Route::post('/saveadmin', [SuperAdminController::class, 'saveadmin']);
    Route::get('/editadmin/{id}', [SuperAdminController::class, 'editadmin'])->name('editadmin');
    Route::post('/update/{id}', [SuperAdminController::class, 'update'])->name('update');
    Route::get('/dltadmin/{id}', [SuperAdminController::class, 'dltadmin'])->name('dltadmin');

    Route::get('/adminlist', [SuperAdminController::class, 'adminlist']);

 

});


## admins start here
Route::controller(AdminController::class)->group(function() {
        
    Route::get('/', 'adminlogin')->name('adminlogin');
    Route::post('admin/authenticate', 'adminauthenticate')->name('adminauthenticate');
    Route::post('admin/logout', 'adminlogout')->name('adminlogout');

});
Route::get('/admin/forgot-password', [AdminController::class, 'showForgotPasswordForm'])->name('admin.forgot.form');
Route::post('/admin/forgot-password', [AdminController::class, 'handleForgotPassword'])->name('admin.forgot.handle');
Route::get('/admin/otp-verify/{id}', [AdminController::class, 'showOtpVerifyForm'])->name('admin.otp.verify.form');
Route::post('/admin/otp-verify/{id}', [AdminController::class, 'verifyOtpAndReset'])->name('admin.otp.verify.submit');

## admin routes
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::controller(AdminController::class)->group(function() {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
       
        Route::get('/submit-data', 'showSubmitData')->name('admin.submit-data');

    // Route to save user data after form submission
    Route::post('/save-user-data', 'saveUserData')->name('admin.save-user-data');
    
    });

    route::resource('ambulances', AmbulanceController::class);
    Route::resource('users', UserController::class);
    Route::resource('recipients', RecipientController::class);
    Route::resource('bloods', BloodController::class);
    Route::resource('notifications', NotificationController::class);
    Route::resource('breastmilk', BreastMilkController::class);
    Route::resource('donors', DonorReqController::class);
    Route::resource('milkdonors', MilkDnorReqController::class);

    Route::get('/deleted', [UserController::class, 'deleted'])->name('users.deleted');

    Route::get('/users/deleted', [UserController::class, 'deleted'])->name('user.deleted');

});



