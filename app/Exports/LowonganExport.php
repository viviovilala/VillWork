<?php
// File: app/Exports/LowonganExport.php
// (Buat file dan isi kode yang sama untuk Lowongan, Pelatihan, dan Lamaran)
namespace App\Exports;

use App\Models\Lowongan;
use Maatwebsite\Excel\Concerns\FromCollection;

class LowonganExport implements FromCollection
{
    public function collection()
    {
        return Lowongan::all();
    }
}

// File: app/Exports/PelatihanExport.php
namespace App\Exports;

use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PelatihanExport implements FromCollection
{
    public function collection()
    {
        return Pelatihan::all();
    }
}

// File: app/Exports/LamaranExport.php
namespace App\Exports;

use App\Models\Lamaran;
use Maatwebsite\Excel\Concerns\FromCollection;

class LamaranExport implements FromCollection
{
    public function collection()
    {
        return Lamaran::all();
    }
}
