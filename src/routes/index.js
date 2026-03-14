import { createRouter, createWebHistory } from 'vue-router'

import Login from '../views/auth_views/Login.vue'
import Register from '../views/auth_views/Register.vue'
import Index from '../views/auth_views/Index.vue'
import IndexClient from '../views/client_views/IndexClient.vue'
import Transactions from '../views/client_views/Transactions.vue'

const routes = [
  {
    path: '/',
    component: Index
  },
  {
    path: '/login',
    component: Login
  },
  {
    path: '/register',
    component: Register
  },
  {
    path: '/index/client',
    component: IndexClient,
    meta: { requiresAuth: true }
  },
  {
    path: '/client/transactions',
    component: Transactions,
    meta: { requiresAuth: true }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {

  const token = localStorage.getItem('token')

  if (to.meta.requiresAuth && !token) {
    next('/login')
  } else {
    next()
  }

})

export default router