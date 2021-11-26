<template>
    <div id="lista_usuarios">
        <div class="container">
            <h2 class="text-center display-4 text-muted">
                <svg
                    aria-hidden="true"
                    focusable="false"
                    data-prefix="fal"
                    data-icon="users"
                    role="img"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 640 512"
                    width="96"
                    class="svg-inline--fa fa-users fa-w-20 fa-7x"
                >
                    <path
                        fill="currentColor"
                        d="M544 224c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80zm0-128c26.5 0 48 21.5 48 48s-21.5 48-48 48-48-21.5-48-48 21.5-48 48-48zM320 256c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm0-192c44.1 0 80 35.9 80 80s-35.9 80-80 80-80-35.9-80-80 35.9-80 80-80zm244 192h-40c-15.2 0-29.3 4.8-41.1 12.9 9.4 6.4 17.9 13.9 25.4 22.4 4.9-2.1 10.2-3.3 15.7-3.3h40c24.2 0 44 21.5 44 48 0 8.8 7.2 16 16 16s16-7.2 16-16c0-44.1-34.1-80-76-80zM96 224c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80zm0-128c26.5 0 48 21.5 48 48s-21.5 48-48 48-48-21.5-48-48 21.5-48 48-48zm304.1 180c-33.4 0-41.7 12-80.1 12-38.4 0-46.7-12-80.1-12-36.3 0-71.6 16.2-92.3 46.9-12.4 18.4-19.6 40.5-19.6 64.3V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-44.8c0-23.8-7.2-45.9-19.6-64.3-20.7-30.7-56-46.9-92.3-46.9zM480 432c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16v-44.8c0-16.6 4.9-32.7 14.1-46.4 13.8-20.5 38.4-32.8 65.7-32.8 27.4 0 37.2 12 80.2 12s52.8-12 80.1-12c27.3 0 51.9 12.3 65.7 32.8 9.2 13.7 14.1 29.8 14.1 46.4V432zM157.1 268.9c-11.9-8.1-26-12.9-41.1-12.9H76c-41.9 0-76 35.9-76 80 0 8.8 7.2 16 16 16s16-7.2 16-16c0-26.5 19.8-48 44-48h40c5.5 0 10.8 1.2 15.7 3.3 7.5-8.5 16.1-16 25.4-22.4z"
                        class=""
                    ></path>
                </svg>
                Usuarios
            </h2>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <create-user
                                    @user="nuevoUser(...arguments)"
                                ></create-user>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <select
                                    class="form-control"
                                    style="width: 100%;"
                                    v-model="perPage"
                                    @change="paginacion"
                                >
                                    <option value="3">3 por pagina</option>
                                    <option value="9">9 por pagina</option>
                                    <option value="27">27 por pagina</option>
                                    <option value="81">81 por pagina</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <select
                                    class="form-control"
                                    style="width: 100%;"
                                    v-model="selectedRol"
                                    @change="filter"
                                >
                                    <option :value="''" disabled
                                        >Buscar Por Roles</option
                                    >
                                    <option
                                        v-for="(role, index) in roles"
                                        :key="index"
                                        :value="role.id"
                                        >{{ role.rol }}</option
                                    >
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group ">
                            <input
                                type="search"
                                class="form-control "
                                placeholder="Buscar Nombre, Email, Rol, etc..."
                                @keyup="buscarUser"
                                v-model="search"
                            />

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div
                    v-for="(user, index) in users"
                    :key="user.id"
                    class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column"
                >
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            <div v-if="user.deleted_at" class="ribbon-wrapper">
                                <div class="ribbon bg-maroon">
                                    locked
                                </div>
                            </div>
                            <nav class="navbar navbar-light bg-light">
                                <p class="navbar-brand text-muted">
                                    <img
                                        src="/image/logo-ips-header.png"
                                        width="180"
                                        height="40"
                                        alt="ips - logo - Corrientes - institutto de prevision social"
                                    />
                                </p>
                            </nav>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead">
                                        <b>{{ user.name }}</b>
                                    </h2>
                                    <p class="text-muted text-sm">
                                        <span
                                            v-for="(role, index) in user.roles"
                                            :key="role.id"
                                            >{{ role.name }}
                                            <i
                                                v-show="
                                                    index < user.roles.lenght
                                                "
                                                >/</i
                                            >
                                        </span>
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small">
                                            <span class="fa-li"
                                                ><i class="fas fa-lg fa-at"></i
                                            ></span>
                                            {{ user.email }}
                                        </li>
                                        <li class="small">
                                            <span class="fa-li"
                                                ><i
                                                    class="fas fa-lg fa-phone"
                                                ></i
                                            ></span>
                                            <div v-if="user.telefono">
                                                {{ user.telefono }}
                                            </div>
                                            <div v-else>
                                                -
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img
                                        :src="
                                            'https://ui-avatars.com/api/?name=' +
                                                user.name +
                                                '&color=7F9CF5&background=EBF4FF'
                                        "
                                        alt="user-avatar"
                                        class="img-circle img-fluid shadow"
                                    />
                                </div>
                            </div>
                        </div>
                        <div v-if="user.deleted_at" class="card-footer">
                            <div class="text-right">
                                <a
                                    href="#"
                                    class="btn btn-sm bg-gradient-maroon"
                                    @click="desbloquear(index, user)"
                                >
                                    <i class="fas fa-unlock"></i>
                                    desbloquear
                                </a>
                            </div>
                        </div>
                        <div v-else class="card-footer">
                            <div class="text-right">
                                <a
                                    href="#"
                                    class="btn btn-sm bg-gradient-teal"
                                    @click="deleteUser(index, user)"
                                >
                                    <i class="fas fa-lock"></i>
                                </a>
                                <a
                                    href="#"
                                    class="btn btn-sm bg-gradient-primary"
                                    data-toggle="modal"
                                    data-target="#showUser"
                                    @click="edit(index, user)"
                                >
                                    <i class="fas fa-user"></i> Ver Perfil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="users.length">
                <span>total registros encontrados: {{ paginate.total }}</span>
                <paginator-component
                    :data="users"
                    :paginate="paginate"
                    @response="asignar(...arguments)"
                ></paginator-component>
            </div>
        </div>
        <update-user v-if="create" :user="user" :index="index"></update-user>
    </div>
