@extends('adminlte::page')

@section('title', 'Importar')

<!-- @section('plugins.Sweetalert2', true)
 -->
@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <style>
        .custom-file-input~.custom-file-label::after {
            content: "Elegir";
        }

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

        .content-box {
            padding: 32px 28px;
            margin: 0 0 20px;
            text-align: center;
            cursor: pointer
        }

        .content-box p {
            margin: 1;
            color: #fff
        }

        .content-box h3 {
            line-height: 26px;
            padding-bottom: 8px;
            color: #fff;
            font-weight: 600
        }

        .content-box i {
            font-size: 80px;
            height: 80px;
            color: #fff;
            margin: 10px 0;
            display: block
        }

        .content-box.color-effect-1 {
            background: #38c782
        }

        .box-icon i {
            display: inline-block;
            font-size: 0;
            cursor: pointer;
            margin: 15px 0;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            text-align: center;
            position: relative;
            z-index: 1;
            color: #fff
        }

        .box-icon i:after {
            pointer-events: none;
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            content: '';
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box
        }

        .box-icon i:before {
            speak: none;
            font-size: 40px;
            line-height: 90px;
            font-style: normal;
            font-weight: 400;
            font-variant: normal;
            text-transform: none;
            display: block;
            -webkit-font-smoothing: antialiased
        }

        .box-icon-effect-1 .box-icon i {
            background: rgba(255, 255, 255, .2);
            color: #fff;
            -webkit-transition: background .2s, color .2s;
            -moz-transition: background .2s, color .2s;
            transition: background .2s, color .2s
        }

        .box-icon-effect-1 .box-icon i:after {
            top: -7px;
            left: -7px;
            padding: 7px;
            box-shadow: 0 0 0 4px #fff;
            -webkit-transition: -webkit-transform .2s, opacity .2s;
            -webkit-transform: scale(.8);
            -moz-transition: -moz-transform .2s, opacity .2s;
            -moz-transform: scale(.8);
            -ms-transform: scale(.8);
            transition: transform .2s, opacity .2s;
            transform: scale(.8);
            opacity: 0
        }

        .content-box:hover .box-icon-effect-1a .box-icon i {
            background: #fff;
            color: #3acf87
        }

        .content-box:hover .box-icon-effect-1a .box-icon i:after {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
            opacity: 1
        }

        .box-icon-effect-2 .box-icon i {
            box-shadow: 0 0 0 4px #fff;
            overflow: hidden;
            -webkit-transition: background .3s, color .3s, box-shadow .3s;
            -moz-transition: background .3s, color .3s, box-shadow .3s;
            transition: background .3s, color .3s, box-shadow .3s;
            color: #fff
        }

        a:link {
            text-decoration: none
        }

    </style>
@stop

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="fas fa-home"></i> Panel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Import</li>
        </ol>
    </nav>
@stop

@section('right-sidebar')
    @include('layouts.right_sidebar')
@stop


@section('content')
    <div id="app">
        <import-component :user="{{ $user }}"></import-component>
    </div>
@stop



@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script>
        // Pusher.logToConsole = true;
        var pusher = new Pusher('fc71604184ab3f47bf1c', {
            cluster: 'eu'
        });
        //exito
        var channel = pusher.subscribe('canal-import');
        channel.bind('event-import', function(data) {

            Swal.fire(
                data.message,
                'Exito!!!',
                'success'
            ).then(function() {
                window.location.reload();
            })
        });
        //fracaso
        var channel = pusher.subscribe('canalfailed-import');
        channel.bind('eventfailed-import', function(data) {
            Swal.fire(
                data.message,
                'error',
                'error'
            ).then(function() {
                window.location.reload();
            })
        });
    </script>
@stop
