<template>
  <figure class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto gap-10 px-4 md:px-0 py-10">
    <div class="w-full md:w-1/2 flex justify-center">
      <div class="w-full max-w-md md:max-w-lg lg:max-w-xl">
        <img src="../../assets/Logo.jpg" class="h-20 m-auto" alt="FlowBite Logo" />
      </div>
    </div>

    <div class="w-full md:w-1/2 flex flex-col md:items-start text-center md:text-left">
      <h1 class="mb-4 text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-heading">
        Cuidar de si, é cuidar do futuro
      </h1>

      <p class="mb-6 text-lg lg:text-xl text-body">
        Plataforma de consultoria psicológica para jovens. Fóruns entre jovens e conversas em tempo real com um psicólogo, com a opção de fazer uma consulta em anonimato.
      </p>

      <div class="flex flex-row justify-center md:justify-start items-center gap-4 mt-4">
        <router-link to="/Login">
          <button
            type="button"
            class="text-white lg:text-lg bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl
                   focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium
                   rounded-xl text-sm px-10 py-3 text-center leading-5"
          >
            Entrar
          </button>
        </router-link>

        <router-link to="/Register">
          <button
            type="button"
            class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l
                   focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium
                   rounded-xl text-sm px-10 py-3 text-center leading-5"
          >
            Registar
          </button>
        </router-link>
      </div>
    </div>
  </figure>
</template>

<script setup>

</script>