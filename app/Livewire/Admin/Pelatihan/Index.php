<?php

namespace App\Livewire\Admin\Pelatihan;

use App\Models\Pelatihan; // Pastikan model ini sudah ada
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination; // Untuk pagination
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout; // 1. Import class Layout

#[Layout('layouts.admin')] // 2. Definisikan layout di sini
#[Title('Kelola Pelatihan')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';

    // Listener ini akan me-refresh data setelah form disimpan
    #[On('pelatihan-saved')]
    public function refreshPelatihanList()
    {
        // Cukup dengan merender ulang, data akan ter-update
    }

    /**
     * Menghapus data pelatihan.
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $pelatihan = Pelatihan::findOrFail($id);

        // Hapus file poster dari storage jika ada
        if ($pelatihan->poster) {
            Storage::disk('public')->delete($pelatihan->poster);
        }

        $pelatihan->delete();

        // Kirim pesan sukses
        session()->flash('success', 'Pelatihan berhasil dihapus.');
    }

    /**
     * Render komponen.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Ambil data pelatihan dengan fitur pencarian dan pagination
        $pelatihans = Pelatihan::where('nama_pelatihan', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10); // Menampilkan 10 data per halaman

        return view('livewire.admin.pelatihan.index', [
            'pelatihans' => $pelatihans
        ]); // 3. Hapus ->layout() dari sini
    }
}
