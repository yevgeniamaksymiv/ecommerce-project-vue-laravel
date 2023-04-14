import { createRouter, createWebHistory } from 'vue-router';
import HomeComponent from '@/components/HomeComponent.vue';
import store from '@/store/index';

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
    path: '/accessories',
    name: 'accessories',
    component: () => import('@/components/AccessoriesComponent.vue'),
  },
  {
    path: '/latest',
    name: 'latest',
    component: () => import('@/components/NewProductsComponent.vue'),
  },
  {
    path: '/product/:id',
    name: 'product',
    component: () => import('@/components/ProductComponent.vue'),
  },
  {
    path: '/cart',
    name: 'cart',
    component: () => import('@/components/CartComponent.vue'),
  },
  {
    path: '/order',
    name: 'order',
    component: () => import('@/components/OrderComponent.vue'),

    beforeEnter: (to, from, next) => {
      const isAuth = store._state.data.userModule.isAuthenticate;
      if (to.name !== 'login' && !isAuth) {
        next({ name: 'login' });
      } else {
        next();
      }
    },
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
