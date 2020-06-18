<td class="td-button">
    <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-primary">
        <i class="fa fa-cog"> Editar</i>
    </a>
</td>
<td class="td-button">
    <form method="POST" action="{{ route('categorias.destroy', $categoria) }}">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Desea eliminar a {{ $categoria->categoria }}?')" >
            <i class="fa fa-trash"> Eliminar</i>
        </button>
    </form>
</td>

