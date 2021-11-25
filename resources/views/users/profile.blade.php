@extends('adminlte::page')

@section('title', 'Perfile de usuario')

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
@stop

@section('right-sidebar')
    @include('layouts.right_sidebar')
@stop

@section('content_header')
<nav aria-label="breadcrumb">
   <ol class="breadcrumb">
     <li class="breadcrumb-item"><a href="{{route('home')}}"> <i class="fas fa-home"></i> Panel</a></li>
     <li class="breadcrumb-item active" aria-current="page">{{__('Profile')}}</li>
   </ol>
 </nav>
@stop


@section('content')
 <div id="app">
    {{-- <h1>
        hola {{$auth}}
    </h1> --}}
    <section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="{{$auth->adminlte_image()}}" alt="{{$auth->name}}">
                </div>

                <h3 class="profile-username text-center">{{$auth->name}}</h3>

                <p class="text-muted text-center">{{implode(',' ,  $auth->roles->pluck('name')->all())}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$auth->email}}</a>
                </li>
                <li class="list-group-item">
                    <b>Telefono</b> <a class="float-right">-</a>
                </li>
                <li class="list-group-item">
                    <b>Permisos</b> 
                    @foreach ($auth->getAllPermissions() as $permiso)
                        
                    <a class="float-right ml-1"><span class="badge bg-red"> {{$permiso->name}}</span></a>
                    @endforeach
                </li>
                </ul>

                <a href="#" class="btn btn-info btn-block"><b>Editar</b></a>
            </div>
            <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
            <div class="card-header p-2">
                Editar
            </div><!-- /.card-header -->
            <div class="card-body">
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputName" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Telefo</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" placeholder="Telefo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Aptitudes</label>
                        <div class="col-sm-10">
                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-info">Confirmar</button>
                        </div>
                    </div>
                    </form>
            </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
 </div>
@stop




@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop 
