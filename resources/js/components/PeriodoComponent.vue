<template>
    <div>
        <!-- Modal nueva jurisdiccion -->
        <div class="modal fade" id="periodo_new" tabindex="-1" role="dialog" aria-labelledby="ModalLabelNewPeriodo" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form  action="" @submit.prevent="nuevo_periodo">
                <div class="modal-header" style="background: radial-gradient(#f3fff1, #ccc);">
                  <h5 class="modal-title" id="ModalLabelNewPeriodo">Nuevo Periodo</h5>
                  <!-- {{errors}} -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="empty">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                                     
                   <div class="form-group">
                     <label for="selectPeriodo">Elija un Nuevo Periodo</label>
                     <month-picker-input
                         id="selectPeriodo"
                         :lang="'es'"
                         :no-default="true"
                         :max-date="fecha_actual"
                         @change="nuevo_periodo">
                           
                     </month-picker-input>
                     <span class="errors text-danger" v-for="error in errores.cod_periodo">
                         <small><em>{{error}}</em></small>
                     </span>
                   </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary btn-sm" @click="nuevo"><i class="fa fa-plus"></i>&nbsp;Nuevo</button>
                </div>
              </form>
            </div>
          </div>
        </div>

       

        <!-- Modal editar Periodo -->
        <div class="modal fade" id="periodo_edit" tabindex="-1" role="dialog" aria-labelledby="ModalLabelEditPeriodo" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form  action="" @submit.prevent="nuevo_periodo">
                <div class="modal-header" style="background: radial-gradient(#f3fff1, #ccc);">
                  <h5 class="modal-title" id="ModalLabelEditPeriodo">Nuevo Periodo</h5>
                  <!-- {{errors}} -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="empty">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                  
                  <!-- <div class="form-group row">
                    <label for="select_mes" class="col-sm-3 col-form-label">Mes *</label>
                    <div class="col-sm-9">
                      <select class="custom-select" id="select_mes" v-model="mes" @change="selectMes">
                        <option selected disabled :value="''">Seleccione Mes...</option>
                        <option :value="1">Enero</option>
                        <option :value="2">Febrero</option>
                        <option :value="3">Marzo</option>
                        <option :value="4">Abril</option>
                        <option :value="5">Mayo</option>
                        <option :value="6">Junio</option>
                        <option :value="7">Julio</option>
                        <option :value="8">Agosto</option>
                        <option :value="9">Septiembre</option>
                        <option :value="10">Octubre</option>
                        <option :value="11">Noviembre</option>
                        <option :value="12">Diciembre</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="select_mes" class="col-sm-3 col-form-label">Año *</label>
                    <div class="col-sm-9">
                      <select :disabled="mes == ''" class="custom-select" id="select_mes" v-model="anio" @change="selectAnio">
                        <option selected disabled :value="''">Seleccione Año...</option>
                        <option :value="2020">2020</option>
                        <option :value="2021">2021</option>
                        <option :value="2022">2022</option>
                        <option :value="2023">2023</option>
                      </select>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label for="descripcion">Periodo</label>
                    <p id="descripcion">{{periodo.periodo}}</p>
                    <span class="errors text-danger" v-for="error in errores.periodo" :key="error.id">
                        <small><em>{{error}}</em></small>
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="cod_periodo">Codigo Periodo</label>
                    <p id="cod_periodo">{{periodo.cod_periodo}}</p>
                    <span class="errors text-danger" v-for="error in errores.cod_periodo" :key="error.id">
                        <small><em>{{error}}</em></small>
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="mes">Mes</label>
                    <p id="mes">{{periodo.mes}}</p>
                    <span class="errors text-danger" v-for="error in errores.mes" :key="error.id">
                        <small><em>{{error}}</em></small>
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="anio">Año</label>
                    <p id="anio">{{periodo.anio}}</p>
                    <span class="errors text-danger" v-for="error in errores.anio" :key="error.id">
                        <small><em>{{error}}</em></small>
                    </span>
                  </div>
                  <div class="form-group" v-if="isEdit">
                    <label for="selectPeriodo">Elija un Periodo</label>
                    <month-picker-input
                        id="selectPeriodo"
                        v-if="isEdit"
                        :lang="'es'"
                        :no-default="true"
                        :max-date="fecha_actual"
                        @change="actualizar">
                          
                    </month-picker-input>
                  </div>
                    
                </div>
                <div class="modal-footer" v-if="isEdit">
                  <button type="button" class="btn btn-primary btn-sm" @click="confimarCambios"><i class="fa fa-edit"></i>&nbsp;Guardar Cambios</button>
                </div>
                <div class="modal-footer" v-else>
                  <button type="button" class="btn btn-danger btn-sm" @click="empty"><i class="fa fa-times"></i>&nbsp;Cancelar</button>
                  <button type="button" class="btn btn-secondary btn-sm" @click="editMode"><i class="fa fa-edit"></i>&nbsp;Editar</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!--Table-->
        <!-- <div class="row">
          <div class="col-md-12 col-lg-4 my-2">
            <button  @click="open_modal()" class="btn btn-outline-success btn-block rounded-pill" data-toggle="modal" data-target="#jurisdiccion_new"><i class="fa fa-plus"></i>&nbsp;Nueva Jurisdicción</button>
          </div>
          <div class="col-md-12 col-lg-4 offset-lg-4 my-2 ">
            <form class="form-inline justify-content-end">
                  <label for="buscador" class="mx-1 sr-only"><i class="fa fa-search"></i></label>
                  <input id="buscador" class="form-control mr-sm-2 w-100 w-lg-80" type="search" placeholder="Buscar..." aria-label="Search" v-model="search" @keyup="buscar()">
            </form>
          </div>
        </div>
        <div class="table-responsive-md">
          <table class="table">
            <thead>
                <tr>
                  <th scope="col"># Cod <a href="#" class="text-dark" @click="sort('cod_jurisdiccion')"><small><i class="fas fa-sort"></i></small></a></th>
                  <th scope="col">Jurisdicción <a href="#" class="text-dark" @click="sort('jurisdiccion')"><small><i class="fas fa-sort"></i></small></a></th>
                  <th scope="col">Origen <a href="#" class="text-dark" @click="sort('origen_id')"><small><i class="fas fa-sort"></i></small></a></th>
                  <th scope="col">Creado <a href="#" class="text-dark" @click="sort('created_at')"><small><i class="fas fa-sort"></i></small></a></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="jurisdicciones.length===0">
                    <td class="text-center">No data</td>
                </tr>
                <tr v-else v-for="(jurisdiccion,index) in jurisdicciones" :key='jurisdiccion.id'>
                  <th scope="row">{{jurisdiccion.cod_jurisdiccion}}</th>
                  <td>{{jurisdiccion.jurisdiccion}}</td>
                  <td>{{jurisdiccion.origen.origen}}</td>
                  <td><em> {{jurisdiccion.created_at | moment}}</em></td>
                  <td>
                    <button @click="trash(index,jurisdiccion.id)" class="btn btn-outline-danger rounded-circle btn-sm mb-1 my-lg-0 border-0"><i class="fa fa-trash"></i></button>
                    <button @click="edit(index,jurisdiccion)" class="btn btn-outline-warning rounded-circle btn-sm mb-1 my-lg-0 border-0" data-toggle="modal" data-target="#jurisdiccion_edit"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
              </tbody>
          </table>
        </div> -->
        <!--end table-->


        <!-- /.col (LEFT) -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col col-md-3 my-2">
                <button class="btn btn-block rounded-pill" data-toggle="modal" data-target="#periodo_new" style="background: radial-gradient(#f3fff1, #ccc);"><i class="fa fa-plus"></i>&nbsp;Nuevo Periodo</button>
              </div>
              <div class="col-md-3  offset-md-6 my-2">
                <form class="form-inline justify-content-end">
                      <label for="buscador" class="mx-1 sr-only"><i class="fa fa-search"></i></label>
                      <input id="buscador" class="form-control mr-sm-2 w-100 w-lg-80" type="search" placeholder="Buscar..." aria-label="Search" v-model="buscador" @keyup="buscarPeriodo()">
                </form>
              </div>
              <div class="col-12">
                <div class="card">
                  <div class="card-header" style="background: radial-gradient(#f3fff1, #ccc);">
                    <h3 class="card-title">Lista de Peridos</h3>

                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <!-- <input type="search" name="table_search" class="form-control float-right" placeholder="Buscar"  @keyup="">

                        <div class="input-group-append">
                          <button type="button" class="btn btn-outline-success" disabled>
                            <i class="fas fa-search"></i>
                          </button>
                        </div> -->
                        <select class="form-control form-control-sm custom-select rounded-pill" v-model="n_paginas" @change="paginacion">
                          <option value="5">5 por página</option>
                          <option value="10">10 por página</option>
                          <option value="25">25 por página</option>
                          <option value="50">50 por página</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Cod Periodo <a href="#" class="text-dark" @click="sort('cod_periodo')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col">Periodo <a href="#" class="text-dark" @click="sort('periodo')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col">Mes <a href="#" class="text-dark" @click="sort('mes')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col">Año <a href="#" class="text-dark" @click="sort('anio')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-if="periodos.length===0">
                            <td colspan="5" style="height: 100px;" class="align-middle"><p class="text-center">No se encontraron resultados</p></td>
                        </tr>
                        <tr v-else v-for="(periodo,index) in periodos" :key='periodo.id'>
                          <th scope="row">{{periodo.cod_periodo}}</th>
                          <td>{{periodo.periodo}}</td>
                          <td>{{periodo.mes}}</td>
                          <td>{{periodo.anio}}</td>
                          <td>
                            <button class="btn btn-outline-danger rounded-circle btn-sm mb-1 my-lg-0 border-0" @click="eliminar(index, periodo)"><i class="fa fa-trash"></i></button>
                            <button class="btn btn-outline-warning rounded-circle btn-sm mb-1 my-lg-0 border-0" data-toggle="modal" data-target="#periodo_edit" @click="editar(index, periodo)"><i class="fa fa-edit"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer">
                    <span>total registros encontrados: {{paginate.total}}</span>
                    <nav aria-label="Contacts Page Navigation">
                      <ul class="pagination pagiante-sm justify-content-end m-0">
                        <li class="page-item" :class="{ 'active': (paginate.current_page === n) }" v-for="n in paginate.last_page" :key="n.id">
                            <a href="#" class="page-link" @click.prevent="getPage(n)">
                                <span >
                                    {{ n }}
                                </span>
                            </a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
          </div>
        </section>
    </div>
    
