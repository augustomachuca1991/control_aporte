<template>


	 <div id="import">

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card card-olive">
              <div class="card-header">
                <h3 class="card-title">Importar Excel \ CSV</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="import" style="min-height: 100px; height: 100px; max-height: 100px; max-width: 100%;">
                  <form @submit.prevent="submitFile()">
                    <div class="form-group row">
                      
                      <div class="col-sm-8 d-flex align-items-start">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="file" name="file" lang="es" ref="file" @change="handleFileUpload()"  required>
                          <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                          <span><i>{{file.name}}</i></span>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <button v-if="isLoad" type="button" name="import" id="import" class="btn btn-success" disabled>
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                          subiendo...
                        </button>
                        <button v-else type="submit" name="import" id="import" class="btn btn-success">
                          <i class="fas fa-file-upload"></i>&nbsp;Importar
                        </button>
                      </div>
                    </div>
                    <div v-if="isLoad" class="form-group row">
                      <div class="col">
                        <progress  id="progress-bar" max="100" :value.prop="uploadPercentage"></progress>
                        {{uploadPercentage}}%
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
          <div class="col-12 col-md-6">
            <!-- DONUT CHART -->
            <div class="card card-secondary">
              <div class="card-header">
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
                      <td><span class="badge bg-success">activo</span></td>
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
                <div class="card-header">
                  <h3 class="card-title">Lista de Declaraciones juradas</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Periodo</th>
                        <th>Organismo</th>
                        <th>Tipo</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="declaracion_jurada in declaraciones_juradas" :key="declaracion_jurada.id">
                        <td>{{declaracion_jurada.id}}</td>
                        <td>{{declaracion_jurada.user.name}}</td>
                        <td>{{declaracion_jurada.periodo.periodo}}</td>
                        <td>{{declaracion_jurada.organismo.organismo}}</td>
                        <td>
                          <span v-if="declaracion_jurada.tipoliquidacion.descripcion === 'Sueldo'" class="badge bg-success">{{declaracion_jurada.tipoliquidacion.descripcion}}</span>
                          <span v-else class="badge bg-warning">{{declaracion_jurada.tipoliquidacion.descripcion}}</span>
                        </td>
                        <td>
                          <button v-if="true" class="btn btn-outline-info rounded-circle btn-sm" @click="aplicar(declaracion_jurada)">
                            <i class="fas fa-tasks"></i>
                          </button>
                          <span v-else class="text-olive"><i class="fas fa-check"></i></span>
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
    

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 4000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
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
            }
        },
        mounted(){
          //console.log(this.user)
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
                             
                  setTimeout(() => {
                    this.isLoad = false;
                    Toast.fire({
                      icon: 'success',
                      title: response.data.nombre_archivo+" se cargo con exitó"
                    })
                    // let dj = {
                    //   id: '3',
                    //   user_id: '1',
                    //   periodo_id: '202006',
                    //   tipoliquidacion_id:  '1',
                    //   organismo_id:  '32',
                    //   path:  "csv/RthAyLnuHMLYuQaKXVGNeQpMbgKykbFr2gP8HjEI.txt",
                    //   nombre_archivo: "mercedes_202006_sueldo.csv",
                    //   secuencia: '1',
                    //   created_at: "2021-03-17T10:37:05.000000Z",
                    //   updated_at: "2021-03-17T10:37:05.000000Z",
                    //   organismo: {
                    //     id: '32',
                    //     cod_organismo: '32',
                    //     jurisdiccion_id: '22',
                    //     organismo: "Mercedes",
                    //     created_at: "2021-03-16T16:17:56.000000Z"
                    //   },
                    //   user: {
                    //     id: '1',
                    //     name: "Augusto Machuca",
                    //     email: "augusto_fer22@hotmail.com",
                    //     created_at: "2021-03-16T16:17:56.000000Z",
                    //     updated_at: "2021-03-16T16:17:56.000000Z" ,
                    //   },
                    //   periodo: {
                    //     id: '2',
                    //     cod_periodo: '202006',
                    //     mes: '6',
                    //     anio: '2020',
                    //     periodo: "Junio de 2020",
                    //     created_at: "2021-03-16T16:17:56.000000Z",
                    //   },
                    //   tipoliquidacion: {
                    //     id: '1',
                    //     descripcion: "Sueldo",
                    //     created_at : "2021-03-16T16:17:56.000000Z",
                    //   },
                    // }
                    this.declaracion_jurada = response.data
                    this.dd_jj.unshift(this.declaracion_jurada);
                    this.declaraciones_juradas.unshift(this.declaracion_jurada);
                    this.isReciente = true;

                    
                  }, 5000)
                  

              }).catch((error) => {

                  setTimeout(() => {
                    this.isLoad = false;
                    Toast.fire({
                      icon: 'error',
                      title: response.data.message
                    })
                  }, 5000)
                  
              })

              
          },
          handleFileUpload(){
            this.file = '';
            this.file = this.$refs.file.files[0];
          },
          aplicar(declaracion_jurada){


              axios.post('api/import' , declaracion_jurada).then((response)=>{
                 Toast.fire({
                   icon: 'success',
                   title: 'importando: '+response.data.nombre_archivo
                 })
              })

          }
        },
      } 
              
</script>