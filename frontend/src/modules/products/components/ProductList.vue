<script setup lang="ts">
import { ref, watchEffect, type Ref } from 'vue'
import ProductService from '../../../services/ProductService'
import type { ResponseProducts, LinkPage } from '../types'

const products: Ref<any> = ref(null)
const q = ref()
const numberPage = ref<number | string | null>(1)

watchEffect(async () => {
  // this effect will run immediately and then
  // re-run whenever currentBranch.value changes
  products.value = await ProductService.getProducts(numberPage.value, q.value)
})

const goToPage = (link: LinkPage) => {
  if (link.url) {
    const url = new URL(link.url)
    const params = url.searchParams
    numberPage.value = params.get('page')
  }
}

const goToPageUrl = (url: string) => {
  const data = {
    url: url,
    label: '',
    active: false
  }
  goToPage(data)
}
</script>

<template>
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead>
        <tr>
          <th class="py-3 px-6 text-left">Nombre</th>
          <th class="py-3 px-6 text-left">Correo Electrónico</th>
          <th class="py-3 px-6 text-left">Rol</th>
          <th class="py-3 px-6 text-left">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr class="bg-white">
          <td class="py-4 px-6 border-b border-gray-200">John Doe</td>
          <td class="py-4 px-6 border-b border-gray-200">johndoe@example.com</td>
          <td class="py-4 px-6 border-b border-gray-200">Admin</td>
          <td class="py-4 px-6 border-b border-gray-200">
            <!-- Acciones -->
          </td>
        </tr>
        <!-- Resto de filas -->
      </tbody>
    </table>
  </div>

  <div
    class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
    v-if="products"
  >
    <div class="flex flex-1 justify-between sm:hidden">
      <div
        @click="goToPageUrl(products.prev_page_url)"
        class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer"
      >
        Anterior
      </div>
      <div
        @click="goToPageUrl(products.next_page_url)"
        class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer"
      >
        Siguiente
      </div>
    </div>

    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Mostrando
          <span class="font-medium">{{ products.from }}</span>
          a
          <span class="font-medium">{{ products.to }}</span>
          de
          <span class="font-medium">{{ products.total }}</span>
          resultados
        </p>
      </div>

      <div>
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
          <div
            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0 cursor-pointer"
            v-for="(link, index) in products.links" :key="index"
            @click="goToPage(link)"
            :class="{'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600': link.active, 'hover:bg-gray-50': !link.active}"
          >
             <div v-if="index === 0">
               <span class="sr-only">Anterior</span>
               <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                 <path
                   fill-rule="evenodd"
                   d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                   clip-rule="evenodd"
                 />
               </svg>
             </div>

            <span v-if="!(index === 0) && !(index === products.links.length - 1)">{{ link.label }}</span>

            <div v-if="index === products.links.length - 1">
              <span class="sr-only">Siguiente</span>
              <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path
                  fill-rule="evenodd"
                  d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                  clip-rule="evenodd"
                />
              </svg>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</template>
