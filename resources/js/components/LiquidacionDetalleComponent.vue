<template>
    <div
        class="modal fade"
        id="liquidacionDetalle"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Periodo - {{ liquidacionDetalle.periodo.periodo }}
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        @click="empty()"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- cabecera -->
                    <div class="row">
                        <div class="col">
                            <p class="text-center">LIQUIDACIÓN</p>
                        </div>
                    </div>
                    <div class="row bg-light">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <small>Jurisdiccion</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small>{{
                                        liquidacionDetalle.organismo
                                            .jurisdiccion.jurisdiccion
                                    }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <small>Organismo</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small>{{
                                        liquidacionDetalle.organismo.organismo
                                    }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <small>Cargo</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small
                                        >{{
                                            liquidacionDetalle.liquidacion
                                                .historia_laborales[0].puesto.id
                                        }}
                                        cargo</small
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <small>Mes</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small>{{
                                        liquidacionDetalle.periodo.mes
                                    }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <small>Año </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small>{{
                                        liquidacionDetalle.periodo.anio
                                    }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3 bg-light">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <small>Nombre</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small
                                        >{{
                                            liquidacionDetalle.liquidacion
                                                .historia_laborales[0].puesto
                                                .agente.nombre
                                        }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <small>Cuil</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small>{{
                                        liquidacionDetalle.liquidacion
                                            .historia_laborales[0].puesto.agente
                                            .cuil
                                    }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <small>Puesto Laboral</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small>
                                        {{
                                            liquidacionDetalle.liquidacion
                                                .historia_laborales[0].puesto
                                                .cod_laboral
                                        }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <small>Antigüedad</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small>
                                        {{
                                            liquidacionDetalle.liquidacion
                                                .historia_laborales[0].puesto
                                                .fecha_ingreso | format_moment
                                        }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <small>Estado</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small>
                                        {{
                                            liquidacionDetalle.liquidacion
                                                .historia_laborales[0]
                                                .historialiquidaciones[0].estado
                                                .estado
                                        }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <small>Función</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <small>
                                        <p
                                            v-if="
                                                liquidacionDetalle.liquidacion
                                                    .historia_laborales[0]
                                                    .historialiquidaciones[0]
                                                    .funcion === null
                                            "
                                        >
                                            -
                                        </p>
                                        <p v-else>
                                            {{
                                                liquidacionDetalle.liquidacion
                                                    .historia_laborales[0]
                                                    .historialiquidaciones[0]
                                                    .funcion
                                            }}
                                        </p>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- detalle -->
                    <!--table-->
                    <div
                        class="table-responsive shadow p-3 mb-5 bg-white rounded"
                    >
                        <table
                            class="table table-sm table-borderless table-fixed"
                        >
                            <!-- <caption class="justify-content-end">
                                <small>
                                    Total Neto $
                                    {{
                                        parseInt(liquidacionDetalle.liquidacion.bruto) +
                                            parseInt(liquidacionDetalle.liquidacion.familiar) -
                                            parseInt(liquidacionDetalle.liquidacion.descuento)
                                    }}
                                </small>
                            </caption> -->
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="text-center">
                                        <small>Cod</small>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <small>Concepto</small>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <small>Cantidad</small>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <small>Remunerativo</small>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <small>No-Remunerativo</small>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <small>Adicional-Familiar</small>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <small>Descuento</small>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="detalle in liquidacionDetalle
                                        .liquidacion.detalles"
                                    :key="detalle.id"
                                >
                                    <th scope="row">
                                        <small>{{
                                            detalle.concepto.cod_concepto
                                        }}</small>
                                    </th>
                                    <td>
                                        <small>{{
                                            detalle.concepto.concepto
                                        }}</small>
                                    </td>
                                    <td>
                                        <small>{{
                                            detalle.concepto.unidad
                                        }}</small>
                                    </td>
                                    <td>
                                        <small
                                            v-if="
                                                detalle.concepto.subtipo
                                                    .tipocodigo.id < 4
                                            "
                                            >{{ detalle.importe }}</small
                                        >
                                        <small v-else>-</small>
                                    </td>
                                    <td>
                                        <small
                                            v-if="
                                                detalle.concepto.subtipo
                                                    .tipocodigo.id === 4
                                            "
                                            >{{ detalle.importe }}</small
                                        >
                                        <small v-else>-</small>
                                    </td>
                                    <td>
                                        <small
                                            v-if="
                                                detalle.concepto.subtipo
                                                    .tipocodigo.id === 5
                                            "
                                            >{{ detalle.importe }}</small
                                        >
                                        <small v-else>-</small>
                                    </td>
                                    <td>
                                        <small
                                            v-if="
                                                detalle.concepto.subtipo
                                                    .tipocodigo.id === 6
                                            "
                                            >{{ detalle.importe }}</small
                                        >
                                        <small v-else>-</small>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="bg-light">
                                <th scope="row" colspan="3">
                                    <small>Subtotal</small>
                                </th>
                                <td>
                                    <small
                                        v-if="
                                            liquidacionDetalle.liquidacion
                                                .no_remunerativo
                                        "
                                        >$
                                        {{
                                            parseInt(
                                                liquidacionDetalle.liquidacion
                                                    .bruto
                                            ) -
                                                parseInt(
                                                    liquidacionDetalle
                                                        .liquidacion
                                                        .no_remunerativo
                                                )
                                        }}</small
                                    >
                                    <small v-else
                                        >$
                                        {{
                                            parseInt(
                                                liquidacionDetalle.liquidacion
                                                    .bruto
                                            )
                                        }}</small
                                    >
                                </td>
                                <td>
                                    <small
                                        >$
                                        {{
                                            liquidacionDetalle.liquidacion
                                                .no_remunerativo
                                        }}</small
                                    >
                                </td>
                                <td>
                                    <small
                                        >$
                                        {{
                                            parseInt(
                                                liquidacionDetalle.liquidacion
                                                    .familiar
                                            ) +
                                                parseInt(
                                                    liquidacionDetalle
                                                        .liquidacion.hijo
                                                ) +
                                                parseInt(
                                                    liquidacionDetalle
                                                        .liquidacion.esposa
                                                )
                                        }}</small
                                    >
                                </td>
                                <td>
                                    <small
                                        >$
                                        {{
                                            liquidacionDetalle.liquidacion
                                                .descuento
                                        }}</small
                                    >
                                </td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["index", "liquidacionDetalle"],
    data: function() {
        return {
            liquidaciones: []
        };
    },
    mounted() {
        // axios.get("api/liquidacion").then(response => {
        //     console.log("Liquidaciones mounted");
        //     this.liquidaciones = response.data;
        // });
    },
    methods: {
        show(id) {
            axios.get(`api/liquidacion/detalle/` + id).then(response => {
                console.log("Liquidacion mounted");
                this.liquidacion = [];
                this.liquidacion = response.data;
            });
        },
        empty() {
            this.liquidacionDetalle = [];
            this.index = "";
        }
    }
};
</script>
