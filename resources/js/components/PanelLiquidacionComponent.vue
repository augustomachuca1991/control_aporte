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
                <div class="card card-outline card-purple">
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
                                @sendOrigen="search('origen',...arguments)" 
                                @sendJur="search('jurisdiccion',...arguments)" 
                                @sendOrganismo="search('organismo',...arguments)">
                        </filter-component>
                    </div>
                  </div>
                </div>
               </div>



               <div class="col-12 col-md-4">
                 <div class="card card-outline card-purple">
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
                             @buscarAgente="buscar(...arguments)">
                         </buscaragente-component>
                     </div>
                   </div>
                 </div>
                </div>


                <div class="col-12 col-md-4">
                  <div class="card card-outline card-purple">
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
                          <filtroperiodo-component 
                             @sendPeriodo="search('periodo',...arguments)">
                          </filtroperiodo-component>
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
                          
                      </div>
                    </div>
                  </div>
                 </div>


                <div class="col-12 col-md-4">
                  <div class="card card-outline card-purple">
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
                              @sendTipo="search('tipo_liquidacion',...arguments)">
                          </filtertipoliquidacion-component>
                      </div>
                    </div>
                  </div>
                 </div>
             
              <!-- /.col (LEFT) -->
                <div class="col-12">
                  <div class="card card-outline">
                    <div class="card-header bg-purple">
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
                            <th scope="col">Puesto Laboral</th>
                            <th scope="col">Agente</th>
                            <th scope="col">Tipo Liquidacion</th>
                            <th scope="col">Periodo</th>
                            <th scope="col">Jurisdiccion</th>
                            <th scope="col">Organismo</th>
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
                          :filtro="filtro">
                      </listaliquidaciones-component> 
                    
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
    export default {
        data(){
            return{
                filtro:{
                data:[],
                periodo:'',
                tipo_liquidacion:'',
                origen:'',
                jurisdiccion:'',
                organismo:'',
                condition:false,
                },
                shown:false,
            };
        },
        mounted() {
            console.log('Panel Component')
        },
        methods:{
            search(index,parm){
                this.shown = true;
                switch (index) {
                  case 'periodo':
                    this.filtro.periodo = ''
                    this.filtro.periodo = parm
                    break;
                  case 'tipo_liquidacion':
                    this.filtro.tipo_liquidacion = ''
                    this.filtro.tipo_liquidacion = parm
                    break;
                  case 'origen':
                      this.filtro.origen = ''
                      this.filtro.jurisdiccion = ''
                      this.filtro.organismo = ''
                      this.filtro.origen = parm
                    break;
                  case 'jurisdiccion':
                      this.filtro.origen = ''
                      this.filtro.jurisdiccion = ''
                      this.filtro.organismo = ''
                      this.filtro.jurisdiccion = parm
                    break;
                  case 'organismo':
                      this.filtro.origen = ''
                      this.filtro.jurisdiccion = ''
                      this.filtro.organismo = ''
                      this.filtro.organismo = parm
                    break;
                }
                const params = {
                    periodo:this.filtro.periodo,
                    tipo_liquidacion:this.filtro.tipo_liquidacion,
                    organismo:this.filtro.organismo,
                    jurisdiccion:this.filtro.jurisdiccion,
                    origen:this.filtro.origen,
                }
                    
                setTimeout(() => {
                  axios.post('api/liquidacion/filtro', params).then((response)=>{
                    this.shown = false;
                    this.filtro.data = [];
                    this.filtro.condition = false
                    if (response.data.length != 0 ) {
                        this.filtro.data = response.data
                        console.log(this.filtro.data)
                        this.filtro.condition = true
                    }
                  }).catch(function (error) {
                    console.log(error);
                  });
                }, 2000)
                    
                
            },
            buscar(datos_agente){
                this.shown = true;
                setTimeout(()=>{
                  axios.post(`api/liquidacion/agente/filtro` , datos_agente).then((response)=>{
                      this.shown = false;
                      this.filtro.data = [];
                      this.filtro.condition = false
                      if (response.data.length != 0 ) {
                          this.filtro.data = response.data
                          this.filtro.condition = true
                      }
                  }).catch(function (error) {
                    console.log(error);
                  });



                },2000);
                
            }
        },

    }
</script>










