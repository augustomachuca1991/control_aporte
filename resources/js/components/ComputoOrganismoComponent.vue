<template>
	<div class="tab-pane fade mh-100" id="organismo" role="tabpanel" aria-labelledby="organismo-tab">
		<h5 class="card-title">Organismo</h5>
    	
    	<div class="table-responsive">
    		<table class="table table-sm table-hover table-bordeless">
			  <thead>
			    <tr class="table-dark">
			      <th scope="col">#</th>
			      <th scope="col">TOTAL HABER BRUTO</th>
			      <th scope="col">TOTAL APORTE PERSONAL</th>
			      <th scope="col">TOTAL BASICO</th>
			      <th scope="col">TOTAL ANTIGÜEDAD</th>
			      <th scope="col">TOTAL ADICIONAL</th>
			      <th scope="col">TOTAL FAMILIAR</th>
			      <th scope="col">TOTAL HIJO</th>
			      <th scope="col">TOTAL ESPOSA</th>
			    </tr>
			  </thead>
			   <tbody>
			   	<tr v-if="organismos.length == 0" class="table-default text-center">
			  		<th colspan="9">No Data</th>
			  	</tr>
			    <tr v-for="(computo,llave) in organismos" v-else>
			      <th scope="row">
			      	<div class="row align-items-center">
			      		<div class="col">
			      			<small>{{ llave }}</small>
			      		</div>
			      		<div class="col">
			      			<div class="row" v-for="(value, key) in computo">
			      				<div class="col">
			      					<small>{{value.organismo.jurisdiccion.jurisdiccion}}</small>	
			      				</div>
			      				<div class="col">
			      					<div class="row">
			      						<div class="col">
			      							<small>{{value.organismo.organismo}}</small>	
			      						</div>
			      					</div>	
			      				</div>
			      			</div>
			      		</div> 
			      	</div>
				 </th>
			      <td>
			      	<tr v-for="(value, key) in computo">
			      		$ {{value.haber_bruto }}
			      	</tr>
			      </td>
			      <td>
			      	<tr v-for="(value, key) in computo">
			      		<small>$ {{value.total_aporte_personal }}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr v-for="(value, key) in computo">
			      		<small>$ {{value.total_sueldo_basico }}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr v-for="(value, key) in computo">
			      		<small>$ {{value.total_antiguedad }}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr v-for="(value, key) in computo">
			      		<small>$ {{value.total_adicional }}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr v-for="(value, key) in computo">
			      		<small>$ {{value.total_familiar }}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr v-for="(value, key) in computo">
			      		<small>$ {{value.total_hijo }}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr v-for="(value, key) in computo">
			      		<small>$ {{value.total_esposa }}</small>
			      	</tr>
			      </td>
			    </tr>
			  </tbody>
			</table>
		</div>	    
	</div>
</template>
<script>
	export default {
		props:['organismos'],
        data: function() {
                return {
                	computos_organismos:{},
                }
            },
        mounted() {
              
                console.log('oganismo-computo-component mounted')
                //axios.get('api/computo/organismo/25616').then((response)=>{
                //   this.computos_organismos = response.data
                //   console.log('computos: '+this.computos_organismos);
                //})
        },
        methods:{
            sumar(integer){
            	//var suma = 0
                //suma += integer;
                //return this.haber_bruto;
            },
        },

    }
</script>