<template>
<div id="panelcategoria">
    <h3 class="h3-responsive mb-3">Categorías</h3>
    <filtrocategoria-component @jurisdiccion="get_codigo(...arguments)" :selectO="selectO"></filtrocategoria-component>
    <categoria-component :categorias="categorias" @select="selectOrigen(...arguments)"></categoria-component>
    
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
