<template>
    <div v-if="hasAlert">
        <!-- <div class="alert alert-danger alert-dismissible">
                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                    >
                        ×
                    </button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    Danger alert preview. This alert is dismissable. A wonderful
                    serenity has taken possession of my entire soul, like these
                    sweet mornings of spring which I enjoy with my whole heart.
                </div>
                <div class="alert alert-info alert-dismissible">
                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                    >
                        ×
                    </button>
                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                    Info alert preview. This alert is dismissable.
                </div> -->
        <div
            class="alert bg-yellow alert-dismissible mb-2"
            v-for="(alert, index) in alerts"
            :key="alert.id"
        >
            <!-- {{ alert.data }} -->
            <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-hidden="true"
                @click="deleteAlert(index, alert)"
            >
                ×
            </button>
            <h5>
                <i class="icon fas fa-exclamation-triangle"></i>
                Atencion! nombre_archivo.csv
            </h5>
            {{ alert.data.message }}
            <ul>
                <li>Fila: {{ alert.data.row }}</li>
                <li>Atributo: {{ alert.data.attribute }}</li>
                <li>
                    Errores:
                    <i
                        class="text-error"
                        v-for="(error, index) in alert.data.errors"
                        :key="index"
                    >
                        {{ error }}
                    </i>
                </li>
                <li>Valor: {{ alert.data.values }}</li>
            </ul>
        </div>
        <!-- <div class="alert alert-success alert-dismissible">
                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                    >
                        ×
                    </button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Success alert preview. This alert is dismissable.
                </div> -->
    </div>
</template>

<script>
export default {
    props: ["auth"],
    data: function() {
        return {
            alerts: [],
            fileName: "",
            hasAlert: false,
            failed: "2"
        };
    },
    mounted() {
        this.getAlert();
    },
    methods: {
        getAlert() {
            axios.get(`api/failedRow/${this.auth.id}`).then(response => {
                this.alerts = response.data;
                if (this.alerts) {
                    this.hasAlert = true;
                }
            });
        },
        deleteAlert(index, alert) {
            //this.alerts.splice(index, 1);
        }
    }
};
</script>
