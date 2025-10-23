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
        <div class="md:mx-4 mt-4">
          <a href="#" class="font-normal">
            <span>{{ $t('frontend.common.see_more') }}</span>
            <div class="w-10 h-0.5 bg-yellow-400 rounded-full"></div>
          </a>
        </div>
      </div>

      <!-- List -->
      <div class="relative">
        <swiper ref="swiperRef" v-bind="swiperSettings" @swiper="onSwiper($event)" @slideChange="onSlideChange($event)"
          class="relative !z-0">
          <swiper-slide v-for="(clas, slideIndex) in classItems" :key="slideIndex" :class="[
            { '!w-[330px] 2xs:!w-[402px] lg:!w-[492px] xl:!w-[668px]': slideIndex === 2 },
            { '!w-[180px] lg:!w-[200px] xl:!w-[268px]': slideIndex != 2 },
          ]">
            <div
              class="relative h-[452px] sm:h-[372px] lg:h-[492px] xl:h-[612px] 2xl:h-[640px] rounded-3xl lg:rounded-[60px] overflow-hidden">
              <img :src="clas.imageUrl" alt="news" class="w-full h-full object-cover" />
              <div :class="{ 'hidden': slideIndex != 2 }"
                class="absolute inset-x-5 bottom-5 bg-white text-black py-5 px-7 lg:py-8 lg:px-10 rounded-3xl lg:rounded-[60px] text-justify duration-500">
                <h3 class="text-base lg:text-xl font-medium mb-1 lg:mb-3">{{ clas.title }}</h3>
                <p class="text-xs lg:text-base font-light !leading-5">{{ clas.description }}</p>
              </div>
              <div v-if="slideIndex === 2"
                class="absolute end-3 2xl:end-5 top-14 2xl:top-[72px] z-[5] -translate-y-1/2 h-full flex items-center">
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

    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';
import { computed, ref } from 'vue';

const classItems = ref([
  {
    id: 1,
    imageUrl: '/img/class/1.jpg',
    title: 'Campus Life',
    description: 'Experience vibrant campus life with diverse activities, student clubs, and a supportive community that fosters personal growth and lifelong friendships.',
  },
  {
    id: 2,
    imageUrl: '/img/class/2.jpg',
    title: 'Campus Facilities',
    description: 'State-of-the-art facilities including modern classrooms, science laboratories, sports centers, and recreational areas designed for optimal learning.',
  },
  {
    id: 3,
    imageUrl: '/img/class/3.jpg',
    title: 'Learning Environment',
    description: 'A nurturing and stimulating environment that encourages creativity, critical thinking, and collaborative learning among students.',
  },
  {
    id: 4,
    imageUrl: '/img/class/4.jpg',
    title: 'Sports & Recreation',
    description: 'Comprehensive sports programs and recreational activities that promote physical fitness, teamwork, and healthy competition.',
  },
  {
    id: 5,
    imageUrl: '/img/class/5.jpg',
    title: 'Science Labs',
    description: 'Advanced science laboratories equipped with modern technology to support hands-on learning and scientific research.',
  },
  {
    id: 6,
    imageUrl: '/img/class/6.jpg',
    title: 'Library',
    description: 'A comprehensive library with extensive resources, digital collections, and quiet study spaces for academic research and learning.',
  },
  {
    id: 7,
    imageUrl: '/img/class/7.jpg',
    title: 'Campus Events',
    description: 'Exciting campus events including workshops, guest lectures, and cultural festivals that enrich the student experience.',
  }
]);

const swiperSettings = computed(() => ({
  slidesPerView: 'auto',
  spaceBetween: 35,
  loop: false,
  direction: 'horizontal',
  speed: 600,
  breakpoints: {
    340: {
      spaceBetween: 20,
    },
    768: {
      spaceBetween: 20,
    },
    1024: {
      spaceBetween: 20,
    },
    1280: {
      spaceBetween: 32,
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
