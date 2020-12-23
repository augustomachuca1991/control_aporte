<template>
    <!--historia laboral-->
    <div class="row">
        <div class="col-12">

          <!-- Project Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Historia Laborales</h6>
            </div>
            <div class="card-body">
              <div id="timeline" style="height: 250px;"></div>
            </div>
          </div>
        </div>
    </div>
    
</template>
<script>
    
    export default {
        data: function(){
            return{
                
                message: "",
            }
        },

        mounted() {

            console.log('historia laboral mounted.')
        },

        methods: {
        },
    }
</script>
