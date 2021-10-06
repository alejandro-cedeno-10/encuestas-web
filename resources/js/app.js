
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('bootstrap');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// import "./bootstrap"
import Vue from "vue"
import Route from '../js/routes.js'
import App from '../js/views/App'
import axios from "axios";
import LottieVuePlayer from '../js/plugins/LottieVuePlayer';
Vue.prototype.$axios = axios;

const app = new Vue({
    el: '#app',
    router: Route,
    LottieVuePlayer,
    render: h => h(App)
});

export default app;


