@extends('admin.app')
@section('body')
    <div class="row">
        <div class="col">
            <h1>Ccategorías</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-success" href="{{ route('categorias.create') }}">Crear nueva Categoría</a>
        </div>
    </div>
    <br>
    {{ $categorias->links() }}
    <table class="table border-rounded table-striped">
        <thead class="thead-dark">
            <tr style="text-align: center;">
                <th scope="col">Id.</th>
                <th scope="col">cod.</th>
                <th scope="col">Descripción</th>
                <th scope="col">Creación</th>
                <th scope="col">Modificación</th>
                <th scope="col" nowrap colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr style="text-align: center;">
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->cod_categoria }}</td>
                    <td>{{ $categoria->categoria }}</td>
                    <td>{{ $categoria->created_at }}</td>
                    <td>{{ $categoria->updated_at }}</td>
                    @include('categorias._buttons')
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
