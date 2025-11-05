<template>
  <section class="bg-[#F4F7FF] mb-16 lg:mb-16">
    <div class="w-full sm:container 3xl:max-w-[70%] mx-auto px-4">
      <div class="relative flex flex-col items-start gap-y-5 gap-x-8 xl:gap-x-10 py-16 md:py-24">
        <!-- Left Content -->
        <div class="relative z-[5] flex-1 space-y-1.5 max-w-xl xl:max-w-2xl text-justify">
          <h2 class="relative z-10 text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
            {{ $t('frontend.calendar.official_title') }}
          </h2>
          <p class="relative z-10 !leading-6 text-base lg:text-base xl:text-xl font-normal text-pretty">
            {{ description }}
          </p>
          <img :src="'/img/shape_star.svg'" alt="ShapeOne" class="absolute -top-8 -start-10 3xl:-start-20 opacity-40 3xl:opacity-100 rtl:scale-x-[-1]" />
        </div>

        <!-- List -->
        <div class="relative z-[5]">
          <ul v-if="holidays && holidays.length > 0" class="list-disc list-inside -space-y-1 ms-6">
            <li v-for="(holiday, index) in holidays" :key="index" class="text-base lg:text-xl">{{ holiday }}</li>
          </ul>
        </div>

        <div class="absolute end-20 bottom-20 md:bottom-36 overflow-hidden opacity-20 md:opacity-100">
          <div class="size-6 bg-[#019BFF] rounded-full rtl:scale-x-[-1]"></div>
        </div>
        <div class="absolute end-10 bottom-24 md:bottom-40 overflow-hidden opacity-20 md:opacity-100">
          <img :src="'/img/shape_one.png'" alt="ShapeOne" class="rtl:scale-x-[-1]" />
        </div>
        <div class="absolute end-0 bottom-14 md:bottom-28 overflow-hidden opacity-20 md:opacity-100">
          <img :src="'/img/shape_two.png'" alt="ShapeOne" class="rtl:scale-x-[-1]" />
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
  official: {
    type: Object,
    default: null
  }
});

const page = usePage();

const description = computed(() => {
  if (props.official?.description) {
    return helpers.getTranslatedText(props.official.description, page);
  }
  return page.props.$t?.('frontend.calendar.official_description') || '';
});

const holidays = computed(() => {
  if (props.official?.holidays) {
    return helpers.getTranslatedText(props.official.holidays, page);
  }
  return null;
});
</script>

