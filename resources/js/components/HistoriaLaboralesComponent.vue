<template>
    <div id="historia_laborales" style="overflow-x:auto;">

        <div class="form-row col mb-3 shadow p-3">
            <div class="form-group col-md-6 border-0 shadow p-3">
                <label class="text-muted" for="organismo1"><i class="fas fa-search"></i> Organismos</label>
                <select class="custom-select mr-sm-2" id="organismo1" name="organismo1"  v-model="selectedOrganismo">
                    <option :value="''" disabled selected>Seleccione Organismo</option>
                    <option v-for="(organismo, index) in organismos" :key="organismo.cod_organismo" :value="organismo.cod_organismo">{{organismo.organismo}}</option>
                </select>
            </div>
            <div class="form-group col-md-6 border-0 shadow p-3">
                <label class="text-muted" for="agente_1"><i class="fas fa-search"></i> Agentes</label>
                <select class="custom-select mr-sm-2" id="agente_1" name="agente_1"  v-model="selectedAgente">
                    <option :value="''" disabled selected>Seleccione Agente</option>
                    <option v-for="(agente, index) in agentes" :key="agente.id" :value="agente.id">{{agente.nombre}}, {{agente.cuil}}</option>
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
                <th scope="col">puesto</th>
                <th scope="col">clase</th>
                <th scope="col">Fecha Ingreso</th>
                <th scope="col">Fecha Egreso</th>
                <th scope="col" nowrap colspan="2">Opciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="hlaborales.length===0">
                <td colspan="6">No hay datos</td>
            </tr>
            <tr style="text-align: center;" v-for="hlaboral in hlaborales">
                <td>{{ hlaboral.id }}</td>
                <td>{{ hlaboral.puesto_id }}</td>
                <td><a data-toggle="modal" data-target="#mostrarModal" @click="mostrarHistoria(hlaboral)" >{{ hlaboral.clase_id }}</a></td>
                <td>{{ hlaboral.fecha_ingreso }}</td>
                <td>{{ hlaboral.fecha_egreso }}</td>
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
                        <h1 class="modal-title">Detalle Historia Laboral</h1>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form-group" method="POST">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group" v-model="agente">
                                        <label class="required" for="mostrarAgentes" >Origen</label>
                                        <select class="custom-select mr-sm-2" id="mostrarAgentes" name="agente" v-model="hlaboral.agente_id" disabled>
                                            <option>Seleccione Agentes</option>
                                            <option v-for="(agente, index) in agentes" :key="agente.id" :value="agente.id">{{agente.nombre}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="mostrarPuesto" class="required">Puesto Laboral</label>
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
                                    <label for="mostrarFechaEgreso" class="required">Fecha Egreso</label>
                                    <input type="text" name="clase" id="mostrarFechaEgreso" value=""
                                           class="form-control"  v-model="hlaboral.fecha_egreso" readonly>
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
            this.getOrganismos(),


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
            getOrganismos(){
                axios.get('api/organismo/')
                    .then((response)=>{
                        this.organismos = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getOrganismosSelected(){
                axios.get(`api/agente/${this.selectedOrganismo}`).then((response)=>{
                    console.log(response.data);
                    this.agentes = response.data;
                })
            },

            getAgentesSelected(){
                axios.get(`api/hlaborales/${this.selectedAgente()}`).then((response)=>{
                    console.log(response.data);
                    this.hlaborales = response.data;
                })
            },

            empty(){
                this.getHistoriaLaborales();
                this.getOrganismos()
            },
        },
        watch:{
            selectedOrganismo: function () {
                this.getOrganismosSelected();
                this.hlaborales = [];
            },
            selectedAgente: function () {
                this.getAgentesSelected(this.selectedAgente());
            }
        }
    }
</script>
