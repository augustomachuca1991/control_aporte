<template>
  <div class="container">
    <form>
      <div class="form-group" v-model="periodos">
        <label for="periodo" class="text-muted"><i class="fas fa-search"></i> Periodo Liquidacion</label>
        <select class="form-control border-0 shadow" id="periodo" v-model="selected">
          <option class="text-muted" :value="''" selected disabled>Seleccione Periodo</option>
          <option v-for="periodo in periodos" :value="periodo.id" :periodo="periodo">Liquidacion de {{periodo.periodo}}</option>
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
                periodos:[],
                selected:'',
            }
        
        },
        mounted() {
           axios.get('api/periodo').then((response)=>{
               console.log(response.data);
               this.periodos= response.data;
            })
        },
        methods:{
            click(){
                console.log('tipo liquidacion: '+this.tipo)
            },
        }
  }
</script>