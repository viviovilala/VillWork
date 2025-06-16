<?php

namespace App\Livewire\Admin\Pelatihan;

use App\Models\Pelatihan;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;

#[Layout('layouts.admin')]
#[Title('Kelola Pelatihan')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';

    // Listener ini akan me-refresh data setelah form disimpan
    #[On('pelatihan-saved')]
    public function refreshPelatihanList() {}

    public function delete(int $id): void
    {
        $pelatihan = Pelatihan::findOrFail($id);
        if ($pelatihan->poster) {
            Storage::disk('public')->delete($pelatihan->poster);
        }
        $pelatihan->delete();
        session()->flash('success', 'Pelatihan berhasil dihapus.');
    }

    public function render()
    {
        $pelatihans = Pelatihan::where('nama_pelatihan', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);
        return view('livewire.admin.pelatihan.index', [
            'pelatihans' => $pelatihans
        ]);
    }
}