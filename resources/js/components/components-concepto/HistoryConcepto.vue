<template>
    <!-- Modal -->
    <div
        class="modal fade"
        id="conceptoHistory"
        tabindex="-1"
        aria-labelledby="conceptoHistoryLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <img
                        src="image/logo-ips-header.png"
                        width="150"
                        height="30"
                        alt=""
                    />
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row bg-olive">
                            <div class="col">Concepto</div>
                            <div class="col">Dpto</div>
                            <div class="col">Usuario</div>
                            <div class="col">Cambios</div>
                            <div class="col">Modificacion</div>
                        </div>
                        <div
                            class="row divider"
                            v-for="(departamento,
                            index) in concepto.departamentos"
                            :key="index"
                        >
                            <div class="col">{{ concepto.concepto }}</div>
                            <div class="col">
                                {{ departamento.departamento }}
                            </div>
                            <div class="col">
                                {{ concepto.users[index].name }}
                                <p class="text-muted text-sm">
                                    {{ concepto.users[index].email }}
                                </p>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        subtipo
                                    </div>
                                    <div class="col">
                                        tipo
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col" v-if="index > 0">
                                        <span class="text-muted text-sm"
                                            >{{
                                                concepto.departamentos[
                                                    index - 1
                                                ].pivot.subtipo_id
                                            }}<svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                width="18"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"
                                                /></svg
                                            >{{
                                                departamento.pivot.subtipo_id
                                            }}</span
                                        >
                                    </div>
                                    <div class="col" v-else>
                                        <span class="text-muted text-sm">
                                            {{ departamento.pivot.subtipo_id
                                            }}<svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                width="18"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"
                                                /></svg
                                            >{{ departamento.pivot.subtipo_id }}
                                        </span>
                                    </div>
                                    <div class="col" v-if="index > 0">
                                        <span class="text-muted text-sm"
                                            >{{
                                                concepto.departamentos[
                                                    index - 1
                                                ].pivot.tipocodigo_id
                                            }}<svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                width="18"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"
                                                /></svg
                                            >{{
                                                departamento.pivot.tipocodigo_id
                                            }}</span
                                        >
                                    </div>
                                    <div class="col" v-else>
                                        <span class="text-muted text-sm">
                                            {{ departamento.pivot.tipocodigo_id
                                            }}<svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                width="18"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"
                                                /></svg
                                            >{{
                                                departamento.pivot.tipocodigo_id
                                            }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                {{ departamento.pivot.updated_at | moment }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="text-sm text-muted">
                        última modificación
                        {{
                            concepto.departamentos[
                                concepto.departamentos.length - 1
                            ].pivot.updated_at | moment
                        }}
                        por
                        {{
                            concepto.users[concepto.departamentos.length - 1]
                                .name
                        }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["concepto"],
    data: function() {
        return {
            data: []
        };
    },
    mounted() {
        console.log("Historial mounted");
    },
    methods: {}
};
</script>
