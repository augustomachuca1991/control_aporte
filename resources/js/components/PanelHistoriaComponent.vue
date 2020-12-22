<template>
	<div>
			<div id="historias-laborales">
				<h3 class="text-center font-weight-bold text-dark">Historias Laborales</h3>
				<div class="row my-1">
		         <div class="col col-lg-4 ml-auto">
		           <buscaragente-component @buscarAgente="datos_agente(...arguments)"></buscaragente-component>
		           <span class="errors text-danger" v-for="error in errors.cuil">    
                     <small><em>{{error}}</em></small>
                  	</span>	
		         </div>
		       </div>
			</div>

			{{cuil}}
			<!-- <historialaborales-component></historialaborales-component> -->
			<!--historia laboral-->
			<div class="row">
			    <div class="col-12">

			      <!-- Project Card Example -->
			      <div class="card shadow mb-4">
			        <div v-if="cuil !== ''" class="card-header py-3">
			          <h4 class="h4-responsive text-center font-weight-bold text-dark">Agente {{agente.nombre}}</h4>
			          <ul>
			          	<li class="text-sm">Nombre :  {{agente.nombre}}</li>
			          	<li class="text-sm">Cuil :  {{agente.cuil}}</li>
			          	<li class="text-sm">Sexo :  {{agente.sexo}}</li>
			          	<li class="text-sm">Fecha de nacimiento :  {{agente.fecha_nac | format_moment}}</li>
			          </ul>
			        </div>
			        <div v-else class="card-header py-3">
			          <h4 class="h4-responsive text-center font-weight-bold text-dark">Historia Laboral</h4>
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
	        		  	errors: []
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
	        			console.log(response.data)
	        			this.puestos = [];
	        			this.datos = [];
	        		    this.agente = response.data[0];
	        		    this.puestos = this.agente.puestolaborales;
	        			google.charts.setOnLoadCallback(this.drawChart);
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
	        			colors : ['#63813f', '#80a851', '#9fd065','#b1e870', '#c1fc7b', '#d8ffaa'],
	        			//backgroundColor :'#bcc5b1',
	        			timeline: { singleColor: '#8d8' },
	        			timeline: { rowLabelStyle: {fontName: 'Helvetica', fontSize: 12, color: '#666666' },
	        			                     barLabelStyle: { fontName: 'Garamond', fontSize: 12 } }

	        		}


	        		chart.draw(dataTable , option);

        		    // google.visualization.events.addListener(chart, 'ready', function () {
        		    //   container.innerHTML = '<img src="' + chart.getImageURI() + '">';
        		    // });
	        	}
	        },

	    }
</script>