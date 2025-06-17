<?php

namespace App\Exports;

use App\Models\PesertaPelatihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PesertaPelatihanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return PesertaPelatihan::with(['user', 'pelatihan'])->get();
    }

    public function headings(): array
    {
        return [
            'ID Pendaftaran',
            'Nama Peserta',
            'Email Peserta',
            'Nama Pelatihan',
            'Tanggal Daftar',
        ];
    }

    public function map($pendaftaran): array
    {
        return [
            $pendaftaran->id,
            $pendaftaran->user?->name ?? 'N/A',
            $pendaftaran->user?->email ?? 'N/A',
            $pendaftaran->pelatihan?->nama_pelatihan ?? 'Pelatihan Dihapus',
            $pendaftaran->created_at?->format('d M Y') ?? 'N/A',
        ];
    }
}
