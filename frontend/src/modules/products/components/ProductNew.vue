<script setup lang="ts">
import { ref, watchEffect } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { headerStore } from '../../../store/HeaderStore'
import ProductService from '@/services/ProductService'

const router = useRouter()
const idParam = useRoute().params.id

headerStore.title = `Nuevo Producto`
if (idParam) {
  headerStore.title = `Actualizar Producto`
}
headerStore.description = ''

const id = ref(idParam)
const productForm = ref({
  name: '',
  description: '',
  price: 0,
  quantity: 0,
  image: '',
  category: '',
  brand: '',
  sku: '',
  weight: '',
  dimensions: '',
  featured: false,
  on_sale: true
})

const loading = ref(false)

watchEffect(async () => {
  if (id.value) {
    loading.value = true
    productForm.value = await ProductService.getProduct(id.value)
    loading.value = false
  }
})

const submitProduct = async () => {
  loading.value = true
  try {
    if (id.value) {
      const updateProduct = await ProductService.updateProduct(id.value, productForm.value)
    } else {
      const addProduct = await ProductService.addProduct(productForm.value)
      if (addProduct.id) {
        router.push({ name: 'products' })
      }
    }
    loading.value = false
  } catch (error) {
    loading.value = false
  }
}

const goBack = () => {
  router.go(-1)
}
</script>

<template>
  <div class="flex justify-end">
    <button
      @click="goBack()"
      type="button"
      class="text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-stone-600 dark:hover:bg-stone-700 dark:focus:ring-blue-800"
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
          d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"
        />
      </svg>

      <span class="sr-only">Icon description</span>
    </button>
  </div>

  <form @submit.prevent="submitProduct()" :class="{ 'animate-pulse': loading }">
    <div class="relative z-0 w-full mb-6 group">
      <input
        autocomplete="off"
        v-model="productForm.name"
        type="text"
        name="name"
        id="name"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
        placeholder=" "
        required
      />
      <label
        for="name"
        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        >Nombre del producto</label
      >
    </div>
    <div class="relative z-0 w-full mb-6 group">
      <textarea
        v-model="productForm.description"
        type="text"
        name="description"
        id="description"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
        placeholder=" "
        required
      ></textarea>
      <label
        for="description"
        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        >Descripción</label
      >
    </div>
    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-6 group">
        <input
          autocomplete="off"
          v-model="productForm.price"
          type="number"
          name="price"
          id="price"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" "
          required
        />
        <label
          for="price"
          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
          >Precio</label
        >
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <input
          autocomplete="off"
          v-model="productForm.quantity"
          type="number"
          name="quantity"
          id="quantity"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" "
          required
        />
        <label
          for="quantity"
          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
          >Cantidad en inventario</label
        >
      </div>
    </div>
    <div class="relative z-0 w-full mb-6 group">
      <input
        autocomplete="off"
        v-model="productForm.image"
        type="text"
        name="image"
        id="image"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
        placeholder=" "
      />
      <label
        for="image"
        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        >URL de la imagen del producto</label
      >
    </div>

    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-6 group">
        <input
          autocomplete="off"
          v-model="productForm.category"
          type="text"
          name="category"
          id="category"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" "
          required
        />
        <label
          for="category"
          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
          >Categoría</label
        >
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <input
          autocomplete="off"
          v-model="productForm.brand"
          type="text"
          name="brand"
          id="brand"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" "
        />
        <label
          for="brand"
          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
          >Marca</label
        >
      </div>
    </div>

    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-6 group">
        <input
          autocomplete="off"
          v-model="productForm.weight"
          type="text"
          name="weight"
          id="weight"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" "
        />
        <label
          for="weight"
          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
          >Peso del producto</label
        >
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <input
          autocomplete="off"
          v-model="productForm.dimensions"
          type="text"
          name="dimensions"
          id="dimensions"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" "
        />
        <label
          for="dimensions"
          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
          >Dimensiones del producto</label
        >
      </div>
    </div>

    <div class="relative z-0 w-full mb-6 group">
      <input
        autocomplete="off"
        v-model="productForm.sku"
        type="text"
        name="sku"
        id="sku"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
        placeholder=" "
      />
      <label
        for="sku"
        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        >Código SKU del producto</label
      >
    </div>

    <div class="grid md:grid-cols-2 md:gap-6 mb-6">
      <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
        <input
          autocomplete="off"
          v-model="productForm.featured"
          id="featured"
          type="checkbox"
          value=""
          name="featured"
          class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
        />
        <label for="featured" class="w-full py-4 ml-2 text-sm font-medium text-gray-900"
          >Indicador de si el producto está destacado o no</label
        >
      </div>
      <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
        <input
          autocomplete="off"
          v-model="productForm.on_sale"
          id="on_sale"
          type="checkbox"
          value=""
          name="on_sale"
          class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
        />
        <label for="on_sale" class="w-full py-4 ml-2 text-sm font-medium text-gray-900"
          >Indicador de si el producto está en oferta o no</label
        >
      </div>
    </div>

    <button
      type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    >
      {{ id ? 'Actualizar' : 'Crear' }}
    </button>
  </form>
</template>
