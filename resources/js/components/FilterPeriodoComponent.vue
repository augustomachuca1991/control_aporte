<template>
  <div>
    <form>
      <div class="form-group border-0 shadow p-3" v-model="periodos">
        <label for="periodo" class="text-muted"><i class="fas fa-search"></i> Periodo Liquidacion</label>
        <select class="form-control form-control-sm" id="periodo" v-model="selected" v-on:change="cambio()">
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
               console.log("filter Periodo component mounted");
               this.periodos= response.data;
            })
        },
        methods:{
            cambio(){
                //axios.get(`api/liquidacion/origen/null/jurisdiccion/null/organismo/null/periodo/${this.selected}/tipo/null`).then((response)=>{
                //  const periodo = response.data;
                //  this.$emit('sendPeriodo',periodo);
                //})
                const periodo =this.selected;
                this.$emit('sendPeriodo',periodo);
            },
        },
        
  }
</script>
                