<template>
    <div class="container">
        <section class="content mb-5">
            <div class="container-fluid">
                <h4 class="text-center display-4">Conceptos</h4>
                <div class="row">
                    <div class="col">
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
        <create-concepto></create-concepto>
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title text-muted">
                    Lista de Conceptos de Liquidacion
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
                    <a href="#" class="btn btn-sm btn-tool">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div
                    class="d-flex justify-content-between align-items-center border-bottom mb-3"
                >
                    <p class="text-success text-xl">
                        <i class="fab fa-amazon-pay"></i>
                    </p>
                    <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
                            <i class="fas fa-eye"></i>
                            12%
                        </span>
                        <span class="text-muted">CONVERSION RATE</span>
                    </p>
                </div>
                <!-- /.d-flex -->
                <div
                    class="d-flex justify-content-between align-items-center border-bottom mb-3"
                >
                    <p class="text-warning text-xl">
                        <i class="fas fa-trash"></i>
                    </p>
                    <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
                            <i class="fas fa-eye"></i>
                            0.8%
                        </span>
                        <span class="text-muted">SALES RATE</span>
                    </p>
                </div>
                <!-- /.d-flex -->
                <div
                    class="d-flex justify-content-between align-items-center mb-0"
                >
                    <p class="text-danger text-xl">
                        <i class="fab fa-airbnb"></i>
                    </p>
                    <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
                            <i class="fas fa-eye"></i>
                            1%
                        </span>
                        <span class="text-muted">REGISTRATION RATE</span>
                    </p>
                </div>
                <!-- /.d-flex -->
            </div>
        </div>
        <div class="list-group">
            <a
                href="#"
                class="list-group-item list-group-item-action flex-column align-items-start mb-2"
                v-for="(concepto, index) in conceptos"
                :key="concepto.id"
                @click="edit(index, concepto)"
                data-toggle="modal"
                data-target="#concepto_edit"
            >
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-2">{{ concepto.concepto | capitalize }}</h5>
                    <small>{{ concepto.organismo.organismo }}</small>
                </div>
                <p class="mb-2">cod {{ concepto.cod_concepto }}</p>
                <small>{{ concepto.unidad }}</small>
            </a>
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
            create: false
        };
    },
    mounted() {
        this.getConceptos();
    },
    methods: {
        getConceptos() {
            axios.get("api/concepto").then(response => {
                this.asignar(response);
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
        buscarConcepto() {
            console.log(this.search);
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
        }
    }
};
</script>
