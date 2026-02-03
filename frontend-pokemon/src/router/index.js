import { createRouter, createWebHistory } from 'vue-router'
import PokemonList from '../views/PokemonList.vue'
import PokemonDetail from '../views/PokemonDetail.vue'

const routes = [
  {
    path: '/',
    name: 'pokemon-list',
    component: PokemonList
  },
  {
    path: '/pokemon/:name',
    name: 'pokemon-detail',
    component: PokemonDetail
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
