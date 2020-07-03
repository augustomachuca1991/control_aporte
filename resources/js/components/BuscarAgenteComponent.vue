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
			<form class="form-row" @submit.prevent="buscar()" method="POST" v-model="checked">
            <div class="col" v-if="checked == ''">
         		  <label class="text-muted">Seleccione un metodo de busqueda</label>
            </div>
            <div v-else class="col">
              <div class="row">
                <div class="col-10">
                  <input :hidden="checked != 1" type="text" class="form-control" name="nombre" id="nombre" placeholder="Por Nombre" required v-model="nombre">
                  <input :hidden="checked != 2" type="text" class="form-control" name="cuil" id="cuil" placeholder="Por Cuil" required v-model="cuil">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-outline-success btn-block">
                      <i class="fas fa-search"></i>
                    </button>
                </div>
              </div>
            </div>
      </form>
        <!--<label class="text-muted">{{input}}</label>-->
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
        		const params = {
              nombre: this.nombre,
              cuil: this.cuil,
            };
            //alert(JSON.stringify(params))
        		this.$emit('buscarAgente',params);
        	}
        },

    }
</script>