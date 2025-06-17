<?php

namespace App\Livewire\Admin\PesertaPelatihan;

use App\Models\PesertaPelatihan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Exports\PesertaPelatihanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

#[Layout('layouts.admin')]
#[Title('Kelola Peserta Pelatihan')]
class Index extends Component
{
    use WithPagination;
    public string $search = '';

    public function delete(PesertaPelatihan $peserta)
    {
        $peserta->delete();
        session()->flash('success', 'Data peserta berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new PesertaPelatihanExport, 'daftar-peserta-pelatihan-' . now()->format('d-m-Y') . '.xlsx');
    }

    public function render()
    {
        $pesertaPelatihans = PesertaPelatihan::with(['user', 'pelatihan'])
            ->whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('pelatihan', function ($query) {
                $query->where('nama_pelatihan', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        // --- Logika Chart ---
        $pendaftaran = PesertaPelatihan::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $labels = $pendaftaran->map(fn($item) => Carbon::parse($item->date)->format('d M'));
        $data = $pendaftaran->map(fn($item) => $item->count);

        $chartData = ['labels' => $labels, 'data' => $data];

        return view('livewire.admin.peserta-pelatihan.index', [
            'pesertaPelatihans' => $pesertaPelatihans,
            'chartData' => $chartData
        ]);
    }
}
