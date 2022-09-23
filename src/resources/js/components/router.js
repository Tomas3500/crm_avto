import Vue from "vue";
import VueRouter from 'vue-router'
Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/user/regist', component: () => import('./layout/RegistComponent'),
            name: 'user.regist'
        },

        {
            path: '/user/login', component: () => import('./layout/LoginComponent'),
            name: 'user.login',
        },

        {
            path: '/cabinet', component: () => import('./HomeCrmComponent'),
            name: 'user.cabinet',

        },

        {
            path: '/clint', component: () => import('./views/Clints'),
            name: 'clint'

        },

        {
            path: '/cars', component: () => import('./views/Cars'),
            name: 'cars'

        },


        {
            path: '/status', component: () => import('./views/Status'),
            name: 'status'

        },

        {
            path: '*', component: () => import('./NotFound'),
            name: 'nodfound'

        },

    ]
})

