<template>
    <div
        class="modal fade"
        id="categoria_new"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalLabelNewCategoria"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" @submit.prevent="newCategoria()">
                    <div class="modal-header bg-gradient-info">
                        <h5 class="modal-title" id="ModalLabelNewCategoria">
                            Nueva Categoria
                        </h5>
                        <!-- {{errors}} -->
                        <button
                            type="button"
                            class="close text-white"
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
                                for="input_codigo_categoria"
                                class="col-sm-3 col-form-label"
                                >Codigo *</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="input_codigo_categoria"
                                    v-model="cod_categoria"
                                />
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
                                for="input_categoria"
                                class="col-sm-3 col-form-label"
                                >Categoria *</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="input_categoria"
                                    v-model="descripcion"
                                />
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
                                for="select_categoria"
                                class="col-sm-3 col-form-label"
                                >Jurisdicción *</label
                            >
                            <div class="col-sm-9">
                                <select
                                    :disabled="jurisdicciones.length === 0"
                                    class="custom-select"
                                    id="select_categoria"
                                    v-model="selectedJurisdiccion"
                                    required
                                >
                                    <option selected disabled :value="''"
                                        >Seleccione Jurisdiccion...</option
                                    >
                                    <option
                                        v-for="(jurisdiccion,
                                        index) in jurisdicciones"
                                        :key="index"
                                        :value="jurisdiccion.cod_jurisdiccion"
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
    props: ["jurisdicciones"],
    data: function() {
        return {
            cod_categoria : "",
            descripcion : "",
            selectedJurisdiccion: "",
            errors: [],
        };
    },
    mounted() {
        console.log("create categoria");
    },
    methods: {
        newCategoria() {
            const params = {
                cod_categoria: this.cod_categoria,
                categoria: this.descripcion,
                jurisdiccion_id: this.selectedJurisdiccion
            };
            this.create(params);
        },
        clear() {
            $("#categoria_new").modal("hide");
            this.errors = [];
            this.descripcion = "";
            this.selectedJurisdiccion = "";
            this.cod_categoria = "";
        },
        create(params) {
            axios
                .post("api/categoria/create", params)
                .then(response => {
                    this.clear();
                    this.$emit("categoria", response.data);
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                });
        }
    }
};
</script>
