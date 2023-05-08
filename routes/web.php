<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('auth.login');
    Route::post('/login', 'login')->name('login');
    Route::delete('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('auth.register');
    Route::post('/register', 'register')->name('register');
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/password/forgot', 'showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'sendResetLinkEmail')->name('password.email');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('/password/reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('/password/reset', 'reset')->name('password.update');
});

Route::controller(SocialController::class)->group(function () {
    Route::get('/auth/socialite/{provider}', 'redirectToProvider')
        ->name('auth.social');

    Route::get('/auth/socialite/{provider}/callback', 'handleProviderCallback')
        ->name('auth.social.callback');
});





