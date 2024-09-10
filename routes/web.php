<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\GuestController::class, 'welcome']);
Route::get('/get-municipalities', [App\Http\Controllers\Auth\RegisterController::class, 'getMunicipalities']);
Route::get('/get-barangays', [App\Http\Controllers\GuestController::class, 'getBarangays']);

Auth::routes(['verify' => true]);

Route::get('/secure-js-file/{filename}', [App\Http\Controllers\SecureController::class, 'serveJsFile'])->name('secure.js');
Route::post('/verify/code',  [App\Http\Controllers\Auth\VerificationController::class, 'otp_verify']);

Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/pet-details/{name}/{id}', [App\Http\Controllers\HomeController::class, 'pet_details'])->name('pet.details');

Route::middleware(['prevent-back-history', 'auth', 'verified'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //General Setting
    Route::get('/generalsettings', [App\Http\Controllers\GeneralSettingsController::class, 'index'])->name('generalsettings');
    Route::post('/generalsettings-company', [App\Http\Controllers\GeneralSettingsController::class, 'company']);
    Route::post('/generalsettings-profile', [App\Http\Controllers\GeneralSettingsController::class, 'profile']);
    Route::post('/generalsettings-account', [App\Http\Controllers\GeneralSettingsController::class, 'account']);
    Route::post('/generalsettings-password', [App\Http\Controllers\GeneralSettingsController::class, 'password']);
    
    Route::resource('message', App\Http\Controllers\MessagesController::class);
    Route::resource('lgu', App\Http\Controllers\UserMngtLGUController::class);
    Route::resource('ngo', App\Http\Controllers\UserMngtNGOController::class);
    Route::resource('resident', App\Http\Controllers\UserMngtResidentController::class);
    Route::resource('service', App\Http\Controllers\ServiceController::class);
    Route::resource('subscription', App\Http\Controllers\SubscriptionController::class);
    Route::resource('postreport', App\Http\Controllers\PostReportController::class);
 
});


