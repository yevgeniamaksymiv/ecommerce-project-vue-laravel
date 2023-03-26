import { createRouter, createWebHistory } from 'vue-router'
import HomeComponent from '@/components/HomePage/HomeComponent.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeComponent,
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/components/LoginPage/LoginComponent.vue'),
  },
  {
    path: '/',
    name: '',
    component: () => '',
  },
  {
    path: '/404',
    name: '404',
    component: () => '',
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: '/404',
  },
];

  const router = createRouter({
    linkActiveClass: 'active',
    linkExactActiveClass: 'exact-active',
    history: createWebHistory(),
    routes,
  });

  export default router;

