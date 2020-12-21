<template>

  <div>
    <form @submit.prevent="buscar()" method="POST">
      <label for="nombre" class="text-muted"><i class="fas fa-search"></i> Buscar Agente</label>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Buscar... " aria-label="Recipient's username" aria-describedby="button-addon2" name="search" id="search" v-model="search">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </form>
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
            this.search = '';
        	}
        },

    }
</script>