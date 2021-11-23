<template>
    <div class="container">
        <div class="hr-sect capitalize">
            <h4>Conceptos de Liquidaciones</h4>
        </div>
        <section class="content mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col col-lg-3">
                                <div class="form-group">
                                    <select
                                        class="form-control"
                                        :class="{
                                            'text-secondary':
                                                selectedOrganismo === ''
                                        }"
                                        style="width: 100%;"
                                        @change="selectOrganismo"
                                        v-model="selectedOrganismo"
                                    >
                                        <option :value="''" disabled
                                            >Buscar Por Organismo</option
                                        >
                                        <option
                                            v-for="(organismo,
                                            index) in organismos"
                                            :key="index"
                                            :value="organismo.cod_organismo"
                                            >{{ organismo.cod_organismo }} -
                                            {{ organismo.organismo }}</option
                                        >
                                    </select>
                                </div>
                            </div>
                            <div class="col col-lg-3">
                                <div class="form-group">
                                    <select
                                        class="form-control"
                                        :class="{
                                            'text-secondary':
                                                selectedTipo === ''
                                        }"
                                        style="width: 100%;"
                                        @change="selectTipo"
                                        v-model="selectedTipo"
                                    >
                                        <option :value="''" selected disabled
                                            >Por Tipo de Codigo</option
                                        >
                                        <option
                                            v-for="(tipo, index) in tipos"
                                            :key="tipo.id"
                                            :value="index"
                                            >{{ tipo.id }} -
                                            {{ tipo.descripcion }}</option
                                        >
                                    </select>
                                </div>
                            </div>
                            <div class="col col-lg-3">
                                <div class="form-group">
                                    <select
                                        class="form-control"
                                        :class="{
                                            'text-secondary':
                                                selectedSubtipo === ''
                                        }"
                                        style="width: 100%;"
                                        @change="selectSubtipo"
                                        v-model="selectedSubtipo"
                                        :disabled="subtipos.length === 0"
                                    >
                                        <option :value="''" selected disabled
                                            >Por Subtipo</option
                                        >
                                        <option
                                            v-for="(subtipo, index) in subtipos"
                                            :key="subtipo.id"
                                            :value="index"
                                            >{{ subtipo.id }} -
                                            {{ subtipo.descripcion }}</option
                                        >
                                    </select>
                                </div>
                            </div>
                            <div class="col col-lg-3">
                                <button
                                    type="button"
                                    class="btn btn-outline-warning btn-block"
                                    @click="refresh"
                                >
                                    <i class="fas fa-sync-alt"></i>Refresh
                                </button>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <input
                                type="search"
                                class="form-control"
                                aria-label="Type your keywords here"
                                v-model="search"
                                @keyup="buscarConcepto"
                                placeholder="Buscar Concepto"
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
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        @click="paginator"
                                        >10</a
                                    >

                                    <div
                                        role="separator"
                                        class="dropdown-divider"
                                    ></div>
                                    <a class="dropdown-item" href="#">todos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <create-concepto
            @concepto="nuevoConcepto(...arguments)"
        ></create-concepto> -->
        <div class="card">
            <div class="card-header border-0">
                <div class="card-tools">
                    <a href="#" class="btn btn-sm btn-tool">
                        <img
                            src="image/logo-ips-header.png"
                            width="150"
                            height="30"
                            alt=""
                        />
                    </a>
                </div>
                <h2 class="text-muted" v-if="conceptos.length <= 0">
                    No se encontraron resutados para esta busqueda
                </h2>
            </div>
            <div class="card-body">
                <div class="row mb-4 text-muted">
                    <div class="col-12 col-lg-3"><b>CONCEPTO</b></div>
                    <div class="col-12 col-lg-3"><b>SUBTIPO DE CODIGO</b></div>
                    <div class="col-12 col-lg-3"><b>TIPO DE CODIGO</b></div>
                    <div class="col-12 col-lg-3">
                        <span class="d-inline-flex d-lg-none"
                            ><b>HISTORIAL</b></span
                        >
                    </div>
                </div>
                <div
                    class="row mb-4 mb-lg-0"
                    v-for="(concepto, index) in conceptos"
                    :key="index"
                >
                    <div class="col-12 col-lg-3">
                        <p
                            class="text-md text-justify d-flex flex-column mb-0 mb-lg-3"
                        >
                            <span>
                                <a
                                    href="#"
                                    @click="edit(index, concepto)"
                                    data-toggle="modal"
                                    data-target="#concepto_edit"
                                    class="text-olive"
                                >
                                    {{ concepto.cod_concepto }} -
                                    {{ concepto.concepto | capitalize }}
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </span>
                            <span class="text-muted">
                                {{ concepto.organismo.organismo }}</span
                            >
                        </p>
                    </div>
                    <div class="col-12 col-lg-3">
                        {{ concepto.subtipo.descripcion | capitalize }}
                    </div>
                    <div class="col-12 col-lg-3">
                        {{
                            concepto.subtipo.tipocodigo.descripcion | capitalize
                        }}
                    </div>
                    <div class="col-12 col-lg-3">
                        <span class="font-weight-bold">
                            <a
                                href="#"
                                class="text-info"
                                @click="history(index, concepto)"
                                data-toggle="modal"
                                data-target="#conceptoHistory"
                            >
                                <i class="fas fa-eye"></i>
                                ver historial
                            </a>
                        </span>
                    </div>
                    <div class="hr-sect capitalize d-lg-none">
                        <svg
                            aria-hidden="true"
                            focusable="false"
                            data-prefix="fal"
                            data-icon="angle-double-down"
                            role="img"
                            width="14"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 256 512"
                            class="svg-inline--fa fa-angle-double-down fa-w-8 fa-7x"
                        >
                            <path
                                fill="currentColor"
                                d="M119.5 262.9L3.5 145.1c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0L128 223.3l100.4-102.2c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L136.5 263c-4.7 4.6-12.3 4.6-17-.1zm17 128l116-117.8c4.7-4.7 4.7-12.3 0-17l-7.1-7.1c-4.7-4.7-12.3-4.7-17 0L128 351.3 27.6 249.1c-4.7-4.7-12.3-4.7-17 0l-7.1 7.1c-4.7 4.7-4.7 12.3 0 17l116 117.8c4.7 4.6 12.3 4.6 17-.1z"
                                class=""
                            ></path>
                        </svg>
                    </div>
                </div>
                <!-- <div
                    v-for="(concepto, index) in conceptos"
                    :key="concepto.id"
                    class="d-flex justify-content-between align-items-center border-bottom mb-3"
                >
                    <p class="text-md ">
                        <a
                            href="#"
                            @click="edit(index, concepto)"
                            data-toggle="modal"
                            data-target="#concepto_edit"
                            class="text-olive"
                        >
                            {{ concepto.concepto | capitalize }} |
                            {{ concepto.subtipo.descripcion | capitalize }} |
                            {{
                                concepto.subtipo.tipocodigo.descripcion
                                    | capitalize
                            }}
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </p>
                    <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
                            <a
                                href="#"
                                class="text-navy"
                                @click="history(index, concepto)"
                                data-toggle="modal"
                                data-target="#conceptoHistory"
                            >
                                <i class="fas fa-eye"></i>
                                ver historial
                            </a>
                        </span>
                        <span class="text-muted">
                            {{ concepto.organismo.organismo }}</span
                        >
                    </p>
                </div> -->
            </div>
        </div>
        <span>total registros encontrados: {{ paginate.total }}</span>
        <paginator-component
            :data="conceptos"
            :paginate="paginate"
            @response="asignar(...arguments)"
        ></paginator-component>

        <update-concepto
            v-if="create"
            :concepto="concepto"
            :index="index"
            :user="user"
            @concepto_update="conceptoActualizado(...arguments)"
        ></update-concepto>
        <div v-if="departamentos.length">
            <history-concepto :concepto="concepto"></history-concepto>
        </div>
        <div v-else>
            <div
                class="modal fade"
                id="conceptoHistory"
                tabindex="-1"
                aria-labelledby="conceptoHistoryLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img
                                src="image/logo-ips-header.png"
                                width="150"
                                height="30"
                                alt=""
                            />
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5 class="modal-title">Sin Cambios</h5>
                        </div>
                        <div class="modal-footer">
                            <p class="text-muted text-sm">
                                No se realizaron cambios a este concepto
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    props: ["user"],
    data: function() {
        return {
            conceptos: [],
            organismos: [],
            subtipos: [],
            tipos: [],
            departamentos: [],
            concepto: {},
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
            perPage: "",
            search: "",
            setTimeoutBuscador: "",
            timeOut: 400,
            index: "",
            create: false,
            selectedOrganismo: "",
            selectedSubtipo: "",
            selectedTipo: ""
        };
    },
    mounted() {
        this.getConceptos();
        this.getOrganismos();
        this.getTipos();
    },
    methods: {
        getConceptos() {
            axios.get("api/concepto").then(response => {
                this.asignar(response);
            });
        },
        getOrganismos() {
            axios.get("api/organismo/all").then(response => {
                this.organismos = response.data;
            });
        },
        getSubtipos() {
            axios.get("api/subtipo").then(response => {
                this.subtipos = response.data;
            });
        },
        getTipos() {
            axios.get("api/tipocodigo").then(response => {
                this.tipos = response.data;
            });
        },
        nuevoConcepto(concepto) {
            this.conceptos.unshift(concepto);
            Toast.fire({
                icon: "success",
                title:
                    "Concepto '" + concepto.concepto + "' creado exitosamente",
                background: "#E7FFD7"
            });
        },
        asignar(response) {
            this.conceptos = response.data.data;
            this.paginate.current_page = response.data.current_page;
            this.paginate.last_page = response.data.last_page;
            this.paginate.total = response.data.total;
            this.paginate.path = response.data.path;
            this.paginate.from = response.data.from;
            this.paginate.to = response.data.to;
            this.paginate.next_page_url = response.data.next_page_url;
            this.paginate.prev_page_url = response.data.prev_page_url;
            this.perPage = response.data.per_page;
        },
        paginator() {
            axios
                .get(`api/concepto/paginate/${this.perPage}`)
                .then(response => {
                    this.asignar(response);
                });
        },
        edit(index, concepto) {
            this.create = true;
            this.concepto = concepto;
            this.departamentos = concepto.departamentos;
            this.index = this.paginate.from + parseInt(index - 1);
        },
        history(index, concepto) {
            this.concepto = concepto;
            this.departamentos = concepto.departamentos;
            this.index = this.paginate.from + parseInt(index - 1);
        },
        conceptoActualizado(concepto) {
            this.concepto = concepto[0];
            this.index = concepto[1];
            this.conceptos[this.index] = this.concepto;
            Toast.fire({
                icon: "success",
                title:
                    "Concepto '" +
                    this.concepto.concepto +
                    "' actualizado exitosamente",
                background: "#E7FFD7"
            });
            this.create = false;
        },
        buscarConcepto() {
            clearTimeout(this.setTimeoutBuscador);
            this.setTimeoutBuscador = setTimeout(() => {
                axios.get(`api/concepto/${this.search}`).then(response => {
                    this.asignar(response);
                });
            }, this.timeOut);
        },
        selectTipo() {
            this.subtipos = [];
            this.selectedSubtipo = "";
            if (this.selectedTipo >= 0) {
                this.subtipos = this.tipos[this.selectedTipo].subtipos;
                const id = this.tipos[this.selectedTipo].id;
                axios.get(`api/concepto/tipo/${id}`).then(response => {
                    this.asignar(response);
                });
            }
        },
        selectSubtipo() {
            if (this.selectedSubtipo >= 0) {
                this.subtipo = this.subtipos[this.selectedSubtipo];
                axios
                    .get(`api/concepto/subtipo/${this.subtipo.id}`)
                    .then(response => {
                        this.asignar(response);
                    });
            }
        },
        selectOrganismo() {
            axios
                .get(`api/concepto/organismo/${this.selectedOrganismo}`)
                .then(response => {
                    this.asignar(response);
                });
        },
        refresh() {
            this.selectedTipo = "";
            this.selectedSubtipo = "";
            this.selectedOrganismo = "";
            this.search = "";
            this.getConceptos();
            this.getOrganismos();
            this.getTipos();
        }
    }
};
</script>
