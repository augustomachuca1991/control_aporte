<template>
	<div>
			<!-- Content Row -->
			<!-- <div class="row">
			  <div class="col-12 mb-4">
			    <div class="card border-left-success shadow h-100 py-2">
			      <div class="card-body">
			        <div class="row no-gutters align-items-center">
			          <div class="col mr-2">
			            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
			            <div class="h5 mb-0 font-weight-bold text-gray-800">Historias Laborales</div>
			          </div>
			          <div class="col-auto">
			            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
			          </div>
			        </div>
			      </div>
			    </div>
			  </div>
			</div> -->
			<div id="historias-laborales">
				<!-- <h3 class="text-center font-weight-bold text-dark">Historias Laborales</h3> -->
				<div class="row my-1">
		         <div class="col col-lg-4 ml-auto">
		           <buscaragente-component @buscarAgente="datos_agente(...arguments)"></buscaragente-component>
		           <span class="errors text-danger" v-for="error in errors.cuil">    
                     <small><em>{{error}}</em></small>
                  	</span>	
		         </div>
		       </div>
			</div>

			<!-- {{cuil}} -->
			<!-- <historialaborales-component></historialaborales-component> -->
			<!--historia laboral-->
			<div class="row">
			    <div class="col-12">

			      <!-- Project Card Example -->
			      <div class="card shadow mb-4">
			        <div v-if="agente.length > 0" class="card-header py-3">
			          <h4 class="h4-responsive text-center font-weight-bold text-dark">Agente {{agente[0].nombre}}</h4>
			          <ul>
			          	<li class="text-sm">Nombre :  {{agente[0].nombre}}</li>
			          	<li class="text-sm">Cuil :  {{agente[0].cuil}}</li>
			          	<li class="text-sm">Sexo :  {{agente[0].sexo}}</li>
			          	<li class="text-sm">Fecha de nacimiento :  {{agente[0].fecha_nac | format_moment}}</li>
			          </ul>
			        </div>
			        <div v-else class="card-header py-3">
			          <h4 class="h4-responsive font-weight-bold text-dark">Historias Laborales</h4>
			        </div>
			        <div class="card-body">
			          <div id="timeline" style="height: 250px; border: 1px solid #ccc"></div>
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
	        		  	puestos: [],
	        		  	errors: [],
	        		  	shown: false,
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
	        			setTimeout(() => {
	        			  this.shown = true
	        			}, 1000)

	        			if (response.data.isError) {
	        				this.errors = [];
	        				this.puestos = [];
		        			this.datos = [];
		        			this.agente = {};
	        				this.errors = response.data.data;
	        			} else {
	        				this.errors = [];
		        			this.puestos = [];
		        			this.datos = [];
		        		    this.agente = response.data.data;
		        		    this.puestos = this.agente[0].puestolaborales;
		        			google.charts.setOnLoadCallback(this.drawChart);
	        			}
	        		}).catch((err) => {
	                   console.log(err.response.data)
	                   //this.errors = err.response.data.errors;
	                 });
	        	},
	        	drawChart:function() {
	        		var fecha_egreso;
	        		var container = document.getElementById('timeline');
	        		var chart = new google.visualization.Timeline(container);
	        		var dataTable = new google.visualization.DataTable();

	        		dataTable.addColumn({ type: 'string', id: 'Puesto_laboral' });
	        		dataTable.addColumn({ type: 'string', id: 'Name' });
	        		dataTable.addColumn({ type: 'date', id: 'Start' });
	        		dataTable.addColumn({ type: 'date', id: 'End' });

	        		this.puestos.forEach( (value , index) => {
	        			if (value.fecha_egreso !== null) {
	        				fecha_egreso = new Date(value.fecha_egreso)
	        			}else{
	        				
	        				fecha_egreso = new Date(2020,12,1);
	        			}
	        			this.datos.push(['PL: '+value.cod_laboral.toString(),'Organismo '+value.organismo_id.toString(),new Date(value.fecha_ingreso),fecha_egreso])
	        		})

	        		dataTable.addRows(this.datos);

	        		var option = {
	        			//colors : ['#63813f', '#80a851', '#9fd065','#b1e870', '#c1fc7b', '#d8ffaa'],
	        			colors: ['#cbb69d', '#603913', '#c69c6e'],
	        			//backgroundColor :'#bcc5b1',
	        			timeline: { rowLabelStyle: {fontName: 'Helvetica', fontSize: 16, color: '#666666' },
	        			                     barLabelStyle: { fontName: 'Garamond', fontSize: 14 } }

	        		}


	        		chart.draw(dataTable , option);

        		    // google.visualization.events.addListener(chart, 'ready', function () {
        		    //   container.innerHTML = '<img src="' + chart.getImageURI() + '">';
        		    // });
	        	}
	        },

	    }
</script>