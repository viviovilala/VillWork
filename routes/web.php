<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // <-- Tambahkan import ini
use Illuminate\Support\Facades\Auth; // <-- Tambahkan import ini

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
*/

// RUTE PUBLIK
Route::get('/', function () {
    return view('welcome');
})->name('home'); // Beri nama rute ini 'home'

// RUTE OTENTIKASI USER BIASA (DARI BREEZE)
// Logout untuk user biasa sudah otomatis mengarah ke '/'
require __DIR__ . '/auth.php';

// RUTE UNTUK USER YANG SUDAH LOGIN
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ====================================================================
// RUTE UNTUK ADMIN (Sistem Terpisah)
// ====================================================================
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('login', AdminLogin::class)->name('login');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::any('dashboard', AdminDashboard::class)->name('dashboard');
        Route::any('pelatihan', AdminPelatihanIndex::class)->name('pelatihan.index');
        Route::any('pelatihan/create', AdminPelatihanForm::class)->name('pelatihan.create');
        Route::any('pelatihan/{pelatihan}/edit', AdminPelatihanForm::class)->name('pelatihan.edit');

        // RUTE BARU UNTUK LOGOUT ADMIN
        Route::post('logout', function (Request $request) {
            Auth::guard('admin')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect ke halaman utama
            return redirect('/');
        })->name('logout');
    });
});
