<template>
  <div class="block min-h-[100dvh]">
    <Detalils v-if="featuredNews" :news="featuredNews" />
    <Latest :news="news" :categories="categories" :selectedCategory="selectedCategory" :initialSearchQuery="searchQuery" />
  </div>
</template>

<script setup>
import Detalils from './partials/Detalils.vue';
import Latest from './partials/Latest.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

// Receive props from controller
defineProps({
  featuredNews: Object,
  news: Object,
  categories: Array,
  selectedCategory: String,
  searchQuery: String,
});

defineOptions({
  layout: PublicLayout
});
</script>

