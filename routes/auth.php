<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('loginchoice', function () {
        return view('auth.loginchoice');
    })->name('login.choice');

    Route::get('login/admin', [AuthenticatedSessionController::class, 'create'])->defaults('role', 'admin')->name('login.admin');
    Route::get('login/customer', [AuthenticatedSessionController::class, 'create'])->defaults('role', 'customer')->name('login.customer');
    Route::get('login/karyawan', [AuthenticatedSessionController::class, 'create'])->defaults('role', 'karyawan')->name('login.karyawan');

    // Keep generic login for fallback or direct access if needed, redirect to choice
    Route::get('login', function () {
        return redirect()->route('login.choice');
    })->name('login');

    Route::post('login/{role?}', [AuthenticatedSessionController::class, 'store']);

    //     Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
//         ->name('password.request');
//
//     Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
//         ->name('password.email');
//
//     Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
//         ->name('password.reset');
//
//     Route::post('reset-password', [NewPasswordController::class, 'store'])
//         ->name('password.store');
});

Route::middleware('auth')->group(function () {
    //    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
//        ->name('password.confirm');
//
//    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
