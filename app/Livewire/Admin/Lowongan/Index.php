<?php

namespace App\Livewire\Admin\Lowongan;

use App\Models\Lowongan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
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

    public function exportExcel()
    {
        return Excel::download(new LowongansExport, 'daftar-lowongan-' . now()->format('d-m-Y') . '.xlsx');
    }

    public function render()
    {
        $lowongans = Lowongan::where('judul_lowongan', 'like', '%' . $this->search . '%')
            ->orWhere('deskripsi', 'like', '%' . $this->search . '%') // Kolom disesuaikan
            ->orWhere('lokasi', 'like', '%' . $this->search . '%')    // Kolom disesuaikan
            ->latest()
            ->paginate(10);
        $lowonganPosts = Lowongan::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

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
        return view('livewire.admin.lowongan.index', [
            'lowongans' => $lowongans,
            'chartData' => $chartData,
        ]);
    }
}
