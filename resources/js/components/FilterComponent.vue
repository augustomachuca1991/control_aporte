<template>
  <div class="container">
     <div class="form-row my-3">
      <div class="col">
        <label for="origen" class="text-muted"><i class="fas fa-search"></i> Origen</label>
        <select class="custom-select mr-sm-2 border-0 shadow" id="origen" name="origen"  v-model="selectedOrigen">
          <option :value="''" disabled selected>Seleccione Origen</option>
          <option v-for="(origen, index) in origenes" :key="origen.cod_origen" :value="origen.cod_origen">{{origen.origen}}</option>
        </select>
        <label class="text-muted">Cod Origen:&nbsp;{{selectedOrigen}}</label>
      </div>
      <div class="col">
      <label for="jurisdiccion" class="text-muted"><i class="fas fa-search"></i> Jurisdiccion</label>
        <select  :disabled="selectedOrigen.length == 0" class="custom-select mr-sm-2 border-0 shadow" id="jurisdiccion" name="jurisdiccion" v-model="selectedJurisdicion">
           <option :value="''" disabled selected>Seleccione Jurisdiccion</option>
           <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.cod_jurisdiccion" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
        </select>
        <label class="text-muted">Cod Jurisdiccion:&nbsp;{{selectedJurisdicion}}</label>
      </div>
      <div class="col-6">
      <label for="organismo" class="text-muted"><i class="fas fa-search"></i> Organismo</label>
        <select :disabled="selectedJurisdicion.length == 0" class="custom-select mr-sm-2 border-0 shadow" id="organismo" name="organismo" v-model="selectedOrganismo">
          <option :value="''" disabled selected>Seleccione Organismo</option>
          <option v-for="(organismo, index) in organismos" :key="organismo.cod_organismo" :value="organismo.cod_organismo">{{organismo.organismo}}</option>
        </select>
        <label class="text-muted">Cod Organismo:&nbsp;{{selectedOrganismo}}</label>
      </div>
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
                    selectedOrigen: '',
                    selectedJurisdicion: '',
                    selectedOrganismo: '',
                }
            },
            watch: {
                selectedOrigen: function() {
                    this.jurisdicciones = [];
                    this.organismos = [];
                    this.selectedJurisdicion = "";
                    this.selectedOrganismo = "";
                    if (this.selectedOrigen > 0) {
                      this.jurisdicciones = this.origenes[this.selectedOrigen-1].jurisdicciones
                    }
                },
                selectedJurisdicion: function() {
                    this.organismos = [];
                    this.selectedOrganismo = "";
                      if (this.selectedJurisdicion > 0) {
                          this.organismos = this.origenes[this.selectedOrigen-1].jurisdicciones[this.selectedJurisdicion-1].organismos
                      }
                }
      },
      mounted() {
            axios.get('api/origen').then((response)=>{
                this.origenes = response.data;
            });
      }

    }
</script>
                        