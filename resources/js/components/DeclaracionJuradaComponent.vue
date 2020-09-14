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
				          <th scope="col">Periodo de Liquidación</th>
				          <th scope="col">Importado</th>
				          <!-- <th scope="col">Usuario</th>
				          <th scope="col">Accion</th> -->
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
				          <!-- <td>{{declaracion_jurada.created_at | moment}}</td>
				          <td>{{declaracion_jurada.user.name}}</td> -->
				          <td>
				              <a class="btn btn-outline-success btn-sm text-success" data-toggle="tooltip" data-placement="bottom" title="aplicar tarea">
				              	<i class="fas fa-tasks"></i>
				              </a>
				              <a class="btn btn-outline-primary btn-sm text-primary" @click="getDetalle(declaracion_jurada.id)" data-toggle="modal" data-target="#detalle">
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
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel" v-model="title">{{title}}</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body" v-model="detalle">
		        {{detalle}}
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Save changes</button>
		      </div>
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
            	detalle:[],
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
		  		this.detalle = []
		  		response.data.forEach(obj => {
			        this.detalle.push(obj.data);
			        console.log('data: '+obj.data);
			    });
			    this.title = 'Declaracion jurada Nº '+response.data[0].declaracionjurada_id
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