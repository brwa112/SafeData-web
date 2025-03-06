<template>
    <div class="relative container mx-auto overflow-x-hidden z-20">
        <div class="w-full h-dvh flex flex-col items-center justify-center gap-4 text-white px-10">
            <div class="flex items-center gap-2.5">
                <h1 class="font-audi text-3xl">SAFE</h1>
                <div class="relative glitch-logo">
                    <h1 class="font-audi text-3xl">DATA</h1>
                    <img :src="'/img/logo/glitch-one.png'" alt="logo" class="hidden absolute end-0 -top-0.5 h-10">
                    <img :src="'/img/logo/glitch-two.png'" alt="logo" class="hidden absolute end-0 -top-0.5 h-10">
                    <img :src="'/img/logo/glitch-three.png'" alt="logo" class="hidden absolute end-0 -top-1 h-10">
                </div>
            </div>
            <div class="flex items-center justify-center flex-wrap gap-2.5 font-light">
                <p class="text-xl sm:text-2xl">Where</p>
                <div class="h-8 bg-white text-black overflow-hidden">
                    <Splide ref="splide" aria-labelledby="autoplay-example-heading" :options="options"
                        :has-track="false">
                        <SplideTrack>
                            <SplideSlide v-for="slide in services" :key="slide.id"
                                class="bg-transparent !border-0 px-3">
                                <p
                                    class="h-8 w-full flex items-center justify-center text-lg sm:text-xl font-medium cursor-none">
                                    {{ slide.name }}
                                </p>
                            </SplideSlide>
                        </SplideTrack>
                    </Splide>
                </div>
                <p class="text-xl sm:text-2xl">Become One</p>
            </div>
            <div ref="lottieMouse" class="block lg:hidden absolute bottom-14 size-32 rotate-180">
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Splide, SplideSlide, SplideTrack } from '@splidejs/vue-splide';
import lottie from 'lottie-web'

const props = defineProps([
    'services',
]);

const lottieMouse = ref(null);

const options = {
    rewind: true,
    gap: '1rem',
    autoplay: true,
    height: 'auto',
    type: 'loop',
    interval: 1500,
    speed: 500,
    direction: "ttb",
    pagination: false,
    isNavigation: true,
    arrows: false,
    pauseOnHover: false,
    pauseOnFocus: false,
    drag: false,
    slidesToScroll: -1,
};

// const services = ref([
//     {
//         id: 1,
//         title: "Web Application",
//     },
//     {
//         id: 2,
//         title: "Cloud",
//     },
//     {
//         id: 3,
//         title: "Mobile Application",
//     },
//     {
//         id: 4,
//         title: "Network",
//     },
//     {
//         id: 5,
//         title: "UX/UI Design",
//     },
//     {
//         id: 6,
//         title: "Website",
//     },
// ]);

onMounted(() => {
    // const glitchLogo = document.querySelector('.glitch-logo');
    // const glitchLogoH1 = glitchLogo.querySelector('h1');
    // const glitchLogoImgOne = glitchLogo.querySelector('img:nth-child(2)');
    // const glitchLogoImgTwo = glitchLogo.querySelector('img:nth-child(3)');
    // const glitchLogoImgThree = glitchLogo.querySelector('img:nth-child(4)');

    // setTimeout(() => {
    //     playSound();

    //     glitchLogoH1.classList.add('invisible');
    //     glitchLogoImgOne.classList.remove('hidden');
    // }, 2500);
    // setTimeout(() => {
    //     glitchLogoImgOne.classList.add('hidden');
    //     glitchLogoImgTwo.classList.remove('hidden');
    // }, 2600);
    // setTimeout(() => {
    //     glitchLogoImgOne.classList.add('hidden');
    //     glitchLogoImgTwo.classList.add('hidden');
    //     glitchLogoImgThree.classList.remove('hidden');
    // }, 2900);
    // setTimeout(() => {
    //     glitchLogoImgThree.classList.add('hidden');
    //     glitchLogoH1.classList.remove('invisible');
    // }, 3050);

    // const playSound = () => {
    //     const audio = new Audio(`./audio/003.wav?${new Date().getTime()}`); // Unique URL to prevent caching
    //     audio.preload = 'auto'; // Preload the audio file
    //     audio.play().catch(error => {
    //         console.error('Error playing audio:', error);
    //     });
    // }

    // Lottie Mouse
    lottie.loadAnimation({
        container: lottieMouse.value,
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: '/anim/mob-scrolling.json' // Replace with your animation path
    });
})
</script>