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
    <table class="table border-rounded table-striped">
        <thead class="thead-dark">
            <tr style="text-align: center;">
                <th scope="col">Id.</th>
                <th scope="col">cod.</th>
                <th scope="col">Descripción</th>
                <th scope="col">Origen</th>
                <th scope="col">Creación</th>
                <th scope="col">Modificación</th>
                <th scope="col" nowrap colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurisdicciones as $jurisdiccion)
                <tr style="text-align: center;">
                    <td>{{ $jurisdiccion->id }}</td>
                    <td>{{ $jurisdiccion->cod_jurisdiccion }}</td>
                    <td>{{ $jurisdiccion->jurisdiccion }}</td>
                    <td>{{ $jurisdiccion->origen_id }}</td>
                    <td>{{ $jurisdiccion->created_at }}</td>
                    <td>{{ $jurisdiccion->updated_at }}</td>
                    @include('jurisdicciones._buttons')
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
