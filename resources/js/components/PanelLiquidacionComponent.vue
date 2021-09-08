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
        

        
          
        <div v-if="shown" class="card">
            <h5 class="card-header card-outline card-pink">Liquidaciones</h5>
            <div class="card-body">
                <p class="text-center">cargando...
                  <span>
                  <img height="80px" src="image/ips_loading.gif" />
                </span>
                </p>
                
            </div>
        </div>
        <listaliquidaciones-component v-else
            :datos="liquidaciones">
        </listaliquidaciones-component>
    </div>
</template>

<script>
export default {
    data() {
        return {
            liquidaciones:[],
                liquidacion:{},
                shown:false,
                periodo:'',
                fecha_actual:null,
                mes:null,
                anio:null,
                date: {
                  from: null,
                  to: null,
                  month: null,
                  year: null,
                  monthIndex: null,
                },
                timeOut:1000,
                filtro:{
                  origen:'',
                  jurisdiccion:'',
                  organismo:'',
                  tipo:'',
                  periodo:'',
                  agente:'',
                }
        };
    },
    mounted() {
        var milisegundos = Date.now();
        this.fecha_actual = new Date(milisegundos);
        this.mes = this.fecha_actual.getMonth() + 1;
        this.anio = this.fecha_actual.getFullYear();
        //this.getLiquidaciones();
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
        // getPage(page) {
        //     axios.get(this.paginate.path + "?page=" + page).then(response => {
        //         this.asignar(response);
        //     });
        // },
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
            //console.log(response.data);
            this.liquidaciones = response.data;
            //console.log(this.liquidaciones);
            // this.paginate.current_page = response.data.current_page;
            // this.paginate.last_page = response.data.last_page;
            // this.paginate.total = response.data.total;
            // this.paginate.path = response.data.path;
        },
        getLiquidaciones() {
            axios.get(`api/liquidacion`).then(response => {
                this.liquidaciones = response.data;
            });
        }
    }
};
</script>
