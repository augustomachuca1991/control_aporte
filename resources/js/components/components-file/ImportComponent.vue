<template>
    <section class="content container">
        <div class="row">
            <div class="col-12">
                <div class="card-hover-shadow-2x mb-3 card">
                    <div class="card-header-tab card-header">
                        <div
                            class="card-header-title font-size-lg text-capitalize font-weight-normal text-info"
                        >
                            <i class="fas fa-database"></i>Lista Tareas
                        </div>
                    </div>
                    <div class="scroll-area-lg">
                        <section
                            class="ps-container scrollbar-container ps ps--theme_default ps--active-y"
                        >
                            <ul
                                class="todo-list-wrapper list-group list-group-flush"
                            >
                                <li
                                    class="list-group-item"
                                    v-if="ddjj_sin.length === 0"
                                >
                                    <div class="widget-content p-0">
                                        <div
                                            class="widget-content-wrapper text-muted"
                                        >
                                            <p>No hay tareas por realizar</p>
                                            Lorem ipsum dolor sit amet
                                            consectetur, adipisicing elit.
                                            Exercitationem maiores debitis at
                                            tempora soluta quia alias ab
                                            explicabo quibusdam quo veritatis
                                            ipsa dolore esse, eum sed, nesciunt
                                            neque voluptatibus provident!
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                width="48"
                                            >
                                                <path
                                                    d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"
                                                />
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                </li>
                                <li
                                    v-else
                                    class="list-group-item"
                                    v-for="(declaracion_jurada,
                                    index) in ddjj_sin"
                                    :key="index"
                                >
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div
                                                    class="widget-content-left text-olive"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-6 w-6"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        width="42"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                        />
                                                    </svg>
                                                    {{
                                                        declaracion_jurada.nombre_archivo
                                                    }}
                                                    <div
                                                        v-if="
                                                            declaracion_jurada.rectificar
                                                        "
                                                        class="badge badge-danger ml-2"
                                                    >
                                                        rectificativa
                                                    </div>
                                                </div>
                                                <div class="widget-heading">
                                                    {{
                                                        declaracion_jurada
                                                            .organismo
                                                            .cod_organismo
                                                    }}
                                                    -
                                                    {{
                                                        declaracion_jurada
                                                            .organismo.organismo
                                                    }}
                                                </div>
                                                <div class="text-muted">
                                                    Tipo Liquidación
                                                    <div
                                                        class="badge badge-pill ml-2"
                                                        :class="
                                                            declaracion_jurada
                                                                .tipoliquidacion
                                                                .id === 2
                                                                ? 'bg-warning'
                                                                : 'bg-olive'
                                                        "
                                                    >
                                                        {{
                                                            declaracion_jurada
                                                                .tipoliquidacion
                                                                .descripcion
                                                        }}
                                                    </div>
                                                </div>
                                                <span
                                                    class="text-muted text-xs"
                                                    >{{
                                                        declaracion_jurada
                                                            .periodo.periodo
                                                    }}</span
                                                >
                                            </div>
                                            <div
                                                class="widget-content-right widget-content-actions pt-3"
                                            >
                                                <div
                                                    v-if="
                                                        !declaracion_jurada.apply
                                                    "
                                                >
                                                    <button
                                                        @click="
                                                            aplicar(
                                                                index,
                                                                declaracion_jurada
                                                            )
                                                        "
                                                        class="border-0 btn-transition btn btn-outline-info rounded-pill"
                                                    >
                                                        Aplicar
                                                    </button>
                                                    <button
                                                        @click="
                                                            deletePeriodo(
                                                                index,
                                                                declaracion_jurada
                                                            )
                                                        "
                                                        class="border-0 btn-transition btn btn-outline-danger rounded-pill"
                                                    >
                                                        <i
                                                            class="fas fa-times"
                                                        ></i>
                                                    </button>
                                                </div>
                                                <div v-else>
                                                    <div
                                                        class="d-flex align-items-center"
                                                    >
                                                        <strong
                                                            class="text-muted"
                                                            >Cargando...</strong
                                                        >
                                                        <div
                                                            class="spinner-grow text-primary"
                                                            role="status"
                                                        ></div>
                                                        <div
                                                            class="spinner-grow text-secondary"
                                                            role="status"
                                                        ></div>
                                                        <div
                                                            class="spinner-grow text-success"
                                                            role="status"
                                                        ></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </section>
                    </div>
                    <div class="card-footer">
                        <form @submit.prevent="submitFile()">
                            <div class="form-group">
                                <label for="inputFile">Subir Archivo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            id="inputFile"
                                            name="file"
                                            ref="file"
                                            @change="handleFileUpload()"
                                            required
                                            lang="es"
                                        />
                                        <label
                                            class="custom-file-label"
                                            for="inputFile"
                                            >Seleccione un archivo</label
                                        >
                                    </div>
                                    <div class="input-group-append">
                                        <button
                                            class="btn input-group-text"
                                            type="submit"
                                            name="import"
                                            id="import"
                                        >
                                            <i class="fas fa-file-upload"></i>
                                            &nbsp; Subir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header bg-gradient-gray">
                        <h3 class="card-title">Importar Excel \ CSV</h3>

                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="collapse"
                            >
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <form @submit.prevent="submitFile()">
                        <div class="card-body">
                            <div
                                class="import"
                                style="min-height: 135px; height: 135px; max-height: 135px; max-width: 100%;"
                            >
                                <div class="form-group">
                                    <div class="d-flex align-items-center">
                                        <input
                                            class="form-control border-0"
                                            type="file"
                                            id="file"
                                            name="file"
                                            ref="file"
                                            @change="handleFileUpload()"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div>
                                <button
                                    type="submit"
                                    name="import"
                                    id="import"
                                    class="btn bg-gradient-gray btn-block"
                                >
                                    <i class="fas fa-file-upload"></i
                                    >&nbsp;Subir
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->

            <div class="col-12">
                <div class="hr-sect capitalize">
                    <h4>Lista de Declaraciones Juradas</h4>
                </div>
                <section class="content mb-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <!-- <div class="row">
                                    <div class="col col-lg-3">
                                        <div class="form-group">
                                            <select
                                                class="form-control"
                                                style="width: 100%;"
                                            >
                                                <option
                                                    :value="''"
                                                    selected
                                                    disabled
                                                    >Buscar Por
                                                    Organismo</option
                                                >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-lg-3">
                                        <div class="form-group">
                                            <select
                                                class="form-control"
                                                style="width: 100%;"
                                            >
                                                <option
                                                    :value="''"
                                                    selected
                                                    disabled
                                                    >Por Tipo de Codigo</option
                                                >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-lg-3">
                                        <div class="form-group">
                                            <select
                                                class="form-control"
                                                style="width: 100%;"
                                            >
                                                <option
                                                    :value="''"
                                                    selected
                                                    disabled
                                                    >Por Subtipo</option
                                                >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-lg-3">
                                        <button
                                            type="button"
                                            class="btn btn-outline-warning btn-block"
                                        >
                                            <i class="fas fa-sync-alt"></i
                                            >Refresh
                                        </button>
                                    </div>
                                </div> -->
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button
                                            type="button"
                                            class="btn btn-default"
                                        >
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                    <input
                                        type="search"
                                        class="form-control"
                                        aria-label="Type your keywords here"
                                        placeholder="Buscar Declaracion Jurada"
                                        v-model="search"
                                        @keyup="buscarDeclaracionJurada()"
                                    />
                                    <div class="input-group-append">
                                        <button
                                            class="btn btn-outline-secondary dropdown-toggle"
                                            type="button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            {{ perPage }} por Pagina
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#"
                                                >10</a
                                            >

                                            <div
                                                role="separator"
                                                class="dropdown-divider"
                                            ></div>
                                            <a class="dropdown-item" href="#"
                                                >todos</a
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="row" v-if="declaraciones_juradas.length === 0">
                    <div class="col">
                        <p>
                            No Hay Datos
                        </p>
                    </div>
                </div>
                <div v-else class="row">
                    <div
                        v-for="(declaracion_jurada,
                        index) in declaraciones_juradas"
                        :key="index"
                        class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column"
                    >
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                <nav class="navbar navbar-light bg-light">
                                    <p class="navbar-brand text-muted">
                                        <img
                                            src="/image/logo-ips-header.png"
                                            width="180"
                                            height="40"
                                            alt="ips - logo - Corrientes - institutto de prevision social"
                                        />
                                    </p>
                                </nav>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-9">
                                        <h2 class="lead text-sm">
                                            <b>
                                                <i class="fas fa-file-csv"></i>
                                                {{
                                                    declaracion_jurada.nombre_archivo
                                                }}
                                            </b>
                                        </h2>
                                        <p
                                            v-if="declaracion_jurada.rectificar"
                                            class="text-muted text-sm"
                                        >
                                            rectificativa nº
                                            {{
                                                declaraciones_juradas.secuencia
                                            }}
                                        </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small">
                                                <span class="fa-li"
                                                    ><i
                                                        class="far fa-calendar-alt"
                                                    ></i
                                                ></span>
                                                {{
                                                    declaracion_jurada.periodo
                                                        .periodo
                                                }}
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"
                                                    ><i
                                                        class="fas fa-gopuram"
                                                    ></i
                                                ></span>
                                                {{
                                                    declaracion_jurada.organismo
                                                        .organismo
                                                }}
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"
                                                    ><i
                                                        class="fas fa-file-invoice-dollar"
                                                    ></i
                                                ></span>
                                                Tipo
                                                {{
                                                    declaracion_jurada
                                                        .tipoliquidacion
                                                        .descripcion
                                                }}
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"
                                                    ><i class="far fa-clock"></i
                                                ></span>
                                                {{
                                                    declaracion_jurada.created_at
                                                        | moment
                                                }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-3 text-center text-olive">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6 "
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            width="24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>
                                        <span class="text-xs"> completed</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <p>
                                        Importado por
                                        <small class="text-muted">{{
                                            declaracion_jurada.user.name
                                        }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="declaraciones_juradas.length">
                    <span
                        >total registros encontrados: {{ paginate.total }}</span
                    >
                    <paginator-component
                        :data="declaraciones_juradas"
                        :paginate="paginate"
                        @response="asignar(...arguments)"
                    ></paginator-component>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
const Toast = swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true,
    didOpen: toast => {
        toast.addEventListener("mouseenter", swal.stopTimer);
        toast.addEventListener("mouseleave", swal.resumeTimer);
    }
});

