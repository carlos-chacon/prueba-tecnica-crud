<script setup lang="ts">
import HeaderLayout from './layouts/HeaderLayout.vue';
import MenuLayout from './layouts/MenuLayout.vue';
import { headerStore } from './store/HeaderStore';
</script>

<template>
  <div class="min-h-full">

    <MenuLayout />

    <HeaderLayout :title="headerStore.title" :description="headerStore.description" />

    <main>
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <RouterView />
      </div>
    </main>
  </div>  
</template>

<style scoped></style>
