<template>
    <div v-if="liquidaciones.length">
        <!-- {{ liquidaciones }} -->
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
                    <a
                        :href="'.detalle'"
                        class="btn btn-success"
                        data-toggle="modal"
                        v-on:click="ver_detalle(index, liquidacion)"
                    >
                        <i class="fas fa-dollar-sign"></i>
                    </a>
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
            </ul>
        </nav>
    </div>
    <div v-else>
        <div class="card">
            <h5 class="card-header card-outline card-pink">Liquidaciones</h5>
            <div class="card-body">
                <h5 class="card-title">No se encontraron resultados</h5>
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
                from: this.datos.from,
                to: this.datos.to
            },
            liquidacionOrganismo: {},
            index: ""
        };
    },
    methods: {
        ver_detalle(index, liquidacionOrganismo) {
            this.index = index;
            this.liquidacionOrganismo = liquidacionOrganismo;
        },
        getPage(page) {
            axios.get(this.paginate.path + "?page=" + page).then(response => {
                this.liquidaciones = response.data.data;
                this.paginate.current_page = response.data.current_page;
                this.paginate.last_page = response.data.last_page;
                this.paginate.total = response.data.total;
                this.paginate.path = response.data.path;
                this.organismos = response.data.data;
                this.paginate.from = response.data.from;
                this.paginate.to = response.data.to;
            });
            console.log(page);
        }
    }
};
</script>
