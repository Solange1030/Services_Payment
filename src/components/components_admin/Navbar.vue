<script setup>
import { ref } from "vue"

const menuOpen = ref(false)

function toggleMenu(){
menuOpen.value = !menuOpen.value
}
</script>

<template>

<header class="fixed top-0 left-64 right-0 h-16 bg-[#0B1323]/80 backdrop-blur-md border-b border-white/10 flex items-center justify-end px-8 z-40">

<div class="relative">

<button
@click="toggleMenu"
class="flex items-center justify-center w-9 h-9 rounded-full bg-gradient-to-r from-purple-600 to-blue-500 text-white font-semibold"
>
U
</button>

<div
v-if="menuOpen"
class="absolute right-0 mt-3 w-48 bg-[#0F1A2A] border border-white/10 rounded-xl shadow-xl overflow-hidden"
>

<div class="px-4 py-3 border-b border-white/10">
<p class="text-sm text-white font-medium">
User
</p>
<p class="text-xs text-gray-400">
user@email.com
</p>
</div>

<ul class="text-sm text-gray-300">

<li class="px-4 py-2 hover:bg-white/5 cursor-pointer">
Perfil
</li>

<li class="px-4 py-2 hover:bg-red-500/20 text-red-400 cursor-pointer">
Logout
</li>

</ul>

</div>

</div>

</header>

</template>