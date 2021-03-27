<template>
	 <div id="panel_computos">
	 	<section class="content">
	 	  <div class="container-fluid">
	 	    <div class="row">
	 	      <div class="col-12 col-md-6">
	 	        <div class="card card-outline card-maroon">
	 	          <div class="card-header">
	 	            <h3 class="card-title">Periodo Liquidación</h3>

	 	            <div class="card-tools">
	 	              <button type="button" class="btn btn-tool" data-card-widget="collapse">
	 	                <i class="fas fa-minus"></i>
	 	              </button>
	 	            </div>
	 	          </div>
	 	            <div class="card-body">
	 	              <div style="min-height: 100px; height: 100px; max-height: 100px; max-width: 100%;">
	 	                  <!--calendar-->
	 	                  		    <label class="text-muted"><i class="fas fa-calendar-alt"></i> Periodo liquidacion </label>
	 	                      		<month-picker-input v-model='anio'
	 	                              :lang="'es'"
	 	                              :max-date="fecha_actual"
	 	                              :default-month="6"
	 	                              :default-year="2020"
	 	                              :input-pre-filled="true"
	 	                              @change="showDate"
	 	                            	></month-picker-input>
	 	              </div>
	 	            </div>
	 	        </div>
	 	      </div>
	 	      <div class="col-12 col-md-6">
	 	        <!-- DONUT CHART -->
	 	        <div class="card card-outline card-maroon">
	 	          <div class="card-header">
	 	            <h3 class="card-title">Tipo de liquidación</h3>

	 	            <div class="card-tools">
	 	              <button type="button" class="btn btn-tool" data-card-widget="collapse">
	 	                <i class="fas fa-minus"></i>
	 	              </button>
	 	            </div>
	 	          </div>
	 	          <div class="card-body">
	 	          	<div style="min-height: 100px; height: 100px; max-height: 100px; max-width: 100%;">
	 	          		
	 	          		<filtertipoliquidacion-component @sendTipo="getTipoLiquidacion(...arguments)"></filtertipoliquidacion-component>
	 	          	</div>
	 	          </div>
	 	        </div>

	 	      </div>
	 	      <!-- /.col (LEFT) -->
	 	        <div class="col-12">
	 	          <div class="card card-maroon">
	 	            <div class="card-header">
	 	              <h3 class="card-title">Computos</h3>

	 	              <div class="card-tools">
	 	                <div class="input-group input-group-sm" style="width: 150px;">
	 	                  <input type="search" name="table_search" class="form-control float-right" placeholder="Buscar" style="background: #f4f4f4;">

	 	                  <!-- <div class="input-group-append">
	 	                    <button type="button" class="btn btn-outline-success" disabled>
	 	                      <i class="fas fa-search"></i>
	 	                    </button>
	 	                  </div> -->
	 	                </div>
	 	              </div>
	 	            </div>
	 	            <!-- /.card-header -->
	 	            <div class="card-body" style="background: #f4f4f4;">
	 	              
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
	 	            <!-- /.card-body -->
	 	          </div>
	 	          <!-- /.card -->
	 	        </div>
	 	      </div>
	 	    <!-- /.row -->
	 	  </div><!-- /.container-fluid -->
	 	</section>
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
            getTipoLiquidacion: function(id){
            	axios.get(`api/computo/origen/tipo-liquidacion/${id}`).then((response)=>{
            		this.origenes = response.data
            	}).catch(function (error) {
            		console.log(error);
            	});

            	axios.get(`api/computo/jurisdiccion/tipo-liquidacion/${id}`).then((response)=>{
            		this.jurisdicciones = response.data
            	}).catch(function (error) {
            		console.log(error);
            	});

            	axios.get(`api/computo/organismo/tipo-liquidacion/${id}`).then((response)=>{
            		this.organismos = response.data
            	}).catch(function (error) {
            		console.log(error);
            	});
					
                
			},
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
        
            