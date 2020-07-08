/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');




window.Vue = require('vue');

var Paginate = require('vue-paginate')


import Swal from 'sweetalert2/dist/sweetalert2.js'

import 'sweetalert2/src/sweetalert2.scss'
  
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Vue.component('paginate', Paginate)
Vue.component('panel-component', require('./components/PanelComponent.vue').default);
Vue.component('filter-component', require('./components/FilterComponent.vue').default);
Vue.component('filtroperiodo-component', require('./components/FilterPeriodoComponent.vue').default);
Vue.component('filtertipoliquidacion-component', require('./components/FilterTipoLiquidacionComponent.vue').default);
Vue.component('buscaragente-component', require('./components/BuscarAgenteComponent.vue').default);
//Vue.component('footer-component', require('./components/FooterComponent.vue').default);
Vue.component('jurisdiccion-component', require('./components/JurisdiccionComponent.vue').default);
Vue.component('categoria-component', require('./components/CategoriaComponent.vue').default);
Vue.component('clase-component', require('./components/ClaseComponent.vue').default);
Vue.component('filtroclase-component', require('./components/FiltroClaseComponent.vue').default);
Vue.component('panelclase-component', require('./components/PanelClaseComponent.vue').default);
Vue.component('filtrocategoria-component', require('./components/FiltroCategoriaComponent.vue').default);
Vue.component('panelcategoria-component', require('./components/PanelCategoriaComponent.vue').default);

Vue.component('listaliquidaciones-component', require('./components/ListLiquidacionesCompnent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});