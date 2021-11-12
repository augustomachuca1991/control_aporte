<?php

namespace App\Imports;

use App\DeclaracionJuradaLine;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class DeclaracionJudaraLineImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) 
        {
            DeclaracionJuradaLine::create([
                'declaracionjurada_id' => $this->declaracionjurada->id,
                'nombre' => $row['nombre'],
                'cuil' => $row['cuil'],
                'fecha_nac' => date("Y-m-d", strtotime($row['fecha_nac'])),
                'sexo' => $row['sexo'],
                'puesto_laboral' => $row['puesto_laboral'],
                'cargo' => $row['cargo'],
                'fecha_ingreso' =>  date("Y-m-d", strtotime($row['fecha_ingreso'])),
                'cod_categoria' => $row['cod_categoria'],
                'categoria' => $row['categoria'],
                'cod_clase' => $row['cod_clase'],
                'clase' => $row['clase'],
                'cod_estado' => $row['cod_estado'],
                'estado' => $row['estado'],
                'cod_jurisdiccion' => '1',
                'jurisdiccion' => 'jurisdiccion',
                'cod_organismo' => '1',
                'organismo' => 'organismo',
                'detalle' => $this->array_conceptos($index,$row['detalle']),
            ]);
        }
    }


    public function array_conceptos($index, $detalle){

        Log::channel('daily')->info('fila '.$index, [
            'detalle' => $detalle,
        ]);

    }
}
