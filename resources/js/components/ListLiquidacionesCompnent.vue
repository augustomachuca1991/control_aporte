<template>
  <div class="table-responsive-lg">
    <!--<label>Liquidaciones {{liquidaciones}} </label>-->

    <!--table-->
    <table class="table table-sm table-hover table-bordeless" v-model="filtro.data.data">
      <caption>
          Instituto de Previsión Social de Corrientes
      </caption>
      <thead>
        <tr class="table-dark">
          <th scope="col">#cod</th>
          <th scope="col">Tipo Liquidacion</th>
          <th scope="col">Agente</th>
          <th scope="col">Puesto Laboral</th>
          <th scope="col">Periodo</th>
          <th scope="col">Jurisdiccion</th>
          <th scope="col">Organismo</th>
          <th scope="col">Detalle</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="!filtro.condition" class="table-default text-center">
          <td colspan="8">No hay datos</td>
        </tr>
        <tr v-else v-for="liquidacion in filtro.data.data">
          <th scope="row">00{{liquidacion.id}}</th>
          <td v-for="tipoliquidacion in liquidacion.liquidacion_organismo">{{tipoliquidacion.tipoliquidacion.descripcion}}</td>
          <td v-for="historia_laboral in liquidacion.historia_laborales">{{historia_laboral.puesto.agente.nombre}}</td>
          <td v-for="historia_laboral in liquidacion.historia_laborales">{{historia_laboral.puesto.cod_laboral}}</td>
          <td v-for="periodo in liquidacion.liquidacion_organismo">{{periodo.periodo.periodo}}</td>
          <td v-for="organismo in liquidacion.liquidacion_organismo">{{organismo.organismo.jurisdiccion.jurisdiccion}}</td>
          <td v-for="organismo in liquidacion.liquidacion_organismo">{{organismo.organismo.organismo}}</td>
          <td>
              <a :href="'#detalle'" class="btn btn-outline-success border-0 btn-sm shadow text-muteds" data-toggle="modal" v-on:click="show(liquidacion.id)">
              <i class="fas fa-dollar-sign"></i>
              </a>  
          </td>
        </tr>
      </tbody>
      <tfoot v-if="filtro.condition"> 
        <!--pagination-->
        <tr>
          <th scope="row" colspan="8">
            <paginate-links for="filtro.data.data" :classes="{'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'}"></paginate-links>
          </th>
        </tr>
      </tfoot>
    </table>

    <!--modal-->
    <div id="detalle" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" v-model="liquidacion">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" v-for="periodo in liquidacion.liquidacion_organismo">Periodo -&nbsp;{{periodo.periodo.periodo}}</h5>
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
                          <small v-for="organismo in liquidacion.liquidacion_organismo">{{organismo.organismo.jurisdiccion.jurisdiccion}}</small> 
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
                          <small v-for="organismo in liquidacion.liquidacion_organismo">{{organismo.organismo.organismo}}</small> 
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
                        <small v-for="periodo in liquidacion.liquidacion_organismo">{{periodo.periodo.mes}}</small>
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
                          <small>
                             <small v-for="periodo in liquidacion.liquidacion_organismo">{{periodo.periodo.anio}}</small>
                          </small> 
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
                           <small v-for="historia_laboral in liquidacion.historia_laborales">{{historia_laboral.puesto.agente.nombre}}
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
                          <small v-for="historia_laboral in liquidacion.historia_laborales">{{historia_laboral.puesto.agente.cuil}}</small> 
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
                          <small v-for="historia_laboral in liquidacion.historia_laborales">
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
                          <small v-for="historia_laboral in liquidacion.historia_laborales">
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
                          <small>Activo</small>
                      </div> 
                    </div>
                </div>      
            </div>
            <!--table-->
            <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
              <table class="table table-sm table-borderless table-fixed">
                <caption class="justify-content-end" v-model="liquidacion">
                  
                  <small>
                    Total Neto $ {{(liquidacion.bruto + liquidacion.bonificable + liquidacion.no_bonificable + liquidacion.no_remunerativo + liquidacion.familiar) - liquidacion.descuento}}
                  </small>
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
                  <tr v-for="detalle in liquidacion.detalles">
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
                <tfoot class="bg-light" v-model="liquidacion">
                  <th scope="row" colspan="3">
                    <small>Subtotal</small>
                  </th>
                  <td>
                    <small>$ {{liquidacion.bruto + liquidacion.bonificable + liquidacion.no_bonificable}}</small>
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
        props:['filtro'],
        data: function(){
            return{
                liquidaciones:[],
                liquidacion:[],
                paginate:this.liquidaciones,
                //pagination:{
                //  current_page:this.filtro.current_page,
                //  primero:this.filtro.first_page_url,
                //  ultimo:this.filtro.last_page_url,
                //  from:this.filtro.from,
                //  last_page:this.filtro.last_page,
                //  next_page_url:this.filtro.next_page_url,
                //  path:this.filtro.path,
                //  per_page:this.filtro.per_page,
                //  to:this.filtro.per_page,
                //  total:this.filtro.total
                //},
            }
        
        },
        mounted() {

                
                console.log('tabla liquidacion component mounted')
        }, 
        methods:{
            show(id){

                axios.get(`api/liquidacion/detalle/`+id).then((response)=>{
                   this.liquidacion = [];
                   this.liquidacion = response.data;
                })
            },
            empty(){
                //this.liquidaciones = this.filtros.data.data
                this.liquidacion = [];
            },
        },
    }
</script>
