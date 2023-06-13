<script setup lang="ts">
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

const openMenu = ref(false)
const classMenu = ref('')

const openMainMenu = () => {
  openMenu.value = !openMenu.value
  classMenu.value = openMenu.value ? 'block' : 'hidden'
}
</script>

<template>
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0"></div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <RouterLink
                to="/"
                active-class="bg-gray-900 text-white"
                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                aria-current="page"
                >Home</RouterLink
              >

              <RouterLink
                to="/products"
                active-class="bg-gray-900 text-white"
                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                >Productos</RouterLink
              >
            </div>
          </div>
        </div>
        <div class="-mr-2 flex md:hidden">
          <!-- Mobile menu button (click)="openMainMenu()"-->
          <button
            @click="openMainMenu()"
            type="button"
            class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
            aria-controls="mobile-menu"
            aria-expanded="false"
          >
            <span class="sr-only">Open main menu</span>
            <svg
              :class="{ block: !openMenu, hidden: openMenu }"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              aria-hidden="true"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
              />
            </svg>
            <svg
              :class="{ hidden: !openMenu, block: openMenu }"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              aria-hidden="true"
            >
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

   
    <div class="md:hidden" id="mobile-menu" v-if="openMenu">
      <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
        <RouterLink
          to="/"
          active-class="bg-gray-900 text-white"
          class="block text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
          aria-current="page"
          >Home</RouterLink
        >

        <RouterLink
          to="/products"
          active-class="bg-gray-900 text-white"
          class="block text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
          >Productos</RouterLink
        >
      </div>
    </div>
  </nav>
</template>
