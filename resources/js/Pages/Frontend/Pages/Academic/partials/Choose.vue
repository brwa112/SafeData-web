<template>
  <section class="relative overflow-hidden mb-20">
    <div class="w-full sm:container 3xl:max-w-[67%] mx-auto px-4">
      <div class="relative flex flex-col items-center justify-between gap-y-7 lg:gap-y-14 gap-x-8 xl:gap-x-10 py-16">
        <!-- Content -->
        <div class="relative z-[5] flex-1 text-center space-y-1.5 max-w-xl xl:max-w-2xl">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-gray-950 !leading-tight">
            {{ $t('frontend.academic.choose_title') }}
          </h2>
          <p class="!leading-6 text-base lg:text-base xl:text-xl font-normal text-pretty">
            {{ description }}
          </p>
        </div>
        <div class="w-full flex flex-col gap-5">
          <div v-for="(reason, index) in reasons" :key="index"
            class="group relative z-10 w-full flex items-center gap-4 sm:gap-9 lg:gap-13">
            <img :src="`/img/academic/${index + 1}.svg`" alt="reason icon"
              class="size-10 sm:size-auto object-contain" />
            <div
              :class="`relative z-[5] w-full flex-1 text-center bg-white ${getBorderColor(index)} border-e-2 rounded-2xl px-3 sm:px-7 lg:px-8 py-4 sm:py-6.5 overflow-hidden`">
              <div class="relative z-[5] space-y-0.5 group-hover:text-white duration-500">
                <h2 class="text-base lg:text-lg xl:text-xl ltr:font-medium rtl:font-semibold !leading-tight">
                  {{ reason.title }}
                </h2>
                <p class="leading-6 text-base lg:text-lg xl:text-xl font-normal text-pretty">
                  {{ reason.description }}
                </p>
              </div>
              <div
                :class="`absolute inset-y-0 end-0 z-0 start-full group-hover:start-0 opacity-0 group-hover:opacity-100 duration-500 rounded-2xl ${getBgColor(index)}`">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Background Lines -->
    <div class="absolute inset-0 z-0 flex bg-gray-50/50">
      <div v-for="i in 150" :key="i" class="divide-x-3 divide-y-3 divide-gray-100/50">
        <div v-for="i in 150" :key="i" class="size-8"></div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import helpers from '@/helpers';

const props = defineProps({
  choose: {
    type: Object,
    default: null
  }
});

const page = usePage();

// Get description from database or fallback to translation
const description = computed(() => {
  if (props.choose?.description) {
    return helpers.getTranslatedText(props.choose.description, page);
  }
  return page.props.locale === 'ckb'
    ? 'ئێمە باوەڕمان وایە هەر خوێندکارێک تایبەتە. بۆیە ڕێژەی کەمی خوێندکار بۆ مامۆستا ڕێگە بە سەرنج و ڕێگای فێربوونی تایبەتمەند دەدات.'
    : 'We offer a holistic, student-centered educational experience that blends academic learning with personal development.';
});

// Get reasons from database or fallback to hardcoded list
const reasons = computed(() => {
  if (props.choose?.reasons) {
    const translatedReasons = helpers.getTranslatedText(props.choose.reasons, page);
    // Check if it's an array
    if (Array.isArray(translatedReasons)) {
      return translatedReasons;
    }
  }

  // Fallback data
  return [
    {
      title: 'Top Recognition',
      description: 'Awarded by the Ministry of Education',
    },
    {
      title: 'Expert Educators',
      description: 'Experienced, passionate teachers',
    },
    {
      title: 'Modern Facilities',
      description: 'Smart classrooms, labs, and digital learning tools',
    },
    {
      title: 'Strong Values',
      description: 'Leadership, empathy, and responsibility',
    },
    {
      title: 'University Preparation',
      description: 'Proven success in student outcomes',
    }
  ];
});

// Helper functions for icons and colors
// const getIcon = (index) => {
//   return `/img/academic/${(index % 5) + 1}.svg`;
// };

const getBgColor = (index) => {
  const colors = [
    'bg-[#F0457D]/100',
    'bg-[#FFD44D]/100',
    'bg-[#0099F5]/100',
    // 'bg-[#F0457D]/100',
    // 'bg-[#FFD44D]/100'
  ];
  return colors[index % colors.length];
};

const getBorderColor = (index) => {
  const colors = [
    'border-[#F0457D]',
    'border-[#FFD44D]',
    'border-[#0099F5]',
    // 'border-[#F0457D]',
    // 'border-[#FFD44D]'
  ];
  return colors[index % colors.length];
};
</script>
