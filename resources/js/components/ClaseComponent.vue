<template>
  <div id="panel_clase">
    <!--Modal nueva clase-->
    <div class="modal fade" id="clase_new" tabindex="-1" role="dialog" aria-labelledby="ModalLabelNewClase" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form  action="" @submit.prevent="nuevaClase()">
            <div class="modal-header bg-info">
              <h5 class="modal-title" id="ModalLabelNewClase">Nueva Clase</h5>
              <!-- {{errors}} -->
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="empty()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="input_codigo_clase" class="col-sm-3 col-form-label">Codigo *</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="input_codigo_clase" v-model="cod_clase" >
                  <span class="errors text-danger" v-for="error in errores.cod_clase">    
                    <small><em>{{error}}</em></small>
                  </span>
                </div>
              </div>
              <div class="form-group row">
                <label for="input_clase" class="col-sm-3 col-form-label">Clase *</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="input_clase" v-model="descripcion" >
                  <span class="errors text-danger" v-for="error in errores.clase">
                      <small><em>{{error}}</em></small>
                  </span>
                </div>
              </div>
              <div class="form-group row">
                <label for="select_categoria" class="col-sm-3 col-form-label">Categoria *</label>
                <div class="col-sm-9">
                  <select :disabled="categorias.length === 0" class="custom-select" id="select_categoria" v-model="selectedCategoria" required>
                    <option selected disabled :value="''">Seleccione Categoria...</option>
                    <option v-for="(categoria,index) in categorias" :key="categoria.id" :value="index">
                      {{categoria.categoria}}
                    </option>
                  </select>
                  <span class="errors text-danger" v-for="error in errores.categoria_id">
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
    <div class="modal fade" id="clase_edit" tabindex="-1" role="dialog" aria-labelledby="ModalLabelEditClase" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h5 class="modal-title" id="ModalLabelEditClase">Editar Jurisdiccion</h5>
            <button @click="empty()" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- {{clase}} -->
            <div class="form-group row">
              <label for="input_codigo_clase_edit" class="col-sm-3 col-form-label">Codigo *</label>
              <div class="col-sm-9">

                <input v-if='editMode' type="text" class="form-control" id="input_codigo_clase_edit" placeholder="Codigo" v-model="cod_clase" disabled>
                <p class="text-justify" v-else>{{cod_clase}}</p>
                <!-- <span class="errors text-danger" v-for="error in errores.cod_clase">
                    <small><em>{{error}}</em></small>
                </span> -->
              </div>
            </div>
            <div class="form-group row">
              <label for="input_clase_edit" class="col-sm-3 col-form-label">Clase *</label>
              <div class="col-sm-9">
                <input v-if="editMode" type="text" class="form-control" id="input_clase_edit" placeholder="Clase" v-model="descripcion">
                <p class="text-justify" v-else>{{descripcion}}</p>
                <span class="errors text-danger" v-for="error in errores.clase">
                    <small><em>{{error}}</em></small>
                </span>
              </div>
            </div>
            <div class="form-group row">
              <label for="input_cod_origen" class="col-sm-3 col-form-label">Categoria *</label>
              <div class="col-sm-9">
                <select v-if="editMode" class="custom-select" id="select_origen_edit" v-model="selectedCategoria" required>
                  <option v-for="(categoria,index) in categorias" :key="categoria.id" :value="index" :selected=" index === selectedCategoria">
                    {{categoria.categoria}}
                  </option>
                </select>
                <p class="text-justify" v-else>{{categoria.categoria}}</p>
                <span class="errors text-danger" v-for="error in errores.categoria_id">
                    <small><em>{{error}}</em></small>
                </span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <span><small><em>(*) obligatorio</em></small></span>
            <button v-if="editMode" type="button" class="btn btn-danger btn-sm" data-dismiss="modal" @click="empty()" >Cancelar</button>
            <button v-if="editMode" class="btn btn-info btn-sm" @click="actualizarClase()">
              <i class="fa fa-save"></i>&nbsp;Guardar Cambbios
            </button>
            <button v-else  type="button" class="btn btn-secondary btn-sm" @click="isEditar()">
              <i class="fa fa-edit"></i>&nbsp;Editar
            </button>
          </div>
        </div>
      </div>
    </div>



    <section class="content">
      <div class="container-fluid">
        <div class="row">
         <!-- nueva clase  y buscador--> 
         <div class="col col-md-3 my-2">
           <button @click="abrirModal()" class="btn btn-outline-success btn-block rounded-pill" data-toggle="modal" data-target="#clase_new"><i class="fa fa-plus"></i>&nbsp;Nueva clase</button>
         </div>
         <div class="col-md-3  offset-md-6 my-2">
           <form class="form-inline justify-content-end">
                 <label for="buscador" class="mx-1 sr-only"><i class="fa fa-search"></i></label>
                 <input id="buscador" class="form-control mr-sm-2 w-100 w-lg-80" type="search" placeholder="Buscar..." aria-label="Search" v-model="search" @keyup="buscar()">
           </form>
         </div>



          <!-- /.col (LEFT) -->
            <div class="col-12">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Lista de Clases</h3>

                  <!-- <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="search" name="table_search" class="form-control float-right" placeholder="Buscar"">
                    </div>
                  </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Cod<a href="#" class="text-dark" @click="sort('cod_clase')"><small><i class="fas fa-sort"></i></small></a></th>
                        <th>Clase<a href="#" class="text-dark" @click="sort('clase')"><small><i class="fas fa-sort"></i></small></a></th>
                        <th>Creado<a href="#" class="text-dark" @click="sort('created_at')"><small><i class="fas fa-sort"></i></small></a></th>
                        <th>Categoria<a href="#" class="text-dark" @click="sort('categoria')"><small><i class="fas fa-sort"></i></small></a></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="clases.length===0">
                          <td colspan="5" style="height: 100px;" class="align-middle"><p class="text-center">No se encontraron resultados</p></td>
                      </tr>
                      <tr v-else v-for="(clase, index) in clases" :key="clase.id">
                        <td>{{clase.cod_clase}}</td>
                        <td>{{clase.clase}}</td>
                        <td>{{clase.created_at | moment}}</td>
                        <td>{{clase.categoria.categoria}}</td>
                        <td>
                          <button class="btn btn-outline-warning rounded-circle btn-xs border-0" data-toggle="modal" data-target="#clase_edit" @click="editarClase(index, clase)"><i class="fas fa-edit"></i></button>
                          <button class="btn btn-outline-danger rounded-circle btn-xs border-0" @click="eliminarClase(index,clase.id)" ><i class="fas fa-trash"></i></button>
                          <!-- <button class="btn btn-outline-info rounded-circle btn-xs border-0"><i class="fas fa-eye"></i></button> -->
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
            return{
                clases:[],
                categorias:[],
                errores:[],
                clase:{},
                categoria:{},
                search:'',
                cod_clase:'',
                descripcion: '',
                selectedClase:'',
                selectedCategoria:'',
                editMode: false,
                order: false,

            }
      },
      mounted() {
        this.getClases();

      },
      methods:{
        getClases(){
          axios.get('api/clase/').then((response)=>{
              this.clases = response.data;
          })
          .catch(function (error) {
              console.log(error);
              this.errors = error;
          });
        },
        getCategorias(){
          axios.get('api/categoria').then((response)=>{
              this.categorias = response.data;
          })
          .catch(function (error) {
              console.log(error);
          });
        },
        nuevaClase(){

            // const nueva_clase = {
            //     //id: 555,
            //     cod_clase : this.cod_clase,
            //     categoria_id : this.categorias[this.selectedCategoria].id,
            //     clase : this.clase,
            //     created_at: new Date(),
            //     categoria: this.categorias[this.selectedCategoria],
            // };
            

            let formData = new FormData()
            formData.append('cod_clase', this.cod_clase)
            formData.append('categoria_id', this.categorias[this.selectedCategoria].id)
            formData.append('clase', this.descripcion)
            axios.post('api/clase/create', formData).then((response)=>{
              //console.log(response.data);
              $('#clase_new').modal('hide');
              Toast.fire({
                icon: 'success',
                title:'Se agrego la nueva clase '+response.data.clase,
                background:'#E7FFD7',
              })
              this.clase = response.data;
              this.clases.unshift(this.clase);
              this.empty();
            }).catch((err) => {
              //console.log(err.response.data.errors)
              this.errores = err.response.data.errors;
            });

            
        },
        editarClase(index, clase){
          //this.empty();
          //console.log(clase.categoria);
          this.getCategorias();
          this.clase = clase;
          // this.clase = this.clases[index];
          this.selectedClase = index;
          this.cod_clase = this.clase.cod_clase;
          this.descripcion = this.clase.clase
          this.selectedCategoria = this.clase.categoria_id - 1;
          this.categoria = this.clase.categoria
        },
        isEditar(){
          this.editMode = true;
        },
        actualizarClase(){
          // console.log('actualizado');
          const params = {
              //id: 555,
              cod_clase : this.cod_clase,
              categoria_id : this.categorias[this.selectedCategoria].id,
              clase : this.descripcion,
              created_at: new Date(),
              categoria: this.categorias[this.selectedCategoria],
          };
          

          axios.put(`api/clase/update/${this.clase.id}`,params)
          .then((response)=>{
              Toast.fire({
                icon: 'success',
                title:'La clase '+response.data.clase +' se edito con exitó',
                background:'#E7FFD7',
              })
              this.clases[this.selectedClase] = response.data;
              this.empty();
          })
          .catch((err) => {
           console.log(err.response.data.errors)
           this.errores = err.response.data.errors;
          });
        },
        eliminarClase(index,id){
          //console.log(index,clase)
          swal.fire({
            title: 'Esta seguro?',
            text: this.clases[index].clase+" esta a punto de ser eliminada!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
            if (result.isConfirmed) {
              axios.delete(`api/clase/delete/${id}`).then((response)=>{
                  this.clases.splice(index, 1);
                  Toast.fire({
                    icon: 'success',
                    title: response.data,
                    background:'#E7FFD7',
                  })
              })
            }
          })
        },
        abrirModal(){
          this.getCategorias();
          console.log(this.categorias);
        },
        buscar(){
          axios.get(`api/clase/${this.search}`).then((response)=>{
              //console.log(response.data)
              this.clases = response.data;
          })

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
          axios.get(`api/clase/order/${columna}/sort/${sort}`).then((response)=>{
              this.clases = response.data
          })
        },
        empty(){
          $('#clase_new').modal('hide');
          $('#clase_edit').modal('hide');
          this.categorias = [];
          this.errores = [];
          this.clase = {};
          this.categoria = {};
          this.search = '';
          this.cod_clase = '';
          this.descripcion =  '';
          this.categoria_id = '';
          this.selectedClase = '';
          this.selectedCategoria = '';
          this.editMode = false;
        },
      },
      

    }
</script>
