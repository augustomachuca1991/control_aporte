<template>
    <div class="container">
        <div class="hr-sect capitalize">
            <h4>Conceptos de Liquidaciones</h4>
        </div>
        <section class="content mb-5">
            <div class="container-fluid">
                <h4 class="display-4 text-muted">Buscador</h4>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col col-lg-4">
                                <div class="form-group">
                                    <select
                                        class="form-control"
                                        :class="{
                                            'text-secondary':
                                                selectedSubtipo === ''
                                        }"
                                        style="width: 100%;"
                                        @change="filter"
                                    >
                                        <option :value="''" selected disabled
                                            >Por Subtipo</option
                                        >
                                        <option
                                            v-for="(subtipo, index) in subtipos"
                                            :key="index"
                                            :value="subtipo.id"
                                            >{{ subtipo.id }} -
                                            {{ subtipo.descripcion }}</option
                                        >
                                    </select>
                                </div>
                            </div>
                            <div class="col col-lg-4">
                                <div class="form-group">
                                    <select
                                        class="form-control"
                                        :class="{
                                            'text-secondary':
                                                selectedTipo === ''
                                        }"
                                        style="width: 100%;"
                                        @change="filter"
                                    >
                                        <option :value="''" selected disabled
                                            >Por Tipo de Codigo</option
                                        >
                                        <option
                                            v-for="(tipo, index) in tipos"
                                            :key="index"
                                            :value="tipo.id"
                                            >{{ tipo.id }} -
                                            {{ tipo.descripcion }}</option
                                        >
                                    </select>
                                </div>
                            </div>
                            <div class="col col-lg-4">
                                <div class="form-group">
                                    <select
                                        class="form-control"
                                        :class="{
                                            'text-secondary':
                                                selectedOrganismo === ''
                                        }"
                                        style="width: 100%;"
                                        @change="filter"
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
                                placeholder="Buscar Concepto, Subtipo, Tipo ..."
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
        <create-concepto
            @concepto="nuevoConcepto(...arguments)"
        ></create-concepto>
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title text-muted">
                    Concepto | Subtipo | Tipo
                </h3>
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
            </div>
            <div class="card-body">
                <div
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
                            <i class="fas fa-angle-right"></i>
                            {{ concepto.concepto | capitalize }} |
                            {{ concepto.subtipo.descripcion | capitalize }} |
                            {{
                                concepto.subtipo.tipocodigo.descripcion
                                    | capitalize
                            }}
                        </a>
                    </p>
                    <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
                            <a
                                href="#"
                                @click="edit(index, concepto)"
                                data-toggle="modal"
                                data-target="#concepto_edit"
                            >
                                <i class="fas fa-eye"></i>
                                # {{ concepto.cod_concepto }}
                            </a>
                        </span>
                        <span class="text-muted">
                            {{ concepto.organismo.organismo }}</span
                        >
                    </p>
                </div>
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
            @concepto_update="conceptoActualizado(...arguments)"
        ></update-concepto>
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
            conceptos: [],
            organismos: [],
            subtipos: [],
            tipos: [],
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
            perPage: 10,
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
        this.getSubtipos();
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
        filter() {}
    }
};
</script>
