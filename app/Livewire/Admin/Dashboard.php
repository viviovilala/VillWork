<?php

// File: app/Livewire/Admin/Dashboard.php
// Logika diperbarui untuk menangani ekspor dan menyiapkan data chart.

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Lowongan;
use App\Models\Pelatihan;
use App\Models\Lamaran;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Exports\UsersExport; // <-- Import kelas Export
use Maatwebsite\Excel\Facades\Excel; // <-- Import Fassad Excel
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

#[Layout('layouts.admin')]
#[Title('Admin Dashboard')]
class Dashboard extends Component
{
    /**
     * Method ini akan dipanggil saat tombol "Download Laporan" diklik.
     */
    public function exportUsers()
    {
        // Memberi nama file yang akan diunduh
        return Excel::download(new UsersExport, 'laporan-pengguna.xlsx');
    }

    /**
     * Method untuk menyiapkan data Chart.js.
     */
    private function getChartData()
    {
        $users = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = $users->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('d M');
        });

        $data = $users->pluck('count');

        // Mengirim data ke browser melalui event
        $this->dispatch('updateUserChart', data: ['labels' => $labels, 'data' => $data]);
    }

    /**
     * Render komponen.
     */
    public function render()
    {
        // Panggil method untuk menyiapkan dan mengirim data chart
        $this->getChartData();

        $latestUsers = User::latest()->take(5)->get();
        $latestLowongan = Lowongan::with('user')->latest()->take(5)->get();
        $latestPelatihan = Pelatihan::latest()->take(5)->get();
        $latestLamaran = Lamaran::with(['user', 'lowongan'])->latest()->take(5)->get();

        return view('livewire.admin.dashboard', [
            'users' => $latestUsers,
            'lowongans' => $latestLowongan,
            'pelatihans' => $latestPelatihan,
            'lamarans' => $latestLamaran,
        ]);
    }
}
