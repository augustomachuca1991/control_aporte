<template>
    <div class="container" v-if="shown">
		{{search}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"
                    ><i class="fas fa-search"></i
                ></span>
            </div>
            <input
                type="text"
                class="form-control"
                placeholder="search"
                v-model="search"
                @keyup="buscar()"
            />
        </div>
        <paginate
            name="dd_jj"
            :list="declaraciones_juradas"
            :per="8"
            ref="paginator"
            class="pl-0"
        >
            <div
                v-if="declaraciones_juradas.length === 0"
                class="card card-outline card-dark"
            >
                <div class="card-hearder">
                    Declaraciones Juradas
                </div>
                <div class="card-body">
                    No hay datos
                </div>
            </div>
            <div
                v-else
                v-for="declaracion_jurada in paginated('dd_jj')"
                :key="declaracion_jurada.id"
                class="card card-outline card-secondary"
            >
                <div class="card-hearder">
                    <div
                        class="d-flex w-100 justify-content-between text-muted px-4 py-2"
                    >
                        <h4 class="mb-1">Declaraciones Juradas</h4>
                        <small
                            ><i class="fas fa-calendar-alt"></i>&nbsp;{{ declaracion_jurada.created_at | moment }}</small
                        >
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a
                                class="btn"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="Descargar declaracion jurada"
                                @click="download(declaracion_jurada.path)"
                            >
                                <i
                                    class="far fa-file-excel fa-5x text-olive"
                                ></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <ul class="list-unstyled">
                                <li>
                                    {{
                                        declaracion_jurada.organismo.organismo
                                            | capitalize
                                    }}
                                </li>
                                <li>
                                    {{ declaracion_jurada.periodo.periodo }}
                                </li>
                                <li>
                                    {{
                                        declaracion_jurada.tipoliquidacion
                                            .descripcion
                                    }}
                                </li>
                            </ul>
                        </div>
                            <div class="col-md-6">
							<button type="button" @click="download(declaracion_jurada.path)" class="btn btn-outline-info btn-block btn-sm"><i class="fas fa-file-download"></i> descargar</button>
							<button type="button" class="btn btn-outline-danger btn-block btn-sm"><i class="fa fa-book"></i> detalle</button>
							</div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-muted text-sm">
                            <i class="far fa-clock"></i
                            >&nbsp;{{ declaracion_jurada.created_at | moment }} |
                            <i class="far fa-user"></i
                            >&nbsp;subido por {{ declaracion_jurada.user.name | capitalize }} |
							&nbsp;
                            <span
                                v-if="declaracion_jurada.deleted_at"
                                class="badge bg-danger"
                                >inactivo</span
                            >
                            <span v-else class="badge bg-olive">activo</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <table class="table table-sm">
			      <caption>
			          <span v-if="$refs.paginator">
						 mostrando {{$refs.paginator.pageItemsCount}} resultados
					  </span>
			      </caption>
			      <thead>
			        <tr>
			          <th scope="col">Usuario</th>
			          <th scope="col">Fecha de Importacion</th>
			          <th scope="col">Organismo</th>
			          <th scope="col">Tipo Liquidacion</th>
			          <th scope="col">Periodo</th>
			          <th scope="col">Archivo</th>
			          <th scope="col"></th>
			        </tr>
			      </thead>
			      <tbody>
			        <tr v-if="declaraciones_juradas.length === 0" class="table-default text-center">
			          <td colspan="7">No hay datos</td>
			        </tr>
			        <tr v-else v-for="(declaracion_jurada, index) in paginated('dd_jj') " :key="declaracion_jurada.id">
			          <th scope="row">{{declaracion_jurada.user.name | capitalize}}</th> 
			          <td>{{declaracion_jurada.created_at | moment}}</td>
			          <td>{{declaracion_jurada.organismo.organismo | capitalize}}</td>
			          <td>{{declaracion_jurada.tipoliquidacion.descripcion}}</td>
			          <td>{{declaracion_jurada.periodo.periodo}}</td>
			          <td>{{declaracion_jurada.nombre_archivo}}</td>
			          <td>
			              <a class="btn btn-outline-info text-info btn-sm border-0" data-toggle="tooltip" data-placement="bottom" title="Descargar declaracion jurada" @click="download(declaracion_jurada.path)">
			              	<i class="fas fa-download"></i>
			              </a>
			              <a class="btn btn-outline-primary btn-sm text-primary border-0" @click="getDetalles(declaracion_jurada.id)">
			              	<i class="far fa-eye"></i>
			              </a> 
			          </td>
			        </tr>
			      </tbody>
			      
			    </table> -->
        </paginate>

        <paginate-links
            for="dd_jj"
            :async="true"
            :show-step-links="true"
            :step-links="{
                next: '»',
                prev: '«'
            }"
            :classes="{ ul: 'pagination', li: 'page-item', a: 'page-link' }"
            :hide-single-page="true"
            :limit="5"
        >
        </paginate-links>
		<span v-if="$refs.paginator" class="d-flex justify-content-end text-muted">
			Mostrando {{$refs.paginator.pageItemsCount}} resultados
		</span>
        <!-- <a class="btn btn-primary shadow text-white">
					aplicadas <i class="fas fa-check"></i>
				</a> -->

        <table class="table" v-if="detalles.length > 0">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>NOMBRE</th>
                    <th>CUIL</th>
                    <th>FECHA DE NACIMIENTO</th>
                    <th>PUESTO LABORAL</th>
                    <th>CARGO</th>
                    <th>FECHA INGRESO</th>
                    <th>COD CATEGORIA</th>
                    <th>CATEGORIA</th>
                    <th>COD CLASE</th>
                    <th>CLASE</th>
                    <th>COD ESTADO</th>
                    <th>ESTADO</th>
                    <th>COD ORGANISMO</th>
                    <th>ORGANISMO</th>
                </tr>
            </thead>
            <tbody v-for="(detalle, index) in detalles" :key="detalle.id">
                <tr
                    class="accordion-toggle collapsed table-light"
                    id="accordion1"
                    data-toggle="collapse"
                    data-parent="#accordion1"
                    :href="'#collapse' + detalle.id"
                >
                    <td class="expand-button text-primary"></td>
                    <th scope="row">{{ detalle.nombre }}</th>
                    <td>{{ detalle.cuil }}</td>
                    <td>{{ detalle.fecha_nac | format_moment }}</td>
                    <td>{{ detalle.puesto_laboral }}</td>
                    <td>{{ detalle.cargo }}</td>
                    <td>{{ detalle.fecha_ingreso | format_moment }}</td>
                    <td>{{ detalle.cod_categoria }}</td>
                    <td>{{ detalle.categoria }}</td>
                    <td>{{ detalle.cod_clase }}</td>
                    <td>{{ detalle.clase }}</td>
                    <td>{{ detalle.cod_estado }}</td>
                    <td>{{ detalle.estado }}</td>
                    <td>{{ detalle.cod_organismo }}</td>
                    <td>{{ detalle.organismo }}</td>
                </tr>
                <tr class="hide-table-padding">
                    <td colspan="15">
                        <div
                            :id="'collapse' + detalle.id"
                            class="collapse in p-3"
                        >
                            <div class="row">
                                <div class="col-3">Detalle Concepto:</div>
                                <div class="col-9">
                                    {{ detalle.detalle | pipe }}
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            declaraciones_juradas: [],
            detalles: [],
            title: "",
            paginate: ["dd_jj"],
            shown: false,
            search: ""
        };
    },
    mounted() {
        setTimeout(() => {
            axios.get("api/declaracion_jurada").then(response => {
                this.declaraciones_juradas = response.data;
                this.shown = true;
            });
        }, 0);
    },
    methods: {
        moment: function() {
            return moment().format("dd/mm/yyyy");
        },
        download: function(pathToFile) {
            const params = {
                path: pathToFile
            };
            axios
                .post("api/declaracion_jurada/download", params, {
                    responseType: "arraybuffer"
                })
                .then(response => {
                    //console.log(response.data)
                    var fileUrl = window.URL.createObjectURL(
                        new Blob([response.data])
                    );
                    var fileLink = document.createElement("a");
                    fileLink.href = fileUrl;

                    fileLink.setAttribute("download", "declaracionjurada.csv");
                    document.body.appendChild(fileLink);
                    fileLink.click();
                });
        },
        getDetalles(id) {
            axios.get(`api/declaracion_jurada/${id}`).then(response => {
                //console.log(response.data)
                this.detalles = response.data.ddjj_lines;
            });
        },
        buscar: function() {
            console.log(this.search);
        }
    },
    filters: {
        pipe: function(detalle) {
            var conceptos = detalle.split("|");
            var index = 0;
            var arrayLength = conceptos.length;
            var tempArray = [];

            for (index = 0; index < arrayLength; index += 6) {
                let concepto = conceptos.slice(index, index + 6);
                // Do something if you want with the group
                tempArray.push(concepto);
            }

            return tempArray;
        }
    }
};
</script>
