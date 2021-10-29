<template>
    <main>
        <div class="container-xl px-4 mt-4">
            <div class="card">
                <div
                    class="card-header p-4 p-md-5 border-bottom-0 bg-gradient-secondary text-white-50"
                >
                    <div
                        class="row gx-4 justify-content-between align-items-center"
                    >
                        <div
                            class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-start"
                        >
                            <img
                                :src="'image/logo-ips-header.png'"
                                alt="IPS-Corrientes-Logo-Corrientes"
                                class="invoice-brand-img mb-4"
                            />
                            <div class="h2 text-white mb-0">
                                Instituto de Previsión Social
                            </div>
                            Diseño web &amp; Desarrollo
                        </div>
                        <div class="col-12 col-lg-auto text-center text-lg-end">
                            <div class="h3 text-white">Config.</div>
                            #1234<br />Hoy: 2021-10-29
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead class="border-bottom">
                                <tr class="small text-uppercase text-muted">
                                    <th scope="col">Departamento</th>
                                    <th scope="col" class="text-end">
                                        Tipo
                                    </th>
                                    <th scope="col" class="text-end">
                                        Subtipo
                                    </th>
                                    <th scope="col" class="text-end"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(departamento,
                                    index) in departamentos"
                                    :key="index"
                                    class="border-bottom"
                                >
                                    <td>
                                        <div class="fw-bold">
                                            {{ departamento.departamento }}
                                        </div>
                                        <div
                                            class="small text-muted d-none d-md-block"
                                        >
                                            A professional UI toolkit for
                                            designing admin dashboards and web
                                            applications
                                        </div>
                                    </td>
                                    <td class="text-end fw-bold">
                                        <div
                                            v-for="(tipo,
                                            index) in departamento.tipocodigos"
                                            :key="index"
                                        >
                                            {{ tipo.id }} -
                                            {{ tipo.descripcion }}
                                        </div>
                                    </td>
                                    <td class="text-end fw-bold">
                                        <div
                                            class="row"
                                            v-for="(subtipo,
                                            index) in departamento.subtipos"
                                            :key="index"
                                        >
                                            {{ subtipo.id }} -
                                            {{ subtipo.descripcion }}
                                        </div>
                                    </td>

                                    <td class="text-end fw-bold">
                                        <button
                                            @click="edit(index, departamento)"
                                            class="btn border-0 btn-outline-info rounded-pill"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end pb-0">
                                        <div
                                            class="text-uppercase small fw-700 text-muted"
                                        >
                                            Subtotal:
                                        </div>
                                    </td>
                                    <td class="text-end pb-0">
                                        <div class="h5 mb-0 fw-700">
                                            $,1925.00
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end pb-0">
                                        <div
                                            class="text-uppercase small fw-700 text-muted"
                                        >
                                            Tax (7%):
                                        </div>
                                    </td>
                                    <td class="text-end pb-0">
                                        <div class="h5 mb-0 fw-700">
                                            $134.75
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end pb-0">
                                        <div
                                            class="text-uppercase small fw-700 text-muted"
                                        >
                                            Total Amount Due:
                                        </div>
                                    </td>
                                    <td class="text-end pb-0">
                                        <div class="h5 mb-0 fw-700 text-green">
                                            $2059.75
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer p-4 p-lg-5 border-top-0">
                    <div class="row gx-4" v-if="!isObjectEmpty(departamento)">
                        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                            <div
                                class="small text-muted text-uppercase fw-700 mb-2"
                            >
                                DPTO
                            </div>
                            <div class="h6 mb-1">
                                {{ departamento.departamento }}
                            </div>
                            <div v-if="!editMode" class="small">
                                <button
                                    class="btn btn-outline-secondary btn-sm rounded-pill"
                                    @click="editMode = true"
                                >
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                            <div class="small" v-else>
                                <button
                                    class="btn btn-outline-success btn-sm rounded-pill"
                                    @click="editMode = false"
                                >
                                    <!-- <i class="fas fa-check"></i> -->
                                    Guardar Cambios
                                </button>
                                <button
                                    class="btn btn-outline-danger btn-sm rounded-pill"
                                    @click="editMode = false"
                                >
                                    Cancelar
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                            <div
                                class="small text-muted text-uppercase fw-700 mb-2"
                            >
                                SUBTIPO
                            </div>

                            <div class="h6 mb-0">
                                {{
                                    departamento.subtipos[
                                        departamento.subtipos.length - 1
                                    ].descripcion
                                }}
                            </div>
                            <div v-if="editMode" class="small">
                                <select
                                    class="custom-select"
                                    id="subtipoCodigo"
                                    disabled
                                    v-model="selectedSubtipo"
                                >
                                    <option
                                        v-for="subtipo in subtipos"
                                        :key="subtipo.id"
                                        :value="subtipo.id"
                                        >{{ subtipo.id }}-{{
                                            subtipo.descripcion
                                        }}</option
                                    >
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div
                                class="small text-muted text-uppercase fw-700 mb-2"
                            >
                                TIPO
                            </div>
                            <div class="h6 mb-0">
                                {{
                                    departamento.tipocodigos[
                                        departamento.tipocodigos.length - 1
                                    ].descripcion
                                }}
                            </div>
                            <div v-if="editMode" class="small">
                                <select
                                    class="custom-select mr-sm-2"
                                    id="tipoCodigo"
                                    :disabled="tipos.length === 0"
                                    v-model="selectedTipo"
                                >
                                    <option
                                        v-for="tipo in tipos"
                                        :key="tipo.id"
                                        :value="tipo.id"
                                        >{{ tipo.id }}-{{
                                            tipo.descripcion
                                        }}</option
                                    >
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
export default {
    //props:['data'],
    data: function() {
        return {
            departamentos: [],
            configuraciones: [],
            tipos: [],
            subtipos: [],
            departamento: {},
            index: "",
            editMode: false,
            selectedTipo: "",
            selectedSubtipo: ""
        };
    },
    mounted() {
        this.getDptos();
        this.configuraciones = [
            {
                id: "1",
                dpto_id: "1",
                subtipo_id: "2",
                tipocodigo_id: "1"
            },
            {
                id: "2",
                dpto_id: "2",
                subtipo_id: "11",
                tipocodigo_id: "3"
            },
            {
                id: "3",
                dpto_id: "1",
                subtipo_id: "6",
                tipocodigo_id: "1"
            }
        ];
        this.getTipos();
        this.getSubtipos();
    },
    methods: {
        getDptos() {
            axios.get("api/departamento").then(response => {
                this.departamentos = response.data;
            });
        },
        getSubtipos() {
            axios.get("api/subtipo").then(response => {
                this.subtipos = response.data;
            });
        },
        getTipos() {
            axios.get("api/tipocodigo").then(response => {
                this.tipos = response.data;
            });
        },
        edit(index, departamento) {
            this.index = index;
            this.departamento = departamento;
            this.selectedTipo =
                departamento.tipocodigos[
                    departamento.tipocodigos.length - 1
                ].id;
            this.selectedSubtipo =
                departamento.subtipos[departamento.subtipos.length - 1].id;

            //this.editMode = true;
        },
        isObjectEmpty(someObject) {
            return !Object.keys(someObject).length;
        }
    }
};
</script>
