<?php
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

    public function exportExcel()
    {
        return Excel::download(new PelatihanExport, 'laporan-pelatihan-' . now()->format('d-m-Y') . '.xlsx');
    }

    public function render()
    {
        $pelatihans = Pelatihan::where('nama_pelatihan', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        $pelatihanPosts = Pelatihan::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $labels = $pelatihanPosts->map(fn($item) => Carbon::parse($item->date)->format('d M'));
        $data = $pelatihanPosts->map(fn($item) => $item->count);

        $chartData = [
            'labels' => $labels,
            'data' => $data,
        ];

        return view('livewire.admin.pelatihan.index', [
            'pelatihans' => $pelatihans,
            'chartData' => $chartData,
        ]);
    }
}