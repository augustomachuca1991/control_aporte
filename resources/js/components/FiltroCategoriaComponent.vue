<template>
    <div class="form-row col mb-3 shadow p-3">
      <div class="col-md-4">
        <label class="mr-sm-2 sr-only" for="origen1">Origen</label>
        <select class="custom-select mr-sm-2" id="origen1" name="origen1"  v-model="selectedOrigen">
          <option :value="''" disabled selected>Seleccione Origen</option>
          <option v-for="(origen, index) in origenes" :key="origen.cod_origen" :value="origen.cod_origen">{{origen.origen}}</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="mr-sm-2 sr-only" for="jurisdiccion">Jurisdiccion</label>
        <select  :disabled="selectedOrigen.length == 0" class="custom-select mr-sm-2" id="jurisdiccion1" name="jurisdiccion1" v-model="selectedJurisdiccion">
           <option :value="''" disabled selected>Seleccione Jurisdiccion</option>
           <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.cod_jurisdiccion" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
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
                    categorias: [],
                    selectedOrigen: "",
                    selectedJurisdiccion: "",
                }
            },
            methods:{
              getCategorias(id){
                axios.get(`api/categoria/${id}`).then((response)=>{
                  this.categorias = response.data;
                  console.log(this.categorias);
                })
                .catch(function (error) {
                    console.log(error);
                });
              },
            },
            watch: {
                selectedOrigen: function() {
                    this.jurisdicciones = [];
                    this.categorias = [];
                    this.selectedJurisdiccion = "";
                    if (this.selectedOrigen > 0) {
                      this.jurisdicciones = this.origenes[this.selectedOrigen-1].jurisdicciones
                      // console.log(this.jurisdicciones);
                    }
                  
                },
                selectedJurisdiccion: function() {
                  const cod_jurisdiccion = this.selectedJurisdiccion;
                  this.getCategorias(cod_jurisdiccion);
                  this.$emit('categorias',categorias);
                }
      },
      mounted() {
            axios.get('api/origen').then((response)=>{
                this.origenes = response.data;
                console.log(response.data);
            });
      }

    }
</script>
             