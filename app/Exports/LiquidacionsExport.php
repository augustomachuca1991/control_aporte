<?php

namespace App\Exports;

use App\Liquidacion;
use Maatwebsite\Excel\Concerns\FromCollection;

class LiquidacionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Liquidacion::all();
    }
}
