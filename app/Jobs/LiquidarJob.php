<?php

namespace App\Jobs;

use App\Agente;
use App\Categoria;
use App\Clase;
use App\ConceptoLiquidacion;
use App\DeclaracionJurada;
use App\HistoriaLaboral;
use App\Jurisdiccion;
use App\Liquidacion;
use App\PuestoLaboral;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class LiquidarJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $declaracionjurada;
    protected $conceptos;
    protected $concepto_id;
    protected $categoria_id;
    protected $clase_id;
    protected $jurisdiccion_id;
    protected $agente;
    protected $puesto_laboral;
    protected $historia_laboral_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DeclaracionJurada $declaracionjurada)
    {
        $this->declaracionjurada = $declaracionjurada;
        $this->onConnection('redis');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->declaracionjurada->ddjj_lines as $ddjj_line) {
            $this->agente($ddjj_line);
            $this->detalle_conceptos($ddjj_line['detalle']);
            $liquidacion = new Liquidacion();
            $liquidacion->declaracion_id = $this->declaracionjurada->id;
            for ($i = 0; $i < count($this->conceptos); $i++) {
                $is_concepto = ConceptoLiquidacion::where('cod_concepto', $this->conceptos[$i]['cod'])
                        ->where('organismo_id', $ddjj_line['cod_organismo']);
                    if ($is_concepto->doesntExist()) {

                        $this->concepto_id = ConceptoLiquidacion::insertGetId([
                            'cod_concepto' => $this->conceptos[$i]['cod'],
                            'concepto' => $this->conceptos[$i]['concepto'],
                            'organismo_id' => $ddjj_line['cod_organismo'],
                            'subtipo_id' => $this->conceptos[$i]['subtipo']
                        ]);
                    }else{
                        $this->concepto_id = $is_concepto->first()->id;
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
            $this->puesto_laboral($ddjj_line);


            $liquidacion->historia_laborales()->attach($this->historia_laboral_id, [
                'estado_id' => $ddjj_line->cod_estado,
                'funcion_id' => null
            ]);
        }
    }


    protected function detalle_conceptos($detalles)
    {
        $detalle = explode('|', $detalles);
        $array_detalle = array_chunk($detalle, 6, false);
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


    protected function liquidacion_conceptos($liquidacion){

        for ($i = 0; $i < count($this->conceptos); $i++) {
            $liquidacion->conceptos()->attach($this->concepto_id, [
                'unidad' => $this->conceptos[$i]['unidad'],
                'importe' => $this->conceptos[$i]['importe']
            ]);
        }
    }

    protected function liquidacion_organismo($liquidacion){

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



    protected function categoria_clase($ddjj_line){
        $is_categoria = Categoria::where('cod_categoria', $ddjj_line->cod_categoria);
        if ($is_categoria->doesntExist()) {
            $this->categoria_id = Categoria::insertGetId([
                'cod_categoria' => $ddjj_line->cod_categoria,
                'categoria' => $ddjj_line->categoria,
            ]);

            $this->clase_id = Clase::insertGetId([
                'cod_clase' => $ddjj_line->cod_clase,
                'categoria_id' => $this->categoria_id,
                'clase' => $ddjj_line->clase
            ]);

            $is_jurisdiccion = Jurisdiccion::where('cod_jurisdiccion', $ddjj_line->cod_jurisdiccion);
            if ($is_jurisdiccion->doesntExist()) {
                $this->jurisdiccion_id = Jurisdiccion::insertGetId([
                    'cod_jurisdiccion' => $ddjj_line->cod_jurisdiccion,
                    'jurisdiccion' => $ddjj_line->jurisdiccion,
                    'origen_id' => $ddjj_line->cod_origen,
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
                ]);
            } else {
                $this->clase_id = $is_clase->first()->id;
            }
        }
    }



    protected function agente($ddjj_line){

        $is_agente = Agente::where('cuil', $ddjj_line->cuil);
        if ($is_agente->doesntExist()) {
            $this->agente = Agente::create([
                'nombre' => $ddjj_line->nombre,
                'cuil' => $ddjj_line->cuil,
                'fecha_nac' => date("Y-m-d", strtotime($ddjj_line->fecha_nac)),
                'sexo' => $ddjj_line->sexo,
            ]);
        } else {
            $this->agente = $is_agente->first();
        }
    }


    protected function puesto_laboral($ddjj_line){

        $is_puesto_laboral = PuestoLaboral::where('cod_laboral', $ddjj_line->puesto_laboral);
        if ($is_puesto_laboral->doesntExist()) {
            $this->agente->organismos()->attach($this->declaracionjurada->organismo_id, [
                'cod_laboral' => $ddjj_line->puesto_laboral,
                'fecha_ingreso' => date("Y-m-d", strtotime($ddjj_line->fecha_ingreso)),
                'fecha_egreso' => null,
            ]);
            $this->puesto_laboral = $this->agente->puestolaborales->where('cod_laboral', $ddjj_line->puesto_laboral)->first();
        } else {
            $this->puesto_laboral = $is_puesto_laboral->first();
        }

        $this->puesto_laboral->clases()->attach($this->clase_id, [
            'fecha_inicio' => date("Y-m-d", strtotime($ddjj_line->fecha_ingreso)),
            'fecha_fin' => now()->endOfMonth()->modify('0 month')->toDateString(),
        ]);

        $this->historia_laboral_id = $this->puesto_laboral->clases->first()->pivot->id;
    }




}
