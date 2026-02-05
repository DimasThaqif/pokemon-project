<script setup>
import { ref, onMounted } from "vue";
import api from "../services/api";
import PokemonCard from "../components/PokemonCard.vue";

const pokemons = ref([]);
const source = ref("");
const loading = ref(true);

const fetchPokemons = async () => {
  try {
    const res = await api.get("/pokemon?limit=20&page=1");
    pokemons.value = res.data.data;
    source.value = res.data.source;
  } catch (err) {
    console.error(err);
  } finally {
    loading.value = false;
  }
};

onMounted(fetchPokemons);
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-4xl font-black text-gray-900 mb-2">
              Pokémon Collection
            </h1>
            <p class="text-gray-600">
              Discover and explore amazing Pokémon from different regions
            </p>
          </div>

          <!-- Source Badge -->
          <div>
            <span
              class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold border"
              :class="
                source === 'api'
                  ? 'bg-red-50 text-red-700 border-red-200'
                  : 'bg-green-50 text-green-700 border-green-200'
              "
            >
              <span class="relative flex h-2 w-2">
                <span 
                  class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75"
                  :class="source === 'api' ? 'bg-red-500' : 'bg-green-500'"
                ></span>
                <span 
                  class="relative inline-flex rounded-full h-2 w-2"
                  :class="source === 'api' ? 'bg-red-600' : 'bg-green-600'"
                ></span>
              </span>
              {{ source === 'api' ? 'Live API' : 'Cached' }}
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">
      <!-- Loading State -->
      <div v-if="loading" class="flex items-center justify-center py-20">
        <div class="text-center">
          <div class="relative w-16 h-16 mx-auto mb-4">
            <div class="absolute inset-0 border-4 border-red-500 border-t-gray-300 
                        rounded-full animate-spin"></div>
          </div>
          <p class="text-gray-600 font-medium">Loading Pokémon...</p>
        </div>
      </div>

      <!-- Empty State -->
      <div
        v-else-if="pokemons.length === 0"
        class="text-center py-20"
      >
        <div class="text-6xl mb-4">🔍</div>
        <p class="text-gray-600 text-lg">No Pokémon found</p>
      </div>

      <!-- Pokemon Grid -->
      <div v-else>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
          <PokemonCard
            v-for="(pokemon, index) in pokemons"
            :key="pokemon.name"
            :pokemon="pokemon"
            :style="{ 
              animationDelay: `${index * 30}ms`,
            }"
            class="animate-fade-in"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fadeIn 0.5s ease-out forwards;
  opacity: 0;
}
</style>