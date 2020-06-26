<template>
  <div id="categorias">
    <table class="table table-borderless table-striped border" v-model="categorias">
      <caption>Categorías</caption>
      <thead>
        <tr>
          <th scope="col">Cod.</th>
          <th scope="col">Categoría</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(categoria, index) in categorias"  v-bind:key="categoria.id">
          <th scope="row">{{categoria.cod_categoria}}</th>
          <td>{{categoria.categoria}}</td>
          <td>
              <a @click="editCategoria(categoria.id)" class="btn btn-outline-warning border-0  btn-sm shadow" data-toggle="modal" data-target="#edit_categoria"><i class="far fa-edit"></i></a>
              <a @click="deleteCategoria(categoria.id)" class="btn btn-outline-danger border-0 btn-sm shadow"><i class="far fa-trash-alt"></i></i></a>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal Edit Categoría -->
    <div class="modal fade bd-example-modal-md edit" id="edit_categoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md edit">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="edit_categoria">Editar categoría</h5>
            <button type="button" v-on:click ="empty()" class="close" data-dismiss="modal" aria-label="Close">
              <span class="btn btn-danger" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-form-label">Cod. categoría</label>
              <input type="text" class="form-control" name="cod_categoria" v-model="categoria.cod_categoria" :disabled="0">
            </div>
            <div class="form-group">
              <label class="col-form-label">Nombre</label>
              <input type="text"class="form-control" name="categoria" v-model="categoria.categoria">
            </div>
            <div class="modal-footer">
              <button v-on:click="updateCategoria(categoria.id)" data-dismiss="modal" id="editar_categoria" class="btn btn-outline-danger border-0">Editar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal nueva categoría -->
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
            <form @submit.prevent="createCategoria()">
              <div class="form-group">
                <label class="col-form-label" for="origen">Origen</label>
                <select class="custom-select mr-sm-2" :id="origen" name="origen" v-model="selectedOrigen" placeholder="Seleccione origen">
                <option :value="''" disabled selected>Selecciona una opción</option>
                <option v-for="(origen, index) in origenes" :key="origen.cod_origen" :value="origen.cod_origen">{{origen.origen}}</option>
                </select>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="origen">Jurisdicción</label>
                <select :disabled="selectedOrigen.length == 0" class="custom-select mr-sm-2" :id="jurisdiccion" name="jurisdiccion" v-model="selectedJurisdiccion">
                  <option :value="''" disabled selected> Seleccione Jurisdicción</option>
                  <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.cod_jurisdiccion" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
                </select>
              </div>
              <div class="form-group has-feedback">
                <label for="cod_categoria" class="col-form-label">Cod. categoría</label>
                <input type="number" class="form-control" id="cod_categoria" name="cod_categoria" v-model="categoria.cod_categoria">
              </div>
              <div class="form-group">
                <label for="categoria" class="col-form-label">Nombre</label>
                <input type="text" class="form-control" id="categoria" name="categoria" v-model="categoria.categoria">
              </div>
                <div  v-if="feedback">
                  <span  style="color:red" v-text="feedback" ></span>
                </div>
              <div class="modal-footer">
                <button id="crear_categoria" type="submit" class="btn btn-primary">Crear</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>



    export default {
        data: function(){
            return{
                categorias:[],
                feedback: "",
                origenes:[],
                origen:[],
                categoria:[],
                selectedOrigen: "",
                selectedJurisdiccion: "",
                jurisdicciones:[],
                jurisdiccion:[],
                errors:[]
            }
        },
      
        methods:{
            getCategorias(){
              axios.get('api/categoria/').then((response)=>{
                this.categorias = response.data;
              })
              .catch(function (error) {
                  console.log(error);
              });
            }, 
            getOrigenes(){
              axios.get('api/origen/')
              .then((response)=>{
                this.origenes = response.data;
              })
              .catch(function (error) {
                  console.log(error);
              });
            },
            createCategoria() {
              const params = {
                cod_jurisdiccion : this.selectedJurisdiccion,
                cod_categoria : this.categoria.cod_categoria,
                categoria : this.categoria.categoria
              }
              axios.post('api/categoria/create', params )
              .then(response => {
                console.log(response.data);
                this.categorias = response.data;
                this.getCategorias();
              }).catch(error => {
                this.feedback = error.response.data.errors;
              });
            },
            editCategoria(id){
              axios.get(`api/categoria/edit/${id}`)
              .then((response)=>{
                this.categoria = response.data;
              }).catch(function (error) {
                  console.log(error);
              });
            },
            updateCategoria(id){
              const params = {
                cod_categoria : this.categoria.cod_categoria,
                categoria : this.categoria.categoria
              };
              axios.put(`api/categoria/update/${id}`, params)
              .then((response)=>{
                // $('#edit_categoria').modal('hide');
                // $('#edit_categoria').removeClass('.modal-backdrop');
                this.getCategorias(); 
                this.categoria = [];      
              }).catch(function (error) {
                console.log(error);
              });
            },
            deleteCategoria(id){
              axios.delete(`api/categoria/delete/${id}`)
              .then((response)=>{
                this.getCategorias();
              }).catch(function (error) {
                console.log(error);
              });
            },
            empty(){
              this.categoria = [];
            }
        },
        watch: {
                selectedOrigen: function() {
                  this.jurisdicciones = [];
                  this.selectedJurisdiccion = "";
                  if (this.selectedOrigen > 0) {
                    this.jurisdicciones = this.origenes[this.selectedOrigen-1].jurisdicciones
                  }
                },
        },
        mounted(){
          this.getCategorias();
          this.getOrigenes();
        }
    }
</script>





