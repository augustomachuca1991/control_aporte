<template>
    <div class="container">
        <section class="content mb-5">
            <div class="container-fluid">
                <h4 class="display-4 text-muted">Buscador</h4>
                <div class="row">
                    <div class="col">
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
                                        v-model="search"
                                        @keyup="buscarSubtipo"
                                        placeholder="Buscar Organismo, Subtipo, Tipo ..."
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
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col">
                <div class="hr-sect capitalize">
                    <h4>SUBTIPOS DE CODIGOS</h4>
                </div>
                <table class="table">
                    <thead>
                        <tr class="table-warning">
                            <th>#Cod - Subtipo</th>
                            <th>#Cod - Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="!subtipos.length">
                            <td>
                                Sin resultado para la busqueda "{{ search }}"
                            </td>
                        </tr>
                        <tr v-for="(subtipo, index) in subtipos" :key="index">
                            <td>
                                {{ subtipo.id }} - {{ subtipo.descripcion }}
                            </td>
                            <td>
                                {{ subtipo.tipocodigo.id }} -{{
                                    subtipo.tipocodigo.descripcion
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <create-subtipo
                    :tipos="tipos"
                    @subtipo="nuevoSubtipo(...arguments)"
                ></create-subtipo>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            subtipos: [],
            tipos: [],
            organismos: [],
            perPage: 10,
            selectedOrganismo: "",
            search: "",
            setTimeoutBuscador: "",
            timeOut: 400,
            status: "check"
        };
    },
    mounted() {
        this.getSubtipos();
        this.getTipos();
    },
    methods: {
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
        // getOrganismo() {
        //     axios.get("api/organismo/all").then(response => {
        //         this.organismos = response.data;
        //     });
        // },
        nuevoSubtipo(subtipo) {
            this.subtipos.unshift(subtipo);
            alert("nuevo subtipo");
        },
        buscarSubtipo() {
            clearTimeout(this.setTimeoutBuscador);
            this.setTimeoutBuscador = setTimeout(() => {
                axios.get(`api/subtipo/${this.search}`).then(response => {
                    this.subtipos = response.data;
                });
            }, this.timeOut);
        }
    }
};
</script>
