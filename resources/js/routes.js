import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../js/components/Home'
import Resultados from './components/Resultados'
import Loading from "./components/Loading";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/resultados',
            name: 'resultados',
            component: Resultados
        },
        {
            path: '/loading',
            name: 'loading',
            component: Loading
        } ,
        {
            path: '*',
            name: '',
            component: Home
        }
    ]
});

export default router;