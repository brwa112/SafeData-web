<template>
  <section class="mt-8 md:mt-10 xl:mt-[100px] mb-10 sm:mb-16">
    <div class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4">
      <div class="relative flex flex-col lg:flex-row justify-between gap-y-10 gap-x-8 xl:gap-x-10 py-16">
        <!-- Left Content -->
        <div class="relative z-[5] flex-1 space-y-5">
          <div class="flex flex-wrap items-center gap-x-5">
            <p class="!leading-6 text-base lg:text-base xl:text-lg font-normal">
              {{ formattedDate }} <span v-if="branchName">| {{ branchName }}</span>
            </p>
            <p v-if="hashtags" class="!leading-6 text-base lg:text-base xl:text-lg font-normal">
              {{ hashtags }}
            </p>
          </div>
          <h2
            class="text-xl sm:text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl 3xl:text-[75px] font-semibold text-black !leading-normal lg:!leading-14 xl:!leading-20 2xl:!leading-[92px]">
            {{ title }}
          </h2>
          <div class="!mt-9">
            <Link :href="branchRoute(`/news/${news.slug || news.id}`)"
              class="max-w-max text-white bg-f-primary rounded-full duration-300 py-3 lg:py-4.5 px-10 lg:px-[72px] text-sm sm:text-base font-normal !leading-6">
            {{ $t('frontend.common.read_more') }}
            </Link>
          </div>
        </div>

        <!-- Right Content - Image -->
        <div
          class="relative z-[2] w-full sm:w-[528px] lg:w-[472px] xl:w-[552px] 2xl:w-[640px] h-[580px] xl:h-[640px] 2xl:h-[700px] 3xl:h-[760px]">
          <img :src="featuredImage" :alt="title" class="w-full h-full object-cover" />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import helpers from '@/helpers';

const props = defineProps({
  news: {
    type: Object,
    required: true,
  }
});

const page = usePage();

// Helper function to generate branch-aware routes
const branchRoute = (path) => {
  return helpers.branchRoute(path);
};

// Get translated content
const title = computed(() => {
  return props.news?.title 
    ? helpers.getTranslatedText(props.news.title, page)
    : '';
});

const content = computed(() => {
  return props.news?.content 
    ? helpers.getTranslatedText(props.news.content, page)
    : '';
});

const branchName = computed(() => {
  return props.news?.branch?.name 
    ? helpers.getTranslatedText(props.news.branch.name, page)
    : '';
});

const categoryName = computed(() => {
  return props.news?.category?.name 
    ? helpers.getTranslatedText(props.news.category.name, page)
    : '';
});

const hashtags = computed(() => {
  if (!props.news?.hashtags || props.news.hashtags.length === 0) return '';
  return props.news.hashtags.map(tag => '#' + helpers.getTranslatedText(tag.name, page)).join(' ');
});

const featuredImage = computed(() => {
  if (props.news?.images && props.news.images.length > 0) {
    return props.news.images[0].url;
  }
  return `/img/news/${props.news?.id || 1}.jpg`;
});

const formattedDate = computed(() => {
  if (!props.news?.created_at) return '';
  const d = new Date(props.news.created_at);
  if (isNaN(d.getTime())) return '';
  return d.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
});
</script>