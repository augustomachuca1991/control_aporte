<template>
    <div class="container">
        <section class="content mb-3">
            <div class="container-fluid">
                <h4 class="text-center text-muted display-4">Liquidaciones</h4>
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
                                v-model="buscador"
                                @keyup="buscarLiquidacion()"
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
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-pink">
                    <div class="card-header">
                        <h3 class="card-title">Filtros</h3>

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
                    <div class="card-body">
                        <div class="import">
                            <filter-component
                                @sendOrigen="porOrigen(...arguments)"
                                @sendJur="porJurisdiccion(...arguments)"
                                @sendOrganismo="porOrganismo(...arguments)"
                            >
                            </filter-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-outline card-pink">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Agentes</h3>

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
                    <div class="card-body">
                        <div
                            class="import"
                            style="min-height: 100px; height: 100px; max-height: 100px; max-width: 100%;"
                        >
                            <buscaragente-component
                                @buscarAgente="porAgente(...arguments)"
                            >
                            </buscaragente-component>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-outline card-pink">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Periodo</h3>

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
                    <div class="card-body">
                        <div
                            style="min-height: 100px; height: 100px; max-height: 100px; max-width: 100%;"
                        >
                            <label class="text-muted"
                                ><i class="fas fa-calendar-alt"></i> Periodo
                                liquidacion
                            </label>
                            <month-picker-input
                                :lang="'es'"
                                :max-date="fecha_actual"
                                :no-default="true"
                                @change="porPeriodo"
                            >
                            </month-picker-input>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-outline card-pink">
                    <div class="card-header">
                        <h3 class="card-title">Tipo Liquidación</h3>

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
                    <div class="card-body">
                        <div
                            style="min-height: 100px; height: 100px; max-height: 100px; max-width: 100%;"
                        >
                            <filtertipoliquidacion-component
                                @sendTipo="porTipo(...arguments)"
                            >
                            </filtertipoliquidacion-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="liquidaciones.length === 0">
            <div class="card">
                <h5 class="card-header card-outline card-pink">
                    Liquidaciones
                </h5>
                <div class="card-body">
                    <h5 class="card-title">
                        No hay Datos
                    </h5>
                </div>
            </div>
        </div>
        <div v-else>
            <div v-if="shown" class="card">
                <!-- <h5 class="card-header card-outline card-pink">Liquidaciones</h5> -->
                <div class="card-body">
                    <p class="text-center">
                        cargando...
                        <span>
                            <img height="80px" src="image/ips_loading.gif" />
                        </span>
                    </p>
                </div>
            </div>
            <listaliquidaciones-component v-else :datos="liquidaciones">
            </listaliquidaciones-component>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            liquidaciones: [],
            liquidacion: {},
            shown: false,
            periodo: "",
            fecha_actual: null,
            mes: null,
            anio: null,
            date: {
                from: null,
                to: null,
                month: null,
                year: null,
                monthIndex: null
            },
            timeOut: 500,
            filtro: {
                origen: "",
                jurisdiccion: "",
                organismo: "",
                tipo: "",
                periodo: "",
                agente: ""
            },
            perPage: "10",
            setTimeoutBuscador: "",
            buscador: ""
        };
    },
    mounted() {
        var milisegundos = Date.now();
        this.fecha_actual = new Date(milisegundos);
        this.mes = this.fecha_actual.getMonth() + 1;
        this.anio = this.fecha_actual.getFullYear();
    },
    methods: {
        porOrigen(param) {
            this.shown = true;
            this.filtro.organismo = "";
            this.filtro.jurisdiccion = "";
            this.filtro.origen = param;
            setTimeout(this.filtrarLiquidacion, this.timeOut);
        },
        porJurisdiccion(param) {
            this.filtro.origen = "";
            this.filtro.organismo = "";
            this.filtro.jurisdiccion = param;
            this.shown = true;
            setTimeout(this.filtrarLiquidacion, this.timeOut);
        },
        porOrganismo(param) {
            this.filtro.origen = "";
            this.filtro.jurisdiccion = "";
            this.filtro.organismo = param;
            this.shown = true;
            setTimeout(this.filtrarLiquidacion, this.timeOut);
        },
        porAgente(param) {
            this.filtro.agente = param.search;
            let datosAgente = param.search;
            this.shown = true;
            setTimeout(this.filtrarLiquidacion, this.timeOut);
        },
        porPeriodo(date) {
            this.date = date;
            if (this.date.monthIndex.toString().length < 2) {
                var mes = "0".concat(this.date.monthIndex.toString());
                this.periodo = this.date.year.toString() + mes;
            } else {
                this.periodo =
                    date.year.toString() + date.monthIndex.toString();
            }
            this.filtro.periodo = this.periodo;
            this.shown = true;
            setTimeout(this.filtrarLiquidacion, this.timeOut);
        },
        porTipo(param) {
            this.filtro.tipo = param;
            this.shown = true;
            setTimeout(this.filtrarLiquidacion, this.timeOut);
        },
        buscarLiquidacion() {
            this.shown = true;
            clearTimeout(this.setTimeoutBuscador);
            if (this.buscador) {
                this.setTimeoutBuscador = setTimeout(() => {
                    axios
                        .get(`api/liquidacion/${this.buscador}`)
                        .then(response => {
                            this.shown = false;
                            this.asignar(response);
                        });
                }, this.timeOut);
            } else {
                this.liquidaciones = [];
            }
        },
        paginator(paginas) {
            this.perPage = paginas;
            // axios
            //     .get(`api/liquidacion/paginate/${this.perPage}`)
            //     .then(response => {
            //         this.asignar(response);
            //     });
        },
        asignar(response) {
            this.liquidaciones = response.data;
        },
        filtrarLiquidacion() {
            axios
                .get(`api/liquidacion/filter/query`, {
                    params: this.filtro
                })
                .then(response => {
                    this.shown = false;
                    this.asignar(response);
                });
        }
    }
};
</script>
