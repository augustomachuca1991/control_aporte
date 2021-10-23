<template>
    <div
        class="modal fade"
        id="periodo_edit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalLabelEditPeriodo"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div
                    class="modal-header"
                    style="background: radial-gradient(#f3fff1, #ccc);"
                >
                    <h5 class="modal-title" id="ModalLabelEditPeriodo">
                        Editar Periodo
                    </h5>
                    <!-- {{errors}} -->
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        @click="clear"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="descripcion">Periodo</label>
                        <p id="descripcion">{{ periodo.periodo }}</p>
                        <span
                            class="errors text-danger"
                            v-for="error in errors.periodo"
                            :key="error.id"
                        >
                            <small
                                ><em>{{ error }}</em></small
                            >
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="cod_periodo">Codigo Periodo</label>
                        <p id="cod_periodo" v-if="editMode">
                            {{ cod_periodo }}
                        </p>
                        <p id="cod_periodo" v-else>
                            {{ periodo.cod_periodo }}
                        </p>
                        <span
                            class="errors text-danger"
                            v-for="error in errors.cod_periodo"
                            :key="error.id"
                        >
                            <small
                                ><em>{{ error }}</em></small
                            >
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="mes">Mes</label>
                        <p v-if="editMode">
                            {{ mes }}
                        </p>
                        <p id="mes" v-else>{{ periodo.mes }}</p>
                        <span
                            class="errors text-danger"
                            v-for="error in errors.mes"
                            :key="error.id"
                        >
                            <small
                                ><em>{{ error }}</em></small
                            >
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="anio">Año</label>
                        <p v-if="editMode">
                            {{ anio }}
                        </p>
                        <p id="anio" v-else>{{ periodo.anio }}</p>
                        <span
                            class="errors text-danger"
                            v-for="error in errors.anio"
                            :key="error.id"
                        >
                            <small
                                ><em>{{ error }}</em></small
                            >
                        </span>
                    </div>
                    <div class="form-group" v-if="editMode">
                        <label for="selectPeriodo">Elija un Periodo</label>
                        <month-picker-input
                            id="selectPeriodo"
                            :lang="'es'"
                            :no-default="true"
                            :max-date="fechaActual"
                            @change="selectedPeriodo"
                        >
                        </month-picker-input>
                    </div>
                </div>
                <div class="modal-footer" v-if="editMode">
                    <button
                        type="button"
                        class="btn btn-primary btn-sm"
                        @click="update"
                    >
                        <i class="fa fa-edit"></i>&nbsp;Guardar Cambios
                    </button>
                </div>
                <div class="modal-footer" v-else>
                    <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        @click="clear"
                    >
                        <i class="fa fa-times"></i>&nbsp;Cancelar
                    </button>
                    <button
                        type="button"
                        class="btn btn-secondary btn-sm"
                        @click="editar"
                    >
                        <i class="fa fa-edit"></i>&nbsp;Editar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["periodo", "index"],
    data: function() {
        return {
            errors: [],
            editMode: false,
            fechaActual: null,
            descripcion: "",
            anio: "",
            mes: "",
            cod_periodo: ""
        };
    },
    mounted() {
        var milisegundos = Date.now();
        this.fechaActual = new Date(milisegundos);
    },
    methods: {
        clear() {
            console.log("clear");
        },
        selectedPeriodo(date) {
            let cod_periodo;
            if (date.monthIndex.toString().length < 2) {
                var mes = "0".concat(date.monthIndex.toString());
                cod_periodo = date.year.toString() + mes;
            } else {
                cod_periodo = date.year.toString() + date.monthIndex.toString();
            }
            this.periodo = {
                cod_periodo: cod_periodo,
                mes: date.monthIndex.toString(),
                anio: date.year.toString(),
                periodo: date.month + " de " + date.year
            };
        },
        update() {
            console.log("update");
        },
        editar() {
            this.editMode = true;
            this.cod_periodo = this.periodo.cod_periodo;
            this.descripcion = this.periodo.periodo;
            this.mes = this.periodo.mes;
            this.anio = this.periodo.anio;
        }
    }
};
</script>
