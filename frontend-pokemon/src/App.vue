<script setup>
import HelloWorld from './components/HelloWorld.vue'
import Navbar from './components/Navbar.vue'
</script>
<template>
  <div class="min-h-screen bg-neutral-900 text-white">
    <Navbar />
    <main class="pt-4">
      <router-view />
    </main>
  </div>
</template>

