<?php

namespace App\Imports;

use App\{DeclaracionJurada, Liquidacion, DeclaracionJuradaLine, Categoria, Clase, Jurisdiccion, Agente, PuestoLaboral, HistoriaLaboral, ConceptoLiquidacion, Dpto, HistoriaLiquidacion, LiquidacionDetalle, LiquidacionOrganismo, Notification, Organismo, TipoCodigo, User};
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\{ImportFailedJob, CompletedImport, DeleteFileImportJob, NotificationJob};
use App\Events\{NotificationImport, FailedImport};
use App\Notifications\ImportHasFailedNotification;
use Exception;
use Illuminate\Support\Facades\DB;
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
    use Importable, SkipsErrors, RemembersChunkOffset, RemembersRowNumber, SkipsFailures;


    protected $declaracionjurada;
    protected $importedBy;
    protected $jurisdiccion;
    protected $organismo;
    protected $periodo;
    protected $tipo;
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
    


    public $tries = 2;
    public $totalRows;
    public $countCicles = 0;
    public $errores;



    public function __construct(DeclaracionJurada $declaracionjurada)
    {
        $this->declaracionjurada = $declaracionjurada;
        $this->importedBy = $declaracionjurada->user;
        $this->organismo = $declaracionjurada->organismo;
        $this->jurisdiccion = $declaracionjurada->organismo->jurisdiccion;
        $this->tipo = $declaracionjurada->tipoliquidacion;
        $this->periodo = $declaracionjurada->periodo;
        $this->rectificar = $declaracionjurada->rectificar;
    }



    public function collection(Collection $rows)
    {
        $chunkOffset = $this->getChunkOffset() - 2;
        $count = ($chunkOffset / 100) + 1;
        $cicles = intdiv($this->totalRows, $rows->count());

        if (!$this->rectificar) {
            foreach ($rows as $index => $row) {
                # create...
                $this->declaracionjuradaline = DeclaracionJuradaLine::create([
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
                    'detalle' => $this->detalle_conceptos(json_encode($row['detalle'])),
                ]);
            }

        }else{
            
            // foreach ($rows as $index => $row) {
            //     # update...
            //     $this->update($index, $row);
            // }

            Log::channel('daily')->info('update');
        }


        if ($cicles == $count) {
            $this->declaracionjurada->status = false;
            $this->declaracionjurada->apply = true;
            $this->declaracionjurada->rectificar = false;
            $this->declaracionjurada->save();
            $notificationJob = new NotificationJob($this->importedBy);
            CompletedImport::dispatch()->chain([$notificationJob]);
            Log::channel('daily')->info($this->declaracionjurada->nombre_archivo, [
                'final' => 'termino',
            ]);
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
                Log::channel('daily')->info($this->declaracionjurada->nombre_archivo, [
                    'error' => $error->errors(),
                ]);
            }
        }
    }


    public function onFailure(Failure ...$failures)
    {
        if (!empty($failures)) {
            foreach ($failures as $key => $failure) {
                Log::channel('daily')->info($this->declaracionjurada->nombre_archivo, [

                    'message' => $failure->toArray()[0],
                    'row' => $failure->row(),
                    'attribute' => $failure->attribute(),
                    'errors' => $failure->errors(),
                    'values' => $failure->values()[$failure->attribute()],
                ]);
            }
        }
    }



    public function registerEvents(): array
    {
        return [
            // ImportFailed::class => function (ImportFailed $event) {

            //     if (!empty($event)) {
            //         Log::channel('daily')->error($event->getException()->getMessage());
            //         //event(new FailedImport("error de importacion"));
            //         $this->failed($event->getException()->getMessage());
            //     }
            // },

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
        event(new FailedImport('ocurrio un error durante la importacion'));
    }



    public function store($row){


    }


    public function update($index , $row){
        

    }


    protected function detalle_conceptos($detalles)
    {
        $detalle = explode('|', $detalles);
        $array_detalle = array_chunk($detalle, 6, false);
        foreach ($array_detalle as $index => $value) {
            $detalle[$index]['cod'] = $value[0];
            $detalle[$index]['concepto'] = $value[1];
            $detalle[$index]['subtipo'] = $value[2];
            $detalle[$index]['tipo'] = $value[3];
            $detalle[$index]['unidad'] = $value[4];
            $detalle[$index]['importe'] = $value[5];
        }
        return $detalle;

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

        // for ($i = 0; $i < count($array_detalle); $i++) {
        //     for ($j = 0; $j < count($array_detalle[$i]); $j++) {
        //         $this->conceptos[$i]['cod'] = $array_detalle[$i][0];
        //         $this->conceptos[$i]['concepto'] = $array_detalle[$i][1];
        //         $this->conceptos[$i]['subtipo'] = $array_detalle[$i][2];
        //         $this->conceptos[$i]['tipo'] = $array_detalle[$i][3];
        //         $this->conceptos[$i]['unidad'] = $array_detalle[$i][4];
        //         $this->conceptos[$i]['importe'] = $array_detalle[$i][5];
        //     }
        // }
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
