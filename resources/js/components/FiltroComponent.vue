<template>
    <div class="form-row">
        <div class="col-12 col-lg-4 mb-3">
            <label for="origen" class="text-muted"
                ><i class="fas fa-search"></i> Origen</label
            >
            <select
                class="custom-select"
                id="origen"
                name="origen"
                v-model="selectedOrigen"
                v-on:change="cambioOrigen()"
            >
                <option :value="''" disabled selected>Seleccione Origen</option>
                <option
                    v-for="(origen, index) in origenes"
                    :key="origen.id"
                    :value="index"
                    >{{ origen.cod_origen }} - {{ origen.origen }}</option
                >
            </select>
        </div>
        <div class="col-12 col-lg-4 mb-3">
            <label for="jurisdiccion" class="text-muted"
                ><i class="fas fa-search"></i> Jurisdiccion</label
            >
            <select
                :disabled="selectedOrigen.length == 0"
                class="custom-select"
                id="juris diccion"
                name="jurisdiccion"
                v-model="selectedJurisdicion"
                v-on:change="cambioJurisdiccion()"
            >
                <option :value="''" disabled selected
                    >Seleccione Jurisdiccion</option
                >
                <option
                    v-for="(jurisdiccion, index) in jurisdicciones"
                    :key="jurisdiccion.id"
                    :value="index"
                    >{{ jurisdiccion.cod_jurisdiccion }} -
                    {{ jurisdiccion.jurisdiccion }}</option
                >
            </select>
        </div>
        <div class="col-12 col-lg-4 mb-3">
            <label for="organismo" class="text-muted"
                ><i class="fas fa-search"></i> Organismo</label
            >
            <select
                :disabled="selectedJurisdicion.length == 0"
                class="custom-select"
                id="organismo"
                name="organismo"
                v-model="selectedOrganismo"
                v-on:change="cambioOrganismo()"
            >
                <option :value="''" disabled selected
                    >Seleccione Organismo</option
                >
                <option
                    v-for="(organismo, index) in organismos"
                    :key="organismo.id"
                    :value="index"
                    >{{ organismo.cod_organismo }} -{{
                        organismo.organismo
                    }}</option
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
            jurisdicciones: [],
            organismos: [],
            origen: {},
            jurisdiccion: {},
            organismo: {},
            selectedOrigen: "",
            selectedJurisdicion: "",
            selectedOrganismo: ""
        };
    },
    mounted() {
        this.getOrigenes();
    },
    methods: {
        cambioOrigen: function() {
            this.jurisdicciones = [];
            this.organismos = [];
            this.selectedJurisdicion = "";
            this.selectedOrganismo = "";
            if (this.selectedOrigen !== "") {
                this.origen = this.origenes[this.selectedOrigen];
                this.jurisdicciones = this.origen.jurisdicciones;
                const origen = this.origen.cod_origen;
                this.$emit("sendOrigen", origen);
            }
        },
        cambioJurisdiccion: function() {
            this.organismos = [];
            this.selectedOrganismo = "";
            if (this.selectedJurisdicion !== "") {
                this.jurisdiccion = this.jurisdicciones[
                    this.selectedJurisdicion
                ];
                this.organismos = this.jurisdiccion.organismos;
                const jur = this.jurisdiccion.cod_jurisdiccion;
                this.$emit("sendJur", jur);
            }
        },
        cambioOrganismo: function() {
            if (this.selectedOrganismo !== "") {
                this.organismo = this.organismos[this.selectedOrganismo];
                const organismo = this.organismo.cod_organismo;
                this.$emit("sendOrganismo", organismo);
            }
        },
        getOrigenes: function() {
            axios.get("api/origen/all").then(response => {
                this.origenes = response.data;
            });
        }
    }
};
</script>
