<?php

namespace App\Exports;

use App\Models\Lamaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LamaransExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Ambil semua data lamaran beserta relasi user dan lowongan
        return Lamaran::with(['user', 'lowongan'])->get();
    }

    public function headings(): array
    {
        // Definisikan judul kolom di file Excel
        return [
            'ID Lamaran',
            'Nama Pelamar',
            'Email Pelamar',
            'Lowongan Dilamar',
            'Status Lamaran',
            'Tanggal Melamar',
        ];
    }

    public function map($lamaran): array
    {
        // Petakan data untuk setiap baris
        return [
            $lamaran->id,
            $lamaran->user?->name ?? 'Pengguna Dihapus',
            $lamaran->user?->email ?? 'N/A',
            $lamaran->lowongan?->judul_lowongan ?? 'Lowongan Dihapus',
            ucfirst($lamaran->status), // Misal: 'Pending', 'Diterima'
            $lamaran->created_at->format('d M Y, H:i'),
        ];
    }
}
