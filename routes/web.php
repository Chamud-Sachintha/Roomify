<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientListingController;
use App\Http\Controllers\ClientVerificationDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailOTPController;
use App\Http\Controllers\ManageClientListingController;
use App\Http\Controllers\ProfileSettingsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StripePaymentController;
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
Route::post('app/client/create-new-listing', [ClientListingController::class, 'createNewListing'])->name('create_new_listing')->middleware('auth');
Route::get('app/client/update-listing', [ClientListingController::class, 'showUpdateListingPage'])->name('update_listing_page')->middleware('auth');
Route::put('app/client/update-listing', [ClientListingController::class, 'updateListing'])->name('update_client_listing')->middleware('auth');
Route::get('app/client/delete-listing', [ClientListingController::class, 'deleteListing'])->name('delete_listing_page')->middleware('auth');

Route::get('/payment/success', [StripePaymentController::class, 'success'])->name('stripe.success');
Route::get('/payment/cancel', [StripePaymentController::class, 'cancel'])->name('stripe.cancel');

Route::get('/app/admin/manage-client-listings', [ManageClientListingController::class, 'showManageClientListingsPage'])->name('manage_client_listings')->middleware('auth');
Route::get('/app/admin/manage-client-listings/{id}', [ManageClientListingController::class, 'viewClientListingDetails'])->name('view_client_listing')->middleware('auth');
Route::post('/app/admin/manage-client-listings/{id}/delete', [ManageClientListingController::class, 'deleteClientListing'])->name('delete_client_listing')->middleware('auth');

Route::get('app/profile-settings', [ProfileSettingsController::class, 'showProfileSettingsPage'])->name('profile_settings')->middleware('auth');
Route::post('app/profile-settings', [ProfileSettingsController::class, 'saveProfileSettings'])->name('save_profile_settings')->middleware('auth');

Route::get('app/client/all-listings', [ClientListingController::class, 'showAllListings'])->name('all_listings')->middleware('auth');

Route::get('app/admin/category-management', [CategoryController::class, 'showCategorySettingsPage'])->name('category_management')->middleware('auth');
Route::post('app/admin/category-management/create', [CategoryController::class, 'createNewCategory'])->name('create_new_category')->middleware('auth');

Route::post('/admin/update-listing-status', [ManageClientListingController::class, 'updateListingStatus'])->name('update_listing_status')->middleware('auth');
Route::get('/app/listing/{id}', [ClientListingController::class, 'showsSingleListingItem'])->name('view_single_listing')->middleware('auth');
Route::post('/app/listing/filter', [ClientListingController::class, 'doFilterClientListingItems'])->name('filter_listings')->middleware('auth');