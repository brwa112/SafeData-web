<template>
  <section class="mt-16 mb-16 xl:mt-28 lg:mb-16" v-if="Object.keys(galleryByCategory).length > 0">
    <div class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4">
      <!-- Content -->
      <TabGroup @change="handleTabChange">
        <div
          class="relative z-[5] w-full flex-1 flex flex-col md:flex-row md:items-end justify-between gap-5 text-justify">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
            {{ $t('frontend.media.title') }}
          </h2>
          <TabList class="flex flex-wrap gap-1">
            <Tab v-for="(items, categorySlug) in galleryByCategory" :key="categorySlug" v-slot="{ selected }" class="outline-0">
              <button :class="[
                'w-full capitalize rounded-full duration-300 py-2 px-3.5 sm:px-5 text-sm sm:text-base font-normal !leading-5 outline-0 border-0 ring-0',
                selected
                  ? 'text-white bg-f-primary'
                  : 'text-black hover:text-f-primary',
              ]">
                {{ getCategoryName(items[0]) }}
              </button>
            </Tab>
          </TabList>
        </div>
        <!-- Tab -->
        <TabPanels class="mt-10">
          <TabPanel v-for="(categoryItems, categorySlug) in galleryByCategory" :key="categorySlug" class="block">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
              <div v-for="media in getPaginatedItems(categorySlug)" :key="media.id" class="relative group">
                <img :src="media.image" :alt="media.title" class="w-full h-[376px] object-cover" />
                <div
                  class="absolute inset-x-3 lg:inset-x-4 bottom-3 bg-white text-black py-3 px-5 text-justify opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                  <h3 class="text-base font-medium">{{ media.title }}</h3>
                  <p class="text-sm font-light">
                    {{ media.description }}
                  </p>
                </div>
              </div>
            </div>
            
            <!-- Pagination for this category -->
            <Pagination 
              v-if="getPagination(categorySlug).last_page > 1"
              :pagination="getPagination(categorySlug)"
              :client-side="true"
              :preserve-scroll="true"
              :preserve-state="true"
              @page-changed="(page) => handlePageChange(categorySlug, page)"
            />
          </TabPanel>
        </TabPanels>
      </TabGroup>
    </div>
  </section>
</template>

<script setup>
import { computed, ref, reactive } from 'vue'
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import Pagination from '@/Pages/Frontend/Components/Pagination.vue'
import { usePage } from '@inertiajs/vue3';
import helpers from '@/helpers';

// Define props
const props = defineProps({
  data: {
    type: Object,
    default: () => ({})
  }
})

const page = usePage();

// Items per page
const perPage = 8

// Current page for each category
const currentPages = reactive({})

// Current tab index
const currentTab = ref(0)

// Get category name from first item in category
const getCategoryName = (item) => {
  if (!item || !item.category) return 'General'
  return helpers.getTranslatedText(item.category.name, page)
}

// Process gallery data grouped by category
const galleryByCategory = computed(() => {
  if (!props.data || Object.keys(props.data).length === 0) return {}
  
  const processed = {}
  
  Object.entries(props.data).forEach(([categorySlug, items]) => {
    if (!Array.isArray(items)) return
    
    processed[categorySlug] = items.map(item => ({
      id: item.id,
      title: helpers.getTranslatedText(item.title, page),
      description: helpers.getTranslatedText(item.description, page),
      category: item.category,
      image: item.images && item.images.length > 0 
        ? (typeof item.images[0] === 'object' ? item.images[0].medium || item.images[0].url : item.images[0])
        : '/img/media/default.jpg'
    }))
    
    // Initialize current page for this category
    if (!currentPages[categorySlug]) {
      currentPages[categorySlug] = 1
    }
  })
  
  return processed
})

// Get paginated items for a specific category
const getPaginatedItems = (categorySlug) => {
  const items = galleryByCategory.value[categorySlug] || []
  const page = currentPages[categorySlug] || 1
  const start = (page - 1) * perPage
  const end = start + perPage
  
  return items.slice(start, end)
}

// Get pagination info for a specific category
const getPagination = (categorySlug) => {
  const items = galleryByCategory.value[categorySlug] || []
  const total = items.length
  const page = currentPages[categorySlug] || 1
  const lastPage = Math.ceil(total / perPage)
  
  return {
    current_page: page,
    last_page: lastPage,
    per_page: perPage,
    total: total,
    from: total > 0 ? ((page - 1) * perPage) + 1 : 0,
    to: Math.min(page * perPage, total)
  }
}

// Handle page change for a specific category
const handlePageChange = (categorySlug, page) => {
  currentPages[categorySlug] = page
}

// Handle tab change - reset to page 1 when switching categories
const handleTabChange = (index) => {
  currentTab.value = index
  // Note: We don't reset page here as users might want to keep their position
}
</script>
