<script setup>
import { useRoute } from "vue-router"
import { LayoutDashboard, Wallet, User } from "lucide-vue-next"

const route = useRoute()
</script>

<template>

<aside class="fixed top-0 left-0 h-screen w-64 bg-[#0F172A] border-r border-white/10 flex flex-col">

  <!-- LOGO -->
  <div class="h-16 flex items-center px-6 border-b border-white/10 space-x-3">
    <img src="../../assets/Logo.jpg" alt="Logo" class="w-20 h-10 rounded-full" />
    <span class="text-white font-semibold text-lg tracking-wide">
      Sys_Pagamento
    </span>
  </div>

  <!-- MENU com scroll -->
  <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
    <!-- Dashboard -->
    <router-link
      to="/dashboard"
      class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition"
      :class="route.path === '/dashboard' ? 'bg-gradient-to-r from-purple-600/20 to-blue-500/20 text-white' : ''"
    >
      <LayoutDashboard size="18"/>
      Dashboard
    </router-link>

    <!-- Clientes -->
    <router-link
      to="/admin/list_client"
      class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition"
      :class="route.path === '/client/list' ? 'bg-gradient-to-r from-purple-600/20 to-blue-500/20 text-white' : ''"
    >
      <User size="18"/>
      Clientes
    </router-link>

    <!-- Transações Pendentes -->
    <router-link
      to="/admin/pending_transactios"
      class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition"
      :class="route.path === '/client/transactions/pending' ? 'bg-gradient-to-r from-purple-600/20 to-blue-500/20 text-white' : ''"
    >
      <Wallet size="18"/>
      Transações Pendentes
    </router-link>

    <!-- Transações Pagas -->
    <router-link
      to="/admin/paied_transactios"
      class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition"
      :class="route.path === '/client/transactions/paid' ? 'bg-gradient-to-r from-purple-600/20 to-blue-500/20 text-white' : ''"
    >
      <Wallet size="18"/>
      Transações Pagas
    </router-link>

    <!-- Transações Falhadas -->
    <router-link
      to="/admin/faild_transactios"
      class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition"
      :class="route.path === '/client/transactions/failed' ? 'bg-gradient-to-r from-purple-600/20 to-blue-500/20 text-white' : ''"
    >
      <Wallet size="18"/>
      Transações Falhadas
    </router-link>

    <!-- Perfil -->
    <router-link
      to="/profile"
      class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition"
      :class="route.path === '/profile' ? 'bg-gradient-to-r from-purple-600/20 to-blue-500/20 text-white' : ''"
    >
      <User size="18"/>
      Perfil
    </router-link>
  </nav>

  <!-- FOOTER -->
  <div class="p-4 border-t border-white/10 text-xs text-gray-400">
    © 2026 PayServices
  </div>

</aside>


</template>