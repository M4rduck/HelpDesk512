
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./../../bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Incidence Components
 */
Vue.component('v-select', vSelect.VueSelect);

Vue.component('incidence-create-form', require('./../../components/incidence/incidence_create.vue'));

const incidence = new Vue({
    el: '#incidence_create_form'
});
