@extends('adminlte::page')

@section('title', 'Conceptos')

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
            <li class="breadcrumb-item active" aria-current="page">Conceptos</li>
        </ol>
    </nav>

@stop


@section('content')
    <div id="app">
        <concepto-component :user="{{ $user }}"></concepto-component>
    </div>
@stop



@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop
