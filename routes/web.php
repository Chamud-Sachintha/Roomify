<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ClientListingController;
use App\Http\Controllers\ClientVerificationDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailOTPController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::post('/register', [AuthenticationController::class, 'registerNewUser'])->name('register');
Route::post('/login', [AuthenticationController::class, 'authenticateUser'])->name('login');
Route::post('/verify-otp', [EmailOTPController::class, 'validateOTP'])->name('verify_otp');
Route::get('app/dashboard', [DashboardController::class, 'showDashboardPage'])->name('dashboard')->middleware('auth');
Route::get('app/verification', [ClientVerificationDocumentController::class, 'showVerificationPage'])->name('verification')->middleware('auth');
Route::get('/settings/verification-settings', [SettingsController::class, 'showVerificationSettingsPage'])->name('verification-settings')->middleware('auth');
Route::post('/settings/create-verification-document-type', [SettingsController::class, 'createVerificationDocumentType'])->name('create_verification_document_type')->middleware('auth');
Route::post('/settings/update-verification-document-type', [SettingsController::class, 'updateVerificationDocumentType'])->name('update_verification_document_type')->middleware('auth');
Route::post('/settings/delete-verification-document-type', [SettingsController::class, 'deleteVerificationDocumentType'])->name('delete_verification_document_type')->middleware('auth');
Route::get('/settings/get-all-verification-document-types', [SettingsController::class, 'getAllverificationDocumentTypes'])->name('get_all_verification_document_types')->middleware('auth');

Route::post('/upload-verification-document', [ClientVerificationDocumentController::class, 'uploadNewVerificationDocument'])->name('upload_verification_document')->middleware('auth');
Route::post('/delete-verification-document', [ClientVerificationDocumentController::class, 'deleteVerificationDocument'])->name('delete_verification_document')->middleware('auth');

Route::get('app/admin/document-verification-requests', [ClientVerificationDocumentController::class, 'showDocumentVerificationRequestsPage'])->name('document_verification_requests')->middleware('auth');
Route::post('app/admin/update-verification-request', [ClientVerificationDocumentController::class, 'updateVerificationRequest'])->name('update_verification_request')->middleware('auth');

Route::get('app/client/my-listings', [ClientListingController::class, 'showCreateListingPage'])->name('client_my_listings')->middleware('auth');
Route::get('app/client/create-listing', [ClientListingController::class, 'showCreateListingFormPage'])->name('create_listing_form')->middleware('auth');