@extends('admin.app')
@section('body')
    <div class="container border-primary justify-content-center"  style="max-width: 40rem;">
        <div class="card-header">
            <h1>Editar {{ $categoria->categoria }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('categorias.update', $categoria) }}" class="form-group" method="POST">
                @method('PUT')
                @include('categorias._form')
            </form>
        </div>
    </div>
@endsection
