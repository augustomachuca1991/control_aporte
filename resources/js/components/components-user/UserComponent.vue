<template>
    <div id="lista_usuarios">
        <div class="container">
            <h2 class="text-center display-4 text-muted">Usuarios</h2>
            <form>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <button
                                        type="button"
                                        class="btn btn-block btn-outline-info"
                                    >
                                        + Nuevo Usuario
                                    </button>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <select
                                        class="form-control"
                                        style="width: 100%;"
                                    >
                                        <option selected>10 por pagina</option>
                                        <option>25 por pagina</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <select
                                        class="form-control"
                                        style="width: 100%;"
                                    >
                                        <option selected>Nombre</option>
                                        <option>Fecha</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input
                                    type="search"
                                    class="form-control form-control-lg"
                                    placeholder="Buscar Nombre, Email, Rol, etc..."
                                    @keyup="buscar"
                                    v-model="search"
                                />

                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-lg btn-default"
                                    >
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                                        <b>Roles: </b>
                                        {{ user.roles[0].rol }}/ Arg / Graphic
                                        Artist / Coffee Lover
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small">
                                            <span class="fa-li"
                                                ><i class="fas fa-lg fa-at"></i
                                            ></span>
                                            Mail: {{ user.email }}
                                        </li>
                                        <li class="small">
                                            <span class="fa-li"
                                                ><i
                                                    class="fas fa-lg fa-phone"
                                                ></i
                                            ></span>
                                            Telefo #: + 800 - 12 12 23 52
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
                                    @click="bloquear(index, user)"
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
            <div v-if="!users.lenght">
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
export default {
    data: function() {
        return {
            users: [],
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
            timeOut: 400
        };
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        getUsers: function() {
            axios.get("api/users").then(response => {
                this.asignar(response);
            });
        },
        desbloquear: function(index, user) {
            //console.log(user.id);
            axios.get(`api/users/desbloquear/` + user.id).then(response => {
                this.users[index].deleted_at = "";
                this.users[index] = response.data;
                alert("usuario desbloqueado: " + response.data);
            });
        },
        bloquear: function(index, user) {
            axios.delete(`api/users/delete/` + user.id).then(response => {
                let hoy = new Date();
                this.users[index].deleted_at = hoy;
                alert("usuario bloqueado: " + response.data);
            });
        },
        edit(index, user) {
            this.user = user;
            this.index = this.paginate.from + parseInt(index - 1);
            this.create = true;
        },
        buscar: function() {
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
        }
    }
};
</script>
