<template>
    <div
        id="concepto_edit"
        class="modal fade bd-example-modal-lg"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img
                        src="image/logo-ips-header.png"
                        width="150"
                        height="30"
                        alt=""
                    />

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        @click="clear"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <h5 class="modal-title center">
                            Concepto - {{ concepto.concepto | capitalize }}
                        </h5>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Concepto *
                                </div>
                                <div class="col-6">
                                    <input
                                        class="form-control"
                                        type="text"
                                        v-if="editMode"
                                        v-model="descripcion"
                                    />
                                    <i v-else>{{ concepto.concepto }}</i>
                                    <div v-if="errors.length">
                                        <span
                                            class="errors text-danger"
                                            v-for="error in errors.concepto"
                                            :key="error.id"
                                        >
                                            <small>
                                                <em>{{ error }}</em>
                                            </small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Tipo Concepto *
                                </div>
                                <div class="col-6">
                                    <div v-if="editMode">
                                        <select
                                            class="custom-select mr-sm-2"
                                            id="selectTipo"
                                            v-model="selectedTipo"
                                            @change="selectedTipos"
                                        >
                                            <option
                                                v-for="(tipo, index) in tipos"
                                                :key="index"
                                                :value="tipo.id"
                                                :selected="
                                                    tipo.id === selectedTipo
                                                "
                                                >{{ tipo.descripcion }}
                                            </option>
                                        </select>
                                    </div>
                                    <i v-else>{{
                                        concepto.subtipo.tipocodigo.descripcion
                                    }}</i>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Subtipo Concepto *
                                </div>
                                <div class="col-6">
                                    <div v-if="editMode">
                                        <select
                                            class="custom-select mr-sm-2"
                                            id="selectSubtipo"
                                            v-if="subtipos.length"
                                            v-model="selectedSubtipo"
                                        >
                                            <option
                                                v-for="(subtipo,
                                                index) in subtipos"
                                                :key="index"
                                                :value="subtipo.id"
                                                :selected="
                                                    selectedSubtipo ===
                                                        subtipo.id
                                                "
                                                >{{ subtipo.id }} -
                                                {{ subtipo.descripcion }}
                                            </option>
                                        </select>
                                        <select
                                            class="custom-select mr-sm-2"
                                            id="selectSubtipo"
                                            v-else
                                            disabled
                                        >
                                            <option selected>{{
                                                concepto.subtipo.descripcion
                                            }}</option></select
                                        >
                                    </div>
                                    <i v-else>{{
                                        concepto.subtipo.descripcion
                                    }}</i>
                                    <div v-if="errors.length">
                                        <span
                                            class="errors text-danger"
                                            v-for="error in errors.subtipo_id"
                                            :key="error.id"
                                        >
                                            <small>
                                                <em>{{ error }}</em>
                                            </small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Unidad
                                </div>
                                <div class="col-6">
                                    <input
                                        v-if="editMode"
                                        class="form-control"
                                        type="text"
                                        v-model="unidad"
                                    />
                                    <i v-else>{{ concepto.unidad }} </i>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Organismo
                                </div>
                                <div class="col-6">
                                    {{ concepto.organismo.organismo }}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer" v-if="editMode">
                    <small><i>(*) campos obligatorios</i></small>
                    <button type="button" class="btn btn-danger" @click="clear">
                        Cancelar
                    </button>

                    <button
                        type="button"
                        class="btn btn-primary"
                        @click="update"
                    >
                        Guardar Cambios
                    </button>
                </div>
                <div class="modal-footer" v-else>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click="edit"
                    >
                        Editar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["concepto", "index", "user"],
    data: function() {
        return {
            errors: [],
            tipos: [],
            subtipos: [],
            editMode: false,
            descripcion: "",
            organismo: "",
            unidad: "",
            selectedTipo: "",
            selectedSubtipo: ""
        };
    },
    mounted() {
        this.getTiposCodigos();
    },
    methods: {
        edit() {
            this.editMode = true;
            this.selectedTipo = this.concepto.subtipo.tipocodigo.id;
            this.selectedSubtipo = this.concepto.subtipo.id;
            this.descripcion = this.concepto.concepto;
            this.selectedSubtipo = this.concepto.subtipo.id;
            this.selectedTipo = this.concepto.subtipo.tipocodigo.id;
            this.organismo = this.concepto.organismo.organismo;
            this.unidad = this.concepto.unidad;
        },
        clear() {
            this.editMode = false;
            this.descripcion = "";
            this.organismo = "";
            this.unidad = "";
            this.subtipos = [];
            this.errors = [];
            this.selectedTipo = "";
            this.selectedSubtipo = "";
        },
        update() {
            const param = {
                cod_concepto: this.concepto.cod_concepto,
                unidad: this.unidad,
                concepto: this.descripcion,
                organismo_id: this.concepto.organismo_id,
                subtipo_id: this.selectedSubtipo,
                user_id: this.user.id
            };
            axios
                .put(`api/concepto/update/${this.concepto.id}`, param)
                .then(response => {
                    $("#concepto_edit").modal("hide");
                    this.clear();
                    this.$emit("concepto_update", [response.data, this.index]);
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                });
        },
        selectedTipos() {
            if (this.selectedTipo !== "") {
                this.subtipos = this.tipos[this.selectedTipo - 1].subtipos;
            }
        },
        getTiposCodigos() {
            axios.get("api/tipocodigo").then(response => {
                this.tipos = response.data;
            });
        }
    }
};
</script>
