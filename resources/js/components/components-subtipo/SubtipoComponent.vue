<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="hr-sect capitalize">
                    <h4>SUBTIPOS DE CODIGOS</h4>
                </div>
                <table class="table">
                    <thead>
                        <tr class="table-danger">
                            <!-- <th>Subtipo</th> -->
                            <th>#Cod - Subtipo</th>
                            <th>#Cod - Tipo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(tipo, index) in tipos" :key="index">
                            <!-- <th scope="row">{{ tipo.id }}</th> -->
                            <td>
                                <div
                                    class="row"
                                    v-for="(subtipo, index) in tipo.subtipos"
                                    :key="index"
                                >
                                    <div class="col">
                                        {{ subtipo.id }} -
                                        {{ subtipo.descripcion }}
                                    </div>
                                </div>
                            </td>
                            <td>{{ tipo.id }} - {{ tipo.descripcion }}</td>

                            <td>
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck1"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck1"
                                    >Check me out</label
                                >
                            </td>
                        </tr>
                        <!-- <tr lass="table-dange">
                            <th>
                                No data
                            </th>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <create-subtipo
                    :tipos="tipos"
                    @subtipo="nuevoSubtipo(...arguments)"
                ></create-subtipo>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            subtipos: [],
            tipos: []
        };
    },
    mounted() {
        this.getSubtipos();
        this.getTipos();
    },
    methods: {
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
        nuevoSubtipo(subtipo) {
            this.subtipos.unshift(subtipo);
            alert("nuevo subtipo");
        }
    }
};
</script>
