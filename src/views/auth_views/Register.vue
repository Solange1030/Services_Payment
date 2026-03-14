<template>
  <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-200 to-purple-200 dark:from-gray-800 dark:to-gray-900 px-4">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8">
      
      <!-- Logo -->
      <div class="flex justify-center mb-6">
        <img
          src="../../assets/Logo.jpg"
          alt="Logo"
          class="w-32 h-32 rounded-full shadow-lg"
        />
      </div>

      <h1 class="text-2xl md:text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">
        Registo Seguro
      </h1>

      <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-6">
        Preencha os dados para criar sua conta
      </p>

      <form @submit.prevent="handleRegister" class="flex flex-col gap-4">
        <!-- Nome -->
        <input
          type="text"
          v-model="name"
          required
          placeholder="Nome completo"
          class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600
                 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white
                 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
        />

        <!-- Email -->
        <input
          type="email"
          v-model="email"
          required
          placeholder="Email"
          class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600
                 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white
                 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
        />

        <!-- Contacto -->
        <input
          type="text"
          v-model="contact"
          required
          placeholder="Contacto"
          class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600
                 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white
                 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
        />

        <!-- Gênero -->
        <select
          v-model="gender"
          required
          class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600
                 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white
                 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
        >
          <option value="" disabled>Gênero</option>
          <option value="Masculino">Masculino</option>
          <option value="Feminino">Feminino</option>
          <option value="Outro">Outro</option>
        </select>

       
        <input
          type="password"
          v-model="password"
          required
          placeholder="Palavra-passe"
          class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600
                 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white
                 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
        />

       >
        <input
          type="password"
          v-model="passwordConfirm"
          required
          placeholder="Confirme a palavra-passe"
          class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600
                 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white
                 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
        />

        <p v-if="error" class="text-red-600 text-sm text-center">{{ error }}</p>

        <button
          type="submit"
          :disabled="loading"
          class="w-full py-3 text-white font-semibold rounded-xl
                 bg-gradient-to-r from-purple-500 to-blue-500
                 hover:from-purple-600 hover:to-blue-600
                 focus:outline-none focus:ring-4 focus:ring-purple-300
                 transition transform hover:scale-105"
        >
          {{ loading ? "Registrando..." : "Registrar" }}
        </button>

        
        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-2">
          Já tem conta? 
          <router-link to="/login" class="text-purple-600 hover:underline dark:text-purple-400 font-medium">
            Faça login
          </router-link>
        </p>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { registerUser } from "../../api/auth"; 

const router = useRouter();
const name = ref("");
const email = ref("");
const contact = ref("");
const gender = ref("");
const password = ref("");
const passwordConfirm = ref("");
const loading = ref(false);
const error = ref("");

async function handleRegister() {
  error.value = "";
  if (!name.value || !email.value || !contact.value || !gender.value || !password.value || !passwordConfirm.value) {
    error.value = "Preencha todos os campos";
    return;
  }

  if (password.value !== passwordConfirm.value) {
    error.value = "As senhas não coincidem";
    return;
  }

  loading.value = true;

  try {
    const formData = {
      name: name.value,
      email: email.value,
      contact: contact.value,
      gender: gender.value,
      password: password.value,
      password_confirmation: passwordConfirm.value,
    };

    const response = await registerUser(formData);
    localStorage.setItem("token", response.data.token);
    localStorage.setItem("user_id", response.data.user.id);

    
    router.push("/index/client/");
  } catch (err) {
    error.value = err.response?.data?.message || "Erro ao registrar";
  } finally {
    loading.value = false;
  }
}
</script>
