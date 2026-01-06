<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $paketKg = \App\Models\Paket::where('satuan', 'kg')->get();
    $paketPcs = \App\Models\Paket::where('satuan', 'pcs')->get();
    $testimonials = \App\Models\Testimonial::where('is_approved', true)->latest()->take(6)->get();

    return view('welcome', compact('paketKg', 'paketPcs', 'testimonials'));
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Customer Routes
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'customerDashboard'])->name('dashboard');
});

// Testimonial Routes (for customers)
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::post('/testimonial', [App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonial.store');
});

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Settings route for admin
    Route::post('/settings', [ProfileController::class, 'updateSettings'])->name('settings.update');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'adminDashboard'])->name('dashboard');
});

// Karyawan Routes
Route::middleware(['auth', 'role:karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'karyawanDashboard'])->name('dashboard');
    Route::get('/absensi', [App\Http\Controllers\AbsensiController::class, 'karyawanIndex'])->name('absensi');
    Route::get('/absensi/data', [App\Http\Controllers\AbsensiController::class, 'getAttendanceData'])->name('absensi.data');
    Route::post('/absensi', [App\Http\Controllers\AbsensiController::class, 'store'])->name('absensi.store');
});

// Absensi Modal Routes (for karyawan only)
Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/absensi/check', [App\Http\Controllers\AbsensiController::class, 'check'])->name('absensi.check');
    Route::post('/absensi/store', [App\Http\Controllers\AbsensiController::class, 'storeAbsensi'])->name('absensi.storeModal');
});

Route::prefix('ajax')->middleware('auth')->group(function () {
    Route::get('/pakets', [App\Http\Controllers\Api\OrderApiController::class, 'getPakets']);
    Route::post('/calculate-distance', [App\Http\Controllers\Api\OrderApiController::class, 'calculateDistance']);
});

// Payment Confirmation Route (public - untuk QR scan)
Route::get('/payment/confirm/{order}/{token}', [App\Http\Controllers\PaymentController::class, 'confirm'])->name('payment.confirm');

// Shared Routes (accessible by both admin and karyawan)
Route::middleware(['auth'])->group(function () {
    Route::resource('order', App\Http\Controllers\OrderController::class);
    Route::patch('/order/{order}/status', [App\Http\Controllers\OrderController::class, 'updateStatus'])->name('order.update.status');
    Route::resource('paket', App\Http\Controllers\PaketController::class);
    Route::resource('customer', App\Http\Controllers\CustomerController::class);
    Route::resource('karyawan', App\Http\Controllers\KaryawanController::class);
    Route::post('jam-kerja/{jam_kerja}/toggle', [App\Http\Controllers\JamKerjaController::class, 'toggle'])->name('jam-kerja.toggle');
    Route::resource('jam-kerja', App\Http\Controllers\JamKerjaController::class);
    Route::resource('absensi', App\Http\Controllers\AbsensiController::class);
    Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');
});

require __DIR__ . '/auth.php';
