<template>
    <div class="form-row col mb-3 shadow p-3">
      <div class="form-group col-md-4 border-0">
        <label class="text-muted" for="origen1"><i class="fas fa-search"></i> Origen</label>
        <select class="form-control form-control-md" id="origen1" name="origen1"  v-model="selectedOrigen">
          <option :value="''" disabled selected>Seleccione Origen</option>
          <option v-for="(origen, index) in origenes" :key="origen.cod_origen" :value="origen.cod_origen">{{origen.origen}}</option>
        </select>
      </div>
      <div class="form-group col-md-4 border-0">
        <label class="text-muted" for="jurisdiccion"><i class="fas fa-search"></i> Jurisdiccion</label>
        <select  :disabled="selectedOrigen.length == 0" class="form-control form-control-md" id="jurisdiccion1" name="jurisdiccion1" v-model="selectedJurisdiccion">
           <option :value="''" disabled selected>Seleccione Jurisdiccion</option>
           <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.cod_jurisdiccion" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
        </select>
      </div>
    </div>
</template>


<script>
    export default {
            props:['selectO'],
            data: function() {
              return {
                  origenes: [],
                  jurisdicciones: '',
                  categorias: '',
                  cod_jurisdiccion: "",
                  selectedOrigen: "",
                  selectedJurisdiccion: "",    
              }
            },
            methods:{
              getCategorias(id){
                  axios.get(`api/categoria/${id}`).then((response)=>{
                    this.categorias = response.data;
                    this.$emit('jurisdiccion',this.categorias); //evento para obtener las categorias segun la jurisdicción seleccionada
                  })
                  .catch( error => {
                    console.log(error);
                  });
              },
            },
            watch: {
                selectedOrigen: function() {
                  this.jurisdicciones = '';
                  this.categorias = '';
                  this.selectedJurisdiccion = "";
                  this.$emit('jurisdiccion',this.categorias);
                  if (this.selectedOrigen > 0) {
                    this.jurisdicciones = this.origenes[this.selectedOrigen-1].jurisdicciones
                  }
                },
                selectedJurisdiccion: function() {
                  if (this.selectedJurisdiccion > 0) {
                    this.getCategorias(this.selectedJurisdiccion);
                  }
                },
      },
      mounted() {
            axios.get('api/origen').then((response)=>{
              this.origenes = response.data;   
            }); 
      }
    }
</script>
             