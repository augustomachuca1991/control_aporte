<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="btn btn-danger" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" id="form_nueva_categoria" action="{{ route('create_categoria') }}">
              @csrf
              <div class="form-group has-feedback">
                <label for="cod_categoria" class="col-form-label">Cod. categoría</label>
                <input type="text" class="form-control @error('cod_categoria') is-invalid @enderror" id="cod_categoria" name="cod_categoria">
                @error('cod_categoria')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
								@enderror
              </div>
              <div class="form-group">
                <label for="categoria" class="col-form-label">Nombre</label>
                <input type="text" class="form-control" id="categoria" name="categoria">
              </div>
              <div class="modal-footer">
                <button type="submit" id="crear_categoria"  class="btn btn-primary">Crear</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
            
  