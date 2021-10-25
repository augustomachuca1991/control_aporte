<template>
    <div>
        <!-- Modal nuevo organismo -->
        <create-organismo
            @organismo="nuevoOrganismo(...arguments)"
        ></create-organismo>

        <!-- Modal editar Organismo -->
        <update-organismo
            v-if="create"
            :origenes="origenes"
            :organismo="organismo"
            :index="index"
            @organismo_update="organismoActualizada(...arguments)"
        ></update-organismo>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col col-md-3 my-2">
                        <button
                            class="btn bg-gradient-success btn-block rounded-pill"
                            data-toggle="modal"
                            data-target="#organismo_new"
                        >
                            <i class="fa fa-plus"></i>&nbsp;Nuevo Organismo
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-gradient-success">
                                <h3 class="card-title">Lista de Organismos</h3>

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
                                            <th scope="col">
                                                # Cod<a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="
                                                        sort('cod_organismo')
                                                    "
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th scope="col">
                                                Organismo<a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="sort('organismo')"
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th scope="col">
                                                jurisdicción<a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="
                                                        sort('jurisdiccion_id')
                                                    "
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th scope="col">
                                                Origen<a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="
                                                        sort('jurisdiccion_id')
                                                    "
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th scope="col">
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
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="organismos.length === 0">
                                            <td
                                                colspan="6"
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
                                            v-for="(organismo,
                                            index) in organismos"
                                            :key="organismo.id"
                                        >
                                            <th scope="row">
                                                {{ organismo.cod_organismo }}
                                            </th>
                                            <td>{{ organismo.organismo }}</td>
                                            <td>
                                                {{
                                                    organismo.jurisdiccion
                                                        .jurisdiccion
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                    organismo.jurisdiccion
                                                        .origen.origen
                                                }}
                                            </td>
                                            <td>
                                                <em>
                                                    {{
                                                        organismo.created_at
                                                            | moment
                                                    }}</em
                                                >
                                            </td>
                                            <td>
                                                <button
                                                    @click="
                                                        edit(index, organismo)
                                                    "
                                                    class="btn btn-outline-warning rounded-circle btn-sm mb-1 my-lg-0 border-0"
                                                    data-toggle="modal"
                                                    data-target="#organismo_edit"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button
                                                    @click="
                                                        deleteOrganismo(
                                                            index,
                                                            organismo
                                                        )
                                                    "
                                                    class="btn btn-outline-danger rounded-circle btn-sm mb-1 my-lg-0 border-0"
                                                >
                                                    <i class="fa fa-trash"></i>
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
                                    :data="organismos"
                                    :paginate="paginate"
                                    @response="asignar(...arguments)"
                                ></paginator-component>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
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
            origenes: [],
            organismos: [],
            organismo: {},
            search: "",
            order: false,
            perPage: 10,
            index: "",
            create: false,
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
            setTimeoutBuscador: "",
            timeOut: 400
        };
    },
    mounted() {
        this.getOrganismos();
    },

    methods: {
        getOrigenes() {
            axios.get("api/origen/all").then(response => {
                this.origenes = response.data;
            });
        },
        getOrganismos() {
            axios.get("api/organismo").then(response => {
                this.asignar(response);
            });
        },
        nuevoOrganismo(param) {
            Toast.fire({
                icon: "success",
                title:
                    "organismo '" + param.organismo + "' creado exitosamente",
                background: "#E7FFD7"
            });
            this.organismos.unshift(param);
        },
        deleteOrganismo(index, organismo) {
            this.organismo = organismo;
            this.index = this.paginate.from + parseInt(index - 1);
            swal.fire({
                title: "Esta seguro?",
                text:
                    this.organismo.organismo +
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
                        .delete(`api/organismo/delete/${this.organismo.id}`)
                        .then(response => {
                            if (response.data.isValid) {
                                this.organismos.splice(this.index, 1);
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
        edit(index, organismo) {
            this.getOrigenes();
            this.create = true;
            this.index = this.paginate.from + parseInt(index - 1);
            this.organismo = organismo;
        },
        organismoActualizada(param) {
            this.organismo = param[0];
            this.index = param[1];
            this.organismos[this.index] = this.organismo;
            Toast.fire({
                icon: "success",
                title:
                    "Organismo '" +
                    this.organismo.organismo +
                    "' actualizado exitosamente",
                background: "#E7FFD7"
            });
            this.create = false;
        },
        buscar() {
            clearTimeout(this.setTimeoutBuscador);
            this.setTimeoutBuscador = setTimeout(() => {
                axios.get(`api/organismo/${this.search}`).then(response => {
                    this.asignar(response);
                });
            }, this.timeOut);
        },
        sort(column) {
            this.order = !this.order;
            let sort;

            if (this.order) {
                sort = "asc";
            } else {
                sort = "desc";
            }

            axios
                .get(`api/organismo/order/${column}/sort/${sort}`)
                .then(response => {
                    this.asignar(response);
                });
        },
        asignar(response) {
            this.organismos = response.data.data;
            this.paginate.current_page = response.data.current_page;
            this.paginate.last_page = response.data.last_page;
            this.paginate.total = response.data.total;
            this.paginate.path = response.data.path;
            this.organismos = response.data.data;
            this.paginate.from = response.data.from;
            this.paginate.to = response.data.to;
            this.paginate.next_page_url = response.data.next_page_url;
            this.paginate.prev_page_url = response.data.prev_page_url;
        },
        paginator() {
            axios
                .get(`api/organismo/paginate/${this.perPage}`)
                .then(response => {
                    this.asignar(response);
                });
        }
    }
};
</script>
