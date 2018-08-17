
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./../../../bootstrap');

window.Vue = require('vue');
window.vuelidate = require('vuelidate');
window.vSelect = require('vue-select');
window.axios = require('axios');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(vuelidate.default);
Vue.component('v-select', vSelect.VueSelect);
Vue.component('method-create-vue', require('./../../../components/system/module/create.vue'));

const app = new Vue({
    validations: {},
    el: '#methodCreateVue'
    
});