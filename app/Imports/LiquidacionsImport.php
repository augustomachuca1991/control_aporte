<?php

namespace App\Imports;

use App\{DeclaracionJurada, Liquidacion, DeclaracionJuradaLine, Categoria, Clase, Jurisdiccion, Agente, PuestoLaboral, HistoriaLaboral, ConceptoLiquidacion, Dpto, HistoriaLiquidacion, LiquidacionDetalle, LiquidacionOrganismo, Organismo, TipoCodigo, User};
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\{ImportFailedJob, CompletedImport, DeleteFileImportJob, NotificationJob};
use App\Events\{NotificationImport, FailedImport};
use App\Notifications\ImportHasFailedNotification;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Events\{AfterImport, ImportFailed, BeforeImport};
use Maatwebsite\Excel\Concerns\{ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, Importable, WithCustomCsvSettings, WithEvents, WithValidation, SkipsOnError, SkipsErrors, SkipsOnFailure, SkipsFailures, RemembersChunkOffset, RemembersRowNumber};
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LiquidacionsImport implements
    ToCollection,
    WithChunkReading,
    ShouldQueue,
    WithCustomCsvSettings,
    WithHeadingRow,
    SkipsOnError,
    SkipsOnFailure,
    WithEvents,
    WithValidation,
    WithBatchInserts
{
    use Importable, SkipsErrors, RemembersChunkOffset, RemembersRowNumber;


    protected $declaracionjurada;
    protected $declaracionjuradaline;
    protected $liquidacion;
    protected $conceptos;
    protected $concepto_id;
    protected $categoria_id;
    protected $clase_id;
    protected $jurisdiccion_id;
    protected $agente;
    protected $puesto_laboral;
    protected $historia_laboral_id;
    protected $importedBy;

    public $tries = 1;
    public $totalRows;
    public $countCicles = 0;
    public $errores;



    public function __construct(DeclaracionJurada $declaracionjurada)
    {
        $this->declaracionjurada = $declaracionjurada;
        $this->importedBy = $declaracionjurada->user;
    }



    public function collection(Collection $rows)
    {


        $chunkOffset = $this->getChunkOffset() - 2;
        $count = ($chunkOffset / 100) + 1;
        $cicles = intdiv($this->totalRows, $rows->count());
        $organismo = Organismo::where('cod_organismo', $this->declaracionjurada->organismo_id)->first();
        $jurisdiccion = $organismo->jurisdiccion;
        if ($this->declaracionjurada->rectificar) {
            foreach ($rows as $row => $value) {
                $this->detalle_conceptos($value['detalle']);
                if (!empty($this->declaracionjurada->ddjj_lines[$row])) {
                    $this->declaracionjurada->ddjj_lines[$row]->update([
                        'nombre' => $value['nombre'],
                        'cuil' => $value['cuil'],
                        'fecha_nac' => date("Y-m-d", strtotime($value['fecha_nac'])),
                        'sexo' => $value['sexo'],
                        'puesto_laboral' => $this->random_puesto_laboral($value['puesto_laboral']),
                        'cargo' => $value['cargo'],
                        'fecha_ingreso' =>  date("Y-m-d", strtotime($value['fecha_ingreso'])),
                        'cod_categoria' => $value['cod_categoria'],
                        'categoria' => $value['categoria'],
                        'cod_clase' => $value['cod_clase'],
                        'clase' => $value['clase'],
                        'cod_estado' => $value['cod_estado'],
                        'estado' => $value['estado'],
                        'cod_jurisdiccion' => $jurisdiccion->cod_jurisdiccion,
                        'jurisdiccion' => $jurisdiccion->jurisdiccion,
                        'cod_organismo' => $organismo->cod_organismo,
                        'organismo' => $organismo->organismo,
                        'detalle' => json_encode($this->conceptos),
                        'updated_at' => now()
                    ]);
                    $this->declaracionjuradaline = $this->declaracionjurada->ddjj_lines[$row];
                } else {

                    $this->declaracionjuradaline = DeclaracionJuradaLine::create([
                        'declaracionjurada_id' => $this->declaracionjurada->id,
                        'nombre' => $value['nombre'],
                        'cuil' => $value['cuil'],
                        'fecha_nac' => date("Y-m-d", strtotime($value['fecha_nac'])),
                        'sexo' => $value['sexo'],
                        'puesto_laboral' => $this->random_puesto_laboral($value['puesto_laboral']),
                        'cargo' => $value['cargo'],
                        'fecha_ingreso' =>  date("Y-m-d", strtotime($value['fecha_ingreso'])),
                        'cod_categoria' => $value['cod_categoria'],
                        'categoria' => $value['categoria'],
                        'cod_clase' => $value['cod_clase'],
                        'clase' => $value['clase'],
                        'cod_estado' => $value['cod_estado'],
                        'estado' => $value['estado'],
                        'cod_jurisdiccion' => $jurisdiccion->cod_jurisdiccion,
                        'jurisdiccion' => $jurisdiccion->jurisdiccion,
                        'cod_organismo' => $organismo->cod_organismo,
                        'organismo' => $organismo->organismo,
                        'detalle' => json_encode($this->conceptos),
                    ]);
                }

                $this->agente($this->declaracionjuradaline);
                $this->agente->update([
                    'nombre' => $this->declaracionjuradaline->nombre,
                    'cuil' => $this->declaracionjuradaline->cuil,
                    'fecha_nac' => date("Y-m-d", strtotime($this->declaracionjuradaline->fecha_nac)),
                    'sexo' => $this->declaracionjuradaline->sexo,
                    'updated_at' => now()
                ]);



                if (!empty($this->declaracionjurada->liquidaciones[$row])) {
                    $this->liquidacion = $this->declaracionjurada->liquidaciones[$row];
                } else {
                    $this->liquidacion = new Liquidacion();
                    $this->liquidacion->declaracion_id = $this->declaracionjurada->id;
                }
                for ($i = 0; $i < count($this->conceptos); $i++) {
                    $is_concepto = ConceptoLiquidacion::where('cod_concepto', $this->conceptos[$i]['cod'])
                        ->where('organismo_id', $this->declaracionjuradaline->cod_organismo);
                    if ($is_concepto->doesntExist()) {

                        $this->concepto_id[$i]  = ConceptoLiquidacion::insertGetId([
                            'cod_concepto' => $this->conceptos[$i]['cod'],
                            'concepto' => $this->conceptos[$i]['concepto'],
                            'unidad' => $this->conceptos[$i]['unidad'],
                            'organismo_id' => $this->declaracionjuradaline->cod_organismo,
                            'subtipo_id' => $this->conceptos[$i]['subtipo'],
                            'created_at' => now(),
                        ]);

                        $departamento = Dpto::find(1);
                        $departamento->conceptos()->attach($this->concepto_id[$i], [
                            'user_id' => $this->declaracionjurada->user_id,
                            'tipocodigo_id' => $this->conceptos[$i]['tipo'],
                            'subtipo_id' => $this->conceptos[$i]['subtipo'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    } else {
                        $this->concepto_id[$i] = $is_concepto->first()->id;
                    }

                    if ($this->conceptos[$i]['subtipo'] <= 2) {

                        if ($this->conceptos[$i]['subtipo'] == 1) {
                            $this->liquidacion->basico = $this->conceptos[$i]['importe'];
                        }
                        $this->liquidacion->remunerativo += $this->conceptos[$i]['importe'];
                        $this->liquidacion->bruto += $this->conceptos[$i]['importe'];
                    } else if ($this->conceptos[$i]['subtipo'] > 2 && $this->conceptos[$i]['subtipo'] <= 5) {

                        if ($this->conceptos[$i]['tipo'] == 2) {
                            $this->liquidacion->bonificable += $this->conceptos[$i]['importe'];
                        } else if ($this->conceptos[$i]['tipo'] == 3) {
                            $this->liquidacion->no_bonificable += $this->conceptos[$i]['importe'];
                        } else if ($this->conceptos[$i]['tipo'] == 4) {
                            $this->liquidacion->no_remunerativo += $this->conceptos[$i]['importe'];
                        }
                        $this->liquidacion->adicionales += $this->conceptos[$i]['importe'];
                        $this->liquidacion->bruto += $this->conceptos[$i]['importe'];
                    } else if ($this->conceptos[$i]['subtipo'] > 5 && $this->conceptos[$i]['subtipo'] <= 8) {

                        if ($this->conceptos[$i]['subtipo'] == 6) {
                            $this->liquidacion->familiar += $this->conceptos[$i]['importe'];
                        } else if ($this->conceptos[$i]['subtipo'] == 7) {
                            $this->liquidacion->hijo += $this->conceptos[$i]['importe'];
                        } else {
                            $this->liquidacion->esposa += $this->conceptos[$i]['importe'];
                        }
                    } elseif ($this->conceptos[$i]['subtipo'] > 8 && $this->conceptos[$i]['subtipo'] <= 11) { // descuento

                        if ($this->conceptos[$i]['subtipo'] == 9) {
                            $this->liquidacion->aporte_personal = $this->conceptos[$i]['importe'];
                            // $this->liquidacion->bruto = $this->conceptos[$i]['importe']/0.185;
                        }
                        $this->liquidacion->descuento += $this->conceptos[$i]['importe'];
                    }
                }
                $this->liquidacion->updated_at = now();
                $this->liquidacion->save();

                $is_detalleliquidacion = LiquidacionDetalle::where('liquidacion_id', $this->liquidacion->id);
                if ($is_detalleliquidacion->doesntExist()) {
                    $this->liquidacion_conceptos($this->liquidacion);
                } else {
                    $liquidacionDetalle = $is_detalleliquidacion->get();
                    for ($i = 0; $i < count($this->conceptos); $i++) {
                        if (!empty($liquidacionDetalle[$i])) {
                            $liquidacionDetalle[$i]->importe = $this->conceptos[$i]['importe'];
                            $liquidacionDetalle[$i]->concepto_id = $this->concepto_id[$i];
                            $liquidacionDetalle[$i]->updated_at = now();
                            $liquidacionDetalle[$i]->save();
                        } else {
                            $liquidacionDetalle = new LiquidacionDetalle();
                            $liquidacionDetalle->liquidacion_id = $this->liquidacion->id;
                            $liquidacionDetalle->concepto_id = $this->concepto_id[$i];
                            $liquidacionDetalle->importe = $this->conceptos[$i]['importe'];
                            $liquidacionDetalle->created_at = now();
                            $liquidacionDetalle->save();
                        }
                    }
                }

                $is_computo = LiquidacionOrganismo::where('liquidacion_id', $this->liquidacion->id);
                if ($is_computo->doesntExist()) {
                    $this->liquidacion_organismo($this->liquidacion);
                } else {
                    $computos = $is_computo->get();
                    foreach ($computos as $computo) {
                        $computo->haber_bruto = $this->liquidacion->bruto;
                        $computo->total_aporte_personal = $this->liquidacion->aporte_personal;
                        $computo->total_sueldo_basico = $this->liquidacion->basico;
                        $computo->total_antiguedad = ($this->liquidacion->remunerativo - $this->liquidacion->basico);
                        $computo->total_adicional = $this->liquidacion->adicionales;
                        $computo->total_familiar = $this->liquidacion->familiar;
                        $computo->total_hijo = $this->liquidacion->hijo;
                        $computo->total_esposa = $this->liquidacion->esposa;
                        $computo->updated_at = now();
                        $computo->save();
                    }
                }

                $this->categoria_clase($this->declaracionjuradaline);
                $this->puesto_laboral($this->declaracionjuradaline);

                $is_historiaLiquidacion = HistoriaLiquidacion::where('h_laboral_id', $this->historia_laboral_id);
                if ($is_historiaLiquidacion->doesntExist()) {
                    HistoriaLiquidacion::create([
                        'estado_id' => $this->declaracionjuradaline->cod_estado,
                        'funcion_id' => null,
                        'h_laboral_id' => $this->historia_laboral_id,
                    ]);
                } else {
                    $historiasLaborales = $is_historiaLiquidacion->get();
                    foreach ($historiasLaborales as $historiaLaboral) {
                        $historiaLaboral->estado_id = $this->declaracionjuradaline->cod_estado;
                        $historiaLaboral->funcion_id = null;
                        $historiaLaboral->updated_at = now();
                        $historiaLaboral->save();
                    }
                }
            }
        } else {
            foreach ($rows as $row) {
                $this->detalle_conceptos($row['detalle']);

                // Validator::make($this->conceptos, [
                //     '*.detalle' => 'array|size:6',
                // ])->validate();

                $ddjj_line = DeclaracionJuradaLine::create([
                    'declaracionjurada_id' => $this->declaracionjurada->id,
                    'nombre' => $row['nombre'],
                    'cuil' => $row['cuil'],
                    'fecha_nac' => date("Y-m-d", strtotime($row['fecha_nac'])),
                    'sexo' => $row['sexo'],
                    'puesto_laboral' => $this->random_puesto_laboral($row['puesto_laboral']),
                    'cargo' => $row['cargo'],
                    'fecha_ingreso' =>  date("Y-m-d", strtotime($row['fecha_ingreso'])),
                    'cod_categoria' => $row['cod_categoria'],
                    'categoria' => $row['categoria'],
                    'cod_clase' => $row['cod_clase'],
                    'clase' => $row['clase'],
                    'cod_estado' => $row['cod_estado'],
                    'estado' => $row['estado'],
                    'cod_jurisdiccion' => $jurisdiccion->cod_jurisdiccion,
                    'jurisdiccion' => $jurisdiccion->jurisdiccion,
                    'cod_organismo' => $organismo->cod_organismo,
                    'organismo' => $organismo->organismo,
                    'detalle' => json_encode($this->conceptos),
                ]);


                $liquidacion = new Liquidacion();
                $liquidacion->declaracion_id = $this->declaracionjurada->id;
                for ($i = 0; $i < count($this->conceptos); $i++) {
                    $is_concepto = ConceptoLiquidacion::where('cod_concepto', $this->conceptos[$i]['cod'])
                        ->where('organismo_id', $ddjj_line['cod_organismo']);
                    if ($is_concepto->doesntExist()) {

                        $this->concepto_id[$i]  = ConceptoLiquidacion::insertGetId([
                            'cod_concepto' => $this->conceptos[$i]['cod'],
                            'concepto' => $this->conceptos[$i]['concepto'],
                            'unidad' => $this->conceptos[$i]['unidad'],
                            'organismo_id' => $ddjj_line['cod_organismo'],
                            'subtipo_id' => $this->conceptos[$i]['subtipo'],
                            'created_at' => now()
                        ]);
                        $departamento = Dpto::find(1);
                        $departamento->conceptos()->attach($this->concepto_id[$i], [
                            'user_id' => $this->declaracionjurada->user_id,
                            'tipocodigo_id' => $this->conceptos[$i]['tipo'],
                            'subtipo_id' => $this->conceptos[$i]['subtipo'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    } else {
                        $this->concepto_id[$i] = $is_concepto->first()->id;
                    }

                    if ($this->conceptos[$i]['subtipo'] <= 2) {

                        if ($this->conceptos[$i]['subtipo'] == 1) {
                            $liquidacion->basico = $this->conceptos[$i]['importe'];
                        }
                        $liquidacion->remunerativo += $this->conceptos[$i]['importe'];
                        $liquidacion->bruto += $this->conceptos[$i]['importe'];
                    } else if ($this->conceptos[$i]['subtipo'] > 2 && $this->conceptos[$i]['subtipo'] <= 5) {

                        if ($this->conceptos[$i]['tipo'] == 2) {
                            $liquidacion->bonificable += $this->conceptos[$i]['importe'];
                        } else if ($this->conceptos[$i]['tipo'] == 3) {
                            $liquidacion->no_bonificable += $this->conceptos[$i]['importe'];
                        } else if ($this->conceptos[$i]['tipo'] == 4) {
                            $liquidacion->no_remunerativo += $this->conceptos[$i]['importe'];
                        }
                        $liquidacion->adicionales += $this->conceptos[$i]['importe'];
                        $liquidacion->bruto += $this->conceptos[$i]['importe'];
                    } else if ($this->conceptos[$i]['subtipo'] > 5 && $this->conceptos[$i]['subtipo'] <= 8) {

                        if ($this->conceptos[$i]['subtipo'] == 6) {
                            $liquidacion->familiar += $this->conceptos[$i]['importe'];
                        } elseif ($this->conceptos[$i]['subtipo'] == 7) {
                            $liquidacion->hijo += $this->conceptos[$i]['importe'];
                        } else {
                            $liquidacion->esposa += $this->conceptos[$i]['importe'];
                        }
                    } elseif ($this->conceptos[$i]['subtipo'] > 8 && $this->conceptos[$i]['subtipo'] <= 11) { // descuento

                        if ($this->conceptos[$i]['subtipo'] == 9) {
                            $liquidacion->aporte_personal = $this->conceptos[$i]['importe'];
                            // $liquidacion->bruto = $this->conceptos[$i]['importe']/0.185;
                        }
                        $liquidacion->descuento += $this->conceptos[$i]['importe'];
                    }
                }
                $liquidacion->save();


                $this->liquidacion_conceptos($liquidacion);
                $this->liquidacion_organismo($liquidacion);
                $this->categoria_clase($ddjj_line);
                $this->agente($ddjj_line);
                $this->puesto_laboral($ddjj_line);


                $liquidacion->historia_laborales()->attach($this->historia_laboral_id, [
                    'estado_id' => $ddjj_line->cod_estado,
                    'funcion_id' => null
                ]);
            }
        }

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
            '*.puesto_laboral' => ['integer', 'nullable'],
            '*.cargo' => ['required'],
            '*.fecha_ingreso' => ['required', 'date'],
            '*.cod_categoria' => ['required', 'integer'],
            '*.categoria' => ['required'],
            '*.cod_clase' => ['required', 'integer'],
            '*.clase' => ['required'],
            '*.cod_estado' => ['required', 'integer'],
            '*.estado' => ['required'],
            '*.cod_funcion' => ['integer', 'nullable'],
            '*.funcion' => ['string', 'nullable'],
            '*.detalle' => ['required', 'string'],
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
        return 200;
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
        return 200;
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
            foreach ($failures as $key => $failure) {
                Log::channel('daily')->info('fallos', [
                    //'message' => $failure->toArray()[0],
                    'row' => $failure->row(),
                    'attribute' => $failure->attribute(),
                    'errors' => $failure->errors(),
                    'values' => $failure->values(),
                ]);

                //$this->errores[$key] = $failure;
            }
        }
    }



    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {

                if (!empty($event)) {
                    Log::channel('daily')->error($event->getException()->getMessage());
                    //event(new FailedImport("error de importacion"));
                    $this->failed($event->getException()->getMessage());
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
            },

            AfterImport::class => function (AfterImport $event) {
                $creator = $event->reader->getProperties()->getCreator();
                if (!empty($creator)) {
                    //echo $totalRows['Worksheet'];
                    Log::channel('daily')->info('after import', [
                        'creator' => $creator
                    ]);
                }
            },


        ];
    }

    public function failed($message)
    {
        ImportFailedJob::dispatch($this->declaracionjurada);
        event(new FailedImport($message));
    }


    protected function detalle_conceptos($detalles)
    {
        $detalle = explode('|', $detalles);
        $array_detalle = array_chunk($detalle, 6, false);

        // $validacion = [
        //     'detalle_array' => $array_detalle,
        // ];
        // $reglas = [
        //     'detalle.*' => 'array|size:6',
        // ];
        // $mensajes = [
        //     'detalle.*.array' => '* no es array',
        //     'detalle.*.size' => '* no tiene el tamaño especifico',
        // ];
        // $validator = Validator::make($validacion, $reglas, $mensajes);

        for ($i = 0; $i < count($array_detalle); $i++) {
            for ($j = 0; $j < count($array_detalle[$i]); $j++) {
                $this->conceptos[$i]['cod'] = $array_detalle[$i][0];
                $this->conceptos[$i]['concepto'] = $array_detalle[$i][1];
                $this->conceptos[$i]['subtipo'] = $array_detalle[$i][2];
                $this->conceptos[$i]['tipo'] = $array_detalle[$i][3];
                $this->conceptos[$i]['unidad'] = $array_detalle[$i][4];
                $this->conceptos[$i]['importe'] = $array_detalle[$i][5];
            }
        }
    }


    protected function liquidacion_conceptos($liquidacion)
    {


        for ($i = 0; $i < count($this->conceptos); $i++) {
            $liquidacion->conceptos()->attach($this->concepto_id[$i], [
                'importe' => $this->conceptos[$i]['importe']
            ]);
        }
    }

    protected function liquidacion_organismo($liquidacion)
    {


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
    }



    protected function categoria_clase(DeclaracionJuradaLine $ddjj_line)
    {
        $is_categoria = Categoria::where('cod_categoria', $ddjj_line->cod_categoria);
        if ($is_categoria->doesntExist()) {
            $this->categoria_id = Categoria::insertGetId([
                'cod_categoria' => $ddjj_line->cod_categoria,
                'categoria' => $ddjj_line->categoria,
                'created_at' => now(),
            ]);

            $this->clase_id = Clase::insertGetId([
                'cod_clase' => $ddjj_line->cod_clase,
                'categoria_id' => $this->categoria_id,
                'clase' => $ddjj_line->clase,
                'created_at' => now(),
            ]);

            $is_jurisdiccion = Jurisdiccion::where('cod_jurisdiccion', $ddjj_line->cod_jurisdiccion);
            if ($is_jurisdiccion->doesntExist()) {
                $this->jurisdiccion_id = Jurisdiccion::insertGetId([
                    'cod_jurisdiccion' => $ddjj_line->cod_jurisdiccion,
                    'jurisdiccion' => $ddjj_line->jurisdiccion,
                    'origen_id' => $ddjj_line->cod_origen,
                    'created_at' => now(),
                ]);
            } else {
                $this->jurisdiccion_id  = $is_jurisdiccion->first()->id;
            }
            Categoria::find($this->categoria_id)->jurisdicciones()->attach($this->jurisdiccion_id);
        } else {
            $this->categoria_id = $is_categoria->first()->id;
            $is_clase = Clase::where('cod_clase', $ddjj_line->cod_clase);
            if ($is_clase->doesntExist()) {
                $this->clase_id = Clase::insertGetId([
                    'cod_clase' => $ddjj_line->cod_clase,
                    'clase' => $ddjj_line->clase,
                    'categoria_id' => Categoria::find($this->categoria_id)->cod_categoria,
                    'created_at' => now(),
                ]);
            } else {
                $this->clase_id = $is_clase->first()->id;
            }
        }
    }



    protected function agente(DeclaracionJuradaLine $declaracionjuradaline)
    {

        $is_agente = Agente::where('cuil', $declaracionjuradaline->cuil);
        if ($is_agente->doesntExist()) {
            $this->agente = Agente::create([
                'nombre' => $declaracionjuradaline->nombre,
                'cuil' => $declaracionjuradaline->cuil,
                'fecha_nac' => date("Y-m-d", strtotime($declaracionjuradaline->fecha_nac)),
                'sexo' => $declaracionjuradaline->sexo,
            ]);
        } else {
            $this->agente = $is_agente->first();
        }
    }


    protected function puesto_laboral(DeclaracionJuradaLine $ddjj_line)
    {
        $is_puesto_laboral = PuestoLaboral::where('cod_laboral', $this->random_puesto_laboral($ddjj_line->puesto_laboral));
        if ($is_puesto_laboral->doesntExist()) {
            $this->puesto_laboral = PuestoLaboral::create([
                'cod_laboral' => $this->random_puesto_laboral($ddjj_line->puesto_laboral),
                'organismo_id' => $this->declaracionjurada->organismo_id,
                'agente_id' => $this->agente->id,
                'fecha_ingreso' => date("Y-m-d", strtotime($ddjj_line->fecha_ingreso)),
                'fecha_egreso' => null,

            ]);

            $this->puesto_laboral->clases()->attach($this->clase_id, [
                'fecha_inicio' => date("Y-m-d", strtotime($ddjj_line->fecha_ingreso)),
                'fecha_fin' => now()->endOfMonth()->modify('0 month')->toDateString(),
            ]);
        } else {
            $this->puesto_laboral = $is_puesto_laboral->first();
        }




        $this->historia_laboral_id = $this->puesto_laboral->clases->first()->pivot->id;
    }


    protected function random_puesto_laboral($cod_laboral)
    {
        if (empty($cod_laboral)) {
            $random_cod = rand(1, 100000);
            $is_puesto = PuestoLaboral::where('cod_laboral', $random_cod)->exists();
            while ($is_puesto) {
                $random_cod = rand(1, 100000);
                $is_puesto = PuestoLaboral::where('cod_laboral', $random_cod)->exists();
            }
            $cod_laboral = $random_cod;
        }
        return $cod_laboral;
    }
}
