<template>
  <div class="block min-h-[100dvh]">
    <Hero :data="hero" />
    <History :data="history" />
    <Message :data="message" />
    <Mission :data="mission" />
    <News />
    <Know :data="social" />
  </div>
</template>

<script setup>
import Hero from './partials/Hero.vue'
import History from './partials/History.vue'
import Know from './partials/Know.vue';
import Message from './partials/Message.vue';
import Mission from './partials/Mission.vue';
import News from './partials/News.vue';

// Define props for home sections data
const props = defineProps([
  'hero',
  'history',
  'message',
  'mission',
  'social'
]);
</script>

<script>
import layout from '@/Pages/Frontend/Layouts/Public.vue'

export default {
    layout: layout,
}
</script>
