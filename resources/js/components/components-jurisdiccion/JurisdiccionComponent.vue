<template>
    <div>
        <!-- /.col (LEFT) -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col col-md-3 my-2">
                        <button
                            class="btn bg-gradient-olive btn-block rounded-pill"
                            data-toggle="modal"
                            data-target="#jurisdiccion_new"
                        >
                            <i class="fa fa-plus"></i>&nbsp;Nueva Jurisdicción
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
                            <div class="card-header bg-gradient-olive">
                                <h3 class="card-title">
                                    Lista de Jurisdicciones
                                </h3>

                                <div class="card-tools">
                                    <div
                                        class="input-group input-group-sm"
                                        style="width: 150px;"
                                    >
                                        <select
                                            class="form-control form-control-sm custom-select rounded-pill"
                                            v-model="perPage"
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
                                                ID
                                                <a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="
                                                        sort('cod_jurisdiccion')
                                                    "
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th scope="col">
                                                Jurisdicción
                                                <a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="
                                                        sort('jurisdiccion')
                                                    "
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th scope="col">
                                                Origen
                                                <a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="sort('origen_id')"
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th scope="col">
                                                Creado
                                                <a
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
                                        <tr v-if="jurisdicciones.length === 0">
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
                                            v-for="(jurisdiccion,
                                            index) in jurisdicciones"
                                            :key="jurisdiccion.id"
                                        >
                                            <th scope="row">
                                                {{
                                                    jurisdiccion.cod_jurisdiccion
                                                }}
                                            </th>
                                            <td>
                                                {{ jurisdiccion.jurisdiccion }}
                                            </td>
                                            <td>
                                                {{ jurisdiccion.origen.origen }}
                                            </td>
                                            <td>
                                                <em>
                                                    {{
                                                        jurisdiccion.created_at
                                                            | moment
                                                    }}</em
                                                >
                                            </td>
                                            <td>
                                                <button
                                                    @click="
                                                        trash(
                                                            index,
                                                            jurisdiccion
                                                        )
                                                    "
                                                    class="btn btn-outline-danger rounded-circle btn-sm mb-1 my-lg-0 border-0"
                                                >
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button
                                                    @click="
                                                        edit(
                                                            index,
                                                            jurisdiccion
                                                        )
                                                    "
                                                    class="btn btn-outline-warning rounded-circle btn-sm mb-1 my-lg-0 border-0"
                                                    data-toggle="modal"
                                                    data-target="#jurisdiccion_edit"
                                                >
                                                    <i class="fa fa-edit"></i>
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
                                <paginator-component :data="jurisdicciones" :paginate="paginate" @response="paginado(...arguments)"></paginator-component>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal nueva jurisdiccion -->
        <create-jurisdiccion
            :origenes="origenes"
            @jurisdiccion="nuevaJurisdiccion(...arguments)"
        ></create-jurisdiccion>

        <!-- Modal editar jurisdiccion -->
        <update-jurisdiccion
            v-if="create"
            :origenes="origenes"
            :jurisdiccion="jurisdiccion"
            :index="index"
            @jurisdiccion_update="jurisdiccionActualizada(...arguments)"
        ></update-jurisdiccion>
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
            jurisdicciones: [],
            jurisdiccion: {},
            origenes: [],

            search: "",
            index: "",
            order: false,
            paginate: {
                current_page: "",
                last_page: "",
                total: "",
                path: "",
                next_page_url: "",
                from: "",
                to: "",
                next_page_url:"",
                prev_page_url:"",

            },
            perPage: 10,
            create: false
        };
    },
    mounted() {
        this.getJurisdicciones();
        this.getOrigenes();
    },
    methods: {
        getJurisdicciones() {
            axios.get("api/jurisdiccion").then(response => {
                this.asignar(response);
            });
        },
        getOrigenes() {
            axios.get("api/origen/all").then(response => {
                this.origenes = response.data;
            });
        },
        nuevaJurisdiccion(param) {
            Toast.fire({
                icon: "success",
                title:
                    "Jurisdicción '" +
                    param.jurisdiccion +
                    "' creada exitosamente",
                background: "#E7FFD7"
            });
            this.getJurisdicciones();
        },
        jurisdiccionActualizada(param) {
            Toast.fire({
                icon: "success",
                title: "Jurisdicción '" + param.jurisdiccion + "' Actualizada",
                background: "#E7FFD7"
            });
            this.getJurisdicciones();
            this.create = false;
        },

        trash(index, jurisdiccion) {
            this.index = this.paginate.from + parseInt(index - 1);
            this.jurisdiccion = jurisdiccion;
            swal.fire({
                title: "Esta seguro?",
                text:
                    this.jurisdiccion.jurisdiccion +
                    " esta a punto de ser eliminada!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete(
                            `api/jurisdiccion/delete/${this.jurisdiccion.id}`
                        )
                        .then(response => {
                            if (response.data.isValid) {
                                this.jurisdicciones.splice(this.index, 1);
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
        edit(index, jurisdiccion) {
            this.create = true;
            this.index = this.paginate.from + parseInt(index - 1);
            this.jurisdiccion = jurisdiccion;
            this.getOrigenes();
        },

        buscar() {
            axios.get(`api/jurisdiccion/${this.search}`).then(response => {
                this.asignar(response);
            });
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
                .get(`api/jurisdiccion/order/${column}/sort/${sort}`)
                .then(response => {
                    this.asignar(response);
                });
        },
        paginacion: function() {
            axios
                .get(`api/jurisdiccion/paginate/${this.perPage}`)
                .then(response => {
                    this.asignar(response);
                });
        },
        asignar(response) {
            this.jurisdicciones = response.data.data;
            this.paginate.current_page = response.data.current_page;
            this.paginate.last_page = response.data.last_page;
            this.paginate.total = response.data.total;
            this.paginate.path = response.data.path;
            this.paginate.from = response.data.from;
            this.paginate.to = response.data.to;
            this.paginate.next_page_url = response.data.next_page_url;
            this.paginate.prev_page_url = response.data.prev_page_url;
        },
        paginado(response){
            this.asignar(response);

        }
    }
};
</script>
</script>

<style>
li.page-item {
    display: none;
}

.page-item:first-child,
.page-item:nth-child(2),
.page-item:nth-last-child(2),
.page-item:last-child,
.page-item.active,
.page-item.disabled {
    display: block;
}
</style>
