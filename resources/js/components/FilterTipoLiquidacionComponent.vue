<template>
  <div>
    <form>
      <div class="form-group border-0 shadow p-3" v-model="tipoliquidaciones">
        <label for="tipoLiquidacion" class="text-muted"><i class="fas fa-search"></i> Tipo de Liquidacion</label>
        <select class="form-control form-control-sm" id="tipoLiquidacion" v-model="selected">
          <option class="text-muted" :value="''" selected disabled>Seleccione tipo de Liquidacion</option>
          <option v-for="tipo in tipoliquidaciones" :value="tipo.id" :tipo="tipo">{{tipo.descripcion}}</option>
        </select>
        <!--<label class="text-muted">Cod Tipo Liquidacion:&nbsp;{{selected}}</label>-->
      </div>
    </form>
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
               console.log(response.data);
               this.tipoliquidaciones= response.data;
            })
        },
        watch: {
            selected: function() {
                //console.log(this.selected);
                const tipoLiquidacion = this.selected;
                this.$emit('sendTipo',tipoLiquidacion);
            }
        }
  }
</script>