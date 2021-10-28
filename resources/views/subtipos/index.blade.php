@extends('adminlte::page')

@section('title', 'Declaracion Jurada')

<!-- @section('plugins.Sweetalert2', true) -->

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <style>
        .hr-sect {
            display: flex;
            flex-basis: 100%;
            align-items: center;
            color: rgba(0, 0, 0, 0.35);
            margin: 8px 0px;
        }

        .hr-sect:before,
        .hr-sect:after {
            content: "";
            flex-grow: 1;
            background: rgba(0, 0, 0, 0.35);
            height: 1px;
            font-size: 0px;
            line-height: 0px;
            margin: 0px 8px;
        }

    </style>
@stop

@section('right-sidebar')
    @include('layouts.right_sidebar')
@stop

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="fas fa-home"></i> Panel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Subtipos de Codigos</li>
        </ol>
    </nav>
@stop


@section('content')
    <div id="app">

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="hr-sect capitalize">
                        <h4 class="uppercase">SUBTIPOS DE CODIGOS</h4>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subtipo</th>
                                <th>Cod Tipo</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-primary">
                                <th scope="row">1</th>
                                <td>Esposa</td>
                                <td>No Remunerativo</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-secondary">
                                <th scope="row">1</th>
                                <td>Esposa</td>
                                <td>Remunarativo Bonificable</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <label class="form-check-label" for="exampleCheck2">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-success">
                                <th scope="row">1</th>
                                <td>Esposa</td>
                                <td>Remunerativo</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck3">
                                    <label class="form-check-label" for="exampleCheck3">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-danger">
                                <th scope="row">1</th>
                                <td>Salario Familiar</td>
                                <td>Adicional Social</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck4">
                                    <label class="form-check-label" for="exampleCheck4">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-warning">
                                <th scope="row">1</th>
                                <td>Salario Familiar</td>
                                <td>Remunarativo</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck5">
                                    <label class="form-check-label" for="exampleCheck5">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-info">
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Descuento</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck6">
                                    <label class="form-check-label" for="exampleCheck6">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-primary">
                                <th scope="row">1</th>
                                <td>Antiguedad</td>
                                <td>No Remunerativo</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-secondary">
                                <th scope="row">1</th>
                                <td>Sueldo Basico</td>
                                <td>Remunarativo Bonificable</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <label class="form-check-label" for="exampleCheck2">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-success">
                                <th scope="row">1</th>
                                <td>Sobre Remunerativo</td>
                                <td>Remunerativo</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck3">
                                    <label class="form-check-label" for="exampleCheck3">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-danger">
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Adicional Social</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck4">
                                    <label class="form-check-label" for="exampleCheck4">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-warning">
                                <th scope="row">1</th>
                                <td>Adicional</td>
                                <td>Remunarativo</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck5">
                                    <label class="form-check-label" for="exampleCheck5">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-info">
                                <th scope="row">1</th>
                                <td>Adicional</td>
                                <td>Descuento</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck6">
                                    <label class="form-check-label" for="exampleCheck6">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-primary">
                                <th scope="row">1</th>
                                <td>Aportes Jubilatorio</td>
                                <td>No Remunerativo</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-secondary">
                                <th scope="row">1</th>
                                <td>Otros</td>
                                <td>Remunarativo Bonificable</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <label class="form-check-label" for="exampleCheck2">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-success">
                                <th scope="row">1</th>
                                <td>Otros</td>
                                <td>Remunerativo</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck3">
                                    <label class="form-check-label" for="exampleCheck3">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-danger">
                                <th scope="row">1</th>
                                <td>Otros</td>
                                <td>Adicional Social</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck4">
                                    <label class="form-check-label" for="exampleCheck4">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-warning">
                                <th scope="row">1</th>
                                <td>Hijo</td>
                                <td>Remunarativo</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck5">
                                    <label class="form-check-label" for="exampleCheck5">Check me out</label>
                                </td>
                            </tr>
                            <tr class="table-info">
                                <th scope="row">1</th>
                                <td>Hijo</td>
                                <td>Descuento</td>
                                <td><input type="checkbox" class="form-check-input" id="exampleCheck6">
                                    <label class="form-check-label" for="exampleCheck6">Check me out</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>
@stop



@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@stop
