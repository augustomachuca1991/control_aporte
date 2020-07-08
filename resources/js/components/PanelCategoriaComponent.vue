<template>
<div id="panelcategoria">
    <filtrocategoria-component @jurisdiccion="get_codigo(...arguments)" :selectO="selectO"></filtrocategoria-component>
    <div class="card shadow">
      <div class="card-header">
          <h5 class="card-title" align="center"><b>Categorías</b></h5>
      </div>
      <div class="card-body">
        <categoria-component :categorias="categorias" @select="selectOrigen(...arguments)"></categoria-component>
      </div>  
    </div>  
    
</div>
</template>

<script>
     export default {
        data: function() {
            return{
                categorias:'',
                selectO:'',
                selectJ:''
            }
      },
      methods:{
          get_codigo(categorias){
            this.categorias = categorias;
          },
          selectOrigen(selectO){
            this.selectO = selectO;
          }
      },
      mounted() {

      },

    }
</script>
