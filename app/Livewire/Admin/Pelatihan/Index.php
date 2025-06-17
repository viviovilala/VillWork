<?php

// File: app/Livewire/Admin/Pelatihan/Index.php
// Versi ini sudah disesuaikan dengan Blade yang sudah kita perbaiki.

namespace App\Livewire\Admin\Pelatihan;

use App\Models\Pelatihan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

// Pastikan use statement ini ada
use App\Exports\PelatihanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

#[Layout('layouts.admin')]
#[Title('Kelola Pelatihan')]
class Index extends Component
{
    use WithPagination;
    public string $search = '';

    // 1. Nama method diganti menjadi 'exportExcel' agar konsisten dengan tombol di Blade
    public function exportExcel()
    {
        // Pastikan Anda sudah membuat file App\Exports\PelatihanExport
        return Excel::download(new PelatihanExport, 'laporan-pelatihan-' . now()->format('d-m-Y') . '.xlsx');
    }

    public function render()
    {
        // Query untuk tabel data (sudah benar)
        $pelatihans = Pelatihan::where('nama_pelatihan', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        // 2. Query untuk chart diperbaiki agar hanya mengambil data 7 hari terakhir
        $pelatihanPosts = Pelatihan::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Logika untuk memformat data chart (sudah benar)
        $labels = $pelatihanPosts->map(fn($item) => Carbon::parse($item->date)->format('d M'));
        $data = $pelatihanPosts->map(fn($item) => $item->count);

        // 3. Nama variabel diubah menjadi 'chartData' agar cocok dengan script di Blade
        $chartData = [
            'labels' => $labels,
            'data' => $data,
        ];

        // 4. Kirim variabel dengan nama yang sudah disesuaikan
        return view('livewire.admin.pelatihan.index', [
            'pelatihans' => $pelatihans,
            'chartData' => $chartData,
        ]);
    }
}