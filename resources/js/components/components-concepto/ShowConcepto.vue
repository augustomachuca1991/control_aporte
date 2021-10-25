<template>
    <div
        id="show_concepto"
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
                                    Concepto
                                </div>
                                <div class="col-6">
                                    <i>{{ concepto.concepto }}</i>
                                    <input
                                        class="form-control"
                                        type="text"
                                        v-if="editMode"
                                        v-model="descripcion"
                                    />
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Subtipo
                                </div>
                                <div class="col-6">
                                    <i>{{ concepto.subtipo.descripcion }}</i>
                                    <div v-if="editMode">
                                        <select
                                            class="custom-select mr-sm-2"
                                            id="selectSubtipo"
                                            v-model="selectedSubtipo"
                                        >
                                            <option
                                                v-for="(subtipo,
                                                index) in subtipos"
                                                :key="index"
                                                :value="subtipo.id"
                                                :selected="
                                                    subtipo.id ===
                                                        selectedSubtipo
                                                "
                                                >{{ subtipo.descripcion }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Tipo
                                </div>
                                <div class="col-6">
                                    <i>{{
                                        concepto.subtipo.tipocodigo.descripcion
                                    }}</i>
                                    <div v-if="editMode">
                                        <select
                                            class="custom-select mr-sm-2"
                                            id="selectTipo"
                                            v-model="selectedTipo"
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
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Organismo
                                </div>
                                <div class="col-6">
                                    <i>{{ concepto.organismo.organismo }}</i>
                                    <!-- <div v-if="editMode">
                                        <select
                                            class="custom-select mr-sm-2"
                                            id="selectOrganismo"
                                            v-model="organismo"
                                        >
                                            <option selected>Choose...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div> -->
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Unidad
                                </div>
                                <div class="col-6">
                                    <i
                                        >Lorem ipsum dolor, sit amet consectetur
                                        adipisicing elit. Et eum voluptat</i
                                    >
                                    <input
                                        class="form-control"
                                        type="text"
                                        v-if="editMode"
                                        v-model="unidad"
                                    />
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer" v-if="editMode">
                    <button type="button" class="btn btn-danger" @click="clear">
                        Cancelar
                    </button>

                    <button
                        type="button"
                        class="btn btn-primary"
                        @click="update"
                        data-toggle="modal"
                        data-target="#concepto_edit"
                    >
                        Guardar Cambios
                    </button>
                </div>
                <div class="modal-footer" v-else>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click="edit"
                        data-toggle="modal"
                        data-target="#concepto_edit"
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
    props: ["concepto", "index"],
    data: function() {
        return {
            tipos: [
                { id: "1", descripcion: "Remunerativo" },
                { id: "2", descripcion: "Remunerativo Bonificable" },
                { id: "3", descripcion: "Remunerativo No Bonificable" },
                { id: "4", descripcion: "No Remunerativo No Bonificable" },
                { id: "5", descripcion: "Adicionales Sociales" },
                { id: "6", descripcion: "Descuento" }
            ],
            subtipos: [
                {
                    id: 1,
                    descripcion: "Sueldo Basico",
                    tipocodigo_id: 1,
                    deleted_at: null,
                    created_at: "2021-10-25T11:38:24.000000Z",
                    updated_at: null
                },
                {
                    id: 2,
                    descripcion: "Antiguedad",
                    tipocodigo_id: 1,
                    deleted_at: null,
                    created_at: "2021-10-25T11:38:24.000000Z",
                    updated_at: null
                },
                {
                    id: 3,
                    descripcion: "Adicional",
                    tipocodigo_id: 2,
                    deleted_at: null,
                    created_at: "2021-10-25T11:38:24.000000Z",
                    updated_at: null
                },
                {
                    id: 4,
                    descripcion: "Adicional",
                    tipocodigo_id: 3,
                    deleted_at: null,
                    created_at: "2021-10-25T11:38:24.000000Z",
                    updated_at: null
                },
                {
                    id: 5,
                    descripcion: "Adicional",
                    tipocodigo_id: 4,
                    deleted_at: null,
                    created_at: "2021-10-25T11:38:24.000000Z",
                    updated_at: null
                },
                {
                    id: 6,
                    descripcion: "Salario Familiar",
                    tipocodigo_id: 5,
                    deleted_at: null,
                    created_at: "2021-10-25T11:38:24.000000Z",
                    updated_at: null
                },
                {
                    id: 7,
                    descripcion: "Hijo",
                    tipocodigo_id: 5,
                    deleted_at: null,
                    created_at: "2021-10-25T11:38:24.000000Z",
                    updated_at: null
                },
                {
                    id: 8,
                    descripcion: "Esposa",
                    tipocodigo_id: 5,
                    deleted_at: null,
                    created_at: "2021-10-25T11:38:24.000000Z",
                    updated_at: null
                },
                {
                    id: 9,
                    descripcion: "Aporte Jubilatorio",
                    tipocodigo_id: 6,
                    deleted_at: null,
                    created_at: "2021-10-25T11:38:24.000000Z",
                    updated_at: null
                },
                {
                    id: 10,
                    descripcion: "Sobre Remunerativo",
                    tipocodigo_id: 6,
                    deleted_at: null,
                    created_at: "2021-10-25T11:38:24.000000Z",
                    updated_at: null
                },
                {
                    id: 11,
                    descripcion: "Otros",
                    tipocodigo_id: 6,
                    deleted_at: null,
                    created_at: "2021-10-25T11:38:24.000000Z",
                    updated_at: null
                }
            ],
            editMode: false,
            descripcion: "",
            subtipo: "",
            tipo: "",
            organismo: "",
            unidad: "",
            selectedTipo: "",
            selectedSubtipo: ""
        };
    },
    mounted() {
        console.log("Component mounted.");
    },
    methods: {
        edit() {
            //this.$emit("concepto_show", [this.concepto, this.index]);
            this.editMode = true;
            //this.tipos = this.getTipos();
            this.selectedTipo = this.concepto.subtipo.tipocodigo.id;
            this.selectedSubtipo = this.concepto.subtipo.id;
            this.descripcion = this.concepto.concepto;
            this.subtipo = this.concepto.subtipo.descripcion;
            this.tipo = this.concepto.subtipo.tipocodigo.descripcion;
            this.organismo = this.concepto.organismo.organismo;
            this.unidad = "Lorem ipsum";
        },
        clear() {
            //$("#show_concepto").modal("hide");
            this.editMode = false;
            this.descripcion = "";
            this.subtipo = "";
            this.tipo = "";
            this.organismo = "";
            this.unidad = "";
        },
        update() {
            $("#show_concepto").modal("hide");
            this.clear;
            const params = {
                cod_concepto: this.concepto.cod_concepto,
                unidad: "unidad",
                concepto: this.descripcion,
                organismo_id: this.concepto.organismo_id,
                subtipo_id: this.selectedSubtipo
            };
            alert(JSON.stringify(params));
        },
        getTipos() {}
    }
};
</script>
