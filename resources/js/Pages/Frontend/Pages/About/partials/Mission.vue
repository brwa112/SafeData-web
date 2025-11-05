<template>
  <section class="relative mb-10 bg-[#F4F7FF] overflow-hidden">
    <div class="w-full sm:container 3xl:max-w-[75%] mx-auto px-4">
      <div class="relative flex items-center justify-center gap-5 xl:gap-10 py-16 lg:py-[110px]">
        <!-- Content -->
        <div class="relative z-[5] flex-1 flex flex-col items-center space-y-3.5 max-w-xl xl:max-w-2xl text-white">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold !leading-tight">
            {{ $t('frontend.mission.title') }}
          </h2>
          <div class="space-y-4" v-html="description"></div>
        </div>
      </div>
      <!-- Background Image -->
      <div class="absolute inset-0">
        <img :src="backgroundImage" alt="mission background" class="w-full h-full object-cover object-[50%_96.5%]" />
      </div>
      <div class="absolute inset-0 bg-[#0B1441]/70"></div>
      <div class="absolute inset-0 bg-black/15"></div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import helpers from '@/helpers';

const props = defineProps({
  data: {
    type: Object,
    default: () => ({})
  }
});

const page = usePage();

// Computed properties for content
const description = computed(() => {
  const desc = helpers.getTranslatedText(props.data.description, page);
  if (!desc) {
    return `
      <p class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-justify">
        At Kurd Genius School, our mission is to create a safe, inclusive, and inspiring learning environment where
        every student is empowered to reach their full potential. We strive to develop lifelong learners who are
        academically prepared, socially responsible, and globally minded. Through high quality education, modern
        teaching methods, and strong moral values, we prepare our students to become leaders, critical thinkers, and
        compassionate citizens.
      </p>
    `;
  }
  // Format the description with proper paragraph styling
  return desc.split('\n').filter(p => p.trim()).map(p => 
    `<p class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-justify">${p.trim()}</p>`
  ).join('');
});

const backgroundImage = computed(() => {
  // Check if images array exists and has items
  if (props.data.images && props.data.images.length > 0) {
    const firstImage = props.data.images[0];
    // If the image is an object with url property, use it
    if (typeof firstImage === 'object' && firstImage.url) {
      return firstImage.url;
    }
    // If it's already a string URL, use it directly
    if (typeof firstImage === 'string') {
      return firstImage;
    }
  }
  // Final fallback to default image
  return '/img/about/bg_mission.jpg';
});
</script>
