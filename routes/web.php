<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- CONTROLLERS ---
use App\Http\Controllers\ProfileController;

// --- LIVEWIRE COMPONENTS ---

// Livewire Admin Components
use App\Livewire\Admin\Auth\Login as AdminLogin;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Pelatihan\Index as AdminPelatihanIndex;
use App\Livewire\Admin\Pelatihan\Form as AdminPelatihanForm;
use App\Livewire\Admin\PesertaPelatihan\Index as AdminPesertaPelatihanIndex;
use App\Livewire\Admin\User\Index as AdminUserIndex;
use App\Livewire\Admin\Lowongan\Index as AdminLowonganIndex; // Admin Lowongan Index
use App\Livewire\Admin\Lamaran\Index as AdminLamaranIndex;

// Livewire Pengguna (User) Components
use App\Livewire\Pengguna\Dashboard as PenggunaDashboard;
use App\Livewire\Pengguna\Pelatihan\Index as PenggunaPelatihanIndex;
use App\Livewire\Pengguna\Pelatihan\History as PenggunaPelatihanHistory;
use App\Livewire\Pengguna\Lowongan\History as PenggunaLowonganHistory;
// *** PERHATIAN DI SINI UNTUK ALIAS INDEX LOWONGAN ***
// Untuk daftar semua lowongan (untuk pelamar)
use App\Livewire\Pengguna\Lowongan\Index as PenggunaLowonganIndexSemua;
// Untuk daftar lowongan yang diposting user (MyPosts baru)
use App\Livewire\Pengguna\Lowongan\Index as PenggunaLowonganIndexPosts; // <<< Menggunakan alias ini untuk komponen Index yang baru direvisi

use App\Livewire\Pengguna\Lowongan\Create as PenggunaLowonganCreateEditForm; // Komponen Create/Edit Lowongan

use App\Livewire\Pengguna\Lamaran\Index as PenggunaLamaranIndex; // Riwayat Lamaran (Index)
use App\Livewire\Pengguna\Lamaran\Create as PenggunaLamaranCreateForm; // Form Daftar Lamaran (Create)
use App\Livewire\Pengguna\Lamaran\History as PenggunaLamaranHistory; // Riwayat Lamaran (History)

// --- EXPORTS ---
use App\Exports\LamaransExport;
use Maatwebsite\Excel\Facades\Excel;


// Halaman utama (Landing Page)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rute Otentikasi Laravel Breeze
require __DIR__ . '/auth.php';

// Rute untuk Pengguna yang sudah login (Authenticated & Verified Users)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', PenggunaDashboard::class)->name('dashboard');

    // Pengelolaan Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/pelatihan', PenggunaPelatihanIndex::class)->name('pelatihan.index');
    Route::get('/pelatihan/history', PenggunaPelatihanHistory::class)->name('pelatihan.history');
    Route::get('/lowongan/history', PenggunaLowonganHistory::class)->name('lowongan.history');
    Route::get('/lamaran/history', PenggunaLamaranHistory::class)->name('lamaran.history');
    // Grup Rute untuk Fitur Pengguna
    Route::get('/lowongan', PenggunaLowonganIndexSemua::class)->name('lowongan.index'); // Menampilkan SEMUA lowongan untuk dilamar

    // Rute Fitur Lamaran (Untuk Pelamar)
    Route::get('/lamaran/create/{lowongan}', PenggunaLamaranCreateForm::class)->name('lamaran.create'); // Form Daftar Lamaran
    Route::get('/lamaran', PenggunaLamaranIndex::class)->name('lamaran.index'); // Riwayat Lamaran

    // Rute Lowongan Pekerjaan (Untuk Pemposting - Semua User)
    // Tidak ada middleware 'role' di sini karena semua user bisa memposting
    // Menggunakan "my-posts" sebagai awalan URL untuk membedakan dari "lowongan" umum
    Route::get('/lowongan/my-posts', PenggunaLowonganIndexPosts::class)->name('lowongan.my-posts'); // Riwayat lowongan yang diposting user
    Route::get('/lowongan/create', PenggunaLowonganCreateEditForm::class)->name('lowongan.create'); // Form buat lowongan baru
    Route::get('/lowongan/{lowongan}/edit', PenggunaLowonganCreateEditForm::class)->name('lowongan.edit');
    Route::prefix('pengguna')->name('pengguna.')->group(function () {
        // Rute Pelatihan
        

        // Rute Lowongan Pekerjaan (Untuk Pelamar - Melihat SEMUA Lowongan)
        // Form edit lowongan
    });
});

// Rute Admin (Authenticated with 'admin' guard)
Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Login (for guests trying to access admin area)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', AdminLogin::class)->name('login');
    });

    // Rute yang hanya bisa diakses oleh admin yang sudah login
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', AdminDashboard::class)->name('dashboard');

        // Pengelolaan Pelatihan Admin
        Route::get('pelatihan', AdminPelatihanIndex::class)->name('pelatihan.index');
        Route::get('pelatihan/create', AdminPelatihanForm::class)->name('pelatihan.create');
        Route::get('pelatihan/{pelatihan}/edit', AdminPelatihanForm::class)->name('pelatihan.edit');

        // Pengelolaan Pengguna
        Route::get('users', AdminUserIndex::class)->name('user.index');
        Route::get('peserta-pelatihan', AdminPesertaPelatihanIndex::class)->name('peserta-pelatihan.index');

        // Pengelolaan Lowongan Pekerjaan (oleh Admin)
        Route::get('lowongan', AdminLowonganIndex::class)->name('lowongan.index'); // Admin melihat semua lowongan
        Route::get('lamaran', AdminLamaranIndex::class)->name('lamaran.index'); // Admin melihat semua lamaran

        // Export Data Lamaran
        Route::get('/lamaran/export', function () {
            return Excel::download(new LamaransExport, 'data_lamaran.xlsx');
        })->name('lamaran.export');

        // Admin Logout
        Route::post('logout', function (Request $request) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        })->name('logout');
    });
});

// Route otentikasi Laravel Breeze
require __DIR__ . '/auth.php';
