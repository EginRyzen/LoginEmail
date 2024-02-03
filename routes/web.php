<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    return view('welcome');
});

Route::resource('register', AuthController::class);
Route::get('login', function () {
    return 'Tempat Login Ini';
})->name('login');

//Email Verifikasi
Route::get('/email/verify', function () {
    return view('auth.verify-email');
    //Arah Redirect Bisa Di cek di middleware authenticate
})->middleware('auth')->name('verification.notice');


//Email Verifikasi Proses
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('profile', function () {
    return 'Tempat Profile Anda';
})->middleware(['auth', 'verified']);;
