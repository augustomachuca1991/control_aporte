<?php

namespace App\Imports;

use App\{Liquidacion,DeclaracionJuradaLine};
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\{NotificationImport,FailedImport};
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\{ToCollection,WithHeadingRow,WithBatchInserts,WithChunkReading,Importable,WithCustomCsvSettings,WithEvents,WithValidation,SkipsOnError,SkipsErrors,SkipsOnFailure,SkipsFailures};
use Exception;

class LiquidacionsImport implements 
    ToCollection,
    WithChunkReading,
    ShouldQueue,
    WithCustomCsvSettings,
    WithHeadingRow,
    SkipsOnError,
    SkipsOnFailure,
    WithEvents,
    WithValidation
    //WithBatchInserts
{
    use Importable, SkipsErrors, SkipsFailures;

    
    public $cabecera;

    public function __construct($cabecera)
    {
      $this->cabecera = $cabecera;
    }
    

    public $tries = 2;
    //public $timeout = 180;
    public function collection(Collection $rows)
    {
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
                   'adicional' => $row['adicional'],
                   'familiar' => $row['familiar'],
                   'hijo' => $row['hijo'],
                   'esposa' => $row['esposa'],
                   // 'otros' => $row['otros'],
                   // 'cod_funcion' => $row['cod_funcion'],
                   // 'funcion' => $row['funcion'],


               ]);
           } 
        } catch (Exception $e) {
            $this->failed($e);
        } catch(\ErrorException $e){
            $this->failed($e);
        } catch(Throwable $e){
            $this->failed($e);
        }
        
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
            '*.antiguedad' =>['numeric'],
            '*.adicional' =>['numeric','nullable'],
            '*.familiar' =>['numeric','nullable'],
            '*.hijo' =>['numeric','nullable'],
            '*.esposa' =>['numeric','nullable'],
            // '*.otros' =>['required', 'numeric'],
            // '*.cod_funcion' =>['integer','nullable'],
            // '*.funcion' =>['string', 'nullable'],
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


    

    


    public function onError(\Throwable $e)
    {
        event(new FailedImport('Error: '+$e->getMessage()));
    }


    public function onFailure(Failure ...$failures)
    {
        try {
            $row="";
            $columna= "";
            $errores = "";
            $valores = "";  
            foreach ($failures as $failure ) {
                $row = "Fila: ".(string)$failure->row()."<br>";
                $columna = "Columna: ".$failure->attribute()."<br>";
                $valores = "Valor invalido: ".$failure->values()[$failure->attribute()]."<br>";
                $errores = "Error: ";
                foreach ($failure->errors() as $error) {
                        $errores .= $error.', ';
                }
            }
            event(new FailedImport($row.$columna.$valores.$errores));
        } catch (Exception $e) {
            //$this->failed($e);
            \Log::info('exepcion personalizado:'.$exception->getMessage());
        } catch(\ErrorException $e){
            //$this->failed($e);
            \Log::info('exepcion personalizado:'.$exception->getMessage());
        } catch(Throwable $e){
            //$this->failed($e);
            \Log::info('exepcion personalizado:'.$exception->getMessage());
        }
        
        
    }


    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function(ImportFailed $event) {
                event(new FailedImport('Algo Salio mal'));
            },
        ];
    }

    public function failed($exception)
    {
        \Log::info('exepcion personalizado:'.$exception->getMessage());
        event(new FailedImport($exception->getMessage()));
        // etc...
    }


}
