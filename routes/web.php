<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JamKerjaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Models\Paket;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $paketKg = Paket::where('satuan', 'kg')->get();
    $paketPcs = Paket::where('satuan', 'pcs')->get();
    $testimonials = Testimonial::where('is_approved', true)->latest()->take(6)->get();

    return view('welcome', compact('paketKg', 'paketPcs', 'testimonials'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'customerDashboard'])->name('dashboard');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::post('/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
});

Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/settings', [ProfileController::class, 'updateSettings'])->name('settings.update');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
});

Route::middleware(['auth', 'role:karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'karyawanDashboard'])->name('dashboard');
    Route::get('/absensi', [AbsensiController::class, 'karyawanIndex'])->name('absensi');
    Route::get('/absensi/data', [AbsensiController::class, 'getAttendanceData'])->name('absensi.data');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
});

Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/absensi/check', [AbsensiController::class, 'check'])->name('absensi.check');
    Route::post('/absensi/store', [AbsensiController::class, 'storeAbsensi'])->name('absensi.storeModal');
});

Route::prefix('ajax')->middleware('auth')->group(function () {
    Route::get('/pakets', [OrderApiController::class, 'getPakets']);
    Route::post('/calculate-distance', [OrderApiController::class, 'calculateDistance']);
});

Route::get('/payment/confirm/{order}/{token}', [PaymentController::class, 'confirm'])->name('payment.confirm');

Route::middleware(['auth'])->group(function () {
    Route::resource('order', OrderController::class);
    Route::patch('/order/{order}/status', [OrderController::class, 'updateStatus'])->name('order.update.status');
    Route::resource('paket', PaketController::class);

    Route::prefix('user')->name('user.')->group(function () {
        // Customer routes
        Route::get('/customer', [UserController::class, 'indexCustomer'])->name('customer.index');
        Route::post('/customer', [UserController::class, 'storeCustomer'])->name('customer.store');
        Route::delete('/customer/{id}', [UserController::class, 'destroyCustomer'])->name('customer.destroy');

        // Karyawan routes
        Route::get('/karyawan', [UserController::class, 'indexKaryawan'])->name('karyawan.index');
        Route::post('/karyawan', [UserController::class, 'storeKaryawan'])->name('karyawan.store');
        Route::delete('/karyawan/{id}', [UserController::class, 'destroyKaryawan'])->name('karyawan.destroy');
    });

    Route::post('jam-kerja/{jam_kerja}/toggle', [JamKerjaController::class, 'toggle'])->name('jam-kerja.toggle');
    Route::resource('jam-kerja', JamKerjaController::class);
    Route::resource('absensi', AbsensiController::class);
    Route::get('/search', [SearchController::class, 'search'])->name('search');
});

require __DIR__ . '/auth.php';

Route::get('/403', function () {
    return view('errors.403'); });
Route::get('/404', function () {
    return view('errors.404'); });
Route::get('/419', function () {
    return view('errors.419'); });
Route::get('/500', function () {
    return view('errors.500'); });
Route::get('/503', function () {
    return view('errors.503'); });
