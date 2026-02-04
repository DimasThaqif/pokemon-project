<script setup>
defineProps({
  pokemon: Object,
});

const getImage = (url) => {
  const id = url.split("/").filter(Boolean).pop();
  return `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${id}.png`;
};
</script>

<template>
  <router-link
    :to="`/pokemon/${pokemon.name}`"
    class="group bg-white rounded-2xl shadow hover:shadow-xl transition p-6 flex flex-col items-center"
  >
    <img
      :src="getImage(pokemon.url)"
      class="h-28 mb-4 group-hover:scale-110 transition"
      loading="lazy"
    />

    <h2 class="font-bold capitalize text-lg">
      {{ pokemon.name }}
    </h2>

    <span class="mt-2 text-xs px-3 py-1 rounded-full bg-gray-100">
      Detail →
    </span>


  </router-link>
</template>
