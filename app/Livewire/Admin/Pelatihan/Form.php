<?php

namespace App\Livewire\Admin\Pelatihan;

use App\Models\Pelatihan;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads; // WAJIB untuk upload file
use Livewire\Attributes\Layout; // 1. Import class Layout
use Livewire\Attributes\Title;

#[Layout('layouts.admin')] // 2. Definisikan layout di sini
#[Title('Form Pelatihan')]
class Form extends Component
{
    use WithFileUploads;

    // Properti untuk form
    public ?Pelatihan $pelatihan = null; // Untuk menampung model saat edit
    public string $nama_pelatihan = '';
    public string $deskripsi = '';
    public $poster; // Untuk menampung file baru yang diupload
    public string $tanggal_mulai = '';
    public string $tanggal_selesai = '';

    /**
     * Aturan validasi.
     */
    protected function rules()
    {
        return [
            'nama_pelatihan' => 'required|string|min:5',
            'deskripsi' => 'required|string',
            // Jika membuat baru, poster wajib. Jika edit, opsional.
            'poster' => ($this->pelatihan?->poster ? 'nullable' : 'required') . '|image|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ];
    }

    /**
     * Method mount dijalankan saat komponen dimuat.
     * Digunakan untuk mengisi form jika dalam mode edit.
     */
    public function mount(Pelatihan $pelatihan)
    {
        if ($pelatihan->exists) {
            $this->pelatihan = $pelatihan;
            $this->nama_pelatihan = $pelatihan->nama_pelatihan;
            $this->deskripsi = $pelatihan->deskripsi;
            $this->tanggal_mulai = $pelatihan->tanggal_mulai->format('Y-m-d');
            $this->tanggal_selesai = $pelatihan->tanggal_selesai->format('Y-m-d');
        }
    }

    /**
     * Method untuk menyimpan data (Create atau Update).
     */
    public function save()
    {
        $this->validate();

        $data = [
            'nama_pelatihan' => $this->nama_pelatihan,
            'deskripsi' => $this->deskripsi,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
        ];

        // Cek apakah ada file poster baru yang diupload
        if ($this->poster) {
            // Hapus poster lama jika ada (saat mode edit)
            if ($this->pelatihan && $this->pelatihan->poster) {
                Storage::disk('public')->delete($this->pelatihan->poster);
            }
            // Simpan poster baru dan masukkan path-nya ke data
            $data['poster'] = $this->poster->store('posters', 'public');
        }

        // Gunakan updateOrCreate untuk handle create dan update sekaligus
        Pelatihan::updateOrCreate(['id' => $this->pelatihan?->id], $data);

        session()->flash('success', 'Data pelatihan berhasil disimpan.');

        // Redirect ke halaman index pelatihan
        return $this->redirect(route('admin.pelatihan.index'), navigate: true);
    }

    public function render()
    {
        // 3. Hapus ->layout() dari sini
        return view('livewire.admin.pelatihan.form');
    }
}
