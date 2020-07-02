<template>
<div id="panelcategoria">
    <filtrocategoria-component @jurisdiccion="get_codigo(...arguments)"></filtrocategoria-component>
    <div class="card shadow">
      <div class="card-header">
          <h5 class="card-title">Categorías</h5>
      </div>
      <div class="card-body">
<<<<<<< HEAD
        <categoria-component :categorias="categorias"></categoria-component>
      </div>  
    </div>  
=======
        <categoria-component :categorias="categorias" @actualizar="created(...arguments)"></categoria-component>
      </div>
    </div>
>>>>>>> b01a58520c69b9a26ba482658c3437bbac073948
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
