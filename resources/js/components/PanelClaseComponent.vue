<template>
<div id="panelcategoria">
    <filtroclase-component></filtroclase-component>
    <div class="card shadow">
      <div class="card-header">
          <h5 class="card-title">Clases</h5>
      </div>
      <div class="card-body">
        <clase-component></clase-component>
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
        
      },
      mounted() {

      },

    }
</script>
