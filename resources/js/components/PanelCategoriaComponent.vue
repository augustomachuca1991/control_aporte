<template>
<div id="panelcategoria">
    <filtrocategoria-component ></filtrocategoria-component>
    <div class="card shadow"> 
      <div class="card-header">
          <h5 class="card-title">Categorías</h5> 
      </div>
      <div class="card-body">
         
          <categoria-component></categoria-component>
      </div>  
    </div>  
</div>
</template>

<script>
     export default {
        data: function() {
            return{
                categorias : [],
            }
      },
      methods:{
        //   get_categorias(categorias){
        //       this.categorias = categorias;
        //     //   console.log(codigo);
        //   },
      },
      mounted() {
           
      },

    }
</script>