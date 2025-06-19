<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Auth\Login as AdminLogin;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Pelatihan\Index as AdminPelatihanIndex;
use App\Livewire\Admin\Pelatihan\Form as AdminPelatihanForm;
use App\Livewire\Admin\PesertaPelatihan\Index as AdminPesertaPelatihanIndex;
use App\Livewire\Admin\User\Index as AdminUserIndex;
use App\Livewire\Admin\Lowongan\Index as AdminLowonganIndex;
use App\Livewire\Admin\Lamaran\Index as AdminLamaranIndex;
use App\Livewire\Pengguna\Dashboard as PenggunaDashboard;
use App\Livewire\Pengguna\Pelatihan\Index as PenggunaPelatihanIndex;
use App\Livewire\Pengguna\Pelatihan\History as PenggunaPelatihanHistory;
use App\Livewire\Pengguna\Lowongan\History as PenggunaLowonganHistory;
use App\Livewire\Pengguna\Lowongan\Index as PenggunaLowonganIndexSemua;
use App\Livewire\Pengguna\Lowongan\Index as PenggunaLowonganIndexPosts;

use App\Livewire\Pengguna\Lowongan\Create as PenggunaLowonganCreateEditForm;
use App\Livewire\Pengguna\Lamaran\Index as PenggunaLamaranIndex;
use App\Livewire\Pengguna\Lamaran\Create as PenggunaLamaranCreateForm;
use App\Livewire\Pengguna\Lamaran\History as PenggunaLamaranHistory;
use App\Exports\LamaransExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
})->name('home');
require __DIR__ . '/auth.php';
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', PenggunaDashboard::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/pelatihan', PenggunaPelatihanIndex::class)->name('pelatihan.index');
    Route::get('/pelatihan/history', PenggunaPelatihanHistory::class)->name('pelatihan.history');
    Route::get('/lowongan/history', PenggunaLowonganHistory::class)->name('lowongan.history');
    Route::get('/lamaran/history', PenggunaLamaranHistory::class)->name('lamaran.history');
    Route::get('/lowongan', PenggunaLowonganIndexSemua::class)->name('lowongan.index');
    Route::get('/lamaran/create/{lowongan}', PenggunaLamaranCreateForm::class)->name('lamaran.create');
    Route::get('/lamaran', PenggunaLamaranIndex::class)->name('lamaran.index');
    Route::get('/lowongan/my-posts', PenggunaLowonganIndexPosts::class)->name('lowongan.my-posts');
    Route::get('/lowongan/create', PenggunaLowonganCreateEditForm::class)->name('lowongan.create');
    Route::get('/lowongan/{lowongan}/edit', PenggunaLowonganCreateEditForm::class)->name('lowongan.edit');
    Route::prefix('pengguna')->name('pengguna.')->group(function () {});
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', AdminLogin::class)->name('login');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('pelatihan', AdminPelatihanIndex::class)->name('pelatihan.index');
        Route::get('pelatihan/create', AdminPelatihanForm::class)->name('pelatihan.create');
        Route::get('pelatihan/{pelatihan}/edit', AdminPelatihanForm::class)->name('pelatihan.edit');
        Route::get('users', AdminUserIndex::class)->name('user.index');
        Route::get('peserta-pelatihan', AdminPesertaPelatihanIndex::class)->name('peserta-pelatihan.index');
        Route::get('lowongan', AdminLowonganIndex::class)->name('lowongan.index'); 
        Route::get('lamaran', AdminLamaranIndex::class)->name('lamaran.index'); 
        Route::get('/lamaran/export', function () {
            return Excel::download(new LamaransExport, 'data_lamaran.xlsx');
        })->name('lamaran.export');
        Route::post('logout', function (Request $request) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        })->name('logout');
    });
});
require __DIR__ . '/auth.php';
