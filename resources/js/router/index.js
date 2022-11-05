import {createRouter, createWebHistory} from 'vue-router'
import {useAuthStore} from "../stores/auth-store";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/login',
            name: 'login',
            component: () => import('../pages/auth/LoginPage.vue')
        },
        {
            path: '/',
            component: () => import('../layouts/Index.vue'),
            children: [
                {
                    path: '',
                    name: 'dashboard',
                    component: () => import('../pages/Dashboard.vue')
                },

                {
                    path: '/project',
                    name: 'project',
                    component: () => import('../pages/project/ListProject.vue')
                },
                {
                    path: '/project/:id',
                    name: 'show-project',
                    component: () => import('../pages/project/ShowProject.vue')
                },

                {
                    path: '/exception',
                    name: 'exception',
                    component: () => import('../pages/exception/ListException.vue')
                },

                {
                    path: '/exception/:id',
                    name: 'show-exception',
                    component: () => import('../pages/exception/ShowException.vue')
                },

            ]
        }
    ]
})

router.beforeEach(async (to, from) => {
    const isAuthenticated = useAuthStore().isAuth;
    if (!isAuthenticated && to.path !== '/login') {
        return '/login';
    }
    if (isAuthenticated && to.path === '/login') {
        return '/';
    }
})

export default router
