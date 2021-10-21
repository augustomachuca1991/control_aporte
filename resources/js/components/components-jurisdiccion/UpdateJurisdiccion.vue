<template>
    <div
        class="modal fade"
        id="jurisdiccion_edit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalLabelEditJurisdiccion"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-olive">
                    <h5 class="modal-title" id="ModalLabelEditJurisdiccion">
                        Editar Jurisdiccion
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
                            for="input_codigo_jurisdiccion_edit"
                            class="col-sm-3 col-form-label"
                            >Codigo *</label
                        >
                        <div class="col-sm-9">
                            <input
                                v-if="editMode"
                                type="text"
                                class="form-control"
                                id="input_codigo_jurisdiccion_edit"
                                placeholder="Codigo"
                                v-model="cod_jurisdiccion"
                                disabled
                            />
                            <p class="text-justify" v-else>
                                {{ this.jurisdiccion.cod_jurisdiccion }}
                            </p>
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
                            for="input_jurisdiccion_edit"
                            class="col-sm-3 col-form-label"
                            >Jurisdiccion *</label
                        >
                        <div class="col-sm-9">
                            <input
                                v-if="editMode"
                                type="text"
                                class="form-control"
                                id="input_jurisdiccion_edit"
                                placeholder="Jurisdiccion"
                                v-model="descripcion"
                                @keydown.enter="update()"
                            />
                            <p class="text-justify" v-else>
                                {{ jurisdiccion.jurisdiccion }}
                            </p>
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
                            for="input_cod_origen"
                            class="col-sm-3 col-form-label"
                            >Origen *</label
                        >
                        <div class="col-sm-9">
                            <select
                                v-if="editMode"
                                class="custom-select"
                                id="select_origen_edit"
                                v-model="selectedOrigen"
                            >
                                <option
                                    v-for="(origen, index) in origenes"
                                    :key="index"
                                    :value="origen.cod_origen"
                                    :selected="
                                        origen.cod_origen === selectedOrigen
                                    "
                                >
                                    {{ origen.origen }}
                                </option>
                            </select>
                            <p class="text-justify" v-else>
                                {{ jurisdiccion.origen.origen }}
                            </p>
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
                        <i class="fa fa-save"></i>&nbsp;Guardar Cambbios
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
    props: ["origenes", "jurisdiccion", "index"],
    data: function() {
        return {
            editMode: false,
            cod_jurisdiccion: "",
            descripcion: "",
            selectedOrigen: "",
            errors: []
        };
    },
    mounted() {
        console.log("update jurisdiccion.");
        this.cod_jurisdiccion = this.jurisdiccion.cod_jurisdiccion;
    },
    methods: {
        clear() {
            $("#jurisdiccion_edit").modal("hide");
            this.editMode = false;
            this.cod_jurisdiccion = "";
            this.descripcion = "";
            this.selectedOrigen = "";
            this.errors = [];
        },
        update() {
            const params = {
                cod_jurisdiccion: this.cod_jurisdiccion,
                jurisdiccion: this.descripcion,
                origen_id: this.selectedOrigen,
            };

            axios
                .put(`api/jurisdiccion/update/${this.jurisdiccion.id}`, params)
                .then(response => {
                    this.clear();
                    this.$emit('jurisdiccion_update',response.data);
                })
                .catch(err => {
                    console.log(err.response.data.errors);
                    this.errors = err.response.data.errors;
                });
        },
        editar() {
            this.editMode = true;
            this.cod_jurisdiccion = this.jurisdiccion.cod_jurisdiccion;
            this.descripcion = this.jurisdiccion.jurisdiccion;
            this.selectedOrigen = this.jurisdiccion.origen.cod_origen;
        }
    }
};
</script>
