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
            <tbody><!-- 
              <tr v-if="!filtro.condition">
                <td colspan="8" style="height: 200px;" class="align-middle"><p class="text-center">No se encontraron resultados</p></td>
              </tr> -->
              <tr v-for=" (liquidacion,index) in datos" :key="datos.id">
                  <th class="scope">
                    <div v-for="historia_laboral in liquidacion.liquidacion.historia_laborales">
                      {{historia_laboral.puesto.agente.nombre}}
                      {{historia_laboral.puesto.agente.cuil }} 
                    </div>
                  </th>
                  <td>
                     <span v-if="liquidacion.tipoliquidacion.descripcion === 'SAC' " class="badge bg-warning">
                      {{liquidacion.tipoliquidacion.descripcion}}
                     </span>
                     <span v-else class="badge bg-success">
                      {{liquidacion.tipoliquidacion.descripcion}}
                     </span>
                  </td> 
                  <td>
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
                      <!-- <a :href="'#detalle'" class="btn btn-outline-success rounded-circle btn-sm mb-1 my-lg-0 border-0" data-toggle="modal" v-on:click="show(liquidacion.id)">
                      <i class="fas fa-dollar-sign"></i>
                      </a>   -->
                      <a class="btn btn-success btn-xs text-white" data-toggle="modal" ><i class="fas fa-dollar-sign"></i></a>
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
   
    

    
  </div>
  
</template>

<script>
    export default {
        props:['datos'],
        data: function(){
            return{

                shown: true,
            }
        
        },
        mounted() {

            console.log(this.datos)
        }, 
        methods:{
            show(id){

                axios.get(`api/liquidacion/detalle/`+id).then((response)=>{
                   this.liquidacion = [];
                   this.liquidacion = response.data;
                }).catch(function (error) {
                  console.log(error);
                });
            },
            empty(){
                //this.liquidaciones = this.filtros.data.data
                this.liquidacion = [];
            },
            onLangsPageChange(toPage, fromPage){
              this.paginas.from = fromPage;
              this.paginas.to = toPage;
              console.log(this.filtro.data)
            },
            getPage: function(page){
              axios.get('/api/liquidacion?page='+page).then((response)=> {
                this.liquidaciones = response.data.data;
                this.current_page = response.data.current_page;
                this.last_page = response.data.last_page;
              })
            },
        },
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
