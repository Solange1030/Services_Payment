<script setup>
import { ref } from "vue"
import api from "../../api/index.js"

const emit = defineEmits(["close","created"])

const paymentMethod = ref("")
const amount = ref("")
const description = ref("")

const loading = ref(false)
const error = ref("")

function closeModal(){
  emit("close")
}

async function submitTransaction(){

  error.value = ""

  // validação
  if(!paymentMethod.value){
    error.value = "Selecione um serviço"
    return
  }

  if(!amount.value || amount.value <= 0){
    error.value = "O montante deve ser maior que 0"
    return
  }

  try{

    loading.value = true

    const token = localStorage.getItem("token")

    await api.post("/client/make_transaction",
      {
        service: paymentMethod.value,
        amount: amount.value,
        description: description.value
      },
      {
        headers:{
          Authorization:`Bearer ${token}`
        }
      }
    )

    emit("created") 
    closeModal()

  }catch(err){

    error.value = "Erro ao criar transação"
    console.error(err)

  }finally{
    loading.value = false
  }

}
</script>


<template>

    <div class="fixed inset-0 flex items-center justify-center z-50">

    
    <div
        class="absolute inset-0 bg-black/60"
        @click="closeModal"
    ></div>

    <div
        class="relative bg-[#121F36] p-8 rounded-3xl w-96 shadow-2xl flex flex-col gap-6"
    >

        <h2 class="text-2xl font-bold text-white">
        Nova Transação
        </h2>

        <button
        @click="closeModal"
        class="absolute top-4 right-4 text-gray-400 hover:text-white"
        >
        ✕
        </button>

        <form
        @submit.prevent="submitTransaction"
        class="flex flex-col gap-4"
        >

        
        <select
            v-model="paymentMethod"
            class="p-3 rounded-xl bg-[#1B2430] text-white border border-gray-700"
        >
            <option value="">Serviço</option>
            <option value="tv">TV</option>
            <option value="agua">Água</option>
            <option value="energia">Energia</option>
            <option value="outros">Outros</option>
        </select>

        <!-- montante -->
        <input
            v-model="amount"
            type="number"
            placeholder="Montante"
            class="p-3 rounded-xl bg-[#1B2430] text-white border border-gray-700"
        />

        <!-- descrição -->
        <textarea
            v-model="description"
            placeholder="Descrição (opcional)"
            class="p-3 rounded-xl bg-[#1B2430] text-white border border-gray-700"
        ></textarea>

        <!-- erro -->
        <p v-if="error" class="text-red-400 text-sm">
            {{ error }}
        </p>

        <!-- botão -->
        <button
            type="submit"
            :disabled="loading"
            class="py-3 rounded-2xl text-white font-semibold
            bg-gradient-to-r from-purple-500 via-pink-500 to-pink-600"
        >
            {{ loading ? "Processando..." : "Pagar" }}
        </button>

        </form>

    </div>

    </div>

</template>