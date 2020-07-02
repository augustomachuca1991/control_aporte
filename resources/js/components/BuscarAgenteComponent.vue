<template>
	<div>
      <div class="form-group border-0 shadow p-3">
        <div class="col-12 col-lg">
          <label for="nombre" class="text-muted"><i class="fas fa-search"></i></label>
          	<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="buscar" id="inlineRadio1" value="1"  v-model="checked">
			  <label class="form-check-label" for="inlineRadio1">Por Nombre</label>
			</div>
			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="buscar" id="inlineRadio2" value="2" v-model="checked">
			  <label class="form-check-label" for="inlineRadio2">Por Cuil</label>
			</div>
			<form class="form-row" @submit.prevent="buscar()" method="POST">
				<div class="col-10">
	           		<input type="text" class="form-control" id="nombre" placeholder="Por Nombre" required v-model="nombre">
				</div>
				<div class="col-2">
	           		<button type="submit" class="btn btn-outline-success btn-block"><i class="fas fa-search"></i></button>
				</div>
			</form>
           <input type="text" class="form-control" id="cuil" placeholder="Por Cuil" required hidden v-model="cuil">
          <!--<label class="text-muted">nombre:&nbsp;{{nombre}}</label>-->
        </div>
      </div>
  	</div>
					
					
           
	
</template>

<script>
	
	 export default {
        data: function() {
                return {
                    nombre:'',
                    cuil:'',
                    checked:'',
                }
            },
        mounted() {
              console.log('agente filter component mounted')
        },
        methods:{
        	buscar:function(){
        		const input = this.nombre;
        		this.$emit('buscarAgente',input);
        	}
        },

    }
</script>