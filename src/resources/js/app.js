/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from "vue";
import Vuelidate from 'vuelidate'
import axios from 'axios'
import router from "./components/router";
import App from "./components/App.vue"

Vue.use(Vuelidate)


require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    axios,
    el: '#app',
    render: h => h(App)
});

// router.beforeEach((to, from, next) => {
//     const token = localStorage.getItem('X-XSRF-TOKEN');

//     if ((to.name !== 'user.login' && to.name !== 'user.regist') && !token) {
//         next({ name: 'user.regist' })
//     }
//     if ((to.name === 'user.login' || to.name == 'user.regist') && token) {

//     }
//     next()

// })
