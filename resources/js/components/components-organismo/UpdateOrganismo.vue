<template>
    <div
        class="modal fade"
        id="organismo_edit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalLabelEditOrganismo"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-success">
                    <h5 class="modal-title" id="ModalLabelEditOrganismo">
                        Editar Organismo
                    </h5>
                    <button
                        @click="clear()"
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label
                            for="input_codigo_organismo_edit"
                            class="col-sm-3 col-form-label"
                            >Codigo</label
                        >
                        <div class="col-sm-9">
                            <input
                                v-if="editMode"
                                type="text"
                                class="form-control"
                                id="input_codigo_organismo_edit"
                                placeholder="Codigo"
                                v-model="cod_organismo"
                                disabled
                            />
                            <p class="text-justify" v-else>
                                {{ organismo.cod_organismo }}
                            </p>
                            <span
                                class="errors text-danger"
                                v-for="error in errors.cod_organismo"
                                :key="error.id"
                            >
                                <small
                                    ><em>{{ error }}</em></small
                                >
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="input_organismo_edit"
                            class="col-sm-3 col-form-label"
                            >Organismo</label
                        >
                        <div class="col-sm-9">
                            <input
                                v-if="editMode"
                                type="text"
                                class="form-control"
                                id="input_organismo_edit"
                                placeholder="Organismo"
                                v-model="descripcion"
                            />
                            <p class="text-justify" v-else>
                                {{ organismo.organismo }}
                            </p>
                            <span
                                class="errors text-danger"
                                v-for="error in errors.organismo"
                                :key="error.id"
                            >
                                <small
                                    ><em>{{ error }}</em></small
                                >
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="input_cod_origen"
                            class="col-sm-3 col-form-label"
                            >Origen</label
                        >
                        <div class="col-sm-9">
                            <select
                                v-if="editMode"
                                class="custom-select"
                                id="select_origen_edit"
                                v-model="selectedOrigen"
                                @change="selectOrigenes"
                                required
                            >
                                <option
                                    v-for="(origen, index) in origenes"
                                    :key="index"
                                    :value="origen.cod_origen"
                                    :selected="origen.cod_origen === selectedOrigen"
                                >
                                    {{ origen.origen }}
                                </option>
                            </select>
                            <p class="text-justify" v-else>
                                {{ organismo.jurisdiccion.origen.origen }}
                            </p>
                            <!-- <span class="errors text-danger" v-for="error in errors.origen_id">
                        <small><em>{{error}}</em></small>
                    </span> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="input_cod_jurisdiccion"
                            class="col-sm-3 col-form-label"
                            >Jurisdiccion</label
                        >
                        <div class="col-sm-9">
                            <select
                                v-if="editMode"
                                :disabled="jurisdicciones.length === 0"
                                class="custom-select"
                                id="select_jurisdiccion_edit"
                                v-model="selectedJurisdiccion"
                                @change="selectJurisdicciones"
                                required
                            >
                                <!-- <option v-if="noclick" selected :value="''">
                        {{jurisdiccion.jurisdiccion}}
                      </option> -->

                                <option
                                    v-for="(jurisdiccion,
                                    index) in jurisdicciones"
                                    :value="jurisdiccion.cod_jurisdiccion"
                                    :key="index"
                                    :selected="jurisdiccion.cod_jurisdiccion === selectedJurisdiccion"
                                >
                                    {{ jurisdiccion.jurisdiccion }}
                                </option>
                            </select>
                            <p class="text-justify" v-else>
                                {{ organismo.jurisdiccion.jurisdiccion }}
                            </p>
                            <span
                                class="errors text-danger"
                                v-for="error in errors.jurisdiccion_id"
                                :key="error.id"
                            >
                                <small
                                    ><em>{{ error }}</em></small
                                >
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        v-if="editMode"
                        type="button"
                        class="btn btn-danger btn-sm"
                        data-dismiss="modal"
                        @click="clear()"
                    >
                        Cancelar
                    </button>
                    <button
                        v-if="editMode"
                        class="btn btn-info btn-sm"
                        @click="update()"
                    >
                        <i class="fa fa-save"></i>&nbsp;Guardar Cambios
                    </button>
                    <button
                        v-else
                        type="button"
                        class="btn btn-secondary btn-sm"
                        @click="editar()"
                    >
                        <i class="fa fa-edit"></i>&nbsp;Editar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['organismo' , 'index', 'origenes'],
    data: function() {
        return {
            errors: [],
            jurisdicciones:[],
            origen:{},
            jurisdiccion:{},
            cod_organismo:"",
            descripcion: "",
            selectedOrigen:"",
            selectedJurisdiccion:"",
            indexJurisdiccion:"",
            indexOrigen:"",
            editMode: false,

        };
    },
    mounted() {
        // console.log("Component mounted.");
    },
    methods: {
        clear(){
            $("#organismo_edit").modal("hide");
            this.jurisdicciones = [];
            this.origen = {};
            this.jurisdiccion = {};
            this.cod_organismo = "";
            this.descripcion = "";
            this.selectedOrigen = "";
            this.selectedJurisdiccion = "";
            this.editMode = false;
        },
        selectOrigenes(){
            this.jurisdicciones = [];
            this.selectedJurisdiccion = "";
            if (this.selectedOrigen !== "") {
                this.origen = this.origenes[this.selectedOrigen];
                this.jurisdicciones = this.origen.jurisdicciones;
            }
        },
        selectJurisdicciones() {
            if (this.selectedOrigen !== "") {
                this.jurisdiccion = this.jurisdicciones[
                    this.selectedJurisdiccion
                ];
            }
        },
        editar(){
            this.editMode = true;
            this.cod_organismo = this.organismo.cod_organismo;
            this.descripcion = this.organismo.organismo;
            this.selectedJurisdiccion = this.organismo.jurisdiccion_id;
            this.selectedOrigen = this.organismo.jurisdiccion.origen_id;
            // this.indexJurisdiccion = ;
            // this.indexOrigen = ;

        },
        update(){

        }
    }
};
</script>
