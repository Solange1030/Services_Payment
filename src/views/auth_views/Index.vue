<template>
  <div class="pt-24">
    <!-- Navbar -->
    <nav class=" fixed w-full z-20 top-0 left-0 border-b border-gray-200 shadow-sm">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="../../assets/Logo.jpg" class="h-16 w-auto object-contain" alt="Logo" />
          <span class="text-2xl font-bold text-white">Sys_Pagamento</span>
        </a>

        <!-- Botões desktop -->
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
          <router-link to="/Login">
            <button
              type="button"
              class="text-white bg-gradient-to-br from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700
                     focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-6 py-2 text-center"
            >
              Entrar
            </button>
          </router-link>

          <router-link to="/Register">
            <button
              type="button"
              class="text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600
                     focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-xl text-sm px-6 py-2 text-center"
            >
              Registar
            </button>
          </router-link>
        </div>
      </div>
    </nav>

    <!-- Seção principal -->
    <section class="max-w-6xl mx-auto px-4 py-16 flex flex-col md:flex-row items-center gap-10">
      <!-- Imagem à esquerda -->
      <div class="w-full md:w-1/2 flex justify-center">
        <img src="../../assets/index.jpg" alt="Pagamento" class="w-full max-w-md rounded-xl shadow-lg" />
      </div>

      <!-- Conteúdo à direita -->
      <div class="w-full md:w-1/2 flex flex-col items-center md:items-start text-center md:text-left">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-white mb-4">
          Facilite seus pagamentos online
        </h1>
        <p class="text-lg lg:text-xl text-gray-600 mb-6">
          Plataforma moderna para gerenciar e pagar serviços online com segurança, rapidez e simplicidade.
        </p>

        <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4 mt-4">
          <router-link to="/Login">
            <button
              type="button"
              class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600
                     focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-10 py-3 text-center"
            >
              Começar
            </button>
          </router-link>

          >
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 mt-20">
      <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8 text-center text-gray-500">
        © 2026 Sys_Pagamento. Todos os direitos reservados.
      </div>
    </footer>
  </div>
</template>

<script setup>
</script>