<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LiquidacionsExport;
use App\Imports\LiquidacionsImport;
use App\DeclaracionJurada;
use Validator;

class ExcelController extends Controller
{
    
    
    

    public function indexImport(){
    	return view('file.import');
    }

    


    public function indexExport(){
    	return view('file.export');
    }

    


    public function import(Request $request){
    	if ($request->hasFile('file')) {
        	$file = $request->file('file');
        	$rules = ['file' => 'file|mimes:csv,txt'];
        	$validator = Validator::make($request->all(), $rules);
	        if (!$validator->fails()) {
	        	$message = 'El archivo esta siendo importado';
	        	$status = 200;
                $ddjj_id = DeclaracionJurada::insertGetId([
                                'user_id' => 1,
                                'organismo_id' => 30,
                                'secuencia' => 6,
                            ]);
                (new LiquidacionsImport($ddjj_id))->queue($file,null,\Maatwebsite\Excel\Excel::CSV);
	        } else {
	            $message = 'Tipo de Archivo selecciona es invalido. Debe ser extension .csv o .txt';
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
