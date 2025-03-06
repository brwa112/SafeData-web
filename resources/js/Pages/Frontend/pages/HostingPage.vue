<template>
    <div
        class="container 2xl:max-w-[100rem] mx-auto flex flex-col items-center justify-center gap-y-12 gap-x-24 text-white py-36 px-5">
        <h1 v-motion-slide-visible-bottom :duration="300" class="font-audi text-xl md:text-2xl xl:text-3xl text-center">
            WEB HOSTING
        </h1>
        <div class="main-cards cards relative z-0 w-full">

            <div class="w-full grid sm:grid-cols-2 lg:grid-cols-4 gap-3 xl:gap-5 2xl:gap-10">
                <div v-motion-slide-visible-bottom :duration="300" v-for="plan in hosting" :key="plan.id" class="cards-inner relative w-full">
                    <div class="cards-card card w-full relative flex flex-col z-10 p-7 md:p-5 xl:p-8">
                        <h1 v-if="plan.id == 2"
                            class="absolute top-2.5 right-2.5 xl:top-4 xl:right-4 text-white text-xs xl:text-sm 2xl:text-base px-5 xl:px-9 py-1.5 bg-white/5">
                            Popular
                        </h1>
                        <h2
                            class="text-f-secondary text-lg sm:text-xl xl:text-2xl 2xl:text-3xl font-semibold mb-2 sm:my-4 xl:my-6 2xl:my-8">
                            {{ plan.name }}
                        </h2>
                        <p class="text-sm 2xl:text-base sm:mb-5 whitespace-pre-wrap">
                            {{ plan.description }}
                        </p>
                        <h1
                            class="hidden absolute bottom-2.5 right-2.5 xl:bottom-4 xl:right-4 text-white text-xs xl:text-sm 2xl:text-base px-5 xl:px-9 py-1.5">
                            ( More... )
                        </h1>

                        <!-- <button type="button"
                            class="card-cta cta w-full bg-white/10 !hidden lg:!block text-xs sm:text-sm 2xl:text-base p-2.5 xl:p-3 2xl:p-3.5 cursor-none">
                            Get Started
                        </button> -->
                    </div>
                    <div class="absolute inset-0 -z-10 size-full backdrop-blur-xl bg-white/[4%]"
                        :class="{ '!bg-f-secondary/20': plan.id == 2 }"></div>
                </div>
            </div>

            <div class="overlay cards-inner grid sm:grid-cols-2 lg:grid-cols-4 gap-3 xl:gap-5 2xl:gap-10"></div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch, inject } from 'vue';

const pageNumber = inject('pageNumber');

const props = defineProps([
    'hosting',
]);

onMounted(() => {
    const cardsContainer = document.querySelector(".cards");
    const cards = Array.from(document.querySelectorAll(".card"));
    const overlay = document.querySelector(".overlay");

    const applyOverlayMask = (e) => {
        const overlayEl = e.currentTarget;
        const x = e.pageX - cardsContainer.offsetLeft;
        const y = e.pageY - cardsContainer.offsetTop;

        overlayEl.style = `--opacity: 1; --x: ${x}px; --y:${y}px;`;
    };

    watch(pageNumber, (newVal) => {
        if (newVal === 3) {
            document.body.addEventListener("pointermove", applyOverlayMask);
        } else {
            document.body.removeEventListener("pointermove", applyOverlayMask);
        }
    });

    const createOverlayCta = (overlayCard, ctaEl) => {
        const overlayCta = document.createElement("div");
        overlayCta.classList.add("cta");
        overlayCta.textContent = ctaEl.textContent;
        overlayCta.setAttribute("aria-hidden", true);
        overlayCard.append(overlayCta);
    };

    const observer = new ResizeObserver((entries) => {
        entries.forEach((entry) => {
            const cardIndex = cards.indexOf(entry.target);
            let width = entry.borderBoxSize[0].inlineSize;
            let height = entry.borderBoxSize[0].blockSize;

            if (cardIndex >= 0) {
                overlay.children[cardIndex].style.width = `${width}px`;
                overlay.children[cardIndex].style.height = `${height}px`;
            }
        });
    });

    const initOverlayCard = (cardEl) => {
        const overlayCard = document.createElement("div");
        overlayCard.classList.add("card");
        createOverlayCta(overlayCard, cardEl.lastElementChild);
        overlay.append(overlayCard);
        observer.observe(cardEl);
    };

    cards.forEach(initOverlayCard);
});
</script>

<style>
.card {
    --flow-space: 0.5em;
    --hsl: var(--hue), var(--saturation), var(--lightness);
    flex: 1 1 14rem;
    display: grid;
    grid-template-rows: auto auto auto 1fr;
}

.card:nth-child(1) {
    --hue: 28.73;
    --saturation: 75%;
    --lightness: 50%;
}

.card:nth-child(2) {
    --hue: 28.73;
    --saturation: 75%;
    --lightness: 50%;
}

.card:nth-child(3) {
    --hue: 28.73;
    --saturation: 75%;
    --lightness: 50%;
}

.card:nth-child(4) {
    --hue: 28.73;
    --saturation: 75%;
    --lightness: 50%;
}

.card:nth-child(5) {
    --hue: 28.73;
    --saturation: 75%;
    --lightness: 50%;
}

.cta {
    display: block;
    align-self: end;
    margin: 1em 0 0.5em 0;
    text-align: center;
    text-decoration: none;
    color: #fff;
    font-weight: 500;
}

.overlay {
    position: absolute;
    inset: 0;
    pointer-events: none;
    user-select: none;
    opacity: var(--opacity, 0);
    -webkit-mask: radial-gradient(25rem 25rem at var(--x) var(--y),
            #000 1000%,
            transparent 50%);
    mask: radial-gradient(25rem 25rem at var(--x) var(--y),
            #000 10%,
            transparent 50%);
    transition: 400ms mask ease;
    will-change: mask;
}

.overlay .card {
    background-color: hsla(var(--hsl), 0.15);
    border-color: hsla(var(--hsl), 1);
    @apply p-7 xl:p-8;
}

.overlay .cta {
    display: block;
    grid-row: -1;
    width: 100%;
    background-color: hsl(var(--hsl));
    @apply !hidden lg:!block text-xs sm:text-sm 2xl:text-base p-2.5 xl:p-3 2xl:p-3.5;
}

:not(.overlay)>.card {
    transition: 400ms background ease;
    will-change: background;
}
</style>