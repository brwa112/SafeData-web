<template>
  <section v-if="hasNews" class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4">
    <div class="flex flex-col gap-10 xl:gap-16 py-3 md:py-8 lg:py-16">
      <!-- Top Content -->
      <div class="flex-1 flex flex-col md:flex-row md:items-center justify-between gap-2">
        <div class="flex-1 space-y-1.5">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black leading-tight">
            {{ $t('frontend.news.title') }}
          </h2>
          <p
            class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-pretty max-w-md lg:max-w-xl xl:max-w-2xl">
            {{ $t('frontend.news.description') }}
          </p>
        </div>
        <div class="md:mx-4 mt-4">
          <Link :href="branchRoute('news')" class="font-normal">
          <span>{{ $t('frontend.common.see_more') }}</span>
          <div class="w-10 h-0.5 bg-yellow-400 rounded-full"></div>
          </Link>
        </div>
      </div>

      <!-- News Grid -->
      <div class="flex-1 grid sm:grid-cols-3 gap-3 md:gap-6 lg:gap-8">
        <Link v-for="item in displayNews" :key="item.id" :href="`/${item.branch.slug}/news/${item.slug}`"
          class="relative h-[532px] sm:h-[332px] md:h-[412px] lg:h-[532px] xl:h-[652px] 2xl:h-[732px] overflow-hidden group cursor-pointer">
        <img :src="item.image" :alt="item.title"
          class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
        <div class="absolute inset-0 flex flex-col justify-end p-4">
          <h3 v-if="item.title"
            class="relative z-10 text-white text-base sm:text-xs lg:text-sm xl:text-base 2xl:text-lg lg:!leading-6 font-semibold mb-2">
            {{ helpers.getTranslatedText(item.title, page) }}
          </h3>
          <p
            class="relative z-10 text-white text-base sm:text-xs lg:text-sm xl:text-base 2xl:text-lg lg:!leading-6 font-light line-clamp-3">
            {{ helpers.getTranslatedText(item.content, page) || item.description }}
          </p>
        </div>
        <div class="absolute inset-x-0 bottom-0 h-[200px] bg-gradient-to-t from-gray-950/70 to-transparent"></div>
        </Link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import helpers from '@/helpers';

// Define props
const props = defineProps({
  data: {
    type: Array,
    default: () => []
  }
});

const page = usePage();

// Computed property for displaying news
const displayNews = computed(() => {
  return hasNews.value ? props.data : [];
});

// Check if we have news from database
const hasNews = computed(() => {
  return props.data && Array.isArray(props.data) && props.data.length > 0;
});
</script>
