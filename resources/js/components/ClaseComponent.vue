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
                    <td colspan="6" align="center">No hay datos</td>
                </tr>
                <tr v-for="(clase, index) in clases" v-bind:key="clase.id" v-else>
                    <th>{{clase.id}}</th>
                    <td>{{clase.clase}}</td>
                    <td class="row">
                        <div class="col-md-1">
                            <button @click="editClase(clase)" class="btn btn-outline-warning border-0 btn-sm shadow text-dark" data-toggle="modal" data-target="#edit_clase">
                            <i class="far fa-edit"></i>
                        </button>
                        </div>
                        <div class="col-md-1">
                        <form @submit.prevent="deleteClase(clase.id)">
                            <button type="submit" class="btn btn-outline-danger border-0 btn-sm shadow text-dark">
                            <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal Edit Clase -->
        <div class="modal fade bd-example-modal-md edit" id="edit_clase" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md edit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_clase">Editar clase</h5>
                        <button type="button" v-on:click ="empty()" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="btn btn-danger" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form-group" method="POST">
                            <div class="form-group">
                                <label class="col-form-label" for="origen_new">Origen</label>
                                <select class="form-control form-control-md" name="origen_new" v-model="origen_id" required>
                                <option v-for="(origen, index) in origenes" :key="origen.id" :value="origen.id">{{origen.origen}}</option>
                                </select>
                            </div>  
                            <div class="form-group">
                                <label class="col-form-label" for="jurisdiccion_new">Jurisdiccion</label>
                                <select class="form-control form-control-md" name="jurisdiccion_new" v-model="jurisdiccion_id" required>
                                <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.id" :value="jurisdiccion.id">{{jurisdiccion.jurisdiccion}}</option>
                                </select>
                            </div>   
                            <div class="form-group">
                                <label class="col-form-label" for="categoria_new">Categoria</label>
                                <select class="form-control form-control-md" name="categoria_new" v-model="clase.categoria_id" required>
                                <option v-for="(categoria, index) in categorias" :key="categoria.id" :value="categoria.id">{{categoria.categoria}}</option>
                                <span  style="color:red" v-if="feedback.categoria_id" v-text="feedback.categoria_id[0]" ></span>
                                </select>
                            </div>       
                            <div class="form-group">
                                <label class="col-form-label">Nombre</label>
                                <input type="text"class="form-control" name="clase" v-model="clase.clase">
                            </div>
                            <div class="modal-footer">
                                <button v-on:click="updateClase(clase.id)" data-dismiss="modal" id="editar_clase" class="btn btn-outline-danger border-0">Editar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Nueva clase -->
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
                            <select class="form-control form-control-md" name="origen_new" v-model="selectedOrigen">
                                <option :value="''" disabled selected>Seleccione Origen</option>
                                <option v-for="(origen, index) in origenes" :key="origen.id" :value="origen.id">{{origen.origen}}</option>
                            </select>
                            <span style="color:red" v-if="feedback.cod_origen" v-text="feedback.cod_origen[0]" ></span>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="jurisdiccion_new">Jurisdicción</label>
                            <select :disabled="selectedOrigen.length == 0" class="form-control form-control-md" name="jurisdiccion_new" v-model="selectedJurisdiccion">
                                <option :value="''" disabled selected> Seleccione Jurisdicción</option>
                                <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.id" :value="jurisdiccion.id">{{jurisdiccion.jurisdiccion}}</option>
                            </select>
                            <span style="color:red" v-if="feedback.cod_jurisdiccion" v-text="feedback.cod_jurisdiccion[0]" ></span>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="categoria_new">Categoría</label>
                            <select :disabled="selectedJurisdiccion.length == 0" class="form-control form-control-md" name="categoria_new" v-model="selectedCategoria">
                                <option :value="''" disabled selected> Seleccione Categoria</option>
                                <option v-for="(categoria, index) in categorias" :key="categoria.cod_categoria" :value="categoria.cod_categoria">{{categoria.categoria}}</option>
                            </select>
                            <span style="color:red" v-if="feedback.categoria_id" v-text="feedback.categoria_id[0]" ></span>
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
    const Toast =   swal.mixin
                    ({
                        toast: true,
                        position: 'top-end',
                        background: 'rgb(223, 237, 225)',
                        timer: 3000,
                        showConfirmButton: false,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', swal.stopTimer)
                            toast.addEventListener('mouseleave', swal.resumeTimer)
                        }
                    })
    export default {
        props:['clases'],
        data: function(){
            return{
                clase:{
                    id: '',
                    categoria_id:'',
                    clase:'',
                    created_at: '',
                    updated_at: '',
                },
                categorias:[],
                selectedCategoria:"",
                selectedOrigen:"",
                selectedJurisdiccion:"",
                feedback:'',
                origenes:[],
                categoria:'',
                jurisdicciones:[],
                origen_id:'',
                jurisdiccion_id:''
            }
        },
        methods:{
            createClase() {
                    const params = {
                        categoria_id : this.selectedCategoria,
                        clase : this.clase.clase
                    };
                    axios.post('api/clase/create', params )
                    .then(response => {
                        this.clases = response.data;
                        $('#clases').removeClass('modal-open');
                        $("#nueva_clase").modal('hide');
                        this.empty();
                        Toast.fire({
                            icon: 'success',
                            title: 'Clase creada con éxito'
                        })
                    }).catch(error => {
                        this.feedback = error.response.data.errors;
                    });
            },
            editClase(clase){
                this.clase = clase;
                this.getCategoria(this.clase.categoria_id);
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
                    Toast.fire({
                        icon: 'success',
                        title: 'Clase actualizada con éxito'
                    })      
                }).catch(function (error) {
                    console.log(error);
                });
            },
            deleteClase(id){
                swal.fire({
                  title: '¿Estás seguro?',
                  text: "Esta clase será eliminada",
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, eliminar',
                  cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        axios.delete(`api/clase/delete/${id}`).then((response)=>{
                            Toast.fire({
                                icon: 'success',
                                title: 'Categoría eliminada con éxito' 
                            })
                            this.clases = response.data;
                        }).catch(function (error) {
                                console.log(error);
                        });
                    }
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
            getJurisdicciones(id){
                axios.get(`api/jurisdiccion/${this.origen_id}`)
                .then((response)=>{
                this.jurisdicciones = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getCategorias(id){
                axios.get(`api/categoria/${id}`)
                .then((response)=>{
                    this.categorias = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getCategoria(id){
                axios.get(`api/categoria/find/${id}`)
                .then((response)=>{
                    this.origen_id = response.data.origen_id;
                    this.getJurisdicciones(this.origen_id);
                    this.jurisdiccion_id = response.data.jurisdiccion_id;
                    this.getCategorias(this.jurisdiccion_id);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            empty(){
                this.clase = {},
                this.selectedOrigen = "";
                this.selectedJurisdiccion = "";
                this.selectedCategoria = "";
                this.feedback = [];
            },
        },
        watch:{
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
                    this.getCategorias(this.selectedJurisdiccion);
                  }
            },
        },
        mounted(){
          this.getOrigenes(); 
        }

    }
</script>