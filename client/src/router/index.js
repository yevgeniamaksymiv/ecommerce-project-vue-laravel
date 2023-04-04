import { createRouter, createWebHistory } from 'vue-router'
import HomeComponent from '@/components/HomeComponent.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeComponent,
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/components/LoginComponent.vue'),
  },
  {
    path: '/clothes',
    name: 'clothes',
    component: () => import('@/components/ClothesComponent.vue'),
  },
  {
    path: '/product/:id',
    name: 'product',
    component: () => import('@/components/ProductComponent.vue'),
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

