<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LiquidacionsExport;
use App\Imports\LiquidacionsImport;
use App\Jobs\CompletedImport;
use App\DeclaracionJurada;
//use Illuminate\Support\Facades\Auth;
use Validator;

class ExcelController extends Controller
{
    
    //public function __construct(){
    //    $this->middleware('auth');
    //}

    public function indexImport(){
    	return view('file.import');
    }

    


    public function indexExport(){
    	return view('file.export');
    }

    


    public function import(Request $request){
        //dd($request);
    	if ($request->hasFile('file')) {
            $file = $request->file('file');
        	$name = explode( '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));//obtiene nombre de archivo sin extension
            $validar = ['file' => $file, 
                        'name' => $name,
                        //'secuencia' => $name[3],
                        ];
            $rules = ['file' => 'file|mimes:csv,txt',
                      'name' => 'array|max:4|min:3',
                      'name.0' => 'string|exists:organismos,organismo',
                      'name.1' => 'integer|exists:periodos,cod_periodo|digits:6',
                      'name.2' => 'string|exists:tipo_liquidacions,descripcion',
                      //'secuencia' => 'integer',
                     ];
            //$messages = [
            //                'array' => 'Nombre de Archivo no tiene el formato correcto',
            //            ];
        	$validator = Validator::make($validar, $rules);
	        if (!$validator->fails()) {
	        	$message = 'Importando Archivo';
	        	$status = 200;
                //$name = $file->getClientOriginalName();
                $ddjj_id = DeclaracionJurada::insertGetId([
                                'user_id' => 1,
                                'periodo_id' => 202005,
                                'tipoliquidacion_id' => 1,
                                'organismo_id' => 1,
                                'secuencia' => 2,
                                'created_at' => now(),
                            ]);
                (new LiquidacionsImport($ddjj_id))
                ->queue($file,null,\Maatwebsite\Excel\Excel::CSV)
                ->chain([new CompletedImport]);
	        } else {
	            $message = $validator->errors()->first();
	            $status = 300;
	        }
	    } else {
	        $message = 'Debe Seleccionar un archivo';
	        $status = 301;
	    }
    	return response()->json(['message'=> $message, 'status' => $status, ]);
    }

    


    public function export(Request $request){
    	$cod = $request->periodo;
    	if ($request->periodo != null) {
    		$message ='Codigo seleccionado '.$cod;
    		$status = 200;
    	} else {
    		$message ='Debe Seleccionar un Periodo';
    		$status = 301;
    	}
    	
    	return response()->json(['message'=> $message, 'status' => $status, 'codigo_periodo' => $cod ]);
    }
}
