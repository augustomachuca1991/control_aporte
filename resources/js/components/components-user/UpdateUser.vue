<template>
    <div
        class="modal fade"
        id="showUser"
        tabindex="-1"
        role="dialog"
        aria-labelledby="showUserLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-info">
                            <h3 class="widget-user-username">
                                {{ user.name }}
                                <button
                                    type="button"
                                    class="btn btn-sm text-white"
                                    @click="edit"
                                >
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </h3>
                            <h5 class="widget-user-desc">
                                {{ user.email }}
                            </h5>
                        </div>
                        <div class="widget-user-image">
                            <img
                                class="img-circle elevation-2"
                                :src="
                                    'https://ui-avatars.com/api/?name=' +
                                        user.name +
                                        '&color=7F9CF5&background=EBF4FF'
                                "
                                alt="User Avatar"
                            />
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            {{ user.roles[0].rol }}
                                        </h5>

                                        <span class="description-text"
                                            >Roles</span
                                        >
                                    </div>
                                </div>
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            + 800 - 12 12 23 52
                                        </h5>
                                        <span class="description-text"
                                            >Telefo</span
                                        >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            <span
                                                v-if="!user.deleted_at"
                                                :class="{
                                                    'badge badge-success':
                                                        user.deleted_at === null
                                                }"
                                                >Activo</span
                                            >
                                        </h5>
                                        <span class="description-text"
                                            >Estado</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["user", "index"],
    data: function() {
        return {
            data: []
        };
    },
    mounted() {
        console.log("update user");
    },
    methods: {
        edit() {
            this.user.name = "ediitado";
        }
    }
};
</script>
