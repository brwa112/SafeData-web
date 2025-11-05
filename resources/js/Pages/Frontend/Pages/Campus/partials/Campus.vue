<template>
  <section class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4 mt-20 lg:mt-16 xl:mt-24">
    <div class="flex flex-col gap-10 xl:gap-8 py-3 md:py-8 lg:py-16">
      <!-- Top Content -->
      <div class="flex-1 flex flex-col md:flex-row justify-between gap-2">
        <div class="flex-1 space-y-1.5">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
            {{ $t('frontend.campus.title') }}
          </h2>
          <p
            class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-pretty max-w-md lg:max-w-xl xl:max-w-2xl">
            {{ $t('frontend.campus.description') }}
          </p>
        </div>
        <!-- <div class="md:mx-4 mt-4">
          <Link href="" class="font-normal">
          <span>{{ $t('frontend.common.see_more') }}</span>
          <div class="w-10 h-0.5 bg-yellow-400 rounded-full"></div>
          </Link>
        </div> -->
      </div>

      <!-- List -->
      <div class="relative">
        <swiper ref="swiperRef" v-bind="swiperSettings" @swiper="onSwiper($event)" @slideChange="onSlideChange($event)"
          class="relative !z-0">
          <swiper-slide v-for="(cumpus, slideIndex) in campusItems" :key="slideIndex" class="group">
            <div
              class="relative z-0 h-[452px] sm:h-[372px] lg:h-[492px] xl:h-[612px] 2xl:h-[640px] rounded-[40px] lg:rounded-[60px] overflow-hidden">
              <img :src="cumpus.imageUrl" alt="news" class="w-full h-full object-cover" />
              <div
                class="absolute inset-x-5 bottom-5 bg-white text-black py-5 px-7 lg:py-8 lg:px-10 rounded-[40px] lg:rounded-[60px] opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                <Link :href="branchRoute(`/campus/${cumpus.slug || cumpus.id}`)">
                <h3 class="text-base xl:text-xl font-medium mb-1 xl:mb-3">{{ cumpus.title }}</h3>
                </Link>
                <p class="text-xs xl:text-base font-light !leading-5 text-justify">{{ cumpus.description }}</p>
              </div>
              <div
                class="absolute end-3 2xl:end-5 top-14 2xl:top-[72px] z-[5] -translate-y-1/2 h-full flex items-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                <Link :href="branchRoute(`/campus/${cumpus.slug || cumpus.id}`)"
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
        <div class="absolute end-0 sm:-end-2 lg:-end-3 3xl:-end-3 top-1/2 z-5 -translate-y-1/2 flex items-center">
          <button @click="slideNext()" :class="{ '!bg-gray-100 !text-gray-700 pointer-events-none': isEnd }"
            class="relative !z-10 flex size-10 xl:size-14 2xl:size-16 rounded-full text-white bg-f-primary items-center justify-center duration-[750ms]">
            <Svg name="arrow-up-light" class="relative !z-10 h-5 xl:h-8 rtl:rotate-180"></Svg>
          </button>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import helpers from '@/helpers';

const props = defineProps({
  campuses: {
    type: Array,
    default: () => []
  }
});

const page = usePage();

// Transform backend data to frontend format
const campusItems = computed(() => {
  if (!props.campuses || props.campuses.length === 0) {
    // Fallback to hardcoded data if no backend data
    return [
      {
        id: 1,
        slug: '1',
        imageUrl: '/img/campus/1.jpg',
        title: 'Campus Life',
        description: 'Experience vibrant campus life with diverse activities, student clubs, and a supportive community that fosters personal growth and lifelong friendships.',
      },
      {
        id: 2,
        slug: '2',
        imageUrl: '/img/campus/2.jpg',
        title: 'Campus Facilities',
        description: 'State-of-the-art facilities including modern classrooms, science laboratories, sports centers, and recreational areas designed for optimal learning.',
      },
      {
        id: 3,
        slug: '3',
        imageUrl: '/img/campus/3.jpg',
        title: 'Learning Environment',
        description: 'A nurturing and stimulating environment that encourages creativity, critical thinking, and collaborative learning among students.',
      },
    ];
  }

  return props.campuses.map(campus => ({
    id: campus.id,
    slug: campus.slug || campus.id,
    imageUrl: campus.imageUrl || (campus.images && campus.images.length > 0 ? campus.images[0].medium || campus.images[0].url : '/img/campus/1.jpg'),
    title: helpers.getTranslatedText(campus.title, page),
    description: helpers.limitWords(helpers.getTranslatedText(campus.content, page), 33),
  }));
});

const swiperSettings = computed(() => ({
  slidesPerView: 2,
  spaceBetween: 35,
  loop: false,
  direction: 'horizontal',
  speed: 600,
  breakpoints: {
    0: {
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
  /* width: auto !important; */
}
</style>
