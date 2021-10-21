<template>
    <div id="lista_categorias">
        <!--Modal nueva categoria-->
        <create-categoria
            :jurisdicciones="jurisdicciones"
            @categoria="nuevaCategoria(...arguments)"
        ></create-categoria>

        <!-- Modal editar jurisdiccion -->
        <update-categoria
            :jurisdicciones="jurisdicciones"
            :categoria="categoria"
            :index="index"
            @categoria_update="categoriaActualizada(...arguments)"
        ></update-categoria>
        <!-- <div
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
        </div> -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- nueva categoria  y buscador-->
                    <div class="col col-md-3 my-2">
                        <button
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
                                            v-model="perPage"
                                            @change="paginacion()"
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
                                                        edit(index, categoria)
                                                    "
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-danger rounded-circle btn-xs border-0"
                                                    @click="
                                                        deleteCategoria(
                                                            index,
                                                            categoria
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
                                <paginator-component
                                    :data="categorias"
                                    :paginate="paginate"
                                    @response="asignar(...arguments)"
                                ></paginator-component>
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
            categoria: {},

            search: "",
            order: false,
            paginate: {
                current_page: "",
                last_page: "",
                total: "",
                path: "",
                from: "",
                to: "",
                next_page_url: "",
                prev_page_url: ""
            },
            perPage: 10,
            index: ""
        };
    },
    mounted() {
        this.getCategorias();
        this.getJurisdicciones();
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
                    this.asignar(response);
                })
                .catch(function(error) {
                    console.log(error);
                    this.errores = error;
                });
        },
        nuevaCategoria(param) {
            Toast.fire({
                icon: "success",
                title:
                    "Categoria '" + param.categoria + "' creada exitosamente",
                background: "#E7FFD7"
            });
            this.categorias.unshift(param);
        },
        edit(index, categoria) {
            this.index = this.paginate.from + parseInt(index - 1);
            this.categoria = categoria;
        },
        categoriaActualizada(param) {
            this.categoria = param[0];
            this.index = param[1];
            this.categorias[this.index] = this.categoria;
            Toast.fire({
                icon: "success",
                title:
                    "Categoria '" +
                    this.categoria.categoria +
                    "' creada exitosamente",
                background: "#E7FFD7"
            });
        },
        deleteCategoria(index, categoria) {
            //console.log(index,clase)
            this.categoria = categoria;
            this.index = this.paginate.from + parseInt(index - 1);
            swal.fire({
                title: "Esta seguro?",
                text:
                    this.categoria.categoria +
                    " esta a punto de ser eliminada!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "Cancelar"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete(`api/categoria/delete/${this.categoria.id}`)
                        .then(response => {
                            if (response.data.isValid) {
                                this.categorias.splice(this.index, 1);
                                Toast.fire({
                                    icon: "success",
                                    title: response.data.msj,
                                    background: "#E7FFD7"
                                });
                            } else {
                                Toast.fire({
                                    icon: "error",
                                    title: response.data.msj,
                                    background: "#FCDBCD"
                                });
                            }
                        });
                }
            });
        },
        buscar() {
            axios.get(`api/categoria/${this.search}`).then(response => {
                //console.log(response.data)
                this.asignar(response);
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
                    this.asignar(response);
                });
        },
        paginacion() {
            axios
                .get(`api/categoria/paginate/${this.perPage}`)
                .then(response => {
                    this.asignar(response);
                });
        },
        asignar(response) {
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
