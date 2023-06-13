<script setup lang="ts">
import HomeWelcome from '../modules/home/components/HomeWelcome.vue'
import { headerStore } from '../store/HeaderStore';

headerStore.title = 'Prueba técnica Blue Web Factory B.V. ';
headerStore.description = ''
</script>

<template>
  <HomeWelcome />
</template>
