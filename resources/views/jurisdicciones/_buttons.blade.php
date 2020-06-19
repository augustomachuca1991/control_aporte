<td class="td-button">
    <a href="{{ route('jurisdicciones.edit', $jurisdiccion) }}" class="btn btn-primary">
        <i class="fa fa-cog"> Editar </i>
    </a>
</td>
<td class="td-button">
    <form method="POST" action="{{ route('jurisdicciones.destroy', $jurisdiccion) }}">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Desea eliminar a {{ $jurisdiccion->jurisdiccion }}?')" >
            <i class="fa fa-trash"> Eliminar</i>
        </button>
    </form>
</td>

