<template>
    <div id="organismos" style="overflow-x:auto;">

        <div class="form-row col mb-3 shadow p-3">
            <div class="form-group col-md-6 border-0 shadow p-3">
                <label class="text-muted" for="origen1"><i class="fas fa-search"></i> Origen</label>
                <select class="custom-select mr-sm-2" id="origen1" name="origen1"  v-model="selectedOrigen">
                    <option :value="''" disabled selected>Seleccione Origen</option>
                    <option v-for="(origen, index) in origenes" :key="origen.cod_origen" :value="origen.cod_origen">{{origen.origen}}</option>
                </select>
            </div>
            <div class="form-group col-md-6 border-0 shadow p-3">
                <label class="text-muted" for="jurisdiccion1"><i class="fas fa-search"></i> Jurisdicción</label>
                <select class="custom-select mr-sm-2" id="jurisdiccion1" name="jurisdiccion1"  v-model="selectedJurisdiccion">
                    <option :value="''" disabled selected>Seleccione Origen</option>
                    <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.cod_jurisdiccion" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a class="btn btn-success" v-on:click="encabezado = 'Crear Organismo'" data-toggle="modal" data-target="#altaModal">Crear nuevo organismo</a>
            </div>
        </div>
        <br>
        <div v-if="this.message != ''">
            <div class="alert alert-danger alert-block" role="alert" id="mensaje_error"  v-if="this.isValid == false">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong style="color:darkred" align="center">{{this.message}}</strong>
            </div>
            <div class="alert alert-success" role="alert" id="mensaje_exito" v-if="this.isValid == true">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong style="color:darkgreen" align="center" >{{this.message}}</strong>
            </div>
        </div>

        <table class="table table-borderless table-striped border" v-model="organismos">
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
            <tr v-if="organismos.length===0">
                <td colspan="6">No hay datos</td>
            </tr>
            <tr style="text-align: center;" v-for="organismo in organismos">
                <td>{{ organismo.id }}</td>
                <td>{{ organismo.cod_organismo }}</td>
                <td><a data-toggle="modal" data-target="#mostrarModal" @click="mostrarOrganismo(organismo)" >{{ organismo.organismo }}</a></td>
                <td>{{ organismo.jurisdiccion_id }}</td>
                <td>{{ organismo.created_at }}</td>
                <td>{{ organismo.updated_at }}</td>
                <td class="td-button">
                    <a @click="editOrganismo(organismo)" class="btn btn-outline-warning border-0  btn-sm shadow" data-toggle="modal" data-target="#editarModal"><i class="far fa-edit"></i></a>
                </td>
                <td class="td-button">
                    <form @submit.prevent="deleteOrganismo(organismo.id)">
                        <button type="submit" class="btn btn-outline-danger border-0 btn-sm shadow text-dark">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- Modal mostrar -->
        <div class="modal fade" id="mostrarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document">
                <div class="modal-content border-primary justify-content-center"  style="max-width: 40rem;">
                    <div class="modal-header">
                        <h1 class="modal-title" v-model="encabezado">Detalle Organismo</h1>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form-group" method="POST">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group" v-model="origen">
                                        <label class="required" for="mostrarOrigen" >Origen</label>
                                        <select class="custom-select mr-sm-2" id="mostrarOrigen" name="origen" v-model="jur_aux.origen_id" disabled>
                                            <option>Seleccione Orígenes</option>
                                            <option v-for="(origen, index) in origenes" :key="origen.id" :value="origen.cod_origen">{{origen.origen}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group" v-model="jurisdiccion">
                                        <label class="required" for="mostrarJurisdiccion" >Jurisdicción</label>
                                        <select class="custom-select mr-sm-2" id="mostrarJurisdiccion" name="jurisdiccion" v-model="org_aux.jurisdiccion_id" disabled>
                                            <option>Seleccione Orígenes</option>
                                            <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.id" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="editarCodJurisdiccion" class="required">Cod. Organismo</label>
                                    <input type="text" name="cod_jurisdiccion" id="mostrarCodJurisdiccion" value=""
                                           class="form-control"  v-model="org_aux.cod_organismo" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="editarDescripcion" class="required">Organismo</label>
                                    <input type="text" name="descripcion" id="mostrarDescripcion" value=""
                                           class="form-control"  v-model="org_aux.organismo" readonly>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
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
                            <div class="form-group">
                                <label class="col-form-label" for="jurisdiccion_new">Jurisdiccion</label>
                                <select class="custom-select mr-sm-2" name="origen_new" v-model="selectedJurisdiccion" placeholder="Seleccione jurisdicción">
                                    <option :value="''" disabled selected>Seleccione Origen</option>
                                    <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.cod_jurisdiccion" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
                                </select>
                                <span style="color:red" v-if="feedback.cod_jurisdiccion" v-text="feedback.cod_jurisdiccion[0]" ></span>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="altaCodOrganismo" class="required">Cod. Organismo</label>
                                    <input type="text" name="cod_organismo" id="altaCodOrganismo" value=""
                                           class="form-control"  v-model="org_aux.cod_organismo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="altaDescripcion" class="required">Organismo</label>
                                    <input type="text" name="descripcion" id="altaDescripcion" value=""
                                           class="form-control"  v-model="org_aux.organismo">
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button v-on:click="createOrganismo()" data-dismiss="modal" id="alta_organismo" class="btn btn-primary border-0">Guardar</button>
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
                                    <div class="form-group" v-model="origen">
                                        <label class="required" for="editarJurisdiccion" >Origen</label>
                                        <select class="custom-select mr-sm-2" id="editarJurisdiccion" name="origen" v-model="org_aux.origen_id" >
                                            <option>Seleccione Jurisdicción</option>
                                            <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.id" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="editarCodOrganismo" class="required">Cod. Organismo</label>
                                    <input type="text" name="cod_organismo" id="editarCodOrganismo" value=""
                                           class="form-control"  v-model="org_aux.cod_organismo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="editarDescripcion" class="required">Organismo</label>
                                    <input type="text" name="descripcion" id="editarDescripcion" value=""
                                           class="form-control"  v-model="org_aux.organismo">
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button v-on:click="updateOrganismo(org_aux)" data-dismiss="modal" id="editar_organismo" class="btn btn-primary border-0">Guardar</button>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="empty()">
                                    <span class="btn btn-danger" aria-hidden="true">Volver</span>
                                </button>
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
        name: "OrganismosComponent",

        data: function(){
            return{
                jurisdicciones:[],
                organismos:[],
                selectedOrigen: [],
                selectedJurisdiccion: [],
                origenes: [],
                origen: [],
                jurisdiccion_id: "",
                message: "",
                isValid: false,
                jur_aux: [],
                org_aux: [],
                feedback: "",


                form_editar: false,
                encabezado: '',
                error_descripcion: ''
            }
        },
        mounted() {
            this.getOrganismos();
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
            getOrganismos(){
                axios.get('api/organismo').then((response)=>{
                    console.log(response.data)
                    this.organismos = response.data;
                })
            },
            getOrigenSelected(){
                axios.get(`api/jurisdiccion/${this.selectedOrigen}`).then((response)=>{
                    console.log(response.data)
                    this.jurisdicciones = response.data;
                })
            },
            getJurisdiccionesSelected(){
                axios.get(`api/organismo/${this.selectedJurisdiccion}`).then((response)=>{
                    console.log(response.data)
                    this.organismos = response.data;
                })
            },

            editOrganismo(p_organismo){
                this.org_aux = _.cloneDeep(p_organismo);
                this.encabezado = 'Editar Organismo';
            },
            mostrarOrganismo(p_organismo){
                this.org_aux = _.cloneDeep(p_organismo);
            },

            updateOrganismo(p_organismo){
                if(confirm("¿Seguro que desea guardar los cambios?")){
                    const params = {
                        cod_organismo : p_organismo.cod_organismo,
                        organismo : p_organismo.jurisdiccion,
                        jurisdiccion_id : p_organismo.jurisdiccion_id,
                    };
                    axios.put(`api/organismo/update/${p_organismo.id}` , params)
                        .then(response => {
                            this.isValid = response.data.isValid;
                            this.message = response.data.errors;
                            this.empty();
                        }).catch(function (error) {
                        console.log(error);
                    });
                }
            },

            createOrganismo(){
                if(confirm("¿Seguro que desea crear el Organismo?")){
                    const params = {
                        cod_organismo : this.org_aux.cod_organismo,
                        organismo : this.org_aux.organismo,
                        organismo_id : this.selectedOrganismo,
                    };

                    axios.post('api/organismo/create', params )
                        .then(response => {
                            this.isValid = response.data.isValid;
                            this.message = response.data.errors;
                            this.empty();


                        }).catch(function (error) {
                        console.log(error);
                    });
                }
            },

            deleteOrganismo(id){
                if(confirm("¿Seguro que quieres eliminar este Organismo?")){
                    axios.delete(`api/organismo/delete/${id}`)
                        .then((response)=>{
                            this.isValid = response.data.isValid;
                            this.message = response.data.errors
                            this.empty();

                        }).catch(function (error) {
                        console.log(error);
                    });
                }
            },

            empty(){
                this.getJurisdiccionesSelected();
                this.jur_aux = [];
            },

        },
        watch:{
            selectedOrigen: function () {
                this.getOrigenSelected()
            },
            selectedJurisdiccion: function () {
                this.getJurisdiccionesSelected()
            }
        }
    }
</script>

