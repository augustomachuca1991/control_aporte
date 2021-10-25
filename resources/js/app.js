/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
var VuePaginate = require("vue-paginate");
var moment = require("moment"); // require

// import Swal from 'sweetalert2/dist/sweetalert2.js'
// import 'sweetalert2/src/sweetalert2.scss'

import { GridPlugin } from "@syncfusion/ej2-vue-grids";
import "@syncfusion/ej2-vue-grids/styles/material.css";
import Vue from "vue";

//MonthPicker
import MonthPicker from "vue-month-picker";
import MonthPickerInput from "vue-month-picker";

//filtro general
Vue.filter("capitalize", function(value) {
    if (!value) return "";
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});
// filtro moment
Vue.filter("moment", function(date) {
    return moment(date)
        .locale("es")
        .fromNow();
});

Vue.filter("format_moment", function(date) {
    return moment(date).format("L");
});

// Vue.filter('formatCuil', function(cuil){
// 	value = value.toString();

// 	  if (value.length === 10 ) {
// 	    value = '0'+value;
// 	  }

// 	  return value.charAt(0)+value.charAt(1)+'-'+value.slice(2,-1)+'-'+value.slice(-1);
// })

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/HistoriaLaboralesComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(GridPlugin);
Vue.use(VuePaginate);
Vue.use(MonthPicker);
Vue.use(MonthPickerInput);
//Vue.use(moment);
Vue.component(
    "panel-component",
    require("./components/PanelLiquidacionComponent.vue").default
);
Vue.component(
    "filter-component",
    require("./components/FiltroComponent.vue").default
);
Vue.component(
    "filtroperiodo-component",
    require("./components/FiltroPeriodoComponent.vue").default
);
Vue.component(
    "filtertipoliquidacion-component",
    require("./components/FiltroTipoLiquidacionComponent.vue").default
);
Vue.component(
    "filter-component",
    require("./components/FiltroComponent.vue").default
);
Vue.component(
    "filtroperiodo-component",
    require("./components/FiltroPeriodoComponent.vue").default
);
Vue.component(
    "filtertipoliquidacion-component",
    require("./components/FiltroTipoLiquidacionComponent.vue").default
);
Vue.component(
    "buscaragente-component",
    require("./components/BuscarAgenteComponent.vue").default
);

Vue.component(
    "filtroclase-component",
    require("./components/FiltroClaseComponent.vue").default
);

Vue.component(
    "filtrocategoria-component",
    require("./components/FiltroCategoriaComponent.vue").default
);
Vue.component(
    "panelcategoria-component",
    require("./components/PanelCategoriaComponent.vue").default
);
Vue.component(
    "panelcomputo-component",
    require("./components/PanelComputoComponent.vue").default
);

Vue.component(
    "historialaborales-component",
    require("./components/HistoriaLaboralesComponent.vue").default
);
Vue.component(
    "panel-historialaboral",
    require("./components/PanelHistoriaComponent.vue").default
);

Vue.component(
    "listaliquidaciones-component",
    require("./components/ListLiquidacionesComponent.vue").default
);
Vue.component(
    "liquidaciondetalle-component",
    require("./components/LiquidacionDetalleComponent.vue").default
);

//computos
Vue.component(
    "computoorigen-component",
    require("./components/ComputoOrigenComponent.vue").default
);
Vue.component(
    "computojur-component",
    require("./components/ComputoJurisdiccionComponent.vue").default
);
Vue.component(
    "computoorganismo-component",
    require("./components/ComputoOrganismoComponent.vue").default
);

//csv
Vue.component(
    "import-component",
    require("./components/ImportComponent.vue").default
);
Vue.component(
    "export-component",
    require("./components/ExportComponent.vue").default
);

//declaraciones juradas
Vue.component(
    "ddjj-component",
    require("./components/DeclaracionJuradaComponent.vue").default
);

//notificaticion
Vue.component(
    "notification-component",
    require("./components/NotificacionComponent.vue").default
);

//panel lateral
Vue.component(
    "panel-config",
    require("./components/PanelConfiguracionComponent.vue").default
);

//usuarios
//panel lateral
Vue.component(
    "users-component",
    require("./components/UserComponent.vue").default
);

Vue.component(
    "home-component",
    require("./components/HomeComponent.vue").default
);

//periodo
Vue.component(
    "periodo-component",
    require("./components/components-periodo/PeriodoComponent.vue").default
);
Vue.component(
    "create-periodo",
    require("./components/components-periodo/CreatePeriodo.vue").default
);
Vue.component(
    "update-periodo",
    require("./components/components-periodo/UpdatePeriodo.vue").default
);

//organismos
Vue.component(
    "organismo-component",
    require("./components/components-organismo/OrganismoComponent.vue").default
);
Vue.component(
    "create-organismo",
    require("./components/components-organismo/CreateOrganismo.vue").default
);
Vue.component(
    "update-organismo",
    require("./components/components-organismo/UpdateOrganismo.vue").default
);

//clases
Vue.component(
    "clase-component",
    require("./components/components-clase/ClaseComponent.vue").default
);
Vue.component(
    "create-clase",
    require("./components/components-clase/CreateClase.vue").default
);
Vue.component(
    "update-clase",
    require("./components/components-clase/UpdateClase.vue").default
);

//categorias
Vue.component(
    "categoria-component",
    require("./components/components-categoria/CategoriaComponent.vue").default
);
Vue.component(
    "create-categoria",
    require("./components/components-categoria/CreateCategoria.vue").default
);
Vue.component(
    "update-categoria",
    require("./components/components-categoria/UpdateCategoria.vue").default
);

//jurisdiccion
Vue.component(
    "jurisdiccion-component",
    require("./components/components-jurisdiccion/JurisdiccionComponent.vue")
        .default
);
Vue.component(
    "create-jurisdiccion",
    require("./components/components-jurisdiccion/CreateJurisdiccion.vue")
        .default
);
Vue.component(
    "update-jurisdiccion",
    require("./components/components-jurisdiccion/UpdateJurisdiccion.vue")
        .default
);

//conceptos
Vue.component(
    "concepto-component",
    require("./components/components-concepto/ConceptoComponent.vue").default
);
Vue.component(
    "create-concepto",
    require("./components/components-concepto/CreateConcepto.vue").default
);
Vue.component(
    "update-concepto",
    require("./components/components-concepto/UpdateConcepto.vue").default
);

//paginador
Vue.component(
    "paginator-component",
    require("./components/components-paginator/PaginatorComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
