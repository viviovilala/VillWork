<?php

namespace App\Exports;

use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PelatihanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pelatihan::all();
    }
}
