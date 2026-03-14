<script setup>
import Sidebar from "../../components/components_client/Sidebar.vue"
import Navbar from "../../components/components_client/Navbar.vue"
</script>

<template>

<div class="bg-[#020617] min-h-screen text-white">

<Sidebar />

<Navbar />

<main class="ml-64 pt-20 p-8">

<router-view />

</main>

</div>

</template>