</template>

<script>
  const Toast = swal.mixin({
                  toast: true,
                  position: 'top-end',
                  timer: 6000,
                  showConfirmButton: false,
                  onOpen: (toast) => {
                    toast.addEventListener('mouseenter', swal.stopTimer)
                    toast.addEventListener('mouseleave', swal.resumeTimer)
                  }
                });
    export default {
        data: function() {
                return {
                    periodos:[],
                    errores:[],
                    periodo:{},
                    index:'',
                    id: '',
                    mes:'',
                    anio:'',
                    cod_periodo:'',
                    fecha_actual:null,
                    isEdit: false,
                    order: false,
                    date: {
                      from: null,
                      to: null,
                      month: null,
                      year: null,
                      monthIndex: null,
                    },
                    paginate:{
                      current_page:'',
                      last_page:'',
                      total:'',
                      path:'',
                      next_page_url:'',
                      from:'',
                      to:'',
                    },
                    n_paginas: 10,
                    buscador:'',
                    setTimeoutBuscador:'',
                }
            },
        mounted() {
              var milisegundos = Date.now();
              this.fecha_actual = new Date(milisegundos);
              // this.mes = this.fecha_actual.getMonth()+1;
              // this.anio = this.fecha_actual.getFullYear();
              this.getPeriodos();
              console.log('componente periodo')
        },
        methods:{
            getPeriodos(){
                            axios.get('api/periodo').then((response)=>{
                                console.log(response.data)
                                this.periodos = response.data.data;
                                this.paginate.current_page = response.data.current_page;
                                this.paginate.last_page = response.data.last_page;
                                this.paginate.total = response.data.total;
                                this.paginate.path = response.data.path;
                                this.paginate.from = response.data.from;
                                this.paginate.to = response.data.to;
                            })
            
            },
            nuevo(){

              axios.post('api/periodo/create', this.periodo).then( (response) => {
                  
                  this.periodos.unshift(this.periodo);
                  this.empty();
                  Toast.fire({
                    icon: 'success',
                    title: 'Periodo '+response.data.periodo+' ha sido registrado',
                    background:'#E7FFD7',
                  })
              }).catch((err) => {
                 console.log(err.response.data.errors)
                 this.errores = err.response.data.errors;
              });

            },
            nuevo_periodo(date){
                
                this.date = date
                if (this.date.monthIndex.toString().length < 2){
                  var mes ='0'.concat(this.date.monthIndex.toString());
                  this.cod_periodo = this.date.year.toString()+mes;
                  
                }else{
                  this.cod_periodo = date.year.toString()+date.monthIndex.toString();
                }
                this.periodo = {
                  cod_periodo: this.cod_periodo,
                  mes: this.date.monthIndex.toString(),
                  anio: this.date.year.toString(),
                  periodo: this.nombreMes(this.date.monthIndex)+' de '+this.date.year,
                }
            
            },
            codPerido(){
              if (this.mes < 10) {
                this.cod_periodo = this.anio+'0'+this.mes
              }else{
                this.cod_periodo = this.anio+""+this.mes;
              }
            
            },
            empty(){
              $('#periodo_new').modal('hide');
              $('#periodo_edit').modal('hide');
              this.errores = [];
              this.periodo = {};
              this.id = '';
              this.cod_periodo = '';
              this.mes = '';
              this.anio = '';
              this.index = '';
              this.isEdit = false;
              this.buscador = '';
              this.setTimeoutBuscador = "";
              this.order = false;

            },
            nombreMes(mes){
              switch (mes) {
                case 1:
                  return 'Enero'
                  break;
                case 2:
                  return 'Febrero'
                  break;
                case 3:
                  return 'Marzo'
                  break;
                case 4:
                  return 'Abril'
                  break;
                case 5:
                  return 'Mayo'
                  break;
                case 6:
                  return 'Junio'
                  break;
                case 7:
                  return 'Julio'
                  break;
                case 8:
                  return 'Agosto'
                  break;
                case 9:
                  return 'Septiembre'
                  break;
                case 10:
                  return 'Octubre'
                  break;
                case 11:
                  return 'Noviembre'
                  break;
                case 12:
                  return 'Diciembre'
                  break;
                default:
                    return 'no corresponde a un mes'
                    break;
              }

            },
            eliminar(index, periodo){
              swal.fire({
                  title: 'Esta seguro?',
                  text: periodo.periodo+" esta a punto de ser eliminada!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, eliminar!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    axios.delete(`api/periodo/delete/${periodo.id}`).then( (response)=>{
                      var nombre = response.data;
                      this.periodos.splice(index, 1);
                      Toast.fire({
                        icon: 'success',
                        title: 'Periodo '+nombre+' ha sido borrado',
                        background:'#E7FFD7',
                      })
                    });
                    
                  }
                })
            
            },
            editar(index,periodo){
                 this.index = index;
                 this.id = periodo.id;
                 this.periodo = periodo;
                 this.mes = periodo.mes;
                 this.anio = periodo.anio;
                 this.cod_periodo = periodo.cod_periodo;
            
            },
            editMode(){
              
              this.isEdit = true;
            
            },
            actualizar(date){
              this.date = date
              if (this.date.monthIndex.toString().length < 2){
                var mes ='0'.concat(this.date.monthIndex.toString());
                this.cod_periodo = this.date.year.toString()+mes;
                
              }else{
                this.cod_periodo = date.year.toString()+date.monthIndex.toString();
              }

              this.periodo ={
                id: this.id,
                cod_periodo: this.cod_periodo,
                mes: this.date.monthIndex.toString(),
                anio: this.date.year.toString(),
                periodo: this.nombreMes(this.date.monthIndex)+' de '+this.date.year,
              }
            
            },
            confimarCambios(){
              axios.put(`api/periodo/update/${this.periodo.id}`, this.periodo).then( (response) => {
                console.log(response.data)
                this.periodo = response.data
                this.periodos[this.index] = this.periodo;
                this.empty();
                Toast.fire({
                  icon: 'success',
                  title: 'Periodo Actualizado',
                  background:'#E7FFD7',
                })
              }).catch((err) => {
                 console.log(err.response.data.errors)
                 this.errores = err.response.data.errors;
              });

            },
            getPage(page){
              axios.get(this.paginate.path+'?page='+page).then((response)=> {
                this.asignar(response);

              })
            
            },
            paginacion:function(){
              
              axios.get(`api/periodo/paginate/${this.n_paginas}`).then( (response) => {
                this.asignar(response);
              });
            
            },
            buscarPeriodo(){

              clearTimeout(this.setTimeoutBuscador);
              this.setTimeoutBuscador = setTimeout( ()=>{
                axios.get(`api/periodo/${this.buscador}`).then( (response)=>{
                  this.asignar(response);
                  
                })
              }, 1000);

            },
            asignar(response){
                this.periodos = response.data.data;
                this.paginate.current_page = response.data.current_page;
                this.paginate.last_page = response.data.last_page;
                this.paginate.total = response.data.total;
                this.paginate.path = response.data.path;
                this.paginate.from = response.data.from;
                this.paginate.to = response.data.to;
            },
            sort(columna){
              this.order = !this.order;
              let sort;
              if (this.order) {
                sort = 'asc'
              }else{
                sort = 'desc'
              }
              console.log(columna)
              axios.get(`api/periodo/order/${columna}/sort/${sort}`).then((response)=>{
                  this.asignar(response);
              })

            },
              
         },
    }
</script>
