<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\StaffController;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/test/mail', function () {
    Mail::raw('MailHog test', fn($m) => $m->to('test@test.com')->subject('Test'));
});

// ------------- public application endpoints --------------------------------------
Route::post('/check-eligibility', [ApplicationController::class, 'checkEligibility'])
    ->name('application.check-eligibility');
Route::post('/apply', [ApplicationController::class, 'store'])
    ->name('application.store');
Route::post('/preview-application', [ApplicationController::class, 'preview'])
    ->name('application.preview');

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

    // routes that require a logged-in admin/staff (session flag checked by admin.auth alias)
    Route::middleware(['auth', 'admin.auth'])->group(function () {
        // Admin only dashboard
        Route::middleware('role:admin')->group(function () {
            Route::get('dashboard', [ApplicationController::class, 'dashboard'])
                ->name('dashboard');
        });

        $applicationRoutes = function () {
            Route::get('applications', [ApplicationController::class, 'adminIndex'])
                ->name('applications.index');
            Route::get('applications/{application}', [ApplicationController::class, 'adminShow'])
                ->name('applications.show');
            Route::patch('applications/{application}/status', [ApplicationController::class, 'updateStatus'])
                ->name('applications.update-status');
        };

        // Admin Only Routes
        Route::middleware('role:admin')->group(function () use ($applicationRoutes) {
            // entry point / dashboard -- render dashboard with stats
            Route::get('dashboard', [ApplicationController::class, 'dashboard'])
                ->name('dashboard');

            // applications resource-like endpoints used by the admin UI
            $applicationRoutes();

            // ── Staff Management (Admin Only) ──────────────────────
            Route::prefix('staff')->name('staff.')->group(function () {
                Route::get('/', [StaffController::class, 'index'])->name('index');
                Route::get('/create', [StaffController::class, 'create'])->name('create');
                Route::post('/', [StaffController::class, 'store'])->name('store');
                Route::patch('/{user}/toggle-status', [StaffController::class, 'toggleStatus'])->name('toggle-status');
                Route::post('/{user}/resend-invite', [StaffController::class, 'resendInvite'])->name('resend-invite');
            });
        });

        // Logout applies to both authenticated dashboard users
        Route::post('logout', [AdminAuthController::class, 'logout'])
            ->name('logout');
    });
});

// Staff (User) Application Routes
Route::middleware(['auth', 'admin.auth', 'role:staff'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('applications', [ApplicationController::class, 'adminIndex'])
            ->name('applications.index');
        Route::get('applications/{application}', [ApplicationController::class, 'adminShow'])
            ->name('applications.show');
        Route::patch('applications/{application}/status', [ApplicationController::class, 'updateStatus'])
            ->name('applications.update-status');
    });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
