<template>
  <section class="mt-16 mb-16 xl:mt-32 lg:mb-16">
    <div class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4">
      <div class="relative flex flex-col lg:flex-row items-center justify-between gap-y-14 gap-x-8 xl:gap-x-10 py-16">
        <!-- Left Content -->
        <div class="relative z-5 flex-1 space-y-1.5 max-w-xl xl:max-w-2xl text-justify">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black leading-tight">
            {{ $t('frontend.about.title') }}
          </h2>
          <div class="space-y-5" v-html="description"></div>
        </div>

        <!-- Right Content - Images -->
        <div class="relative pe-10 sm:pe-20 2xl:pe-[136px]">
          <div class="relative z-[2] w-[288px] h-[288px] sm:w-[432px] sm:h-[432px] xl:w-[512px] xl:h-[512px]">
            <img :src="mainImage" alt="about" class="w-full h-full object-cover" />
          </div>
          <div
            class="absolute top-5 start-5 z-[1] bg-[#5977FE] w-[288px] h-[288px] sm:w-[432px] sm:h-[432px] xl:w-[512px] xl:h-[512px]">
          </div>
          <div class="absolute -top-5 sm:-top-10 start-14 sm:start-[84px] z-[3]">
            <img :src="'/img/about/scribble.svg'" alt="decoration" class="size-1/2 sm:size-full object-cover" />
          </div>
          <div class="absolute top-1/2 -end-20 sm:-end-8 2xl:end-0 z-[3]">
            <img :src="'/img/about/ruler.svg'" alt="decoration" class="size-1/2 sm:size-full object-cover" />
          </div>
          <div class="absolute -bottom-7 sm:-bottom-14 start-20 sm:start-32 z-[3]">
            <img :src="'/img/about/shape-yellow.svg'" alt="decoration" class="size-1/2 sm:size-full object-cover" />
          </div>
        </div>
      </div>
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
      <p class="!leading-6 text-base lg:text-base xl:text-xl font-normal text-pretty">
        Kurd Genius School was established in 2013 by Maya Company, a proud member of the Qaiwan Group of Companies,
        and is led by Mrs. Sozan Abubakr Mawlud.
      </p>
      <p class="!leading-6 text-base lg:text-base xl:text-xl font-normal text-pretty !mt-5">
        Since its foundation, the school has consistently ranked among the top performing educational institutions
        in the Kurdistan Region, earning annual recognition from the Ministry of Education.
      </p>
      <p class="!leading-6 text-base lg:text-base xl:text-xl font-normal text-pretty !mt-5">
        Our 12th-grade students regularly achieve exceptional academic results, frequently placing among the
        region's highest achievers. Their accomplishments are widely celebrated on social media and in the press.
        Many graduates continue their academic journey at top-tier universities both locally and internationally.
      </p>
      <p class="!leading-6 text-base lg:text-base xl:text-xl font-normal text-pretty !mt-5">
        In addition to academic success, Kurd Genius is known for fostering innovation, leadership, and community
        engagement through extracurricular activities, science fairs, and student-driven projects.
      </p>
    `;
  }
  // Format the description with proper paragraph styling
  return desc.split('\n').filter(p => p.trim()).map(p => 
    `<p class="!leading-6 text-base lg:text-base xl:text-xl font-normal text-pretty !mt-5">${p.trim()}</p>`
  ).join('');
});

const mainImage = computed(() => {
  // Check if data has an image property (single image URL from system controller)
  if (props.data.image && typeof props.data.image === 'string') {
    return props.data.image;
  }
  // Check if images array exists and has items (from frontend controller)
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
  return '/img/about/1.jpg';
});
</script>
