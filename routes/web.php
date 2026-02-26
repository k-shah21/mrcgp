<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\AdminAuthController;

// ------------- public application endpoints --------------------------------------
Route::post('/check-eligibility', [ApplicationController::class, 'checkEligibility'])
    ->name('application.check-eligibility');
Route::post('/apply', [ApplicationController::class, 'store'])
    ->name('application.store');

// ------------- admin auth & pages ------------------------------------------------
// Admin login/logout handled by a bespoke controller; protects the dashboard
Route::prefix('admin')->name('admin.')->group(function () {
    // public-facing auth pages
    Route::middleware('guest')->group(function () {
        Route::get('auth/login', [AdminAuthController::class, 'showLogin'])
            ->name('login');
        Route::post('auth/login', [AdminAuthController::class, 'login'])
            ->name('login.submit');
    });

    // routes that require a logged-in admin (session flag checked by admin.auth alias)
    Route::middleware(['auth', 'admin.auth'])->group(function () {
        // entry point / dashboard -- render same index view via controller
        Route::get('dashboard', [ApplicationController::class, 'adminIndex'])
            ->name('dashboard');

        // applications resource-like endpoints used by the admin UI
        Route::get('applications', [ApplicationController::class, 'adminIndex'])
            ->name('applications.index');
        Route::get('applications/{application}', [ApplicationController::class, 'adminShow'])
            ->name('applications.show');
        Route::patch('applications/{application}/status', [ApplicationController::class, 'updateStatus'])
            ->name('applications.update-status');

        Route::post('logout', [AdminAuthController::class, 'logout'])
            ->name('logout');
    });
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
