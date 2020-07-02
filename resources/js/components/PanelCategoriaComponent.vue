<template>
<div id="panelcategoria">
    <filtrocategoria-component @jurisdiccion="get_codigo(...arguments)"></filtrocategoria-component>
    <div class="card shadow"> 
      <div class="card-header">
          <h5 class="card-title">Categorías</h5> 
      </div>
      <div class="card-body">
        <categoria-component :categorias="categorias"></categoria-component>
      </div>  
    </div>  
</div>
</template>

<script>
     export default {
        data: function() {
            return{
                categorias:[]
            }
      },
      methods:{
          get_codigo(categorias){
            this.categorias = categorias;
          }
      },
      mounted() {
           
      },

    }
</script>