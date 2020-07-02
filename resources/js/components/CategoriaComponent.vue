<template>
  <div id="categorias">
    <table class="table table-borderless table-striped border" v-model="categorias" >
      <caption>Categorías</caption>
      <thead>
        <tr>
          <th scope="col">Cod. Categoría</th>
          <th scope="col">Categoría</th>
           <!--<th scope="col">Jurisdiccion</th>-->
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
       <tr v-if="categorias.length===0">
          <td colspan="6">No hay datos</td>
       </tr>
        <tr v-for="(categoria, index) in categorias"  v-bind:key="categoria.id" v-else>
          <th>{{categoria.cod_categoria}}</th>
          <td>{{categoria.categoria}}</td>
           <!--<td v-for="jurisdiccion in categoria.jurisdicciones">{{jurisdiccion.jurisdiccion}}</td>-->
          <td class="row">
              <div class="col-md-1">
                <button @click="editCategoria(categoria)" class="btn btn-outline-warning border-0 btn-sm shadow text-dark" data-toggle="modal" data-target="#edit_categoria">
                <i class="far fa-edit"></i>
              </button>
              </div>
              <div class="col-md-1">
               <form @submit.prevent="deleteCategoria(categoria.id)">
                <button type="submit" class="btn btn-outline-danger border-0 btn-sm shadow text-dark">
                  <i class="far fa-trash-alt"></i>
                </button>
              </form>
              </div>
          </td>
        </tr>
        
      </tbody>
    </table>

    <div class="m-2" align="right">
      <a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#nueva_categoria"><i class="fas fa-plus"></i> Nueva</a>    
    </div>
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
            <form action="" class="form-group" method="POST">
              
              <div class="form-group">
                <label class="col-form-label">Código categoría</label>
                <input type="text" class="form-control" name="cod_categoria" v-model="categoria.cod_categoria" :disabled="0">
              </div>
              
              <div class="form-group">
                <label class="col-form-label">Nombre</label>
                <input type="text"class="form-control" name="categoria" v-model="categoria.categoria">
              </div>
              <div class="modal-footer">
                <button v-on:click="updateCategoria(categoria.id)" data-dismiss="modal" id="editar_categoria" class="btn btn-outline-danger border-0">Editar</button>
              </div>
            </form>
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
            <button type="button" class="close" data-dismiss="modal" v-on:click="empty()" aria-label="Close">
              <span class="btn btn-danger" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="createCategoria()" method="POST">
              <div class="form-group">
                <label class="col-form-label" for="origen_new">Origen</label>
                <select class="custom-select mr-sm-2" name="origen_new" v-model="selectedOrigen" placeholder="Seleccione origen">
                <option :value="''" disabled selected>Seleccione Origen</option>
                <option v-for="(origen, index) in origenes" :key="origen.cod_origen" :value="origen.cod_origen">{{origen.origen}}</option>
                </select>
                <span style="color:red" v-if="feedback.cod_origen" v-text="feedback.cod_origen[0]" ></span>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="jurisdiccion_new">Jurisdicción</label>
                <select :disabled="selectedOrigen.length == 0" class="custom-select mr-sm-2" name="jurisdiccion_new" v-model="selectedJurisdiccion">
                  <option :value="''" disabled selected> Seleccione Jurisdicción</option>
                  <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.cod_jurisdiccion" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
                </select>
                <span style="color:red" v-if="feedback.cod_jurisdiccion" v-text="feedback.cod_jurisdiccion[0]" ></span>
              </div>
              <div class="form-group has-feedback">
                <label for="cod_categoria" class="col-form-label">Código Categoría</label>
                <input type="number" class="form-control" id="cod_categoria" name="cod_categoria" v-model="categoria.cod_categoria" required>
                <span  style="color:red" v-if="feedback.cod_categoria" v-text="feedback.cod_categoria[0]" ></span>
              </div>
              <div class="form-group">
                <label for="categoria" class="col-form-label">Nombre</label>
                <input type="text" class="form-control" id="categoria" name="categoria" v-model="categoria.categoria" required>
                <span style="color:red" v-if="feedback.categoria" v-text="feedback.categoria[0]" ></span>
              </div>
              <div class="modal-footer">
                <button id="crear_categoria" class="btn btn-primary">Crear</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
    // var bus = new Vue();
    // import Vue from 'vue';
    // // const EventBus = new Vue();
    // export const eventBus = new Vue();
    export default {
        // props:['categorias'],
        props: {
          categorias: Array,
        },
        data: function(){
            return{      
                feedback: "",
                origenes:[],
                // origen:[],
                // selected:'',
                categoria:{},
                // cat_aux:{
                //     id: '',
                //     categoria:'',
                //     cod_categoria: null,
                //     jurisdicciones: {},
                //     created_at: '',
                //     updated_at: '',
                // },
                categoria:{
                    id: '',
                    categoria:'',
                    cod_categoria: null,
                    jurisdicciones: {},
                    created_at: '',
                    updated_at: '',
                },
                selectedOrigen: "",
                selectedJurisdiccion: "",
                jurisdicciones:[],
                // jurisdiccion:[],
                errors:[],
            }
        },
        methods:{ 
            getOrigenes(){
              axios.get('api/origen/')
              .then((response)=>{
                this.origenes = response.data;
              })
              .catch(function (error) {
                  console.log(error);
              });
            },
            // getJurisdicciones(){
            //   axios.get('api/jurisdiccion/')
            //   .then((response)=>{
            //     this.jurisdicciones = response.data;
            //   })
            //   .catch(function (error) {
            //       console.log(error);
            //   });
            // },
            createCategoria() {
              if(confirm("¿Seguro que quieres crear esta categoria?")){
                const params = {
                    cod_jurisdiccion : this.selectedJurisdiccion,
                    cod_categoria : this.categoria.cod_categoria,
                    categoria : this.categoria.categoria
                  }
                  axios.post('api/categoria/create', params )
                  .then(response => {
                    $('#categorias').removeClass('modal-open');
                    $("#nueva_categoria").modal('hide');
                    this.empty();
                  }).catch(error => {
                    this.feedback = error.response.data.errors;
                  });
              }
            },
            editCategoria(categoria){
              this.categoria = categoria;
              // this.getJurisdicciones();
            },
            updateCategoria(id){
              if(confirm("¿Seguro que desea guardar los cambios?")){
                const params = {
                  cod_categoria : this.categoria.cod_categoria,
                  categoria : this.categoria.categoria
                }
                axios.put(`api/categoria/update/${id}`, params)
                .then((response)=>{
                  this.categorias = response.data;
                }).catch(function (error) {
                  console.log(error);
                });
              }
            },
            deleteCategoria(id){
              if(confirm("¿Seguro que quieres eliminar este registro?")){
                axios.delete(`api/categoria/delete/${id}`)
                .then((response)=>{
                  this.categorias = response.data;
                  // this.getCategorias();
                }).catch(function (error) {
                  console.log(error);
                });
              }
            },
            empty(){
              // this.categoria = [];
              // this.cat_aux = [];
              this.selectedOrigen = "";
              this.selectedJurisdiccion = "";
              this.feedback = [];
              // this.categorias = [];
            },
            onFail(errors) {
              this.errors.record(errors.errors);
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
          this.getOrigenes();
        }
    }
</script>





