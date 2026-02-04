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
  <div class="min-h-screen bg-neutral-900 px-6 py-10">
    <h1 class="text-4xl font-extrabold mb-3 text-center tracking-wide">
      Pokémon List
    </h1>

    <span
      class="block mx-auto w-fit mb-8 px-4 py-1 rounded-full text-xs font-semibold"
      :class="
        source === 'api'
          ? 'bg-red-500/20 text-red-400'
          : 'bg-green-500/20 text-green-400'
      "
    >
      Source: {{ source }}
    </span>

    <div v-if="loading" class="text-center py-10 text-gray-500">
      Loading Pokémon...
    </div>

    <div
      v-else-if="pokemons.length === 0"
      class="text-center py-10 text-gray-400"
    >
      Tidak ada data Pokémon
    </div>

    <div
      v-else
      class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6"
    >
      <PokemonCard
        v-for="pokemon in pokemons"
        :key="pokemon.name"
        :pokemon="pokemon"
      />
    </div>
  </div>
</template>
