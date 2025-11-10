<template>
  <section class="mt-24 mb-16 lg:mt-36 xl:mt-48 lg:mb-16">
    <div class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4">
      <div class="relative flex flex-col items-center gap-10 xl:gap-16 py-16 lg:py-28">
        <!-- Top Content - Images -->
        <div class="relative w-full flex items-center justify-between bg-[#FFA610] h-36 ps-7 lg:ps-16">
          <h2
            class="relative z-[5] text-2xl lg:text-3xl xl:text-[32px] font-semibold text-white text-wrap w-40 md:w-full">
            {{ $t('frontend.principal_message.title') }}
          </h2>
          <div class="absolute bottom-0 -end-10 md:-end-20 lg:end-40 z-[5]">
            <div class="relative">
              <div class="h-full md:h-[392px] overflow-hidden">
                <img :src="authorImage" alt="principal"
                  class="size-60 md:size-[560px] object-contain object-top ltr:scale-x-[-1]" />
              </div>
              <div class="absolute top-0 md:top-[140px] -start-1/2 md:-start-[20px] lg:-start-[120px] z-[5]">
                <div
                  class="flex flex-col rounded-2xl bg-white px-5 py-3 lg:min-w-[280px] shadow-[0_2px_10px_rgba(0,0,0,0.2)]">
                  <img :src="'/img/about/send.svg'" alt="icon" class="size-4.5 lg:size-5" />
                  <p class="relative z-[5] text-xs lg:text-base mt-0.5">
                    {{ authorName }}
                  </p>
                  <h2 class="relative z-[5] text-xs lg:text-base font-medium leading-5">
                    {{ $t('frontend.principal_message.position') }}
                  </h2>
                </div>
              </div>
            </div>
          </div>
          <img :src="'/img/about/lines.svg'" alt="decoration" class="relative z-[1] hidden lg:block rtl:scale-x-[-1]" />
        </div>
        <!-- Bottom Content -->
        <div class="relative z-[5] flex-1 space-y-1.5 max-w-3xl xl:max-w-5xl text-justify px-3">
          <h2 class="text-lg xl:text-xl font-semibold text-black leading-tight">
            {{ $t('frontend.principal_message.greeting') }}
          </h2>
          <div class="space-y-4" v-html="description"></div>
          <p class="leading-6 text-base lg:text-lg xl:text-xl font-medium !mt-8">
            {{ authorName }}
          </p>
          <img :src="'/img/about/sign.svg'" alt="signature" class="-mt-3 -ms-2.5 lg:-ms-5" />
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
  data: {
    type: Object,
    default: () => ({})
  }
});

const page = usePage();

// Computed properties for content
const description = computed(() => {
  const desc = helpers.getTranslatedText(props.data.description, page);
  if (!desc) {
    return `
      <p class="leading-6 text-base lg:text-lg xl:text-xl font-normal !mt-4">
        It is with great pride and deep commitment that I welcome you to Kurd Genius School — a place where academic
        excellence meets personal growth, innovation, and global standards.
      </p>
      <p class="leading-6 text-base lg:text-lg xl:text-xl font-normal !mt-4">
        Since 2013, Kurd Genius has grown into a vibrant learning community guided by a clear vision: to nurture
        young minds, build strong character, and prepare our students for success in an ever-changing world.
      </p>
      <p class="leading-6 text-base lg:text-lg xl:text-xl font-normal !mt-4">
        We believe that every child holds unique potential, and it is our mission to unlock that potential through
        high-quality education, personalized care, and consistent support.
      </p>
      <p class="leading-6 text-base lg:text-lg xl:text-xl font-normal !mt-4">
        At Kurd Genius, we don't just teach subjects — we empower students to become confident, responsible
        individuals who think critically, solve problems, and lead with compassion. Our dedicated teachers, modern
        learning environments, and rich academic and extracurricular programs all contribute to this mission.
      </p>
      <p class="leading-6 text-base lg:text-lg xl:text-xl font-normal !mt-4">
        I invite you to explore our website and discover what makes our school a truly special place. Together, with
        our families and community, we will continue this journey of excellence.
      </p>
    `;
  }
  // Format the description with proper paragraph styling
  return desc.split('\n').filter(p => p.trim()).map(p => 
    `<p class="leading-6 text-base lg:text-lg xl:text-xl font-normal !mt-4">${p.trim()}</p>`
  ).join('');
});

const authorName = computed(() => {
  return helpers.getTranslatedText(props.data.author) || 'Sozan Abubakr Mawlud';
});

const authorImage = computed(() => {
  return props.data.author_image || '/img/about/person.png';
});
</script>
