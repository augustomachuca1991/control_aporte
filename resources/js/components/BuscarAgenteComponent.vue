<template>
	<div>
      <div class="form-group border-0 shadow p-3">
        <div class="col-12 col-lg">
          <label for="nombre" class="text-muted"><i class="fas fa-search"></i> Buscar Agente</label>
          	
    			<form class="form-row mt-1" @submit.prevent="buscar()" method="POST">
                
            <div class="col-10">
              <input type="text" class="form-control" name="search" id="search" placeholder="Buscar" required v-model="search">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-outline-success btn-block">
                  <i class="fas fa-search"></i>
                </button>
            </div>
          </form>
        <!--<label class="text-muted">Nombre: {{search}}</label>-->
      </div>
    </div>
	</div>
					
					
           
	
</template>

<script>
	
	 export default {
        data: function() {
                return {
                    search:'',
                }
            },
        mounted() {
              console.log('agente filter component mounted')
        },
        methods:{
        	buscar:function(){
        		const params = {
              search: this.search,
            };
            //alert(JSON.stringify(params))
        		this.$emit('buscarAgente',params);
        	}
        },

    }
</script>