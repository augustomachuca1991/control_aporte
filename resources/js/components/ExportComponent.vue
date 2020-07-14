<template>

	<form @submit.prevent="exportar()">
	  <div class="form-group row">
	    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Descargar Archivo</label>
	    <div class="col-sm-8 d-flex align-items-center">
	      <select id="periodo" name="periodo" class="form-control form-control-sm" v-model="selectedPeriodo" @change="cambio()">
	          <option class="text-muted" :value="''" selected disabled>Seleccione Periodo</option>
	          <option v-for="periodo in periodos" :value="periodo.cod_periodo" :periodo="periodo">Periodo de {{periodo.periodo}}</option>
	      </select>
	    </div>
	    <div class="col-sm-2">
	       <button type="submit" name="export" id="export" class="btn btn-warning btn-sm  btn-block">
	          <i class="fas fa-download"></i>&nbsp;
	          <span class="small">Exportar</span>
	        </button>
	    </div>
	  </div>
	</form>

</template>

<script>
	export default {
        data: function(){
            return{
            	periodos:[],
            	selectedPeriodo:'',      
              
            }
        },
        mounted(){
           axios.get('api/periodo').then((response)=>{
               console.log('export-component mounted')
               this.periodos= response.data;
           })
        },
        methods:{
        	exportar:function(){
        		const periodo = {
        			periodo: this.selectedPeriodo
        		}
        		axios.post('api/export', periodo).then((response)=>{
	               alert(response.data.message);
	          	}).catch(function (error) {
                  console.log(error);
                });
        	},
        	cambio:function(){
        		this.selectedPeriodo = this.selectedPeriodo;
        	} 
            
        },
    }
</script>