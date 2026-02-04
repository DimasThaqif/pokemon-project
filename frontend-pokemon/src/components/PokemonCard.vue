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
    class="group bg-neutral-800 rounded-2xl border border-neutral-700
           hover:border-yellow-400 hover:-translate-y-1
           transition-all duration-300 p-5 flex flex-col items-center"
  >
    <img
      :src="getImage(pokemon.url)"
      class="h-28 mb-4 group-hover:scale-110 transition"
      loading="lazy"
    />

    <h2 class="font-bold capitalize text-lg text-white">
      {{ pokemon.name }}
    </h2>

    <span
      class="mt-3 text-xs px-3 py-1 rounded-full
             bg-yellow-400/10 text-yellow-300
             group-hover:bg-yellow-400 group-hover:text-black transition"
    >
      Detail →
    </span>
  </router-link>
</template>

