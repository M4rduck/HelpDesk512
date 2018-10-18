
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.VuePaginate = require('vue-paginate');

/**
 * Solicutdes Components
 */
Vue.use(VuePaginate);
Vue.component('v-select', vSelect.VueSelect);
Vue.component('vue-element-loading',loading);
Vue.component('solicitudes-table', require('./../../components/incidence/solicitude_table.vue'));
Vue.component('solicitude-create-form', require('./../../components/incidence/solicitude_create.vue'));

const solicitudes = new Vue({
    el: '#solicitudes'
});
