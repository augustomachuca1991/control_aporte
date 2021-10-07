<?php

namespace App\Imports;

use App\{DeclaracionJurada, Liquidacion, DeclaracionJuradaLine, Categoria, Clase, Jurisdiccion, Agente, PuestoLaboral, HistoriaLaboral, ConceptoLiquidacion, User};
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\{ImportFailedJob, CompletedImport, DeleteFileImportJob, LiquidarJob, NotificationJob};
use App\Events\{NotificationImport, FailedImport};
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Events\{ImportFailed, BeforeImport};
use Maatwebsite\Excel\Concerns\{ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, Importable, WithCustomCsvSettings, WithEvents, WithValidation, SkipsOnError, SkipsErrors, SkipsOnFailure, SkipsFailures, RemembersChunkOffset, RemembersRowNumber};
use Illuminate\Support\Facades\Log;

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
    use Importable, SkipsErrors, RemembersChunkOffset, RemembersRowNumber;


    protected $declaracionjurada;


    public $tries = 1;
    public $totalRows;
    public $countCicles = 0;
    public $error = "ocurrio un error";



    public function __construct(DeclaracionJurada $declaracionjurada)
    {
        $this->declaracionjurada = $declaracionjurada;
    }



    public function collection(Collection $rows)
    {
        
        $chunkOffset = $this->getChunkOffset() - 2;
        $count = ($chunkOffset / 100) + 1;
        $cicles = intdiv($this->totalRows, $rows->count());

        
        if ($this->declaracionjurada->rectificar) {
            foreach ($rows as $row => $value) {

                // $this->declaracionjurada->ddjj_lines[$row]->nombre = $value['nombre'];
                // $this->declaracionjurada->ddjj_lines[$row]->cuil = $value['cuil'];
                // $this->declaracionjurada->ddjj_lines[$row]->fecha_nac = date("Y-m-d", strtotime($value['fecha_nac']));
                // $this->declaracionjurada->ddjj_lines[$row]->sexo = $value['sexo'];
                // $this->declaracionjurada->ddjj_lines[$row]->puesto_laboral = $value['puesto_laboral'];
                // $this->declaracionjurada->ddjj_lines[$row]->cargo = $value['cargo'];
                // $this->declaracionjurada->ddjj_lines[$row]->fecha_ingreso = date("Y-m-d", strtotime($value['fecha_ingreso']));
                // $this->declaracionjurada->ddjj_lines[$row]->cod_categoria = $value['cod_categoria'];
                // $this->declaracionjurada->ddjj_lines[$row]->categoria = $value['categoria'];
                // $this->declaracionjurada->ddjj_lines[$row]->cod_clase = $value['cod_clase'];
                // $this->declaracionjurada->ddjj_lines[$row]->clase = $value['clase'];
                // $this->declaracionjurada->ddjj_lines[$row]->cod_estado = $value['cod_estado'];
                // $this->declaracionjurada->ddjj_lines[$row]->estado = $value['estado'];
                // $this->declaracionjurada->ddjj_lines[$row]->cod_jurisdiccion = $value['cod_jurisdiccion'];
                // $this->declaracionjurada->ddjj_lines[$row]->jurisdiccion = $value['jurisdiccion'];
                // $this->declaracionjurada->ddjj_lines[$row]->cod_organismo = $value['cod_organismo'];
                // $this->declaracionjurada->ddjj_lines[$row]->organismo = $value['organismo'];
                // $this->declaracionjurada->ddjj_lines[$row]->detalle = $value['detalle'];

                // $this->declaracionjurada->ddjj_lines[$row]->save();

                $this->declaracionjurada->ddjj_lines[$row]->update([
                    'nombre' => $value['nombre'],
                    'cuil' => $value['cuil'],
                    'fecha_nac' => date("Y-m-d", strtotime($value['fecha_nac'])),
                    'sexo' => $value['sexo'],
                    'puesto_laboral' => $value['puesto_laboral'],
                    'cargo' => $value['cargo'],
                    'fecha_ingreso' =>  date("Y-m-d", strtotime($value['fecha_ingreso'])),
                    'cod_categoria' => $value['cod_categoria'],
                    'categoria' => $value['categoria'],
                    'cod_clase' => $value['cod_clase'],
                    'clase' => $value['clase'],
                    'cod_estado' => $value['cod_estado'],
                    'estado' => $value['estado'],
                    'cod_jurisdiccion' => $value['cod_jurisdiccion'],
                    'jurisdiccion' => $value['jurisdiccion'],
                    'cod_organismo' => $value['cod_organismo'],
                    'organismo' => $value['organismo'],
                    'detalle' => $value['detalle'],
                    'updated_at' => now()
                ]);
                
            }
        }else{
            foreach ($rows as $row) {
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
                    'cod_jurisdiccion' => $row['cod_jurisdiccion'],
                    'jurisdiccion' => $row['jurisdiccion'],
                    'cod_organismo' => $row['cod_organismo'],
                    'organismo' => $row['organismo'],
                    'detalle' => $row['detalle'],
                ]);
            }
        }
        LiquidarJob::dispatch($this->declaracionjurada);

        if ($cicles == $count) {
            $deleteFileJob = new DeleteFileImportJob($this->declaracionjurada);
            CompletedImport::dispatch()->chain([new NotificationJob(User::find($this->declaracionjurada->user_id)), $deleteFileJob]);
        }
        
    }



    public function rules(): array
    {
        return [
            '*.nombre' => ['required'],
            '*.cuil' => ['required', 'integer', 'digits_between:10,11'],
            '*.fecha_nac' => ['required', 'date'],
            '*.sexo' => ['required', 'string'],
            '*.puesto_laboral' => ['integer','nullable'],
            '*.cargo' => ['required'],
            '*.fecha_ingreso' => ['required', 'date'],
            '*.cod_categoria' => ['required', 'integer'],
            '*.categoria' => ['required'],
            '*.cod_clase' => ['required', 'integer'],
            '*.clase' => ['required'],
            '*.cod_estado' => ['required', 'integer'],
            '*.estado' => ['required'],
            '*.cod_jurisdiccion' => ['required', 'integer'],
            '*.jurisdiccion' => ['required'],
            '*.cod_organismo' => ['required', 'integer'],
            '*.organismo' => ['required'],
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
        return 300;
    }


    public function getCsvSettings(): array
    {
        return [
            'delimiter' => '@',
            'enclosure' => '',
            'input_encoding' => 'UTF-8'
        ];
    }







    public function onError(\Throwable $errors)
    {
        //event(new FailedImport('Error: '+$errors));
        //$this->failed($e);
        // Log::channel('daily')->info('onError', [
        //     'message' => $e->getMessage(),
        // ]);
        // ImportFailedJob::dispatch($this->declaracionjurada);
        //  event(new FailedImport($e->getMessage()));
        if (!empty($errors)) {
            foreach ($errors as $error) {
                Log::channel('daily')->info('onError', [
                    'errors' => $error->errors(),
                ]);
            }
        }
    }


    public function onFailure(Failure ...$failures)
    {
        if (!empty($failures)) {
            foreach ($failures as $failure) {
                Log::channel('daily')->info('fallos', [
                    'message' => $failure->toArray()[0],
                    'row' => $failure->row(),
                    'attribute' => $failure->attribute(),
                    'errors' => $failure->errors(),
                    'values' => $failure->values(),
                ]);

                $this->error = $failure->toArray()[0];
            }
        }
    }



    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {

                if (!empty($event)) {
                    Log::channel('daily')->error('failed import', [
                        'import failed' => $event->getException()->getMessage(),
                    ]);
                    event(new FailedImport($this->error));
                }
            },

            BeforeImport::class => function (BeforeImport $event) {
                $totalRows = $event->getReader()->getTotalRows();
                if (!empty($totalRows)) {
                    $this->totalRows = $totalRows['Worksheet'] - 1;
                    Log::channel('daily')->info('before import', [
                        'total Rows' => $this->totalRows
                    ]);
                }
            }

            // AfterImport::class => function (AfterImport $event) {
            //     $creator = $event->reader->getProperties()->getCreator();
            //     if (!empty($creator)) {
            //         //echo $totalRows['Worksheet'];
            //         Log::channel('daily')->info('after import', [
            //             'creator' => $creator
            //         ]);
            //     }
            // },


        ];
    }

    public function failed($message)
    {
        ImportFailedJob::dispatch($this->declaracionjurada);
        event(new FailedImport($message));
    }


}



