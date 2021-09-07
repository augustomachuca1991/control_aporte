<template>
  <div v-if="datos.length" id="lista_liquidaciones">
    
    <select
            class="mb-5"
            name="perPage"
            id="perPage"
            v-model="perPage"
        >
            <option value="5">Por pagína 5</option>
            <option value="10">Por pagína 10</option>
            <option value="25">Por pagína 25</option>
            <option value="50">Por pagína 50</option>
            <option value="100">Por pagína 100</option>
        </select>

        <paginate ref="paginator" name="liquidacions" :list="datos" :per="perPage">
            <div
                class="card w-100 card-outline card-pink"
                v-for="(liquidacion,index) in paginated('liquidacions')"
                :key="liquidacion.id"
            >
                <div class="card-header">
                    <h5 class="card-title text-capitalize">
                        {{
                            liquidacion.liquidacion.historia_laborales[0].puesto
                                .agente.nombre
                        }}
                        -
                        {{
                            liquidacion.liquidacion.historia_laborales[0].puesto
                                .agente.cuil
                        }}
                    </h5>
                    <p class="d-flex justify-content-end text-muted text-capitalize">
                        Periodo - {{ liquidacion.periodo.periodo }}
                    </p>
                </div>
                <div class="card-body">
                    <p
                        class="card-text"
                        v-for="clases in liquidacion.liquidacion
                            .historia_laborales"
                        :key="clases.id"
                    >
                        <label for="clase">Clase</label>
                        {{ clases.clase.clase }}
                    </p>

                    <p
                        class="card-text"
                        v-for="categorias in liquidacion.liquidacion
                            .historia_laborales"
                        :key="categorias.id"
                    >
                        <label for="categorias">Categoria</label>
                        {{ categorias.clase.categoria.categoria }}
                    </p>
                    <p class="card-text">
                        <label for="puestos">Puestos Laborales</label>
                        <span
                            v-for="puesto_laboral in liquidacion.liquidacion
                                .historia_laborales"
                            :key="puesto_laboral.id"
                            >{{ puesto_laboral.puesto.cod_laboral }}
                        </span>
                    </p>
                    <p class="card-text">
                        <!-- <a href="#" class="btn btn-success"
                            ><i class="fas fa-dollar-sign"></i
                        ></a> -->
                        <a :href="'.detalle'" class="btn btn-success" data-toggle="modal" v-on:click="ver_detalle(index,liquidacion)">
                        <i class="fas fa-dollar-sign"></i>
                      </a>  
                    </p>
                    <div class="text-right">
                        <p class="mb-0">
                            Tipo - {{ liquidacion.tipoliquidacion.descripcion }}
                        </p>
                        <footer class="blockquote-footer">
                            <cite title="Source Title text-capitalize">
                                {{ liquidacion.organismo.organismo }}
                                -
                                {{
                                    liquidacion.organismo.jurisdiccion
                                        .jurisdiccion
                                }}
                                -
                                {{
                                    liquidacion.organismo.jurisdiccion.origen
                                        .origen
                                }}</cite
                            >
                        </footer>
                    </div>
                </div>
            </div>
        </paginate>
        <paginate-links
            for="liquidacions"
            :hide-single-page="true"
            :async="true"
            :limit="3"
            @change="onLiquidacionsPageChange"
        ></paginate-links>
        <span class="d-flex justify-content-end text-muted text-sm" v-if="$refs.paginator">
          Mostrando {{$refs.paginator.pageItemsCount}} Resultados
        </span>
        
      

  <!--modal-->
      <div id="detalle_liquidacion" class="detalle modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <tr v-for="detalle in detalles" :key="detalle.id">
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
                liquidaciones: [],
                paginate: ["liquidacions"],
                perPage: "5",
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
              //this.liquidaciones = this.datos;
              //console.log('lista liquidaciones: '+this.datos);
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
            },
            onLiquidacionsPageChange (toPage, fromPage) {
              console.log('to page'+ toPage);
              console.log('from Page'+ fromPage);
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

<style>
.paginate-links {
    width: 100%;
    list-style: none;
    text-align: center;
}
.paginate-links li {
    display: inline;
    background-color: #e83e8c;
    color: white;
    padding: 0.5rem;
    margin-left: 0.3rem;
    margin-right: 0.3rem;
    cursor: pointer;
    border-radius: 3px;
}
.paginate-result {
    width: 100%;
    text-align: center;
    margin-bottom: 1rem;
}
.blockquote {
    border-left-color: #e83e8c;
}
</style>
