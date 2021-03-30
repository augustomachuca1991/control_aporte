<template>
  <div id="export">

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- /.col (LEFT) -->
              <div class="col-12">
                <div class="card">
                  <div class="card-header bg-gradient-gray">
                    <h3 class="card-title">Lista de Archivos</h3>

                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="search" name="table_search" class="form-control float-right" placeholder="Buscar">

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
                        <tr v-for="(declaracion_jurada, index) in declaraciones_juradas" :key="declaracion_jurada.id">
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
                            
                            <button :id="declaracion_jurada.id" class="btn bg-gradient-warning btn-xs rounded-circle" @click="descargar(declaracion_jurada)" data-toggle="tooltip" data-placement="top" title="descargar declaracion jurada">
                              <i class="fas fa-download"></i>
                            </button>

                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            <div class="col-12">
              <div class="card card-outline card-gray">
                <div class="card-header">
                  <h3 class="card-title">Filtros</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="import">
                      <filter-component 
                              @sendOrigen="porOrigen(...arguments)" 
                              @sendJur="porJurisdiccion(...arguments)" 
                              @sendOrganismo="porOrganismo(...arguments)">
                      </filter-component>
                  </div>
                </div>
              </div>
             </div>

            <div class="col-12 col-md-6">
              <div class="card card-outline card-gray">
                <div class="card-header">
                  <h3 class="card-title">Exportar Excel \ CSV</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <!-- DONUT CHART -->
              <div class="card card-outline card-gray">
                <div class="card-header">
                  <h3 class="card-title">titulos</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                </div>
                <!-- /.card-body -->
              </div>

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
        data: function(){
            return{
            	declaraciones_juradas:[],     
              
            }
        },
        mounted(){
           this.getDeclaracionesJuradas();
        },
        methods:{
          getDeclaracionesJuradas:function(){

              axios.get('api/declaracion_jurada').then((response)=>{
                 this.declaraciones_juradas = response.data;
              })
          },
        	exportar:function(){
        		
        	},
          descargar:function(declaracion_jurada){
            let formData = new FormData();
            formData.append('path', declaracion_jurada.path);

            axios.post('api/declaracion_jurada/download', formData, {responseType: 'arraybuffer'}).then((response)=>{
                var fileUrl = window.URL.createObjectURL(new Blob([response.data]))
                var fileLink = document.createElement('a')
                fileLink.href = fileUrl
                fileLink.setAttribute('download', declaracion_jurada.nombre_archivo)
                document.body.appendChild(fileLink)
                fileLink.click()
            })

          },
          porOrigen:function(origen_id){
            console.log(origen_id);
          },
          porJurisdiccion:function(jurisdiccion_id){
            console.log(jurisdiccion_id);
          },
          porOrganismo:function(organismo_id){
            console.log(organismo_id);
          },
        }
    }
</script>