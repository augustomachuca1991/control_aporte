<template>
    <div
        class="modal fade"
        id="periodo_new"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalLabelNewPeriodo"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" @submit.prevent="create()">
                    <div
                        class="modal-header"
                        style="background: radial-gradient(#f3fff1, #ccc);"
                    >
                        <h5 class="modal-title" id="ModalLabelNewPeriodo">
                            Nuevo Periodo
                        </h5>
                        <!-- {{errors}} -->
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="clear()"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="selectPeriodo"
                                >Elija un Nuevo Periodo</label
                            >
                            <month-picker-input
                                id="selectPeriodo"
                                :lang="'es'"
                                :no-default="true"
                                :max-date="fechaActual"
                                @change="selectPeriodo"
                            >
                            </month-picker-input>
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    //props:['data'],
    data: function() {
        return {
            errors: [],
            fechaActual: null,
            periodo: {}
        };
    },
    mounted() {
        var milisegundos = Date.now();
        this.fechaActual = new Date(milisegundos);
    },
    methods: {
        clear() {
            $("#periodo_new").modal("hide");
            this.errors = [];
            this.periodo = {};

        },
        selectPeriodo(date) {
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
        create() {
            axios
                .post("api/periodo/create", this.periodo)
                .then(response => {
                    this.clear();
                    this.$emit("periodo", response.data);
                })
                .catch(err => {
                    this.errores = err.response.data.errors;
                });
        }
    }
};
</script>
