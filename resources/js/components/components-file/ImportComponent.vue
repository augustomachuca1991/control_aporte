<template>
    <section class="content container">
        <div class="row">
            <div class="col-12 text-xs">
                <alert-notifications :auth="user"></alert-notifications>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            Dropzone.js
                            <small><em>jQuery File Upload</em> like look</small>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="actions" class="row">
                            <div class="col-lg-6">
                                <div class="btn-group w-100">
                                    <span
                                        class="btn btn-success col fileinput-button dz-clickable"
                                    >
                                        <i class="fas fa-plus"></i>
                                        <span>Add files</span>
                                    </span>
                                    <button
                                        type="submit"
                                        class="btn btn-primary col start"
                                    >
                                        <i class="fas fa-upload"></i>
                                        <span>Start upload</span>
                                    </button>
                                    <button
                                        type="reset"
                                        class="btn btn-warning col cancel"
                                    >
                                        <i class="fas fa-times-circle"></i>
                                        <span>Cancel upload</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center">
                                <div class="fileupload-process w-100">
                                    <div
                                        id="total-progress"
                                        class="progress progress-striped active"
                                        role="progressbar"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        aria-valuenow="0"
                                        style="opacity: 0;"
                                    >
                                        <div
                                            class="progress-bar progress-bar-success"
                                            style="width: 100%;"
                                            data-dz-uploadprogress=""
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="table table-striped files"
                            id="previews"
                        ></div>
                    </div>
                    <div class="card-footer">
                        Visit
                        <a href="https://www.dropzonejs.com"
                            >dropzone.js documentation</a
                        >
                        for more examples and information about the plugin.
                    </div>
                </div>
            </div> -->
            <div class="col-12 mt-3">
                <div class="card-hover-shadow-2x mb-3 card">
                    <div class="card-footer">
                        <form @submit.prevent="submitFile()">
                            <div class="form-group">
                                <label for="inputFile" class="text-muted"
                                    ><i class="fas fa-upload"></i> &nbsp;Subir
                                    Archivo</label
                                >
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            id="inputFile"
                                            name="file"
                                            ref="file"
                                            @change="handleFileUpload"
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
                                            <i class="fas fa-link"></i>Poner en
                                            cola
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12" v-if="ddjj_sin.length > 0">
                <div class="hr-sect capitalize">
                    <h4>Tareas Pendientes</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <section
                            class="ps-container scrollbar-container ps ps--theme_default ps--active-y"
                        >
                            <ul
                                class="todo-list-wrapper list-group list-group-flush"
                            >
                                <li
                                    class="list-group-item"
                                    v-for="(declaracion_jurada,
                                    index) in ddjj_sin"
                                    :key="index"
                                >
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper row">
                                            <div
                                                class="widget-content-left col mb-4 mb-lg-0"
                                            >
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

                                                <a
                                                    href="#"
                                                    class="stretched-link"
                                                    v-if="
                                                        !declaracion_jurada.apply
                                                    "
                                                    @click="
                                                        aplicar(
                                                            index,
                                                            declaracion_jurada
                                                        )
                                                    "
                                                    ><svg
                                                        aria-hidden="true"
                                                        focusable="false"
                                                        data-prefix="fad"
                                                        data-icon="link"
                                                        role="img"
                                                        width="14"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512"
                                                        class="svg-inline--fa fa-link fa-w-16 fa-7x"
                                                    >
                                                        <g class="fa-group">
                                                            <path
                                                                fill="currentColor"
                                                                d="M44.45 252.59l37.11-37.1c9.84-9.84 26.78-3.3 27.29 10.6a184.45 184.45 0 0 0 9.69 52.72 16.08 16.08 0 0 1-3.78 16.61l-13.09 13.09c-28 28-28.9 73.66-1.15 102a72.07 72.07 0 0 0 102.32.51L270 343.79A72 72 0 0 0 270 242a75.64 75.64 0 0 0-10.34-8.57 16 16 0 0 1-6.95-12.6A39.86 39.86 0 0 1 264.45 191l21.06-21a16.06 16.06 0 0 1 20.58-1.74A152.05 152.05 0 0 1 327 400l-.36.37-67.2 67.2c-59.27 59.27-155.7 59.26-215 0s-59.26-155.72.01-214.98z"
                                                                class="fa-secondary"
                                                            ></path>
                                                            <path
                                                                fill="currentColor"
                                                                d="M410.33 203.49c28-28 28.9-73.66 1.15-102a72.07 72.07 0 0 0-102.32-.49L242 168.21A72 72 0 0 0 242 270a75.64 75.64 0 0 0 10.34 8.57 16 16 0 0 1 6.94 12.6A39.81 39.81 0 0 1 247.55 321l-21.06 21.05a16.07 16.07 0 0 1-20.58 1.74A152.05 152.05 0 0 1 185 112l.36-.37 67.2-67.2c59.27-59.27 155.7-59.26 215 0s59.27 155.7 0 215l-37.11 37.1c-9.84 9.84-26.78 3.3-27.29-10.6a184.45 184.45 0 0 0-9.69-52.72 16.08 16.08 0 0 1 3.78-16.61z"
                                                                class="fa-primary"
                                                            ></path>
                                                        </g></svg
                                                    >Importar</a
                                                >
                                            </div>
                                            <div
                                                class="widget-content-right widget-content-actions col-12 col-lg-3"
                                            >
                                                <div class="text-muted">
                                                    <p class="text-sm">
                                                        <i
                                                            class="far fa-user"
                                                        ></i
                                                        >Subido por
                                                        <b class="d-block">{{
                                                            declaracion_jurada
                                                                .user.name
                                                        }}</b>
                                                    </p>
                                                    <p class="text-sm">
                                                        <svg
                                                            aria-hidden="true"
                                                            focusable="false"
                                                            data-prefix="fal"
                                                            data-icon="clock"
                                                            role="img"
                                                            width="14"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 512 512"
                                                            class="svg-inline--fa fa-clock fa-w-16 fa-7x"
                                                        >
                                                            <path
                                                                fill="currentColor"
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm216 248c0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216zm-148.9 88.3l-81.2-59c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h14c6.6 0 12 5.4 12 12v146.3l70.5 51.3c5.4 3.9 6.5 11.4 2.6 16.8l-8.2 11.3c-3.9 5.3-11.4 6.5-16.8 2.6z"
                                                                class=""
                                                            ></path></svg
                                                        >Tiempo
                                                        <b class="d-block">{{
                                                            declaracion_jurada.created_at
                                                                | moment
                                                        }}</b>
                                                    </p>

                                                    <!-- <button
                                                        @click="
                                                            aplicar(
                                                                index,
                                                                declaracion_jurada
                                                            )
                                                        "
                                                        class="border-0 btn-transition btn btn-outline-info rounded-pill mb-1"
                                                    >
                                                        <i
                                                            class="fas fa-file-upload"
                                                        ></i
                                                        >&nbsp;Importar
                                                    </button>
                                                    <button
                                                        @click="
                                                            deleteDeclaracionJurada(
                                                                index,
                                                                declaracion_jurada
                                                            )
                                                        "
                                                        class="border-0 btn-transition btn btn-outline-danger rounded-pill mb-1"
                                                    >
                                                        <i
                                                            class="fas fa-times"
                                                        ></i
                                                        >&nbsp;Quitar de la cola
                                                    </button> -->
                                                </div>
                                                <div
                                                    v-if="
                                                        declaracion_jurada.apply
                                                    "
                                                >
                                                    <div
                                                        class="spinner-border text-primary"
                                                        role="status"
                                                    >
                                                        <span class="sr-only"
                                                            >Cargando...</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="hr-sect capitalize">
                    <h4>Tareas Finalizadas</h4>
                </div>
                <!-- <section class="content mb-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
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
                </section> -->
                <div v-if="declaraciones_juradas.length > 0" class="row">
                    <div
                        v-for="(declaracion_jurada,
                        index) in declaraciones_juradas"
                        :key="index"
                        class="col-12 col-lg-4 d-flex rounded"
                    >
                        <div class="four columns">
                            <a
                                href="#"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="Descargar Archivo"
                                @click="download(declaracion_jurada.path)"
                            >
                                <div class="content-box color-effect-1">
                                    <p>
                                        {{
                                            declaracion_jurada.created_at
                                                | moment
                                        }}
                                        <span
                                            v-if="declaracion_jurada.rectificar"
                                            class="badge badge-danger"
                                        >
                                            rectificada</span
                                        >
                                    </p>
                                    <h3>
                                        {{
                                            declaracion_jurada.organismo
                                                .organismo
                                        }}
                                    </h3>
                                    <div
                                        class="box-icon-wrap box-icon-effect-1 box-icon-effect-1a"
                                    >
                                        <div class="box-icon">
                                            <i class="fa fa-file"></i>
                                        </div>
                                    </div>
                                    <p>
                                        Perido
                                        {{ declaracion_jurada.periodo.periodo }}
                                    </p>
                                    <p>
                                        Tipo
                                        <span
                                            class="badge"
                                            :class="
                                                declaracion_jurada
                                                    .tipoliquidacion.id === 2
                                                    ? 'bg-warning'
                                                    : 'bg-olive'
                                            "
                                            >{{
                                                declaracion_jurada
                                                    .tipoliquidacion.descripcion
                                            }}</span
                                        >
                                    </p>
                                </div>
                            </a>
                        </div>
                        <!-- <div class="card bg-light d-flex flex-fill">
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
                                                <span
                                                    class="badge"
                                                    :class="
                                                        declaracion_jurada
                                                            .tipoliquidacion
                                                            .id == 1
                                                            ? 'badge-success'
                                                            : 'badge-warning'
                                                    "
                                                    >Tipo
                                                    {{
                                                        declaracion_jurada
                                                            .tipoliquidacion
                                                            .descripcion
                                                    }}</span
                                                >
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
                        </div> -->
                    </div>
                </div>
                <div v-if="declaraciones_juradas.length > perPage">
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
            //fileName: "hola.csv"
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
        handleFileUpload(e) {
            var fileName = document.getElementById("inputFile").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
            this.file = "";
            this.file = this.$refs.file.files[0];
        },
        deleteDeclaracionJurada(index, declaracionJurada) {
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
            axios
                .get(`api/declaracion_jurada/aplicar/${this.user.id}`)
                .then(response => {
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
                    this.ddjj_sin.unshift(response.data);
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
        download: function(pathToFile) {
            const params = {
                path: pathToFile
            };
            axios
                .post("api/declaracion_jurada/download", params, {
                    responseType: "arraybuffer"
                })
                .then(response => {
                    //console.log(response.data)
                    var fileUrl = window.URL.createObjectURL(
                        new Blob([response.data])
                    );
                    var fileLink = document.createElement("a");
                    fileLink.href = fileUrl;

                    fileLink.setAttribute("download", "declaracionjurada.csv");
                    document.body.appendChild(fileLink);
                    fileLink.click();
                });
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

© 2021 GitHub, Inc. Terms Privacy Security Status Docs Contact GitHub Pricing
API Training Blog About
