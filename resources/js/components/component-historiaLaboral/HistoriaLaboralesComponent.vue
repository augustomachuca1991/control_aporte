<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card card-outline card-orange">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Buscar por Puestos Laborales
                                </h3>

                                <div class="card-tools">
                                    <button
                                        type="button"
                                        class="btn btn-tool"
                                        data-card-widget="collapse"
                                    >
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div
                                class="card-body"
                                style="min-height: 135px; height: 135px; max-height: 135px; max-width: 100%;"
                            >
                                <form
                                    @submit.prevent="buscarPuesto()"
                                    method="POST"
                                >
                                    <label
                                        for="peusto_laboral"
                                        class="text-muted"
                                        ><i class="fas fa-search"></i> Buscar
                                        Puesto Laboral</label
                                    >
                                    <div class="input-group">
                                        <input
                                            class="form-control"
                                            placeholder="Buscar... "
                                            aria-label="Recipient's username"
                                            aria-describedby="button-addon2"
                                            name="puesto_laboral"
                                            id="puesto_laboral"
                                            v-model="cod_laboral"
                                            required
                                        />
                                        <div class="input-group-append">
                                            <button
                                                class="btn btn-outline-secondary"
                                                type="submit"
                                                id="button-addon2"
                                            >
                                                <i
                                                    class="fas fa-address-card"
                                                ></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <span
                                    class="errors text-danger"
                                    v-for="error in errors.puesto_laboral"
                                    :key="error.id"
                                >
                                    <small
                                        ><em>{{ error }}</em></small
                                    >
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- DONUT CHART -->
                        <div class="card card-outline card-orange">
                            <div class="card-header">
                                <h3 class="card-title">Bucar Por Cuil</h3>

                                <div class="card-tools">
                                    <button
                                        type="button"
                                        class="btn btn-tool"
                                        data-card-widget="collapse"
                                    >
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div
                                class="card-body"
                                style="min-height: 135px; height: 135px; max-height: 135px; max-width: 100%;"
                            >
                                <buscaragente-component
                                    @buscarAgente="datos_agente(...arguments)"
                                ></buscaragente-component>
                                <span
                                    class="errors text-danger"
                                    v-for="error in errors.cuil"
                                    :key="error.id"
                                >
                                    <small
                                        ><em>{{ error }}</em></small
                                    >
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col (LEFT) -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-gradient-orange">
                                <h3 class="card-title text-white">
                                    Historias Laborales
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <p v-if="!isAgente" class="text-center">
                                    Sin resultados encontrados
                                </p>
                                <div v-else>
                                    <div v-if="shown">
                                        <div
                                            class="text-center content-center my-5"
                                        >
                                            Espere...
                                            <span>
                                                <img
                                                    height="80px"
                                                    src="image/ips_loading.gif"
                                                />
                                            </span>
                                        </div>
                                    </div>
                                    <div
                                        v-else
                                        class="timeline timeline-inverse"
                                    >
                                        <div class="time-label">
                                            <span>Ficha Del Empleado </span>
                                        </div>
                                        <div>
                                            <i
                                                class="fas fa-address-card bg-blue"
                                            ></i>
                                            <div class="timeline-item">
                                                <span class="time"
                                                    ><i
                                                        class="fas fa-clock"
                                                    ></i>
                                                    Fecha de Nacimiento:
                                                    {{ agente.fecha_nac }}</span
                                                >
                                                <h3 class="timeline-header">
                                                    <a href="#"
                                                        >Datos Personales</a
                                                    >
                                                </h3>

                                                <div class="timeline-body">
                                                    <dl>
                                                        <dt>
                                                            Nombre Agente
                                                        </dt>
                                                        <dd>
                                                            {{ agente.nombre }}
                                                        </dd>
                                                        <dt>Cuil</dt>
                                                        <dd>
                                                            {{
                                                                agente.cuil
                                                                    | formatCuil
                                                            }}
                                                        </dd>
                                                        <dt>Edad</dt>
                                                        <dd>
                                                            {{
                                                                agente.fecha_nac
                                                            }}
                                                        </dd>
                                                        <dt>Sexo</dt>
                                                        <dd>
                                                            {{ agente.sexo }}
                                                        </dd>
                                                        <dt>
                                                            Puestos Laborales
                                                            ({{
                                                                organismos.length
                                                            }})
                                                        </dt>
                                                        <ul>
                                                            <li
                                                                v-for="(organismo,
                                                                index) in organismos"
                                                                :key="index"
                                                            >
                                                                Puesto Laboral:
                                                                #{{
                                                                    organismo
                                                                        .puesto_laboral
                                                                        .cod_laboral
                                                                }}
                                                                <button
                                                                    class="btn btn-outline-info  btn-xs rounded-pill"
                                                                    @click="
                                                                        cargo(
                                                                            index,
                                                                            organismo
                                                                        )
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-eye"
                                                                    ></i>
                                                                    {{
                                                                        organismo.organismo
                                                                    }}
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </dl>
                                                </div>
                                                <div class="timeline-footer">
                                                    <span
                                                        class="errors text-danger"
                                                        v-for="error in errors.historialaborales"
                                                        :key="error.id"
                                                    >
                                                        <small
                                                            ><em>{{
                                                                error
                                                            }}</em></small
                                                        >
                                                    </span>
                                                    <!-- <a class="btn btn-danger btn-sm">Delete</a> -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- The last icon means the story is complete -->
                                        <div>
                                            <i class="fas fa-clock bg-gray"></i>
                                            <div class="timeline-item">
                                                <!-- Time -->
                                                <span class="time"
                                                    ><i
                                                        class="fas fa-clock"
                                                    ></i>
                                                    12:05</span
                                                >
                                                <!-- Header. Optional -->
                                                <h3 class="timeline-header">
                                                    <a
                                                        href="#"
                                                        class="text-dark"
                                                        >Historia Laboral</a
                                                    >
                                                    cronologia
                                                </h3>
                                                <!-- Body -->
                                                <div class="timeline-body">
                                                    <div
                                                        class="shadow"
                                                        id="timeline"
                                                        style="height: 250px; border: 1px solid #ccc"
                                                    ></div>
                                                </div>
                                                <!-- Placement of additional controls. Optional -->
                                                <div class="timeline-footer">
                                                    <a
                                                        class="btn bg-gradient-secondary btn-sm"
                                                        ><i
                                                            class="fas fa-print"
                                                        ></i>
                                                        Imprimir</a
                                                    >
                                                    <a
                                                        class="btn bg-gradient-orange btn-sm"
                                                        @click="empty()"
                                                        ><i
                                                            class="fas fa-broom"
                                                        ></i
                                                        >&nbsp;Limpiar</a
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
</template>

