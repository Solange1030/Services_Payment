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
        Login Seguro
      </h1>

      <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-6">
        Introduz o teu email e a Palavra-passe
      </p>

      <form @submit.prevent="handleVerifyCredentials" class="flex flex-col gap-5">
        <!-- Email -->
        <input
          type="email"
          v-model="email"
          required
          placeholder="Digite o seu email"
          class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600
                 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white
                 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
        />

        <!-- Código 6 dígitos -->
        <div class="flex justify-between">
          <input
            v-for="(digit, i) in password"
            :key="i"
            :id="`password-${i}`"
            type="password"
            maxlength="1"
            v-model="password[i]"
            @input="handlePasswordChange($event.target.value, i)"
            class="w-12 h-12 text-center text-lg border rounded-xl border-gray-300 dark:border-gray-600
                   bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white
                   focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
            required
          />
        </div>

        <p v-if="error" class="text-red-600 text-sm text-center">{{ error }}</p>

        <!-- Botão -->
        <button
          type="submit"
          :disabled="loading"
          class="w-full py-3 text-white font-semibold rounded-xl
                 bg-gradient-to-r from-purple-500 to-blue-500
                 hover:from-purple-600 hover:to-blue-600
                 focus:outline-none focus:ring-4 focus:ring-purple-300
                 transition transform hover:scale-105"
        >
          {{ loading ? "A autenticar..." : "Entrar" }}
        </button>

        <!-- Link de registro -->
        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-2">
          Ainda não tens conta? 
          <router-link to="/Auth/signup" class="text-purple-600 hover:underline dark:text-purple-400 font-medium">
            Regista-te aqui
          </router-link>
        </p>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { loginUser } from "../../api/auth";

const router = useRouter();
const email = ref("");
const password = ref(Array(6).fill(""));
const loading = ref(false);
const error = ref("");

async function handleVerifyCredentials() {
  loading.value = true;
  error.value = "";

  if (password.value.some((c) => c === "")) {
    error.value = "Preencha todos os dígitos do código de acesso";
    loading.value = false;
    return;
  }

  try {
    const formData = {
      email: email.value,
      password: password.value.join(""),
    };

    const response = await loginUser(formData);
    localStorage.setItem("token", response.data.token);
    localStorage.setItem("user_id", response.data.user.id);

    if (response.data.user.role === "Cliente") {
      router.push("/index/client/");
    } else if (response.data.user.role === "Admin") {
      router.push("/Psy/consults");
    } else {
      router.push("/dashboard");
    }
  } catch (err) {
    error.value = err.message || "Erro ao autenticar";
  } finally {
    loading.value = false;
  }
}

function handlePasswordChange(value, index) {
  if (!/^\d?$/.test(value)) return;
  password.value[index] = value;

  const nextInput = document.getElementById(`password-${index + 1}`);
  if (value && nextInput) nextInput.focus();
}
</script>