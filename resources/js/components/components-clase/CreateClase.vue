<template>
    <div
        class="modal fade"
        id="clase_new"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalLabelNewClase"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" @submit.prevent="newClase()">
                    <div class="modal-header bg-gradient-teal">
                        <h5 class="modal-title" id="ModalLabelNewClase">
                            Nueva Clase
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="clear()"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label
                                for="input_codigo_clase"
                                class="col-sm-3 col-form-label"
                                >Codigo *</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="input_codigo_clase"
                                    v-model="cod_clase"
                                />
                                <span
                                    class="errors text-danger"
                                    v-for="error in errors.cod_clase"
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
                                for="input_clase"
                                class="col-sm-3 col-form-label"
                                >Clase *</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="input_clase"
                                    v-model="descripcion"
                                />
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
                                for="select_categoria"
                                class="col-sm-3 col-form-label"
                                >Categoria *</label
                            >
                            <div class="col-sm-9">
                                <select
                                    :disabled="categorias.length === 0"
                                    class="custom-select"
                                    id="select_categoria"
                                    v-model="selectedCategoria"
                                    required
                                >
                                    <option selected disabled :value="''"
                                        >Seleccione Categoria...</option
                                    >
                                    <option
                                        v-for="(categoria, index) in categorias"
                                        :key="index"
                                        :value="categoria.id"
                                    >
                                        {{ categoria.categoria }}
                                    </option>
                                </select>
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
    props: ["categorias"],
    data: function() {
        return {
            errors: [],
            cod_clase: "",
            descripcion: "",
            selectedCategoria: "",
        };
    },
    mounted() {
        console.log("create clase");
    },
    methods: {
        newClase() {
            const params = {
                cod_clase: this.cod_clase,
                clase: this.descripcion,
                categoria_id: this.selectedCategoria
            };
            this.create(params);
        },
        create(params){
            axios
                .post("api/clase/create", params)
                .then(response => {
                    this.clear();
                    this.$emit("clase", response.data);
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                });

        },
        clear() {
            $("#clase_new").modal("hide");
            this.errors = [];
            this.descripcion = "";
            this.selectedCategoria = "";
            this.cod_clase = "";
        }
    }
};
</script>
