<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow mb-3">
                    <div class="card-header text-center">Liquidacion de marzo de 2019 - Jurisdiccion Municipio Saladas</div>

                    <div class="card-body">
                        <filter-component></filter-component>
                        <!--<div class="container-fluid my-3">
                            <table class="table table-borderless">
                              <thead class="thead-light">
                                <tr>
                                  <th scope="col"># Codigo</th>
                                  <th scope="col">Organismo</th>
                                  <th scope="col">Tipo liquidacion</th>
                                  <th scope="col">accion</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>organismo 1</td>
                                  <td>sueldo</td>
                                  <td><a href="#" class="btn btn-primary btn-block text-white">ver</a></td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>organismo 2</td>
                                  <td>sueldo</td>
                                  <td><a href="#" class="btn btn-primary btn-block text-white">ver</a></td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>organismo 3</td>
                                  <td>sac</td>
                                  <td><a href="#" class="btn btn-primary btn-block text-white">ver</a></td>
                                </tr>
                                <tr>
                                  <th scope="row">4</th>
                                  <td>organismo 4</td>
                                  <td>sac</td>
                                  <td><a href="#" class="btn btn-primary btn-block text-white">ver</a></td>
                                </tr>
                              </tbody>
                            </table>
                        </div>-->
                        <details-component></details-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('administrador mounted.')
        }
    }
</script>