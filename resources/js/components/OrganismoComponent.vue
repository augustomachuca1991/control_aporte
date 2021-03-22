<template>
    <div>
        <!-- Modal nuevo organismo -->
        <div class="modal fade" id="organismo_new" tabindex="-1" role="dialog" aria-labelledby="ModalLabelNewOrganismo" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form  action="" @submit.prevent="newOrganismo()">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabelNewOrganismo">Nuevo Organismo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="input_cod_organismo" class="col-sm-3 col-form-label">Codigo *</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="input_cod_organismo" v-model="cod_organismo">
                      <span class="errors text-danger" v-for="error in errors.cod_organismo">    
                        <small><em>{{error}}</em></small>
                      </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input_organismo" class="col-sm-3 col-form-label">Organismo *</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="input_organismo" v-model="descripcion">
                      <span class="errors text-danger" v-for="error in errors.organismo">
                          <small><em>{{error}}</em></small>
                      </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="select_origen" class="col-sm-3 col-form-label">Origen *</label>
                    <div class="col-sm-9">
                      <select :disabled="origenes.length === 0" class="custom-select" id="select_origen" v-model="selectedOrigen" @change="selectOrigen()">
                        <option selected disabled :value="''">Seleccione Origen...</option>
                        <option v-for="(origen,index) in origenes" :key="origen.id" :value="index">
                          {{origen.origen}}
                        </option>
                      </select>
                      <span class="errors text-danger" v-for="error in errors.origen_id" >
                          <small><em>{{error}}</em></small>
                      </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="select_origen" class="col-sm-3 col-form-label">Jurisdiccion *</label>
                    <div class="col-sm-9">
                      <select :disabled="jurisdicciones.length === 0" class="custom-select" id="select_jurisdiccion" v-model="selectedJurisdiccion" @change="selectJurisdiccion()">
                        <option selected disabled :value="''">Seleccione Jurisdiccion...</option>
                        <option v-for="(jurisdiccion,index) in jurisdicciones" :key="jurisdiccion.id" :value="index">
                          {{jurisdiccion.jurisdiccion}}
                        </option>
                      </select>
                      <span class="errors text-danger" v-for="error in errors.jurisdiccion_id">
                          <small><em>{{error}}</em></small>
                      </span>
                      {{this.jurisdicciones.legth}}
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

        <!-- Modal editar Organismo -->
        <div class="modal fade" id="organismo_edit" tabindex="-1" role="dialog" aria-labelledby="ModalLabelEditOrganismo" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditOrganismo">Editar Organismo</h5>
                <button @click="empty()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label for="input_codigo_organismo_edit" class="col-sm-3 col-form-label">Codigo</label>
                  <div class="col-sm-9">

                    <input v-if='editMode' type="text" class="form-control" id="input_codigo_organismo_edit" placeholder="Codigo" v-model="cod_organismo" disabled>
                    <p class="text-justify" v-else>{{organismo.cod_organismo}}</p>
                    <!-- <span class="errors text-danger" v-for="error in errors.cod_jurisdiccion">
                        <small><em>{{error}}</em></small>
                    </span> -->
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input_organismo_edit" class="col-sm-3 col-form-label">Organismo</label>
                  <div class="col-sm-9">
                    <input v-if="editMode" type="text" class="form-control" id="input_organismo_edit" placeholder="Organismo" v-model="descripcion">
                    <p class="text-justify" v-else>{{organismo.organismo}}</p>
                    <!-- <span class="errors text-danger" v-for="error in errors.jurisdiccion">
                        <small><em>{{error}}</em></small>
                    </span> -->
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input_cod_origen" class="col-sm-3 col-form-label">Origen</label>
                  <div class="col-sm-9">
                    <select v-if="editMode" class="custom-select" id="select_origen_edit" v-model="selectedOrigen" @change="selectOrigen()">
                      <option v-for="(origen, index) in origenes" :key="origen.id" :value="index" :selected=" index === selectedOrigen">
                        {{origen.origen}}
                      </option>
                    </select>
                    <p class="text-justify" v-else>{{origen.origen}}</p>
                    <!-- <span class="errors text-danger" v-for="error in errors.origen_id">
                        <small><em>{{error}}</em></small>
                    </span> -->
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input_cod_jurisdiccion" class="col-sm-3 col-form-label">Jurisdiccion</label>
                  <div class="col-sm-9" @change="selectJurisdiccion()">
                    <select v-if="editMode"  :disabled="jurisdicciones.length === 0" class="custom-select" id="select_jurisdiccion_edit">
                      <option v-if="noclick" selected :value="''">
                        {{jurisdiccion.jurisdiccion}}
                      </option>

                      <option v-else v-for="(jurisdiccion, index) in jurisdicciones" :value="index" :key="jurisdiccion.id">
                        {{jurisdiccion.jurisdiccion}}
                      </option>
                    </select> 
                    <!-- <select v-if="editMode"  :disabled="jurisdicciones.length === 0" class="custom-select" id="select_jurisdiccion_edit" v-model="selectedJurisdiccion">
                      <option v-for="(jurisdiccion, index) in jurisdicciones" :value="index" :key="jurisdiccion.id">
                        {{jurisdiccion.jurisdiccion}}
                      </option>
                    </select> -->
                    <p class="text-justify" v-else>{{jurisdiccion.jurisdiccion}}</p>
                    <!-- <span class="errors text-danger" v-for="error in errors.origen_id">
                        <small><em>{{error}}</em></small>
                    </span> -->
                  </div>
                </div>
              </div>
              <div class="modal-footer">
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
            <button  @click="open_modal()" class="btn btn-outline-success btn-block rounded-pill" data-toggle="modal" data-target="#organismo_new"><i class="fa fa-plus"></i>&nbsp;Nuevo Organismo</button>
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
                  <th scope="col"># Cod<a href="#" class="text-dark" @click="sort('cod_organismo')"><small><i class="fas fa-sort"></i></small></a></th>
                  <th scope="col">Organismo<a href="#" class="text-dark" @click="sort('organismo')"><small><i class="fas fa-sort"></i></small></a></th>
                  <th scope="col">jurisdicción<a href="#" class="text-dark" @click="sort('jurisdiccion_id')"><small><i class="fas fa-sort"></i></small></a></th>
                  <th scope="col">Origen<a href="#" class="text-dark" @click="sort('jurisdiccion_id')"><small><i class="fas fa-sort"></i></small></a></th>
                  <th scope="col">Creado<a href="#" class="text-dark" @click="sort('created_at')"><small><i class="fas fa-sort"></i></small></a></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="organismos.length===0">
                    <td class="text-center">No data</td>
                </tr>
                <tr v-else v-for="(organismo,index) in organismos" :key='organismo.id'>
                  <th scope="row">{{organismo.cod_organismo}}</th>
                  <td>{{organismo.organismo}}</td>
                  <td>{{organismo.jurisdiccion.jurisdiccion}}</td>
                  <td>{{organismo.jurisdiccion.origen.origen}}</td>
                  <td><em> {{organismo.created_at | moment}}</em></td>
                  <td>
                    <button @click="trash(index,organismo.id)" class="btn btn-outline-danger rounded-circle btn-sm mb-1 my-lg-0 border-0"><i class="fa fa-trash"></i></button>
                    <button @click="edit(index,organismo)" class="btn btn-outline-warning rounded-circle btn-sm mb-1 my-lg-0 border-0" data-toggle="modal" data-target="#organismo_edit"><i class="fa fa-edit"></i></button>
                  </td>
                </tr>
              </tbody>
          </table>
        </div> -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col col-md-3 my-2">
                <button  @click="open_modal()" class="btn btn-outline-success btn-block rounded-pill" data-toggle="modal" data-target="#jurisdiccion_new"><i class="fa fa-plus"></i>&nbsp;Nuevo Organismo</button>
              </div>
              <div class="col-md-3  offset-md-6 my-2">
                <form class="form-inline justify-content-end">
                      <label for="buscador" class="mx-1 sr-only"><i class="fa fa-search"></i></label>
                      <input id="buscador" class="form-control mr-sm-2 w-100 w-lg-80" type="search" placeholder="Buscar..." aria-label="Search" v-model="search" @keyup="buscar()">
                </form>
              </div>
              <div class="col-12">
                <div class="card card-warning">
                  <div class="card-header">
                    <h3 class="card-title">Lista de Organismos</h3>

                    <!-- <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="search" name="table_search" class="form-control float-right" placeholder="Buscar"  @keyup="">

                        <div class="input-group-append">
                          <button type="button" class="btn btn-outline-success" disabled>
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div> -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th scope="col"># Cod<a href="#" class="text-dark" @click="sort('cod_organismo')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col">Organismo<a href="#" class="text-dark" @click="sort('organismo')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col">jurisdicción<a href="#" class="text-dark" @click="sort('jurisdiccion_id')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col">Origen<a href="#" class="text-dark" @click="sort('jurisdiccion_id')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col">Creado<a href="#" class="text-dark" @click="sort('created_at')"><small><i class="fas fa-sort"></i></small></a></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-if="organismos.length===0">
                            <td colspan="6" style="height: 100px;" class="align-middle"><p class="text-center">No se encontraron resultados</p></td>
                        </tr>
                        <tr v-else v-for="(organismo,index) in organismos" :key='organismo.id'>
                          <th scope="row">{{organismo.cod_organismo}}</th>
                          <td>{{organismo.organismo}}</td>
                          <td>{{organismo.jurisdiccion.jurisdiccion}}</td>
                          <td>{{organismo.jurisdiccion.origen.origen}}</td>
                          <td><em> {{organismo.created_at | moment}}</em></td>
                          <td>
                            <button @click="trash(index,organismo.id)" class="btn btn-outline-danger rounded-circle btn-sm mb-1 my-lg-0 border-0"><i class="fa fa-trash"></i></button>
                            <button @click="edit(index,organismo)" class="btn btn-outline-warning rounded-circle btn-sm mb-1 my-lg-0 border-0" data-toggle="modal" data-target="#organismo_edit"><i class="fa fa-edit"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
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
        data: function(){
            return{
                origenes:[],
                jurisdicciones:[],
                organismos:[],
                origen:{},
                jurisdiccion:{},
                organismo:{},
                selectedOrigen:'',
                selectedJurisdiccion:'',
                cod_organismo:'',
                descripcion:'',
                search:'',
                order:false,
                errors:[],
                cod_jurisdiccion:'',
                cod_origen:'',
                index_organismo: '',
                editMode:false,
                noclick:false
                

            }
        },
        mounted() {
            this.getOrganismos();
        },

        methods: {
            getOrigenes(){
                axios.get('api/origen/').then((response)=>{
                    this.origenes = response.data;
                })
            },
            getJurisdicciones(){
                axios.get('api/jurisdiccion/').then((response)=>{
                    this.jurisdicciones = response.data;
                })
            },
            selectOrigen(){
                this.noclick = false;
                this.jurisdicciones = [];
                this.selectedJurisdiccion = '';
                this.cod_origen = '';
                if (this.selectedOrigen >= 0) {
                    this.origen = this.origenes[this.selectedOrigen]
                    this.cod_origen = this.origen.cod_origen
                    this.jurisdicciones = this.origen.jurisdicciones
                }

            },
            selectJurisdiccion(){
                    if (this.selectedJurisdiccion >= 0) {
                      this.jurisdiccion = this.jurisdicciones[this.selectedJurisdiccion];
                      this.cod_jurisdiccion = this.jurisdiccion.cod_jurisdiccion;
                    }

            },
            getOrganismos(){
                axios.get('api/organismo').then((response)=>{
                    this.organismos = response.data;
                })
            },
            newOrganismo(){
                let params = {
                  cod_organismo : this.cod_organismo,
                  organismo : this.descripcion,
                  jurisdiccion_id : this.cod_jurisdiccion,
                  origen_id : this.cod_origen
                }
                const organismo = {
                        cod_organismo : this.cod_organismo,
                        jurisdiccion_id : this.jurisdiccion.cod_jurisdiccion,
                        organismo : this.descripcion,
                        created_at: new Date(),
                        jurisdiccion: {
                            id : this.jurisdiccion.id,
                            cod_jurisdiccion : this.jurisdiccion.cod_jurisdiccion,
                            origen_id: this.origen.cod_origen,
                            jurisdiccion: this.jurisdiccion.jurisdiccion,
                            origen : this.origen
                        }
                    };

                axios.post('api/organismo/create',params)
                              .then((response)=> {
                                  this.organismos.unshift(organismo);
                                  this.empty();
                                  Toast.fire({
                                    icon: 'success',
                                    title: 'Jurisdicción '+response.data.organismo+' se creó satisfactoriamente.',
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
                 text: this.organismos[index].organismo+" esta a punto de ser eliminada!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Si, eliminar!'
               }).then((result) => {
                 if (result.isConfirmed) {
                   this.organismos.splice(index, 1);
                   axios.delete(`api/organismo/delete/${id}`)
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
            edit(index,organismo){
                this.open_modal();
                this.index_organismo = index;
                this.organismo = organismo;
                this.cod_organismo = this.organismo.cod_organismo;
                this.descripcion = this.organismo.organismo;
                this.jurisdiccion = this.organismo.jurisdiccion;
                this.origen = this.jurisdiccion.origen;
                this.selectedOrigen = (this.origen.id - 1);
                this.selectedJurisdiccion = this.jurisdiccion.id;
                this.noclick = true;
            },
            update(){
              //const params = {
              //    cod_organismo : this.cod_organismo,
              //    organismo : this.descripcion,
              //    jurisdiccion_id : this.jurisdicciones[this.selectedJurisdiccion].cod_jurisdiccion,
              //    created_at: this.jurisdiccion.created_at,
              //    origen_id: this.origenes[this.selectedOrigen].cod_origen,
              //};

              const organismo = {
                      cod_organismo : this.cod_organismo,
                      jurisdiccion_id : this.jurisdiccion.cod_jurisdiccion,
                      organismo : this.descripcion,
                      created_at: this.organismo.created_at,
                      jurisdiccion: {
                          id : this.jurisdiccion.id,
                          cod_jurisdiccion : this.jurisdiccion.cod_jurisdiccion,
                          origen_id: this.origen.cod_origen,
                          jurisdiccion: this.jurisdiccion.jurisdiccion,
                          origen : this.origen
                      }
                  };
              this.organismos[this.index_organismo] = organismo;
              this.empty();

              //axios.put(`api/organismo/update/${this.organismo.id}`,params)
              //.then((response)=>{
              //    this.organismos[this.index_organismo] = organismo;
              //    this.empty();
              //})
              //.catch((err) => {
              // console.log(err.response.data.errors)
              // this.errors = err.response.data.errors;
              //});
            },
            buscar(){
                axios.get(`api/organismo/${this.search}`).then((response)=>{
                  this.organismos = response.data;
                })
            },
            sort(column){
                this.order = !this.order;
                let sort;
                
                if (this.order) {
                  sort = 'asc'
                }else{
                  sort = 'desc'
                }

                axios.get(`api/organismo/order/${column}/sort/${sort}`).then((response)=>{
                    this.organismos = response.data
                })
            },
            open_modal(){
                this.getOrigenes();
                //this.getJurisdicciones();
            },
            empty(){
              this.errors = [];
              this.descripcion  = '';
              this.cod_organismo = '';
              this.cod_origen = '';
              this.cod_jurisdiccion = '';
              this.selectedOrigen = '';
              this.selectedJurisdiccion = '';
              this.editMode = false;
              this.origen = {};
              this.jurisdiccion = {};
              this.organismo = {};
              this.index_organismo = '';
              this.origenes = [];
              this.jurisdicciones = [];
              $('#organismo_new').modal('hide');
              $('#organismo_edit').modal('hide');
              
            },
            editar(){
              this.editMode = true;
            }

            

            

        },
    }
</script>
