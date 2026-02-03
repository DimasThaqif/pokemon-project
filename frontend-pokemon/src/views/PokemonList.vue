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
  <div class="min-h-screen bg-gray-100 p-6">
    <h1 class="text-3xl font-bold mb-2">Pokémon List</h1>

    <span
      class="inline-block mb-4 px-3 py-1 rounded-full text-xs font-semibold"
      :class="source === 'api' 
        ? 'bg-red-200' 
        : 'bg-green-200'"
    >
      Source: {{ source }}
    </span>

    <div v-if="loading" class="text-center py-10 text-gray-500">Loading...</div>

    <div
      v-else-if = "pokemons.length === 0"
      class="text-center py-10 text-gray-400"
    >
      Tidak ada pokemon
    </div>

    <div v-else class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
      <PokemonCard
        v-for="pokemon in pokemons"
        :key="pokemon.name"
        :pokemon="pokemon"
      />
    </div>
  </div>
</template>
