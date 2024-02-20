// Composables
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    component: () => import('@/layouts/default/Default.vue'),
    children: [
      {
        path: '',
        name: 'Home',
        component: () => import(/* webpackChunkName: "home" */ '@/views/home/Home.vue'),
        
      },
      {
        path: 'vehicules', 
        name: 'Vehicules',
        component: () => import(/* webpackChunkName: "vehicules" */ '@/views/home/Vehicules.vue'),
      },
      {
        path: 'login', 
        name: 'Login',
        component: () => import(/* webpackChunkName: "login" */ '@/views/home/Login.vue'),
      },
      {
        path: 'admin', 
        name: 'Admin',
        component: () => import(/* webpackChunkName: "login" */ '@/views/admin/Admin.vue'),
      },
      {
        path:'adminvehicules',
        name:'AdminVehicules',
        component: () => import(/* webpackChunkName: "login" */ '@/views/admin/AdminVehicules.vue'),
      },
      {
        path:'adminemploye',
        name:'AdminEmploye',
        component: () => import(/* webpackChunkName: "login" */ '@/views/admin/AdminEmploye.vue'),
      }
      ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
})

export default router

