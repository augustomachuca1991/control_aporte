<template>
    <!-- <div class="container">
        

        <div class="card my-5 border-0 shadow">
            <div class="card-header bg-info">
                <div class="card-title">
                    <h2 class="text-white">Panel de busqueda</h2>
                </div>
            </div>
            <div class="card-body">
                <filter-component 
                        @sendOrigen="search('origen',...arguments)" 
                        @sendJur="search('jurisdiccion',...arguments)" 
                        @sendOrganismo="search('organismo',...arguments)">
                </filter-component>
                <div class="form-row my-2 justify-content-between">
                    <div class="col-12 col-md-12 col-lg-4 mb-md-3">
                        <buscaragente-component 
                            @buscarAgente="like(...arguments)">
                        </buscaragente-component>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <filtertipoliquidacion-component 
                            @sendTipo="search('tipo_liquidacion',...arguments)">
                        </filtertipoliquidacion-component>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <filtroperiodo-component 
                           @sendPeriodo="search('periodo',...arguments)">
                        </filtroperiodo-component>
                    </div>
                </div>
            </div>
        </div>
            
        <h3>Liquidaciones</h3>
        <listaliquidaciones-component 
            :filtro="filtro">
        </listaliquidaciones-component>        
        
    </div> -->
    <div id="panel_liquidacion">    
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card card-outline card-pink">
                  <div class="card-header">
                    <h3 class="card-title">Filtros</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="import">
                        <filter-component 
                                @sendOrigen="porOrigen(...arguments)" 
                                @sendJur="porJurisdiccion(...arguments)" 
                                @sendOrganismo="porOrganismo(...arguments)">
                        </filter-component>
                    </div>
                  </div>
                </div>
               </div>



               <div class="col-12 col-md-4">
                 <div class="card card-outline card-pink">
                   <div class="card-header">
                     <h3 class="card-title">Buscar Agentes</h3>

                     <div class="card-tools">
                       <button type="button" class="btn btn-tool" data-card-widget="collapse">
                         <i class="fas fa-minus"></i>
                       </button>
                     </div>
                   </div>
                   <div class="card-body">
                     <div class="import" style="min-height: 100px; height: 100px; max-height: 100px; max-width: 100%;">
                         <buscaragente-component 
                             @buscarAgente="porAgente(...arguments)">
                         </buscaragente-component>
                     </div>
                   </div>
                 </div>
                </div>


                <div class="col-12 col-md-4">
                  <div class="card card-outline card-pink">
                    <div class="card-header">
                      <h3 class="card-title">Buscar Periodo</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div  style="min-height: 100px; height: 100px; max-height: 100px; max-width: 100%;">
                          <!-- <filtroperiodo-component 
                             @sendPeriodo="search('periodo',...arguments)">
                          </filtroperiodo-component> -->
                          <!-- <label for="periodo" class="text-muted"><i class="fas fa-search"></i>
                            Periodo Liquidaciones
                          </label>
                          <br>
                          <input type="date" name="periodo">
 -->

                          
                            <!-- <label for="periodo" class="text-muted">
                              <i class="fas fa-search"></i>
                                Periodo Liquidaciones
                            </label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                              </div>
                              <input type="date" class="form-control" id="Fecha">
                            </div> -->
                            <label class="text-muted"><i class="fas fa-calendar-alt"></i> Periodo liquidacion </label>
                            <month-picker-input
                                :lang="'es'"
                                :max-date="fecha_actual"
                                :clearable="true"
                                :default-month="3"
                                :default-year="2021"
                                :input-pre-filled="true"
                                :editable-year="true"
                                @change="porPeriodo"
                                @clear>
                                  
                            </month-picker-input>
                          
                      </div>
                    </div>
                  </div>
                 </div>


                <div class="col-12 col-md-4">
                  <div class="card card-outline card-pink">
                    <div class="card-header">
                      <h3 class="card-title">Tipo Liquidación</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div style="min-height: 100px; height: 100px; max-height: 100px; max-width: 100%;">
                          <filtertipoliquidacion-component 
                              @sendTipo="porTipo(...arguments)">
                          </filtertipoliquidacion-component>
                      </div>
                    </div>
                  </div>
                 </div>
             
              <!-- /.col (LEFT) -->
                <div class="col-12">
                  <div class="card card-outline">
                    <div class="card-header bg-gradient-pink">
                      <h3 class="card-title">Lista de Haberes</h3>

                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="search" name="table_search" class="form-control float-right" placeholder="Buscar"">
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      

                      <table v-if="shown" class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th scope="col">Agente</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Puestos Laborales</th>
                            <th scope="col">Periodo</th>
                            <th scope="col">Organismo</th>
                            <th scope="col">Clase</th>
                            <th scope="col">Categoria</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                          <tbody>
                            <tr>
                              <td colspan="8" style="height: 200px;" class="align-middle">
                                <span class="text-center">Cargando...</span>
                                <div class="spinner-border text-primary" role="status">
                                  <span class="sr-only">Loading...</span>
                                </div>
                              </td>
                            </tr>  
                          </tbody>
                      </table> 
                      
                      <listaliquidaciones-component v-else
                          :datos="liquidaciones">
                      </listaliquidaciones-component> 
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card-body -->
                    <div class="card-footer">
                      total registros encontrados {{paginate.total}}
                      <ul class="pagination pagination-sm m-0 float-right">
                        <!-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li> -->
                        <!-- <li class="page-item"><a class="page-link" href="#">1</a></li> -->
                        <li class="page-item mx-1" :class="{ 'active': (paginate.current_page === n) }" v-for="n in paginate.last_page">
                            <a href="#" class="page-link bg-gradient-pink border-0 rounded-circle" @click.prevent="getPage(n)">
                                <span >
                                    {{ n }}
                                </span>
                            </a>
                        </li>
                        <!-- <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> -->
                      </ul>
                    </div>
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
    export default {
        data(){
            return{
                liquidaciones:[],
                liquidacion:{},
                shown:false,
                paginate:{
                  current_page:'',
                  last_page:'',
                  total:'',
                  path:'',
                  next_page_url:'',
                },
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


            };
        },
        mounted() {
            var milisegundos = Date.now();
            this.fecha_actual = new Date(milisegundos);
            this.mes = this.fecha_actual.getMonth()+1;
            this.anio = this.fecha_actual.getFullYear();
        },
        methods:{
            porOrigen(param){
              this.shown = true;
                setTimeout(()=>{
                  axios.get(`api/liquidacion/origen/`+param).then((response)=>{
                    this.shown = false;
                    this.liquidaciones = response.data.data;
                    this.paginate.current_page = response.data.current_page;
                    this.paginate.last_page = response.data.last_page;
                    this.paginate.total = response.data.total;
                    this.paginate.path = response.data.path;
                  });
                  
                }, 2000);

            },
            porJurisdiccion(param){
              this.shown = true;
                setTimeout(()=>{
                  axios.get(`api/liquidacion/jurisdiccion/`+param).then((response)=>{
                    this.shown = false;
                    this.liquidaciones = response.data.data;
                    this.paginate.current_page = response.data.current_page;
                    this.paginate.last_page = response.data.last_page;
                    this.paginate.total = response.data.total;
                    this.paginate.path = response.data.path;
                  });
                }, 2000);
            },
            porOrganismo(param){
              this.shown = true;
                setTimeout(()=>{
                  axios.get(`api/liquidacion/organismo/`+param).then((response)=>{
                    this.shown = false;
                    this.liquidaciones = response.data.data;
                    this.paginate.current_page = response.data.current_page;
                    this.paginate.last_page = response.data.last_page;
                    this.paginate.total = response.data.total;
                    this.paginate.path = response.data.path;
                  });
                }, 2000);
            },
            porAgente(param){
                let datosAgente = param.search;

                this.shown = true;
                setTimeout(()=>{
                  axios.get(`api/liquidacion/agente/`+datosAgente).then((response)=>{
                      this.shown = false;
                      this.liquidaciones = response.data.data;
                      this.paginate.current_page = response.data.current_page;
                      this.paginate.last_page = response.data.last_page;
                      this.paginate.total = response.data.total;
                      this.paginate.path = response.data.path;
                  })



                },2000);
                
            },
            getPage(page){
              axios.get(this.paginate.path+'?page='+page).then((response)=> {
                this.liquidaciones = response.data.data;
                this.paginate.current_page = response.data.current_page;
                this.paginate.last_page = response.data.last_page;
                this.paginate.total = response.data.total;
                this.paginate.path = response.data.path;
              })
            },
            porPeriodo (date) {
                  this.date = date
                  if (this.date.monthIndex.toString().length < 2){
                    var mes ='0'.concat(this.date.monthIndex.toString());
                    this.periodo = this.date.year.toString()+mes;
                    
                  }else{
                    this.periodo = date.year.toString()+date.monthIndex.toString();
                  }

                  this.shown = true;
                  setTimeout(()=>{
                    axios.get(`api/liquidacion/periodo/`+this.periodo).then((response)=>{
                        this.shown = false;
                        this.liquidaciones = response.data.data;
                        this.paginate.current_page = response.data.current_page;
                        this.paginate.last_page = response.data.last_page;
                        this.paginate.total = response.data.total;
                        this.paginate.path = response.data.path;
                    })



                  },2000);
            },
            porTipo (param) {
              this.shown = true;
              setTimeout(()=>{
                axios.get(`api/liquidacion/tipo/`+param).then((response)=>{
                    this.shown = false;
                    this.liquidaciones = response.data.data;
                    this.paginate.current_page = response.data.current_page;
                    this.paginate.last_page = response.data.last_page;
                    this.paginate.total = response.data.total;
                    this.paginate.path = response.data.path;
                })



              },2000);
            },
        },

    }
</script>










