<template>
    <div class="relative container 2xl:max-w-[100rem] mx-auto z-20 py-36">
        <div
            class="w-full flex flex-col sm:flex-row items-center justify-center gap-y-5 gap-x-5 xl:gap-x-16 2xl:gap-x-24 text-white lg:px-2">
            <h1 v-motion-slide-visible-bottom :duration="300" class="font-audi text-xl md:text-2xl xl:text-3xl ms-3">SERVICES</h1>

            <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-y-3 sm:gap-y-5 gap-x-5 xl:gap-x-16 2xl:gap-x-24 p-6">
                <!-- Card -->
                <div v-motion-slide-visible-bottom :duration="300" v-for="service in services" :key="service.id"
                    class="services-card w-full group relative overflow-hidden text-white p-5 sm:p-6 lg:p-8 xl:p-10" data-tilt
                    data-tilt-scale="1.02" data-tilt-reset-to-start="true" data-tilt-reset="true" data-tilt-speed="1000"
                    data-tilt-max="5">
                    <div class="relative z-10 flex gap-1">
                        <div class="block">
                            <Svg :name="service.icon" class="size-9 2xl:size-12 text-white me-3"></Svg>
                        </div>
                        <div class="flex flex-col justify-center gap-1">
                            <h2 class="text-base sm:text-lg 2xl:text-xl font-medium">{{ service.name }}</h2>
                            <p
                                class="text-white block text-xs 2xl:text-sm font-light text-justify leading-tight">
                                {{ service.description }}
                            </p>
                        </div>
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
            </div>

        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import VanillaTilt from "vanilla-tilt";

const props = defineProps([
    'services',
]);

onMounted(() => {
    VanillaTilt.init(document.querySelectorAll(".services-card"));
});
</script>