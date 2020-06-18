@extends('admin.app')
@section('body')
    <div class="container border-primary justify-content-center"  style="max-width: 40rem;">
        <div class="card-header">
            <h1>Crear Categorías</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('categorias.store') }}" class="form-group" method="POST">
                @include('categorias._form')
            </form>
        </div>
    </div>
@endsection
