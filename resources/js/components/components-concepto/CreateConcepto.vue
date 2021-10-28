<template>
    <div>
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn bg-olive mb-2"
            data-toggle="modal"
            data-target="#new_concepto"
        >
            + Nuevo Concepto
        </button>

        <!-- Modal -->
        <div
            class="modal fade"
            id="new_concepto"
            tabindex="-1"
            aria-labelledby="new_conceptoLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
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
                        <div class="form-group">
                            <label for="inputcod">Cod Concepto*</label>
                            <input
                                type="text"
                                id="inputcod"
                                class="form-control"
                                v-model="cod_concepto"
                            />
                            <div v-if="!errors.length">
                                <span
                                    class="errors text-danger"
                                    v-for="error in errors.cod_concepto"
                                    :key="error.id"
                                >
                                    <small
                                        ><em>{{ error }}</em></small
                                    >
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputConcepto">Concepto*</label>
                            <input
                                type="text"
                                id="inputConcepto"
                                class="form-control"
                                v-model="concepto"
                            />
                            <div v-if="!errors.length">
                                <span
                                    class="errors text-danger"
                                    v-for="error in errors.concepto"
                                    :key="error.id"
                                >
                                    <small
                                        ><em>{{ error }}</em></small
                                    >
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTipo">Tipo*</label>
                            <select
                                id="inputTipo"
                                class="form-control custom-select"
                                v-model="tipo"
                                @change="selectedTipo"
                            >
                                <option :value="''" disabled selected
                                    >Seleccione un tipo de concepto de
                                    liquidación</option
                                >
                                <option
                                    v-for="(tipo, index) in tipos"
                                    :key="tipo.id"
                                    :value="index"
                                >
                                    {{ tipo.id }} - {{ tipo.descripcion }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSubtipo">Subtipo*</label>
                            <select
                                id="inputSubtipo"
                                class="form-control custom-select"
                                v-model="subtipo"
                                :disabled="!subtipos.length"
                            >
                                <option :value="''" disabled selected
                                    >Seleccione un subtipo de concepto de
                                    liquidación</option
                                >
                                <option
                                    v-for="(subtipo, index) in subtipos"
                                    :key="index"
                                    :value="subtipo.id"
                                    >{{ subtipo.id }} -
                                    {{ subtipo.descripcion }}</option
                                >
                            </select>
                            <div v-if="!errors.length">
                                <span
                                    class="errors text-danger"
                                    v-for="error in errors.subtipo_id"
                                    :key="error.id"
                                >
                                    <small
                                        ><em>{{ error }}</em></small
                                    >
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputUnidad">Unidad</label>
                            <input
                                type="text"
                                id="inputUnidad"
                                class="form-control"
                                v-model="unidad"
                            />
                        </div>
                        <div class="form-group">
                            <label for="inputOrganismo">Organismo*</label>
                            <select
                                id="inputOrganismo"
                                class="form-control custom-select"
                                v-model="organismo"
                            >
                                <option :value="''" disabled selected
                                    >Seleccione un organismo</option
                                >

                                <option
                                    v-for="(organismo, index) in organismos"
                                    :key="index"
                                    :value="organismo.cod_organismo"
                                    >{{ organismo.organismo }}</option
                                >
                            </select>
                            <div v-if="!errors.length">
                                <span
                                    class="errors text-danger"
                                    v-for="error in errors.organismo_id"
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
                        <small><i>(*) campos obligatorios</i></small>
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cerrar
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="newConcepto"
                        >
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            errors: [],
            tipos: [],
            subtipos: [],
            organismos: [],
            cod_concepto: "",
            concepto: "",
            subtipo: "",
            tipo: "",
            organismo: "",
            unidad: ""
        };
    },
    mounted() {
        this.getTiposCodigos();
        this.getOrganismos();
    },
    methods: {
        getTiposCodigos() {
            axios.get("api/tipocodigo").then(response => {
                this.tipos = response.data;
            });
        },
        getOrganismos() {
            axios.get("api/organismo/all").then(response => {
                this.organismos = response.data;
            });
        },
        clear() {
            $("#new_concepto").modal("hide");
            this.errors = [];
            this.subtipos = [];
            this.cod_concepto = "";
            this.concepto = "";
            this.subtipo = "";
            this.tipo = "";
            this.organismo = "";
            this.unidad = "";
        },
        selectedTipo() {
            this.subtipo = "";
            this.subtipos = [];
            if (this.tipo !== "") {
                this.subtipos = this.tipos[this.tipo].subtipos;
            }
        },
        newConcepto() {
            const param = {
                cod_concepto: this.cod_concepto,
                concepto: this.concepto,
                organismo_id: this.organismo,
                subtipo_id: this.subtipo
            };
            this.create(param);
        },
        create(concepto) {
            axios
                .post("api/concepto/create", concepto)
                .then(response => {
                    this.clear();
                    this.$emit("concepto", response.data);
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                });
        }
    }
};
</script>
