<?php

namespace App\Imports;

use App\{Liquidacion,Declaracionjuradadetalle};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\{ToCollection,WithHeadingRow,WithBatchInserts,WithChunkReading,Importable};

class LiquidacionsImport implements ToCollection, WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue
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

            //aqui el codigo
            Declaracionjuradadetalle::create([
                'declaracionjurada_id' => 1,
                'data' => 'datos',
                //'created_at' => now(),
            ]);
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
}
