<template>
    <div class="form-row my-3">
      <div class="col">
        <label class="mr-sm-2 sr-only" for="origen">Origen</label>
        <select class="custom-select mr-sm-2" id="origen" name="origen"  v-model="selectedOrigen">
          <option :value="null" disabled selected>Seleccione Origen</option>
          <option v-for="(origen, index) in origenes" :key="origen.id" :value="origen.id">{{origen.origen}}</option>
        </select>
      </div>
      <div class="col">
      <label class="mr-sm-2 sr-only" for="jurisdiccion">Jurisdiccion</label>
        <select  :disabled="jurisdicciones.length == 0" class="custom-select mr-sm-2" id="jurisdiccion" name="jurisdiccion" v-model="selectedJurisdicion">
           <option :value="null" disabled selected>Seleccione Jurisdiccion</option>
           <option v-for="(jurisdiccion, index) in jurisdicciones">{{jurisdiccion.jurisdiccion}}</option>
        </select>
      </div>
      <div class="col-6">
      <label class="mr-sm-2 sr-only" for="organismo">Organismo</label>
        <select :disabled="organismos.length == 0" class="custom-select mr-sm-2" id="organismo" name="organismo" v-model="selectedOrganismo">
          <option :value="null" disabled selected>Seleccione Organismo</option>
          <option v-for="organismo in organismos">{{organismo}}</option>
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
                    selectedOrigen: "",
                    selectedJurisdicion: "",
                    selectedOrganismo: ""
                }
            },
            watch: {
                selectedOrigen: function() {
                    this.jurisdicciones = [];
                    this.organismos = [];
                    this.selectedJurisdicion = "";
                    this.selectedOrganismo = "";
                    if (this.selectedOrigen != 0) {

                        this.jurisdicciones = this.origenes[this.selectedOrigen-1].jurisdicciones
                    }
                    //this.jurisdicciones = this.origenes[this.selectedOrigen-1].jurisdicciones
                },
                selectedJurisdicion: function() {
                    this.organismos = [];
                    this.selectedOrganismo = "";
                    if (this.selectedJurisdicion != 0) {
                        this.organismos = this.origenes[this.selectedOrigen][this.selectedJurisdicion]
                    }
                }
      },
      mounted() {
            axios.get('api/origen').then((response)=>{
                this.origenes = response.data;
                console.log(this.origenes);
            });
      }

    }
</script>