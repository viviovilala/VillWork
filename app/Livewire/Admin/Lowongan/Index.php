<?php

namespace App\Livewire\Admin\Lowongan;

use App\Models\Lowongan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

// Tambahkan use statement yang diperlukan
use App\Exports\LowongansExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

#[Layout('layouts.admin')]
#[Title('Kelola Lowongan')]
class Index extends Component
{
    use WithPagination;
    public string $search = '';

    // Method baru untuk trigger download Excel
    public function exportExcel()
    {
        return Excel::download(new LowongansExport, 'daftar-lowongan-' . now()->format('d-m-Y') . '.xlsx');
    }

    public function render()
    {
        // Model diubah menjadi Lowongan dan kolom pencarian disesuaikan
        $lowongans = Lowongan::where('judul_lowongan', 'like', '%' . $this->search . '%')
            ->orWhere('deskripsi', 'like', '%' . $this->search . '%') // Kolom disesuaikan
            ->orWhere('lokasi', 'like', '%' . $this->search . '%')    // Kolom disesuaikan
            ->latest()
            ->paginate(10);

        // --- Logika untuk Data Chart ---
        // Menghitung jumlah lowongan yang dibuat dalam 7 hari terakhir
        // Model diubah menjadi Lowongan
        $lowonganPosts = Lowongan::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Memformat data untuk Chart.js
        // Logika ini tetap sama, hanya variabel inputnya yang berubah
        $labels = $lowonganPosts->map(function ($item) {
            return Carbon::parse($item->date)->format('d M');
        });

        $data = $lowonganPosts->map(function ($item) {
            return $item->count;
        });

        $chartData = [
            'labels' => $labels,
            'data' => $data,
        ];
        // --- Akhir Logika Chart ---

        // Mengirim variabel yang benar ke view yang benar
        return view('livewire.admin.lowongan.index', [
            'lowongans' => $lowongans, // Variabel disesuaikan
            'chartData' => $chartData,
        ]);
    }
}
