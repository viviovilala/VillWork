<?php

namespace App\Livewire\Pengguna\Lowongan;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Untuk format tanggal

class ManageLowongan extends Component
{
    // --- Properti untuk Form Input Lowongan ---
    public $id_perusahaan;
    public $judul_pekerjaan;
    public $deskripsi;
    public $lokasi;
    public $gaji_min;
    public $gaji_max;
    public $tanggal_berakhir;

    // --- Properti untuk Pesan Notifikasi Form ---
    public $formMessage = '';
    public $formMessageType = ''; // 'success' or 'error'

    // --- Properti untuk Tampilan Data Lowongan & Grafik ---
    public $lowongans = [];
    public $labels = [];
    public $dataGaji = [];
    public $showDetailModal = false;
    public $selectedLowongan = null;

    // Rules untuk validasi form
    protected $rules = [
        'id_perusahaan' => 'required|string|max:255',
        'judul_pekerjaan' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'lokasi' => 'required|string|max:255',
        'gaji_min' => 'required|numeric|min:0',
        'gaji_max' => 'required|numeric|min:0|gt:gaji_min',
        'tanggal_berakhir' => 'required|date|after_or_equal:today',
    ];

    // Dipanggil saat komponen pertama kali di-load
    public function mount()
    {
        $this->loadLowonganData();
    }

    // Real-time validation untuk form
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // --- Metode untuk Publish Lowongan ---
    public function publishLowongan()
    {
        $this->validate();

        try {
            DB::table('lowongan')->insert([
                'id_perusahaan' => $this->id_perusahaan,
                'judul_pekerjaan' => $this->judul_pekerjaan,
                'deskripsi' => $this->deskripsi,
                'lokasi' => $this->lokasi,
                'gaji_min' => $this->gaji_min,
                'gaji_max' => $this->gaji_max,
                'tanggal_berakhir' => $this->tanggal_berakhir,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Reset form fields
            $this->reset([
                'id_perusahaan', 'judul_pekerjaan', 'deskripsi',
                'lokasi', 'gaji_min', 'gaji_max', 'tanggal_berakhir'
            ]);

            $this->formMessage = 'Lowongan berhasil dipublikasikan!';
            $this->formMessageType = 'success';

            // Muat ulang data lowongan dan grafik setelah publish
            $this->loadLowonganData();

        } catch (\Exception $e) {
            $this->formMessage = 'Terjadi kesalahan saat mempublikasikan lowongan: ' . $e->getMessage();
            $this->formMessageType = 'error';
        }
    }

    // --- Metode untuk Memuat Data Lowongan & Grafik ---
    public function loadLowonganData()
    {
        $this->lowongans = DB::table('lowongan')->orderBy('tanggal_berakhir', 'DESC')->get();

        $this->labels = [];
        $this->dataGaji = [];

        foreach ($this->lowongans as $row) {
            $this->labels[] = $row->judul_pekerjaan;
            $this->dataGaji[] = $row->gaji_max;
        }

        // Emit event untuk memberitahu frontend bahwa data grafik sudah diperbarui
        $this->dispatch('lowonganDataUpdated', [
            'labels' => $this->labels,
            'dataGaji' => $this->dataGaji
        ]);
    }

    // --- Metode untuk Modal Detail Lowongan ---
    public function showDetail($id_lowongan)
    {
        $this->selectedLowongan = DB::table('lowongan')->where('id_lowongan', $id_lowongan)->first();
        $this->showDetailModal = true;
    }

    public function closeModal()
    {
        $this->showDetailModal = false;
        $this->selectedLowongan = null;
    }

    public function render()
    {
        return view('livewire.manage-lowongan');
    }
}