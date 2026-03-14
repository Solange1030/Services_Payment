<script setup>
import { defineProps, computed } from "vue"

const props = defineProps({
  id: Number,
  amount: Number,
  service: String,
  date: String,
  status: String
})

/* formatar data */
const formattedDate = computed(() => {
  return new Date(props.date).toLocaleDateString("pt-PT")
})

function viewDetails(){
  alert("Detalhes da transação " + props.id)
}
</script>

<template>
<div
  class="w-60 bg-gradient-to-br from-[#1B2430] to-[#0D111F] text-gray-200 p-6 rounded-3xl
         border border-gray-800
         shadow-lg hover:shadow-2xl
         transform hover:-translate-y-1 hover:scale-105
         transition-all duration-300
         flex flex-col gap-4"
>

  <!-- Serviço -->
  <h5 class="text-base font-semibold text-white tracking-wide">
    {{ service }}
  </h5>

  <!-- Montante e Estado -->
  <div class="space-y-2 text-sm">

    <p>
      <span class="font-medium text-gray-400">
        Montante:
      </span>
      <span class="text-white font-medium">{{ amount }} MZN</span>
    </p>

    <p>
      <span class="font-medium text-gray-400">
        Estado:
      </span>
      <span
        :class="{
          'text-yellow-300': status=='Pendente',
          'text-green-400': status=='Pago',
          'text-red-400': status=='Falhado'
        }"
        class="font-semibold"
      >
        {{ status }}
      </span>
    </p>

  </div>

  <!-- Data -->
  <div class="flex justify-between bg-white/5 px-4 py-3 rounded-xl text-sm">
    <span class="text-gray-300">
      📅 {{ formattedDate }}
    </span>
  </div>

  <!-- Botões -->
  <div class="flex gap-3 mt-3">

    <!-- Ver detalhes -->
    <button
      @click="viewDetails"
      class="flex-1 text-sm font-medium border border-gray-700 rounded-xl py-2
             bg-gradient-to-r from-gray-700 via-gray-800 to-gray-900
             hover:from-gray-600 hover:via-gray-700 hover:to-gray-800
             transition-all duration-300"
    >
      Ver detalhes
    </button>

    <!-- Status -->
    <button
      :class="[
        'flex-1 text-sm font-semibold rounded-xl py-2 bg-gradient-to-r hover:brightness-105 transition-all duration-300',
        status === 'Pendente' ? 'from-yellow-400 via-yellow-500 to-yellow-500' :
        status === 'Pago' ? 'from-green-400 via-green-500 to-green-500' :
        'from-red-400 via-red-500 to-red-500'
      ]"
    >
      {{ status }}
    </button>

  </div>

</div>
</template>