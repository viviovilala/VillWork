<?php

// File: app/Livewire/Admin/Pelatihan/Form.php
namespace App\Livewire\Admin\Pelatihan;

use App\Models\Pelatihan;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Form Pelatihan')]
class Form extends Component
{
    // Properti dan trait untuk upload file sudah dihapus
    public ?Pelatihan $pelatihan;
    public string $nama_pelatihan = '';
    public string $deskripsi = '';
    public string $tanggal_mulai = '';
    public string $tanggal_selesai = '';

    // Aturan validasi disederhanakan tanpa poster
    protected function rules()
    {
        return [
            'nama_pelatihan' => 'required|string|min:5',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ];
    }

    public function mount(Pelatihan $pelatihan)
    {
        $this->pelatihan = $pelatihan;
        if ($this->pelatihan->exists) {
            $this->nama_pelatihan = $pelatihan->nama_pelatihan;
            $this->deskripsi = $pelatihan->deskripsi;
            $this->tanggal_mulai = $pelatihan->tanggal_mulai->format('Y-m-d');
            $this->tanggal_selesai = $pelatihan->tanggal_selesai->format('Y-m-d');
        }
    }

    public function save()
    {
        // Validasi data
        $data = $this->validate();

        // Simpan atau perbarui data pelatihan
        $this->pelatihan->fill($data)->save();

        session()->flash('success', 'Data pelatihan berhasil disimpan.');
        return $this->redirect(route('admin.pelatihan.index'), navigate: true);
    }

    // Method removePoster() sudah dihapus

    public function render()
    {
        return view('livewire.admin.pelatihan.form');
    }
}
