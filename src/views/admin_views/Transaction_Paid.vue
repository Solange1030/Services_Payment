<script setup>
import { ref, onMounted } from "vue";
import Sidebar from "../../components/components_admin/Sidebar.vue";
import Navbar from "../../components/components_admin/Navbar.vue";
import api from "../../api/index.js";

const transactions = ref([]);
const loadingId = ref(null);


function formatCurrency(value) {
  if (!value) return "MTn 0,00";
  return new Intl.NumberFormat("pt-MZ", { style: "currency", currency: "MZN" }).format(value);
}

async function fetchTransactions() {
  try {
    const token = localStorage.getItem("token");
    const response = await api.get("/admin/transactions/paid", {
      headers: { Authorization: `Bearer ${token}` },
    });
    transactions.value = response.data.pending_transactions;
  } catch (error) {
    console.error("Erro ao buscar transações:", error);
  }
}


async function updateTransactionStatus(id, status) {
  try {
    loadingId.value = id;
    const token = localStorage.getItem("token");
    await api.post(
      "/admin/transaction/update-status",
      { transaction_id: id, status },
      { headers: { Authorization: `Bearer ${token}` } }
    );
    fetchTransactions(); 
  } catch (error) {
    console.error("Erro ao atualizar transação:", error);
  } finally {
    loadingId.value = null;
  }
}

onMounted(() => { fetchTransactions() });
</script>

<template>
  <div class="bg-[#020617] min-h-screen flex relative">
    <Sidebar class="fixed left-0 top-0 h-screen w-60 z-20" />
    <div class="flex-1 ml-[240px]">
      <Navbar class="fixed top-0 left-[240px] w-[calc(100%-240px)] z-10" />

      <main class="pt-[90px] p-8">
        <h1 class="text-3xl text-white font-bold mb-6">Transações Pagas</h1>

        <div class="overflow-x-auto bg-neutral-primary-soft shadow-lg rounded-2xl border border-neutral-secondary">
          <table class="min-w-full text-sm text-left text-white">
            <thead class="bg-neutral-secondary-dark text-xs uppercase text-white">
              <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Cliente</th>
                <th class="px-6 py-3">Serviço</th>
                <th class="px-6 py-3">Valor</th>
                <th class="px-6 py-3">Data</th>
                <th class="px-6 py-3 text-center">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="tx in transactions"
                :key="tx.id"
                class="bg-neutral-primary border-b border-neutral-secondary hover:bg-neutral-secondary/20 transition-colors duration-200"
              >
                <td class="px-6 py-4 font-medium whitespace-nowrap">{{ tx.id }}</td>
                <td class="px-6 py-4">{{ tx.client_name }}</td>
                <td class="px-6 py-4">{{ tx.service }}</td>
                <td class="px-6 py-4">{{ formatCurrency(tx.amount) }}</td>
                <td class="px-6 py-4">{{ new Date(tx.created_at).toLocaleDateString() }}</td>
                <td class="px-6 py-4 flex justify-center gap-2">
                  
                    
                  
                  <button
                    class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm transition disabled:opacity-50"
                  >
                    Cancelar
                  </button>
                </td>
              </tr>

              <tr v-if="transactions.length === 0">
                <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                  Nenhuma transação encontrada.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
</template>
