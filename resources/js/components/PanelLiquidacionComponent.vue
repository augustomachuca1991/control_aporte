<template>
    <div class="container">
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
        <select
            class="form-control mb-5"
            name="perPage"
            id="perPage"
            v-model="perPage"
        >
            <option value="5">Por pagína 5</option>
            <option value="10">Por pagína 10</option>
            <option value="25">Por pagína 25</option>
            <option value="50">Por pagína 50</option>
            <option value="100">Por pagína 100</option>
        </select>

        <paginate name="liquidacions" :list="liquidaciones" :per="perPage">
            <li
                v-for="liquidacion in paginated('liquidacions')"
                :key="liquidacion.id"
            >
                <p>
                    <label for="agente">Agente</label>
                    {{
                        liquidacion.liquidacion.historia_laborales[0].puesto
                            .agente.nombre
                    }}
                    -
                    {{
                        liquidacion.liquidacion.historia_laborales[0].puesto
                            .agente.cuil
                    }}
                </p>
                <p>
                    <label for="tipo">Tipo de Liquidacion</label>
                    {{ liquidacion.tipoliquidacion.descripcion }}
                </p>
                <p>
                    <label for="periodo">Periodo</label>
                    {{ liquidacion.periodo.cod_periodo }} -
                    <label for="codigo">Cod</label>
                    {{ liquidacion.periodo.periodo }}
                </p>
                <p>
                    <label for="organismo">Organismo</label>
                    {{ liquidacion.organismo.organismo }} -
                    {{ liquidacion.organismo.jurisdiccion.jurisdiccion }}
                    -
                    {{ liquidacion.organismo.jurisdiccion.origen.origen }}
                </p>
                <p
                    v-for="clases in liquidacion.liquidacion.historia_laborales"
                    :key="clases.id"
                >
                    <label for="clase">Clase</label>
                    {{ clases.clase.clase }}
                </p>
                <p
                    v-for="categorias in liquidacion.liquidacion
                        .historia_laborales"
                    :key="categorias.id"
                >
                    <label for="categorias">Categoria</label>
                    {{ categorias.clase.categoria.categoria }}
                </p>
                <label for="puestos">Puestos Laborales</label>
                <select name="puestos_laborales" :id="liquidacion.id">
                    <option
                        v-for="puesto_laboral in liquidacion.liquidacion
                            .historia_laborales"
                        :key="puesto_laboral.id"
                        >{{ puesto_laboral.puesto.cod_laboral }}</option
                    >
                </select>
                <p>
                    <a
                        :href="'#detalle'"
                        class="btn btn-outline-success rounded-circle btn-sm mb-1 my-lg-0 border-0"
                        data-toggle="modal"
                        v-on:click="ver_detalle(index, liquidacion)"
                    >
                        <i class="fas fa-dollar-sign"></i>
                    </a>
                </p>
                <hr>
            </li>
        </paginate>
        <paginate-links
            for="liquidacions"
            :simple="{
                prev: '<<',
                next: '>>'
            }"
        ></paginate-links>
    </div>
</template>

<script>
export default {
    data() {
        return {
            liquidaciones: [],
            paginate: ["liquidacions"],
            perPage: "5"
        };
    },
    mounted() {
        var milisegundos = Date.now();
        this.fecha_actual = new Date(milisegundos);
        this.mes = this.fecha_actual.getMonth() + 1;
        this.anio = this.fecha_actual.getFullYear();
        this.getLiquidaciones();
    },
    methods: {
        porOrigen(param) {
            this.filtro.origen = param;
            this.shown = true;
            setTimeout(() => {
                axios
                    .post(`api/liquidacion/origen/` + param, this.filtro)
                    .then(response => {
                        this.shown = false;
                        this.asignar(response);
                    });
            }, this.timeOut);
        },
        porJurisdiccion(param) {
            this.filtro.origen = "";
            this.filtro.jurisdiccion = param;
            this.shown = true;
            setTimeout(() => {
                axios
                    .post(`api/liquidacion/jurisdiccion/` + param, this.filtro)
                    .then(response => {
                        this.shown = false;
                        this.asignar(response);
                    });
            }, this.timeOut);
        },
        porOrganismo(param) {
            this.filtro.origen = "";
            this.filtro.jurisdiccion = "";
            this.filtro.organismo = param;
            this.shown = true;
            setTimeout(() => {
                axios
                    .post(`api/liquidacion/organismo/` + param, this.filtro)
                    .then(response => {
                        this.shown = false;
                        this.asignar(response);
                    });
            }, this.timeOut);
        },
        porAgente(param) {
            this.filtro.agente = param.search;
            let datosAgente = param.search;
            this.shown = true;
            setTimeout(() => {
                axios
                    .post(`api/liquidacion/agente/` + datosAgente, this.filtro)
                    .then(response => {
                        this.shown = false;
                        this.asignar(response);
                    });
            }, this.timeOut);
        },
        getPage(page) {
            axios.get(this.paginate.path + "?page=" + page).then(response => {
                this.asignar(response);
            });
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
            setTimeout(() => {
                axios
                    .post(
                        `api/liquidacion/periodo/` + this.periodo,
                        this.filtro
                    )
                    .then(response => {
                        this.shown = false;
                        this.asignar(response);
                    });
            }, this.timeOut);
        },
        porTipo(param) {
            this.filtro.tipo = param;
            this.shown = true;
            setTimeout(() => {
                axios
                    .post(`api/liquidacion/tipo/` + param, this.filtro)
                    .then(response => {
                        this.shown = false;
                        this.asignar(response);
                    });
            }, this.timeOut);
        },
        buscarLiquidacion() {
            this.shown = true;
            clearTimeout(this.setTimeoutBuscador);
            this.setTimeoutBuscador = setTimeout(() => {
                axios.get(`api/liquidacion/${this.buscador}`).then(response => {
                    this.shown = false;
                    this.asignar(response);
                });
            }, this.timeOut);
        },
        paginacion: function() {
            axios
                .get(`api/liquidacion/paginate/${this.n_paginas}`)
                .then(response => {
                    this.asignar(response);
                });
        },
        asignar(response) {
            this.liquidaciones = response.data.data;
            this.paginate.current_page = response.data.current_page;
            this.paginate.last_page = response.data.last_page;
            this.paginate.total = response.data.total;
            this.paginate.path = response.data.path;
        },
        getLiquidaciones: function() {
            axios.get(`api/liquidacion`).then(response => {
                this.liquidaciones = response.data;
            });
        }
    }
};
</script>

<style>
.paginate-links {
    width: 100%;
    list-style: none;
    text-align: center;
}
.paginate-links li {
    display: inline;
    background-color: #e83e8c;
    color: white;
    padding: 0.5rem;
    margin-left: 0.3rem;
    margin-right: 0.3rem;
    cursor: pointer;
    border-radius: 3px;
}
.paginate-result {
    width: 100%;
    text-align: center;
    margin-bottom: 1rem;
}
</style>
