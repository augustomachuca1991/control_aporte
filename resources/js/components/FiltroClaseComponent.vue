<template>
    <div class="form-row col mb-3 shadow p-3">
        <div class="form-group col-md-4 border-0">
            <label class="text-muted" for="origen1"
                ><i class="fas fa-search"></i> Origen</label
            >
            <select
                class="form-control form-control-md"
                id="origen1"
                name="origen1"
                v-model="selectedOrigen"
            >
                <option :value="''" disabled selected>Seleccione Origen</option>
                <option
                    v-for="(origen, index) in origenes"
                    :key="origen.id"
                    :value="origen.id"
                    >{{ origen.origen }}</option
                >
            </select>
        </div>
        <div class="form-group col-md-4 border-0">
            <label class="text-muted" for="jurisdiccion"
                ><i class="fas fa-search"></i> Jurisdiccion</label
            >
            <select
                :disabled="selectedOrigen.length == 0"
                class="form-control form-control-md"
                id="jurisdiccion1"
                name="jurisdiccion1"
                v-model="selectedJurisdiccion"
            >
                <option :value="''" disabled selected
                    >Seleccione Jurisdiccion</option
                >
                <option
                    v-for="(jurisdiccion, index) in jurisdicciones"
                    :key="jurisdiccion.id"
                    :value="jurisdiccion.id"
                    >{{ jurisdiccion.jurisdiccion }}</option
                >
            </select>
        </div>
        <div class="form-group col-md-4 border-0">
            <label class="text-muted" for="categoria"
                ><i class="fas fa-search"></i> Categoria</label
            >
            <select
                :disabled="selectedJurisdiccion.length == 0"
                class="form-control form-control-md"
                id="categoria1"
                name="categoria1"
                v-model="selectedCategoria"
            >
                <option :value="''" disabled selected
                    >Seleccione Categoria</option
                >
                <option
                    v-for="(categoria, index) in categorias"
                    :key="categoria.cod_categoria"
                    :value="categoria.cod_categoria"
                    >{{ categoria.categoria }}</option
                >
            </select>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            origenes: [],
            selectedCategoria: "",
            jurisdiccion: "",
            jurisdicciones: "",
            categorias: "",
            clases: "",
            cod_jurisdiccion: "",
            selectedOrigen: "",
            selectedJurisdiccion: ""
        };
    },
    methods: {
        getClases(id) {
            axios
                .get(`api/clase/${id}`)
                .then(response => {
                    this.clases = response.data;
                    this.$emit("categoria", this.clases); //evento para obtener las categorias segun la jurisdicción seleccionada
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getOrigenes() {
            axios.get("api/origen").then(response => {
                this.origenes = response.data;
            });
        },
        getJurisdicciones() {
            axios.get("api/jurisdiccion").then(response => {
                this.jurisdicciones = response.data;
            });
        },
        getCategorias(id) {
            axios.get(`api/categoria/${id}`).then(response => {
                this.categorias = response.data;
            });
        }
    },
    watch: {
        selectedOrigen: function() {
            this.jurisdicciones = "";
            this.categorias = "";
            this.clases = "";
            this.selectedJurisdiccion = "";
            this.selectedCategoria = "";
            this.$emit("categoria", this.clases);
            if (this.selectedOrigen > 0) {
                this.jurisdicciones = this.origenes[
                    this.selectedOrigen - 1
                ].jurisdicciones;
            }
        },
        selectedJurisdiccion: function() {
            this.categorias = "";
            this.clases = "";
            this.selectedCategoria = "";
            this.$emit("categoria", this.clases);
            if (this.selectedJurisdiccion > 0) {
                this.getCategorias(this.selectedJurisdiccion);
            }
        },
        selectedCategoria: function() {
            if (this.selectedCategoria > 0) {
                this.getClases(this.selectedCategoria);
            }
        }
    },
    mounted() {
        this.getOrigenes();
    }
};
</script>
