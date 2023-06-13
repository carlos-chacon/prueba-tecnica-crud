<script setup lang="ts">
import { headerStore } from '../store/HeaderStore';
import ProductList from '../modules/products/components/ProductList.vue';

headerStore.title = 'Productos';
headerStore.description = 'Listados de productos.'

</script>
<template>
    <ProductList />
</template>