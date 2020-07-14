<?php

namespace App\Imports;

use App\{Liquidacion,DeclaracionJurada};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\{ToCollection,WithHeadingRow,WithBatchInserts,WithChunkReading,Importable,WithEvents};

class LiquidacionsImport implements ToCollection, WithHeadingRow,WithBatchInserts,WithChunkReading,ShouldQueue,WithEvents
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
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        } catch(\Throwable $e){
            DB::rollback();
        }
    }
}
