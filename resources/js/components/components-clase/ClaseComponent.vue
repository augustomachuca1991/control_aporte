<template>
    <div id="panel_clase">
        <!--Modal nueva clase-->
        <create-clase
            :categorias="categorias"
            @clase="nuevaClase(...arguments)"
        ></create-clase>

        <!-- Modal editar jurisdiccion -->
        <update-clase
            v-if="create"
            :categorias="categorias"
            :clase="clase"
            :index="index"
            @clase_update="claseActualizada(...arguments)"
        ></update-clase>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- nueva clase  y buscador-->
                    <div class="col col-md-3 my-2">
                        <button
                            class="btn bg-gradient-teal btn-block rounded-pill"
                            data-toggle="modal"
                            data-target="#clase_new"
                        >
                            <i class="fa fa-plus"></i>&nbsp;Nueva clase
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
                            <div class="card-header bg-gradient-teal">
                                <h3 class="card-title">Lista de Clases</h3>

                                <div class="card-tools">
                                    <div
                                        class="input-group input-group-sm"
                                        style="width: 150px;"
                                    >
                                        <select
                                            class="form-control form-control-sm custom-select rounded-pill"
                                            v-model="perPage"
                                            @change="paginator"
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
                                                    @click="sort('cod_clase')"
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th>
                                                Clase<a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="sort('clase')"
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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="clases.length === 0">
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
                                            v-for="(clase, index) in clases"
                                            :key="clase.id"
                                        >
                                            <td>{{ clase.cod_clase }}</td>
                                            <td>{{ clase.clase }}</td>
                                            <td>
                                                {{ clase.created_at | moment }}
                                            </td>
                                            <td>
                                                {{ clase.categoria.categoria }}
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-outline-warning rounded-circle btn-xs border-0"
                                                    data-toggle="modal"
                                                    data-target="#clase_edit"
                                                    @click="edit(index, clase)"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-danger rounded-circle btn-xs border-0"
                                                    @click="
                                                        deleteClase(
                                                            index,
                                                            clase
                                                        )
                                                    "
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <!-- <button class="btn btn-outline-info rounded-circle btn-xs border-0"><i class="fas fa-eye"></i></button> -->
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
                                    :data="clases"
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
            clases: [],
            categorias: [],
            clase: {},
            search: "",
            order: false,
            paginate: {
                current_page: "",
                last_page: "",
                total: "",
                path: "",
                from: "",
                to: "",
                per_page: "",
                next_page_url: "",
                prev_page_url: ""
            },
            perPage: 10,
            index: "",
            create: false,
            setTimeoutBuscador: "",
            timeOut: 1000
        };
    },
    mounted() {
        this.getClases();
        this.getCategorias();
    },
    methods: {
        getClases() {
            axios
                .get("api/clase/")
                .then(response => {
                    this.asignar(response);
                })
                .catch(function(error) {
                    console.log(error);
                    this.errors = error;
                });
        },
        getCategorias() {
            axios
                .get("api/categoria/all")
                .then(response => {
                    this.categorias = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        nuevaClase(param) {
            Toast.fire({
                icon: "success",
                title: "clase '" + param.clase + "' creada exitosamente",
                background: "#E7FFD7"
            });
            this.clases.unshift(param);
        },
        edit(index, clase) {
            this.index = this.paginate.from + parseInt(index - 1);
            this.clase = clase;
            this.create = true;
        },
        claseActualizada(param) {
            this.clase = param[0];
            this.index = param[1];
            this.clases[this.index] = this.clase;
            Toast.fire({
                icon: "success",
                title: "Clase '" + this.clase.clase + "' creada exitosamente",
                background: "#E7FFD7"
            });
            this.create = false;
        },
        deleteClase(index, clase) {
            this.index = this.paginate.from + parseInt(index - 1);
            this.clase = clase;
            swal.fire({
                title: "Esta seguro?",
                text: this.clase.clase + " esta a punto de ser eliminada!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete(`api/clase/delete/${this.clase.id}`)
                        .then(response => {
                            if (response.data.isValid) {
                                this.clases.splice(this.index, 1);
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
            clearTimeout(this.setTimeoutBuscador);
            this.setTimeoutBuscador = setTimeout(() => {
                axios.get(`api/clase/${this.search}`).then(response => {
                    this.asignar(response);
                });
            }, this.timeOut);
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
                .get(`api/clase/order/${columna}/sort/${sort}`)
                .then(response => {
                    this.asignar(response);
                });
        },
        asignar(response) {
            this.clases = response.data.data;
            this.paginate.current_page = response.data.current_page;
            this.paginate.last_page = response.data.last_page;
            this.paginate.total = response.data.total;
            this.paginate.path = response.data.path;
            this.paginate.from = response.data.from;
            this.paginate.to = response.data.to;
            this.paginate.next_page_url = response.data.next_page_url;
            this.paginate.prev_page_url = response.data.prev_page_url;
        },
        paginator() {
              axios.get(`api/clase/paginate/${this.perPage}`).then( (response) => {
                this.asignar(response)
              });
        }
    }
};
</script>
