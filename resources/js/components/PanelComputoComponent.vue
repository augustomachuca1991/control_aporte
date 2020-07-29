<template>
	 <div>
	    <filtroperiodo-component @sendPeriodo="getPeriodo(...arguments)"></filtroperiodo-component>
		<div class="card text-center">
		  <div class="card-header">
		  	<p>El calculo de computos se obtendran respecto al periodo de liquidación, el resultado
		  		obtenedido mostrará de forma global el total en $ (pesos argentinos), agrupados por origenes, por jurisdicciones o bien por organismos.
		  	</p>
		    <ul class="nav nav-tabs card-header-tabs">
		      <!--<li class="nav-item">
		        <a class="nav-link " id="origen-tab" data-toggle="tab" href="#origen" role="tab" aria-controls="origen" aria-selected="false">Por Origenes</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" id="jurisdiccion-tab" data-toggle="tab" href="#jurisdiccion" role="tab" aria-controls="jurisdiccion" >Por Jurisdicciones</a>
		      </li>-->
		      <li class="nav-item">
		        <a class="nav-link active" id="organismo-tab" data-toggle="tab" href="#organismo" role="tab" aria-controls="organismo">Por Organismos</a>
		      </li>
		    </ul>
		  </div>
		  <div class="card-body">
		  	<div class="tab-content" id="myTabContent">
	        	<!--<computoorigen-component :origenes="origenes"></computoorigen-component>
		    	<computojur-component :jurisdicciones="jurisdicciones"></computojur-component>-->
		    	<computoorganismo-component :organismos="organismos"></computoorganismo-component>
	      	</div>
		  </div>
		</div>
	 </div>
</template>

<script>
  export default {
        data: function(){
            return{
                //origenes:[],
                //jurisdicciones:[],
                organismos:[],
                periodo:'',
            }
        
        },
        mounted() {
            console.log("panel computos component mounted");
        },
        methods:{
            getPeriodo: function(id){
            	if (id) {
            		this.periodo = id	
					axios.get(`api/computo/origen/${this.periodo}`).then((response)=>{
						//this.origenes = response.data
						//this.jurisdicciones = response.data
						this.organismos = response.data
					}).catch(function (error) {
						console.log(error);
					});
            	}
					
                
			},
        },
  }
</script>
        
            