<template>
    <div>
        <!-- Modal nueva periodo -->
        <create-periodo @periodo="nuevoPeriodo(...arguments)"></create-periodo>

        <!-- Modal editar Periodo -->
        <update-periodo
            v-if="create"
            :periodo="periodo"
            :index="index"
            @periodo_update="periodoActualizado(...arguments)"
        ></update-periodo>

        <!-- /.col (LEFT) -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col col-md-3 my-2">
                        <button
                            class="btn btn-block rounded-pill"
                            data-toggle="modal"
                            data-target="#periodo_new"
                            style="background: radial-gradient(#f3fff1, #ccc);"
                        >
                            <i class="fa fa-plus"></i>&nbsp;Nuevo Periodo
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
                                @keyup="buscarPeriodo()"
                            />
                        </form>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div
                                class="card-header"
                                style="background: radial-gradient(#f3fff1, #ccc);"
                            >
                                <h3 class="card-title">Lista de Peridos</h3>

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
                                                Cod Periodo
                                                <a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="sort('cod_periodo')"
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th scope="col">
                                                Periodo
                                                <a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="sort('periodo')"
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th scope="col">
                                                Mes
                                                <a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="sort('mes')"
                                                    ><small
                                                        ><i
                                                            class="fas fa-sort"
                                                        ></i></small
                                                ></a>
                                            </th>
                                            <th scope="col">
                                                Año
                                                <a
                                                    href="#"
                                                    class="text-dark"
                                                    @click="sort('anio')"
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
                                        <tr v-if="periodos.length === 0">
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
                                            v-for="(periodo, index) in periodos"
                                            :key="periodo.id"
                                        >
                                            <th scope="row">
                                                {{ periodo.cod_periodo }}
                                            </th>
                                            <td>{{ periodo.periodo }}</td>
                                            <td>{{ periodo.mes }}</td>
                                            <td>{{ periodo.anio }}</td>
                                            <td>
                                                <button
                                                    class="btn btn-outline-danger rounded-circle btn-sm mb-1 my-lg-0 border-0"
                                                    @click="
                                                        deletePeriodo(
                                                            index,
                                                            periodo
                                                        )
                                                    "
                                                >
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-warning rounded-circle btn-sm mb-1 my-lg-0 border-0"
                                                    data-toggle="modal"
                                                    data-target="#periodo_edit"
                                                    @click="
                                                        edit(index, periodo)
                                                    "
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
                                <paginator-component
                                    :data="periodos"
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
            periodos: [],
            periodo: {},
            index: "",
            fecha_actual: null,
            order: false,
            date: {
                from: null,
                to: null,
                month: null,
                year: null,
                monthIndex: null
            },
            paginate: {
                current_page: "",
                last_page: "",
                total: "",
                path: "",
                next_page_url: "",
                from: "",
                to: "",
                next_page_url: "",
                prev_page_url: ""
            },
            perPage: 10,
            search: "",
            setTimeoutBuscador: "",
            timeOut: 300,
            create: false
        };
    },
    mounted() {
        var milisegundos = Date.now();
        this.fecha_actual = new Date(milisegundos);
        this.getPeriodos();
    },
    methods: {
        getPeriodos() {
            axios.get("api/periodo").then(response => {
                this.asignar(response);
            });
        },
        nuevoPeriodo(periodo) {
            Toast.fire({
                icon: "success",
                title: "periodo '" + periodo.periodo + "' creado exitosamente",
                background: "#E7FFD7"
            });
            this.periodos.unshift(periodo);
        },
        deletePeriodo(index, periodo) {
            this.periodo = periodo;
            this.index = this.paginate.from + parseInt(index - 1);
            swal.fire({
                title: "Esta seguro?",
                text: this.periodo.periodo + " esta a punto de ser eliminada!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete(`api/periodo/delete/${this.periodo.id}`)
                        .then(response => {
                            if (response.data.isValid) {
                                this.periodos.splice(this.index, 1);
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
        edit(index, periodo) {
            this.periodo = periodo;
            this.index = this.paginate.from + parseInt(index - 1);
            this.create = true;
        },
        periodoActualizado(periodo) {
            this.periodo = periodo[0];
            this.index = periodo[1];
            this.create = false;
            this.periodos[this.index] = this.periodo;
            Toast.fire({
                icon: "success",
                title: "Periodo '" + this.periodo.periodo + "' actualizado",
                background: "#E7FFD7"
            });
        },
        paginacion: function() {
            axios.get(`api/periodo/paginate/${this.perPage}`).then(response => {
                this.asignar(response);
            });
        },
        buscarPeriodo() {
            clearTimeout(this.setTimeoutBuscador);
            this.setTimeoutBuscador = setTimeout(() => {
                axios.get(`api/periodo/${this.buscador}`).then(response => {
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
                .get(`api/periodo/order/${columna}/sort/${sort}`)
                .then(response => {
                    this.asignar(response);
                });
        },
        asignar(response) {
            this.periodos = response.data.data;
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
