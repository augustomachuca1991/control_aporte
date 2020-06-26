<div class="modal fade bd-example-modal-md" tabindex="-1" id="nueva_clase" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="nueva_clase">Nueva clase</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="btn btn-danger" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" id="form_nueva_clase" action="{{ route('create_clase') }}">
              @csrf
              {{-- <div class="form-group has-feedback">
                <label for="categoria" class="col-form-label">Categoría</label>
                <input type="text" class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="cod_categoria">
                @error('categoria')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
								@enderror
              </div> --}}
              <div class="form-group">
                <label class="mr-sm-2 sr-only" for="categoria">Categoría</label>
                <select class="custom-select mr-sm-2" id="categoria" name="categoria" v-model="categorias">
                  <option>Seleccione Categoria</option>
                  <option v-for="(categoria, index) in categorias" :key="categoria.cod_categoria" :value="categoria.cod_categoria">{{categoria.categoria}}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="clase" class="col-form-label">Nombre</label>
                <input type="text" class="form-control" id="clase" name="clase">
              </div>
              <div class="modal-footer">
                <button type="submit" id="crear_clase" @click="createClase()" class="btn btn-primary">Crear</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div class="col">
    
    </div>
            
  