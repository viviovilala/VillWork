<?php

// File: app/Livewire/Admin/Pelatihan/Index.php
// Pastikan file PHP Anda sudah sama seperti ini.

namespace App\Livewire\Admin\Pelatihan;

use App\Models\Pelatihan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
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

    public function export()
    {
        return Excel::download(new PelatihanExport, 'laporan-pelatihan.xlsx');
    }

    public function render()
    {
        // 1. Ambil data untuk tabel (dengan pagination)
        $pelatihansForTable = Pelatihan::where('nama_pelatihan', 'like', '%' . $this->search . '%')
            ->latest()->paginate(10);

        // 2. Siapkan data untuk grafik (semua data, tanpa pagination)
        $pelatihansForChart = Pelatihan::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // 3. Kemas data chart ke dalam sebuah array
        $initialChartData = [
            'labels' => $pelatihansForChart->pluck('date')->map(fn($date) => Carbon::parse($date)->format('d M Y')),
            'data' => $pelatihansForChart->pluck('count')
        ];

        // 4. Kirim kedua set data ke view
        return view('livewire.admin.pelatihan.index', [
            'pelatihans' => $pelatihansForTable,
            'initialChartData' => $initialChartData,
        ]);
    }
}
