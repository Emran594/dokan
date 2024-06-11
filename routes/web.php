<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/userLogin');
});

Route::post('/user-registration',[UserController::class,'userRegistration']);
Route::post('/user-login',[UserController::class,'userLogin']);
Route::post('/send-otp',[UserController::class,'sendOtp']);
Route::post('/verify-otp',[UserController::class,'verifyOtp']);
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update',[UserController::class,'UpdateProfile'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/logout',[UserController::class,'UserLogout']);

Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOTPPage']);
Route::get('/userProfile',[UserController::class,'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard',[DashboardController::class,'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/salePage',[SaleController::class,'SalePage'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create')->middleware([TokenVerificationMiddleware::class]);
Route::post('/sales', [SaleController::class, 'store'])->name('sales.store')->middleware([TokenVerificationMiddleware::class]);
Route::get('/sales/{id}/edit', [SaleController::class, 'editSale'])->name('sales.edit')->middleware([TokenVerificationMiddleware::class]);

// API route for fetching nozzles by tank
Route::get('/api/nozzles/{tank}', [SaleController::class, 'getNozzlesByTank'])->middleware([TokenVerificationMiddleware::class]);
