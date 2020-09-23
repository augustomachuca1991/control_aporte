<?php

namespace App\Imports;

use App\{Liquidacion,DeclaracionJuradaLine};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\{ToCollection,WithHeadingRow,WithBatchInserts,WithChunkReading,Importable,WithCustomCsvSettings};

class LiquidacionsImport implements ToCollection,WithBatchInserts,WithChunkReading,ShouldQueue,WithCustomCsvSettings,WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $cabecera;

    public function __construct($cabecera)
    {
      $this->cabecera = $cabecera;
    }
    

    public $tries = 3;
    //public $timeout = 180;
    public function collection(Collection $rows)
    {
        
        DB::beginTransaction();
        try {
            foreach ($rows as $row) {
                DeclaracionJuradaLine::create([
                    'declaracionjurada_id' => $this->cabecera,
                    'nombre' => $row['nombre'],
                    'cuil' => $row['cuil'],
                    'fecha_nac' => date("Y-m-d", strtotime($row['fecha_nac'])),
                    'sexo' => $row['sexo'],
                    'puesto_laboral' => $row['puesto_laboral'],
                    'cargo' => $row['cargo'],
                    'fecha_ingreso' =>  date("Y-m-d", strtotime($row['fecha_ingreso'])),
                    'cod_clase' => $row['cod_clase'],
                    'clase' => $row['clase'],
                    'cod_estado' => $row['cod_estado'],
                    'estado' => $row['estado'],
                    'cod_jurisdiccion' => $row['cod_jurisdiccion'],
                    'jurisdiccion' => $row['jurisdiccion'],
                    'cod_organismo' => $row['cod_organismo'],
                    'organismo' => $row['organismo'],
                    'haber_bruto' => $row['haber_bruto'],
                    'aporte_personal' => $row['aporte_personal'],
                    'aporte_estatal' => $row['aporte_estatal'],
                    'basico' => $row['basico'],
                    'antiguedad' => $row['antiguedad'],
                    // 'adicionales' => $row['adicionales'],
                    // 'familiar' => $row['familiar'],
                    // 'hijo' => $row['hijo'],
                    // 'esposa' => $row['esposa'],
                    // 'otros' => $row['otros'],
                    // 'cod_funcion' => $row['cod_funcion'],
                    // 'funcion' => $row['funcion'],


                ]);
            }
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        } catch(\Throwable $e){
            DB::rollback();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Lectura por bloque
    |--------------------------------------------------------------------------
    |
    | Lee el archivo en bloques
    |  
    */
    public function batchSize(): int
    {
        return 500;
    }
    
    
    
    /*
    |--------------------------------------------------------------------------
    | Insert por bloque
    |--------------------------------------------------------------------------
    |
    | Inserta por bloque
    | 
    */
    public function chunkSize(): int
    {
        return 500;
    }


    public function getCsvSettings(): array
    {
        return [
            'delimiter' => '@',
        ];
    }
}
