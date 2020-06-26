<template>
  <div class="container">
    <form>
      <div class="form-group" v-model="tipoliquidaciones">
        <label for="tipoLiquidacion" class="text-muted"><i class="fas fa-search"></i> Tipo de Liquidacion</label>
        <select class="form-control border-0 shadow" id="tipoLiquidacion" v-model="selected">
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
        methods:{
            click(){
                console.log('tipo liquidacion: '+this.tipo)
            },
        }
  }
</script>