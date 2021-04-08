<template>
	<div id="panel_historia_laboral">
		 	<section class="content">
		 	  <div class="container-fluid">
		 	    <div class="row">
		 	      <div class="col-12 col-md-6">
		 	        <div class="card card-outline card-orange">
		 	          <div class="card-header">
		 	            <h3 class="card-title">Periodo Liquidación</h3>

		 	            <div class="card-tools">
		 	              <button type="button" class="btn btn-tool" data-card-widget="collapse">
		 	                <i class="fas fa-minus"></i>
		 	              </button>
		 	            </div>
		 	          </div>
		 	            <div class="card-body" style="min-height: 135px; height: 135px; max-height: 135px; max-width: 100%;">
		 	              <div>
		 	                  <!--calendar-->
		 	                  		    <!-- <label for="exampleInputEmail1">Periodo liquidacion <i class="fas fa-calendar-alt"></i></label>
		 	                      		<month-picker-input v-model='anio'
		 	                              :lang="'es'"
		 	                              :max-date="fecha_actual"
		 	                              :default-month="6"
		 	                              :default-year="2020"
		 	                              :input-pre-filled="true"
		 	                              @change="showDate"
		 	                            	></month-picker-input> -->
		 	              </div>
		 	            </div>
		 	        </div>
		 	      </div>
		 	      <div class="col-12 col-md-6">
		 	        <!-- DONUT CHART -->
		 	        <div class="card card-outline card-orange">
		 	          <div class="card-header">
		 	            <h3 class="card-title">Bucar Por Agente</h3>

		 	            <div class="card-tools">
		 	              <button type="button" class="btn btn-tool" data-card-widget="collapse">
		 	                <i class="fas fa-minus"></i>
		 	              </button>
		 	            </div>
		 	          </div>
		 	          <div class="card-body" style="min-height: 135px; height: 135px; max-height: 135px; max-width: 100%;">
		 	          	<buscaragente-component @buscarAgente="datos_agente(...arguments)"></buscaragente-component>
  			           	<span class="errors text-danger" v-for="error in errors.cuil">    
  	                     <small><em>{{error}}</em></small>
  	                  	</span>	
		 	          </div>
		 	        </div>

		 	      </div>
		 	      <!-- /.col (LEFT) -->
		 	        <div class="col-12">
		 	          <div class="card">
		 	            <div class="card-header bg-gradient-orange">
		 	              <h3 class="card-title text-white">Historias Laborales</h3>

		 	              <!-- <div class="card-tools">
		 	                <div class="input-group input-group-sm" style="width: 150px;">
		 	                  <input type="search" name="table_search" class="form-control float-right" placeholder="Buscar">

		 	                  <div class="input-group-append">
		 	                    <button type="button" class="btn btn-outline-success" disabled>
		 	                      <i class="fas fa-search"></i>
		 	                    </button>
		 	                  </div>
		 	                </div>
		 	              </div> -->
		 	            </div>
		 	            <!-- /.card-header -->
		 	            <div class="card-body">
		 	              
		 	            	
		 	            	<!-- Main node for this component -->
		 	            	<div class="timeline timeline-inverse">
		 	            	  <!-- Timeline time label -->
		 	            	  <div class="time-label">
		 	            	    <span>{{this.fecha_ingreso }} </span>
		 	            	  </div>
		 	            	  <div>
		 	            	  <!-- Before each timeline item corresponds to one icon on the left scale -->
		 	            	    <i class="fas fa-address-card bg-blue"></i>
		 	            	    <!-- Timeline item -->
		 	            	    <div class="timeline-item">
		 	            	    <!-- Time -->
		 	            	      <span class="time"><i class="fas fa-clock"></i> 12:05</span>
		 	            	      <!-- Header. Optional -->
		 	            	      <h3 class="timeline-header"><a href="#">Datos Personales</a> {{nombre}}</h3>
		 	            	      <!-- Body -->
		 	            	      	<!--carga-->
	  	 	            	        <div v-if="shown">
	  	 	            	        	<!-- <i class='fas fa-2x fa-sync-alt fa-spin'></i> -->
	          			        		<!-- <div class="spinner-grow text-dark" style="width: 3rem; height: 3rem;" role="status">
	          			        		  <span class="sr-only">Loading...</span>
	          			        		</div>
	          			        		<div class="spinner-grow text-info" style="width: 3rem; height: 3rem;" role="status">
	          			        		  <span class="sr-only">Loading...</span>
	          			        		</div>
	          			        		<div class="spinner-grow text-success" style="width: 3rem; height: 3rem;" role="status">
	          			        		  <span class="sr-only">Loading...</span>
	          			        		</div> -->
	          			        		<div class="text-center content-center my-5">
      			        		          Espere...
      			        		          <span>
      			        		            <img height="80px" src="image/ips_loading.gif" />
      			        		          </span>
      			        		        </div>
	          			        	</div>

		 	            	      <div v-else class="timeline-body">
		 	            	      	<strong>Nombre:</strong>{{nombre}}<br>
		 	            	        <strong>Cuil:</strong>{{cuil | formatCuil}}<br>
		 	            	        <strong>Fecha de Nacimiento:</strong> {{fecha_nac}}<br>
		 	            	        <strong>Sexo:</strong>{{sexo}}<br>
		 	            	        <strong>Puestos Laborales</strong>
		 	            	        <ul>
		 	            	        	<li v-for="(puesto_laboral,index) in puestos_laborales" :key="puesto_laboral.id">Puesto Laboral: #{{puesto_laboral.cod_laboral}}
		 	            	        	<button class="btn btn-outline-info border-0 btn-xs" @click="cargo(index)">
		 	            	        		<i class="fas fa-eye"></i>
		 	            	        	</button>
		 	            	        	</li>
		 	            	        </ul>
		 	            	      </div>
		 	            	      <!-- Placement of additional controls. Optional -->
		 	            	      <div class="timeline-footer">
		 	            	        <a class="btn bg-gradient-navy btn-sm" @click="historiaLaboral()">Ver Periodo Completo</a>
		 	            	        <!-- <a class="btn btn-danger btn-sm">Delete</a> -->
		 	            	      </div>
		 	            	    </div>
		 	            	  </div>
		 	            	  <!-- The last icon means the story is complete -->
		 	            	  <div>
		 	            	    <i class="fas fa-clock bg-gray"></i>
		 	            	    <div class="timeline-item">
		 	            	    <!-- Time -->
		 	            	      <span class="time"><i class="fas fa-clock"></i> 12:05</span>
		 	            	      <!-- Header. Optional -->
		 	            	      <h3 class="timeline-header"><a href="#" class="text-dark">Historia Laboral</a> sent you an email</h3>
		 	            	      <!-- Body -->
		 	            	      <div class="timeline-body">
		 	            	        
	        			        	<div class="shadow" id="timeline" style="height: 250px; border: 1px solid #ccc"></div>
		 	            	      </div>
		 	            	      <!-- Placement of additional controls. Optional -->
		 	            	      <div class="timeline-footer">
		 	            	        <!-- <a class="btn btn-primary btn-sm">Read more</a> -->
		 	            	        <a class="btn bg-gradient-orange btn-sm" @click="empty()"><i class="fas fa-broom"></i>&nbsp;Limpiar</a>
		 	            	      </div>
		 	            	    </div>
		 	            	  </div>
		 	            	</div>









		 	            </div>
		 	            <!-- /.card-body -->
		 	          </div>
		 	          <!-- /.card -->
		 	        </div>
		 	      </div>
		 	    <!-- /.row -->
		 	  </div><!-- /.container-fluid -->
		 	</section>
	</div>
