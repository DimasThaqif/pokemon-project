<script setup>
defineProps({
  pokemon: Object
})
</script>

<template>
  <div class="bg-white rounded-xl shadow p-4 text-center hover:scale-105 transition">
    <h2 class="capitalize font-semibold text-lg">
      {{ pokemon.name }}
    </h2>
  </div>
</template>
