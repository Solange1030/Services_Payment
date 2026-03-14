<script setup>
import { ref, onMounted } from "vue";
import Sidebar from "../../components/components_client/Sidebar.vue";
import Navbar from "../../components/components_client/Navbar.vue";
import TransactionCard from "../../components/components_client/TransactionCard.vue";
import api from "../../api/index.js";

const transactions = ref([]);
const showModal = ref(false);

async function fetchTransactions() {
  try {
    const token = localStorage.getItem("token"); 
    const response = await api.get('/client/my_transactions', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });
    transactions.value = response.data.data; 
  } catch (error) {
    console.error("Erro ao buscar transações:", error);
  }
}

function openModal() {
  showModal.value = true;
}

function closeModal() {
  showModal.value = false;
}

onMounted(() => {
  fetchTransactions();
});
</script>

<template>
  <div class="bg-[#020617] min-h-screen flex relative">

    <!-- Sidebar fixa -->
    <Sidebar class="fixed left-0 top-0 h-screen w-60 z-20" />

    <div class="flex-1 ml-[240px] relative">

      <!-- Navbar fixa -->
      <Navbar class="fixed top-0 left-[240px] w-[calc(100%-240px)] z-10" />

      <!-- CONTEÚDO PRINCIPAL -->
      <div :class="showModal ? 'filter blur-sm pointer-events-none transition-all duration-300' : 'transition-all duration-300'">
        <main class="pt-[80px] p-8 relative z-0">
          <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl text-white font-bold">Minhas Transações</h1>
            <button
              @click="openModal"
              class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-xl shadow-lg transition-colors duration-300"
            >
              + Novo
            </button>
          </div>

          <div v-if="transactions.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <TransactionCard
              v-for="transaction in transactions"
              :key="transaction.id"
              :id="transaction.id"
              :amount="transaction.amount"
              :service="transaction.service"
              :date="transaction.created_at"
              :status="transaction.state"
            />
          </div>

          <p v-else class="text-gray-400 text-center mt-10">
            Nenhuma transação encontrada.
          </p>
        </main>
      </div>

      <!-- MODAL (fora da div desfocada) -->
      <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50">
        <!-- Fundo escuro -->
        <div class="absolute inset-0 bg-black/50"></div>

        <!-- Card da modal -->
        <div class="relative bg-[#121F36] p-8 rounded-3xl w-96 shadow-2xl flex flex-col gap-6 z-50">
          <h2 class="text-2xl font-bold text-white mb-2">Nova Transação</h2>

          <!-- Botão fechar -->
          <button
            @click="closeModal"
            class="absolute top-4 right-4 text-gray-400 hover:text-white text-lg"
          >
            ✕
          </button>

          <!-- Formulário -->
          <form class="flex flex-col gap-4">
            <input type="text" placeholder="Serviço" class="p-3 rounded-xl bg-[#1B2430] text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500"/>
            <input type="number" placeholder="Montante" class="p-3 rounded-xl bg-[#1B2430] text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500"/>
            <textarea placeholder="Descrição" class="p-3 rounded-xl bg-[#1B2430] text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>

            <button type="submit" class="py-3 rounded-2xl text-white font-semibold text-lg
                   bg-gradient-to-r from-purple-500 via-pink-500 to-pink-600
                   hover:brightness-110 hover:scale-105 transition-all duration-300">
              Pagar
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
</template>