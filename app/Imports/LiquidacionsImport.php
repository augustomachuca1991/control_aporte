<?php

namespace App\Imports;

use App\{Liquidacion,DeclaracionJuradaLine};
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Support\Facades\{DB,Validator};
use Maatwebsite\Excel\Events\AfterImport;
use App\Events\{NotificationImport,FailedImport};
use Maatwebsite\Excel\Concerns\{ToCollection,WithHeadingRow,WithBatchInserts,WithChunkReading,Importable,WithCustomCsvSettings,WithEvents,RegistersEventListeners,WithValidation,SkipsOnError,SkipsErrors,SkipsOnFailure,SkipsFailures};

class LiquidacionsImport implements 
    ToCollection,
    WithChunkReading,
    ShouldQueue,
    WithCustomCsvSettings,
    WithHeadingRow,
    WithEvents,
    WithValidation
    //SkipsOnError,
    //SkipsOnFailure
    //WithBatchInserts
{
    use Importable, SkipsErrors, RegistersEventListeners, SkipsFailures;

    
    public $cabecera;

    public function __construct($cabecera)
    {
      $this->cabecera = $cabecera;
    }
    

    public $tries = 3;
    //public $timeout = 180;
    public function collection(Collection $rows)
    {
        
        // DB::beginTransaction();
        // try {
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
                    'adicionales' => $row['adicionales'],
                    'familiar' => $row['familiar'],
                    'hijo' => $row['hijo'],
                    'esposa' => $row['esposa'],
                    'otros' => $row['otros'],
                    'cod_funcion' => $row['cod_funcion'],
                    'funcion' => $row['funcion'],


                ]);
            }
            
        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollback();
        // } catch(\Throwable $e){
        //     DB::rollback();
        // }
    }



    public function rules(): array
    {
        return [
            '*.nombre' =>['required'],
            '*.cuil' =>['required','integer','digits_between:10,11'],
            '*.fecha_nac' =>['required','date'],
            '*.sexo' =>['required','string'],
            '*.puesto_laboral' =>['required','integer'],
            '*.cargo' =>['required'],
            '*.fecha_ingreso' =>['required','date'],
            '*.cod_clase' =>['required','integer'],
            '*.clase' =>['required'],
            '*.cod_estado' =>['required','integer'],
            '*.estado' =>['required'],
            '*.cod_jurisdiccion' =>['required','integer'],
            '*.jurisdiccion' =>['required'],
            '*.cod_organismo' =>['required','integer'],
            '*.organismo' =>['required'],
            '*.haber_bruto' =>['required', 'numeric'],
            '*.aporte_personal' =>['required','numeric'],
            '*.aporte_estatal' =>['required', 'numeric'],
            '*.basico' =>['required', 'numeric'],
            '*.antiguedad' =>['required','numeric'],
            '*.adicional' =>['required', 'numeric'],
            '*.familiar' =>['required', 'numeric'],
            '*.hijo' =>['required', 'numeric'],
            '*.esposa' =>['required','numeric'],
            '*.otros' =>['required', 'numeric'],
            '*.cod_funcion' =>['integer','nullable'],
            '*.funcion' =>['string', 'nullable'],
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Lectura por bloque
    |--------------------------------------------------------------------------
    |
    | Lee el archivo en bloques
    |  
    */
    // public function batchSize(): int
    // {
    //     return 500;
    // }
    
    
    
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
            'enclosure' => '',
            'input_encoding' => 'UTF-8'
        ];
    }

    public static function afterImport(AfterImport $event)
    {
        
        event(new NotificationImport('El archivo excel se importó correctamente'));

    }

    

    


    // public function onError(\Throwable $e)
    // {
    //     event(new FailedImport('Error'));
    // }

    //  public function onFailure(Failure ...$failures)
    // {
    //     event(new FailedImport('Error'));
    // }


    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function(ImportFailed $event) {
                event(new FailedImport('Error'));
            },
        ];
    }



}
