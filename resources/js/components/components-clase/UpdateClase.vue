<template>
    <div
        class="modal fade"
        id="clase_edit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalLabelEditClase"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-teal">
                    <h5 class="modal-title" id="ModalLabelEditClase">
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
                    <!-- {{clase}} -->
                    <div class="form-group row">
                        <label
                            for="input_codigo_clase_edit"
                            class="col-sm-3 col-form-label"
                            >Codigo *</label
                        >
                        <div class="col-sm-9">
                            <input
                                v-if="editMode"
                                type="text"
                                class="form-control"
                                id="input_codigo_clase_edit"
                                placeholder="Codigo"
                                v-model="cod_clase"
                                disabled
                            />
                            <p class="text-justify" v-else>
                                {{ clase.cod_clase }}
                            </p>
                            <!-- <span class="errors text-danger" v-for="error in errores.cod_clase">
                    <small><em>{{error}}</em></small>
                </span> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="input_clase_edit"
                            class="col-sm-3 col-form-label"
                            >Clase *</label
                        >
                        <div class="col-sm-9">
                            <input
                                v-if="editMode"
                                type="text"
                                class="form-control"
                                id="input_clase_edit"
                                placeholder="Clase"
                                v-model="descripcion"
                            />
                            <p class="text-justify" v-else>
                                {{ clase.clase }}
                            </p>
                            <span
                                class="errors text-danger"
                                v-for="error in errors.clase"
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
                            >Categoria *</label
                        >
                        <div class="col-sm-9">
                            <select
                                v-if="editMode"
                                class="custom-select"
                                id="select_origen_edit"
                                v-model="selectedCategoria"
                                required
                            >
                                <option
                                    v-for="(categoria, index) in categorias"
                                    :key="index"
                                    :value="categoria.cod_categoria"
                                    :selected="categoria.cod_categoria === selectedCategoria"
                                >
                                    {{ categoria.categoria }}
                                </option>
                            </select>
                            <p class="text-justify" v-else>
                                {{ clase.categoria.categoria }}
                            </p>
                            <span
                                class="errors text-danger"
                                v-for="error in errors.categoria_id"
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
    props: ["categorias", "clase", "index"],
    data: function() {
        return {
            errors: [],
            editMode: false,
            cod_clase: "",
            descripcion: "",
            selectedCategoria: "",
            editMode:false,
        };
    },
    mounted() {
        console.log("update clase");
    },
    methods: {
        clear() {
            $("#clase_edit").modal("hide");
            this.errors = [];
            this.descripcion = ""; 
            this.editMode = false;
            this.cod_clase= "";
            this.selectedCategoria = "";
        },
        update() {
            const param = {
                cod_clase: this.cod_clase,
                clase: this.descripcion,
                categoria_id: this.selectedCategoria
            };

            axios
                .put(`api/clase/update/${this.clase.id}`, param)
                .then(response => {
                    this.clear();
                    this.$emit("clase_update", [response.data, this.index]);
                })
                .catch(err => {
                    console.log(err.response.data.errors);
                    this.errors = err.response.data.errors;
                });
        },
        editar() {
            this.editMode = true;
            this.cod_clase = this.clase.cod_clase;
            this.descripcion = this.clase.clase;
            this.selectedCategoria = this.clase.categoria.id
        }
    }
};
</script>
