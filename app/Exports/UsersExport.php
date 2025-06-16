<?php
// File: app/Exports/UsersExport.php
// Pastikan file ini ada setelah menjalankan `make:export`

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::select('id', 'nama', 'email', 'created_at')->get();
    }

    public function headings(): array
    {
        return ["ID", "Nama", "Email", "Tanggal Daftar"];
    }
}