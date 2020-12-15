<template>
  <!-- <div class="form-group border-0 shadow p-3">
    
  
  <form class="form-inline">
    <div class="col">
      <label for="origen" class="text-muted"><i class="fas fa-search"></i> Origen</label>
      <select class="custom-select" id="origen" name="origen" v-model="selectedOrigen" v-on:change="cambioOrigen()">
        <option :value="''" disabled selected>Seleccione Origen</option>
        <option v-for="origen in origenes" :value="origen.cod_origen">{{origen.origen}}</option>
      </select>
    </div>
    <div class="col">
      <label for="jurisdiccion" class="text-muted"><i class="fas fa-search"></i> Jurisdiccion</label>
       <select :disabled="selectedOrigen.length == 0" class="custom-select" id="juris diccion" name="jurisdiccion" v-model="selectedJurisdicion" v-on:change="cambioJurisdiccion()">
          <option :value="''" disabled selected>Seleccione Jurisdiccion</option>
          <option v-for="jurisdiccion in jurisdicciones" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
       </select>
    </div>
    <div class="col">
      <label for="organismo" class="text-muted"><i class="fas fa-search"></i> Organismo</label>
      <select :disabled="selectedJurisdicion.length == 0" class="custom-select" id="organismo" name="organismo" v-model="selectedOrganismo" v-on:change="cambioOrganismo()">
        <option :value="''" disabled selected>Seleccione Organismo</option>
        <option v-for="organismo in organismos" :value="organismo.cod_organismo">{{organismo.organismo}}</option>
      </select>
    </div>
</form>
</div> -->

<div class="form-row border-0 shadow p-3">
    <div class="col-12 col-lg-4 mb-3">
      <label for="origen" class="text-muted"><i class="fas fa-search"></i> Origen</label>
      <select class="custom-select" id="origen" name="origen" v-model="selectedOrigen" v-on:change="cambioOrigen()">
        <option :value="''" disabled selected>Seleccione Origen</option>
        <option v-for="origen in origenes" :value="origen.cod_origen">{{origen.origen}}</option>
      </select>
    </div>
    <div class="col-12 col-lg-4 mb-3">
      <label for="jurisdiccion" class="text-muted"><i class="fas fa-search"></i> Jurisdiccion</label>
       <select :disabled="selectedOrigen.length == 0" class="custom-select" id="juris diccion" name="jurisdiccion" v-model="selectedJurisdicion" v-on:change="cambioJurisdiccion()">
          <option :value="''" disabled selected>Seleccione Jurisdiccion</option>
          <option v-for="jurisdiccion in jurisdicciones" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
       </select>
    </div>
    <div class="col-12 col-lg-4 mb-3">
      <label for="organismo" class="text-muted"><i class="fas fa-search"></i> Organismo</label>
      <select :disabled="selectedJurisdicion.length == 0" class="custom-select" id="organismo" name="organismo" v-model="selectedOrganismo" v-on:change="cambioOrganismo()">
        <option :value="''" disabled selected>Seleccione Organismo</option>
        <option v-for="organismo in organismos" :value="organismo.cod_organismo">{{organismo.organismo}}</option>
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
                    selectedOrigen: '',
                    selectedJurisdicion: '',
                    selectedOrganismo: '',
                }
            },
        mounted() {
              axios.get('api/origen').then((response)=>{
                  this.origenes = response.data;
                  //console.log(this.origenes[0].jurisdicciones[0].organismos.length)
              });
        },
        methods:{
          cambioOrigen: function(){
            this.jurisdicciones = [];
            this.organismos = [];
            this.selectedJurisdicion = "";
            this.selectedOrganismo = "";
            if (this.selectedOrigen > 0) {
              this.jurisdicciones = this.origenes[this.selectedOrigen-1].jurisdicciones
              const origen = this.selectedOrigen;
              this.$emit('sendOrigen',origen);
            }
          },
          cambioJurisdiccion: function(){
            this.organismos = [];
            this.selectedOrganismo = "";
            if (this.selectedJurisdicion > 0) {
                this.organismos = this.origenes[this.selectedOrigen-1].jurisdicciones[this.selectedJurisdicion-1].organismos
                const jur = this.selectedJurisdicion;
                this.$emit('sendJur',jur);
            }
          },
          cambioOrganismo: function(){
            if (this.selectedOrganismo > 0) {
                  const organismo = this.selectedOrganismo;
                  this.$emit('sendOrganismo',organismo);
            }
          }

        },

    }
</script>


    
                        