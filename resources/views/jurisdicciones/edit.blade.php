@extends('admin.app')
@section('body')
    <div class="container border-primary justify-content-center"  style="max-width: 40rem;">
        <div class="card-header">
            <h1>Editar {{ $jurisdiccion->jurisdiccion }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('jurisdicciones.update', $jurisdiccion) }}" class="form-group" method="POST">
                @method('PUT')
                @include('jurisdicciones._form')
            </form>
        </div>
    </div>
@endsection
