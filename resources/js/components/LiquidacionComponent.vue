<template>
  <div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow mb-3" v-model="liquidaciones">
                    <div class="card-header text-center" v-for="liquidacion in liquidaciones">
                        Liquidacion de {{liquidacion.periodos[0].periodo}}
                    </div>

                    <div class="card-body">
                        <div class="container-fluid my-3">
                            <div class="table-responsive">  
                              <table class="table table-borderless">
                                <caption v-for="liquidacion in liquidaciones">
                                    Jurisdiccion de {{liquidacion.organismos[0].jurisdiccion_id}}
                                </caption>
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col"># Codigo</th>
                                    <th scope="col">Organismo</th>
                                    <th scope="col">Tipo liquidacion</th>
                                    <th scope="col">Puesto laboral</th>
                                    <th scope="col">Agente</th>
                                    <th scope="col">accion</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="liquidacion in liquidaciones">
                                    <th scope="row">
                                        <tr>  
                                            <td>13214{{liquidacion.id}}</td>
                                        </tr>
                                    </th>
                                    <td>
                                        <tr v-for="organismo in liquidacion.organismos">  
                                            <td> {{organismo.organismo}}</td>
                                        </tr>
                                    </td>
                                    <td>
                                        <tr v-for="tipo in liquidacion.tipo_liquidaciones">  
                                            <td> {{tipo.descripcion}}</td>
                                        </tr>
                                    </td>
                                    <td>
                                        <tr v-for="historia_laboral in liquidacion.historia_laborales">  
                                            <td> {{historia_laboral.puesto.cod_laboral}}</td>
                                        </tr>
                                    </td>
                                    <td v-for="historia_laboral in liquidacion.historia_laborales">
                                        <tr>  
                                            <td>{{historia_laboral.puesto.agente.nombre}}</td>
                                        </tr>
                                    </td>
                                    <td>
                                      <tr>  
                                          <td>
                                            <a :href="'#detalle'"  class="btn btn-primary btn-block text-white" data-toggle="modal" data-id=liquidacion.id>ver</a>  
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
    <div id="detalle" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" v-for="liquidacion in liquidaciones">Periodo -&nbsp;{{liquidacion.periodos[0].periodo}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="btn btn-danger" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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
                          <small v-for="liquidacion in liquidaciones">{{liquidacion.organismos[0].jurisdiccion_id}}</small> 
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
                          <small v-for="liquidacion in liquidaciones" >{{liquidacion.organismos[0].organismo}}</small> 
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
                          <small v-for="liquidacion in liquidaciones">
                            {{liquidacion.periodos[0].mes}}
                          </small> 
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
                          <small v-for="liquidacion in liquidaciones">
                            {{liquidacion.periodos[0].anio}}
                          </small> 
                      </div> 
                    </div>
                </div>      
            </div>
            <!--cabecera-->
            <div class="row my-3 bg-light" v-for="liquidacion in liquidaciones"> 
                <div class="col">
                    <div class="row"> 
                      <div class="col">
                           <small>Nombre</small>  
                      </div>
                    </div>    
                    <div class="row">
                      <div class="col">
                          <small v-for="historia_laboral in liquidacion.historia_laborales">
                              {{historia_laboral.puesto.agente.nombre}}
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
                          <small  v-for="historia_laboral in liquidacion.historia_laborales">
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
                          <small>12</small> 
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
                <caption class="justify-content-end"><small>Total Neto $ 31070.50</small></caption>
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
                  <tr>
                    <th scope="row"><small>1</small></th>
                    <td><small>Basico</small></td>
                    <td><small>1</small></td>
                    <td><small>7590.72</small></td>
                    <td><small>-</small></td>
                    <td><small>-</small></td>
                    <td><small>-</small></td>
                  </tr>
                  <tr>
                    <th scope="row"><small>2</small></th>
                    <td><small>Antigüedad</small></td>
                    <td><small>12 años</small></td>
                    <td><small>3795.40</small></td>
                    <td><small>-</small></td>
                    <td><small>-</small></td>
                    <td><small>-</small></td>
                  </tr>
                  <tr>
                    <th scope="row"><small>65</small></th>
                    <td><small>Funcion Especifica</small></td>
                    <td>-</td>
                    <td><small>23379.47</small></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <th scope="row"><small>3</small></th>
                    <td><small>Bonificacion por titulo</small></td>
                    <td>-</td>
                    <td>-</td>
                    <td><small>6695.03</small></td>
                    <td>-</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <th scope="row"><small>4</small></th>
                    <td><small>Presentismo</small></td>
                    <td>-</td>
                    <td>-</td>
                    <td><small>2277.22</small></td>
                    <td>-</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <th scope="row"><small>5</small></th>
                    <td><small>Aporte Jubilatorio</small></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><small>9972.16</small></td>
                  </tr>
                  <tr>
                    <th scope="row"><small>6</small></th>
                    <td><small>Obra Social</small></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><small>2695.18</small></td>
                  </tr>
                </tbody>
                <tfoot class="bg-light">
                  <th scope="row" colspan="3"><small>Subtotal</small></th>
                  <td><small>$ 34765.59</small></td>
                  <td><small>$ 8972.25</small></td>
                  <td><small>-</small></td>
                  <td><small>$ 12667.34</small></td>
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
            }
        
        },
        mounted() {
           axios.get('api/liquidacion').then((response)=>{
               console.log(response.data);
               this.liquidaciones = response.data;
            })
        }
    }

    //$('#detalle').on('show.bs.modal', function (event) {
    //  //Capturo Datos del Click en el boton 
    //  var button  = $(event.relatedTarget)
    //  var id      = button.data('id')
    //  console.log(id)
    //  //cargo en el modal mostrar
    //  var modal = $(this)
    //  //modal.find('.modal-title #liquidacion').html(id)
    //})
</script>