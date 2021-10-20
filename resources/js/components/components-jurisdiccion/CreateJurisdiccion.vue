<template>
    <!-- Modal nueva jurisdiccion -->
    <div
        class="modal fade"
        id="jurisdiccion_new"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalLabelNewJurisdiccion"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form @submit.prevent="newJurisdiccion()">
                    <div class="modal-header bg-gradient-olive">
                        <h5 class="modal-title" id="ModalLabelNewJurisdiccion">
                            Nueva Jurisdiccion
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times; </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label
                                for="input_codigo_jurisdiccion"
                                class="col-sm-3 col-form-label"
                                >Codigo *</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="input_codigo_jurisdiccion"
                                    v-model="selectedJurisdiccion"
                                />
                                <span
                                    class="errors text-danger"
                                    v-for="error in errors.cod_jurisdiccion"
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
                                for="input_jurisdiccion"
                                class="col-sm-3 col-form-label"
                                >Jurisdiccion *</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="input_jurisdiccion"
                                    v-model="descripcion"
                                />
                                <span
                                    class="errors text-danger"
                                    v-for="error in errors.jurisdiccion"
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
                                    :disabled="origenes.length === 0"
                                    class="custom-select"
                                    id="select_origen"
                                    v-model="selectedOrigen"
                                >
                                    <option selected disabled :value="''"
                                        >Seleccione Origen...</option
                                    >
                                    <option
                                        v-for="(origen, index) in origenes"
                                        :key="index"
                                        :value="origen.cod_origen"
                                    >
                                        {{ origen.origen }}
                                    </option>
                                </select>
                                <span
                                    class="errors text-danger"
                                    v-for="error in errors.origen_id"
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
    props: ["origenes"],
    data: function() {
        return {
            errors: [],
            selectedOrigen: "",
            selectedJurisdiccion: "",
            descripcion: ""
        };
    },
    mounted() {
        console.log("create jurisdiccion");
    },
    methods: {
        newJurisdiccion() {
            const params = {
                cod_jurisdiccion: this.selectedJurisdiccion,
                jurisdiccion: this.descripcion,
                origen_id: this.selectedOrigen,
            };
            this.create(params);
            
        },
        clear() {
            $("#jurisdiccion_new").modal("hide");
            this.errors = [];
            this.descripcion = "";
            this.selectedJurisdiccion = "";
            this.selectedOrigen = "";
        },
        create(params){
            axios
                .post("api/jurisdiccion/create", params)
                .then(response => {
                    this.clear();
                    this.$emit('jurisdiccion',response.data);
                    
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                });
        }
    }
};
</script>
