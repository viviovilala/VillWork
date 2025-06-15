<?php

use Illuminate\Support\Facades\Route;

// Import controller bawaan Breeze
use App\Http\Controllers\ProfileController;

// Import semua komponen Livewire Admin
use App\Livewire\Admin\Auth\Login as AdminLogin;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Pelatihan\Index as AdminPelatihanIndex;
use App\Livewire\Admin\Pelatihan\Form as AdminPelatihanForm;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| File ini mengatur semua URL untuk aplikasi Anda, memisahkan
| jalur untuk tamu, user biasa, dan admin.
|
*/

// ====================================================================
// RUTE PUBLIK (Bisa diakses semua orang)
// ====================================================================
Route::get('/', function () {
    return view('welcome');
});


// ====================================================================
// RUTE UNTUK USER BIASA
// ====================================================================

// Rute otentikasi Bawaan Laravel Breeze (login, register, dll untuk USER)
// Ini akan meng-handle URL seperti /login, /register, /forgot-password
require __DIR__ . '/auth.php';

// Grup rute ini hanya bisa diakses oleh USER yang sudah login.
// `middleware('auth')` secara default menggunakan guard 'web'.
Route::middleware('auth')->group(function () {
    // Dashboard untuk user biasa
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rute lain untuk user biasa
    Route::get('/lamaran', function () {
        return view('lamaran');
    })->name('lamaran');

    // Rute profil bawaan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ====================================================================
// RUTE UNTUK ADMIN (Sistem Terpisah)
// ====================================================================

// Semua rute di grup ini akan memiliki awalan URL /admin dan nama admin.
Route::prefix('admin')->name('admin.')->group(function () {

    // Rute untuk tamu ADMIN (yang belum login).
    // `guest:admin` memastikan hanya admin yang belum login yang bisa akses halaman ini.
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', AdminLogin::class)->name('login');
    });

    // Rute untuk ADMIN yang sudah login.
    // `auth:admin` memastikan hanya admin yang sudah login yang bisa akses halaman ini.
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('pelatihan', AdminPelatihanIndex::class)->name('pelatihan.index');
        Route::get('pelatihan/create', AdminPelatihanForm::class)->name('pelatihan.create');
        Route::get('pelatihan/{pelatihan}/edit', AdminPelatihanForm::class)->name('pelatihan.edit');

        // Anda juga bisa menambahkan rute logout khusus admin di sini jika perlu.
    });
});
