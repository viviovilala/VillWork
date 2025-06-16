<?php

// File: app/Livewire/Admin/Pelatihan/Index.php
namespace App\Livewire\Admin\Pelatihan;

use App\Models\Pelatihan;
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

    #[On('pelatihan-saved')]
    public function refreshPelatihanList() {}

    public function delete(int $id): void
    {
        $pelatihan = Pelatihan::findOrFail($id);
        // Logika untuk menghapus file dari storage sudah dihapus
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
