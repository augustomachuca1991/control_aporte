<template>
    <div
        id="concepto_edit"
        class="modal fade bd-example-modal-lg"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg" role="document">
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
                    <div class="row justify-content-center">
                        <h5 class="modal-title center">
                            Concepto - {{ concepto.concepto | capitalize }}
                        </h5>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Subtipo
                                </div>
                                <div class="col-4">
                                    <i>{{ concepto.subtipo.descripcion }}</i>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Tipo
                                </div>
                                <div class="col-4">
                                    <i>{{
                                        concepto.subtipo.tipocodigo.descripcion
                                    }}</i>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Organismo
                                </div>
                                <div class="col-4">
                                    <i>{{ concepto.organismo.organismo }}</i>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    Unidad
                                </div>
                                <div class="col-4">
                                    <i
                                        >Lorem ipsum dolor, sit amet consectetur
                                        adipisicing elit. Et eum voluptat</i
                                    >
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <!-- <button
                        type="button"
                        class="btn btn-secondary"
                        @click="edit"
                        data-toggle="modal"
                        data-target="#concepto_edit"
                    >
                        Editar
                    </button> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    //props:['data'],
    data: function() {
        return {
            data: []
        };
    },
    mounted() {
        console.log("Component mounted.");
    },
    methods: {}
};
</script>
