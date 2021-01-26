<template>
	<div v-if="shown">
		<h4 class="h4-responsive card-title text-center my-4">Declaraciones Juradas</h4>
		<div class="row">
		  <div class="col-md-12 col-lg-4 offset-lg-8 my-2 ">
		    <form class="form-inline justify-content-end">
		          <label for="buscador" class="mx-1 sr-only"><i class="fa fa-search"></i></label>
		          <input id="buscador" class="form-control mr-sm-2 w-100 w-lg-80" type="search" placeholder="Buscar..." aria-label="Search" v-model="search" @keyup="buscar()">
		    </form>
		  </div>
		</div>
		<div class="table-lg-responsive">
			<paginate  name="dd_jj" :list="declaraciones_juradas" :per="8" ref="paginator">
				<table class="table table-sm">
			      <caption>
			          <span v-if="$refs.paginator">
						 mostrando {{$refs.paginator.pageItemsCount}} resultados
					  </span>
			      </caption>
			      <thead>
			        <tr>
			          <th scope="col">Usuario</th>
			          <th scope="col">Generado</th>
			          <th scope="col">Organismo</th>
			          <th scope="col">Tipo</th>
			          <th scope="col">Periodo</th>
			          <th scope="col">Rectificativa</th>
			          <th scope="col"></th>
			          <!--<th scope="col">Accion</th> -->
			        </tr>
			      </thead>
			      <tbody>
			        <tr v-if="declaraciones_juradas.length === 0" class="table-default text-center">
			          <td colspan="7">No hay datos</td>
			        </tr>
			        <tr v-else v-for="(declaracion_jurada, index) in paginated('dd_jj') " :key="declaracion_jurada.id">
			          <th scope="row">{{declaracion_jurada.user.name | capitalize}}</th> 
			          <td>{{declaracion_jurada.created_at | moment}}</td>
			          <td>{{declaracion_jurada.organismo.organismo | capitalize}}</td>
			          <td>{{declaracion_jurada.tipoliquidacion.descripcion}}</td>
			          <td>{{declaracion_jurada.periodo.periodo}}</td>
			          <td v-if="declaracion_jurada.secuencia === null">Original</td>
			          <td v-else>Nº{{declaracion_jurada.secuencia}}</td>
			          <td>
			              <a class="btn btn-outline-info text-info btn-sm border-0" data-toggle="tooltip" data-placement="bottom" title="Descargar declaracion jurada" @click="download(declaracion_jurada.path)">
			              	<i class="fas fa-download"></i>
			              </a>
			              <!-- <a class="btn btn-outline-primary btn-sm text-primary" @click="getDetalle(declaracion_jurada.id)" data-toggle="modal" data-target=".bd-example-modal-lg">
			              	<i class="far fa-eye"></i>
			              </a>  -->
			          </td>
			        </tr>
			      </tbody>
			      
			    </table>
		    </paginate>
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
				<!-- <a class="btn btn-primary shadow text-white">
					aplicadas <i class="fas fa-check"></i>
				</a> -->
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
            	search:'',
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
  		  download: function(pathToFile){
  		  				const params = {
  		  					path: pathToFile,
  		  				} 
  		  			  	axios.post('api/declaracion_jurada/download', params, {responseType: 'arraybuffer'})
  		  			  	.then((response)=>{
  		  			  		//console.log(response.data)
  		  			  		var fileUrl = window.URL.createObjectURL(new Blob([response.data]))
  		  			  		var fileLink = document.createElement('a')
  		  			  		fileLink.href = fileUrl

  		  			  		fileLink.setAttribute('download', 'declaracionjurada.csv')
  		  			  		document.body.appendChild(fileLink)
  		  			  		fileLink.click()
  		  	       		})
  		  },
  		  buscar(){
  		    axios.get(`api/declaracion_jurada/${this.search}`).then((response)=>{
  		        //console.log(response.data)
  		        this.declaraciones_juradas = response.data;
  		    })
  		  },

		},
		//filters: {
		//  moment: function (date) {
		//    return moment(date ,"YYYYMMDD").locale('es').fromNow();
		//  }
		//}
    }
</script>