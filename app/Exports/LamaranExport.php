<?php

namespace App\Exports;

use App\Models\Lamaran;
use Maatwebsite\Excel\Concerns\FromCollection;

class LamaranExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lamaran::all();
    }
}
