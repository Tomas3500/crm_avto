import Vue from "vue";
import VueRouter from 'vue-router'
Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/user/regist', component: () => import('./RegistComponent'),
            name: 'user.regist'
        },
        {
            path: '/user/login', component: () => import('./LoginComponent'),
            name: 'user.login'

        },

        {
            path: '/user/cabinet', component: () => import('./LoginComponent'),
            name: 'user.cabinet'

        },

    ]
})