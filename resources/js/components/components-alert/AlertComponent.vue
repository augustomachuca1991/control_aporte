<template>
    <div v-if="hasAlert">
        <!-- <x-adminlte-callout
            theme="danger"
            class="bg-gradient-pink"
            title-class="text-uppercase"
            icon="fas fa-lg fa-leaf text-purple"
            title="observation"
        >
            <i>A styled observation for the user.</i>
        </x-adminlte-callout> -->
        <div
            class="callout callout-warning  mb-1 text-orange"
            v-for="(alert, index, ht) in alerts"
            :key="index"
            style=" background-color: #fff3cd;"
        >
            <!-- {{ alert.data }} -->
            <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-hidden="true"
                @click="deleteAlert(index, ht, alert)"
            >
                ×
            </button>
            <h5>
                <i class="icon fas fa-exclamation-triangle"></i>
                Atencion!!!
                <i class="text-bold">"{{ alert.data.fileName }}"</i> tuvo los
                siguentes fallos:
            </h5>
            La fila <b>"{{ alert.data.row }}"</b>
            <span v-for="(error, index) in alert.data.errors" :key="index">
                {{ error }}</span
            >
            y se recibió un valor "{{ alert.data.values }}"
            <!-- <ul>
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
            </ul> -->
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
        deleteAlert(index, ht, alert) {
            console.log("click");
            const param = {
                alert_id: alert.id,
                user_id: this.auth.id
            };
            axios.post(`api/readNotifications`, param).then(response => {
                this.alerts = response.data;
            });
        }
    }
};
</script>
