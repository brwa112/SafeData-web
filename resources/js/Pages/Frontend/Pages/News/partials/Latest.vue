<template>
  <section class="mt-10 mb-16 xl:mt-24 lg:mb-32">
    <div class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4">
      <!-- Content -->
      <div class="relative z-[5] w-full flex-1 flex flex-col items-center justify-center gap-5 text-justify">
        <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
          {{ $t('frontend.news.latest_news') }}
        </h2>
        <!-- Input Search -->
        <div class="relative w-full max-w-xl">
          <input v-model="searchQuery" @input="handleSearch" type="text"
            :placeholder="$t('frontend.news.search_placeholder')"
            class="w-full border bg-blue-50 text-black placeholder:text-black rounded-full py-4 px-7 text-sm sm:text-base font-normal !leading-5 border-transparent outline-0 focus:ring-0" />
        </div>
        <!-- Category Tabs -->
        <div class="flex justify-center flex-wrap gap-1">
          <Link v-for="category in categories" :key="category.slug" :href="branchRoute('/news')"
            :data="{ category: category.slug }" :class="[
              'rounded-full duration-300 py-2 px-3.5 sm:px-5 text-sm sm:text-base capitalize font-normal !leading-5 outline-0 border-0 ring-0',
              isActiveCategory(category.slug)
                ? 'text-white bg-f-primary'
                : 'text-black hover:text-f-primary',
            ]" preserve-scroll>
          {{ getCategoryName(category) }}
          </Link>
        </div>
      </div>

      <!-- News Grid -->
      <div v-if="news && news.data && news.data.length > 0"
        class="mt-10 flex-1 grid sm:grid-cols-3 gap-3 md:gap-6 lg:gap-8">
        <Link v-for="item in news.data" :key="item.id" :href="branchRoute(`/news/${item.slug || item.id}`)"
          class="relative h-[532px] sm:h-[332px] md:h-[412px] lg:h-[532px] xl:h-[652px] 2xl:h-[732px] overflow-hidden group">
        <img :src="getNewsImage(item)" :alt="getNewsTitle(item)"
          class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
        <p
          class="absolute bottom-3 lg:bottom-6 xl:bottom-11 z-[2] text-white p-4 text-base sm:text-xs lg:text-sm xl:text-base 2xl:text-lg lg:leading-6 font-light line-clamp-3">
          {{ getNewsExcerpt(item) }}
        </p>
        <div class="absolute inset-x-0 bottom-0 z-[1] h-[200px] bg-gradient-to-t from-gray-950/70 to-transparent">
        </div>
        </Link>
      </div>

      <!-- No Results Message -->
      <div v-else class="mt-10 flex flex-col items-center justify-center py-16 px-4">
        <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3 class="text-xl md:text-2xl font-semibold text-gray-700 mb-2">
          {{ $t('frontend.news.no_news_found') }}
        </h3>
        <p class="text-gray-500 text-center max-w-md">
          {{ searchQuery ? $t('frontend.news.try_different_search') : $t('frontend.news.no_news_available') }}
        </p>
      </div>

      <!-- Pagination -->
      <Pagination v-if="news && news.last_page > 1" :pagination="news" :preserve-scroll="true" :preserve-state="true" />
    </div>
  </section>
</template>

<script setup>
import { Link, usePage, router } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import Pagination from '@/Pages/Frontend/Components/Pagination.vue'
import helpers from '@/helpers'

const props = defineProps({
  news: {
    type: Object,
    default: () => ({
      data: [],
      current_page: 1,
      last_page: 1,
      per_page: 6,
      total: 0,
    })
  },
  categories: {
    type: Array,
    default: () => [],
  },
  selectedCategory: {
    type: String,
    default: null,
  },
  initialSearchQuery: {
    type: String,
    default: '',
  },
});

const page = usePage();
const searchQuery = ref(props.initialSearchQuery || '');
let searchTimeout = null;

// Handle search with debounce
const handleSearch = () => {
  if (searchTimeout) {
    clearTimeout(searchTimeout);
  }

  searchTimeout = setTimeout(() => {
    const params = {
      search: searchQuery.value || undefined,
      category: props.selectedCategory || undefined,
    };

    router.get(branchRoute('/news'), params, {
      preserveState: true,
      preserveScroll: true,
      replace: true,
    });
  }, 500); // 500ms debounce
};

// Watch for initialSearchQuery changes from props
watch(() => props.initialSearchQuery, (newValue) => {
  searchQuery.value = newValue || '';
});

// Helper function to generate branch-aware routes
const branchRoute = (path) => {
  return helpers.branchRoute(path);
};

// Check if category is active
const isActiveCategory = (categorySlug) => {
  // If selectedCategory is explicitly provided, use it
  if (props.selectedCategory) {
    return props.selectedCategory === categorySlug;
  }

  // If no category selected and we have categories, the first one is active
  if (props.categories && props.categories.length > 0) {
    return categorySlug === props.categories[0].slug;
  }

  return false;
};

// Get category name
const getCategoryName = (category) => {
  if (!category || !category.name) return 'General';
  return helpers.getTranslatedText(category.name, page);
};

// Get translated news title
const getNewsTitle = (newsItem) => {
  return helpers.getTranslatedText(newsItem.title, page);
};

// Get news excerpt (first 150 characters of content)
const getNewsExcerpt = (newsItem) => {
  const content = helpers.getTranslatedText(newsItem.content, page);
  return content.length > 150 ? content.substring(0, 150) + '...' : content;
};

// Get news image
const getNewsImage = (newsItem) => {
  if (newsItem.images && newsItem.images.length > 0) {
    return newsItem.images[0].medium || newsItem.images[0].url;
  }
  return `/img/news/default.jpg`;
};
</script>
