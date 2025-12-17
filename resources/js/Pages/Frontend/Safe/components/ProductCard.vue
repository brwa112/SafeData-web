<template>
    <div @click="hrefLink(product.url)"
        class="w-full relative group p-4 lg:p-6 xl:px-7 xl:py-8 xl:pb-10 duration-500 hover:scale-105 overflow-hidden"
        @mouseenter="startAutoSlide" @mouseleave="stopAutoSlide">
        <div
            class="relative z-10 w-full h-full flex flex-col items-start justify-between gap-x-4 gap-y-5 lg:gap-y-10 xl:gap-y-12 2xl:gap-y-16">
            <div class="w-full flex justify-between items-center">
                <h2 class="text-lg sm:text-xl font-medium">0{{ product.id }}</h2>
                <Svg v-if="product.url" name="arrow"
                    class="block size-4 sm:size-5 duration-300 group-hover:-rotate-45"></Svg>
            </div>
            <div class="w-full flex flex-col gap-1">
                <div class="flex items-center justify-between">
                    <p class="text-sm lg:text-base xl:text-lg font-medium text-nowrap">{{ product.name }}</p>
                </div>
                <Splide ref="splideRef" aria-labelledby="autoplay-example-heading" :options="options" :has-track="false"
                    class="block">
                    <SplideTrack>
                        <SplideSlide v-for="slide in formatParagraph(product.description)" :key="slide.id"
                            class="bg-transparent !border-0 !cursor-none">
                            <p class="text-xs xl:text-sm font-light max-h-20 text-balance">
                                {{ slide }}
                            </p>
                        </SplideSlide>
                    </SplideTrack>
                </Splide>
            </div>
        </div>
        <div
            class="block absolute bottom-0 right-0 lg:bottom-2.5 lg:right-2.5 z-10 scale-[.3] duration-1000 opacity-0 group-hover:opacity-100">
            <Spinner />
        </div>
        <div class="absolute inset-0 -z-10 size-full backdrop-blur-xl bg-white/[4%]"></div>
        <div class="absolute inset-0 z-0 bg-f-secondary duration-500 opacity-0 group-hover:opacity-100">
            <div
                class="absolute inset-0 size-full scale-[3] z-5 circle-obj rounded-e-full blur-3xl opacity-0 group-hover:opacity-30">
            </div>
            <div
                class="absolute inset-0 size-full scale-[3] z-5 circle-obj-one rounded-e-full blur-3xl opacity-0 group-hover:opacity-30">
            </div>
        </div>
    </div>
</template>

<script setup>
import { Splide, SplideSlide, SplideTrack } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
import { ref, reactive, onMounted } from 'vue';
import Spinner from './Spinner.vue';

const props = defineProps({
    product: {
        type: [Array, Object],
        required: true,
    },
});

const options = reactive({
    rewind: true,
    gap: '1rem',
    autoplay: false,
    height: 'auto',
    type: 'fade',
    interval: 3000,
    speed: 1000,
    pagination: false,
    isNavigation: true,
    arrows: false,
    pauseOnHover: false,
    pauseOnFocus: false,
    drag: false,
    slidesToScroll: -1,
});

const splideRef = ref(null);

const startAutoSlide = () => {
    splideRef.value.splide.Components.Autoplay.play();
};

const stopAutoSlide = () => {
    splideRef.value.splide.Components.Autoplay.pause();
};

const wordsNumber = ref(27);

onMounted(() => {

    const checkWordsNumber = () => {
        if (window.innerWidth < 1536 && window.innerWidth > 1280) {
            wordsNumber.value = 20;
        } else if (window.innerWidth < 1280 && window.innerWidth > 1024) {
            wordsNumber.value = 21;
        } else {
            wordsNumber.value = 27;
        }
        if (props.product.id === 1)
            wordsNumber.value += 5;
    };

    checkWordsNumber();

    window.addEventListener('resize', () => {
        checkWordsNumber();
    });
});

const formatParagraph = (text) => {
    // Function to split a string into chunks of a specified length
    const splitByWords = (str, wordCount) => {
        let words = str.split(' ');
        let result = [];
        for (let i = 0; i < words.length; i += wordCount) {
            result.push(words.slice(i, i + wordCount).join(' '));
        }
        return result;
    };

    // Split the text into chunks of 30 words
    return splitByWords(text, wordsNumber.value);
};

const hrefLink = (link) => {
    if (link) {
        window.open(link, '_blank');
    }
};

</script>