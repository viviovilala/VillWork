<?php

namespace App\Exports;

use App\Models\Lowongan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LowongansExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Lowongan::with('user')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Judul Lowongan',
            'Deskripsi',
            'Gaji',
            'Lokasi',
            'Dibuat Oleh',
            'Tanggal Posting',
        ];
    }

    /**
     * @param mixed $lowongan
     * @return array
     */
    public function map($lowongan): array
    {
        // [DIPERBAIKI] Memetakan data sesuai dengan kolom yang benar dan menambahkan pengecekan null
        return [
            $lowongan->id,
            $lowongan->judul_lowongan,
            $lowongan->deskripsi,
            $lowongan->gaji,
            $lowongan->lokasi,
            $lowongan->user?->name ?? 'N/A', 
            $lowongan->created_at?->format('d M Y') ?? 'N/A', 
        ];
    }
}
