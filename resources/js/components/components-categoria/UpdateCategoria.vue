<template>
    <div
        class="modal fade"
        id="categoria_edit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalLabelEditCategoria"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-info">
                    <h5 class="modal-title" id="ModalLabelEditCategoria">
                        Editar Categoria
                    </h5>
                    <button
                        @click="clear()"
                        type="button"
                        class="close text-white"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label
                            for="input_codigo_categoria_edit"
                            class="col-sm-3 col-form-label"
                            >Codigo *</label
                        >
                        <div class="col-sm-9">
                            <input
                                v-if="editMode"
                                type="text"
                                class="form-control"
                                id="input_codigo_categoria_edit"
                                placeholder="Codigo"
                                v-model="cod_categoria"
                                disabled
                            />
                            <p class="text-justify" v-else>
                                {{ categoria.cod_categoria }}
                            </p>
                            <span
                                class="errors text-danger"
                                v-for="error in errors.cod_categoria"
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
                            for="input_clase_edit"
                            class="col-sm-3 col-form-label"
                            >Categoria *</label
                        >
                        <div class="col-sm-9">
                            <input
                                v-if="editMode"
                                type="text"
                                class="form-control"
                                id="input_clase_edit"
                                placeholder="Categoria"
                                v-model="descripcion"
                            />
                            <p class="text-justify" v-else>
                                {{ categoria.categoria }}
                            </p>
                            <span
                                class="errors text-danger"
                                v-for="error in errors.categoria"
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
                            for="input_clase_edit"
                            class="col-sm-3 col-form-label"
                            >Jurisdicciones *</label
                        >
                        <div class="col-sm-9">
                            <!-- <input
                                v-if="editMode"
                                type="text"
                                class="form-control"
                                id="input_clase_edit"
                                placeholder="Categoria"
                                v-model="descripcion"
                            /> -->
                            <div v-if="editMode">
                                <div
                                    class="form-check"
                                    v-for="(jurisdiccion,
                                    index) in jurisdicciones"
                                    :key="jurisdiccion.id"
                                >
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        :value="jurisdiccion.cod_jurisdiccion"
                                        :id="index"
                                        v-model="selectedJurisdicciones"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="flexCheckDefault"
                                    >
                                        {{ jurisdiccion.jurisdiccion }}
                                    </label>
                                </div>
                            </div>
                            <ul class="text-justify" v-else>
                                <li
                                    v-for="jurisdiccion in categoria.jurisdicciones"
                                    :key="jurisdiccion.id"
                                >
                                    {{ jurisdiccion.jurisdiccion }}
                                </li>
                            </ul>
                            <span
                                class="errors text-danger"
                                v-for="error in errors.categoria"
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
    props: ["jurisdicciones", "categoria", "index"],
    data: function() {
        return {
            errors: [],
            editMode: false,
            cod_categoria: "",
            descripcion: "",
            selectedJurisdicciones: []
        };
    },
    mounted() {
        console.log("update categoria");
    },
    methods: {
        clear() {
            $("#categoria_edit").modal("hide");
            this.errors = [];
            (this.descripcion = ""), (this.editMode = false);
            this.cod_categoria = "";
            this.jurisdicciones_id = [];
        },
        update() {
            const params = {
                cod_categoria: this.cod_categoria,
                categoria: this.descripcion,
                jurisdicciones_id: this.selectedJurisdicciones
            };

            axios
                .put(`api/categoria/update/${this.categoria.id}`, params)
                .then(response => {
                    this.clear();
                    this.$emit("categoria_update", [response.data, this.index]);
                    // Toast.fire({
                    //     icon: "success",
                    //     title:
                    //         "La categoria " +
                    //         response.data.categoria +
                    //         " se edito con exitó",
                    //     background: "#E7FFD7"
                    // });
                    // this.categorias[this.selectedCategoria] = response.data;
                    // this.empty();
                    //alert(JSON.stringify(response.data))
                })
                .catch(err => {
                    console.log(err.response.data.errors);
                    this.errores = err.response.data.errors;
                });
        },
        editar() {
            this.editMode = true;
            this.cod_categoria = this.categoria.cod_categoria;
            this.descripcion = this.categoria.categoria;
            this.selectedJurisdicciones = this.categoria.jurisdicciones.map(
                item => item.cod_jurisdiccion
            );
        }
    }
};
</script>
