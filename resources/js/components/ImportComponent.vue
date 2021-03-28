<template>


	 <div id="import">

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-header bg-gradient-gray">
                <h3 class="card-title">Importar Excel \ CSV</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <form @submit.prevent="submitFile()">
                <div class="card-body">
                  <div class="import" style="min-height: 135px; height: 135px; max-height: 135px; max-width: 100%;">
                      <div class="form-group">
                        <div class="d-flex align-items-center">
                          <!-- <label for="file" class="form-label text-muted">Subir Archivo</label> -->
                          <input class="form-control border-0"  type="file" id="file" name="file" ref="file" @change="handleFileUpload()"  required>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="card-footer bg-white">
                  <div>
                    <button type="submit" name="import" id="import" class="btn bg-gradient-gray btn-block">
                      <i class="fas fa-file-upload"></i>&nbsp;Subir
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <!-- DONUT CHART -->
            <div class="card">
              <div class="card-header bg-gradient-gray">
                <h3 class="card-title">Ultimos Archivo importado</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table v-if="isReciente" class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Publicado por</th>
                      <th>Creado</th>
                      <th style="width: 40px">Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="reciente in dd_jj" :key="reciente.id">
                      <td>{{reciente.id}}.</td>
                      <td>{{reciente.user.name}}</td>
                      <td>{{reciente.created_at | moment}}</td>
                      <td>
                        <span v-if="reciente.status" class="badge bg-info">Activo</span>
                        <span  v-else class="badge bg-success rounded-circle"><i class="fas fa-check"></i></span>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <h1  v-else class="card-title">No hay datos recientes</h1>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col (LEFT) -->
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-gradient-gray">
                  <h3 class="card-title">Lista de Declaraciones juradas</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="search" name="table_search" class="form-control float-right" placeholder="Buscar" v-model="search" @keyup="buscar()">

                      <!-- <div class="input-group-append">
                        <button type="button" class="btn btn-outline-success" disabled>
                          <i class="fas fa-search"></i>
                        </button>
                      </div> -->
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre de Archivo</th>
                        <th>Periodo</th>
                        <th>Organismo</th>
                        <th>Tipo</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="declaracion_jurada in declaraciones_juradas" :key="declaracion_jurada.id">
                        <td>{{declaracion_jurada.id}}</td>
                        <td>
                          <span class="text-success"><i class="fas fa-file-csv"></i></span>
                          {{declaracion_jurada.nombre_archivo}}
                        </td>
                        <td>{{declaracion_jurada.periodo.periodo}}</td>
                        <td>{{declaracion_jurada.organismo.organismo}}</td>
                        <td>
                          <span v-if="declaracion_jurada.tipoliquidacion.descripcion === 'Sueldo'" class="badge bg-success">Haberes</span>
                          <span v-else class="badge bg-warning">{{declaracion_jurada.tipoliquidacion.descripcion}}</span>
                        </td>
                        <td>
                          
                          <button :id="declaracion_jurada.id" v-if="declaracion_jurada.status" class="btn btn-outline-warning rounded btn-xs" @click="aplicar(declaracion_jurada)" data-toggle="tooltip" data-placement="top" title="Aplicar Tarea">
                            <i class="fas fa-tasks"></i>
                          </button>
                          <span  v-else class="badge bg-success rounded-circle"><i class="fas fa-check"></i></span>

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
      showConfirmButton: false,
      timer: 4000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
      }
    })
    
    export default {
        props:['user'],
        data: function(){
            return{      
              file:'',
              declaraciones_juradas:[],
              dd_jj:[],
              declaracion_jurada:{},
              isLoad: false,
              isReciente: false,
              uploadPercentage:0,
              loadedProgress:0,
              totalProgress:0,
              search: '',
            }
        },
        mounted(){
          console.log(this.user)
          axios.get('api/archivos-recientes').then((response)=>{
             if (response.data.length === 0) {
                this.isReciente = false;
              } else {
                this.dd_jj = response.data;
                this.isReciente = true;
              }
          })

          axios.get('api/declaracion_jurada').then((response)=>{
             this.declaraciones_juradas = response.data;
          })

        },
        methods:{
          // onUploadProgress:function(progressEvent){
          //   this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100) );
          // }.bind(this), 
          submitFile () {
            
            let formData = new FormData()
            formData.append('file', this.file)
            formData.append('user_id', this.user.id)
            
            axios.post('api/declaracion_jurada/create', formData, 
            {
              headers: {
                  'Content-Type': 'multipart/form-data'
              },
              onUploadProgress: function( progressEvent ) {
                this.loadedProgress = progressEvent.loaded;
                this.totalProgress = progressEvent.total;
                this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ));
                this.isLoad = true;
                this.file = ''; 
              }.bind(this)
            })
              .then((response)=>{
                
                if (response.data.status) {
                        this.declaracion_jurada = response.data.data;
                        Toast.fire({
                          icon: 'success',
                          title: this.declaracion_jurada.nombre_archivo+' se subió con exito',
                          background:'#E7FFD7',
                        })
                        this.dd_jj.unshift(this.declaracion_jurada);
                        this.declaraciones_juradas.unshift(this.declaracion_jurada);
                        this.isReciente = true;

                } else {
                        Toast.fire({
                          icon: 'error',
                          title: response.data.data,
                          background:'#FCDBCD',
                        })
                }
                this.isLoad = false;
                  
                    
                  

              }).catch((error) => {
                  
                  this.isLoad = false;
                  Toast.fire({
                    icon: 'error',
                    title: error.response,
                    background:'#FCDBCD',
                  })
                  
              })

              
          },
          handleFileUpload(){
            this.file = '';
            this.file = this.$refs.file.files[0];
          },
          aplicar(declaracion_jurada){

                $('#'+declaracion_jurada.id)
                .prop('disabled', true)
                .removeClass('btn-outline-warning fas fa-tasks')
                .find('i').removeClass('fas fa-tasks')
                .addClass('btn-outline-info border-0')
                //.append("Cargando <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>")
                .append("<div class='overlay'><i class='fas fa-2x fa-sync-alt fa-spin'></i></div>");
              axios.post('api/import' , declaracion_jurada).then((response)=>{
                 this.declaracion_jurada = response.data;
                 Toast.fire({
                   icon: 'success',
                   title: 'importando: '+response.data.nombre_archivo
                 })

              })

          },
          buscar(){
            axios.get(`api/declaracion_jurada/buscar/${this.search}`).then((response)=>{
                this.declaraciones_juradas = response.data;
            })
          }
        },
      } 
              
</script>