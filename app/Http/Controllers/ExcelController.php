<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LiquidacionsExport;
use App\Imports\LiquidacionsImport;
use App\{DeclaracionJurada, Notification};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ExcelController extends Controller
{

    protected $auth;

    public function __construct()
    {
        //$this->middleware('auth');
        $this->auth = Auth::user();
    }




    public function indexImport()
    {
        $user = Auth::user();
        return view('file.import', compact('user'));
    }




    public function indexExport()
    {
        return view('file.export');
    }




    public function import(Request $request)
    {


        $declaracionjurada = DeclaracionJurada::find($request->id);
        $declaracionjurada->apply = true;
        $declaracionjurada->save();
        $path = Storage::url($request->path);
        $file = Storage::putFileAs('public', new File("./" . $path), 'import.csv');
        $import = new LiquidacionsImport($declaracionjurada);
        $import->queue($file);
        return $declaracionjurada;
    }




    public function export(Request $request)
    {
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
