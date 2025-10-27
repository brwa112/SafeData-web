<template>
  <section class="relative">
    <!-- Hero -->
    <div class="relative min-h-[100dvh] flex items-end">
      <!-- Background Image or Video -->
      <div class="absolute inset-0">
        <video v-if="mediaType === 'video' && backgroundVideo" 
               :src="backgroundVideo" 
               autoplay 
               muted 
               loop 
               class="w-full h-full object-cover object-center">
        </video>
        <img v-else 
             :src="heroImage" 
             alt="Hero Background" 
             class="w-full h-full object-cover object-top" />
        <!-- Overlay -->
        <div class="absolute inset-0 bg-f-primary opacity-20"></div>
      </div>

      <!-- Content -->
      <div class="relative z-10 w-full sm:container 3xl:max-w-[85%] mx-auto px-4 pb-8">
        <div class="w-full flex flex-col lg:flex-row lg:items-end justify-between gap-6 sm:gap-12">
          <!-- Left Content -->
          <h1 class="text-white text-4xl md:text-5xl lg:text-6xl 2xl:text-[64px] font-bold mb-6 !leading-tight">
            {{ heroTitle || $t('frontend.hero.title') }}
          </h1>

          <!-- Right Content - Info Card -->
          <div class="text-white space-y-3">
            <div
              class="bg-f-primary p-5 text-white flex flex-col justify-between space-y-3 w-full lg:min-w-[520px] min-h-[160px]">
              <div class="bg-white w-[140px] h-[6px] rounded-full"></div>
              <div class="space-y-1">
                <h2 class="text-xl sm:text-2xl font-semibold">{{ heroSubtitle || $t('frontend.hero.subtitle_one') }}</h2>
                <h2 class="text-xl sm:text-2xl font-semibold">{{ $t('frontend.hero.subtitle_two') }}</h2>
              </div>
            </div>
            <button
              class="bg-gray-950 text-white flex flex-col items-center justify-center lowercase px-3 min-w-[100px] h-[100px] font-normal mb-8">
              <span>{{ $t('frontend.common.see_more') }}</span>
              <div class="block">
                <Svg name="arrow_down" class="w-5 h-5 animate-bounce"></Svg>
              </div>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Statistics Bar at Bottom -->
    <div class="bg-f-primary py-[54px]" ref="statisticsSection">
      <div class="sm:container 3xl:max-w-[85%] mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 items-center justify-center gap-8 text-white">
          <div class="flex flex-col items-center text-center sm:text-start">
            <div class="block">
              <div class="text-3xl font-semibold mb-0.5">
                <AnimatedNumber dir="ltr" :number="expertTutors" />
              </div>
              <h1 class="text-xl font-light">{{ $t('frontend.stats.expert_tutors') }}</h1>
            </div>
          </div>
          <div class="flex flex-col items-center text-center sm:text-start">
            <div class="block">
              <div class="text-3xl font-semibold mb-0.5">
                <AnimatedNumber dir="ltr" :number="students" />
              </div>
              <h1 class="text-xl font-light">{{ $t('frontend.stats.students') }}</h1>
            </div>
          </div>
          <div class="flex flex-col items-center text-center sm:text-start">
            <div class="block">
              <div class="text-3xl font-semibold mb-0.5 flex items-center">
                <AnimatedNumber dir="ltr" :number="experience" />
                <span class="">+ {{ $t('frontend.stats.years') }}</span>
              </div>
              <h1 class="text-xl font-light">{{ $t('frontend.stats.experience') }}</h1>
            </div>
          </div>
          <div class="flex flex-col items-center text-center sm:text-start">
            <div class="block">
              <div class="text-3xl font-semibold mb-0.5">
                <AnimatedNumber dir="ltr" :number="campuses" />
              </div>
              <h1 class="text-xl font-light">{{ $t('frontend.stats.campuses') }}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted, ref, onUnmounted, computed } from 'vue';
import AnimatedNumber from '@/Pages/Frontend/Components/AnimatedNumber.vue';

// Define props
const props = defineProps(['data']);

const expertTutors = ref(0);
const students = ref(0);
const experience = ref(0);
const campuses = ref(0);

const statisticsSection = ref(null);
let observer = null;

// Computed properties for hero data with fallbacks
const heroTitle = computed(() => {
  if (props.data && props.data.title) {
    return props.data.title[document.documentElement.lang] || props.data.title.en || '';
  }
  return '';
});

const heroSubtitle = computed(() => {
  if (props.data && props.data.subtitle) {
    return props.data.subtitle[document.documentElement.lang] || props.data.subtitle.en || '';
  }
  return '';
});

const heroImage = computed(() => {
  return props.data?.hero_image || '/img/home/hero-bg.jpg';
});

const backgroundVideo = computed(() => {
  return props.data?.background_video || null;
});

const mediaType = computed(() => {
  return props.data?.metadata?.media_type || 'image';
});

const startAnimation = () => {
  if (props.data?.metadata) {
    expertTutors.value = props.data.metadata.expert_tutors || 23;
    students.value = props.data.metadata.students || 352;
    experience.value = props.data.metadata.experience || 6;
    campuses.value = props.data.metadata.campuses || 3;
  } else {
    // Fallback to default values
    expertTutors.value = 23;
    students.value = 352;
    experience.value = 6;
    campuses.value = 3;
  }
};

onMounted(() => {
  // Create intersection observer to watch when statistics section comes into view
  observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          // Start animation when section is visible
          startAnimation();
          // Stop observing after animation starts
          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.5, // Trigger when 50% of the section is visible
      rootMargin: '-50px' // Start animation 50px before the section is fully visible
    }
  );

  // Start observing the statistics section
  if (statisticsSection.value) {
    observer.observe(statisticsSection.value);
  }
});

onUnmounted(() => {
  // Clean up observer when component is unmounted
  if (observer) {
    observer.disconnect();
  }
});
</script>

<style scoped>
@keyframes bounce {

  0%,
  100% {
    transform: translateY(-15%);
    animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
  }

  50% {
    transform: translateY(75%);
    animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
  }
}

.animate-bounce {
  animation: bounce 1s infinite;
}
</style>
