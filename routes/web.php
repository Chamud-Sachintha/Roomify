<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\ClientListingController;
use App\Http\Controllers\ClientVerificationDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailOTPController;
use App\Http\Controllers\ManageClientListingController;
use App\Http\Controllers\ProfileSettingsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserManagementController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('welcome'));
Route::get('/register', fn() => view('register'));
Route::get('/login', fn() => view('login'));

Route::post('/register', [AuthenticationController::class, 'registerNewUser'])->name('register');
Route::post('/login', [AuthenticationController::class, 'authenticateUser'])->name('login');
Route::post('/verify-otp', [EmailOTPController::class, 'validateOTP'])->name('verify_otp');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/app/dashboard', [DashboardController::class, 'showDashboardPage'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile Settings
    |--------------------------------------------------------------------------
    */
    Route::prefix('app/profile-settings')->group(function () {
        Route::get('/', [ProfileSettingsController::class, 'showProfileSettingsPage'])->name('profile_settings');
        Route::post('/', [ProfileSettingsController::class, 'saveProfileSettings'])->name('save_profile_settings');
    });

    /*
    |--------------------------------------------------------------------------
    | Verification (Client)
    |--------------------------------------------------------------------------
    */
    Route::prefix('app')->group(function () {
        Route::get('/verification', [ClientVerificationDocumentController::class, 'showVerificationPage'])->name('verification');

        Route::post('/upload-verification-document', [ClientVerificationDocumentController::class, 'uploadNewVerificationDocument'])->name('upload_verification_document');
        Route::post('/delete-verification-document', [ClientVerificationDocumentController::class, 'deleteVerificationDocument'])->name('delete_verification_document');
    });

    /*
    |--------------------------------------------------------------------------
    | Settings (Admin)
    |--------------------------------------------------------------------------
    */
    Route::prefix('settings')->group(function () {
        Route::get('/verification-settings', [SettingsController::class, 'showVerificationSettingsPage'])->name('verification-settings');

        Route::post('/create-verification-document-type', [SettingsController::class, 'createVerificationDocumentType'])->name('create_verification_document_type');
        Route::post('/update-verification-document-type', [SettingsController::class, 'updateVerificationDocumentType'])->name('update_verification_document_type');
        Route::post('/delete-verification-document-type', [SettingsController::class, 'deleteVerificationDocumentType'])->name('delete_verification_document_type');

        Route::get('/get-all-verification-document-types', [SettingsController::class, 'getAllverificationDocumentTypes'])->name('get_all_verification_document_types');
    });

    /*
    |--------------------------------------------------------------------------
    | Client Listings
    |--------------------------------------------------------------------------
    */
    Route::prefix('app/client')->group(function () {
        Route::get('/my-listings', [ClientListingController::class, 'showCreateListingPage'])->name('client_my_listings');
        Route::get('/all-listings', [ClientListingController::class, 'showAllListings'])->name('all_listings');

        Route::get('/create-listing', [ClientListingController::class, 'showCreateListingFormPage'])->name('create_listing_form');
        Route::post('/create-new-listing', [ClientListingController::class, 'createNewListing'])->name('create_new_listing');

        Route::get('/update-listing', [ClientListingController::class, 'showUpdateListingPage'])->name('update_listing_page');
        Route::put('/update-listing', [ClientListingController::class, 'updateListing'])->name('update_client_listing');

        Route::get('/delete-listing', [ClientListingController::class, 'deleteListing'])->name('delete_listing_page');
    });

    /*
    |--------------------------------------------------------------------------
    | Listings (General)
    |--------------------------------------------------------------------------
    */
    Route::prefix('app/listing')->group(function () {
        Route::get('/{id}', [ClientListingController::class, 'showsSingleListingItem'])->name('view_single_listing');
        Route::post('/filter', [ClientListingController::class, 'doFilterClientListingItems'])->name('filter_listings');
    });

    /*
    |--------------------------------------------------------------------------
    | Admin - Listings Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('app/admin')->group(function () {

        Route::get('/manage-client-listings', [ManageClientListingController::class, 'showManageClientListingsPage'])->name('manage_client_listings');
        Route::get('/manage-client-listings/{id}', [ManageClientListingController::class, 'viewClientListingDetails'])->name('view_client_listing');
        Route::post('/manage-client-listings/{id}/delete', [ManageClientListingController::class, 'deleteClientListing'])->name('delete_client_listing');

        Route::post('/update-listing-status', [ManageClientListingController::class, 'updateListingStatus'])->name('update_listing_status');

        Route::get('/document-verification-requests', [ClientVerificationDocumentController::class, 'showDocumentVerificationRequestsPage'])->name('document_verification_requests');
        Route::post('/update-verification-request', [ClientVerificationDocumentController::class, 'updateVerificationRequest'])->name('update_verification_request');

        /*
        |--------------------------------------------------------------------------
        | Category Management
        |--------------------------------------------------------------------------
        */
        Route::get('/category-management', [CategoryController::class, 'showCategorySettingsPage'])->name('category_management');
        Route::post('/category-management/create', [CategoryController::class, 'createNewCategory'])->name('create_new_category');
        Route::get('/app/admin/manage-all-users', [UserManagementController::class, 'showUserManagementPage'])->name('manage_all_users');
        Route::get('/view-user/{id}', [UserManagementController::class, 'viewUserDetails'])->name('view_user_details');
        Route::post('/reset-user-password', [UserManagementController::class, 'resetUserPassword'])->name('reset_user_password');

        Route::get('/messages', [ChatMessageController::class, 'showMessagesPage'])->name('messages');
    });

});

/*
|--------------------------------------------------------------------------
| Payments
|--------------------------------------------------------------------------
*/

Route::prefix('payment')->group(function () {
    Route::get('/success', [StripePaymentController::class, 'success'])->name('stripe.success');
    Route::get('/cancel', [StripePaymentController::class, 'cancel'])->name('stripe.cancel');
});