</template>

<script type="text/javascript">
		

		 export default {
	        data: function() {
	                return {
	                    agente:{},
	                    cuil:'',
	                    nombre:'',
	                    fecha_nac: '',
	                    sexo:'',
	                    datos: [],
	        		  	puestos_laborales: [],
	        		  	puesto_laboral:{},
	        		  	errors: [],
	        		  	shown: false,
	        		  	fecha_ingreso: 'fecha ingreso',
	        		  	fecha_egreso: 'fecha cese',
	                }
	            },
	        mounted() {
	              console.log('agente filter component mounted')
	              google.charts.load('current', {'packages':['timeline']});
				  
	        },
	        methods:{
	        	datos_agente:function(input){
	        		this.empty();
	        		this.cuil = input.search;
	        		let formData = new FormData()
	        		formData.append('cuil', this.cuil)
	        		axios.post(`api/agente`, formData)
	        		.then((response)=>{
	        			

	        			if (response.data.isError) {
	        				this.empty();
	        				this.errors = response.data.data;
	        			} else {
	        				this.shown = true;
	        				setTimeout(() => {
		        				
		          				this.empty();
		  	        		    this.agente = response.data.data;
		  	        		    this.cuil = this.agente.cuil;
		  	        		    this.nombre = this.agente.nombre;
		  	        		    this.fecha_nac = this.agente.fecha_nac;
		  	        		    this.sexo = this.agente.sexo;
		  	        		    this.puestos_laborales = this.agente.puestolaborales
		  	        		    console.log(this.agente);
		  	        		 //    this.shown = false;
		  	        			
	        				}, 2500)
	        				
	        			}
	        		}).catch((err) => {
	                   console.log(err.response.data)
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

	        		if (this.puesto_laboral.fecha_egreso) {
	        			fecha_egreso = new Date(this.puesto_laboral.fecha_egreso);
	        		} else {
	        			fecha_egreso = new Date();
	        		}

	        		this.fecha_ingreso = this.puesto_laboral.fecha_ingreso;
	        		this.fecha_egreso = fecha_egreso;
	        		this.datos.push([
	        			'PL: '+this.puesto_laboral.cod_laboral, 
	        			'Organismo: '+this.puesto_laboral.organismo.organismo,
	        			new Date(this.puesto_laboral.fecha_ingreso),
	        			fecha_egreso,
	        			])


	        		dataTable.addRows(this.datos);

	        		var option = {
	        			colors : ['#ffc26c', '#ffe0b5'],
	        			//backgroundColor :'#bcc5b1',

	        		}


	        		chart.draw(dataTable , option);

        		    // google.visualization.events.addListener(chart, 'ready', function () {
        		    //   container.innerHTML = '<img src="' + chart.getImageURI() + '">';
        		    // });
	        	},
	        	empty:function () {
    				this.errors = [];
    				this.puestos_laborales = [];
        			this.datos = [];
        			this.agente = {};
        			this.nombre = '';
        			this.cuil = '';
        			this.fecha_nac = '';
        			this.sexo = '';
        			this.shown = false;
        			this.cod_laboral = '';
        			this.fecha_ingreso = 'fecha ingreso';
        			this.fecha_egreso = 'fecha cese';
        			this.organismo = '';
	        	},
	        	historiaLaboral:function(){
	        		console.log(this.puestos_laborales)
	        	},
	        	cargo:function(index){
	        		this.datos= [];
	        		this.puesto_laboral = this.puestos_laborales[index];
	        		google.charts.setOnLoadCallback(this.drawChart);
	        		console.log(this.puesto_laboral);



	        	},
	        },
	        filters:{
	          formatCuil:function(value){
	              value = value.toString();
	              if (value.length == 10 ) {
	                value = '0'+value;
	              }

	              var last = value.slice(-1);
	              var dni = value.slice(2,-1);
	              var first = value.charAt(0)+value.charAt(1);

	              return first+'-'+dni+'-'+last;
	          },
	        }

	    }
</script>