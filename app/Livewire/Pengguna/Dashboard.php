<?php

// File: app/Livewire/Admin/Dashboard.php
// Logika diubah untuk mengambil 5 data terbaru dari setiap model.

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Lowongan;
use App\Models\Pelatihan;
use App\Models\Lamaran;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Admin Dashboard')]
class Dashboard extends Component
{
    /**
     * Render komponen.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Ambil 5 data terbaru dari setiap model untuk ditampilkan di dashboard.
        // `with()` digunakan untuk memuat relasi dan mencegah N+1 query.
        $latestUsers = User::latest()->take(5)->get();
        $latestLowongan = Lowongan::with('user')->latest()->take(5)->get();
        $latestPelatihan = Pelatihan::latest()->take(5)->get();
        $latestLamaran = Lamaran::with(['user', 'lowongan'])->latest()->take(5)->get();

        // Kirim semua data tersebut ke view.
        return view('livewire.admin.dashboard', [
            'users' => $latestUsers,
            'lowongans' => $latestLowongan,
            'pelatihans' => $latestPelatihan,
            'lamarans' => $latestLamaran,
        ]);
    }
}
