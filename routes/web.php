<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Route::get('/sertificate', [\App\Http\Controllers\PencapaianController::class, 'sertificate'])->name('sertificate');
Route::get('/penghargaan', [\App\Http\Controllers\PencapaianController::class, 'penghargaan'])->name('penghargaan');
Route::get('/event', [\App\Http\Controllers\PencapaianController::class, 'event'])->name('event');

Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index']);

// Authentication Routes
Route::get('/debug-settings', function () {
    return response()->json(\Illuminate\Support\Facades\View::getShared()['site_settings'] ?? 'Not Set');
});
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

// Beranda / Homepage
Route::resource('banners', \App\Http\Controllers\Admin\BannerController::class);
Route::resource('home-abouts', \App\Http\Controllers\Admin\HomeAboutController::class);
Route::resource('home-videos', \App\Http\Controllers\Admin\HomeVideoController::class);
Route::resource('home-philosophies', \App\Http\Controllers\Admin\HomePhilosophyController::class);
Route::get('home-about-images/edit', [\App\Http\Controllers\Admin\HomeAboutImageController::class, 'edit'])->name('home-about-images.edit');
Route::put('home-about-images/update', [\App\Http\Controllers\Admin\HomeAboutImageController::class, 'update'])->name('home-about-images.update');

// Produk
Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
Route::resource('brands', \App\Http\Controllers\Admin\BrandController::class);

// Acara & Event
Route::resource('events', \App\Http\Controllers\Admin\EventController::class);

// Static Pages (Item-based CRUD)
Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);
Route::resource('about-sections', \App\Http\Controllers\Admin\AboutSectionController::class);
Route::resource('contact-items', \App\Http\Controllers\Admin\ContactItemController::class);
Route::resource('policy-sections', \App\Http\Controllers\Admin\PolicySectionController::class);

// Super Admin Only Routes
Route::middleware(['superadmin'])->group(function () {
    // Settings
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class)->except(['show']);

    // Users & Roles
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);

    // Logs
    Route::get('logs/activity', [\App\Http\Controllers\Admin\LogController::class, 'activity'])->name('logs.activity');
    Route::get('logs/login', [\App\Http\Controllers\Admin\LogController::class, 'login'])->name('logs.login');
});

// Admin accessible routes (already under auth & otp.verified)
Route::get('security/password', [\App\Http\Controllers\Admin\PasswordController::class, 'index'])->name('security.password');
Route::put('security/password', [\App\Http\Controllers\Admin\PasswordController::class, 'update'])->name('security.password.update');

// Existing Articles (Maybe keep or move?)
Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
});

