<script setup>
defineProps({
  pokemon: Object,
});

const getImage = (url) => {
  const id = url.split("/").filter(Boolean).pop();
  return `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${id}.png`;
};

const getPokemonId = (url) => {
  return url.split("/").filter(Boolean).pop().padStart(3, '0');
};
</script>

<template>
  <router-link
    :to="`/pokemon/${pokemon.name}`"
    class="group bg-white rounded-xl border border-gray-200
           hover:border-red-400 hover:shadow-xl hover:-translate-y-1
           transition-all duration-300 p-5 flex flex-col items-center
           relative overflow-hidden"
  >
    <!-- Pokemon ID Badge -->
    <div class="absolute top-3 right-3 bg-gray-100 
                px-2 py-1 rounded-md text-xs font-semibold text-gray-600">
      #{{ getPokemonId(pokemon.url) }}
    </div>

    <!-- Pokemon Image -->
    <div class="w-full h-32 flex items-center justify-center mb-4">
      <img
        :src="getImage(pokemon.url)"
        :alt="pokemon.name"
        class="h-28 w-28 object-contain 
               group-hover:scale-110 transition-transform duration-300 
               filter drop-shadow-lg"
        loading="lazy"
      />
    </div>

    <!-- Pokemon Name -->
    <h2 class="font-bold capitalize text-lg text-gray-900 mb-3 text-center">
      {{ pokemon.name }}
    </h2>

    <!-- View Button -->
    <div class="w-full mt-auto">
      <span class="flex items-center justify-center gap-2 text-sm font-semibold
                   px-4 py-2 rounded-lg
                   bg-gray-100 text-gray-700
                   group-hover:bg-red-500 group-hover:text-white
                   transition-all duration-300">
        View Details
        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" 
             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
        </svg>
      </span>
    </div>
  </router-link>
</template>