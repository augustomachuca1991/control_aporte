<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LiquidacionsExport;
use App\Imports\LiquidacionsImport;
use App\Jobs\DeleteFileJob;
use App\{DeclaracionJurada,Periodo,TipoLiquidacion,Organismo,User};
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile; 
use Illuminate\Support\Facades\Storage;

class ExcelController extends Controller
{
    
    // public function __construct(){
    //     $this->middleware('admin');
    // }


    

    public function indexImport(){
        $user = Auth::user();
    	return view('file.import',compact('user'));
    }

    


    public function indexExport(){
    	return view('file.export');
    }

    


    public function import(Request $request){

        //recupero usuario autenticado y declaracion jurada;
        $user = User::find( $request->user['id']);
        $declaracionjurada = DeclaracionJurada::find($request->id);


        //recupero path del archivo a importar;
        $path = Storage::url($request->path);
        $file = Storage::putFileAs('public', new File("./".$path), 'import.csv');
        
        
        //Importa el archivo
        $import = new LiquidacionsImport($declaracionjurada);
        //$deleteFileJob = new DeleteFileJob($declaracionjurada);
        // $import->queue($file)->chain([new CompletedImport,new NotificationJob($user)]);
        $import->queue($file);
        return $declaracionjurada;
        
    }

    


    public function export(Request $request){
    	$cod_periodo = $request->periodo;
        // if ($cod_periodo != null) {
        //     $name= 'Liquidacion'.strtotime(now()).'.csv';
        //     $liquidaciones = new LiquidacionsExport($cod_periodo);
        //     $liquidaciones
        //     ->store($name,'local',\Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv'])
        //     ->chain([new CompletedExport]);
        //     $message = 'Exportando Archivo';
        //     $status = 1;
        // } else {
        //     $message ='Debe seleccionar un periodo de liquidación';
        //     $status = 0;
        // }
    	
        // return response()->json(['message'=> $message, 'status' => $status]);
    }


    



    
    	
}
