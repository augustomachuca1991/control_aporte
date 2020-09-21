<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LiquidacionsExport;
use App\Imports\LiquidacionsImport;
use App\Jobs\CompletedImport;
use App\{DeclaracionJurada,Periodo,TipoLiquidacion,Organismo};
// use Illuminate\Support\Facades\Auth;
use Validator;

class ExcelController extends Controller
{
    
    // public function __construct(){
    //     $this->middleware('admin');
    // }


    

    public function indexImport(){
    	return view('file.import');
    }

    


    public function indexExport(){
    	return view('file.export');
    }

    


    public function import(Request $request){
    	// if ($request->hasFile('file')) {
     //        $file = $request->file('file');
     //        $name = explode( '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));//obtiene nombre de archivo sin extension
     //        $validar = ['file' => $file, 
     //                    'name' => $name,
     //                    'organismo' => $name[0],
     //                    'periodo' => $name[1],
     //                    'tipo_liquidacion' => $name[2],
     //                    'secuencia' => $name[3],
     //                    ];
     //        $rules = ['file' => 'file|mimes:csv,txt',
     //                  'name' => 'array|max:4|min:3',
     //                  'organismo' => 'string|exists:organismos,organismo',
     //                  'periodo' => 'integer|exists:periodos,cod_periodo|digits:6',
     //                  'tipo_liquidacion' => 'string|exists:tipo_liquidacions,descripcion',
     //                  'secuencia' => 'integer',
     //                 ];
     //        $validator = Validator::make($validar, $rules);
     //        if (!$validator->fails()) {
     //            $message = 'Importando Archivo';
     //            $status = 200;
     //            $ddjj_id = DeclaracionJurada::insertGetId([
     //                            'user_id' => $request->id,
     //                            'periodo_id' => 202005,
     //                            'tipoliquidacion_id' => 1,
     //                            'organismo_id' => 1,
     //                            'secuencia' => 2,
     //                            'created_at' => now(),
     //                        ]);
     //            (new LiquidacionsImport($ddjj_id))
     //            ->queue($file,null,\Maatwebsite\Excel\Excel::CSV)
     //            ->chain([new CompletedImport]);
     //        } else {
     //            $message = $validator->errors()->first();
     //            $status = 900;
     //        }
	    // } else {
	    //     $message = 'Debe Seleccionar un archivo';
     //        $status = 900;
	    // }
        $file = $request->file('file');
        $name = explode( '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));//obtiene nombre de archivo sin extension
        $count = count($name);
        if ($count >= 3) {
            if ($count == 3) {
                $name[3] = null;
            }
            $validacion = [
                'archivo' => $file,
                'nombre' => $name,
                'organismo' => $name[0],
                'periodo' => $name[1],
                'tipo_liquidacion' => $name[2],
                'secuencia' => $name[3]
            ];
            $reglas = [
                'archivo' => 'file|mimes:csv,txt',
                'nombre' => 'required|array|max:4',
                'organismo' => 'exists:organismos,organismo',
                'periodo' => 'exists:periodos,cod_periodo',
                'tipo_liquidacion' => 'exists:tipo_liquidacions,descripcion',
                'secuencia' => 'integer|nullable'
            ];
            $mensajes = [
                'archivo.file' => 'Debe Seleccionar un archivo',
                'archivo.mimes' => 'El tipo de archivo esincorrecto. Debe ser .csv o .txt',
                'nombre.required' => 'Nombre Requerido',
                'nombre.array' => 'El nombre no cumple con el formato. El mismo debe ser ej: organimo_periodo_tipoliquidacion_secuencia.csv',
                'nombre.max' => 'El nombre no cumple con el formato. El mismo debe tener como maximo 4 elementos',
                'organismo.exists' => 'El organismo no existe o no esta escrito correctamente',
                'periodo.exists' => 'El codigo de periodo no existe',
                'tipo_liquidacion.exists' => 'Tipo de Liquidacion no existe. Verifique',
                'secuencia.integer' => 'El numero secuencia debe ser un entero o bien nulo',
            ];
            $validator = Validator::make($validacion, $reglas, $mensajes);
            if ($validator->fails()) {
                $message = $validator->errors()->first();
                $status = 0;
            }else{
                $periodo_id = $name[1];
                $tipoliquidacion_id = TipoLiquidacion::where('descripcion',$name[2])->first()->id;
                $organismo_id = Organismo::where('organismo',$name[0])->first()->cod_organismo;
                $secuencia = $name[3];
                $message = 'Importando Archivo';
                $status = 1;
                $ddjj_id = DeclaracionJurada::insertGetId([
                               'user_id' => 1,
                               'periodo_id' => $periodo_id,
                               'tipoliquidacion_id' => $tipoliquidacion_id,
                               'organismo_id' => $organismo_id,
                               'secuencia' => $secuencia,
                               'created_at' => now(),
                               'updated_at' => now(),
                           ]);
                (new LiquidacionsImport($ddjj_id))
                ->queue($file,null,\Maatwebsite\Excel\Excel::CSV)
                ->chain([new CompletedImport]);
            }
            
        }else{
            $message = 'El nombre no cumple con el formato. El mismo debe tener como minimo 3 elementos';
            $status = 0;
        }
        
        return response()->json(['message'=> $message, 'status' => $status, 'user' => $request]);
    }

    


    public function export(Request $request){
    	$cod = $request->periodo;
        if ($request->periodo != null) {
            $message ='Codigo seleccionado '.$cod;
            $status = 1;      
        } else {
            $message ='Debe Seleccionar un Periodo';
            $status = 0;
        }
    	
    	return response()->json(['message'=> $message, 'status' => $status, 'codigo_periodo' => $cod]);
    }
}
