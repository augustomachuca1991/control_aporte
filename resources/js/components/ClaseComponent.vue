<template>
    <div id="clases">
        <table class="table table-borderless table-striped border" v-model="clases">
            <caption>Clases</caption>
            <thead>
                <tr>
                    <th scope="col">Cod. Clase</th>
                    <th scope="col">Clase</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="clases.length===0">
                    <td colspan="6">No hay datos</td>
                </tr>
                <tr v-for="(clase, index) in clases" v-bind:key="clase.id" v-else>
                    <th>{{clase.id}}</th>
                    <td>{{clase.clase}}</td>
                    <td>
                        <a @click="editClase(clase.id)" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#edit_clase"><i class="far fa-edit"></i></a>
                        <a @click="deleteClase(clase.id)" class="btn btn-primary btn-sm text-white"><i class="far fa-trash-alt"></i></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    <div class="m-2" align="right">
      <a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#nueva_clase"><i class="fas fa-plus"></i> Nueva</a>    
    </div>

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
                    <form @submit.prevent="createClase()" method="POST">
                    <div class="form-group">
                        <label class="col-form-label" for="origen_new">Origen</label>
                        <select class="custom-select mr-sm-2" name="origen_new" v-model="selectedOrigen">
                            <option :value="''" disabled selected>Seleccione Origen</option>
                            <option v-for="(origen, index) in origenes" :key="origen.id" :value="origen.id">{{origen.origen}}</option>
                        </select>
                        <span style="color:red" v-if="feedback.cod_origen" v-text="feedback.cod_origen[0]" ></span>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="jurisdiccion_new">Jurisdicción</label>
                        <select :disabled="selectedOrigen.length == 0" class="custom-select mr-sm-2" name="jurisdiccion_new" v-model="selectedJurisdiccion">
                            <option :value="''" disabled selected> Seleccione Jurisdicción</option>
                            <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.id" :value="jurisdiccion.id">{{jurisdiccion.jurisdiccion}}</option>
                        </select>
                        <span style="color:red" v-if="feedback.cod_jurisdiccion" v-text="feedback.cod_jurisdiccion[0]" ></span>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="categoria_new">Categoría</label>
                        <select :disabled="selectedJurisdiccion.length == 0" class="custom-select mr-sm-2" name="categoria_new" v-model="selectedCategoria">
                            <option :value="''" disabled selected> Seleccione Categoria</option>
                            <option v-for="(categoria, index) in categorias" :key="categoria.id" :value="categoria.id">{{categoria.categoria}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="clase" class="col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="clase" name="clase" v-model="clase.clase" required>
                    </div>
                    <div class="modal-footer">
                        <button id="crear_clase" class="btn btn-primary">Crear</button>
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
        props:['clases'],
        data: function(){
            return{
                clase:{
                    id: '',
                    clase:'',
                    created_at: '',
                    updated_at: '',
                },
                // clases: this.class,
                categorias:[],
                selectedCategoria:"",
                selectedOrigen:"",
                selectedJurisdiccion:"",
                feedback:'',
                origenes:[],
                jurisdicciones:[]
            }
        },
        methods:{
            // getClases(){
            //   axios.get(`api/clase/`).then((response)=>{
            //   this.clases = response.data;
            //   console.log(response.data);
            //   })
            //   .catch(function (error) {
            //       console.log(error);
            //     });
            // }, 
            createClase() {
                if(confirm("¿Seguro que quieres crear esta clase?")){
                    const params = {
                        categoria_id : this.selectedCategoria,
                        clase : this.clase.clase
                        };
                    axios.post('api/clase/create', params )
                    .then(response => {
                        this.clases = response.data;
                        $('#clases').removeClass('modal-open');
                        $("#nueva_clase").modal('hide');
                        // this.empty();
                    });
                }
            },
            editClase(id){
                 axios.get(`api/clase/edit/${id}`).then((response)=>{
                         this.clase = response.data;
            }) .catch(function (error) {
                  console.log(error);
                });
            },
            updateClase(id){
              const params = {
                categoria_id : this.clase.categoria_id,
                clase : this.clase.clase
              };

              axios.put(`api/clase/update/${id}`, params).then((response)=>{
                
              $('#edit_clase').removeClass('show');
              $('modal-backdrop').remove();
              $('. close').click();
          
              this.getClases();       
            }).catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            deleteClase(id){
              if(confirm("¿Seguro que quieres eliminar este registro?")){
                axios.delete(`api/clase/delete/${id}`).then((response)=>{
                        this.clases = response.data;
                }).catch(function (error) {
                        // handle error
                        console.log(error);
                    });
              }
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
            empty(){
              // this.categoria = [];
              // this.cat_aux = [];
              this.selectedOrigen = "";
              this.selectedJurisdiccion = "";
              this.selectedCategoria = "";
              this.feedback = [];
              // this.categorias = [];
            },
        },
        watch: {
                selectedOrigen: function() {
                  this.jurisdicciones = [];
                  this.selectedJurisdiccion = "";
                  if (this.selectedOrigen > 0) {
                    this.jurisdicciones = this.origenes[this.selectedOrigen-1].jurisdicciones
                  }
                },
                selectedJurisdiccion: function() {
                  this.categorias = [];
                  this.selectedCategoria = "";
                  if (this.selectedJurisdiccion > 0) {
                    this.categorias = this.origenes[this.selectedOrigen-1].jurisdicciones[this.selectedJurisdiccion-1].categorias
                  }
                },
        },
        mounted(){
          this.getOrigenes();
        }

    }
</script>