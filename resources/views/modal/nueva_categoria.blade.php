<div class="modal fade bd-example-modal-md" tabindex="-1" id="nueva_categoria" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="nueva_categoria">Nueva categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="btn btn-danger" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="col-form-label" for="origen">Origen</label>
          <select class="custom-select mr-sm-2" :id="origen" name="origen" v-model="selectedOrigen">
          <option> Seleccione Origen</option>
          <option v-for="(origen, index) in origenes" :key="origen.cod_origen" :value="origen.cod_origen">{{origen.origen}}</option>
          </select>
        </div>
        <div class="form-group">
          <label class="col-form-label" for="origen">Jurisdicción</label>
          <select :disabled="selectedOrigen.length == 0" class="custom-select mr-sm-2" :id="jurisdiccion" name="jurisdiccion" v-model="selectedJurisdiccion">
            <option :value="null" disabled selected> Seleccione Jurisdicción</option>
            <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.cod_jurisdiccion" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
          </select>
        </div>
        <div class="form-group has-feedback">
          <label for="cod_categoria" class="col-form-label">Cod. categoría</label>
          <input type="text" class="form-control" id="cod_categoria" name="cod_categoria" v-model="categoria.cod_categoria">
        </div>
        <div class="form-group">
          <label for="categoria" class="col-form-label">Nombre</label>
          <input type="text" class="form-control" id="categoria" name="categoria" v-model="categoria.categoria">
        </div>
        <div class="modal-footer">
          <button type="submit" id="crear_categoria" @click="createCategoria()" class="btn btn-primary">Crear</button>
        </div>
      </div>
    </div>
  </div>
</div>