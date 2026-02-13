<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('home');
});

Route::get('/event-launching', function () {
    return view('event-launching');
});

Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index']);

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// OTP Verification Routes (requires auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/otp/verify', [OtpController::class, 'showOtpForm'])->name('otp.show');
    Route::post('/otp/verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/otp/resend', [OtpController::class, 'resendOtp'])->name('otp.resend');
});

// Admin Routes (requires auth + OTP verified)
Route::middleware(['auth', 'otp.verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Category CRUD
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    
    // Product CRUD
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    
    // Article CRUD
    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
});
