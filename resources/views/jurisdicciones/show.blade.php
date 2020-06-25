@extends('admin.app')
@section('body')
    <div class="card">
        <div class="card-header">
            <h1>{{ $jurisdiccion->jurisdiccion }}</h1>
        </div>
        <div class="card-body">
            <div class="one">
                <table class="table table-bordered table-dark" >
                    @include('jurisdicciones._buttons')
                </table>
            </div>
            <table class="table border-rounded table-sm">
                <tr>
                    <td class="table-dark td-title" style="width: 15%; text-align: right">Id:</td>
                    <td class="td-content">{{ $jurisdiccion->id }}</td>

                    <td class="table-dark td-title" style="width: 15%; text-align: right">Cod.:</td>
                    <td class="td-content">{{ $jurisdiccion->cod_jurisdiccion }}</td>
                </tr>
                <tr>
                    <td class="table-dark td-title" style="width: 15%; text-align: right">Descripción:</td>
                    <td class="td-content">{{ $jurisdiccion->jurisdiccion }}</td>

                    <td class="table-dark td-title" style="width: 15%; text-align: right">Origen:</td>
                    <td class="td-content">{{ $jurisdiccion->origen_id }}</td>
                </tr>
                <tr>
                    <td class="table-dark td-title" style="width: 15%; text-align: right">Creado:</td>
                    <td class="td-content">{{ $jurisdiccion->created_at }}</td>

                    <td class="table-dark td-title" style="width: 15%; text-align: right">Modificado:</td>
                    <td class="td-content">{{ $jurisdiccion->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
