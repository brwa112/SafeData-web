<template>
  <div class="block min-h-[100dvh]">
    <Academic :academic="academic" />
    <Official :official="official" />
    <Important :important="important" />
  </div>
</template>

<script setup>
import Academic from './partials/Academic.vue';
import Official from './partials/Official.vue';
import Important from './partials/Important.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

defineProps({
  academic: {
    type: Object,
    default: null
  },
  official: {
    type: Object,
    default: null
  },
  important: {
    type: Object,
    default: null
  }
});

defineOptions({
  layout: PublicLayout
});
</script>

