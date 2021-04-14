<?php

namespace App\Imports;

use App\{DeclaracionJurada,Liquidacion,DeclaracionJuradaLine,Categoria,Clase,Jurisdiccion,Agente, PuestoLaboral,HistoriaLaboral,ConceptoLiquidacion};
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

    
    protected $declaracionjurada;

    public function __construct(DeclaracionJurada $declaracionjurada)
    {
      $this->declaracionjurada = $declaracionjurada;
    }
    

    public $tries = 3;
    //public $timeout = 180;
    public function collection(Collection $rows)
    {
        try {
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

                $detalles = explode( '|', $row['detalle']);
                $detalle = array_chunk($detalles, 6, false);
                for ($i=0; $i < count($detalle) ; $i++) { 
                    # code...
                    for ($j=0; $j < count($detalle[$i]); $j++) { 
                        # code...
                        $conceptos[$i]['cod'] = $detalle[$i][0];
                        $conceptos[$i]['concepto'] = $detalle[$i][1];
                        $conceptos[$i]['subtipo'] = $detalle[$i][2];
                        $conceptos[$i]['tipo'] = $detalle[$i][3];
                        $conceptos[$i]['unidad'] = $detalle[$i][4];
                        $conceptos[$i]['importe'] = $detalle[$i][5];
                    }
                }



                $liquidacion = new Liquidacion();
                $liquidacion->declaracion_id = $this->declaracionjurada->id;
                for ($i=0; $i < count($conceptos) ; $i++) { 
                    $concepto = ConceptoLiquidacion::where('cod_concepto', $conceptos[$i]['cod'])
                    ->where('organismo_id',$row['cod_organismo']);
                    if ($concepto->doesntExist()) {
                        # code...
                        $new_concepto = new ConceptoLiquidacion();
                        $new_concepto->cod_concepto = $conceptos[$i]['cod'];
                        $new_concepto->concepto = $conceptos[$i]['concepto'];
                        $new_concepto->organismo_id = $row['cod_organismo'];
                        $new_concepto->subtipo_id = $conceptos[$i]['subtipo'];
                        $new_concepto->save();
                    }


                    if ($conceptos[$i]['subtipo'] <= 2) { //remunerativo
                        # code...
                        if ($conceptos[$i]['subtipo'] == 1) {
                            $liquidacion->basico = $conceptos[$i]['importe'];

                        }
                        
                        $liquidacion->remunerativo += $conceptos[$i]['importe'];
                        $liquidacion->bruto += $conceptos[$i]['importe'];
                    } else if($conceptos[$i]['subtipo'] > 2 && $conceptos[$i]['subtipo'] <= 5 ){ //adicionales
                        
                        if ($conceptos[$i]['tipo'] == 2) { //remunerativo bonificable
                            # code...
                            $liquidacion->bonificable += $conceptos[$i]['importe'];

                        }else if ($conceptos[$i]['tipo'] == 3) {//remunerativo no bonificable
                            # code...
                            $liquidacion->no_bonificable += $conceptos[$i]['importe'];

                        }else if ($conceptos[$i]['tipo'] == 4) {//no remunerativo no bonificable
                            # code...
                            $liquidacion->no_remunerativo += $conceptos[$i]['importe'];
                        }

                        $liquidacion->bruto += $conceptos[$i]['importe'];

                    } else if ($conceptos[$i]['subtipo'] > 5 && $conceptos[$i]['subtipo'] <= 8 ) { // adicionales sociales
                        # code...
                        $liquidacion->familiar += $conceptos[$i]['importe'];

                    }elseif ($conceptos[$i]['subtipo'] > 8 && $conceptos[$i]['subtipo'] <= 11) { // descuento
                        if ($conceptos[$i]['subtipo'] == 9) {
                            # code...
                            $liquidacion->aporte_personal = $conceptos[$i]['importe'];
                            
                            
                            // $liquidacion->bruto = $conceptos[$i]['importe']/0.185;
                        }

                        $liquidacion->descuento += $conceptos[$i]['importe'];


                    }
                    //haberes con aporte = basico + descuento
                    //bruto = bonificable + remunerativo + no remunerativo;
                    
                    
                    
                }
                
                
                $liquidacion->save();
                for ($i=0; $i < count($conceptos) ; $i++) { 
                    # code...
                    $liquidacion->conceptos()->attach( $conceptos[$i]['cod'],[
                        'unidad' => $conceptos[$i]['unidad'],
                        'importe' => $conceptos[$i]['importe']
                    ]);
                }




                // Nueva Liquidacion-------------------------------------------------------------
                
                // $liquidacion = new Liquidacion();
                // $liquidacion->declaracion_id = $this->declaracionjurada->id;
                // $liquidacion->bruto = $row['aporte_personal']/0.185;
                // $liquidacion->bonificable = $row['basico']+$row['antiguedad'];
                // $liquidacion->no_bonificable = $row['adicional'];
                // $liquidacion->no_remunerativo = 1500;
                // $liquidacion->familiar = $row['hijo']+$row['esposa'];
                // $liquidacion->descuento = $row['aporte_personal']+0;
                // $liquidacion->save();

                //Conceptos de liquidaciones
                // $name_array = explode( '|', $row['detalle']);
                // $detalles = array_chunk($name_array, 5, false);
                // for ($i=0; $i < count($detalles) ; $i++) {
                //     for ($j=0; $j < count($detalles[$i]) ; $j++) { 
                        
                //         $resultado[$i]['cod'] = $detalles[$i][0];
                //         $resultado[$i]['concepto'] = $detalles[$i][1];
                //         $resultado[$i]['unidad'] = $detalles[$i][2];
                //         $resultado[$i]['tipo'] = $detalles[$i][3];
                //         $resultado[$i]['importe'] = $detalles[$i][4];
                        
                     
                //      }
                    

                //     $liquidacion->conceptos()->attach( $resultado[$i]['cod'],[
                //         'unidad' => $resultado[$i]['unidad'],
                //         'importe' => $resultado[$i]['importe']
                //     ]);
                // }

                //Liquidacion Organismos-------------------------------------------------------
                $liquidacion->organismos()->attach($this->declaracionjurada->organismo_id ,[
                    'periodo_id' => $this->declaracionjurada->periodo_id , 
                    'tipo_id' => $this->declaracionjurada->tipoliquidacion_id,
                    'haber_bruto' => $liquidacion->bruto,
                    'total_aporte_personal' => $liquidacion->aporte_personal,
                    'total_sueldo_basico' => $liquidacion->basico, 
                    'total_antiguedad' => ($liquidacion->remunerativo - $liquidacion->basico),
                    'total_adicional' => 1,
                    'total_familiar' => 2,
                    'total_hijo' => 3,
                    'total_esposa' => 4,
                ]);

                //Nueva Categoria, Clase y Jurisdiccion-------------------------------------------------------------------
                // $categoria = Categoria::where('cod_categoria', $declaracionjurada_detalle->cod_categoria);
                // if ($categoria->doesntExist()) {
                //     $categoria1 = Categoria::create([
                //         'cod_categoria' => $declaracionjurada_detalle->cod_categoria,
                //         'categoria' => $declaracionjurada_detalle->categoria,
                //     ]);
                //     //Clase------------------------------------------------------------------------
                //     $clase1 = New Clase();
                //     $clase1->cod_clase = $declaracionjurada_detalle->cod_clase;
                //     $clase1->categoria_id = $categoria1->id;
                //     $clase1->clase = $declaracionjurada_detalle->clase;
                //     $clase1->save();
                //     //Jurisdiccion------------------------------------------------------------------
                //     $jurisdiccion = Jurisdiccion::where('cod_jurisdiccion', $declaracionjurada_detalle->cod_jurisdiccion);
                //     if ($jurisdiccion->doesntExist()) {
                //         $jurisdiccion1 = Jurisdiccion::create([
                //             'cod_jurisdiccion' => $declaracionjurada_detalle->cod_jurisdiccion,
                //             'jurisdiccion' => $declaracionjurada_detalle->jurisdiccion,
                //             'origen_id' => $declaracionjurada_detalle->cod_origen,
                //         ]);
                //     }else{
                //         $jurisdiccion1 = $jurisdiccion->first();
                //     }
                //     $categoria1->jurisdicciones()->attach($jurisdiccion1->id);
                // }else{
                //     $categoria1 = $categoria->first();
                //     $clase = Clase::where('cod_clase', $declaracionjurada_detalle->cod_clase);
                //     if ($clase->doesntExist()) {
                //         $clase1 = Clase::create([
                //             'cod_clase' => $declaracionjurada_detalle->cod_clase,
                //             'clase' => $declaracionjurada_detalle->clase,
                //             'categoria_id' => $categoria1->cod_categoria,
                //         ]);
                //     } else {
                //         $clase1 = $clase->first();
                //     }
                // }


                //Agentes------------------------------------------------------------------
                // $agente = Agente::where('cuil', $declaracionjurada_detalle->cuil);
                // if ($agente->doesntExist()) {
                //     $agente1 = Agente::create([
                //         'nombre' => $declaracionjurada_detalle->nombre,
                //         'cuil' => $declaracionjurada_detalle->cuil,
                //         'fecha_nac' => date("Y-m-d", strtotime($declaracionjurada_detalle->fecha_nac)),
                //         'sexo' => $declaracionjurada_detalle->sexo,
                //     ]);
                // }else{
                //     $agente1 = $agente->first();
                // }


                //Puesto Laboral----------------------------------------------------------------------------------
                // $puesto_laboral = PuestoLaboral::where('cod_laboral', $declaracionjurada_detalle->puesto_laboral);
                // if ($puesto_laboral->doesntExist()) {
                //     $agente1->organismos()->attach($this->declaracionjurada->organismo_id,[
                //         'cod_laboral' => $declaracionjurada_detalle->puesto_laboral,
                //         'fecha_ingreso' => date("Y-m-d", strtotime($declaracionjurada_detalle->fecha_ingreso)),
                //         'fecha_egreso' => null,
                //     ]);
                //     $puesto_laboral1 = $agente1->puestolaborales->first();
                // } else{
                //     $puesto_laboral1 = $puesto_laboral->first();
                // }
                

                //puesto laborales-------------------------------------------------------------------------------------
                // $puesto_laboral1->clases()->attach($clase1->id,[
                //     'fecha_inicio' => date("Y-m-d", strtotime($declaracionjurada_detalle->fecha_ingreso)),
                //     'fecha_fin' => now()->endOfMonth()->modify('0 month')->toDateString(),
                // ]);

                
                //$historia_laboral = $puesto_laboral1->historialaborales->first();
                // $historia_laboral = HistoriaLaboral::where('puesto_id', $declaracionjurada_detalle->puesto_laboral)
                //                                      ->where('clase_id' , $declaracionjurada_detalle->cod_clase)
                //                                      ->first();

                
                //liquidaciones con Historias laborales-----------------------------------------------------------------
                // $liquidacion->historia_laborales()->attach($historia_laboral->id,[ 
                //     'estado_id' => $declaracionjurada_detalle->cod_estado , 
                //     'funcion_id' => null
                // ]);


                //Conceptos de liquidaciones
                // $name_array = explode( '|', $row['detalle']);
                // $detalles = array_chunk($name_array, 5, false);
                // for ($i=0; $i < count($detalles) ; $i++) {
                //     for ($j=0; $j < count($detalles[$i]) ; $j++) { 
                        
                //         $resultado[$i]['cod'] = $detalles[$i][0];
                //         $resultado[$i]['concepto'] = $detalles[$i][1];
                //         $resultado[$i]['unidad'] = $detalles[$i][2];
                //         $resultado[$i]['tipo'] = $detalles[$i][3];
                //         $resultado[$i]['importe'] = $detalles[$i][4];
                        
                     
                //      }
                    

                //     $liquidacion->conceptos()->attach( $resultado[$i]['cod'],[
                //         'unidad' => $resultado[$i]['unidad'],
                //         'importe' => $resultado[$i]['importe']
                //     ]);
                // }


                // $liquidacion->conceptos()->attach(1,['unidad' => '30 dias','importe' => 50000]);
                // $liquidacion->conceptos()->attach(2,['unidad' => '34 años','importe' => 20000]);
                // $liquidacion->conceptos()->attach(3,['unidad' => null,     'importe' => 50000]);
                // $liquidacion->conceptos()->attach(4,['unidad' => '30 %',   'importe' => 10000]);
                // $liquidacion->conceptos()->attach(5,['unidad' => null,     'importe' => 50000]);
                // $liquidacion->conceptos()->attach(6,['unidad' => '18,5 %', 'importe' => 9250]);
                // $liquidacion->conceptos()->attach(7,['unidad' => '5%',     'importe' => 2500]);
                // $liquidacion->conceptos()->attach(8,['unidad' => '1',      'importe' => 1000]);
                // $liquidacion->conceptos()->attach(9,['unidad' => null,     'importe' => 100]);
                    





            }//end foreach

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
            '*.cod_categoria' =>['required','integer'],
            '*.categoria' =>['required'],
            '*.cod_clase' =>['required','integer'],
            '*.clase' =>['required'],
            '*.cod_estado' =>['required','integer'],
            '*.estado' =>['required'],
            '*.cod_jurisdiccion' =>['required','integer'],
            '*.jurisdiccion' =>['required'],
            '*.cod_organismo' =>['required','integer'],
            '*.organismo' =>['required'],
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
        } catch (\Exception $e) {
            $this->failed($e);
            //\Log::info('Exception:'.$exception->getMessage());
        } catch(\ErrorException $e){
            $this->failed($e);
            //\Log::info('ErrorException:'.$exception->getMessage());
        } catch(\Throwable $e){
            $this->failed($e);
            //\Log::info('Throwable:'.$exception->getMessage());
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
        \Log::debug('excepcion personalizado:'.$exception->getMessage());
        event(new FailedImport($exception->getMessage()));
        // etc...
    }


}
