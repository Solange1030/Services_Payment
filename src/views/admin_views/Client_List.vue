<script setup>
import { ref, onMounted } from "vue";
import Sidebar from "../../components/components_admin/Sidebar.vue";
import Navbar from "../../components/components_admin/Navbar.vue";
import api from "../../api/index.js";

const clients = ref([]);
const showModal = ref(false);

async function fetchClients() {
  try {
    const token = localStorage.getItem("token");
    const response = await api.get("/admin/clients", {
      headers: { Authorization: `Bearer ${token}` },
    });
    clients.value = response.data.clients;
  } catch (error) {
    console.error("Erro ao buscar clientes:", error);
  }
}

function openModal() { showModal.value = true }
function closeModal() { showModal.value = false }

onMounted(() => { fetchClients() })
</script>

<template>
  <div class="bg-[#020617] min-h-screen flex relative">

   
    <div
      class="flex w-full transition-all duration-300"
      :class="showModal ? 'blur-sm brightness-50 pointer-events-none' : ''"
    >
      <Sidebar class="fixed left-0 top-0 h-screen w-60 z-20" />
      <div class="flex-1 ml-[240px]">
        <Navbar class="fixed top-0 left-[240px] w-[calc(100%-240px)] z-10" />

        <main class="pt-[90px] p-8">
          <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl text-white font-bold">Clientes Registrados</h1>
            
          </div>

          <!-- TABELA DE CLIENTES -->
          <div class="overflow-x-auto bg-neutral-primary-soft shadow-lg rounded-2xl border border-neutral-secondary">
            <table class="min-w-full text-sm text-left text-white">
              <thead class="bg-neutral-secondary-dark text-xs uppercase text-white">
                <tr>
                  <th class="px-6 py-3">ID</th>
                  <th class="px-6 py-3">Nome</th>
                  <th class="px-6 py-3">Email</th>
                  <th class="px-6 py-3">Telefone</th>
                  <th class="px-6 py-3">Data de Registro</th>
                  <th class="px-6 py-3 text-center">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="client in clients"
                  :key="client.id"
                  class="bg-neutral-primary border-b border-neutral-secondary hover:bg-neutral-secondary/20 transition-colors duration-200"
                >
                  <td class="px-6 py-4 font-medium whitespace-nowrap">{{ client.id }}</td>
                  <td class="px-6 py-4">{{ client.name }}</td>
                  <td class="px-6 py-4">{{ client.email }}</td>
                  <td class="px-6 py-4">{{ client.contact ?? '—' }}</td>
                  <td class="px-6 py-4">{{ new Date(client.created_at).toLocaleDateString() }}</td>
                  <td class="px-6 py-4 flex justify-center gap-2">
                    <button class="px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded text-sm transition">Ver</button>
                    <button class="px-3 py-1 bg-green-600 hover:bg-green-700 rounded text-sm transition">Editar</button>
                  </td>
                </tr>
                <tr v-if="clients.length === 0">
                  <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                    Nenhum cliente registrado.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </main>
      </div>
    </div>

   
    
  </div>
</template>
