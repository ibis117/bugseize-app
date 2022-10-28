import { createRouter, createWebHistory } from 'vue-router'


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
                    path:'',
                    name: 'dashboard',
                    component: () => import('../pages/Dashboard.vue')
                }
            ]
        }
    ]
})

export default router
