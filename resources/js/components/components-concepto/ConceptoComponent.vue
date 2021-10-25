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
                                        @click="paginator(5)"
                                        >5</a
                                    >
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        @click="paginator(10)"
                                        >10</a
                                    >
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        @click="paginator(25)"
                                        >25</a
                                    >
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        @click="paginator(50)"
                                        >50</a
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
                <small>unidad</small>
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
        paginator(perPage) {
            console.log(perPage);
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
        }
    }
};
</script>
