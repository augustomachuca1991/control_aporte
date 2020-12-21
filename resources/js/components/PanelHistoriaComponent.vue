<template>
	<div>
			<div id="historias-laborales">
				<h3 class="text-center">Historias Laborales</h3>
				<div class="row my-1">
		         <div class="col-12 col-md-8 col-lg-4">
		           <buscaragente-component @buscarAgente="datos_agente(...arguments)"></buscaragente-component>	
		         </div>
		       </div>
			</div>

			<!-- {{puestos}} -->
			<!-- <historialaborales-component></historialaborales-component> -->
			<!--historia laboral-->
			<div class="row">
			    <div class="col-12">

			      <!-- Project Card Example -->
			      <div class="card shadow mb-4">
			        <div v-if="cuil !== ''" class="card-header py-3">
			          <h6 class="text-center font-weight-bold text-primary">{{agente.nombre}}</h6>
			          <p>Sexo :  {{agente.sexo}}</p>
			          <p>Fecha Nacimiento :  {{agente.fecha_nac}}</p>
			        </div>
			        <div v-else class="card-header py-3">
			          <h6 class="text-center font-weight-bold text-primary">Historia Laboral</h6>
			        </div>
			        <div class="card-body">
			          <div id="timeline" style="height: 250px;"></div>
			        </div>
			      </div>
			    </div>
			</div>
	</div>
</template>
<script type="text/javascript">
		

		 export default {
	        data: function() {
	                return {
	                    cuil:'',
	                    agente:{},
	                    datos: [],
	        		  	puestos: []
	                }
	            },
	        mounted() {
	              console.log('agente filter component mounted')
	              google.charts.load('current', {'packages':['timeline']});
				  
	        },
	        methods:{
	        	datos_agente:function(input){
	        		this.puestos = [];
	        		this.cuil = input.search;
	        		axios.get(`api/agente/${this.cuil}`)
	        		.then((response)=>{
	        			this.puestos = [];
	        			this.datos = [];
	        		    this.agente = response.data[0];
	        		    this.puestos = this.agente.puestolaborales;
	        			google.charts.setOnLoadCallback(this.drawChart);
	        		})
	        	},
	        	drawChart:function() {
	        		var container = document.getElementById('timeline');
	        		var chart = new google.visualization.Timeline(container);
	        		var dataTable = new google.visualization.DataTable();

	        		dataTable.addColumn({ type: 'string', id: 'President' });
	        		dataTable.addColumn({ type: 'date', id: 'Start' });
	        		dataTable.addColumn({ type: 'date', id: 'End' });

	        		this.puestos.forEach( (value , index) => {
	        			//console.log(value.fecha_ingreso)
	        			if (value.fecha_egreso !== null) {
	        				this.datos.push([  'Organismo: '+value.organismo_id.toString(),  new Date(value.fecha_ingreso),  new Date(value.fecha_egreso)]);
	        			}else{
	        				this.datos.push([  'cod org. '+value.organismo_id.toString(),  new Date(value.fecha_ingreso),  new Date(2020,12,31)]);
	        			}
	        			
	        		})
	        		
	        		//this.datos.push([ 'Ministerio de Educacion', new Date(1986, 1, 1), new Date(2020,12,31)]);
	        		//this.datos.push([ 'Instituto Prevision Social', new Date(1991, 1, 1), new Date(2000, 1, 31)]);
	        		dataTable.addRows(this.datos);


	        		chart.draw(dataTable);
	        	}
	        },

	    }
</script>