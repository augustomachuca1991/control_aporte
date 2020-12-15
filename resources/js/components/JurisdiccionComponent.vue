<template>
    <div>
        <!-- Modal nueva jurisdiccion -->
        <div class="modal fade" id="jurisdiccion_new" tabindex="-1" role="dialog" aria-labelledby="ModalLabelNewJurisdiccion" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelNewJurisdiccion">Nueva Jurisdiccion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i>Nuevo</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal editar jurisdiccion -->
        <div class="modal fade" id="jurisdiccion_edit" tabindex="-1" role="dialog" aria-labelledby="ModalLabelEditJurisdiccion" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditJurisdiccion">Editar Jurisdiccion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p v-model="descripcion">{{descripcion}}</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        <!--Table-->
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
                  <td>{{jurisdiccion.created_at | moment}}</td>
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
                    jurisdiccion:{},
                    descripcion:'',
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
                this.jurisdiccion = jurisdiccion;
                this.descripcion = jurisdiccion.jurisdiccion;
            }
        },
    }
</script>