</template>

<script>
const Toast = swal.mixin({
    toast: true,
    position: "top-end",
    timer: 6000,
    showConfirmButton: false,
    onOpen: toast => {
        toast.addEventListener("mouseenter", swal.stopTimer);
        toast.addEventListener("mouseleave", swal.resumeTimer);
    }
});
export default {
    data: function() {
        return {
            users: [],
            roles: [],
            user: {},
            paginate: {
                current_page: "",
                last_page: "",
                total: "",
                path: "",
                next_page_url: "",
                from: "",
                to: "",
                next_page_url: "",
                prev_page_url: ""
            },
            search: "",
            index: "",
            create: false,
            setTimeoutBuscador: "",
            timeOut: 400,
            selectedRol: "",
            perPage: "9"
        };
    },
    mounted() {
        this.getUsers();
        this.getRoles();
    },
    methods: {
        getUsers: function() {
            axios.get("api/users").then(response => {
                this.asignar(response);
            });
        },
        getRoles() {
            axios.get("api/roles").then(response => {
                this.roles = response.data;
            });
        },
        nuevoUser(user) {
            this.users.unshift(user);
            Toast.fire({
                icon: "success",
                title: "Se envió un correo de confirmación a " + user.email,
                background: "#E7FFD7"
            });
        },
        desbloquear(index, user) {
            this.user = user;
            this.index = this.paginate.from + parseInt(index - 1);
            axios
                .get(`api/users/desbloquear/${this.user.id}`)
                .then(response => {
                    this.users[this.index].deleted_at = "";
                    this.user = response.data;
                    this.users[this.index] = this.user;
                    Toast.fire({
                        icon: "success",
                        title: "Usuario" + this.user.name + " Habilatado",
                        background: "#E7FFD7"
                    });
                });
        },
        deleteUser(index, user) {
            this.user = user;
            this.index = this.paginate.from + parseInt(index - 1);
            swal.fire({
                title: "Esta seguro?",
                text: this.user.name + " sera bloqueado del sistema!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete(`api/users/delete/${this.user.id}`)
                        .then(response => {
                            if (response.data.isValid) {
                                this.users[this.index].deleted_at = new Date();
                                Toast.fire({
                                    icon: "success",
                                    title: response.data.msj,
                                    background: "#E7FFD7"
                                });
                            } else {
                                Toast.fire({
                                    icon: "error",
                                    title: response.data.msj,
                                    background: "#FCDBCD"
                                });
                            }
                        });
                }
            });
        },
        edit(index, user) {
            this.user = user;
            this.index = this.paginate.from + parseInt(index - 1);
            this.create = true;
        },
        buscarUser() {
            clearTimeout(this.setTimeoutBuscador);
            this.setTimeoutBuscador = setTimeout(() => {
                axios.get(`api/users/${this.search}`).then(response => {
                    this.asignar(response);
                });
            }, this.timeOut);
        },
        asignar(response) {
            this.users = response.data.data;
            this.paginate.current_page = response.data.current_page;
            this.paginate.last_page = response.data.last_page;
            this.paginate.total = response.data.total;
            this.paginate.path = response.data.path;
            this.paginate.from = response.data.from;
            this.paginate.to = response.data.to;
            this.paginate.next_page_url = response.data.next_page_url;
            this.paginate.prev_page_url = response.data.prev_page_url;
        },
        paginacion: function() {
            axios.get(`api/users/paginate/${this.perPage}`).then(response => {
                this.asignar(response);
            });
        },
        filter: function() {
            axios.get(`api/users/filter/${this.selectedRol}`).then(response => {
                this.asignar(response);
            });
        }
    }
};
</script>
