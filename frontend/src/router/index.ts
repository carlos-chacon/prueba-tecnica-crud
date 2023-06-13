import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/products',
      name: 'products',
      component: () => import('../views/ProductsView.vue'),
    },
    {
      path: '/products/new',
      name: 'product-new',
      component: () => import('../modules/products/components/ProductNew.vue'),
    },
    {
      path: '/products/edit/:id',
      name: 'product-edit',
      component: () => import('../modules/products/components/ProductNew.vue'),
    }
  ]
})

export default router
