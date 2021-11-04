<template>
    <div v-if="liquidaciones.length">
        <div
            class="card w-100 card-outline card-pink"
            v-for="(liquidacion, index) in liquidaciones"
            :key="liquidacion.id"
        >
            <div class="card-header">
                <h5 class="card-title text-capitalize">
                    {{
                        liquidacion.liquidacion.historia_laborales[0].puesto
                            .agente.nombre
                    }}
                    -
                    {{
                        liquidacion.liquidacion.historia_laborales[0].puesto
                            .agente.cuil
                    }}
                </h5>
                <p
                    class="d-flex justify-content-end text-muted text-capitalize"
                >
                    Periodo - {{ liquidacion.periodo.periodo }}
                </p>
            </div>
            <div class="card-body">
                <div
                    v-for="historia_laboral in liquidacion.liquidacion
                        .historia_laborales"
                    :key="historia_laboral.id"
                >
                    <p class="text-capitalize">
                        <label for="clase">Clase&nbsp;</label
                        >{{ historia_laboral.clase.clase }}
                    </p>
                    <p class="text-capitalize">
                        <label for="categorias">Categoria&nbsp;</label
                        >{{ historia_laboral.clase.categoria.categoria }}
                    </p>
                    <p class="text-capitalize">
                        <label for="puestos">Puesto Laboral&nbsp;</label
                        >{{ historia_laboral.puesto.cod_laboral }}
                    </p>
                </div>
                <p class="card-text">
                    <!-- <a
                        :href="'.detalle'"
                        class="btn btn-success"
                        data-toggle="modal"
                        v-on:click="ver_detalle(index, liquidacion)"
                    >
                        <i class="fas fa-dollar-sign"></i>
                    </a> -->
                    <button
                        type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#liquidacionDetalle"
                        v-on:click="ver_detalle(index, liquidacion)"
                    >
                        Recibo de sueldo <i class="fas fa-dollar-sign"></i>
                    </button>
                </p>
                <div class="text-right">
                    <p class="mb-0">
                        Tipo - {{ liquidacion.tipoliquidacion.descripcion }}
                    </p>
                    <footer class="blockquote-footer">
                        <cite title="Source Title text-capitalize">
                            {{ liquidacion.organismo.organismo }}
                            -
                            {{
                                liquidacion.organismo.jurisdiccion.jurisdiccion
                            }}
                            -
                            {{
                                liquidacion.organismo.jurisdiccion.origen.origen
                            }}</cite
                        >
                    </footer>
                </div>
            </div>
        </div>
        <span>total registros encontrados: {{ paginate.total }}</span>

        <nav aria-label="Contacts Page Navigation">
            <ul class="pagination paginate-xs justify-content-end m-0">
                <!-- previous -->
                <li class="page-item" v-show="paginate.prev_page_url">
                    <a
                        href="#"
                        class="page-link"
                        @click.prevent="getPreviousPage"
                    >
                        <span>
                            <span aria-hidden="true">«</span>
                        </span>
                    </a>
                </li>

                <!-- items links -->
                <li
                    class="page-item"
                    :class="{ active: paginate.current_page === n }"
                    v-for="n in paginate.last_page"
                    :key="n.id"
                >
                    <a href="#" class="page-link" @click.prevent="getPage(n)">
                        <span>
                            {{ n }}
                        </span>
                    </a>
                </li>

                <!-- next -->
                <li class="page-item" v-show="paginate.next_page_url">
                    <a href="#" class="page-link" @click.prevent="getNextPage">
                        <span>
                            <span aria-hidden="true">»</span>
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Modal -->
        <div v-if="create">
            <liquidaciondetalle-component
                :index="index"
                :liquidacionDetalle="liquidacionOrganismo"
                @modal="hide()"
            ></liquidaciondetalle-component>
        </div>
    </div>
    <div v-else>
        <div class="card">
            <h5 class="card-header card-outline card-pink">Liquidaciones</h5>
            <div class="card-body">
                <h5 class="card-title">
                    No se encontraron resultados para esta consulta
                </h5>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["datos"],
    data: function() {
        return {
            liquidaciones: this.datos.data,
            paginate: {
                current_page: this.datos.current_page,
                last_page: this.datos.last_page,
                total: this.datos.total,
                path: this.datos.path,
                next_page_url: this.datos.next_page_url,
                prev_page_url: this.datos.prev_page_url,
                from: this.datos.from,
                to: this.datos.to
            },
            liquidacionOrganismo: {},
            index: "",
            create: false
        };
    },
    methods: {
        ver_detalle(index, liquidacionOrganismo) {
            this.index = this.paginate.from + parseInt(index - 1);
            this.liquidacionOrganismo = liquidacionOrganismo;
            this.create = true;
        },
        getPage(page) {
            axios.get(this.paginate.path + "?page=" + page).then(response => {
                this.paginacion(response);
            });
        },
        getPreviousPage() {
            axios.get(this.paginate.prev_page_url).then(response => {
                this.paginacion(response);
            });
        },
        getNextPage() {
            axios.get(this.paginate.next_page_url).then(response => {
                this.paginacion(response);
            });
        },
        paginacion(response) {
            this.liquidaciones = response.data.data;
            this.paginate.current_page = response.data.current_page;
            this.paginate.last_page = response.data.last_page;
            this.paginate.total = response.data.total;
            this.paginate.path = response.data.path;
            this.paginate.from = response.data.from;
            this.paginate.to = response.data.to;
            this.paginate.next_page_url = response.data.next_page_url;
            this.paginate.prev_page_url = response.data.prev_page_url;
        },
        hide() {
            this.create = false;
        }
    }
};
</script>

<style>
li.page-item {
    display: none;
}

.page-item:first-child,
.page-item:nth-child(2),
.page-item:nth-last-child(2),
.page-item:last-child,
.page-item.active,
.page-item.disabled {
    display: block;
}
</style>
