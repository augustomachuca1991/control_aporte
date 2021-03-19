<?php

namespace App\Http\Controllers;

//use App\{DeclaracionJurada,Liquidacion,Agente,PuestoLaboral,Clase,Categoria,HistoriaLaboral,Jurisdiccion};
use App\{DeclaracionJurada,Periodo,TipoLiquidacion,Organismo,User};
use Illuminate\Http\Request;
use App\Jobs\LiquidacionJob;
use Illuminate\Support\Facades\Auth;
use Validator;

class DeclaracionJuradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user = Auth()->user;
        return view('declaraciones_juradas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //asignamos variables
        $file = $request->file('file');
        $user_id = $request->user_id;
        $file_storage = $file->store('public');
        $name = explode( '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $original_name = $file->getClientOriginalName();
        $count = count($name);
        



        //validamos si existe si la cadena contiene numero de secuencia
        if ($count === 3) {
            $name[3] = null;
        }



        //se valida el archivo a subir
            $validacion = [
                'archivo' => $file,
                'original_name' => $original_name,
                'nombre' => $name,
                'organismo' => $name[0],
                'periodo' => $name[1],
                'tipo_liquidacion' => $name[2],
                'secuencia' => $name[3],
            ];
            $reglas = [
                'archivo' => 'file|mimes:csv,txt',
                'original_name' => 'unique:declaracion_juradas,nombre_archivo',
                'nombre' => 'required|array|max:4',
                'organismo' => 'exists:organismos,organismo',
                'periodo' => 'exists:periodos,cod_periodo',
                'tipo_liquidacion' => 'exists:tipo_liquidacions,descripcion',
                'secuencia' => 'integer|nullable'
            ];
            $mensajes = [
                'archivo.file' => 'Debe Seleccionar un archivo',
                'archivo.mimes' => 'El tipo de archivo es incorrecto. Debe ser .csv o .txt',
                'original_name.unique' => 'Esta intentando importar un archivo ya existente',
                'nombre.required' => 'Nombre Requerido',
                'nombre.array' => 'El nombre no cumple con el formato. El mismo debe ser ej: organimo_periodo_tipoliquidacion_secuencia.csv',
                'nombre.max' => 'El nombre no cumple con el formato. El mismo debe tener como maximo 4 elementos',
                'organismo.exists' => 'El organismo no existe o no esta escrito correctamente',
                'periodo.exists' => 'El codigo de periodo no existe',
                'tipo_liquidacion.exists' => 'Tipo de Liquidacion no existe. Verifique',
                'secuencia.integer' => 'El numero secuencia debe ser un entero',
            ];
            $validator = Validator::make($validacion, $reglas, $mensajes);


            // si no pasa la validacion arroja mensaje caso contrario crea una nueva declaracion jurada
            if ($validator->fails()) {
                $mensajes = $validator->errors()->first();
                return response()->json(['data' => $mensajes , 'status' => false]);
            }else{

                $organismo_id = Organismo::where('organismo',$name[0])->first()->cod_organismo;
                $periodo_id = $name[1];
                $tipoliquidacion_id = TipoLiquidacion::where('descripcion',$name[2])->first()->id;
                $secuencia = 1;
                $new_declaracionjurada = DeclaracionJurada::create([
                               'user_id' => $user_id,
                               'periodo_id' => $periodo_id,
                               'tipoliquidacion_id' => $tipoliquidacion_id,
                               'organismo_id' => $organismo_id,
                               'secuencia' => $secuencia,
                               'path' => $file_storage,
                               'nombre_archivo' => $original_name,
                               'status' => true,
                           ]);
                $declaracionjurada = $this->show($new_declaracionjurada->id);

                return response()->json(['data' => $declaracionjurada, 'status' => true]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $declaracionjurada = DeclaracionJurada::with(['organismo', 'user','periodo', 'tipoliquidacion'])
                            ->where('id', $id)->first();
        return $declaracionjurada;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function edit(DeclaracionJurada $declaracionJurada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeclaracionJurada $declaracionJurada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $declaracionJurada = DeclaracionJurada::find($id);
        
    }

    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function getDeclaracionesJuradas(){
        // return DeclaracionJurada::whereHas('ddjj_lines')->with(
        //     ['organismo', 'user','periodo', 'tipoliquidacion']
        // )->orderBy('id', 'desc')->get();
        return DeclaracionJurada::with(['organismo', 'user','periodo', 'tipoliquidacion'])
        ->latest()->get();
    }

    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $pathToFile = \Storage::url('app/'.$request->path);
        $header = ['Content-Type' => 'text/csv'];
        return response()->download('..'.$pathToFile, 'descarga.csv',$header);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function search($buscar)
    {   
        
            
            return DeclaracionJurada::whereHas('user', function($query) use($buscar){
                        $query->where('name','LIKE',"%".$buscar."%");
                })->orWhereHas('periodo', function($query) use($buscar){
                        $query->where('periodo','LIKE',"%".$buscar."%");
                })->orWhereHas('tipoliquidacion', function($query) use($buscar){
                        $query->where('descripcion','LIKE',"%".$buscar."%");
                })->orWhereHas('organismo', function($query) use($buscar){
                        $query->where('organismo','LIKE',"%".$buscar."%");
                })
            ->with(['organismo', 'user','periodo', 'tipoliquidacion'])
            //->orWhere('periodo_id' ,'LIKE' ,"%".$search."%")
            ->get();
        
        
    }


    public function recientes(Request $request){
        return DeclaracionJurada::with(['organismo', 'user','periodo', 'tipoliquidacion'])->latest()->take(4)->get();
    }

}
