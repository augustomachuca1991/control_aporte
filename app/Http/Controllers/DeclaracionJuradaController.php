<?php

namespace App\Http\Controllers;

//use App\{DeclaracionJurada,Liquidacion,Agente,PuestoLaboral,Clase,Categoria,HistoriaLaboral,Jurisdiccion};
use App\{DeclaracionJurada, DeclaracionJuradaLine, Notification, Periodo, TipoLiquidacion, Organismo, User};
use Illuminate\Http\Request;
use App\Jobs\LiquidacionJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DeclaracionJuradaController extends Controller
{
    public $organismo_id;
    public $periodo_id;
    public $tipoliquidacion_id;
    public $secuencia;
    public $perPage = 10;

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
        $name = explode('_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $original_name = $file->getClientOriginalName();
        $count = count($name);


        //validamos si existe si la cadena contiene numero de secuencia
        if ($count === 5) {
            $name[5] = null;
        }



        //se valida el archivo a subir
        $validacion = [
            'archivo' => $file,
            'original_name' => $original_name,
            'nombre' => $name,
            'origen' => $name[0],
            'jurisdiccion' => $name[1],
            'organismo' => $name[2],
            'periodo' => $name[3],
            'tipo_liquidacion' => $name[4],
            'secuencia' => $name[5],
        ];
        $reglas = [
            'archivo' => 'file|mimes:csv,txt',
            'original_name' => 'unique:declaracion_juradas,nombre_archivo',
            'nombre' => 'required|array|max:6',
            'origens' => 'exists:origens,cod_origen',
            'jurisdiccion' => 'exists:jurisdiccions,cod_jurisdiccion',
            'organismo' => 'exists:organismos,cod_organismo',
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
            'jurisdiccion.exists' => 'El cod Jurisdiccion no existe o no esta escrito correctamente',
            'origen.exists' => 'El cod Origen no existe o no esta escrito correctamente',
            'organismo.exists' => 'El cod organismo no existe o no esta escrito correctamente',
            'periodo.exists' => 'El codigo de periodo no existe',
            'tipo_liquidacion.exists' => 'Tipo de Liquidacion no existe. Verifique',
            'secuencia.integer' => 'El numero secuencia debe ser un entero',
        ];
        $validator = Validator::make($validacion, $reglas, $mensajes);


        // si no pasa la validacion arroja mensaje caso contrario crea una nueva declaracion jurada
        if ($validator->fails()) {
            $data = $validator->errors()->first();
            $status = false;
            $confirm = false;
        } else {

            $this->organismo_id = Organismo::where('cod_organismo', $name[2])->first()->cod_organismo;
            $this->periodo_id = $name[3];
            $this->tipoliquidacion_id = TipoLiquidacion::where('descripcion', $name[4])->first()->id;
            $this->secuencia = $name[5];
            $is_declaradionjurada = DeclaracionJurada::where('periodo_id', $this->periodo_id)->where('tipoliquidacion_id', $this->tipoliquidacion_id)->where('organismo_id', $this->organismo_id);
            if ($is_declaradionjurada->doesntExist()) {
                $declaracionJurada = DeclaracionJurada::create([
                    'user_id' => $user_id,
                    'periodo_id' => $this->periodo_id,
                    'tipoliquidacion_id' => $this->tipoliquidacion_id,
                    'organismo_id' => $this->organismo_id,
                    'secuencia' => $this->secuencia,
                    'path' => $file_storage,
                    'nombre_archivo' => $original_name,
                    'status' => true,
                    'apply' => false,
                    'rectificar' => false,
                ]);
                $data = $this->show($declaracionJurada->id);
                $status = true;
                $confirm = false;
            } else {
                $declaracionJurada = $is_declaradionjurada->first();
                if ($this->secuencia < $declaracionJurada->secuencia) {
                    $data = 'No es posible es un rectificacion anterior';
                    $status = false;
                    $confirm = false;
                } else {
                    $data = [
                        'id' => $declaracionJurada->id,
                        'user_id' => $user_id,
                        'secuencia' => $this->secuencia,
                        'nombre_archivo' => $original_name,
                        'path' => $file_storage,
                        'status' => true,
                        'rectificar' => true,
                        'apply' => false,
                        'updated_at' => now()
                    ];
                    $status = false;
                    $confirm = true;
                }
            }
        }

        return response()->json(['data' => $data, 'status' => $status, 'confirm' => $confirm]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $declaracionjurada = DeclaracionJurada::with(['organismo', 'user', 'periodo', 'tipoliquidacion', 'ddjj_lines', 'liquidaciones'])
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
    public function update(Request $request, $id)
    {
        $declaracionJurada = DeclaracionJurada::find($id);
        $declaracionJurada->update([
            'user_id' => $request->id,
            'secuencia' => $request->secuencia,
            'nombre_archivo' => $request->nombre_archivo,
            'path' => $request->path,
            'status' => true,
            'rectificar' => true,
            'apply' => false,
            'updated_at' => now()
        ]);
        return $this->show($declaracionJurada->id);
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
        $hasDetalle =  $declaracionJurada->ddjj_lines()->doesntExist();
        if ($hasDetalle) {
            $msj = $declaracionJurada->nombre_archivo . ' se quito de la lista de tareas';
            $isValid = true;
            $declaracionJurada->forceDelete();
        } else {
            $isValid = false;
            $msj = 'No es posible eliminar! esta asociado a varios datos y podria causar una problema al sistemas';
        }

        return response()->json(['isValid' => $isValid, 'msj' => $msj]);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function getDeclaracionesJuradas()
    {
        $user_id = 1;
        $declaracionesJuradas = DeclaracionJurada::with(['organismo', 'user', 'periodo', 'tipoliquidacion', 'ddjj_lines'])
            ->latest()->where('status', false)->paginate($this->perPage);

        return $declaracionesJuradas;
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $pathToFile = storage_path('app/' . $request->path);
        $header = ['Content-Type' => 'text/csv'];
        return response()->download($pathToFile, 'descarga.csv', $header);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeclaracionJurada  $declaracionJurada
     * @return \Illuminate\Http\Response
     */
    public function search($buscar)
    {


        // return DeclaracionJurada::where('status' , false)->whereHas('user', function ($query) use ($buscar) {
        //     $query->where('name', 'LIKE', "%" . $buscar . "%");
        // })->orWhereHas('periodo', function ($query) use ($buscar) {
        //     $query->where('periodo', 'LIKE', "%" . $buscar . "%");
        // })->orWhereHas('tipoliquidacion', function ($query) use ($buscar) {
        //     $query->where('descripcion', 'LIKE', "%" . $buscar . "%");
        // })->orWhereHas('organismo', function ($query) use ($buscar) {
        //     $query->where('organismo', 'LIKE', "%" . $buscar . "%");
        // })
        // ->with(['organismo', 'user', 'periodo', 'tipoliquidacion'])
        // ->paginate($this->perPage);
        return DeclaracionJurada::where('status', false)->where('nombre_archivo', 'LIKE', "%" . $buscar . "%")->with(['organismo', 'user', 'periodo', 'tipoliquidacion'])->paginate($this->perPage);
    }


    public function sinAplicar($user_id)
    {

        return DeclaracionJurada::whereHas('user', function ($query) use ($user_id) {
            $query->where('id', $user_id);
        })->with(['organismo', 'user', 'periodo', 'tipoliquidacion'])->where('status', true)->get();
    }

    public function cast_jsonDecode(DeclaracionJuradaLine $declaracionJuradaLine)
    {
        $declaracionJuradaLine->detalle = json_decode($declaracionJuradaLine->detalle, true);
    }

    public function getFailedNotificationImport($user_id)
    {
        $user = User::find($user_id);
        return $user->unreadNotifications->where('type', 'App\Notifications\FailedRowNotification')->all();
        //return Notification::where('notifiable_id', $user_id)->first()->type;
    }


    public function unReadNotifications(Request $request , $user_id)
    {
        $alert_id = $request->alert_id;
        $user = User::find($user_id);
        //$notification = $user->unreadNotifications->find($alert_id);
        return $user->unreadNotifications->find($alert_id)->update(['read_at' => now()]);
    }
}
