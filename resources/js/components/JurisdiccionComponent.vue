<template>
    <div id="jurisdicciones" style="overflow-x:auto;">


        <div v-if="this.message != ''">
            <div class="alert alert-danger alert-block" role="alert" id="mensaje_error"  v-if="this.isValid == false">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong style="color:darkred" align="center">{{this.message}}</strong>
            </div>
            <div class="alert alert-success" role="alert" id="mensaje_exito" v-if="this.isValid == true">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong style="color:darkgreen" align="center" >{{this.message}}</strong>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a class="btn btn-success" v-on:click="encabezado = 'Crear Jurisdicción'" data-toggle="modal" data-target="#altaModal">Crear nueva jurisdicción</a>
            </div>
        </div>

        <br>

    <table class="table table-borderless table-striped border" v-model="jurisdicciones">
        <thead >
            <tr style="text-align: center;">
                <th scope="col">Id.</th>
                <th scope="col">cod.</th>
                <th scope="col">Descripción</th>
                <th scope="col">Origen</th>
                <th scope="col">Creación</th>
                <th scope="col">Modificación</th>
                <th scope="col" nowrap colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align: center;" v-for="jurisdiccion in jurisdicciones">
                <td>{{ jurisdiccion.id }}</td>
                <td>{{ jurisdiccion.cod_jurisdiccion }}</td>
                <td><a data-toggle="modal" data-target="#mostrarModal" v-on:click="mostrar(jurisdiccion)" >{{ jurisdiccion.jurisdiccion }}</a></td>
                <td>{{ jurisdiccion.origen_id }}</td>
                <td>{{ jurisdiccion.created_at }}</td>
                <td>{{ jurisdiccion.updated_at }}</td>
                <td class="td-button">
                    <a @click="editJurisdiccion(jurisdiccion)" class="btn btn-outline-warning border-0  btn-sm shadow" data-toggle="modal" data-target="#editarModal"><i class="far fa-edit"></i></a>
                </td>
                <td class="td-button">
                    <a @click="deleteJurisdiccion(jurisdiccion)" class="btn btn-outline-danger border-0 btn-sm shadow" data-toggle="modal" data-target="#eliminarModal"><i class="far fa-trash-alt"></i></a>
                </td>
            </tr>
        </tbody>
    </table>

        <!-- Modal mostrar -->
        <div class="modal fade" id="mostrarModal" tabindex="-1" role="dialog" aria-labelledby="mostrarModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document">
                <div class="modal-content border-primary justify-content-center"  style="max-width: 40rem;">
                    <div class="modal-header">
                        <h1 class="modal-title">Detalle Jurisdicción</h1>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form-group" method="POST">
                            <div class="row">
                                <div class="col">
                                    <label for="mostrarCodJurisdiccion" class="required">Origen</label>
                                    <input type="text" name="cod_jurisdiccion" id="mostrarCodJurisdiccion" value=""
                                           class="form-control"  v-model="selectedOrigen.origen" readonly>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="mostrarDetalleOrigen" class="required">Cod. Jurisdicción</label>
                                    <input type="text" name="mostrarDetalleOrigen" id="mostrarDetalleOrigen" value=""
                                           class="form-control"  v-model="jur.cod_jurisdiccion" readonly>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="mostrarDescripcion" class="required">Jurisdicción</label>
                                    <input type="text" name="descripcion" id="mostrarDescripcion" value=""
                                           class="form-control"  v-model="jur.jurisdiccion" readonly>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <!--a href="" class="btn btn-danger" data-dismiss="modal">Volver</a-->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="empty()">
                                    <span class="btn btn-danger" aria-hidden="true">Volver</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal alta -->
        <div class="modal fade" id="altaModal" tabindex="-1" role="dialog" aria-labelledby="altaModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document">
                <div class="modal-content border-primary justify-content-center"  style="max-width: 40rem;">
                    <div class="modal-header">
                        <h1 class="modal-title" v-model="encabezado">{{encabezado}}</h1>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form-group" method="POST">
                            <div class="form-group">
                                <label class="col-form-label" for="origen_new">Origen</label>
                                <select class="custom-select mr-sm-2" name="origen_new" v-model="selectedOrigen" placeholder="Seleccione origen">
                                    <option :value="''" disabled selected>Seleccione Origen</option>
                                    <option v-for="(origen, index) in origenes" :key="origen.cod_origen" :value="origen.cod_origen">{{origen.origen}}</option>
                                </select>
                                <span style="color:red" v-if="feedback.cod_origen" v-text="feedback.cod_origen[0]" ></span>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="altaCodJurisdiccion" class="required">Cod. Jurisdicción</label>
                                    <input type="text" name="cod_jurisdiccion" id="altaCodJurisdiccion" value=""
                                           class="form-control"  v-model="jur_aux.cod_jurisdiccion">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="altaDescripcion" class="required">Jurisdicción</label>
                                    <input type="text" name="descripcion" id="altaDescripcion" value=""
                                           class="form-control"  v-model="jur_aux.jurisdiccion">
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button v-on:click="createJuristiccion()" data-dismiss="modal" id="alta_jurisdiccion" class="btn btn-primary border-0">Guardar</button>
                                <!--a href="" class="btn btn-danger" data-dismiss="modal">Volver</a-->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="empty()">
                                    <span class="btn btn-danger" aria-hidden="true">Volver</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal editar -->
        <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document">
                <div class="modal-content border-primary justify-content-center"  style="max-width: 40rem;">
                    <div class="modal-header">
                        <h1 class="modal-title" v-model="encabezado">{{encabezado}}</h1>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form-group" method="POST">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group" v-model="origen">
                                        <label class="required" for="editarOrigen" >Origen</label>
                                        <select class="custom-select mr-sm-2" id="editarOrigen" name="origen" v-model="jur_aux.origen_id" >
                                            <option>Seleccione Orígenes</option>
                                            <option v-for="(origen, index) in origenes" :key="origen.id" :value="origen.cod_origen">{{origen.origen}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="editarCodJurisdiccion" class="required">Cod. Jurisdicción</label>
                                    <input type="text" name="cod_jurisdiccion" id="editarCodJurisdiccion" value=""
                                           class="form-control"  v-model="jur_aux.cod_jurisdiccion">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="editarDescripcion" class="required">Jurisdicción</label>
                                    <input type="text" name="descripcion" id="editarDescripcion" value=""
                                           class="form-control"  v-model="jur_aux.jurisdiccion">
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button v-on:click="updateJurisdiccion(jur_aux)" data-dismiss="modal" id="editar_jurisdiccion" class="btn btn-primary border-0">Guardar</button>
                                <!--a href="" class="btn btn-danger" data-dismiss="modal">Volver</a-->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="empty()">
                                    <span class="btn btn-danger" aria-hidden="true">Volver</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal eliminar -->
        <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarModalLabel">Eliminar Modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
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
                jurisdicciones:[],
                selectedOrigen: [],
                origenes: [],
                origen: [],
                jurisdiccion_id: "",
                message: "",
                isValid: false,
                jur_aux: [],
                jur:[],
                feedback: "",

                jur:{
                    id: null,
                    cod_jurisdiccion: null,
                    jurisdiccion: '',
                    origen_id: null,
                    created_at: '',
                    updated_at: '',
                },
                form_editar: false,
                encabezado: '',
                error_descripcion: ''
            }
        },
        mounted() {
            this.getOrigenes();
            this.getJurisdicciones();
        },

        methods: {
            getJurisdicciones(){
                axios.get('api/jurisdiccion').then((response)=>{
                    console.log(response.data)
                    this.jurisdicciones = response.data;
                })
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

            restaurar: function(p_jurisdiccion){
                console.log(p_jurisdiccion);
                alert(p_jurisdiccion.jurisdiccion);
                //this.jur = Object.assign({},p_jurisdiccion);
                this.jur.id = p_jurisdiccion.id;
                this.jur.cod_jurisdiccion = p_jurisdiccion.cod_jurisdiccion;
                this.jur.jurisdiccion= p_jurisdiccion.jurisdiccion;
                this.jur.origen_id= p_jurisdiccion.origen_id;
                this.jur.created_at= p_jurisdiccion.created_at;
                this.jur.updated_at= p_jurisdiccion.updated_at;

            }.bind(this),

            editJurisdiccion(p_jurisdiccion){
                //this.jur = p_jurisdiccion;
                //this.jur_aux = Object.assign({}, jur_aux, jur),jur = jurisdiccion;
                this.jur_aux = _.cloneDeep(p_jurisdiccion);
                this.encabezado = 'Editar Jurisdicción';
            },
            updateJurisdiccion(p_jurisdiccion){
                if(confirm("¿Seguro que desea guardar los cambios?")){
                    const params = {
                        cod_jurisdiccion : p_jurisdiccion.cod_jurisdiccion,
                        jurisdiccion : p_jurisdiccion.jurisdiccion,
                        origen_id : p_jurisdiccion.origen_id,
                    };
                    axios.put(`api/jurisdiccion/update/${p_jurisdiccion.id}` , params)
                        .then(response => {
                            this.isValid = response.data.isValid;
                            this.message = response.data.errors
                            this.getJurisdicciones();
                            this.jur = [];
                            //console.log(response.data.isValid);
                            //console.log(response.data.errors);
                            //alert('SI funciona');
                            //alert(this.message);
                        }).catch(function (error) {
                        alert('NO funciona');
                        console.log(error);
                    });
                }
            },

            createJuristiccion(){
                if(confirm("¿Seguro que desea crear la Jurisdicción?")){
                    const params = {
                        cod_jurisdiccion : this.jur_aux.cod_jurisdiccion,
                        jurisdiccion : this.jur_aux.jurisdiccion,
                        origen_id : this.selectedOrigen,
                    };
                    console.log(params);
                    axios.post('api/jurisdiccion/create', params )
                        .then(response => {
                            this.isValid = response.data.isValid;
                            this.message = response.data.errors
                            this.getJurisdicciones();
                            this.jur = [];

                            console.log(response.data.isValid);
                            console.log(response.data.errors);
                            console.log(response.data.error_descripcion);
                            alert('SI funciona');
                            //alert(this.message);

                        }).catch(function (error) {
                        alert('NO funciona');
                        console.log(error);
                    });
                }
            },

            deleteJurisdiccion(p_jurisdiccion){

            },

            empty(){
                this.jur = [];
            },
            mostrar: function(p_jurisdiccion) {
                console.log(p_jurisdiccion);
                //alert(p_jurisdiccion.origen_id);
                this.selectedOrigen = this.origenes.find(origen => origen.cod_origen === p_jurisdiccion.origen_id);
                this.jur = p_jurisdiccion;
                this.encabezado = 'Detalle Jurisdicción'
            }
        },
    }
</script>
