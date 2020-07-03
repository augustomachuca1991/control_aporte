<template>
<div id="panelcategoria">
    <filtroclase-component @categoria="get_codigo(...arguments)"></filtroclase-component>
    <div class="card shadow">
      <div class="card-header">
          <h5 class="card-title">Clases</h5>
      </div>
      <div class="card-body">
        <clase-component :clases="clases"></clase-component>
      </div>  
    </div>  
</div>
</template>

<script>
     export default {
        data: function() {
            return{
                clases:''
            }
      },
      methods:{
        get_codigo(clases){
          this.clases = clases;
        }
      },
      mounted() {

      },

    }
</script>
