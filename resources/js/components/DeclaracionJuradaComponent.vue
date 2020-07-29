<template>
	<div class="table-lg-responsive">
		<table class="table table-sm table-hover table-bordeless">
	      <caption>
	          Instituto de Previsión Social de Corrientes
	      </caption>
	      <thead>
	        <tr class="table-dark">
	          <th scope="col">#cod</th>
	          <th scope="col">Usuario</th>
	          <th scope="col">Organismo</th>
	          <th scope="col">Rectificativa</th>
	          <th scope="col">Creacion</th>
	          <th scope="col">Ultima Modificación</th>
	          <th scope="col">Accion</th>
	        </tr>
	      </thead>
	      <tbody>
	        <tr v-if="false" class="table-default text-center">
	          <td colspan="7">No hay datos</td>
	        </tr>
	        <tr v-else v-for="(declaracion_jurada, index) in declaraciones_juradas" :key="declaracion_jurada.id">
	          <th scope="row">{{declaracion_jurada.id}}</th>
	          <td>{{declaracion_jurada.user_id}}</td>
	          <td>{{declaracion_jurada.organismo_id}}</td>
	          <td v-if="declaracion_jurada.secuencia === null">original</td>
	          <td v-else>rectificativa nº {{declaracion_jurada.secuencia}}</td>
	          <td>{{declaracion_jurada.created_at}}</td>
	          <td>{{declaracion_jurada.updated_at}}</td>
	          <td>
	              <a class="btn btn-outline-success border-0 btn-block shadow text-muted" data-toggle="modal">
	              	accion
	              </a>  
	          </td>
	        </tr>
	      </tbody>
	      
	    </table>

	</div>
</template>

<script>
	export default {
        data: function(){
            return{
            	declaraciones_juradas:[],
            }
        },
        mounted(){
           axios.get('api/declaracion_jurada').then((response)=>{
               console.log(response.data)
               this.declaraciones_juradas = response.data;
           })
        },
        methods:{

        },
    }
</script>