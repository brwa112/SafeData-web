<template>
    <div class="relative container-test mx-auto overflow-hidden z-20 py-36">
        <div class="w-full flex flex-col items-center justify-center gap-10 text-white">
            <Splide v-motion-slide-visible-bottom :duration="300" ref="splide"
                aria-labelledby="autoplay-example-heading" :options="{ ...options, autoScroll: { speed: -2, } }"
                :extensions="extensions" :has-track="true">
                <SplideSlide v-for="client in clients" :key="client.id" class="!bg-transparent !border-0">
                    <div class="relative size-full p-5 lg:px-7 lg:py-8 duration-200 group overflow-hidden">
                        <div class="relative size-full z-10 overflow-hidden">
                            <h2
                                class="text-sm lg:text-lg font-medium whitespace-nowrap duration-500 opacity-0 group-hover:opacity-100 -translate-y-10 group-hover:translate-y-0">
                                {{ client.name }}
                            </h2>
                            <div
                                class="size-full flex flex-col items-center justify-center gap-1 duration-300 -translate-y-6 group-hover:translate-y-0">
                                <img :src="client.logo" :alt="client.name"
                                    class="w-32 object-cover filter invert brightness-0 grayscale opacity-50">
                            </div>
                        </div>
                        <div class="absolute inset-0 z-0 size-full backdrop-blur-xl bg-white/[4%]"></div>
                    </div>
                </SplideSlide>
            </Splide>
            <h1 v-motion-slide-visible-bottom :duration="300" class="font-audi text-xl md:text-2xl xl:text-3xl">
                CLIENTS
            </h1>
            <Splide v-motion-slide-visible-bottom :duration="300" ref="splide"
                aria-labelledby="autoplay-example-heading" :options="{ ...options, autoScroll: { speed: 2, } }"
                :extensions="extensions" :has-track="true">
                <SplideSlide v-for="client in reverseClients" :key="client.id" class="!bg-transparent !border-0">
                    <div class="relative size-full p-5 lg:px-7 lg:py-8 duration-200 group overflow-hidden">
                        <div class="relative size-full z-10 overflow-hidden">
                            <h2
                                class="text-sm lg:text-lg font-medium whitespace-nowrap duration-500 opacity-0 group-hover:opacity-100 -translate-y-10 group-hover:translate-y-0">
                                {{ client.name }}
                            </h2>
                            <div
                                class="size-full flex flex-col items-center justify-center gap-1 duration-300 -translate-y-6 group-hover:translate-y-0">
                                <img :src="client.logo" :alt="client.name"
                                    class="w-32 object-cover filter invert brightness-0 grayscale opacity-50">
                            </div>
                        </div>
                        <div class="absolute inset-0 z-0 size-full backdrop-blur-xl bg-white/[4%]"></div>
                    </div>
                </SplideSlide>
            </Splide>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import { AutoScroll } from '@splidejs/splide-extension-auto-scroll';
import '@splidejs/vue-splide/css';

const props = defineProps([
    'clients',
]);

const options = {
    rewind: true,
    width: '100%',
    gap: '1.5rem',
    type: 'loop',
    drag: 'free',
    focus: 'right',
    pagination: false,
    arrows: false,
    breakpoints: {
        1920: {
            perPage: 6,
        },
        1536: {
            perPage: 5,
        },
        1280: {
            perPage: 4,
        },
        1024: {
            perPage: 3,
        },
        768: {
            perPage: 3,
        },
        640: {
            perPage: 2,
        },
        480: {
            perPage: 2,
        },
    }
};

// i want get reverse clients
const reverseClients = computed(() => props.clients.slice().reverse());

const extensions = {
    AutoScroll,
};

onMounted(() => {
    // Initialization or additional logic if needed
});
</script>