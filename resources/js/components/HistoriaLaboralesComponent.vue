<template>
    <div id="historia_laborales" style="overflow-x:auto;">

        <div class="form-row col mb-3 shadow p-3">
            <div class="form-group col-md-4 border-0 shadow p-3">
                <label class="text-muted" for="origen1"><i class="fas fa-search"></i> Origen</label>
                <select class="form-control form-control-md" id="origen1" name="origen1"  v-model="selectedOrigen">
                    <option :value="''" disabled selected>Seleccione Origen</option>
                    <option v-for="(origen, index) in origenes" :key="origen.id" :value="origen.id">{{origen.origen}}</option>
                </select>
            </div>
            <div class="form-group col-md-4 border-0 shadow p-3">
                <label class="text-muted" for="jurisdiccion1"><i class="fas fa-search"></i> Jurisdiccion</label>
                <select  :disabled="selectedOrigen.length == 0" class="form-control form-control-md" id="jurisdiccion1" name="jurisdiccion1" v-model="selectedJurisdiccion">
                    <option :value="''" disabled selected>Seleccione Jurisdicción</option>
                    <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.id" :value="jurisdiccion.id">{{jurisdiccion.jurisdiccion}}</option>
                </select>
            </div>
            <div class="form-group col-md-4 border-0 shadow p-3">
                <label class="text-muted" for="organismo1"><i class="fas fa-search"></i> Organismos </label>
                <select  :disabled="selectedJurisdiccion.length == 0" class="form-control form-control-md" id="organismo1" name="organismo1" v-model="selectedOrganismo">
                    <option :value="''" disabled selected>Seleccione Organismo</option>
                    <option v-for="(organismo, index) in organismos" :key="organismo.id" :value="organismo.id">{{organismo.organismo}}</option>
                </select>
            </div>

            <div class="form-group col-md-12 border-0 shadow p-3">
                <label class="text-muted" for="agente_1"><i class="fas fa-search"></i> Agentes</label>
                <select class="custom-select mr-sm-2" id="agente_1" name="agente_1"  v-model="selectedAgente">
                    <option :value="''" disabled selected>Seleccione Agente</option>
                    <option v-for="(agente, index) in agentes_organismos" :key="agente.id" :value="agente.id">{{agente.agente.cuil}} - {{agente.agente.nombre}}, {{agente.fecha_ingreso}}</option>
                </select>
            </div>
        </div>

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

        <table class="table table-borderless table-striped border" v-model="hlaborales">
            <thead >
            <tr style="text-align: center;">
                <th scope="col">Id.</th>
                <th scope="col">Puesto</th>
                <th scope="col">Clase</th>
                <th scope="col">Descripción</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col" nowrap colspan="2">Ver</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="hlaborales.length===0">
                <td colspan="6">No hay datos</td>
            </tr>
            <tr style="text-align: center;" v-for="hlaboral in hlaborales">
                <td>{{ hlaboral.id }}</td>
                <td>{{ hlaboral.puesto.cod_laboral}}</td>
                <td>{{ hlaboral.clase_id }}</td>
                <td><a data-toggle="modal" data-target="#mostrarModal" @click="mostrarHistoria(hlaboral)" >{{ hlaboral.clase.clase }}</a></td>
                <td>{{ hlaboral.fecha_inicio }}</td>
                <td>{{ hlaboral.fecha_fin }}</td>
                <td class="td-button">
                    <a @click="mostrarHistoria(hlaboral)" class="btn btn-outline-warning border-0  btn-sm shadow" data-toggle="modal" data-target="#mostrarModal"><i class="fa fa-list-alt"></i></a>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- Modal mostrar -->
        <div class="modal fade" id="mostrarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document">
                <div class="modal-content border-primary justify-content-center"  style="max-width: 40rem;">
                    <div class="modal-header">
                        <h1 class="modal-title">Historia Laboral </h1>
                    </div>

                    <div class="modal-body">
                        <form action="" class="form-group" method="POST">

                            <div class="row">
                                <div class="col">
                                    <label for="mostrarPuesto" class="required">Puesto Laboral </label>
                                    <input type="text" name="puesto" id="mostrarPuesto" value=""
                                           class="form-control"  v-model="hlaboral.puesto_id" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="mostrarClase" class="required">Clase</label>
                                    <input type="text" name="clase" id="mostrarClase" value=""
                                           class="form-control"  v-model="hlaboral.clase_id" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="mostrarFechaInicio" class="required">Fecha Inicio</label>
                                    <input type="text" name="clase" id="mostrarFechaInicio" value=""
                                           class="form-control"  v-model="hlaboral.fecha_inicio" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="mostrarFechaFin" class="required">Fecha Fin</label>
                                    <input type="text" name="clase" id="mostrarFechaFin" value=""
                                           class="form-control"  v-model="hlaboral.fecha_fin" readonly>
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


    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                jurisdicciones:[],
                jurisdiccion: [],
                organismos:[],
                selectedOrigen: [],
                selectedJurisdiccion: [],
                selectedOrganismo: [],
                selectedAgente:[],
                agentes_organismos:[],
                agentes: [],
                agente: [],
                puestos: [],
                puesto: [],
                origenes: [],
                origen: [],
                hlaborales: [],
                hlaboral: [],
                message: "",
                feedback: "",
                error_descripcion: ''
            }
        },

        mounted() {
            //this.getHistoriaLaborales();
            //this.getOrganismos();
            this.getOrigenes();

            console.log('Component mounted.')
        },

        methods: {
            getHistoriaLaborales(){
                axios.get('api/hlaborales/')
                    .then((response)=>{
                        this.hlaborales = response.data;
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
            getOrganismos(){
                axios.get('api/organismo/')
                    .then((response)=>{
                        this.organismos = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getOrigenSelected(){
                axios.get(`api/jurisdiccion/${this.selectedOrigen}`).then((response)=>{
                    console.log(response.data);
                    this.jurisdicciones = response.data;
                })
            },
            getJurisdiccionesSelected(p){
                this.selectedJurisdicion = p;
                axios.get(`api/organismo/${this.selectedJurisdicion}`).then((response)=>{
                    console.log(this.selectedJurisdicion);
                    //console.log(response.data);
                    this.organismos = response.data;
                })
            },
            getOrganismosSelected(p){
                this.selectedOrganismo = p;
                axios.get(`api/agente_organismo/${this.selectedOrganismo}`).then((response)=>{
                    console.log(response.data);
                    this.agentes_organismos = response.data;

                })
            },

            getAgentesOrganismosSelected(){
                axios.get(`api/hlaborales_puesto/${this.selectedAgente}`).then((response)=>{
                    console.log(response.data);
                    this.hlaborales = response.data;
                })
            },

            mostrarHistoria(p_historia){

                axios.get(`api/hlaborales_id/${p_historia.id}`).then((response)=>{
                    console.log(response.data);
                    this.hlaboral = response.data;
                })
            },

            empty(){
                this.hlaboral = "";
            },
        },
        watch:{

            selectedOrigen: function () {
                this.organismos = '';
                this.jurisdicciones = '';
                this.selectedJurisdiccion = "";
                this.selectedOrganismo = "";
                this.getOrigenSelected();
                if (this.selectedOrigen > 0) {
                    this.jurisdicciones = this.origenes[this.selectedOrigen-1].jurisdicciones;
                }
            },

            selectedJurisdiccion: function () {
                this.organismos = '';
                this.selectedOrganismo = "";

                if (this.selectedJurisdiccion > 0) {
                    this.getJurisdiccionesSelected(this.selectedJurisdiccion);

                }
            },

            selectedOrganismo: function () {
                this.getOrganismosSelected(this.selectedOrganismo);
                this.hlaborales = "";
            },

            selectedAgente: function () {
                this.hlaborales = "";
                this.getAgentesOrganismosSelected(this.selectedAgente);
            },
        }
    }
</script>
