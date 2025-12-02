<template>
  <section class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4 mt-15">
    <div class="flex flex-col gap-10 xl:gap-8 py-3 md:py-8 lg:py-16">
      <!-- Top Content -->
      <div class="flex-1 flex flex-col md:flex-row justify-between gap-2">
        <div class="flex-1 space-y-1.5">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
            {{ $t('frontend.classrooms.title') }}
          </h2>
          <p
            class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-pretty max-w-md lg:max-w-xl xl:max-w-2xl">
            {{ $t('frontend.classrooms.description') }}
          </p>
        </div>
        <!-- <div class="md:mx-4 mt-4">
          <a href="#" class="font-normal">
            <span>{{ $t('frontend.common.see_more') }}</span>
            <div class="w-10 h-0.5 bg-yellow-400 rounded-full"></div>
          </a>
        </div> -->
      </div>

      <!-- List -->
      <div v-if="hasData" class="relative">
        <swiper ref="swiperRef" v-bind="swiperSettings" @swiper="onSwiper($event)" @slideChange="onSlideChange($event)"
          class="relative !z-0">
          <swiper-slide v-for="(clas, slideIndex) in classItems" :key="slideIndex" class="group">
            <div
              class="relative h-[452px] sm:h-[372px] lg:h-[492px] xl:h-[612px] 2xl:h-[640px] rounded-3xl lg:rounded-[60px] overflow-hidden">
              <img :src="clas.imageUrl" alt="news" class="w-full h-full object-cover" />
              <div
                class="absolute inset-x-5 bottom-5 bg-white text-black py-5 px-7 lg:py-8 lg:px-10 rounded-3xl lg:rounded-[60px] opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                <h3 class="text-base xl:text-xl font-medium mb-1 xl:mb-3">{{ clas.title }}</h3>
                <p class="text-xs xl:text-base font-light !leading-5 text-justify">{{ clas.description }}</p>
              </div>
              <div
                class="absolute end-3 2xl:end-5 top-14 2xl:top-[72px] z-[5] -translate-y-1/2 h-full flex items-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                <Link :href="branchRoute(`/campus/class/${clas.slug || clas.id}`)"
                  class="relative z-10 flex size-10 xl:size-14 2xl:size-16 rounded-full bg-white items-center justify-center duration-[750ms]">
                  <Svg name="arrow_top" class="relative z-10 h-8 xl:h-12 rtl:-rotate-90"></Svg>
                </Link>
              </div>
            </div>
          </swiper-slide>
        </swiper>

        <!-- Custom Navigation -->
        <div
          class="absolute start-0 sm:-start-2 lg:-start-3 3xl:-start-8 top-1/2 z-5 -translate-y-1/2 flex items-center">
          <button @click="slidePrev()" :class="{ '!bg-gray-100 !text-gray-700 pointer-events-none': isBeginning }"
            class="relative !z-10 flex size-10 xl:size-14 2xl:size-16 rounded-full text-white bg-f-primary items-center justify-center duration-[750ms]">
            <Svg name="arrow-up-light" class="relative !z-10 h-5 xl:h-8 ltr:rotate-180"></Svg>
          </button>
        </div>
        <div
          class="absolute end-0 sm:-end-2 lg:-end-3 3xl:-end-3 top-1/2 z-5 -translate-y-1/2 flex items-center">
          <button @click="slideNext()" :class="{ '!bg-gray-100 !text-gray-700 pointer-events-none': isEnd }"
            class="relative !z-10 flex size-10 xl:size-14 2xl:size-16 rounded-full text-white bg-f-primary items-center justify-center duration-[750ms]">
            <Svg name="arrow-up-light" class="relative !z-10 h-5 xl:h-8 rtl:rotate-180"></Svg>
          </button>
        </div>
      </div>

      <!-- No Classrooms Found Message -->
      <div v-else class="flex flex-col items-center justify-center py-16 px-4">
        <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        <h3 class="text-xl md:text-2xl font-semibold text-gray-700 mb-2">
          {{ $t('frontend.classrooms.no_classrooms_found') }}
        </h3>
        <p class="text-gray-500 text-center max-w-md">
          {{ $t('frontend.classrooms.no_classrooms_available') }}
        </p>
      </div>

    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import helpers from '@/helpers';

const props = defineProps({
  classrooms: {
    type: Array,
    default: () => []
  }
});

const page = usePage();

// Check if there's data to display
const hasData = computed(() => props.classrooms && props.classrooms.length > 0);

// Transform backend data to frontend format
const classItems = computed(() => {
  if (!props.classrooms || props.classrooms.length === 0) {
    return [];
  }

  return props.classrooms.map(classroom => ({
    id: classroom.id,
    slug: classroom.slug || classroom.id,
    imageUrl: classroom.imageUrl || (classroom.images && classroom.images.length > 0 ? classroom.images[0].medium || classroom.images[0].url : '/img/class/1.jpg'),
    title: helpers.getTranslatedText(classroom.title, page),
    description: helpers.limitWords(helpers.getTranslatedText(classroom.content, page), 100),
  }));
});

const swiperSettings = computed(() => ({
  slidesPerView: 2,
  spaceBetween: 35,
  loop: false,
  direction: 'horizontal',
  speed: 600,
  breakpoints: {
    340: {
      spaceBetween: 20,
      slidesPerView: 1,
    },
    768: {
      spaceBetween: 20,
      slidesPerView: 2,
    },
    1024: {
      spaceBetween: 20,
      slidesPerView: 2,
    },
    1280: {
      spaceBetween: 32,
      slidesPerView: 2,
    },
  },
}))

const swiperInstance = ref(null)
const isEnd = ref(false)
const isBeginning = ref(true)

const onSwiper = (swiper) => {
  swiperInstance.value = swiper
  isEnd.value = swiper.isEnd
  isBeginning.value = swiper.isBeginning
}

const onSlideChange = (swiper) => {
  isEnd.value = swiper.isEnd
  isBeginning.value = swiper.isBeginning
}

const slideNext = () => {
  swiperInstance.value?.slideNext()
  isEnd.value = swiperInstance.value?.isEnd
  isBeginning.value = swiperInstance.value?.isBeginning
}

const slidePrev = () => {
  swiperInstance.value?.slidePrev()
  isEnd.value = swiperInstance.value?.isEnd
  isBeginning.value = swiperInstance.value?.isBeginning
}
</script>

<style scoped>
.swiper {
  overflow: visible !important;
}

.swiper-wrapper {
  height: auto !important;
}

.swiper-slide {
  height: auto !important;
}
</style>
