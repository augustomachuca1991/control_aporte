<template>
  <div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow mb-3" >
                    <div class="card-header text-center">
                        <h4 class="h4-responsive text-muted">Liquidaciones</h4>
                    </div>

                    <div class="card-body">
                        <div class="container-fluid my-3">
                            <div class="table-responsive">  
                              <table class="table table-borderless" v-model="liquidaciones">
                                <caption>
                                    Instituto de Previsión Social de Corrientes
                                </caption>
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col"># Codigo</th>
                                    <th scope="col">Tipo liquidacion</th>
                                    <th scope="col">Agente</th>
                                    <th scope="col">Puesto laboral</th>
                                    <th scope="col">Periodo</th>
                                    <th scope="col">Detalle</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="liquidacion in liquidaciones" :key="liquidacion.id" :liquidacion="liquidacion">
                                    <th scope="row">
                                        <tr>  
                                            <td>000{{liquidacion.id}}</td>
                                        </tr>
                                    </th>
                                    <td>
                                        <tr v-for="tipo in liquidacion.tipo_liquidaciones">  
                                            <td> {{tipo.descripcion}}</td>
                                        </tr>
                                    </td>
                                    <td v-for="historia_laboral in liquidacion.historia_laborales">
                                        <tr>  
                                            <td>{{historia_laboral.puesto.agente.nombre}}</td>
                                        </tr>
                                    </td>
                                    <td>
                                        <tr v-for="historia_laboral in liquidacion.historia_laborales">  
                                            <td> {{historia_laboral.puesto.cod_laboral}}</td>
                                        </tr>
                                    </td>
                                    <td v-for="periodo in liquidacion.periodos">
                                        <tr>  
                                            <td>{{periodo.periodo}}</td>
                                        </tr>
                                    </td>
                                    <td>
                                      <tr>  
                                          <td>
                                            <a :href="'#detalle'"  class="btn btn-outline-success shadow" data-toggle="modal" v-on:click="show(liquidacion.id)"><i class="fas fa-dollar-sign"></i></a>  
                                          </td>
                                      </tr>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--modal-->
    <div id="detalle" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" v-model="liquidacion">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" v-for="liquid in liquidacion">Periodo -&nbsp;{{liquid.periodos[0].periodo}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="empty()">
              <span class="btn btn-danger" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" v-for="liquid in liquidacion">
            <!--cabecera-->
            <div class="row"> 
              <div class="col">
                  <p class="text-center">LIQUIDACIONES</p> 
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
                          <small v-for="organismo in liquid.organismos">{{organismo.jurisdiccion.jurisdiccion}}</small> 
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
                          <small v-for="organismo in liquid.organismos">{{organismo.organismo}}</small> 
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
                          <small>Personal IPS</small> 
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
                        <small v-for="periodo in liquid.periodos">{{periodo.mes}}</small>
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
                             <small v-for="periodo in liquid.periodos">{{periodo.anio}}</small>
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
                           <small v-for="historia_laboral in liquid.historia_laborales">{{historia_laboral.puesto.agente.nombre}}
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
                          <small v-for="historia_laboral in liquid.historia_laborales">{{historia_laboral.puesto.agente.cuil}}</small> 
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
                          <small v-for="historia_laboral in liquid.historia_laborales">
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
                          <small v-for="historia_laboral in liquid.historia_laborales">
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
              <table class="table table-borderless table-fixed table-sm">
                <caption class="justify-content-end" v-model="liquidacion" v-for="liquid in liquidacion">
                  <small>
                    Total Neto $ {{(liquid.bruto + liquid.bonificable + liquid.no_bonificable + liquid.no_remunerativo + liquid.familiar) - liquid.descuento}}
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
                  <tr v-for="detalle in liquid.detalles">
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
                <tfoot class="bg-light" v-model="liquidacion" v-for="liq in liquidacion">
                  <th scope="row" colspan="3">
                    <small>Subtotal</small>
                  </th>
                  <td>
                    <small>$ {{liq.bruto + liq.bonificable + liq.no_bonificable}}</small>
                  </td>
                  <td>
                    <small>$ {{liq.no_remunerativo}}</small>
                  </td>
                  <td>
                    <small>$ {{liq.familiar}}</small>
                  </td>
                  <td>
                    <small>$ {{liq.descuento}}</small>
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