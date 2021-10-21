<template>
    <div
        class="modal fade"
        id="organismo_new"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalLabelnuevo_organismo"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" @submit.prevent="newOrganismo()">
                    <div class="modal-header bg-gradient-success">
                        <h5 class="modal-title" id="ModalLabelnuevo_organismo">
                            Nuevo Organismo
                        </h5>
                        <button
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
                                for="input_cod_organismo"
                                class="col-sm-3 col-form-label"
                                >Codigo *</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="input_cod_organismo"
                                    v-model="cod_organismo"
                                />
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
                                for="input_organismo"
                                class="col-sm-3 col-form-label"
                                >Organismo *</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="input_organismo"
                                    v-model="descripcion"
                                />
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
                                for="select_origen"
                                class="col-sm-3 col-form-label"
                                >Origen *</label
                            >
                            <div class="col-sm-9">
                                <select
                                    class="custom-select"
                                    id="select_origen"
                                    v-model="selectedOrigen"
                                    @change="selectedOrigenes()"
                                    required
                                >
                                    <option selected disabled :value="''"
                                        >Seleccione Origen...</option
                                    >
                                    <option
                                        v-for="(origen, index) in origenes"
                                        :key="origen.id"
                                        :value="index"
                                    >
                                        {{ origen.origen }}
                                    </option> </select
                                ><!-- 
                      <span class="errors text-danger" v-for="error in errors.origen_id" >
                          <small><em>{{error}}</em></small>
                      </span> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                for="select_origen"
                                class="col-sm-3 col-form-label"
                                >Jurisdiccion *</label
                            >
                            <div class="col-sm-9">
                                <select
                                    :disabled="jurisdicciones.length === 0"
                                    class="custom-select"
                                    id="select_jurisdiccion"
                                    v-model="selectedJurisdiccion"
                                    @change="selectJurisdicciones"
                                    required
                                >
                                    <option selected disabled :value="''"
                                        >Seleccione Jurisdiccion...</option
                                    >
                                    <option
                                        v-for="(jurisdiccion,
                                        index) in jurisdicciones"
                                        :key="jurisdiccion.id"
                                        :value="index"
                                    >
                                        {{ jurisdiccion.jurisdiccion }}
                                    </option>
                                </select>
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
                        <span
                            ><small><em>(*) obligatorio</em></small></span
                        >
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    //props: ["jurisdicciones"],
    data: function() {
        return {
            errors: [],
            origenes: [],
            jurisdicciones: [],
            origen: {},
            jurisdiccion: {},
            cod_organismo: "",
            descripcion: "",
            selectedOrigen: "",
            selectedJurisdiccion: ""
        };
    },
    mounted() {
        this.getOrigenes();
    },
    methods: {
        getOrigenes() {
            axios.get("api/origen/all").then(response => {
                this.origenes = response.data;
            });
        },
        clear() {
            $("#organismo_new").modal("hide");
            this.errors = [];
            //this.origenes = [];
            this.jurisdicciones = [];
            this.origen = {};
            this.jurisdiccion = {};
            this.cod_organismo = "";
            this.descripcion = "";
            this.selectedOrigen = "";
            this.selectedJurisdiccion = "";
        },
        selectedOrigenes() {
            this.jurisdicciones = [];
            this.selectedJurisdiccion = "";
            if (this.selectedOrigen !== "") {
                this.origen = this.origenes[this.selectedOrigen];
                this.jurisdicciones = this.origen.jurisdicciones;
            }
        },
        selectJurisdicciones() {
            if (this.selectedJurisdiccion !== "") {
                this.jurisdiccion = this.jurisdicciones[
                    this.selectedJurisdiccion
                ];
            }
        },
        newOrganismo() {
            const params = {
                cod_organismo: this.cod_organismo,
                organismo: this.descripcion,
                jurisdiccion_id: this.jurisdiccion.id
            };
            this.create(params);
        },
        create(params) {
            axios
                .post("api/organismo/create", params)
                .then(response => {
                    this.clear();
                    this.$emit("organismo", response.data);
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                });
        }
    }
};
</script>
