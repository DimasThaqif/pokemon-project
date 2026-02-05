<script setup>
import { ref, onMounted, computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";

const route = useRoute();
const router = useRouter();
const pokemon = ref(null);
const species = ref(null);
const loading = ref(true);
const error = ref(null);

const typeColors = {
  normal: '#A8A878',
  fire: '#F08030',
  water: '#6890F0',
  electric: '#F8D030',
  grass: '#78C850',
  ice: '#98D8D8',
  fighting: '#C03028',
  poison: '#A040A0',
  ground: '#E0C068',
  flying: '#A890F0',
  psychic: '#F85888',
  bug: '#A8B820',
  rock: '#B8A038',
  ghost: '#705898',
  dragon: '#7038F8',
  dark: '#705848',
  steel: '#B8B8D0',
  fairy: '#EE99AC',
};

const statNames = {
  hp: 'HP',
  attack: 'Attack',
  defense: 'Defense',
  'special-attack': 'Sp. Atk',
  'special-defense': 'Sp. Def',
  speed: 'Speed',
};

const primaryType = computed(() => {
  return pokemon.value?.types[0]?.type.name || 'normal';
});

const fetchPokemon = async () => {
  try {
    loading.value = true;
    error.value = null;

    const pokemonRes = await axios.get(
      `https://pokeapi.co/api/v2/pokemon/${route.params.name}`
    );
    pokemon.value = pokemonRes.data;

    const speciesRes = await axios.get(pokemonRes.data.species.url);
    species.value = speciesRes.data;
  } catch (err) {
    console.error(err);
    error.value = "Failed to load Pokémon data";
  } finally {
    loading.value = false;
  }
};

const getPokemonId = (id) => {
  return String(id).padStart(3, '0');
};

const getFlavorText = () => {
  if (!species.value) return '';
  const entry = species.value.flavor_text_entries.find(
    entry => entry.language.name === 'en'
  );
  return entry ? entry.flavor_text.replace(/\f/g, ' ') : '';
};

onMounted(fetchPokemon);
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Loading State -->
    <div v-if="loading" class="flex items-center justify-center min-h-screen">
      <div class="text-center">
        <div class="relative w-16 h-16 mx-auto mb-4">
          <div class="absolute inset-0 border-4 border-red-500 border-t-gray-300 
                      rounded-full animate-spin"></div>
        </div>
        <p class="text-gray-600 font-medium">Loading Pokémon...</p>
      </div>
    </div>

    <!-- Error State -->
    <div v-else-if="error" class="flex items-center justify-center min-h-screen px-6">
      <div class="text-center max-w-md">
        <div class="text-6xl mb-4">❌</div>
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Oops!</h2>
        <p class="text-gray-600 mb-6">{{ error }}</p>
        <button
          @click="router.push('/')"
          class="px-6 py-3 bg-red-500 hover:bg-red-600
                 text-white font-semibold rounded-lg
                 transition-colors duration-200"
        >
          Back to Home
        </button>
      </div>
    </div>

    <!-- Pokemon Detail -->
    <div v-else-if="pokemon" class="max-w-6xl mx-auto px-6 py-8">
      <!-- Back Button -->
      <button
        @click="router.push('/')"
        class="group flex items-center gap-2 mb-6 px-4 py-2 
               bg-white hover:bg-gray-50
               border border-gray-200 hover:border-gray-300
               rounded-lg text-gray-700 hover:text-gray-900
               transition-all duration-200"
      >
        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" 
             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to List
      </button>

      <!-- Main Content -->
      <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">
        <div class="p-8 md:p-12">
          <div class="grid md:grid-cols-2 gap-12 items-center">
            
            <!-- Left: Image -->
            <div class="relative">
              <div class="bg-gray-50 rounded-2xl p-8 flex items-center justify-center">
                <img
                  :src="pokemon.sprites.other['official-artwork'].front_default"
                  :alt="pokemon.name"
                  class="w-full max-w-sm mx-auto drop-shadow-2xl"
                />
              </div>
            </div>

            <!-- Right: Info -->
            <div class="space-y-6">
              <!-- ID Badge -->
              <div class="inline-block px-3 py-1 bg-gray-100 
                          rounded-lg text-sm font-semibold text-gray-600">
                #{{ getPokemonId(pokemon.id) }}
              </div>

              <!-- Name -->
              <h1 class="text-5xl md:text-6xl font-black capitalize text-gray-900">
                {{ pokemon.name }}
              </h1>

              <!-- Types -->
              <div class="flex gap-2">
                <span
                  v-for="type in pokemon.types"
                  :key="type.type.name"
                  class="px-4 py-2 rounded-lg font-semibold text-white text-sm capitalize"
                  :style="{ backgroundColor: typeColors[type.type.name] }"
                >
                  {{ type.type.name }}
                </span>
              </div>

              <!-- Description -->
              <p class="text-gray-700 text-base leading-relaxed">
                {{ getFlavorText() }}
              </p>

              <!-- Physical Stats -->
              <div class="grid grid-cols-2 gap-4 pt-4">
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                  <div class="text-gray-500 text-sm mb-1">Height</div>
                  <div class="text-2xl font-bold text-gray-900">
                    {{ (pokemon.height / 10).toFixed(1) }} m
                  </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                  <div class="text-gray-500 text-sm mb-1">Weight</div>
                  <div class="text-2xl font-bold text-gray-900">
                    {{ (pokemon.weight / 10).toFixed(1) }} kg
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Stats Section -->
      <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-12 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Base Stats</h2>

        <div class="space-y-4">
          <div
            v-for="stat in pokemon.stats"
            :key="stat.stat.name"
            class="space-y-2"
          >
            <div class="flex justify-between items-center">
              <span class="text-gray-700 font-semibold text-sm min-w-[100px]">
                {{ statNames[stat.stat.name] }}
              </span>
              <span class="text-gray-900 font-bold">
                {{ stat.base_stat }}
              </span>
            </div>

            <!-- Progress Bar -->
            <div class="relative h-2 bg-gray-100 rounded-full overflow-hidden">
              <div
                class="absolute inset-y-0 left-0 rounded-full transition-all duration-1000"
                :style="{
                  width: `${Math.min((stat.base_stat / 255) * 100, 100)}%`,
                  backgroundColor: typeColors[primaryType]
                }"
              ></div>
            </div>
          </div>

          <!-- Total Stats -->
          <div class="pt-4 mt-4 border-t border-gray-200">
            <div class="flex justify-between items-center">
              <span class="text-gray-700 font-bold">Total</span>
              <span class="text-2xl font-black text-gray-900">
                {{ pokemon.stats.reduce((sum, stat) => sum + stat.base_stat, 0) }}
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Abilities Section -->
      <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Abilities</h2>

        <div class="grid md:grid-cols-2 gap-4">
          <div
            v-for="ability in pokemon.abilities"
            :key="ability.ability.name"
            class="bg-gray-50 border border-gray-200 rounded-xl p-4"
          >
            <div class="flex items-center gap-2">
              <span class="capitalize font-semibold text-gray-900">
                {{ ability.ability.name.replace('-', ' ') }}
              </span>
              <span
                v-if="ability.is_hidden"
                class="px-2 py-0.5 bg-purple-100 text-purple-700 
                       text-xs rounded-md font-medium"
              >
                Hidden
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>