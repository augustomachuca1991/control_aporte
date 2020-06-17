<template>
    <div class="form-row my-3">
      <div class="col">
        <label class="mr-sm-2 sr-only" for="origen">Origen</label>
        <select class="custom-select mr-sm-2" id="origen" name="origen"  v-model="selectedOrigen">
          <option :value="null" disabled selected>Seleccione Origen</option>
          <option v-for="(country_obj, country) in origen" :value="country">{{country}}</option>
        </select>
      </div>
      <div class="col">
      <label class="mr-sm-2 sr-only" for="jurisdiccion">Jurisdiccion</label>
        <select  :disabled="jurisdicciones.length == 0" class="custom-select mr-sm-2" id="jurisdiccion" name="jurisdiccion" v-model="selectedJurisdicion">
           <option :value="null" disabled selected>Seleccione Jurisdiccion</option>
           <option v-for="(city_obj, city) in jurisdicciones">{{city}}</option>
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
                    origen: {
                        "Sisper": {
                            "Salud Publica": ["Beijing", "Shanghai", "Guangzhou", "Tianjin"],
                            "Poder Judicial": ["New Delhi", "Mumbai", "Bangalore", "Chennai"],
                            "Direccion Enseñanza Privada": ["Tokyo", "Kyoto", "Nagoya", "Hiroshima"],
                            "Ministerio Hacienda y Finanzas": ["Instituto de Prevision Social", "IOSCOR"],
                            "Ministerio de Seguridad": ["Jefatura de Policía"]
                        },
                        "Munucipios": {
                            "Municipalidad Goya": ["Goya"],
                            "Municipalidad Saladas": ["Saladas"],
                            "Municipalidad Empedrado": ["Empedrado"]
                        },
                        "Entidades Autonomas": {
                            "DPEC": ["Direccion Provincial Energia de Corrientes"],
                        }
                    },
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
                    if (this.selectedOrigen.length > 0) {
                        this.jurisdicciones = this.origen[this.selectedOrigen]
                    }
                },
                selectedJurisdicion: function() {
                    this.organismos = [];
                    this.selectedOrganismo = "";
                    if (this.selectedJurisdicion.length > 0) {
                        this.organismos = this.origen[this.selectedOrigen][this.selectedJurisdicion]
                    }
                }
      },
      mounted() {
            console.log('Filter mounted.')
      }

    }
</script>