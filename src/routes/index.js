import { createRouter, createWebHistory } from 'vue-router'

import Login from '../views/auth_views/Login.vue'
import Register from '../views/auth_views/Register.vue'
import Index from '../views/auth_views/Index.vue'
import IndexClient from '../views/client_views/IndexClient.vue'
import Transactions from '../views/client_views/Transactions.vue'
import Transactions_Paid from '../views/admin_views/Transaction_Paid.vue'
import Transactions_Pending from '../views/admin_views/Transaction_Pending.vue'
import Transactions_Faild from '../views/admin_views/Transaction_Faild.vue'
import Client_List from '../views/admin_views/Client_List.vue'
import IndexAdmin from '../views/admin_views/Index.vue'
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
  },

   {
    path: '/index/admin',
    component: IndexAdmin,
    meta: { requiresAuth: true }
  },

  {
    path: '/admin/pending_transactios',
    component: Transactions_Pending,
    meta: { requiresAuth: true }
  },

   {
    path: '/admin/paied_transactios',
    component: Transactions_Paid,
    meta: { requiresAuth: true }
  },

   {
    path: '/admin/faild_transactios',
    component: Transactions_Faild,
    meta: { requiresAuth: true }
  },

   {
    path: '/admin/list_client',
    component: Client_List,
    meta: { requiresAuth: true }
  },
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