export default {
    props: ["user"],
    data: function() {
        return {
            file: "",
            declaraciones_juradas: [],
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
            ddjj_sin: [],
            declaracion_jurada: {},
            isLoad: false,
            isReciente: false,
            uploadPercentage: 0,
            loadedProgress: 0,
            totalProgress: 0,
            search: "",
            setTimeoutBuscador: "",
            timeOut: 300,
            perPage: "10",
            index: ""
        };
    },
    mounted() {
        this.getDeclaracionesJudaras();
        this.getDeclaracionesJudarasSin();
    },
    methods: {
        // onUploadProgress:function(progressEvent){
        //   this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100) );
        // }.bind(this),
        submitFile() {
            let formData = new FormData();
            formData.append("file", this.file);
            formData.append("user_id", this.user.id);

            axios
                .post("api/declaracion_jurada/create", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    },
                    onUploadProgress: function(progressEvent) {
                        this.loadedProgress = progressEvent.loaded;
                        this.totalProgress = progressEvent.total;
                        this.uploadPercentage = parseInt(
                            Math.round(
                                (progressEvent.loaded / progressEvent.total) *
                                    100
                            )
                        );
                        this.isLoad = true;
                        this.file = "";
                    }.bind(this)
                })
                .then(response => {
                    if (response.data.status) {
                        this.declaracion_jurada = response.data.data;
                        Toast.fire({
                            icon: "success",
                            title:
                                this.declaracion_jurada.nombre_archivo +
                                " se subió con exito",
                            background: "#E7FFD7"
                        });
                        this.ddjj_sin.unshift(this.declaracion_jurada);
                    } else {
                        if (response.data.confirm) {
                            swal.fire({
                                title:
                                    "Atención! Esta a punto de rectificar, Los cambios seran de forma permanentes.",
                                showCancelButton: true,
                                confirmButtonText: "Confirmar Cambios",
                                cancelButtonText: "Cancelar"
                            }).then(result => {
                                if (result.isConfirmed) {
                                    this.rectificar(response.data.data);
                                    // this.declaracion_jurada = response.data.data

                                    // Toast.fire({
                                    //     icon: "success",
                                    //     title:"rectificacion con exitó",
                                    //     background: "#E7FFD7"
                                    // });
                                } else {
                                    window.location.reload();
                                }
                            });
                        } else {
                            Toast.fire({
                                icon: "error",
                                title: response.data.data,
                                background: "#FCDBCD"
                            });
                        }
                    }
                    this.isLoad = false;
                })
                .catch(error => {
                    this.isLoad = false;
                    Toast.fire({
                        icon: "error",
                        title: error.response,
                        background: "#FCDBCD"
                    });
                });
        },
        handleFileUpload() {
            this.file = "";
            this.file = this.$refs.file.files[0];
        },
        deletePeriodo(index, declaracionJurada) {
            this.declaracionJurada = declaracionJurada;
            this.index = index;
            swal.fire({
                title: "Esta seguro?",
                text: "Desea quitar esta tarea de la lista?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "Cancelar"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete(
                            `api/declaracion_jurada/delete/${this.declaracionJurada.id}`
                        )
                        .then(response => {
                            if (response.data.isValid) {
                                this.ddjj_sin.splice(this.index, 1);
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
        getDeclaracionesJudaras() {
            axios.get("api/declaracion_jurada").then(response => {
                this.asignar(response);
            });
        },
        getDeclaracionesJudarasSin() {
            axios.get("api/archivos-recientes").then(response => {
                this.ddjj_sin = response.data;
            });
        },
        aplicar(index, declaracion_jurada) {
            this.index = index;
            this.declaracion_jurada = declaracion_jurada;
            axios.post("api/import", this.declaracion_jurada).then(response => {
                this.ddjj_sin[this.index].apply = true;
                Toast.fire({
                    icon: "success",
                    title:
                        "importando: " + this.declaracion_jurada.nombre_archivo
                });
            });
        },
        rectificar(declaracionjurada) {
            const data = {
                id: declaracionjurada.id,
                user_id: declaracionjurada.user_id,
                secuencia: declaracionjurada.secuencia,
                nombre_archivo: declaracionjurada.nombre_archivo,
                path: declaracionjurada.path,
                status: true,
                rectificar: true
            };

            axios
                .put(`api/declaracion_jurada/update/` + data.id, data)
                .then(response => {
                    this.declaraciones_juradas.unshift(response.data);
                });
        },
        buscarDeclaracionJurada() {
            clearTimeout(this.setTimeoutBuscador);
            this.setTimeoutBuscador = setTimeout(() => {
                axios
                    .get(`api/declaracion_jurada/buscar/${this.search}`)
                    .then(response => {
                        this.asignar(response);
                    });
            }, this.timeOut);
        },
        asignar(response) {
            this.declaraciones_juradas = response.data.data;
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
