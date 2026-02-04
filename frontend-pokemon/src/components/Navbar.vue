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
  <nav
    class="sticky top-0 z-50 bg-neutral-900/80 backdrop-blur border-b border-neutral-700"
  >
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
      <!-- Logo -->
      <router-link
        to="/"
        class="flex items-center gap-2 font-extrabold text-xl text-gray-800 hover:opacity-80 transition"
      >
        <img
          src="https://raw.githubusercontent.com/PokeAPI/media/master/logo/pokeapi_256.png"
          class="h-8 w-8 object-contain"
          alt="PokeAPI Logo"
        />
        <span class="hidden sm:block">PokeDex</span>
      </router-link>

      <!-- Desktop Menu -->
      <div class="hidden md:flex items-center gap-8 text-sm font-semibold">
        <router-link
          v-for="item in menu"
          :key="item.name"
          :to="item.path"
          class="text-gray-300 hover:text-yellow-400 transition"
          :class="{ 'text-yellow-400': $route.path === item.path }"
        >
          {{ item.name }}
        </router-link>
      </div>

      <!-- Mobile Button -->
      <button
        @click="open = !open"
        class="md:hidden text-gray-700 focus:outline-none"
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
      class="md:hidden bg-white border-t border-gray-200 px-6 py-4 space-y-3"
    >
      <router-link
        v-for="item in menu"
        :key="item.name"
        :to="item.path"
        @click="open = false"
        class="block font-medium text-gray-700 hover:text-red-500 transition"
        :class="{ 'text-red-500': $route.path === item.path }"
      >
        {{ item.name }}
      </router-link>
    </div>
  </nav>
</template>
