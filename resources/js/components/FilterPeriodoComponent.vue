<template>
  <div>
    <form>
      <div class="form-group border-0 shadow p-3" v-model="periodos">
        <label for="periodo" class="text-muted"><i class="fas fa-search"></i> Periodo Liquidacion</label>
        <select class="form-control form-control-sm" id="periodo" v-model="selected">
          <option class="text-muted" :value="''" selected disabled>Seleccione Periodo</option>
          <option v-for="periodo in periodos" :value="periodo.cod_periodo" :periodo="periodo">Liquidacion de {{periodo.periodo}}</option>
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
            change(){
                console.log('tipo liquidacion: '+this.selected)
            },
        },
        watch: {
            selected: function() {
                //console.log(this.selected);
                const periodo = this.selected;
                this.$emit('sendPeriodo',periodo);
            }
        }
  }
</script>