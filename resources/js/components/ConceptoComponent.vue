<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-indigo">
                        <h3 class="card-title">Lista de Conceptos</h3>

                        <div class="card-tools">
                          <div class="input-group input-group-sm" style="width: 150px;">
                            <select class="form-control form-control-sm custom-select rounded-pill" v-model="n_paginas" @change="paginacion">
                              <option value="5">5 por página</option>
                              <option value="10">10 por página</option>
                              <option value="25">25 por página</option>
                              <option value="50">50 por página</option>
                            </select>
                          </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <strong>#</strong>
                            </div>
                            <div class="col">
                                <strong>Organismo</strong>
                            </div>
                            <div class="col">
                                <strong>Concepto</strong>
                            </div>
                            <div class="col">
                                <strong>Subtipo Codigo</strong>
                            </div>
                            <div class="col">
                                <strong>Tipo Codigo</strong>
                            </div>

                            <div class="col-1">
                                
                            </div>
                        </div>
                        <hr>
                        <div class="row" v-for="(concepto, index) in conceptos" :key="concepto.id">
                            <div class="col-1">
                                <strong>{{concepto.id}}</strong>
                            </div>
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

                            <div class="col-1">
                                <a href="#" class="btn btn-outline-info border-0 " @click="editar(index,concepto)"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                        <hr>
                        <span>total registros encontrados: {{paginate.total}}</span>
                        <nav aria-label="Contacts Page Navigation">
                          <ul class="pagination paginate-xs justify-content-end m-0">
                            <li class="page-item" :class="{ 'active': (paginate.current_page === n) }" v-for="n in paginate.last_page">
                                <a href="#" class="page-link" @click.prevent="getPage(n)">
                                    <span>
                                        {{ n }}
                                    </span>
                                </a>
                            </li>
                          </ul>
                        </nav>

                    </div>
                    <div class="card-footer"  v-if="editMode">
                        <div class="row">

                            <div class="col">
                                <input type="text" name="organismo" v-model="organismo.organismo" disabled>
                            </div>
                            <div class="col">
                                <input type="text" name="organismo" v-model="concepto.concepto" disabled>
                            </div>
                            <div class="col">
                                <select>
                                    <option :value="subtipo.id">
                                        {{subtipo.id}}.{{subtipo.descripcion}}
                                    </option>
                                </select>
                            </div>
                            <div class="col">
                                <select>
                                    <option :value="tipocodigo.id">
                                         {{tipocodigo.id}}.{{tipocodigo.descripcion}}
                                    </option>
                                </select>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-outline-warning btn-sm rounded-circle border-0"><i class="fas fa-edit"></i></button>
                                <button @click="cancelar" class="btn btn-outline-danger btn-sm rounded-circle border-0"><i class="fas fa-times"></i></button>
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
                  concepto:{},
                  organismo:{},
                  subtipo:{},
                  tipocodigo:{},
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
                  editMode:false,

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
                this.paginate.current_page = response.data.current_page;
                this.paginate.last_page = response.data.last_page;
                this.paginate.total = response.data.total;
                this.paginate.path = response.data.path;
                //this.organismos = response.data.data;
                this.paginate.from = response.data.from;
                this.paginate.to = response.data.to;
            },
            editar(index,concepto){
                this.editMode = true;
                this.concepto = concepto;
                this.subtipo = this.concepto.subtipo
                this.organismo = this.concepto.organismo
                this.tipocodigo = this.subtipo.tipocodigo


                
            },
            cancelar(){
                this.editMode = false;
            },
            getPage(page){
              axios.get(this.paginate.path+'?page='+page).then((response)=> {
                
                this.asignar(response);

              })
            },
            paginacion:function(){
              console.log(this.n_paginas)
              // axios.get(`api/clase/paginate/${this.n_paginas}`).then( (response) => {

              //   this.clases = response.data.data;
              //   this.paginate.current_page = response.data.current_page;
              //   this.paginate.last_page = response.data.last_page;
              //   this.paginate.total = response.data.total;
              //   this.paginate.path = response.data.path;
              //   //this.organismos = response.data.data;
              //   this.paginate.from = response.data.from;
              //   this.paginate.to = response.data.to;
              // });
              

            },
        }
    }
</script>