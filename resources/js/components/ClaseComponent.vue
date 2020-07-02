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
                <tr v-for="(clase, index) in clases"  v-bind:key="clase.id">
                    <th>{{clase.id}}</th>
                    <td>{{clase.clase}}</td>
                    <td>
                        <a @click="editClase(clase.id)" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#edit_clase"><i class="far fa-edit"></i></a>
                        <a @click="deleteClase(clase.id)" class="btn btn-primary btn-sm text-white"><i class="far fa-trash-alt"></i></i></a>
                    </td>
                </tr>
            </tbody>
        </table>


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
                    <form enctype="multipart/form-data" id="form_nueva_clase">
                    <div class="form-group has-feedback">
                        <label for="categoria" class="col-form-label">Categoría</label>
                        <input type="text" class="form-control" id="categoria" name="cod_categoria">
                    </div> 
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
            
  
    </div>
</template>


<script>
    export default {
        data: function(){
            return{
                clases:[],
                clase:[],
                categorias:[],
                selectedCategorias:[]
            }
        
        },
        methods:{
            getClases(){
              axios.get('api/clase/').then((response)=>{
              this.clases = response.data;
              console.log(response.data);
              })
              .catch(function (error) {
                  console.log(error);
                });
            }, 
            createClase() {
            const params = {
                  categoria_id : this.clase.categoria_id,
                  clase : this.clase.clase
                };
            this.axios
                .post('api/clase/create', params )
                .then(response => {
                  this.clases = response.data;
                });
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
              axios.delete(`api/clase/delete/${id}`).then((response)=>{
                        this.getClases();
              }).catch(function (error) {
                    // handle error
                    console.log(error);
                });
            }
        },
        mounted(){
          this.getClases();
        }

    }
</script>