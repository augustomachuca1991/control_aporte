<template>
    <div>
        <!-- Modal nueva jurisdiccion -->
        <div class="modal fade" id="jurisdiccion_new" tabindex="-1" role="dialog" aria-labelledby="ModalLabelNewJurisdiccion" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form  action="" @submit.prevent="newJurisdiccion()">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabelNewJurisdiccion">Nueva Jurisdiccion</h5>
                  <!-- {{errors}} -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="input_codigo_jurisdiccion" class="col-sm-3 col-form-label">Codigo</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="input_codigo_jurisdiccion" placeholder="Codigo" v-model="cod_jurisdiccion">
                      <span class="errors text-danger" v-for="error in errors.cod_jurisdiccion">    
                        <small><em>{{error}}</em></small>
                      </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="input_jurisdiccion" class="col-sm-3 col-form-label">Jurisdiccion</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="input_jurisdiccion" placeholder="Jurisdiccion" v-model="descripcion">
                      <span class="errors text-danger" v-for="error in errors.jurisdiccion">
                          <small><em>{{error}}</em></small>
                      </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="select_origen" class="col-sm-3 col-form-label">Origen</label>
                    <div class="col-sm-9">
                      <select :disabled="origenes.length === 0" class="custom-select" id="select_origen" v-model="selectedOrigen" >
                        <option selected disabled>Seleccione Origen...</option>
                        <option v-for="(origen,index) in origenes" :key="origen.id" :value="origen.cod_origen">
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
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditJurisdiccion">Editar Jurisdiccion</h5>
                <button @click="empty()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label for="input_codigo_jurisdiccion_edit" class="col-sm-3 col-form-label">Codigo</label>
                  <div class="col-sm-9">

                    <input v-if='editMode' type="text" class="form-control" id="input_codigo_jurisdiccion_edit" placeholder="Codigo" :value="cod_jurisdiccion">
                    <p v-else>{{cod_jurisdiccion}}</p>
                    <span class="error" v-for="error in errors.cod_jurisdiccion">
                        {{error}}
                    </span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input_jurisdiccion_edit" class="col-sm-3 col-form-label">Jurisdiccion</label>
                  <div class="col-sm-9">
                    <input v-if="editMode" type="text" class="form-control" id="input_jurisdiccion_edit" placeholder="Jurisdiccion" :value="descripcion">
                    <p v-else>{{cod_jurisdiccion}}</p>
                    <span class="error" v-for="error in errors.jurisdiccion">
                        {{error}}
                    </span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input_cod_origen" class="col-sm-3 col-form-label">Origen</label>
                  <div class="col-sm-9">
                    <select v-if="editMode" class="custom-select" id="select_origen_edit"  v-model="selectedOrigen">
                      <option v-for="origen in origenes" :key="origen.id" :value="origen.cod_origen" :selected="origen.cod_origen == selectedOrigen">
                        {{origen.origen}}
                      </option>
                    </select>
                    <p v-else>Sisper</p>
                    <span class="errors text-danger text-sm" v-for="error in errors.origen_id">
                        {{error}}
                    </span>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button @click="empty()" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                <button @click="editar()" type="button" class="btn btn-ligth border-dark btn-sm"><i class="fa fa-edit"></i>&nbsp;Editar</button>
              </div>
            </div>
          </div>
        </div>
        <!--Table-->
        <h3 class="text-center">Lista de Jurisdiccion</h3>
        <div class="row">
          <div class="col-md-12 col-lg-4 my-2">
            <button  @click="open_modal()" class="btn btn-outline-success btn-block rounded-pill" data-toggle="modal" data-target="#jurisdiccion_new"><i class="fa fa-plus"></i>&nbsp;Nueva Jurisdicción</button>
          </div>
          <div class="col-md-12 col-lg-4 offset-lg-4 my-2 ">
            <form class="form-inline justify-content-end">
                  <input id="buscador" class="form-control mr-sm-2 w-100 w-lg-80" type="search" placeholder="Buscar..." aria-label="Search">
                  <label for="buscador" class="mx-1 sr-only"><i class="fa fa-search"></i></label>
            </form>
          </div>
        </div>
        <div class="table-responsive-md">
          <table class="table">
            <thead>
                <tr>
                  <th scope="col"># Cod</th>
                  <th scope="col">Jurisdicción</th>
                  <th scope="col">Origen</th>
                  <th scope="col">Creado</th>
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
        </div>
    </div>
    
</template>

<script>
    export default {
        data: function() {
                return {
                    jurisdicciones:[],
                    origenes:[],
                    jurisdiccion:{},
                    descripcion:'',
                    cod_jurisdiccion:'',
                    selectedOrigen:'',
                    errors:[],
                    editMode:false
                }
            },
        mounted() {
              this.getJurisdicciones();
        },
        methods:{
            getJurisdicciones(){
                            axios.get('api/jurisdiccion').then((response)=>{
                                console.log(response.data)
                                this.jurisdicciones = response.data;
                            })
                        },
            getOrigenes(){
                axios.get('api/origen').then((response)=>{
                    console.log(response.data)
                    this.origenes = response.data;
                })
            },
            newJurisdiccion(){
                const params = {
                    cod_jurisdiccion : this.cod_jurisdiccion,
                    jurisdiccion : this.descripcion,
                    origen_id : this.selectedOrigen,
                    created_at: new Date(),
                    origen:{
                        origen: this.origenes[this.selectedOrigen-1].origen
                    }
                };


                
                
                axios.post('api/jurisdiccion/create',params)
                                 .then((response)=> {
                                   console.log(response.data);
                                   this.jurisdicciones.push(params);
                                   this.empty();
                                   alert('agregado correctamente');
                                 }).catch((err) => {
                                   console.log(err.response.data.errors)
                                   this.errors = err.response.data.errors;
                                 });
            },
            trash(index,id){
                if (confirm('Seguro desea eliminar: '+this.jurisdicciones[index].jurisdiccion)){
                    this.jurisdicciones.splice(index, 1);
                    axios.delete(`api/jurisdiccion/delete/${id}`)
                        .then((response)=>{
                            if (response.data.isValid) {
                                alert(response.data.errors)
                            }else{
                                alert('no se puedo eliminar el elemento')
                            }
                        })
                }else{
                    console.log('no')
                }
            },
            edit(index,jurisdiccion){
                this.getOrigenes();
                this.descripcion = jurisdiccion.jurisdiccion;
                this.cod_jurisdiccion = jurisdiccion.cod_jurisdiccion;
                this.selectedOrigen = jurisdiccion.origen_id;
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
            }
        },
    }
</script>
