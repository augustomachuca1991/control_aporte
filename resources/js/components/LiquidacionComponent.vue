<template>
  <div id="lista_liquidaciones">
    <!--<label>Liquidaciones {{filtro.data}} </label>-->
    <!-- <paginate name="liquidacions" :list="filtro.data" :per="10" ref="paginator" tag="tbody">
    
    <paginate> -->
    <!--table-->
  
    <div class="table-responsive">
      <paginate name="liquidacions" :list="filtro.data" :per="10" ref="paginator" tag="tbody">
        <table class="table">
          <caption>
              <span v-if="$refs.paginator">
                  Mostrando {{$refs.paginator.pageItemsCount}} resultados
              </span>
          </caption>
          <thead>
            <tr>
              <th scope="col">Puesto Laboral</th>
              <th scope="col">Tipo Liquidacion</th>
              <th scope="col">Agente</th>
              <th scope="col">Periodo</th>
              <th scope="col">Jurisdiccion</th>
              <th scope="col">Organismo</th>
              <th scope="col"></th>
            </tr>
          </thead>
            <tbody>
              

              <tr v-if="!filtro.condition">
                <td>No se encontraron resultados</td>
              </tr>
              <tr v-else v-for="liquidacion in paginated('liquidacions')" :key="liquidacion.id">
                  <th scope="row" v-for="historia_laboral in liquidacion.historia_laborales" :key="historia_laboral.id">00{{historia_laboral.puesto.cod_laboral}}</th>
                  <td v-for="tipoliquidacion in liquidacion.liquidacion_organismo" :key="tipoliquidacion.id">{{tipoliquidacion.tipoliquidacion.descripcion}}</td>
                  <td v-for="historia_laboral in liquidacion.historia_laborales" :key="historia_laboral.id">{{historia_laboral.puesto.agente.nombre}}</td>
                  <td v-for="periodo in liquidacion.liquidacion_organismo" :key="periodo.id">{{periodo.periodo.periodo}}</td>
                  <td v-for="organismo in liquidacion.liquidacion_organismo" :key="organismo.id">{{organismo.organismo.jurisdiccion.jurisdiccion}}</td>
                  <td v-for="organismo in liquidacion.liquidacion_organismo" :key="organismo.id">{{organismo.organismo.organismo}}</td>
                  <td>
                      <a :href="'#detalle'" class="btn btn-outline-success rounded-circle btn-sm mb-1 my-lg-0 border-0" data-toggle="modal" v-on:click="show(liquidacion.id)">
                      <i class="fas fa-dollar-sign"></i>
                      </a>  
                  </td>
              </tr>
            </tbody>
        </table>
      </paginate>
    </div>
   <!--  <div v-if="shown">
      <div class="spinner-grow text-dark" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
      </div>
      <div class="spinner-grow text-info" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
      </div>
      <div class="spinner-grow text-success" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div> -->
  <!-- <nav aria-label="Page navigation example"> 
    <paginate-links 
      for="liquidacions" 
      :async="true"
      :limit="3" 
      :show-step-links="true"
      :step-links="{
        next: '»',
        prev: '«'
      }"
      :classes="{'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'}"
      :hide-single-page="true"
      @change="onLangsPageChange">
    </paginate-links>
  </nav> -->
   
    

    <!--modal-->
    <div id="detalle" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" v-for="periodo in liquidacion.liquidacion_organismo" :key="periodo.id">Periodo -&nbsp;{{periodo.periodo.periodo}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="empty()">
              <span class="btn btn-danger" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--cabecera-->
            <div class="row"> 
              <div class="col">
                  <p class="text-center">LIQUIDACIÓN</p> 
              </div>
            </div> 
            <!--cabecera -->
            <div class="row bg-light"> 
                <div class="col">
                    <div class="row"> 
                      <div class="col">
                           <small>Jurisdiccion</small>  
                      </div> 
                    </div>
                    <div class="row">
                      <div class="col">
                          <small v-for="organismo in liquidacion.liquidacion_organismo" :key="organismo.id">{{organismo.organismo.jurisdiccion.jurisdiccion}}</small> 
                      </div>
                    </div> 

                </div>
                <div class="col">
                    <div class="row"> 
                      <div class="col">
                           <small>Organismo</small>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                          <small v-for="organismo in liquidacion.liquidacion_organismo" :key="organismo.id">{{organismo.organismo.organismo}}</small> 
                      </div> 
                    </div>

                </div> 
                <div class="col">
                    <div class="row"> 
                      <div class="col"> 
                             <small>Cargo</small>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                          <small>no definido</small> 
                      </div> 
                    </div>

                </div>
                <div class="col"> 
                  <div class="row"> 
                      <div class="col">
                            <small>Mes</small> 
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <small v-for="periodo in liquidacion.liquidacion_organismo" :key="periodo.id">{{periodo.periodo.mes}}</small>
                      </div> 
                    </div>
                </div> 
                <div class="col">
                    <div class="row"> 
                      <div class="col">
                           <small>Año </small>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                             <small v-for="periodo in liquidacion.liquidacion_organismo" :key="periodo.id">{{periodo.periodo.anio}}</small>
                      </div> 
                    </div>
                </div>      
            </div>
            <!--cabecera-->
            <div class="row my-3 bg-light"> 
                <div class="col">
                    <div class="row"> 
                      <div class="col">
                           <small>Nombre</small>  
                      </div>
                    </div>    
                    <div class="row">
                      <div class="col">
                           <small v-for="historia_laboral in liquidacion.historia_laborales" :key="historia_laboral.id">{{historia_laboral.puesto.agente.nombre}}
                           </small>
                      </div> 
                    </div>
                </div>
                <div class="col">
                    <div class="row"> 
                      <div class="col">
                           <small>Cuil</small>  
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col">
                          <small v-for="historia_laboral in liquidacion.historia_laborales" :key="historia_laboral.id">{{historia_laboral.puesto.agente.cuil}}</small> 
                      </div> 
                    </div>
                </div> 
                <div class="col">
                    <div class="row"> 
                      <div class="col"> 
                             <small>Puesto Laboral</small>  
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col">
                          <small v-for="historia_laboral in liquidacion.historia_laborales" :key="historia_laboral.id">
                               {{historia_laboral.puesto.cod_laboral}}
                          </small>
                      </div> 
                    </div>
                </div>
                <div class="col"> 
                  <div class="row"> 
                      <div class="col">
                           <small>Antigüedad</small>  
                      </div> 
                    </div>
                    <div class="row">
                      <div class="col">
                          <small v-for="historia_laboral in liquidacion.historia_laborales" :key="historia_laboral.id">
                            {{historia_laboral.fecha_ingreso}}
                          </small> 
                      </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="row"> 
                      <div class="col">
                           <small>Estado</small>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                          <small v-for="historia_laboral in liquidacion.historia_laborales" :key="historia_laboral.id">
                            {{historia_laboral.historialiquidaciones[0].estado.estado}}
                          </small> 
                      </div> 
                    </div>
                </div>
                <div class="col">
                    <div class="row"> 
                      <div class="col">
                           <small>Función</small>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                          <small v-for="historia_laboral in liquidacion.historia_laborales" :key="historia_laboral.id">
                            <p v-if="historia_laboral.historialiquidaciones[0].funcion === null">-</p>
                            <p v-else>{{historia_laboral.historialiquidaciones[0].funcion.funcion}}</p>
                          </small> 
                      </div> 
                    </div>
                </div>       
            </div>
            <!--table-->
            <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
              <table class="table table-sm table-borderless table-fixed">
                <caption class="justify-content-end">
                  
                  <!-- <small>
                    Total Neto $ {{(liquidacion.bruto + liquidacion.bonificable + liquidacion.no_bonificable + liquidacion.no_remunerativo + liquidacion.familiar) - liquidacion.descuento}}
                  </small> -->
                </caption>
                <thead class="bg-light" >
                  <tr>
                    <th scope="col" class="text-center"><small>Cod</small></th>
                    <th scope="col" class="text-center"><small>Concepto</small></th>
                    <th scope="col" class="text-center"><small>Cantidad</small></th>
                    <th scope="col" class="text-center"><small>Remunerativo</small></th>
                    <th scope="col" class="text-center"><small>No-Remunerativo</small></th>
                    <th scope="col" class="text-center"><small>Adicional-Familiar</small></th>
                    <th scope="col" class="text-center"><small>Descuento</small></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="detalle in liquidacion.detalles" :key="detalle.id">
                    <th scope="row"><small>{{detalle.concepto_id}}</small></th>
                    <td>
                      <small>{{detalle.concepto.concepto}}</small>
                    </td>
                    <td>
                      <small>{{detalle.unidad}}</small>
                    </td>
                    <td>
                      <small v-if="detalle.concepto.subtipo.tipocodigo.id < 4">{{detalle.importe}}</small>
                      <small v-else>-</small>
                    </td>
                    <td>
                      <small  v-if="detalle.concepto.subtipo.tipocodigo.id === 4">{{detalle.importe}}</small>
                      <small v-else>-</small>
                    </td>
                    <td>
                      <small  v-if="detalle.concepto.subtipo.tipocodigo.id === 5">{{detalle.importe}}</small>
                      <small v-else>-</small>
                    </td>
                    <td>
                      <small  v-if="detalle.concepto.subtipo.tipocodigo.id === 6">{{detalle.importe}}</small>
                      <small v-else>-</small>
                    </td>
                  </tr>
                </tbody>
                <tfoot class="bg-light">
                  <th scope="row" colspan="3">
                    <small>Subtotal</small>
                  </th>
                  <td>
                    <small>$ {{liquidacion}}</small>
                  </td>
                  <td>
                    <small>$ {{liquidacion.no_remunerativo}}</small>
                  </td>
                  <td>
                    <small>$ {{liquidacion.familiar}}</small>
                  </td>
                  <td>
                    <small>$ {{liquidacion.descuento}}</small>
                  </td>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        data: function(){
            return{
                liquidaciones:[],
                liquidacion:[],
            }
        
        },
        mounted() {
           axios.get('api/liquidacion').then((response)=>{
               console.log('Liquidaciones mounted');
               this.liquidaciones = response.data;
            })
        }, 
        methods:{
            show(id){
                axios.get(`api/liquidacion/detalle/`+id).then((response)=>{
                  console.log('Liquidacion mounted');
                   this.liquidacion = [];
                   this.liquidacion = response.data;
                })

            },
            empty(){
                this.liquidacion = [];
            },
        }
    }
</script>