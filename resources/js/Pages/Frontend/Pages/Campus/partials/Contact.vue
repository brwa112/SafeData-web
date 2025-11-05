<template>
  <section class="mt-10 mb-10">
    <div class="w-full sm:container 3xl:max-w-[75%] mx-auto px-4">
      <div
        class="relative flex flex-col lg:flex-row items-center justify-center gap-10 lg:gap-20 xl:gap-40 py-16 lg:py-28">
        <!-- Branch Logo -->
        <div class="block">
          <img :src="branchLogo" alt="Branch logo" class="w-full h-[220px] lg:h-[380px] object-contain" />
        </div>
        <!-- Content -->
        <div class="relative z-5 flex-1 space-y-1.5 max-w-xl xl:max-w-2xl">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
            {{ branchName }}
          </h2>
          <p class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-justify">
            {{ branchDescription }}
          </p>
          <Link :href="branchRoute('/about')"
            class="bg-f-primary hover:bg-white text-white hover:text-f-primary hover:font-semibold py-3 px-2 block text-center !w-40 !mt-7 rounded-full border-4 border-f-primary transition-all duration-500 text-base font-light transform">
          {{ $t('frontend.campus_contact.contact') }}
          </Link>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import helpers from '@/helpers';

const page = usePage();
const selectedBranch = computed(() => page.props.selectedBranch);

// Computed properties for branch data
const branchLogo = computed(() => {
  return selectedBranch.value?.logo_url || '/img/logo.png';
});

const branchName = computed(() => {
  if (!selectedBranch.value?.name) {
    return page.props.lang === 'en' 
      ? 'Kurd Genius School' 
      : 'قوتابخانەی کورد جینیەس';
  }
  return helpers.getTranslatedText(selectedBranch.value.name, page);
});

const branchDescription = computed(() => {
  if (!selectedBranch.value?.description) {
    return page.props.lang === 'en'
      ? 'Quality education and effective English learning environment for students.'
      : 'ژینگەیەکی پەروەردەیی بە کوالێتی و فێربوونی ئینگلیزی کاریگەر بۆ قوتابیان.';
  }
  return helpers.getTranslatedText(selectedBranch.value.description, page);
});

</script>
