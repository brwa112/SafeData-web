<template>
  <section v-if="messageDescription || fallbackContent" class="mt-16 mb-16 lg:mt-32 lg:mb-16 bg-white px-4">
    <div
      class="relative w-full sm:container 3xl:max-w-[90%] mx-auto border-[5px] border-b-0 border-f-primary rounded-t-[32px]">
      <div
        class="w-5/6 mx-auto flex flex-col lg:flex-row items-center gap-5 xl:gap-10 pt-[26px] pb-[152px] sm:pt-12 sm:pb-[180px]">
        <!-- Left Content -->
        <div class="flex-1 space-y-1.5">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
            {{ $t('frontend.principal_message.title') }}
          </h2>
          <div class="relative w-full">
            <p class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-pretty">
              {{ messageDescription || fallbackContent }}
            </p>
            <p class="absolute -start-5 sm:-start-7 -top-1 text-[32px] font-semibold">"</p>
          </div>
          <div class="!mt-4">
            <a href="#" class="font-normal">
              <span>{{ $t('frontend.common.see_more') }}</span>
              <div class="w-10 h-0.5 bg-yellow-400 rounded-full"></div>
            </a>
          </div>
        </div>

        <!-- Right Content - Images -->
        <div class="flex-1 flex lg:justify-end">
          <img :src="authorImage || '/img/home/message/1.jpg'" alt="Principal"
            class="w-full lg:w-5/6 h-[336px] sm:h-[416px] 2xl:h-[536px] object-cover object-[0%_15%] ltr:scale-x-[-1]" />
        </div>
      </div>

      <div class="absolute -inset-x-1 bottom-0 -mx-px">
        <img :src="'/img/home/message/bottom.svg'" alt="Decoration"
          class="w-full h-[128px] 2xl:h-[136px] object-cover" />
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue';

// Define props
const props = defineProps(['data']);

// Computed properties for message data with fallbacks
const messageDescription = computed(() => {
  if (props.data && props.data.description) {
    return props.data.description[document.documentElement.lang] || props.data.description.en || '';
  }
  return '';
});

const authorImage = computed(() => {
  return props.data?.author_image || null;
});

const fallbackContent = "It is with great pride and deep commitment that I welcome you to Kurd Genius School — a place where academic excellence meets personal growth, innovation, and global standards.";
</script>
