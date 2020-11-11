<template>
	 <div>
	 	<p>{{ date.month  }}-{{date.year}}</p>
	 	  <month-picker @change="showDate"></month-picker>
	    <filtroperiodo-component @sendPeriodo="getPeriodo(...arguments)"></filtroperiodo-component>
	    <!-- <month-picker-input :no-default="true"></month-picker-input> -->
		<div class="card text-center">
		  <div class="card-header">
		    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		      <li class="nav-item" role="presentation">
		        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Origen</a>
		      </li>
		      <li class="nav-item" role="presentation">
		        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Jurisdiccion</a>
		      </li>
		      <li class="nav-item" role="presentation">
		        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Organismo</a>
		      </li>

		    </ul>
		    <div class="tab-content" id="pills-tabContent">
		      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"><computoorigen-component :origenes="origenes"></computoorigen-component></div>
		      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"><computojur-component :jurisdicciones="jurisdicciones"></computojur-component></div>
		      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"><computoorganismo-component :organismos="organismos"></computoorganismo-component></div>
		    </div>
		  </div>
		</div>
	 </div>
</template>

<script>
  //import MonthPicker from 'vue-month-picker'
  export default {
	  	// components: {
	  	// 		MonthPicker
	  	// },
        data: function(){
            return{
                origenes:[],
                jurisdicciones:[],
                organismos:[],
                periodo:'',
                date: {
    				from: null,
    				to: null,
    				month: null,
    				year: null
    			}
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
						this.origenes = response.data
					}).catch(function (error) {
						console.log(error);
					});

					axios.get(`api/computo/jurisdiccion/${this.periodo}`).then((response)=>{
						this.jurisdicciones = response.data
					}).catch(function (error) {
						console.log(error);
					});

					axios.get(`api/computo/organismo/${this.periodo}`).then((response)=>{
						this.organismos = response.data
					}).catch(function (error) {
						console.log(error);
					});
            	}
					
                
			},
			showDate (date) {
						this.date = date
			}
        },
  }
</script>
        
            