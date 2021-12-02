<template>
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-info card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img
                            class="profile-user-img img-fluid img-circle"
                            :src="auth.name | imageLogo"
                            :alt="auth.name"
                        />
                    </div>

                    <h3 class="profile-username text-center">
                        {{ auth.name }}
                    </h3>

                    <p class="text-muted text-center">
                        {{ auth.roles | pluck("name", " ") }}
                        <!-- {{implode(',' ,  auth->roles->pluck('name')->all())}} -->
                    </p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b>
                            <a class="float-right">{{ auth.email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Telefono</b>
                            <a class="float-right">{{ auth.telefono }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Permisos</b>
                            <!-- @foreach ($auth->getAllPermissions() as $permiso)-->
                            <!-- {{ auth.getAllPermissions }} -->

                            <a
                                v-for="(permiso, index) in permisos"
                                :key="index"
                                class="float-right ml-1 mb-1"
                                ><span class="badge bg-olive d-flex">
                                    {{ permiso.name }}</span
                                ></a
                            >
                        </li>
                    </ul>

                    <a
                        href="#"
                        @click="editProfile()"
                        class="btn btn-info btn-block"
                        ><b>Editar</b></a
                    >
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    Editar Perfil
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form
                        class="form-horizontal"
                        @submit.prevent="updateProfile()"
                    >
                        <div class="form-group row">
                            <label
                                for="inputName"
                                class="col-sm-2 col-form-label"
                                >Nombre</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputName"
                                    placeholder="Nombre"
                                    v-model="name"
                                    :disabled="!editMode"
                                />
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
                        <div class="form-group row">
                            <label
                                for="inputEmail"
                                class="col-sm-2 col-form-label"
                                >Email</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="email"
                                    class="form-control"
                                    id="inputEmail"
                                    placeholder="Email"
                                    v-model="email"
                                    :disabled="!editMode"
                                />
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
                        <div class="form-group row">
                            <label
                                for="inputName2"
                                class="col-sm-2 col-form-label"
                                >Telefono</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="phone"
                                    placeholder="Telefono"
                                    v-model="telefono"
                                    :disabled="!editMode"
                                />
                            </div>
                            <span
                                class="errors text-danger"
                                v-for="error in errors.telefono"
                                :key="error.id"
                            >
                                <small
                                    ><em>{{ error }}</em></small
                                >
                            </span>
                        </div>
                        <div class="form-group row">
                            <label
                                for="inputExperience"
                                class="col-sm-2 col-form-label"
                                >Aptitudes</label
                            >
                            <div class="col-sm-10">
                                <textarea
                                    class="form-control"
                                    id="inputExperience"
                                    placeholder="Experience"
                                    v-model="aptitudes"
                                    :disabled="!editMode"
                                ></textarea>
                            </div>
                        </div>
                        <div class="form-group row" v-if="hasRoleAdmin">
                            <label
                                for="inputExperience"
                                class="col-sm-2 col-form-label"
                                >Roles</label
                            >
                            <div class="col-sm-10">
                                <div
                                    class="form-check form-check-inline"
                                    v-for="(role, index) in roles"
                                    :key="index"
                                >
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="inlineRadioOptions"
                                        :id="role.id"
                                        :value="role.id"
                                        v-model="roleUser"
                                        :disabled="!editMode"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="inlineRadio1"
                                        >{{ role.name }}</label
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" v-if="editMode">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-info">
                                    Confirmar
                                </button>
                                <button
                                    @click="clear()"
                                    type="button"
                                    class="btn btn-danger"
                                >
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    </div>
</template>

<script>
export default {
    props: ["auth", "permisos"],
    data: function() {
        return {
            id: "",
            name: "",
            email: "",
            telefono: "",
            aptitudes: "",
            editMode: false,
            errors: [],
            roles: [],
            roleUser: [],
            hasRoleAdmin: false
        };
    },
    mounted() {
        console.log("Profile User");
        this.getRoles();
    },
    methods: {
        pluck(array) {
            array.forEach(obj => {
                array.push(obj.name);
                return;
            });
        },
        editProfile() {
            //alert(JSON.stringify(this.auth.roles));
            this.id = this.auth.id;
            this.name = this.auth.name;
            this.email = this.auth.email;
            this.telefono = this.auth.telefono;
            this.aptitudes = "";
            this.editMode = true;
            this.auth.roles.forEach(roles => {
                if (roles.name === "admin") {
                    this.hasRoleAdmin = true;
                }
                this.roleUser.push(roles.id);
            });
        },
        updateProfile() {
            const params = {
                name: this.name,
                email: this.email,
                telefono: this.telefono,
                aptitudes: this.aptitudes,
                roles_id: this.roleUser
            };
            axios
                .put(`api/users/update/${this.auth.id}`, params)
                .then(response => {
                    //alert(JSON.stringify(response.data));
                    this.auth.name = response.data.name;
                    this.auth.email = response.data.email;
                    this.auth.telefono = response.data.telefono;

                    this.clear();
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                });
        },
        clear() {
            this.id = "";
            this.name = "";
            this.email = "";
            this.telefono = "";
            this.aptitudes = "";
            this.editMode = false;
            this.hasRoleAdmin = false;
        },
        getRoles() {
            axios.get("api/roles").then(response => {
                this.roles = response.data;
            });
        }
    },
    filters: {
        pluck: function(array, attribute, separator) {
            let data = [];
            array.forEach(obj => {
                data.push(obj[attribute]);
                //return obj[attribute];
            });
            return data.join(separator + " ");
        },
        imageLogo: function(name) {
            return (
                "https://ui-avatars.com/api/?name=" +
                name +
                "&background=0D8ABC&color=fff"
            );
        }
    }
};
</script>
