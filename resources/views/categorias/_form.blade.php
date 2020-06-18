@csrf
<div class="row">
    <div class="col">
        <label for="descripcion" class="required">Categoría</label>
        <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', $categoria->categoria) }}"
               class="form-control @error('descripcion') is-invalid @enderror">
        @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<br>
<div class="form-group">
    <input type="submit" class="btn btn-primary" onclick="return confirm('Está seguro que desea guardar?')" value="Guardar">
    <a href="{{ route('categorias.index') }}" class="btn btn-danger">Volver</a>
</div>
