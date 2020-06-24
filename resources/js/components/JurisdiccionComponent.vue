<template>
    <div id="jurisdicciones">

        <div class="row">
            <div class="col">
                <a class="btn btn-success" v-on:click="encabezado = 'Crear Jurisdicción'" data-toggle="modal" data-target="#altaModal">Crear nueva jurisdicción</a>
            </div>
        </div>

        <br>

    <table class="table border-rounded table-striped" v-model="jurisdicciones">
        <thead class="thead-dark">
            <tr style="text-align: center;">
                <th scope="col">Id.</th>
                <th scope="col">cod.</th>
                <th scope="col">Descripción</th>
                <th scope="col">Origen</th>
                <th scope="col">Creación</th>
                <th scope="col">Modificación</th>
                <th scope="col" nowrap colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align: center;" v-for="jurisdiccion in jurisdicciones">
                <td>{{ jurisdiccion.id }}</td>
                <td>{{ jurisdiccion.cod_jurisdiccion }}</td>
                <td><a data-toggle="modal" data-target="#mostrarModal" v-on:click="jur = jurisdiccion" >{{ jurisdiccion.jurisdiccion }}</a></td>
                <td>{{ jurisdiccion.origen_id }}</td>
                <td>{{ jurisdiccion.created_at }}</td>
                <td>{{ jurisdiccion.updated_at }}</td>
                <td class="td-button">
                    <!-- Button trigger modal -->
                    <a :href="'jurisdicciones/'+jurisdiccion.id+'edit/'" class="btn btn-primary" data-toggle="modal" data-target="#altaModal">
                        <i class="fa fa-cog" v-on:click="encabezado = 'Editar Jurisdicción'"> Editar </i>
                    </a>

                    <!-- Button trigger modal
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Launch demo modal
                    </button>-->
                </td>
                <td class="td-button">
                    <form method="POST" action="">
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#eliminarModal">
                            <i class="fa fa-trash"> Eliminar</i>
                        </button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

        <!-- Modal mostrar -->
        <div class="modal fade" id="mostrarModal" tabindex="-1" role="dialog" aria-labelledby="mostrarModalLabel" aria-hidden="true" v-model="jurisdiccion">
            <div class="modal-dialog" role="document">
                <div class="modal-content border-primary justify-content-center"  style="max-width: 40rem;">
                    <div class="modal-header">
                        <h1 class="modal-title">Detalles</h1>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form-group" method="POST">
                            <div class="row">
                                <div class="col">
                                    <label for="altaDescripcion" class="required">Jurisdicción</label>
                                    <textarea type="text" name="descripcion" id="mostrarDescripcion"
                                              class="form-control" readonly>{{jur.jurisdiccion}}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <a href="" class="btn btn-danger" data-dismiss="modal">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal alta -->
        <div class="modal fade" id="altaModal" tabindex="-1" role="dialog" aria-labelledby="altaModalLabel" aria-hidden="true" v-model="encabezado">
            <div class="modal-dialog" role="document">
                <div class="modal-content border-primary justify-content-center"  style="max-width: 40rem;">
                    <div class="modal-header">
                        <h1 class="modal-title">{{encabezado}}</h1>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form-group" method="POST">
                            <div class="row">
                                <div class="col">
                                    <label for="altaDescripcion" class="required">Jurisdicción</label>
                                    <input type="text" name="descripcion" id="altaDescripcion" value=""
                                           class="form-control @error('descripcion') is-invalid @enderror">
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" onclick="return confirm('Está seguro que desea guardar?')" value="Guardar">
                                <a href="" class="btn btn-danger" data-dismiss="modal">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal eliminar -->
        <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true" v-model="encabezado">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarModalLabel">Eliminar Modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                jurisdicciones:[],
                jur:{
                    id: null,
                    cod_jurisdiccion: null,
                    jurisdiccion: '',
                    origen_id: null,
                    created_at: '',
                    updated_at: '',
                },
                form_editar: false,
                encabezado: ''
            }

        },
        mounted() {
            axios.get('api/jurisdiccion').then((response)=>{
                console.log(response.data)
                this.jurisdicciones = response.data;
            })
        },

        verJurisdiccion: function(event){
            console.log(event);
            this.jur.jurisdiccion = event,
            this.encabezado = 'Detalle Jurisdicción'
        }

    }

</script>
