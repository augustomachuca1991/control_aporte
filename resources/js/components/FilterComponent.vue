<template>
    <div class="form-row">
      <div class="col">
        <label class="mr-sm-2 sr-only" for="origen">Origen</label>
        <select class="custom-select mr-sm-2" id="origen" name="origen">
          <option :value="null" disabled selected>Seleccione Origen</option>
          <option v-for="option in origen_opciones" v-bind:value="option.id">{{option.origen}}</option>
        </select>
      </div>
      <div class="col">
      <label class="mr-sm-2 sr-only" for="jurisdiccion">Jurisdiccion</label>
        <select class="custom-select mr-sm-2" id="jurisdiccion" name="jurisdiccion">
           <option :value="null" disabled selected>Seleccione Jurisdiccion</option>
           <option v-for="option in jurisdiccion_opciones[3]" v-bind:value="option.id">{{option.jurisdiccion}}</option>
        </select>
      </div>
      <div class="col-6">
      <label class="mr-sm-2 sr-only" for="inlineOrganismo">Organismo</label>
        <select class="custom-select mr-sm-2" id="inlineOrganismo">
          <option selected>Seleccione Organismo</option>
          <option value="1">Organismo 1</option>
          <option value="2">Organismo 2</option>
          <option value="3">Organismo 3</option>
        </select>
      </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                  origenes:null,
                  jurisdicciones:null,
                  origen_opciones:[
                    {origen: 'sisper' ,    id: 1},
                    {origen: 'municipio' , id: 2},
                    {origen: 'autonomos' , id: 3},
                  ],
                  jurisdiccion_opciones:{
                    1:[{jurisdiccion: 'Ministerio hacienda',id: 1},
                       {jurisdiccion: 'Ministerio de educacion',id: 2}
                      ],
                    2:[{jurisdiccion: 'Alvear',id: 1},
                       {jurisdiccion: 'Goya',id: 2}
                      ],
                    3:[{jurisdiccion: 'DPEC',id: 1}
                      ]
                  },
            }
        },
        mounted() {
            console.log('Filter mounted.')
        },
    }
</script>