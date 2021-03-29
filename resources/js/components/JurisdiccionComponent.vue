<template>
    <div>
        <!-- Modal nueva jurisdiccion -->
        <div class="modal fade" id="jurisdiccion_new" tabindex="-1" role="dialog" aria-labelledby="ModalLabelNewJurisdiccion" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form  action="" @submit.prevent="newJurisdiccion()">
                <div class="modal-header bg-gradient-olive">
                  <h5 class="modal-title" id="ModalLabelNewJurisdiccion">Nueva Jurisdiccion</h5>
                  <!-- {{errors}} -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="input_codigo_jurisdiccion" class="col-sm-3 col-form-label">Codigo *</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="input_codigo_jurisdiccion" v-model="cod_jurisdiccion">
                      <span class="errors text-danger" v-for="error in errors.cod_jurisdiccion">    
                        <small><em>{{error}}</em></small>
                      </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input_jurisdiccion" class="col-sm-3 col-form-label">Jurisdiccion *</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="input_jurisdiccion" v-model="descripcion">
                      <span class="errors text-danger" v-for="error in errors.jurisdiccion">
                          <small><em>{{error}}</em></small>
                      </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="select_origen" class="col-sm-3 col-form-label">Origen *</label>
                    <div class="col-sm-9">
                      <select :disabled="origenes.length === 0" class="custom-select" id="select_origen" v-model="selectedOrigen" >
                        <option selected disabled :value="''">Seleccione Origen...</option>
                        <option v-for="(origen,index) in origenes" :key="origen.id" :value="index">
                          {{origen.origen}}
                        </option>
                      </select>
                      <span class="errors text-danger" v-for="error in errors.origen_id">
                          <small><em>{{error}}</em></small>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <span><small><em>(*) obligatorio</em></small></span>
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;Nuevo</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal editar jurisdiccion -->
        <div class="modal fade" id="jurisdiccion_edit" tabindex="-1" role="dialog" aria-labelledby="ModalLabelEditJurisdiccion" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-gradient-olive">
                <h5 class="modal-title" id="ModalLabelEditJurisdiccion">Editar Jurisdiccion</h5>
                <button @click="empty()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label for="input_codigo_jurisdiccion_edit" class="col-sm-3 col-form-label">Codigo *</label>
                  <div class="col-sm-9">

                    <input v-if='editMode' type="text" class="form-control" id="input_codigo_jurisdiccion_edit" placeholder="Codigo" v-model="cod_jurisdiccion" disabled>
                    <p class="text-justify" v-else>{{cod_jurisdiccion}}</p>
                    <span class="errors text-danger" v-for="error in errors.cod_jurisdiccion">
                        <small><em>{{error}}</em></small>
                    </span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input_jurisdiccion_edit" class="col-sm-3 col-form-label">Jurisdiccion *</label>
                  <div class="col-sm-9">
                    <input v-if="editMode" type="text" class="form-control" id="input_jurisdiccion_edit" placeholder="Jurisdiccion" v-model="descripcion">
                    <p class="text-justify" v-else>{{descripcion}}</p>
                    <span class="errors text-danger" v-for="error in errors.jurisdiccion">
                        <small><em>{{error}}</em></small>
                    </span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input_cod_origen" class="col-sm-3 col-form-label">Origen *</label>
                  <div class="col-sm-9">
                    <select v-if="editMode" class="custom-select" id="select_origen_edit" v-model="selectedOrigen">
                      <option v-for="(origen,index) in origenes" :key="origen.id" :value="index" :selected=" index === selectedOrigen">
                        {{origen.origen}}
                      </option>
                    </select>
                    <p class="text-justify" v-else>{{origen.origen}}</p>
                    <span class="errors text-danger" v-for="error in errors.origen_id">
                        <small><em>{{error}}</em></small>
                    </span>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <span><small><em>(*) obligatorio</em></small></span>
                <button v-if="editMode" type="button" class="btn btn-danger btn-sm" data-dismiss="modal" @click="empty()" >Cancelar</button>
                <button v-if="editMode" class="btn btn-info btn-sm" @click="update()">
                  <i class="fa fa-save"></i>&nbsp;Guardar Cambbios
                </button>
                <button v-else  type="button" class="btn btn-secondary btn-sm" @click="editar()">
                  <i class="fa fa-edit"></i>&nbsp;Editar
                </button>
              </div>
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
                <button  @click="open_modal()" class="btn bg-gradient-olive btn-block rounded-pill" data-toggle="modal" data-target="#jurisdiccion_new"><i class="fa fa-plus"></i>&nbsp;Nueva Jurisdicción</button>
              </div>
              <div class="col-md-3  offset-md-6 my-2">
                <form class="form-inline justify-content-end">
                      <label for="buscador" class="mx-1 sr-only"><i class="fa fa-search"></i></label>
                      <input id="buscador" class="form-control mr-sm-2 w-100 w-lg-80" type="search" placeholder="Buscar..." aria-label="Search" v-model="search" @keyup="buscar()">
                </form>
              </div>
              <div class="col-12">
                <div class="card">
                  <div class="card-header bg-gradient-olive">
                    <h3 class="card-title">Lista de Jurisdicciones</h3>

                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <!-- <input type="search" name="table_search" class="form-control float-right" placeholder="Buscar"  @keyup="">

                        <div class="input-group-append">
                          <button type="button" class="btn btn-outline-success" disabled>
                            <i class="fas fa-search"></i>
                          </button>
                        </div> -->
                        <select class="form-control form-control-sm custom-select">
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
                          <th>ID <a href="#" class="text-dark" @click="sort('cod_jurisdiccion')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col">Jurisdicción <a href="#" class="text-dark" @click="sort('jurisdiccion')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col">Origen <a href="#" class="text-dark" @click="sort('origen_id')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col">Creado <a href="#" class="text-dark" @click="sort('created_at')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-if="jurisdicciones.length===0">
                            <td colspan="5" style="height: 100px;" class="align-middle"><p class="text-center">No se encontraron resultados</p></td>
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
                  </div>
                  <div class="card-footer">
                    <span>total registros encontrados: {{paginate.total}}</span>
                    <nav aria-label="Contacts Page Navigation">
                      <ul class="pagination pagiante-sm justify-content-end m-0">
                        <li class="page-item" :class="{ 'active': (paginate.current_page === n) }" v-for="n in paginate.last_page">
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
                    jurisdicciones:[],
                    jurisdiccion:{},
                    origenes:[],
                    origen:{},
                    descripcion:'',
                    cod_jurisdiccion:'',
                    selectedOrigen:'',
                    errors:[],
                    editMode:false,
                    search:'',
                    index:'',
                    order:false,
                    paginate:{
                      current_page:'',
                      last_page:'',
                      total:'',
                      path:'',
                      next_page_url:'',
                      from:'',
                      to:'',
                    },
                }
            },
        mounted() {
              this.getJurisdicciones();
        },
        methods:{
            getJurisdicciones(){
                            axios.get('api/jurisdiccion').then((response)=>{
                                //console.log(response.data)
                                this.jurisdicciones = response.data.data;
                                this.paginate.current_page = response.data.current_page;
                                this.paginate.last_page = response.data.last_page;
                                this.paginate.total = response.data.total;
                                this.paginate.path = response.data.path;
                                this.paginate.from = response.data.from;
                                this.paginate.to = response.data.to;
                            })
                        },
            getOrigenes(){
                axios.get('api/origen').then((response)=>{
                    //console.log(response.data)
                    this.origenes = response.data;
                })
            },
            newJurisdiccion(){
                let codigo_origen = '';
                if (this.selectedOrigen >= 0) {
                  this.origen = this.origenes[this.selectedOrigen];
                  codigo_origen = this.origenes[this.selectedOrigen].cod_origen;
                }
                const params = {
                    cod_jurisdiccion : this.cod_jurisdiccion,
                    jurisdiccion : this.descripcion,
                    origen_id : codigo_origen,
                    created_at: new Date(),
                    origen: this.origen,
                };
                axios.post('api/jurisdiccion/create',params)
                                 .then((response)=> {
                                   this.jurisdicciones.unshift(params);
                                   this.empty();
                                    Toast.fire({
                                      icon: 'success',
                                      title: 'Jurisdicción '+response.data.jurisdiccion+' se creó satisfactoriamente.',
                                      background:'#E7FFD7',
                                    })
                                   
                                 }).catch((err) => {
                                   console.log(err.response.data.errors)
                                   this.errors = err.response.data.errors;
                                 });
            },
            trash(index,id){
                swal.fire({
                  title: 'Esta seguro?',
                  text: this.jurisdicciones[index].jurisdiccion+" esta a punto de ser eliminada!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, eliminar!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    this.jurisdicciones.splice(index, 1);
                    axios.delete(`api/jurisdiccion/delete/${id}`)
                    .then((response)=>{
                        if (response.data.isValid) {
                            Toast.fire({
                              icon: 'success',
                              title: response.data.errors,
                              background:'#E7FFD7',
                            })

                        }else{
                            Toast.fire({
                              icon: 'error',
                              title: 'Atencion!!! Algo Salio Mal.',
                              background:'#FCDBCD',
                            })
                        }
                    })
                  }
                })
            },
            edit(index,jurisdiccion){
                // console.log(index);
                // console.log(this.paginate.from - 1)
                this.getOrigenes();
                this.jurisdiccion = jurisdiccion;
                this.descripcion = jurisdiccion.jurisdiccion;
                this.cod_jurisdiccion = jurisdiccion.cod_jurisdiccion;
                this.origen = jurisdiccion.origen;
                this.selectedOrigen = (this.origen.cod_origen-1);
                this.index = index;
            },
            open_modal(){
                this.getOrigenes();
            },
            editar(){
                this.editMode = true;
            },
            empty(){
              $('#jurisdiccion_new').modal('hide');
              $('#jurisdiccion_edit').modal('hide');
              this.errors = [];
              this.descripcion  = '';
              this.cod_jurisdiccion = '';
              this.cod_origen = '';
              this.selectedOrigen = '';
              this.editMode = false;
              this.origen = {};
            },
            buscar(){
              axios.get(`api/jurisdiccion/${this.search}`).then((response)=>{
                  this.jurisdicciones = response.data.data;
                  this.paginate.current_page = response.data.current_page;
                  this.paginate.last_page = response.data.last_page;
                  this.paginate.total = response.data.total;
                  this.paginate.path = response.data.path;
                  this.paginate.from = response.data.from;
                  this.paginate.to = response.data.to;
              })
            },
            update(){
              const params = {
                  cod_jurisdiccion : this.cod_jurisdiccion,
                  jurisdiccion : this.descripcion,
                  origen_id : this.origenes[this.selectedOrigen].cod_origen,
                  created_at: this.jurisdiccion.created_at,
                  origen: this.origenes[this.selectedOrigen],
              };

              axios.put(`api/jurisdiccion/update/${this.jurisdiccion.id}`,params)
              .then((response)=>{
                  this.jurisdicciones[this.index] = params;
                  this.empty();
              })
              .catch((err) => {
               console.log(err.response.data.errors)
               this.errors = err.response.data.errors;
              });
            },
            sort(column){
              this.order = !this.order;
              let sort;
              if (this.order) {
                sort = 'asc'
              }else{
                sort = 'desc'
              }
              axios.get(`api/jurisdiccion/order/${column}/sort/${sort}`).then((response)=>{
                        this.jurisdicciones = response.data.data
                        this.paginate.current_page = response.data.current_page;
                        this.paginate.last_page = response.data.last_page;
                        this.paginate.total = response.data.total;
                        this.paginate.path = response.data.path;
                        this.paginate.from = response.data.from;
                        this.paginate.to = response.data.to;
              })
            },

            getPage(page){
              axios.get(this.paginate.path+'?page='+page).then((response)=> {
                this.jurisdicciones = response.data.data;
                this.paginate.current_page = response.data.current_page;
                this.paginate.last_page = response.data.last_page;
                this.paginate.total = response.data.total;
                this.paginate.path = response.data.path;
                this.paginate.from = response.data.from;
                this.paginate.to = response.data.to;
              })
            },
        },
    }
</script>
