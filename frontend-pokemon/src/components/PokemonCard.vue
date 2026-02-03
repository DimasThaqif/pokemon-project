<script setup>
defineProps({
  pokemon: Object
})

const getImage = (url) => {
  const id = url.split('/').filter(Boolean).pop()
  return `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${id}.png`
}
</script>

<template>
  <router-link
    :to="`/pokemon/${pokemon.name}`"
    class="block bg-white rounded-xl shadow-md hover:shadow-xl transition p-4 text-center"
  >
    <img
      :src="getImage(pokemon.url)"
      class="mx-auto h-24 w-24"
      loading="lazy"
    />

    <h2 class="capitalize mt-2 font-semibold text-lg">
      {{ pokemon.name }}
    </h2>
  </router-link>
</template>
