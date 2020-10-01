<template>
	<div class="card border-0 shadow mb-3" v-if="shown">
		<div class="card-body">
			<h4 class="h4-responsive card-title text-center">Declaraciones Juradas</h4>
			<div class="table-lg-responsive">
				<paginate  name="dd_jj" :list="declaraciones_juradas" :per="8" ref="paginator">
					<table class="table table-sm table-hover table-bordeless">
				      <caption>
				          <span v-if="$refs.paginator">
							 mostrando {{$refs.paginator.pageItemsCount}} resultados
						  </span>
				      </caption>
				      <thead>
				        <tr class="table-dark">
				          <th scope="col">Organismo</th>
				          <th scope="col">Tipo Liquidacion</th>
				          <th scope="col">Rectificativa</th>
				          <th scope="col">Periodo</th>
				          <th scope="col">Usuario</th>
				          <th scope="col">Acción</th>
				          <!--<th scope="col">Accion</th> -->
				        </tr>
				      </thead>
				      <tbody>
				        <tr v-if="declaraciones_juradas.length === 0" class="table-default text-center">
				          <td colspan="7">No hay datos</td>
				        </tr>
				        <tr v-else v-for="(declaracion_jurada, index) in paginated('dd_jj') " :key="declaracion_jurada.id">
				          <th scope="row">{{declaracion_jurada.organismo.organismo | capitalize}}</th>
				          <td>{{declaracion_jurada.tipoliquidacion.descripcion}}</td>
				          <td v-if="declaracion_jurada.secuencia === null">Orginal</td>
				          <td v-else>Rectificativa nº{{declaracion_jurada.secuencia}}</td>
				          <td>{{declaracion_jurada.periodo.periodo}}</td>
				          <td>{{declaracion_jurada.user.name}}</td> 
				          <!-- <td>{{declaracion_jurada.created_at | moment}}</td>-->
				          <td>
				              <a class="btn btn-outline-success btn-sm text-success" data-toggle="tooltip" data-placement="bottom" title="aplicar tarea" @click="task(declaracion_jurada.id)">
				              	<i class="fas fa-tasks"></i>
				              </a>
				              <a class="btn btn-outline-primary btn-sm text-primary" @click="getDetalle(declaracion_jurada.id)" data-toggle="modal" data-target=".bd-example-modal-lg">
				              	<i class="far fa-eye"></i>
				              </a> 
				          </td>
				        </tr>
				      </tbody>
				      
				    </table>
			    </paginate>
			    <div class="d-flex flex-row-reverse">
			    	<paginate-links for="dd_jj" 
				    				:async="true" 
									:show-step-links="true"
							  		:step-links="{
							    	next: '»',
							    	prev: '«'
							  		}"
									:classes="{'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'}"
									:hide-single-page="true"
									:limit = "5">
					</paginate-links>
					<a class="btn btn-primary shadow text-white">
						aplicadas <i class="fas fa-check"></i>
					</a>
				</div>
			</div>
		</div>
			

		<!-- Modal -->
		<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <table class="table">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col"># Cuil</th>
				      <th scope="col">Nombre Agente</th>
				      <th scope="col">Puesto Laboral</th>
				      <th scope="col">Cargo</th>
				      <th scope="col">Clase</th>
				      <th scope="col">Estado</th>
				      <th scope="col">Jurisdiccion</th>
				      <th scope="col">Organismo</th>
				      <!-- <th scope="col">Haber Bruto</th>
				      <th scope="col">Aporte Personal</th>
				      <th scope="col">Basico</th>
				      <th scope="col">Adicionales</th>
				      <th scope="col">Funcion</th> -->
				    </tr>
				  </thead>
				  <tbody>
				    <tr v-for="(detalle,index) in detalles" :key="detalle.id">
				      <th scope="row">{{detalle.cuil}}</th>
				      <td>{{detalle.nombre | capitalize}}</td>
				      <td>{{detalle.puesto_laboral}}</td>
				      <td>{{detalle.cargo}}</td>
				      <td>{{detalle.clase}}</td>
				      <td>{{detalle.estado}}</td>
				      <td>{{detalle.jurisdiccion}}</td>
				      <td>{{detalle.organismo}}</td>
				      <!-- <td>{{detalle.haber_bruto}}</td>
				      <td>{{detalle.aporte_personal}}</td>
				      <td>{{detalle.basico}}</td>
				      <td>{{detalle.adicional}}</td>
				      <td>{{detalle.clase}}</td> -->
				    </tr>
				  </tbody>
			  </table>
		    </div>
		  </div>
		</div>
	</div>
</template>

<script> 
	export default {
        data: function(){
            return{
            	declaraciones_juradas:[],
            	detalles:[],
            	title:'',
            	paginate: ['dd_jj'],
            	shown: false,
            }
        },
        mounted(){
        	setTimeout(() => {
        		axios.get('api/declaracion_jurada').then((response)=>{
                	this.declaraciones_juradas = response.data;
		      		this.shown = true
           		})	
		    }, 0)
           
        },
        methods: {
		  moment: function () {
		    return moment().format('dd/mm/yyyy');
		  },
		  getDetalle: function(cabecera_id){
		  	axios.get('api/declaracion_jurada/detalle/'+cabecera_id).then((response)=>{
		  		this.title = ''
		  		this.detalles = []
		  		this.detalles = response.data
		  		this.title = 'Declaracion Jurada nº '+this.detalles[0].declaracionjurada_id
       		})
		  },
  		  task: function(cabecera_id){
  		  	let cabecera = cabecera_id
  		  	axios.delete('api/declaracion_jurada/aplicar/'+cabecera).then((response) =>{
	  		  	this.declaraciones_juradas = response.data
	  		  	swal.fire(
	  		  	          'Aplicando tarea',
	  		  	          response.status.toString(),
	  		  	          'success'
	  		  	      )
	  		  	//console.log(response.data)
  		  	}).catch((error)=>{
  		  		swal.fire(
	  		  	          'Error',
	  		  	          error.message,
	  		  	          'error'
	  		  	      )
  		  	})
  		  }

		},
		//filters: {
		//  moment: function (date) {
		//    return moment(date ,"YYYYMMDD").locale('es').fromNow();
		//  }
		//}
    }
</script>