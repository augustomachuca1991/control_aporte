<template>
<div id="panelcategoria">
    <filtrocategoria-component @jurisdiccion="get_codigo(...arguments)"></filtrocategoria-component>
    <div class="card shadow"> 
      <div class="card-header">
          <h5 class="card-title">Categorías</h5> 
      </div>
      <div class="card-body">
        <categoria-component :categorias="categorias" @actualizar="created(...arguments)"></categoria-component>
      </div>  
    </div>  
</div>
</template>

<script>
     export default {
        data: function() {
            return{
                // data: {
                //     // cod_jurisdiccion: '',
                // },
                categorias:[]
            }
      },
      methods:{
          get_codigo(categorias){
              // this.data.cod_jurisdiccion = cod_jurisdiccion;
              this.categorias = categorias;
              // console.log("panel Categoria: "+this.data);
          },
      },
      mounted() {
           
      },

    }
</script>