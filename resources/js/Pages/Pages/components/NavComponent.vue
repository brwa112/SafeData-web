<template>

    <header class="fixed top-5 !z-50 flex flex-wrap lg:justify-start lg:flex-nowrap w-full text-white text-sm py-4">
        <nav
            class="container 2xl:max-w-[100rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
            <div v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                :duration="1200">
                <img :src="'img/logo/symbol_logo.png'" alt="logo" class="w-10 md:w-12">
            </div>
            <div class="lg:order-3 flex items-center gap-x-2">

                <div class="inline-flex lg:hidden">

                    <!-- Button Menu -->
                    <div v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="600" class="menu__trigger js-menu-trigger relative"><span>MENU</span></div>
                    <!-- End Button Menu -->

                    <!--Menu-->
                    <NavMobile />
                    <!--/Menu-->

                </div>

                <!-- Button -->
                <div v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                    :duration="1200">
                    <div
                        class="button-nav hidden lg:flex flex-col items-center justify-center bg-white/10 shadow-none rounded-full overflow-hidden">
                        <button type="button" @click="changePage(5)"
                            class="primary-button-nav w-full relative group py-2.5 px-3.5 cursor-none rounded-full text-sm">
                            <span class="relative z-20">Contact</span>
                            <span class="round" />
                        </button>
                    </div>
                </div>
                <!-- End Button -->
            </div>
            <div id="navbar-alignment"
                class="hidden overflow-hidden transition-all duration-300 basis-full grow lg:grow-0 lg:basis-auto lg:block lg:order-2">
                <div class="hoverable black flex flex-col lg:flex-row lg:items-center py-3">
                    <button v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" type="button" @click="changePage('first')"
                        class=".btn-nav px-5 font-normal cursor-none">
                        Home
                    </button>
                    <button v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" @click="changePage('second')" type="button"
                        class=".btn-nav px-5 font-normal cursor-none">
                        Products
                    </button>
                    <button v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" @click="changePage('third')" type="button"
                        class=".btn-nav px-5 font-normal cursor-none">
                        Services
                    </button>
                    <button v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" @click="changePage('fourth')" type="button"
                        class=".btn-nav px-5 font-normal cursor-none">
                        Web Hosting
                    </button>
                    <button v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" @click="changePage('fifth')" type="button"
                        class=".btn-nav px-5 font-normal cursor-none">
                        Clients
                    </button>
                    <button v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" @click="changePage('sixth')" type="button"
                        class=".btn-nav px-5 font-normal cursor-none">
                        About
                    </button>
                    <!-- Change Mouse -->
                    <GeneralMouse />
                </div>
            </div>
        </nav>
    </header>

</template>

<script setup>
import { ref, inject, onMounted } from 'vue'
import GeneralMouse from './GeneralMouse.vue';
import NavMobile from './NavMobile.vue';

const changePage = (name) => {
    const elements = document.getElementsByClassName(name);
    const element = elements[0];

    var lastPoint = 70;
    if (name == 'sixth') {
        lastPoint = 0;
    }

    const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
    const offsetPosition = elementPosition - lastPoint;

    window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
    });
}

onMounted(() => {
    // Button Contact
    let button = document.querySelector(".primary-button-nav");
    let item = document.querySelector(".primary-button-nav .round");

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
.button-nav .primary-button-nav .round {
    position: absolute;
    top: -1px;
    left: 10px;
    z-index: 10;
    border-radius: 100%;
    animation: scale-down-nav 0.8s forwards;
}

.button-nav .primary-button-nav.animate .round {
    animation: scale-up-nav 0.8s forwards;
}

@keyframes scale-up-nav {
    to {
        transform: scale(200);
        background-color: rgb(206 132 64);
    }
}

@keyframes scale-down-nav {
    from {
        transform: scale(200);
        background-color: rgb(206 132 64);
    }

    to {
        transform: scale(0);
        background-color: rgb(206 132 64 / 0.05);
    }
}
</style>