<template>
    <div class="relative mx-auto overflow-hidden z-20">
        <div class="w-full h-screen flex flex-col items-center justify-end gap-4 text-white px-5 2xl:px-7">
            <div class="w-full relative z-10">
                <div
                    class="relative z-10 text-white flex flex-col items-center gap-12 xs:gap-20 p-12 md:p-16 xl:p-24 2xl:pt-24 2xl:pb-16 2xl:px-28">
                    <div class="w-full flex items-start justify-between gap-20">
                        <!-- About Section -->
                        <div class="flex flex-col gap-12 xs:gap-20 xl:gap-28">
                            <div v-motion-slide-visible-bottom :duration="300" class="flex flex-col gap-2 xs:gap-4">
                                <h2 class="text-xl xs:text-2xl xl:text-3xl font-audi">About</h2>
                                <p
                                    class="text-xs xs:text-sm xl:text-[0.92rem] text-justify font-light leading-5 max-w-sm">
                                    Our company is specifically about Information Technology with all its components.
                                    Webeganthis company this year in 2021, but our work history is way back this time.
                                    We have experience in this work since 2014 and now we’re providing our services
                                    through this company.
                                </p>
                            </div>
                            <div v-motion-slide-visible-bottom :duration="300"
                                class="flex flex-wrap gap-x-3 xl:gap-x-7 gap-y-3 xl:gap-y-5">
                                <a href="https://www.facebook.com/safedatacompany" target="_blank"
                                    class="relative group ps-8 xs:ps-10 sm:ps-16 p-1 px-2.5 text-white/70 cursor-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="relative z-10 size-6"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4z" />
                                    </svg>
                                    <div
                                        class="absolute inset-0 z-0 size-full backdrop-blur-xl duration-500 bg-white/[4%] group-hover:bg-f-secondary">
                                    </div>
                                </a>
                                <a href="https://www.instagram.com/safedatacompany?igsh=MThvbmM4Zm80MDJ4eg=="
                                    target="_blank"
                                    class="relative group ps-8 xs:ps-10 sm:ps-16 p-1 px-2.5 text-white/70 cursor-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="relative z-10 size-6"
                                        viewBox="0 0 1024 1024">
                                        <path fill="currentColor"
                                            d="M512 378.7c-73.4 0-133.3 59.9-133.3 133.3S438.6 645.3 512 645.3S645.3 585.4 645.3 512S585.4 378.7 512 378.7M911.8 512c0-55.2.5-109.9-2.6-165c-3.1-64-17.7-120.8-64.5-167.6c-46.9-46.9-103.6-61.4-167.6-64.5c-55.2-3.1-109.9-2.6-165-2.6c-55.2 0-109.9-.5-165 2.6c-64 3.1-120.8 17.7-167.6 64.5C132.6 226.3 118.1 283 115 347c-3.1 55.2-2.6 109.9-2.6 165s-.5 109.9 2.6 165c3.1 64 17.7 120.8 64.5 167.6c46.9 46.9 103.6 61.4 167.6 64.5c55.2 3.1 109.9 2.6 165 2.6c55.2 0 109.9.5 165-2.6c64-3.1 120.8-17.7 167.6-64.5c46.9-46.9 61.4-103.6 64.5-167.6c3.2-55.1 2.6-109.8 2.6-165M512 717.1c-113.5 0-205.1-91.6-205.1-205.1S398.5 306.9 512 306.9S717.1 398.5 717.1 512S625.5 717.1 512 717.1m213.5-370.7c-26.5 0-47.9-21.4-47.9-47.9s21.4-47.9 47.9-47.9s47.9 21.4 47.9 47.9a47.84 47.84 0 0 1-47.9 47.9" />
                                    </svg>
                                    <div
                                        class="absolute inset-0 z-0 size-full backdrop-blur-xl duration-500 bg-white/[4%] group-hover:bg-f-secondary">
                                    </div>
                                </a>
                                <a href="mailto:info@safedatait.com" target="_blank"
                                    class="relative group ps-8 xs:ps-10 sm:ps-16 p-1 px-2.5 text-white/70 cursor-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="relative z-10 size-6"
                                        viewBox="0 0 256 256">
                                        <path fill="currentColor"
                                            d="M128 20a108 108 0 0 0 0 216c22.27 0 45.69-6.73 62.64-18a12 12 0 1 0-13.29-20c-13 8.63-31.89 14-49.35 14a84 84 0 1 1 84-84c0 9.29-1.67 17.08-4.69 21.95c-2.64 4.24-6 6.05-11.31 6.05s-8.67-1.81-11.31-6.05c-3-4.87-4.69-12.66-4.69-21.95V88a12 12 0 0 0-23.49-3.46a52 52 0 1 0 8.86 79.57C172.3 174.3 182.81 180 196 180c24.67 0 40-19.92 40-52A108.12 108.12 0 0 0 128 20m0 136a28 28 0 1 1 28-28a28 28 0 0 1-28 28" />
                                    </svg>
                                    <div
                                        class="absolute inset-0 z-0 size-full backdrop-blur-xl duration-500 bg-white/[4%] group-hover:bg-f-secondary">
                                    </div>
                                </a>
                                <a href="https://t.me/safedatacompany" target="_blank"
                                    class="relative group ps-8 xs:ps-10 sm:ps-16 p-1 px-2.5 text-white/70 cursor-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="relative z-10 size-6"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="M1.846 7.151a.75.75 0 0 0-.228 1.376l6.517 3.915l6.22-4.355a.75.75 0 0 1 .86 1.229l-6.22 4.355l1.45 7.463a.75.75 0 0 0 1.372.256L22.792 3.94a.75.75 0 0 0-.793-1.133z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div
                                        class="absolute inset-0 z-0 size-full backdrop-blur-xl duration-500 bg-white/[4%] group-hover:bg-f-secondary">
                                    </div>
                                </a>
                                <a href="tel:+9647703558372" target="_blank"
                                    class="relative group flex items-center gap-3 py-2 px-3 cursor-none">
                                    <div class="relative z-10 flex items-center gap-3">
                                        <div class="bg-white/70 size-2 rounded-full"></div>
                                        <span class="font-extralight text-sm">776 951 2191</span>
                                    </div>
                                    <div
                                        class="absolute inset-0 z-0 size-full backdrop-blur-xl duration-500 bg-white/[4%] group-hover:bg-f-secondary">
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- Contact Form Section -->
                        <div v-motion-slide-visible-bottom :duration="300"
                            class="w-full max-w-md xl:max-w-lg hidden lg:flex flex-col gap-4">
                            <h2 class="text-2xl xl:text-3xl font-audi">Contact</h2>
                            <form @submit.prevent="" class="flex flex-col gap-4">
                                <div class="flex items-center gap-3 xl:gap-8">
                                    <input type="email" placeholder="Email" autocomplete="off"
                                        class="w-full py-4 px-3 text-sm bg-white/[4%] outline-0 cursor-none" />
                                    <input type="text" placeholder="Subject" autocomplete="off"
                                        class="w-full py-4 px-3 text-sm bg-white/[4%] outline-0 cursor-none" />
                                </div>
                                <textarea placeholder="Message" rows="5" autocomplete="off"
                                    class="w-full py-4 px-3 text-sm bg-white/[4%] outline-0 resize-none cursor-none"></textarea>
                                <!-- Button -->
                                <div class="button-about">
                                    <button class="primary-button-about py-4 px-3 cursor-none">
                                        Get Started
                                        <span class="round" />
                                    </button>
                                </div>
                                <!-- End Button -->
                            </form>
                        </div>
                    </div>
                    <div v-motion-slide-visible-bottom :duration="300"
                        class="text-center text-5xl sm:text-6xl lg:text-[5.3rem] xl:text-[6.5rem] 2xl:text-[7.8rem] 3xl:text-[10rem] w-96 md:w-auto md:text-nowrap font-audi text-f-secondary leading-none">
                        BE SAFE WITH US
                    </div>
                </div>
                <div class="absolute inset-0 z-0 size-full backdrop-blur-xl bg-white/[4%] px-7"></div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue'

