<template>
    <!-- <div id="categorias">
    <table class="table my-2" v-model="categorias" >
      <caption>Categorías</caption>
      <thead>
        <tr>
          <th scope="col">Cod. Categoría</th>
          <th scope="col">Categoría</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
       <tr v-if="categorias.length===0">
          <td colspan="6" align="center">No hay datos</td>
       </tr>
        <tr v-for="(categoria, index) in categorias"  v-bind:key="categoria.id" v-else>
          <th>{{categoria.cod_categoria}}</th>
          <td>{{categoria.categoria}}</td>
          <td>
               <form @submit.prevent="deleteCategoria(categoria.id)" class="form-inline">
                <button type="submit" class="btn btn-outline-danger rounded-circle btn-sm mb-1 my-lg-0 border-0">
                  <i class="far fa-trash-alt"></i>
                </button>
              </form>
              <button @click="editCategoria(categoria)" class="btn btn-outline-warning rounded-circle btn-sm mb-1 my-lg-0 border-0" data-toggle="modal" data-target="#edit_categoria">
                <i class="far fa-edit"></i>
              </button>
          </td>
        </tr>
        
      </tbody>
    </table>

    <div class="m-2" align="right">
      <a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#nueva_categoria"><i class="fas fa-plus"></i> Nueva</a>    
    </div>








    <div class="modal fade bd-example-modal-md edit" id="edit_categoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md edit">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="edit_categoria">Editar categoría</h5>
            <button type="button" v-on:click ="empty()" class="close" data-dismiss="modal" aria-label="Close">
              <span class="btn btn-danger" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" class="form-group" method="POST">
              <div class="form-group">
                <label class="col-form-label" for="origen_new">Origen</label>
                <select class="form-control form-control-md" name="origen_new" v-model="origen_id" required>
                <option v-for="(origen, index) in origenes" :key="origen.id" :value="origen.id">{{origen.origen}}</option>
                </select>
              </div>  
              <div class="form-group">
                <label class="col-form-label" for="jurisdiccion_new">Jurisdiccion</label>
                <select class="form-control form-control-md" name="jurisdiccion_new" v-model="jurisdiccion_id" required>
                <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.id" :value="jurisdiccion.id">{{jurisdiccion.jurisdiccion}}</option>
                </select>
              </div>   
              <div class="form-group">
                <label class="col-form-label">Código categoría</label>
                <input type="text" class="form-control" name="cod_categoria" v-model="cat_aux.cod_categoria" :disabled="0">
              </div>
              <div class="form-group">
                <label class="col-form-label">Nombre</label>
                <input type="text"class="form-control" name="categoria" v-model="cat_aux.categoria">
              </div>
              <div class="modal-footer">
                <button v-on:click="updateCategoria()" data-dismiss="modal" id="editar_categoria" class="btn btn-outline-danger border-0">Editar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>




    <div class="modal fade bd-example-modal-md" tabindex="-1" id="nueva_categoria" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="nueva_categoria">Nueva categoría</h5>
            <button type="button" class="close" data-dismiss="modal" v-on:click="empty()" aria-label="Close">
              <span class="btn btn-danger" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="createCategoria()" method="POST">
              <div class="form-group">
                <label class="col-form-label" for="origen_new">Origen</label>
                <select class="form-control form-control-md" name="origen_new" v-model="selectedOrigen" required>
                <option :value="''" disabled selected>Seleccione Origen</option>
                <option v-for="(origen, index) in origenes" :key="origen.id" :value="origen.id">{{origen.origen}}</option>
                </select>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="jurisdiccion_new">Jurisdicción</label>
                <select :disabled="selectedOrigen.length == 0" class="form-control form-control-md" name="jurisdiccion_new" v-model="selectedJurisdiccion" required>
                  <option :value="''" disabled selected> Seleccione Jurisdicción</option>
                  <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.id" :value="jurisdiccion.id">{{jurisdiccion.jurisdiccion}}</option>
                  <span  style="color:red" v-if="feedback.id_jurisdiccion" v-text="feedback.id_jurisdiccion[0]" ></span>
                </select>
              </div>
              <div class="form-group has-feedback">
                <label for="cod_categoria" class="col-form-label">Código Categoría</label>
                <input type="number" class="form-control" id="cod_categoria" name="cod_categoria" v-model="categoria.cod_categoria" required>
                <span  style="color:red" v-if="feedback.cod_categoria" v-text="feedback.cod_categoria[0]" ></span>
              </div>
              <div class="form-group">
                <label for="categoria" class="col-form-label">Nombre</label>
                <input type="text" class="form-control" id="categoria" name="categoria" v-model="categoria.categoria" required>
                <span style="color:red" v-if="feedback.categoria" v-text="feedback.categoria[0]" ></span>
              </div>
              <div class="modal-footer">
                <button id="crear_categoria" class="btn btn-primary">Crear</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> -->
    <div id="lista_categorias">
        <!--Modal nueva categoria-->
        <div
            class="modal fade"
            id="categoria_new"
            tabindex="-1"
            role="dialog"
            aria-labelledby="ModalLabelNewCategoria"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="" @submit.prevent="nuevaCategoria()">
                        <div class="modal-header bg-gradient-info">
                            <h5 class="modal-title" id="ModalLabelNewCategoria">
                                Nueva Categoria
                            </h5>
                            <!-- {{errors}} -->
                            <button
                                type="button"
                                class="close text-white"
                                data-dismiss="modal"
                                aria-label="Close"
                                @click="empty()"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    for="input_codigo_categoria"
                                    class="col-sm-3 col-form-label"
                                    >Codigo *</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="input_codigo_categoria"
                                        v-model="cod_categoria"
                                    />
                                    <span
                                        class="errors text-danger"
                                        v-for="error in errores.cod_categoria"
                                        :key="error.id"
                                    >
                                        <small
                                            ><em>{{ error }}</em></small
                                        >
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="input_categoria"
                                    class="col-sm-3 col-form-label"
                                    >Categoria *</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="input_categoria"
                                        v-model="descripcion"
                                    />
                                    <span
                                        class="errors text-danger"
                                        v-for="error in errores.categoria"
                                        :key="error.id"
                                    >
                                        <small
                                            ><em>{{ error }}</em></small
                                        >
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="select_categoria"
                                    class="col-sm-3 col-form-label"
                                    >Jurisdicción *</label
                                >
                                <div class="col-sm-9">
                                    <select
                                        :disabled="jurisdicciones.length === 0"
                                        class="custom-select"
                                        id="select_categoria"
                                        v-model="selectedJurisdiccion"
                                        required
                                    >
                                        <option selected disabled :value="''"
                                            >Seleccione Jurisdiccion...</option
                                        >
                                        <option
                                            v-for="(jurisdiccion,
                                            index) in jurisdicciones"
                                            :key="jurisdiccion.id"
                                            :value="index"
                                        >
                                            {{ jurisdiccion.jurisdiccion }}
                                        </option>
                                    </select>
                                    <span
                                        class="errors text-danger"
                                        v-for="error in errores.jurisdiccion_id"
                                        :key="error.id"
                                    >
                                        <small
                                            ><em>{{ error }}</em></small
                                        >
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span
                                ><small><em>(*) obligatorio</em></small></span
                            >
                            <button
                                type="submit"
                                class="btn btn-primary btn-sm"
                            >
                                <i class="fa fa-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal editar jurisdiccion -->
        <div
            class="modal fade"
            id="categoria_edit"
            tabindex="-1"
            role="dialog"
            aria-labelledby="ModalLabelEditCategoria"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-info">
                        <h5 class="modal-title" id="ModalLabelEditCategoria">
                            Editar Categoria
                        </h5>
                        <button
                            @click="empty()"
                            type="button"
                            class="close text-white"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- {{clase}} -->
                        <div class="form-group row">
                            <label
                                for="input_codigo_categoria_edit"
                                class="col-sm-3 col-form-label"
                                >Codigo *</label
                            >
                            <div class="col-sm-9">
                                <input
                                    v-if="editMode"
                                    type="text"
                                    class="form-control"
                                    id="input_codigo_categoria_edit"
                                    placeholder="Codigo"
                                    v-model="cod_categoria"
                                    disabled
                                />
                                <p class="text-justify" v-else>
                                    {{ cod_categoria }}
                                </p>
                                <span
                                    class="errors text-danger"
                                    v-for="error in errores.cod_categoria"
                                    :key="error.id"
                                >
                                    <small
                                        ><em>{{ error }}</em></small
                                    >
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                for="input_clase_edit"
                                class="col-sm-3 col-form-label"
                                >Categoria *</label
                            >
                            <div class="col-sm-9">
                                <input
                                    v-if="editMode"
                                    type="text"
                                    class="form-control"
                                    id="input_clase_edit"
                                    placeholder="Categoria"
                                    v-model="descripcion"
                                />
                                <p class="text-justify" v-else>
                                    {{ descripcion }}
                                </p>
                                <span
                                    class="errors text-danger"
                                    v-for="error in errores.categoria"
                                    :key="error.id"
                                >
                                    <small
                                        ><em>{{ error }}</em></small
                                    >
                                </span>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
              <label for="input_cod_origen" class="col-sm-3 col-form-label">Jurisdicciones *</label>
              <div class="col-sm-9">
                <select v-if="editMode" class="custom-select" id="select_origen_edit" v-model="selectedJurisdiccion" required>
                  <option v-for="(jurisdiccion,index) in jurisdicciones" :key="jurisdiccion.id" :value="index" :selected=" index === selectedJurisdiccion">
                    {{jurisdiccion.jurisdiccion}}
                  </option>
                </select>
                <p class="text-justify" v-else v-for="jurisdiccion in categoria_jurisdicciones" :key="jurisdiccion.id">{{jurisdiccion.jurisdiccion}}</p>
                <span class="errors text-danger" v-for="error in errores.categoria_id">
                    <small><em>{{error}}</em></small>
                </span>
              </div>
            </div> -->
                    </div>
                    <div class="modal-footer">
                        <span
                            ><small><em>(*) obligatorio</em></small></span
                        >
                        <button
                            v-if="editMode"
                            type="button"
                            class="btn btn-danger btn-sm"
                            data-dismiss="modal"
                            @click="empty()"
                        >
                            Cancelar
                        </button>
                        <button
                            v-if="editMode"
                            class="btn btn-info btn-sm"
                            @click="actualizarCategoria()"
                        >
                            <i class="fa fa-save"></i>&nbsp;Guardar Cambios
                        </button>
                        <button
                            v-else
                            type="button"
                            class="btn btn-secondary btn-sm"
                            @click="isEditar()"
                        >
                            <i class="fa fa-edit"></i>&nbsp;Editar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- nueva categoria  y buscador-->
                    <div class="col col-md-3 my-2">
                        <button
                            @click="abrirModal()"
                            class="btn bg-gradient-info btn-block rounded-pill"
                            data-toggle="modal"
                            data-target="#categoria_new"
                        >
                            <i class="fa fa-plus"></i>&nbsp;Nueva categoria
                        </button>
                    </div>
                    <div class="col-md-3  offset-md-6 my-2">
                        <form class="form-inline justify-content-end">
                            <label for="buscador" class="mx-1 sr-only"
                                ><i class="fa fa-search"></i
                            ></label>
                            <input
                                id="buscador"
                                class="form-control mr-sm-2 w-100 w-lg-80"
                                type="search"
                                placeholder="Buscar..."
                                aria-label="Search"
                                v-model="search"
                                @keyup="buscar()"
                            />
                        </form>
                    </div>

                    <!-- /.col (LEFT) -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-gradient-info">
                                <h3 class="card-title">Lista de Categorias</h3>

                                <div class="card-tools">
                                    <div
                                        class="input-group input-group-sm"
                                        style="width: 150px;"
                                    >
                                        <select
                                            class="form-control form-control-sm custom-select rounded-pill"
                                            v-model="n_paginas"
                                            @change="paginacion"
                                        >
                                            <option value="5"
                                                >5 por página</option
                                            >
                                            <option value="10"
                                                >10 por página</option
                                            >
                                            <option value="25"
                                                >25 por página</option
                                            >
                                            <option value="50"
                                                >50 por página</option
                                            >
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>
                                                Cod<a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="
                                                        sort('cod_categoria')
                                                    "
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th>
                                                Categoria<a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="sort('categoria')"
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th>
                                                Creado<a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="sort('created_at')"
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th>
                                                Jurisdicción<!-- <a href="#" class="text-dark" @click="sort('categoria')"><small><i class="fas fa-sort"></i></small></a> -->
                                            </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="categorias.length === 0">
                                            <td
                                                colspan="5"
                                                style="height: 100px;"
                                                class="align-middle"
                                            >
                                                <p class="text-center">
                                                    No se encontraron resultados
                                                </p>
                                            </td>
                                        </tr>
                                        <tr
                                            v-else
                                            v-for="(categoria,
                                            index) in categorias"
                                            :key="categoria.id"
                                        >
                                            <td>
                                                {{ categoria.cod_categoria }}
                                            </td>
                                            <td>{{ categoria.categoria }}</td>
                                            <td>
                                                {{
                                                    categoria.created_at
                                                        | moment
                                                }}
                                            </td>
                                            <td>
                                                <span
                                                    v-for="jurisdiccion in categoria.jurisdicciones"
                                                    :key="jurisdiccion.id"
                                                >
                                                    {{
                                                        jurisdiccion.jurisdiccion
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-outline-warning rounded-circle btn-xs border-0"
                                                    data-toggle="modal"
                                                    data-target="#categoria_edit"
                                                    @click="
                                                        editarCategoria(
                                                            index,
                                                            categoria
                                                        )
                                                    "
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-danger rounded-circle btn-xs border-0"
                                                    @click="
                                                        eliminarCategoria(
                                                            index,
                                                            categoria.id
                                                        )
                                                    "
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <span
                                    >total registros encontrados:
                                    {{ paginate.total }}</span
                                >
                                <nav aria-label="Contacts Page Navigation">
                                    <ul
                                        class="pagination paginate-xs justify-content-end m-0"
                                    >
                                        <!-- previous -->
                                        <li
                                            class="page-item"
                                            v-show="paginate.prev_page_url"
                                        >
                                            <a
                                                href="#"
                                                class="page-link"
                                                @click.prevent="getPreviousPage"
                                            >
                                                <span>
                                                    <span aria-hidden="true"
                                                        >«</span
                                                    >
                                                </span>
                                            </a>
                                        </li>

                                        <li
                                            class="page-item"
                                            :class="{
                                                active:
                                                    paginate.current_page === n
                                            }"
                                            v-for="n in paginate.last_page"
                                            :key="n.id"
                                        >
                                            <a
                                                href="#"
                                                class="page-link"
                                                @click.prevent="getPage(n)"
                                            >
                                                <span>
                                                    {{ n }}
                                                </span>
                                            </a>
                                        </li>
                                        <!-- next -->
                                        <li
                                            class="page-item"
                                            v-show="paginate.next_page_url"
                                        >
                                            <a
                                                href="#"
                                                class="page-link"
                                                @click.prevent="getNextPage"
                                            >
                                                <span>
                                                    <span aria-hidden="true"
                                                        >»</span
                                                    >
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
</template>

<script>
const Toast = swal.mixin({
    toast: true,
    position: "top-end",
    timer: 6000,
    showConfirmButton: false,
    onOpen: toast => {
        toast.addEventListener("mouseenter", swal.stopTimer);
        toast.addEventListener("mouseleave", swal.resumeTimer);
    }
});
export default {
    data: function() {
        return {
            categorias: [],
            jurisdicciones: [],
            categoria_jurisdicciones: [],
            errores: [],
            jurisdiccion: {},
            categoria: {},
            cod_categoria: "",
            descripcion: "",
            selectedJurisdiccion: "",
            selectedCategoria: "",
            search: "",
            editMode: false,
            order: false,
            paginate: {
                current_page: "",
                last_page: "",
                total: "",
                path: "",
                from: "",
                to: "",
                next_page_url:"",
                prev_page_url:""
            },
            n_paginas: 5
        };
    },
    mounted() {
        this.getCategorias();
    },
    methods: {
        getJurisdicciones() {
            axios
                .get("api/jurisdiccion/all")
                .then(response => {
                    this.jurisdicciones = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                    this.errores = error;
                });
        },
        getCategorias() {
            axios
                .get("api/categoria")
                .then(response => {
                    this.paginacion(response)
                })
                .catch(function(error) {
                    console.log(error);
                    this.errores = error;
                });
        },
        nuevaCategoria() {
            // const nueva_clase = {
            //     //id: 555,
            //     cod_clase : this.cod_clase,
            //     categoria_id : this.categorias[this.selectedCategoria].id,
            //     clase : this.clase,
            //     created_at: new Date(),
            //     categoria: this.categorias[this.selectedCategoria],
            // };

            let formData = new FormData();
            formData.append("cod_categoria", this.cod_categoria);
            formData.append(
                "jurisdiccion_id",
                this.jurisdicciones[this.selectedJurisdiccion].id
            );
            formData.append("categoria", this.descripcion);
            axios
                .post("api/categoria/create", formData)
                .then(response => {
                    console.log(response.data);
                    $("#categoria_new").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title:
                            "Se agrego la nueva categoria " +
                            response.data.categoria,
                        background: "#E7FFD7"
                    });
                    this.categoria = response.data;
                    this.categorias.unshift(this.categoria);
                    this.empty();
                })
                .catch(err => {
                    this.errores = err.response.data.errors;
                });
        },
        editarCategoria(index, categoria) {
            //this.empty();
            //console.log(clase.categoria);
            //this.getCategorias();
            this.categoria = categoria;
            // this.clase = this.clases[index];
            this.selectedCategoria = this.paginate.from + parseInt(index - 1);
            this.cod_categoria = this.categoria.cod_categoria;
            this.descripcion = this.categoria.categoria;
            this.categoria_jurisdicciones = this.categoria.jurisdicciones;
        },
        isEditar() {
            this.editMode = true;
        },
        actualizarCategoria() {
            // console.log('actualizado');
            const params = {
                //id: 555,
                cod_categoria: this.cod_categoria,
                //categoria_id : this.categorias[this.selectedCategoria].id,
                categoria: this.descripcion,
                created_at: new Date()
                //categoria: this.categorias[this.selectedCategoria],
            };

            axios
                .put(`api/categoria/update/${this.categoria.id}`, params)
                .then(response => {
                    Toast.fire({
                        icon: "success",
                        title:
                            "La categoria " +
                            response.data.categoria +
                            " se edito con exitó",
                        background: "#E7FFD7"
                    });
                    this.categorias[this.selectedCategoria] = response.data;
                    this.empty();
                })
                .catch(err => {
                    console.log(err.response.data.errors);
                    this.errores = err.response.data.errors;
                });
        },
        eliminarCategoria(index, id) {
            //console.log(index,clase)
            this.selectedCategoria = this.paginate.from + parseInt(index - 1);
            swal.fire({
                title: "Esta seguro?",
                text:
                    this.categorias[this.selectedCategoria ].categoria +
                    " esta a punto de ser eliminada!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete(`api/categoria/delete/${id}`)
                        .then(response => {
                            this.categorias.splice(index, 1);
                            Toast.fire({
                                icon: "success",
                                title: response.data,
                                background: "#E7FFD7"
                            });
                        });
                }
            });
        },
        abrirModal() {
            this.getJurisdicciones();
            console.log(this.jurisdicciones);
        },
        buscar() {
            axios.get(`api/categoria/${this.search}`).then(response => {
                //console.log(response.data)
                this.categorias = response.data.data;
                this.paginate.current_page = response.data.current_page;
                this.paginate.last_page = response.data.last_page;
                this.paginate.total = response.data.total;
                this.paginate.path = response.data.path;
                this.organismos = response.data.data;
                this.paginate.from = response.data.from;
                this.paginate.to = response.data.to;
            });
        },
        sort(columna) {
            this.order = !this.order;
            let sort;
            if (this.order) {
                sort = "asc";
            } else {
                sort = "desc";
            }
            axios
                .get(`api/categoria/order/${columna}/sort/${sort}`)
                .then(response => {
                    this.paginacion(response)
                });
        },
        empty() {
            $("#categoria_new").modal("hide");
            $("#categoria_edit").modal("hide");
            this.jurisdicciones = [];
            this.categoria_jurisdicciones = [];
            this.errores = [];
            this.categoria = {};
            this.search = "";
            this.cod_categoria = "";
            this.descripcion = "";
            this.selectedJurisdiccion = "";
            this.editMode = false;
        },
        getPage(page) {
            axios.get(this.paginate.path + "?page=" + page).then(response => {
                this.paginacion(response);
            });
        },
        getPreviousPage() {
            axios.get(this.paginate.prev_page_url).then(response => {
                this.paginacion(response);
            });
        },
        getNextPage() {
            axios.get(this.paginate.next_page_url).then(response => {
                this.paginacion(response);
            });
        },
        paginacion(response){
            this.categorias = response.data.data;
            this.paginate.current_page = response.data.current_page;
            this.paginate.last_page = response.data.last_page;
            this.paginate.total = response.data.total;
            this.paginate.path = response.data.path;
            this.paginate.from = response.data.from;
            this.paginate.to = response.data.to;
            this.paginate.next_page_url = response.data.next_page_url;
            this.paginate.prev_page_url = response.data.prev_page_url;
        }
    }
};
</script>
