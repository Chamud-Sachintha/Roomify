<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailOTPController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/register', [AuthenticationController::class, 'registerNewUser'])->name('register');
Route::post('/login', [AuthenticationController::class, 'authenticateUser'])->name('login');
Route::post('/verify-otp', [EmailOTPController::class, 'validateOTP'])->name('verify_otp');
Route::get('app/dashboard', [DashboardController::class, 'showDashboardPage'])->name('dashboard')->middleware('auth');