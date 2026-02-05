<script setup>
import { ref } from "vue";

const open = ref(false);

const menu = [
  { name: "Home", path: "/" },
  { name: "Pokémon", path: "/pokemon" },
  { name: "Favorites", path: "/favorites" },
  { name: "About", path: "/about" },
];
</script>

<template>
  <nav class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
      <!-- Logo -->
      <router-link
        to="/"
        class="flex items-center gap-2 hover:opacity-80 transition-opacity"
      >
        <img
          src="https://raw.githubusercontent.com/PokeAPI/media/master/logo/pokeapi_256.png"
          class="h-10 w-10 object-contain"
          alt="PokeAPI Logo"
        />
        <span class="font-black text-xl text-gray-900">
          PokéDex
        </span>
      </router-link>

      <!-- Desktop Menu -->
      <div class="hidden md:flex items-center gap-1">
        <router-link
          v-for="item in menu"
          :key="item.name"
          :to="item.path"
          class="px-4 py-2 rounded-lg text-sm font-semibold
                 text-gray-700 hover:text-gray-900 hover:bg-gray-100
                 transition-all duration-200"
          :class="{ 
            'bg-red-500 text-white hover:bg-red-600 hover:text-white': 
            $route.path === item.path 
          }"
        >
          {{ item.name }}
        </router-link>
      </div>

      <!-- Mobile Menu Button -->
      <button
        @click="open = !open"
        class="md:hidden p-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors"
      >
        <svg
          v-if="!open"
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16"
          />
        </svg>

        <svg
          v-else
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div
      v-if="open"
      class="md:hidden bg-white border-t border-gray-200 px-6 py-4 space-y-2"
    >
      <router-link
        v-for="item in menu"
        :key="item.name"
        :to="item.path"
        @click="open = false"
        class="block px-4 py-2 rounded-lg font-semibold 
               text-gray-700 hover:bg-gray-100 transition-colors"
        :class="{ 
          'bg-red-500 text-white hover:bg-red-600': 
          $route.path === item.path 
        }"
      >
        {{ item.name }}
      </router-link>
    </div>
  </nav>
</template>