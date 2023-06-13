<script setup lang="ts">
import { headerStore } from '../store/HeaderStore';
import ProductList from '../modules/products/components/ProductList.vue';

headerStore.title = 'Productos';
headerStore.description = 'Crud de productos tienda virtual'

</script>
<template>
    <ProductList />
</template>