onMounted(() => {
    let button = document.querySelector(".primary-button-about");
    let item = document.querySelector(".primary-button-about .round");

    button.addEventListener("mouseenter", function (event) {
        this.classList += " animate";

        let buttonX = event.offsetX;
        let buttonY = event.offsetY;

        if (buttonY < 24) {
            item.style.top = 0 + "px";
        } else if (buttonY > 30) {
            item.style.top = 48 + "px";
        }

        item.style.left = buttonX + "px";
        item.style.width = "1px";
        item.style.height = "1px";
    });

    button.addEventListener("mouseleave", function () {
        this.classList.remove("animate");

        let buttonX = event.offsetX;
        let buttonY = event.offsetY;

        if (buttonY < 24) {
            item.style.top = 0 + "px";
        } else if (buttonY > 30) {
            item.style.top = 48 + "px";
        }
        item.style.left = buttonX + "px";
    });
})
</script>

<style>
.button-about {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}

.button-about .primary-button-about {
    position: relative;
    width: 100%;
    overflow: hidden;
    background-color: transparent;
    text-transform: uppercase;
    color: #ffffff;
    font-size: 14px;
    font-weight: 700;
    background-color: rgb(206 132 64 / 0.05);
}

.button-about .primary-button-about .round {
    position: absolute;
    top: -1px;
    left: 10px;
    z-index: -1;
    border-radius: 100%;
    animation: scale-down-about 1s forwards;
}

.button-about .primary-button-about.animate .round {
    animation: scale-up-about 1s forwards;
}

@keyframes scale-up-about {
    to {
        transform: scale(1100);
        background-color: rgb(206 132 64);
    }
}

@keyframes scale-down-about {
    from {
        transform: scale(1200);
        background-color: rgb(206 132 64);
    }

    to {
        ransform: scale(0);
        background-color: rgb(206 132 64 / 0.05);
    }
}
</style>