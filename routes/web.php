<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PlanController;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {

    // Dashboard - Gym Members
    Route::get('/dashboard', [MemberController::class, 'index'])->name('dashboard');

    // Gym System - Members
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::post('/members', [MemberController::class, 'store'])->name('members.store');
    Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
    Route::get('/members/trash', [MemberController::class, 'trash'])->name('members.trash');
    Route::post('/members/{id}/restore', [MemberController::class, 'restore'])->name('members.restore');
    Route::delete('/members/{id}/force-delete', [MemberController::class, 'forceDelete'])->name('members.force-delete');
    Route::get('/members/export/pdf', [MemberController::class, 'exportPdf'])->name('members.export');

    // Gym System - Plans
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
    Route::put('/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
    Route::delete('/plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');

    // Redirect /settings to the profile page
    Route::redirect('settings', 'settings/profile');

    // Volt routes for settings
    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    // Two-factor authentication route (only if enabled in Fortify)
    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],  // Empty array means no additional middleware when it's disabled
            ),
        )
        ->name('two-factor.show');
});

// Include Laravel Fortify authentication routes
require __DIR__.'/auth.php';