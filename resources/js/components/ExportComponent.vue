<template>
    <div class="card mb-3">
        <img class="card-img-top" src="/image/bannerExcel.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Descargar Archivo</h5>
              <form @submit.prevent="exportar()">
              <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Descargar Archivo</label>
                <div class="col-sm-8 d-flex align-items-center">
                  <select id="periodo" name="periodo" class="form-control form-control-sm" v-model="selectedPeriodo" @change="cambio()">
                      <option class="text-muted" :value="''" selected disabled>Seleccione Periodo</option>
                      <option v-for="periodo in periodos" :key="periodo.id" :value="periodo.cod_periodo" :periodo="periodo">Periodo de {{periodo.periodo}}</option>
                  </select>
                </div>
                <div class="col-sm-2">
                   <button type="submit" name="export" id="export" class="btn btn-warning btn-sm  btn-block">
                      <i class="fas fa-download"></i>&nbsp;
                      <span class="small">Descargar</span>
                    </button>
                </div>
              </div>
            </form>
        </div>
    </div>
</template>

<script>
  const Toast = swal.mixin({
                  toast: true,
                  position: 'top-end',
                  timer: 6000,
                  showConfirmButton: false,
                  onOpen: (toast) => {
                    toast.addEventListener('mouseenter', swal.stopTimer)
                    toast.addEventListener('mouseleave', swal.resumeTimer)
                  }
                });
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
                    if (response.data.status) {
                      Toast.fire({
                        icon: 'success',
                        title: response.data.message,
                        background: '#E7FFD7',
                      })
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: response.data.message,
                        background:'#FCDBCD',
                      })
                    }
                 
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