<?php

namespace App\Imports;

use App\{DeclaracionJurada, Liquidacion, DeclaracionJuradaLine, Categoria, Clase, Jurisdiccion, Agente, PuestoLaboral, HistoriaLaboral, ConceptoLiquidacion, User};
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\{ImportFailedJob, CompletedImport, DeleteFileImportJob, NotificationJob};
use App\Events\{NotificationImport, FailedImport};
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Events\{ImportFailed, BeforeImport};
use Maatwebsite\Excel\Concerns\{ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, Importable, WithCustomCsvSettings, WithEvents, WithValidation, SkipsOnError, SkipsErrors, SkipsOnFailure, SkipsFailures, RemembersChunkOffset, RemembersRowNumber};
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
        foreach ($rows as $row) {
            $declaracionjurada_detalle = DeclaracionJuradaLine::create([
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
                // 'haber_bruto' => $row['haber_bruto'],
                // 'aporte_personal' => $row['aporte_personal'],
                // 'aporte_estatal' => $row['aporte_estatal'],
                // 'basico' => $row['basico'],
                // 'antiguedad' => $row['antiguedad'],
                // 'adicional' => $row['adicional'],
                // 'familiar' => $row['familiar'],
                // 'hijo' => $row['hijo'],
                // 'esposa' => $row['esposa'],

                // 'otros' => $row['otros'],
                // 'cod_funcion' => $row['cod_funcion'],
                // 'funcion' => $row['funcion'],
            ]);






            //liquidacion detalle

            $detalles = explode('|', $row['detalle']);
            $detalle = array_chunk($detalles, 6, false);
            for ($i = 0; $i < count($detalle); $i++) {
                # code...
                for ($j = 0; $j < count($detalle[$i]); $j++) {
                    # code...
                    $conceptos[$i]['cod'] = $detalle[$i][0];
                    $conceptos[$i]['concepto'] = $detalle[$i][1];
                    $conceptos[$i]['subtipo'] = $detalle[$i][2];
                    $conceptos[$i]['tipo'] = $detalle[$i][3];
                    $conceptos[$i]['unidad'] = $detalle[$i][4];
                    $conceptos[$i]['importe'] = $detalle[$i][5];
                }
            }


            //Conceptos de Liquidacion
            $liquidacion = new Liquidacion();
            $liquidacion->declaracion_id = $this->declaracionjurada->id;
            for ($i = 0; $i < count($conceptos); $i++) {
                $concepto = ConceptoLiquidacion::where('cod_concepto', $conceptos[$i]['cod'])
                    ->where('organismo_id', $row['cod_organismo']);
                if ($concepto->doesntExist()) {
                    # code...
                    $new_concepto = new ConceptoLiquidacion();
                    $new_concepto->cod_concepto = $conceptos[$i]['cod'];
                    $new_concepto->concepto = $conceptos[$i]['concepto'];
                    $new_concepto->organismo_id = $row['cod_organismo'];
                    $new_concepto->subtipo_id = $conceptos[$i]['subtipo'];
                    $new_concepto->save();
                }


                if ($conceptos[$i]['subtipo'] <= 2) {

                    if ($conceptos[$i]['subtipo'] == 1) {
                        $liquidacion->basico = $conceptos[$i]['importe'];
                    }

                    $liquidacion->remunerativo += $conceptos[$i]['importe'];
                    $liquidacion->bruto += $conceptos[$i]['importe'];
                } else if ($conceptos[$i]['subtipo'] > 2 && $conceptos[$i]['subtipo'] <= 5) {

                    if ($conceptos[$i]['tipo'] == 2) {

                        $liquidacion->bonificable += $conceptos[$i]['importe'];
                    } else if ($conceptos[$i]['tipo'] == 3) {

                        $liquidacion->no_bonificable += $conceptos[$i]['importe'];
                    } else if ($conceptos[$i]['tipo'] == 4) {

                        $liquidacion->no_remunerativo += $conceptos[$i]['importe'];
                    }
                    $liquidacion->adicionales += $conceptos[$i]['importe'];
                    $liquidacion->bruto += $conceptos[$i]['importe'];
                } else if ($conceptos[$i]['subtipo'] > 5 && $conceptos[$i]['subtipo'] <= 8) {

                    if ($conceptos[$i]['subtipo'] == 6) {

                        $liquidacion->familiar += $conceptos[$i]['importe'];
                    } elseif ($conceptos[$i]['subtipo'] == 7) {

                        $liquidacion->hijo += $conceptos[$i]['importe'];
                    } else {

                        $liquidacion->esposa += $conceptos[$i]['importe'];
                    }
                } elseif ($conceptos[$i]['subtipo'] > 8 && $conceptos[$i]['subtipo'] <= 11) { // descuento
                    if ($conceptos[$i]['subtipo'] == 9) {

                        $liquidacion->aporte_personal = $conceptos[$i]['importe'];
                        // $liquidacion->bruto = $conceptos[$i]['importe']/0.185;
                    }

                    $liquidacion->descuento += $conceptos[$i]['importe'];
                }
            }





            $liquidacion->save();
            for ($i = 0; $i < count($conceptos); $i++) {
                # code...
                $liquidacion->conceptos()->attach($conceptos[$i]['cod'], [
                    'unidad' => $conceptos[$i]['unidad'],
                    'importe' => $conceptos[$i]['importe']
                ]);
            }


            //Liquidacion Organismos-------------------------------------------------------
            $liquidacion->organismos()->attach($this->declaracionjurada->organismo_id, [
                'periodo_id' => $this->declaracionjurada->periodo_id,
                'tipo_id' => $this->declaracionjurada->tipoliquidacion_id,
                'haber_bruto' => $liquidacion->bruto,
                'total_aporte_personal' => $liquidacion->aporte_personal,
                'total_sueldo_basico' => $liquidacion->basico,
                'total_antiguedad' => ($liquidacion->remunerativo - $liquidacion->basico),
                'total_adicional' => $liquidacion->adicionales,
                'total_familiar' => $liquidacion->familiar,
                'total_hijo' => $liquidacion->hijo,
                'total_esposa' => $liquidacion->esposa,
            ]);

            //Nueva Categoria, Clase y Jurisdiccion-------------------------------------------------------------------
            $categoria = Categoria::where('cod_categoria', $declaracionjurada_detalle->cod_categoria);
            if ($categoria->doesntExist()) {
                $categoria1 = Categoria::create([
                    'cod_categoria' => $declaracionjurada_detalle->cod_categoria,
                    'categoria' => $declaracionjurada_detalle->categoria,
                ]);
                //Clase------------------------------------------------------------------------
                $clase1 = new Clase();
                $clase1->cod_clase = $declaracionjurada_detalle->cod_clase;
                $clase1->categoria_id = $categoria1->id;
                $clase1->clase = $declaracionjurada_detalle->clase;
                $clase1->save();
                //Jurisdiccion------------------------------------------------------------------
                $jurisdiccion = Jurisdiccion::where('cod_jurisdiccion', $declaracionjurada_detalle->cod_jurisdiccion);
                if ($jurisdiccion->doesntExist()) {
                    $jurisdiccion1 = Jurisdiccion::create([
                        'cod_jurisdiccion' => $declaracionjurada_detalle->cod_jurisdiccion,
                        'jurisdiccion' => $declaracionjurada_detalle->jurisdiccion,
                        'origen_id' => $declaracionjurada_detalle->cod_origen,
                    ]);
                } else {
                    $jurisdiccion1 = $jurisdiccion->first();
                }
                $categoria1->jurisdicciones()->attach($jurisdiccion1->id);
            } else {
                $categoria1 = $categoria->first();
                $clase = Clase::where('cod_clase', $declaracionjurada_detalle->cod_clase);
                if ($clase->doesntExist()) {
                    $clase1 = Clase::create([
                        'cod_clase' => $declaracionjurada_detalle->cod_clase,
                        'clase' => $declaracionjurada_detalle->clase,
                        'categoria_id' => $categoria1->cod_categoria,
                    ]);
                } else {
                    $clase1 = $clase->first();
                }
            }


            //Agentes------------------------------------------------------------------
            $agente = Agente::where('cuil', $declaracionjurada_detalle->cuil);
            if ($agente->doesntExist()) {
                $agente1 = Agente::create([
                    'nombre' => $declaracionjurada_detalle->nombre,
                    'cuil' => $declaracionjurada_detalle->cuil,
                    'fecha_nac' => date("Y-m-d", strtotime($declaracionjurada_detalle->fecha_nac)),
                    'sexo' => $declaracionjurada_detalle->sexo,
                ]);
            } else {
                $agente1 = $agente->first();
            }


            //Puesto Laboral----------------------------------------------------------------------------------
            $puesto_laboral = PuestoLaboral::where('cod_laboral', $declaracionjurada_detalle->puesto_laboral);
            if ($puesto_laboral->doesntExist()) {
                $agente1->organismos()->attach($this->declaracionjurada->organismo_id, [
                    'cod_laboral' => $declaracionjurada_detalle->puesto_laboral,
                    'fecha_ingreso' => date("Y-m-d", strtotime($declaracionjurada_detalle->fecha_ingreso)),
                    'fecha_egreso' => null,
                ]);
                $puesto_laboral1 = $agente1->puestolaborales->where('cod_laboral', $declaracionjurada_detalle->puesto_laboral)->first();
            } else {
                $puesto_laboral1 = $puesto_laboral->first();
            }


            //puesto laborales-------------------------------------------------------------------------------------
            $puesto_laboral1->clases()->attach($clase1->id, [
                'fecha_inicio' => date("Y-m-d", strtotime($declaracionjurada_detalle->fecha_ingreso)),
                'fecha_fin' => now()->endOfMonth()->modify('0 month')->toDateString(),
            ]);

            $historia_laboral = HistoriaLaboral::where('puesto_id', $puesto_laboral1->id)
                ->where('clase_id', $clase1->id)
                ->first();

            //liquidaciones con Historias laborales------------------
            $liquidacion->historia_laborales()->attach($historia_laboral->id, [
                'estado_id' => $declaracionjurada_detalle->cod_estado,
                'funcion_id' => null
            ]);
        } //end foreach
        $user = User::find($this->declaracionjurada->user_id);
        if ($cicles == $count) {
            $deleteFileJob = new DeleteFileImportJob($this->declaracionjurada);
            CompletedImport::dispatch()->chain([new NotificationJob($user), $deleteFileJob]);
        }
        
    }



    public function rules(): array
    {
        return [
            '*.nombre' => ['required'],
            '*.cuil' => ['required', 'integer', 'digits_between:10,11'],
            '*.fecha_nac' => ['required', 'date'],
            '*.sexo' => ['required', 'string'],
            '*.puesto_laboral' => ['required', 'integer'],
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
            // '*.haber_bruto' =>['required', 'numeric'],
            // '*.aporte_personal' =>['required','numeric'],
            // '*.aporte_estatal' =>['required', 'numeric'],
            // '*.basico' =>['required', 'numeric'],
            // '*.antiguedad' =>['numeric'],
            // '*.adicional' =>['numeric','nullable'],
            // '*.familiar' =>['numeric','nullable'],
            // '*.hijo' =>['numeric','nullable'],
            // '*.esposa' =>['numeric','nullable'],
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
