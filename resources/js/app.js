/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('error-messages', require('./components/Common/Errors.vue').default);
Vue.component('borrower', require('./components/Borrowers/Index.vue').default);
Vue.component('borrower-form', require('./components/Borrowers/Form.vue').default);
Vue.component('borrower-view', require('./components/Borrowers/View.vue').default);
Vue.component('grouping', require('./components/Settings/Groupings/Index.vue').default);
Vue.component('grouping-form', require('./components/Settings/Groupings/Form.vue').default);
Vue.component('company-form', require('./components/Settings/Companies/Form.vue').default);
Vue.component('dashboard', require('./components/Common/Dashboard.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
