<template>
  <div class="relative bg-f-primary">

    <Head>
      <title>Safe Data Company</title>
    </Head>

    <!-- Animation Background -->
    <div class="fixed inset-0">
      <AnimationBg />
    </div>

    <section class="first">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg relative flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <HeroPage :services="services" />
          </div>
        </div>
      </div>
    </section>
    <section class="second">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <ProductsPage :products="products" />
          </div>
        </div>
      </div>
    </section>
    <section class="third">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <ServicesPage :services="services" />
          </div>
        </div>
      </div>
    </section>
    <section class="fourth">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <HostingPage :hosting="hosting" />
          </div>
        </div>
      </div>
    </section>
    <section class="fifth">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <ClientsPage :clients="clients" />
          </div>
        </div>
      </div>
    </section>
    <section class="sixth">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <AboutPage />
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref, onMounted, inject, watch } from 'vue';

import HeroPage from './pages/HeroPage.vue';
import ProductsPage from './pages/ProductsPage.vue';
import ServicesPage from './pages/ServicesPage.vue';
import HostingPage from './pages/HostingPage.vue';
import AnimationBg from './components/AnimationBg.vue';
import ClientsPage from './pages/ClientsPage.vue';
import AboutPage from './pages/AboutPage.vue';

const props = defineProps([
    'services',
    'clients',
    'products',
    'hosting',
]);
</script>

<script>
import layout from './Layouts/Public.vue'
import { Head } from '@inertiajs/vue3';

export default {
  layout: layout,
}
</script>
