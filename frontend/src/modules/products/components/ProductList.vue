<script setup lang="ts">
import { ref, watchEffect, type Ref } from 'vue'
import ProductService from '../../../services/ProductService'
import type { LinkPage, Product } from '../types'
import Swal from 'sweetalert2'

const products: Ref<any> = ref(null)
const q = ref('')
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

const deleteProduct = async (product: Product) => {
  Swal.fire({
    title: `Desea eliminar este producto: ${product.name}`,
    showCancelButton: true,
    showLoaderOnConfirm: true,
    confirmButtonText: 'OK',
    preConfirm: async () => {
      const deleteProduct = await ProductService.deleteProduct(product.id)
      if (deleteProduct) {
        products.value.data = products.value.data.filter((item: Product) => item.id !== product.id)
      }
      return deleteProduct
    }
  })
}
</script>

<template>
  <RouterLink
    :to="{ name: 'product-new' }"
    class="rounded-full relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0 cursor-pointer z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-indigo-700 mb-3"
  >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="w-6 h-6"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
      />
    </svg>
    Nuevo
  </RouterLink>

  <form class="flex items-center mb-4">
    <label for="simple-search" class="sr-only">Search</label>
    <div class="relative w-full">
      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <svg
          aria-hidden="true"
          class="w-5 h-5 text-gray-500 dark:text-gray-400"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </div>
      <input
        autocomplete="off"
        v-model="q"
        type="text"
        id="simple-search"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Buscar ..."
        required
      />
    </div>
    <button
      type="submit"
      class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    >
      <svg
        class="w-5 h-5"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
        ></path>
      </svg>
      <span class="sr-only">Search</span>
    </button>
  </form>

  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200" :class="{ 'animate-pulse': !products }">
      <thead>
        <tr>
          <th>Acción</th>
          <th class="py-3 px-6 text-left">Nombre</th>
          <th class="py-3 px-6 text-left">Descripción</th>
          <th class="py-3 px-6 text-left">Precio</th>
          <th class="py-3 px-6 text-left">Cantidad</th>
          <th class="py-3 px-6 text-left">Categoría</th>
          <th class="py-3 px-6 text-left">Marca</th>
          <th class="py-3 px-6 text-left">Destacado</th>
          <th class="py-3 px-6 text-left">En oferta</th>
          <th class="py-3 px-6 text-left">Fecha Creación</th>
          <th class="py-3 px-6 text-left">Fecha Actualización</th>
        </tr>
      </thead>
      <tbody>
        <template v-if="products">
          <tr class="bg-white" v-for="product in products.data" :key="product.id">
            <td class="py-4 px-6 border-b border-gray-200">
              <div class="flex">
                <RouterLink
                  :to="{ name: 'product-edit', params: { id: product.id } }"
                  type="button"
                  class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-blue-800"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                    />
                  </svg>

                  <span class="sr-only">Editar</span>
                </RouterLink>

                <button
                  @click="deleteProduct(product)"
                  type="button"
                  class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                    />
                  </svg>

                  <span class="sr-only">Borrar</span>
                </button>
              </div>
            </td>
            <td class="py-4 px-6 border-b border-gray-200">{{ product.name }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ product.description }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ product.price }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ product.quantity }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ product.category }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ product.brand }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ product.featured ? 'Si' : 'No' }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ product.on_sale ? 'Si' : 'No' }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ product.created_at }}</td>
            <td class="py-4 px-6 border-b border-gray-200">{{ product.updated_at }}</td>
          </tr>
        </template>
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
            v-for="(link, index) in products.links"
            :key="index"
            @click="goToPage(link)"
            :class="{
              'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600':
                link.active,
              'hover:bg-gray-50': !link.active
            }"
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

            <span v-if="!(index === 0) && !(index === products.links.length - 1)">{{
              link.label
            }}</span>

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
