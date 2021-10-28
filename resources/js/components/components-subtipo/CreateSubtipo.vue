<template>
    <form class="form-inline" v-on:submit.prevent="newSubtipo">
        <div class="form-group mb-2">
            <label for="tipoCodigo" class="sr-only">Tipo</label>
            <select
                class="custom-select mr-sm-2"
                id="tipoCodigo"
                :disabled="tipos.length === 0"
                v-model="selectedTipo"
            >
                <option :value="''" selected disabled
                    >Seleccione Tipo de Codigo...</option
                >
                <option v-for="tipo in tipos" :key="tipo.id" :value="tipo.id"
                    >{{ tipo.id }}-{{ tipo.descripcion }}</option
                >
            </select>
            <div v-if="!errors.length">
                <span
                    class="errors text-danger"
                    v-for="error in errors.tipocodigo_id"
                    :key="error.id"
                >
                    <small
                        ><em>{{ error }}</em></small
                    >
                </span>
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="subtipo" class="sr-only">Subtipo (*)</label>
            <input
                type="text"
                class="form-control"
                id="subtipo"
                placeholder="Subtipo"
                v-model="subtipo"
            />
            <div v-if="!errors.length">
                <span
                    class="errors text-danger"
                    v-for="error in errors.descripcion"
                    :key="error.id"
                >
                    <small
                        ><em>{{ error }}</em></small
                    >
                </span>
            </div>
        </div>
        <button type="submit" class="btn bg-olive mb-2">
            + Nuevo Subtipo
        </button>
    </form>
</template>
<script>
export default {
    props: ["tipos"],
    data: function() {
        return {
            errors: [],
            subtipo: "",
            selectedTipo: ""
        };
    },
    methods: {
        newSubtipo() {
            const param = {
                descripcion: this.subtipo,
                tipocodigo_id: this.selectedTipo
            };
            this.create(param);
        },
        create(subtipo) {
            axios
                .post("api/subtipo/create", subtipo)
                .then(response => {
                    this.empty();
                    this.$emit("subtipo", response.data);
                })
                .catch(err => {
                    alert(JSON.stringify(err.response.data.errors));
                    this.errors = err.response.data.errors;
                });
        },
        empty() {
            this.selectedTipo = "";
            this.subtipo = "";
        }
    }
};
</script>