<script type="text/javascript">
export default {
    data: function() {
        return {
            errors: [],
            datos: [],
            organismos: [],
            agente: {},
            puesto_laboral: {},
            shown: false,
            isAgente: false,
            isPuesto: false,
            timeOut: 300,
            index: "",
            organismo: {}
        };
    },
    mounted() {
        console.log("agente filter component mounted");
        google.charts.load("current", { packages: ["timeline"] });
    },
    methods: {
        datos_agente: function(input) {
            this.isAgente = true;
            this.cuil = input.search;
            this.getAgente();
        },
        drawChart: function(organismo, index) {
            var container = document.getElementById("timeline");
            var chart = new google.visualization.Timeline(container);

            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({ type: "string", id: "Puesto_laboral" });
            dataTable.addColumn({ type: "string", id: "Name" });
            dataTable.addColumn({ type: "date", id: "Start" });
            dataTable.addColumn({ type: "date", id: "End" });

            var fecha_egreso;
            if (organismo.puesto_laboral.fecha_egreso) {
                fecha_egreso = new Date(organismo.puesto_laboral.fecha_egreso);
            } else {
                fecha_egreso = new Date();
            }
            this.datos.push([
                "PL: " + organismo.puesto_laboral.cod_laboral,
                organismo.organismo,
                new Date(organismo.puesto_laboral.fecha_ingreso),
                fecha_egreso
            ]);

            dataTable.addRows(this.datos);

            var option = {
                colors: ["#fd9036", "#fd7e14"],
                backgroundColor: "#fff"
            };

            chart.draw(dataTable, option);
        },
        empty: function() {
            this.agente = {};
            this.organismos = [];
            this.isAgente = false;
            this.isPuesto = false;
            this.datos = [];
        },
        cargo: function(index, organismo) {
            this.index = index;
            this.puesto_laboral = organismo.puesto_laboral;
            this.organismo = organismo;
            this.isPuesto = true;
            google.charts.setOnLoadCallback(
                this.drawChart(this.organismo, this.index)
            );
        },
        buscarPuesto() {
            this.isAgente = true;
            axios
                .get(`api/agente/puesto/${this.cod_laboral}`)
                .then(response => {
                    if (response.data.isError) {
                        this.errors = response.data.data;
                    } else {
                        this.shown = true;
                        setTimeout(() => {
                            this.agente = response.data.data;
                            this.organismos = this.agente.organismos;
                            this.shown = false;
                        }, this.timeOut);
                    }
                });
        },
        getAgente() {
            axios.get(`api/agente/${this.cuil}`).then(response => {
                if (response.data.isError) {
                    this.errors = response.data.data;
                } else {
                    this.shown = true;
                    setTimeout(() => {
                        this.agente = response.data.data;
                        this.organismos = this.agente.organismos;
                        this.shown = false;
                    }, this.timeOut);
                }
            });
        }
    },
    filters: {
        formatCuil: function(value) {
            value = value.toString();
            if (value.length == 10) {
                value = "0" + value;
            }

            var last = value.slice(-1);
            var dni = value.slice(2, -1);
            var first = value.charAt(0) + value.charAt(1);

            return first + "-" + dni + "-" + last;
        }
    }
};
</script>
