<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-indigo">Conceptos</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                Organismo
                            </div>
                            <div class="col">
                                Concepto
                            </div>
                            <div class="col">
                                Subtipo Codigo
                            </div>
                            <div class="col">
                                Tipo Codigo
                            </div>
                        </div>
                        <hr>
                        <div class="row" v-for="(concepto, index) in conceptos" :key="concepto.id">
                            <div class="col">
                                {{concepto.organismo.organismo}}
                            </div>
                            <div class="col">
                                {{concepto.concepto | capitalize}}
                            </div>
                            <div class="col">
                                {{concepto.subtipo.id}}. {{concepto.subtipo.descripcion}}
                            </div>
                            <div class="col">
                                {{concepto.subtipo.tipocodigo.id}}. {{concepto.subtipo.tipocodigo.descripcion}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
          data: function() {
              return{
                  conceptos:[],
                  paginate:{
                    current_page:'',
                    last_page:'',
                    total:'',
                    path:'',
                    next_page_url:'',
                    from:'',
                    to:'',
                    per_page:'',
                  },
                  n_paginas:10,

              }
        },
        mounted() {
            this.getConceptos();
            console.log('Component mounted.')
        },
        methods:{
            getConceptos(){
                axios.get('api/concepto').then( (response)=> {
                    this.asignar(response);
                })
            },
            asignar(response){
                this.conceptos = response.data.data;
            }
        }
    }
</script>