<template>
  <!-- <div>
    <form>
      <div class="form-group border-0 shadow p-3" v-model="tipoliquidaciones">
        <label for="tipoLiquidacion" class="text-muted"><i class="fas fa-search"></i> Tipo de Liquidacion</label>
        <select class="form-control form-control-sm" id="tipoLiquidacion" v-model="selected" v-on:change="cambio()">
          <option class="text-muted" :value="''" selected disabled>Seleccione tipo de Liquidacion</option>
          <option v-for="tipo in tipoliquidaciones" :value="tipo.id" :tipo="tipo">{{tipo.descripcion}}</option>
        </select>
      </div>
    </form>
  </div> -->
    <div v-model="tipoliquidaciones">
      <label for="tipoLiquidacion" class="text-muted"><i class="fas fa-search"></i> Tipo de Liquidacion</label>
      <select class="custom-select" id="tipoLiquidacion" v-model="selected" v-on:change="cambio()">
        <option class="text-muted" :value="''" selected disabled>Seleccione tipo de Liquidacion</option>
        <option v-for="tipo in tipoliquidaciones" :value="tipo.id" :tipo="tipo">{{tipo.descripcion}}</option>
      </select>
    </div>
</template>

<script>
  export default {
        data: function(){
            return{
                tipoliquidaciones:[],
                selected:'',
            }
        
        },
        mounted() {
           axios.get('api/tipoliquidacion').then((response)=>{
               console.log("filter tipo liquidacion mounted");
               this.tipoliquidaciones= response.data;
            })
        },
        //watch: {
        //    selected: function() {
        //        //console.log(this.selected);
        //        const tipoLiquidacion = this.selected;
        //        this.$emit('sendTipo',tipoLiquidacion);
        //    }
        //},
        methods:{
            cambio(){
                //axios.get(`api/liquidacion/origen/null/jurisdiccion/null/organismo/null/periodo/null/tipo/${this.selected}`).then((response)=>{
                //  const tipoLiquidacion = response.data;
                //  this.$emit('sendTipo',tipoLiquidacion);
                //})
                const tipoLiquidacion = this.selected;
                this.$emit('sendTipo',tipoLiquidacion);
            },
        },

  }
</script>