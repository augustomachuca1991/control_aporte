<template>
  <div id="lista_liquidaciones">
    <!--<label>Liquidaciones {{filtro.data}} </label>-->
    <!-- <paginate name="liquidacions" :list="filtro.data" :per="10" ref="paginator" tag="tbody">
    
    <paginate> -->
    <!--table-->
  
    <!-- <div class="table-responsive">-->
      <!-- <paginate class="center" name="liquidacions" :list="filtro.data" :per="10" ref="paginator" tag="tbody">  -->
        <table <table class="table table-hover text-nowrap">
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
              <tr v-if="isEmpty">
                <td colspan="8" style="height: 200px;" class="align-middle"><p class="text-center">No se encontraron resultados</p></td>
              </tr>
              <tr v-else v-for=" (liquidacion,index) in datos" :key="datos.id">
                  <td style="width: 12.5%;">
                    <div v-for="historia_laboral in liquidacion.liquidacion.historia_laborales">
                      <strong>{{historia_laboral.puesto.agente.nombre}}</strong> <br>
                      {{historia_laboral.puesto.agente.cuil | formatCuil}} 
                    </div>
                  </td>
                  <td style="width: 10%;">
                     <span v-if="liquidacion.tipoliquidacion.descripcion === 'SAC' " class="badge bg-warning">
                      {{liquidacion.tipoliquidacion.descripcion}}
                     </span>
                     <span v-else class="badge bg-success">
                      {{liquidacion.tipoliquidacion.descripcion}}
                     </span>
                  </td> 
                  <td style="width: 5%;">
                    <div v-for="historia_laboral in liquidacion.liquidacion.historia_laborales">
                      {{historia_laboral.puesto.cod_laboral}}
                    </div>
                  </td>
                  <td>
                      {{liquidacion.periodo.mes}}/{{liquidacion.periodo.anio}}
                  </td> 
                  <td>
                      {{liquidacion.organismo.organismo}}
                  </td>
                  <td>
                    <div v-for="historia_laboral in liquidacion.liquidacion.historia_laborales">
                      {{historia_laboral.clase.clase}}
                    </div>
                  </td>
                  <td>
                    <div v-for="historia_laboral in liquidacion.liquidacion.historia_laborales">
                      {{historia_laboral.clase.categoria.categoria}}
                    </div>
                  </td>
                  <td>
                      <a :href="'#detalle'" class="btn btn-outline-success rounded-circle btn-sm mb-1 my-lg-0 border-0" data-toggle="modal" v-on:click="ver_detalle(index,liquidacion)">
                      <i class="fas fa-dollar-sign"></i>
                      </a>  
                      <!-- <a class="btn btn-success btn-xs text-white" data-toggle="modal" ><i class="fas fa-dollar-sign"></i></a> -->
                  </td>
              </tr>
            </tbody>
        </table>
        
      <!-- </paginate> -->
    <!--</div> -->
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
              <h5 class="modal-title" id="detalleModalLabel">Periodo - {{periodo.periodo}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="empty()">
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
                            <small >{{jurisdiccion.jurisdiccion}}</small> 
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
                            <small>{{organismo.organismo}}</small> 
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
                            <small>{{puesto.id}} cargo</small> 
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
                          <small>{{periodo.mes}}</small>
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
                               <small>{{periodo.anio}}</small>
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
                             <small>{{agente.nombre}}
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
                            <small>{{agente.cuil}}</small> 
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
                            <small>
                                 {{puesto.cod_laboral}}
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
                            <small>
                              {{puesto.fecha_ingreso | format_moment}}
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
                            <small>
                              {{estado.estado}}
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
                            <small>
                              <p v-if="historialiquidacion.funcion === null">-</p>
                              <p v-else>{{historialiquidacion.funcion}}</p>
                            </small> 
                        </div> 
                      </div>
                  </div>       
              </div>
              <!--table-->
              <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
                <table class="table table-sm table-borderless table-fixed">
                  <caption class="justify-content-end">
                    
                    <small>
                      Total Neto $ {{(parseInt(liquidacion.bruto) + parseInt(liquidacion.familiar) - parseInt(liquidacion.descuento))}}
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
                    <tr v-for="detalle in detalles">
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
                    <td >

                      <small v-if="liquidacion.no_remunerativo">$ {{parseInt(liquidacion.bruto) - parseInt(liquidacion.no_remunerativo)}}</small>
                      <small v-else >$ {{parseInt(liquidacion.bruto)}}</small>
                    </td>
                    <td>
                      <small>$ {{liquidacion.no_remunerativo}}</small>
                    </td>
                    <td>
                      <small>$ {{parseInt(liquidacion.familiar) + parseInt(liquidacion.hijo) + parseInt(liquidacion.esposa)}}</small>
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
        props:['datos'],
        data: function(){
            return{
                historia_laborales:[],
                detalles:[],
                historia_laboral:{},
                historialiquidacion:{},
                liquidacionOrganismo:{},
                liquidacion:{},
                periodo:{},
                tipoliquidacion:{},
                organismo:{},
                jurisdiccion:{},
                clase:{},
                categoria:{},
                puesto:{},
                agente:{},
                estado:{},
                shown: true,
                isEmpty: true,

            }
        
        },
        mounted() {

            console.log(this.datos.length)
            if (this.datos.length > 0) {
              this.isEmpty = false;
            }
        }, 
        methods:{
            ver_detalle(index, liquidacionOrganismo){
              this.liquidacionOrganismo = liquidacionOrganismo;
              this.liquidacion = this.datos[index].liquidacion;
              this.historia_laboral = this.liquidacion.historia_laborales[0];
              this.detalles = this.liquidacion.detalles;
              this.historialiquidacion = this.historia_laboral.historialiquidaciones[0];
              this.clase = this.historia_laboral.clase;
              this.categoria = this.clase.categoria;
              this.periodo = this.datos[index].periodo;
              this.tipoliquidacion = this.datos[index].tipoliquidacion;
              this.organismo = this.datos[index].organismo;
              this.jurisdiccion = this.organismo.jurisdiccion;
              this.puesto = this.historia_laboral.puesto;
              this.agente = this.puesto.agente;
              this.estado = this.historialiquidacion.estado;

            },
            empty(){
                //this.liquidaciones = this.filtros.data.data
                this.liquidacionOrganismo = {};
                this.liquidacion = {};
                this.historia_laboral = {};
                this.historialiquidacion = {};
                this.clase = {};
                this.categoria = {};
                this.periodo = {};
                this.tipoliquidacion = {};
                this.organismo = {};
                this.jurisdiccion = {};
                this.puesto = {};
                this.agente = {};
                this.estado = {};
            }
        },
        filters:{
          formatCuil:function(value){
              value = value.toString();
              if (value.length == 10 ) {
                value = '0'+value;
              }

              var last = value.slice(-1);
              var dni = value.slice(2,-1);
              var first = value.charAt(0)+value.charAt(1);

              return first+'-'+dni+'-'+last;
          },
        }

    }
</script>

<style type="text/css">
    tr.hide-table-padding td {
      padding: 0;
    }

    .expand-button {
        position: relative;
    }

    .accordion-toggle .expand-button:after
    {
      position: absolute;
      left:.75rem;
      top: 50%;
      transform: translate(0, -50%);
      content: '-';
    }
    .accordion-toggle.collapsed .expand-button:after
    {
      content: '+';
    }
</style>
