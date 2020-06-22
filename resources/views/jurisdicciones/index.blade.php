@extends('admin.app')
@section('body')

    <div class="row">
        <div class="col">
            <h1>Jurisdicciones</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-success" href="{{ route('jurisdicciones.create') }}">Crear nueva jurisdicción</a>
        </div>
    </div>

    <br>
    {{ $jurisdicciones->links() }}

        <jurisdiccion-component></jurisdiccion-component>

@endsection
