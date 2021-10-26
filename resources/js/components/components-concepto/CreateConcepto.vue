<template>
    <div>
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn btn-primary mb-2"
            data-toggle="modal"
            data-target="#new_concepto"
        >
            + nuevo concepto
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
                            <label for="inputConcepto">Concepto</label>
                            <input
                                type="text"
                                id="inputConcepto"
                                class="form-control"
                                v-model="concepto"
                            />
                        </div>
                        <div class="form-group">
                            <label for="inputTipo">Tipo</label>
                            <select
                                id="inputTipo"
                                class="form-control custom-select"
                            >
                                <option disabled>Select one</option>
                                <option>On Hold</option>
                                <option>Canceled</option>
                                <option selected>Remunerativo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSubtipo">Subtipo</label>
                            <select
                                id="inputSubtipo"
                                class="form-control custom-select"
                            >
                                <option disabled>Select one</option>
                                <option>On Hold</option>
                                <option>Canceled</option>
                                <option selected>Antigüedad</option>
                            </select>
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
                            <label for="inputOrganismo">Organismo</label>
                            <select
                                id="inputOrganismo"
                                class="form-control custom-select"
                            >
                                <option disabled>Select one</option>
                                <option>On Hold</option>
                                <option>Canceled</option>
                                <option selected>Saladas</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cerrar
                        </button>
                        <button type="button" class="btn btn-primary">
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
    props: ["concepto", "index"],
    data: function() {
        return {
            errors: [],
            tipos: [],
            subtipos: [],
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
        this.getTiposCodigos();
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
            this.unidad = this.concepto.unidad;
        },
        clear() {
            //$("#show_concepto").modal("hide");
            this.editMode = false;
            this.descripcion = "";
            this.subtipo = "";
            this.tipo = "";
            this.organismo = "";
            this.unidad = "";
            this.subtipos = [];
            this.errors = [];
        },
        update() {
            const param = {
                cod_concepto: this.concepto.cod_concepto,
                unidad: this.unidad,
                concepto: this.descripcion,
                organismo_id: this.concepto.organismo_id,
                subtipo_id: this.selectedSubtipo
            };
            axios
                .put(`api/concepto/update/${this.concepto.id}`, param)
                .then(response => {
                    $("#show_concepto").modal("hide");
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
