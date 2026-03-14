<script setup>
import { ref, onMounted } from "vue";
import Sidebar from "../../components/components_client/Sidebar.vue";
import Navbar from "../../components/components_client/Navbar.vue";
import TransactionCard from "../../components/components_client/TransactionCard.vue";
import Form_Transaction from "../../components/components_client/Form_transaction.vue";
import api from "../../api/index.js";

const transactions = ref([]);
const showModal = ref(false);

async function fetchTransactions() {
  try {
    const token = localStorage.getItem("token");
    const response = await api.get("/client/my_transactions", {
      headers: { Authorization: `Bearer ${token}` },
    });
    transactions.value = response.data.data;
  } catch (error) {
    console.error("Erro ao buscar transações:", error);
  }
}

function openModal() { showModal.value = true }
function closeModal() { showModal.value = false }

onMounted(() => { fetchTransactions() })
</script>

<template>
  <div class="bg-[#020617] min-h-screen flex relative">

    <!-- CONTEÚDO PRINCIPAL -->
    <div
      class="flex w-full transition-all duration-300"
      :class="showModal ? 'blur-sm brightness-50 pointer-events-none' : ''"
    >
      <Sidebar class="fixed left-0 top-0 h-screen w-60 z-20" />
      <div class="flex-1 ml-[240px]">
        <Navbar class="fixed top-0 left-[240px] w-[calc(100%-240px)] z-10" />

        <main class="pt-[90px] p-8">
          <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl text-white font-bold">Minhas Transações</h1>
            <button
              @click="openModal"
              class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-xl shadow-lg"
            >
              + Novo
            </button>
          </div>

          <div v-if="transactions.length" class="grid grid-row-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
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
    </div>

    <!-- MODAL DO FORMULÁRIO -->
    <Form_Transaction
      v-if="showModal"
      @close="closeModal"
      @created="fetchTransactions"
    />

  </div>
</template>