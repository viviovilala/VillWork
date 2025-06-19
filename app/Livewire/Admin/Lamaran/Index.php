<?php

namespace App\Livewire\Admin\Lamaran;

use App\Models\Lamaran;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

use App\Exports\LamaransExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

#[Layout('layouts.admin')]
#[Title('Kelola Lamaran')]
class Index extends Component
{
    use WithPagination;
    public string $search = '';

    public function delete(Lamaran $lamaran)
    {
        $lamaran->delete();
        session()->flash('success', 'Lamaran berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new LamaransExport, 'daftar-lamaran-' . now()->format('d-m-Y') . '.xlsx');
    }

    public function render()
    {
        $lamarans = Lamaran::with(['user', 'lowongan'])
            ->whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('lowongan', function ($query) {
                $query->where('judul_lowongan', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        $lamaranMasuk = Lamaran::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $labels = $lamaranMasuk->map(fn($item) => Carbon::parse($item->date)->format('d M'));
        $data = $lamaranMasuk->map(fn($item) => $item->count);

        $chartData = [
            'labels' => $labels,
            'data' => $data,
        ];

        return view('livewire.admin.lamaran.index', [
            'lamarans' => $lamarans,
            'chartData' => $chartData
        ]);
    }
}
