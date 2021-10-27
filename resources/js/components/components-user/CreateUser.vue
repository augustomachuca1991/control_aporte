<template>
    <div>
        <button
            type="button"
            class="btn btn-block btn-info"
            data-toggle="modal"
            data-target="#new_user"
        >
            + Nuevo Usuario
        </button>
        <!-- Modal -->
        <div
            class="modal fade"
            id="new_user"
            tabindex="-1"
            role="dialog"
            aria-labelledby="new_userLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="new_userLabel">
                            Nuevo Usuario
                        </h5>
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
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email*</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="inputEmail4"
                                        placeholder="Email"
                                        v-model="email"
                                    />
                                    <div v-if="!errors.length">
                                        <span
                                            class="errors text-danger"
                                            v-for="error in errors.email"
                                            :key="error.id"
                                        >
                                            <small
                                                ><em>{{ error }}</em></small
                                            >
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputName">Name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="inputName"
                                        placeholder="Name"
                                        v-model="name"
                                    />
                                    <div v-if="!errors.length">
                                        <span
                                            class="errors text-danger"
                                            v-for="error in errors.name"
                                            :key="error.id"
                                        >
                                            <small
                                                ><em>{{ error }}</em></small
                                            >
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone">Phone</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputPhone"
                                    placeholder="+ 800 - 12 12 23 52 "
                                    v-model="phone"
                                />
                            </div>
                            <div class="form-group">
                                <label for="inputRoles">Roles*</label>
                                <select
                                    id="inputRoles"
                                    class="form-control"
                                    v-model="selectedRol"
                                >
                                    <option disabled :value="''" selected
                                        >Elija una Rol de usuario...</option
                                    >
                                    <option
                                        v-for="(role, index) in roles"
                                        :key="index"
                                        :value="role.id"
                                        >{{ role.rol }}</option
                                    >
                                </select>
                                <div v-if="!errors.length">
                                    <span
                                        class="errors text-danger"
                                        v-for="error in errors.roles_id"
                                        :key="error.id"
                                    >
                                        <small
                                            ><em>{{ error }}</em></small
                                        >
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="gridCheck"
                                        v-model="send"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="gridCheck"
                                    >
                                        Send Email
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <small
                            ><i class="text-muted"
                                >campos obligatorios (*)</i
                            ></small
                        >
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="newUser"
                        >
                            Nuevo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            name: "",
            email: "",
            password: "",
            selectedRol: "",
            phone: "",
            roles: [],
            errors: [],
            send: true
        };
    },
    mounted() {
        this.getRoles();
    },
    methods: {
        getRoles() {
            axios.get("api/roles").then(response => {
                this.roles = response.data;
            });
        },
        newUser() {
            const param = {
                name: this.name,
                email: this.email,
                password: this.password,
                roles_id: this.selectedRol,
                send: this.send
            };
            this.create(param);
        },
        create(param) {
            axios
                .post("api/users/create", param)
                .then(response => {
                    //console.log(response.data);
                    this.$emit("user", response.data);
                    this.clear();
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                });
        },
        clear() {
            $("#new_user").modal("hide");
            this.name = "";
            this.email = "";
            this.password = "";
            this.selectedRol = "";
            this.phone = "";
            this.errors = [];
            this.send = false;
        }
    }
};
</script>
