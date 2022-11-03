
import * as VueRouter from "vue-router";
import Welcome from '../components/Welcome.vue'
import Login from '../pages/auth/Login'
import Register from '../pages/auth/Register'
import Main from '../pages/Main'
import Dashboard from '../pages/dashboard/Dashboard'
import Subscriptions from "../pages/dashboard/Subscriptions";
import Auth from '../Auth';

const routes=[
    {
        name: 'main',
        path: '/',
        component: Main,
        children: [
            {
                name: 'register',
                path: 'auth/register',
                component: Register
            },
            {
                name: 'login',
                path: 'auth/login',
                component: Login
            },
            {
                path:'/',
                name:'dashboard',
                component:Dashboard,
                meta: {
                    requiresAuth: true
                }
            },
            {
                path:'manage-subscriptions',
                name:'subscriptions',
                component:Subscriptions,
                meta: {
                    requiresAuth: true
                }
            },
        ]
    },
    // {
    //     path:'/',
    //     name:'home',
    //     component:Welcome,
    // },
    
]

const router = VueRouter.createRouter({
    history:VueRouter.createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth) ) {
        if (Auth.check()) {
            next();
            return;
        } else {
            router.push('/auth/login');
        }
    } else {
        next();
    }
});

export default router
    
