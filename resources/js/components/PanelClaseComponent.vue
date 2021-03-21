<template>
  <!-- <div>
    <filtroclase-component @categoria="get_codigo(...arguments)"></filtroclase-component>
    <clase-component :clases="clases"></clase-component>
  </div> -->
  <div id="panel_clase">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Filtros</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="clases">
                    



                    <!--aqui va el componente-->
                    <filter-component>
                    </filter-component>
                </div>
              </div>
            </div>
           </div>
         
          <!-- /.col (LEFT) -->
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Lista de Clases</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="search" name="table_search" class="form-control float-right" placeholder="Buscar"">
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <clase-component></clase-component>
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
     export default {
        data: function() {
            return{
                clases:''
            }
      },
      methods:{
        get_codigo(clases){
          this.clases = clases;
        }
      },
      mounted() {

      },

    }
</script>
