<template>
    <div class="form-row col mb-3 shadow p-3">
      <div class="form-group col-md-4 border-0 shadow p-3">
        <label class="text-muted" for="origen1"><i class="fas fa-search"></i> Origen</label>
        <select class="custom-select mr-sm-2" id="origen1" name="origen1"  v-model="selectedOrigen">
          <option :value="''" disabled selected>Seleccione Origen</option>
          <option v-for="(origen, index) in origenes" :key="origen.cod_origen" :value="origen.cod_origen">{{origen.origen}}</option>
        </select>
      </div>
      <div class="form-group col-md-4 border-0 shadow p-3">
        <label class="text-muted" for="jurisdiccion"><i class="fas fa-search"></i> Jurisdiccion</label>
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
                  cod_jurisdiccion: "",
                  selectedOrigen: "",
                  selectedJurisdiccion: "",    
              }
            },
            // created(){
            //   eventBus.$on('actualizar', this.actualizar());  // 3.Listening
            // },
            methods:{
              getCategorias(id){
                  axios.get(`api/categoria/${id}`).then((response)=>{
                    this.categorias = response.data;
                    console.log(this.categorias);
                    this.$emit('jurisdiccion',this.categorias); //evento para obtener las categorias segun la jurisdicción seleccionada
                  })
                  .catch( error => {
                    if(!id){
                      this.$emit('jurisdiccion',this.categorias); //evento para obtener las categorias segun la jurisdicción seleccionada
                    }
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
                  }
                },
                selectedJurisdiccion: function() {
                  this.categorias = [];
                  const cod_jurisdiccion = this.selectedJurisdiccion;
                  this.getCategorias(cod_jurisdiccion);
                },
                categorias: function(){
                  this.categorias = this.getCategorias(this.selectedJurisdiccion);
                }
      },
      mounted() {
            axios.get('api/origen').then((response)=>{
                this.origenes = response.data;
                // console.log(response.data);
            }); 
      }
    }
</script>
             