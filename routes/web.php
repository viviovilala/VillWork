<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- CONTROLLER & COMPONENT ---
use App\Http\Controllers\ProfileController;

// User
use App\Livewire\Pengguna\Dashboard as UserDashboard;
use App\Livewire\Pengguna\Pelatihan\Index as UserPelatihan; // Alias untuk dashboard pengguna
use App\Livewire\Pengguna\Pelatihan\History as UserPelatihanHistory;
// Admin
use App\Livewire\Admin\Auth\Login as AdminLogin;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Pelatihan\Index as AdminPelatihanIndex;
use App\Livewire\Admin\Pelatihan\Form as AdminPelatihanForm;
use App\Livewire\Admin\User\Index as AdminUserIndex;
use App\Livewire\Admin\Lowongan\Index as AdminLowonganIndex;
use App\Livewire\Admin\Lamaran\Index as AdminLamaranIndex;
use App\Livewire\Admin\PesertaPelatihan\Index as AdminPesertaPelatihanIndex;
// --- ROUTE ---

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route untuk Pengguna yang sudah login
Route::middleware('auth')->group(function () {
    // [DIPERBAIKI] Route ini sekarang menunjuk ke komponen Livewire Dashboard Pengguna
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');
    Route::get('/pelatihan', UserPelatihan::class)->name('pelatihan.index');  
    Route::get('/pelatihan/history', UserPelatihanHistory::class)->name('pelatihan.history');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk Admin
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('login', AdminLogin::class)->name('login');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', AdminDashboard::class)->name('dashboard'); // Route dashboard admin tetap
        Route::get('pelatihan', AdminPelatihanIndex::class)->name('pelatihan.index');
        Route::any('pelatihan/create', AdminPelatihanForm::class)->name('pelatihan.create');
        Route::any('pelatihan/{pelatihan}/edit', AdminPelatihanForm::class)->name('pelatihan.edit');
        Route::get('users', AdminUserIndex::class)->name('user.index');
        Route::get('lowongan', AdminLowonganIndex::class)->name('lowongan.index');
        Route::get('lamaran', AdminLamaranIndex::class)->name('lamaran.index');
        Route::get('peserta-pelatihan', AdminPesertaPelatihanIndex::class)->name('peserta-pelatihan.index');

        Route::post('logout', function (Request $request) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        })->name('logout');
    });
});

// Route otentikasi Breeze
require __DIR__ . '/auth.php';
