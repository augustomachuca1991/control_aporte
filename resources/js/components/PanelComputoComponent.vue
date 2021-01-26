<template>
	 <div>
	 	<!-- <filtroperiodo-component @sendPeriodo="getPeriodo(...arguments)"></filtroperiodo-component> -->
	    <div class="form-group">
		    <label for="exampleInputEmail1">Periodo liquidacion <i class="fas fa-calendar-alt"></i></label>
    		<month-picker-input v-model='anio'
            :lang="'es'"
            :max-date="fecha_actual"
            :default-month="1"
            :default-year="2021"
            :input-pre-filled="true"
            @change="showDate"
          	></month-picker-input>
		 </div>
		  <div class="form-group">

		  	<ul class="nav nav-tabs" id="myTab" role="tablist">
		  	  <li class="nav-item" role="presentation">
		  	    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Origen</a>
		  	  </li>
		  	  <li class="nav-item" role="presentation">
		  	    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Jurisdicción</a>
		  	  </li>
		  	  <li class="nav-item" role="presentation">
		  	    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Organismo</a>
		  	  </li>
		  	</ul>
		  	<div class="tab-content" id="myTabContent">
		  	  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><computoorigen-component :origenes="origenes"></computoorigen-component></div>
		  	  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><computojur-component :jurisdicciones="jurisdicciones"></computojur-component></div>
		  	  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><computoorganismo-component :organismos="organismos"></computoorganismo-component></div>
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
                fecha_actual:null,
                mes:null,
                anio:null,
                date: {
    				from: null,
    				to: null,
    				month: null,
    				year: null,
    				monthIndex: null,
    			}
            }
        
        },
        mounted() {
            console.log("panel computos component mounted");
            var milisegundos = Date.now();
            this.fecha_actual = new Date(milisegundos);
            this.mes = this.fecha_actual.getMonth()+1;
            this.anio = this.fecha_actual.getFullYear();
            //console.log(this.fecha_actual.getMonth()+1)

        },
        methods:{
   //          getPeriodo: function(id){
   //          	if (id) {
   //          		this.periodo = id	
			// 		axios.get(`api/computo/origen/${this.periodo}`).then((response)=>{
			// 			this.origenes = response.data
			// 		}).catch(function (error) {
			// 			console.log(error);
			// 		});

			// 		axios.get(`api/computo/jurisdiccion/${this.periodo}`).then((response)=>{
			// 			this.jurisdicciones = response.data
			// 		}).catch(function (error) {
			// 			console.log(error);
			// 		});

			// 		axios.get(`api/computo/organismo/${this.periodo}`).then((response)=>{
			// 			this.organismos = response.data
			// 		}).catch(function (error) {
			// 			console.log(error);
			// 		});
   //          	}
					
                
			// },
			showDate (date) {
						this.date = date
						if (this.date.monthIndex.toString().length < 2){
							var mes ='0'.concat(this.date.monthIndex.toString());
							this.periodo = this.date.year.toString()+mes;
							
						}else{
							this.periodo = date.year.toString()+date.monthIndex.toString();
						}

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
  }
</script>
        
            