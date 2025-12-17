<template>

    <!-- background -->
    <div class="js-bg fixed inset-0 !z-40 size-full backdrop-blur-2xl bg-white/[4%] duration-500 opacity-0 hidden"></div>
    <!-- End background -->

    <div class="menu__inner js-menu-inner !fixed !inset-0 !z-50">

        <!--Menu-->
        <div class="menu__items-wrapper js-menu-items-wrapper">
            <ul class="menu__items-list js-menu-items-list space-y-4 whitespace-nowrap">
                <li class="js-menu-item is-active"
                    data-morph="M 418.1,159.8 C 460.9,222.9 497,321.5 452.4,383.4 417.2,432.4 371.2,405.6 271.3,420.3 137.2,440 90.45,500.6 42.16,442.8 -9.572,381 86.33,289.1 117.7,215.5 144.3,153.4 145.7,54.21 212.7,36.25 290.3,15.36 373.9,94.6 418.1,159.8 Z">
                    <button type="button" @click="changePage('first')" class="!text-4xl md:!text-5xl">Home</button>
                </li>
                <li class="js-menu-item"
                    data-morph="M 402.7,215.5 C 433.9,280.4 488.1,367.2 447.7,426.8 410.1,482.2 316.7,460.2 249.7,460.6 182.8,461.1 88.08,485.5 51.26,429.5 10.29,367.3 73.19,279.4 106.9,213 141.8,144 176.6,33.65 253.9,33.7 332.2,33.75 368.8,144.9 402.7,215.5 Z">
                    <button type="button" @click="changePage('second')" class="!text-4xl md:!text-5xl">Products</button>
                </li>
                <li class="js-menu-item"
                    data-morph="M 402.7,215.5 C 433.9,280.4 488.1,367.2 447.7,426.8 410.1,482.2 316.7,460.2 249.7,460.6 182.8,461.1 88.08,485.5 51.26,429.5 10.29,367.3 73.19,279.4 106.9,213 141.8,144 176.6,33.65 253.9,33.7 332.2,33.75 368.8,144.9 402.7,215.5 Z">
                    <button type="button" @click="changePage('third')" class="!text-4xl md:!text-5xl">Services</button>
                </li>
                <li class="js-menu-item"
                    data-morph="M 402.7,215.5 C 433.9,280.4 488.1,367.2 447.7,426.8 410.1,482.2 316.7,460.2 249.7,460.6 182.8,461.1 88.08,485.5 51.26,429.5 10.29,367.3 73.19,279.4 106.9,213 141.8,144 176.6,33.65 253.9,33.7 332.2,33.75 368.8,144.9 402.7,215.5 Z">
                    <button type="button" @click="changePage('fourth')" class="!text-4xl md:!text-5xl">Web Hosting</button>
                </li>
                <li class="js-menu-item"
                    data-morph="M 402.7,215.5 C 433.9,280.4 488.1,367.2 447.7,426.8 410.1,482.2 316.7,460.2 249.7,460.6 182.8,461.1 88.08,485.5 51.26,429.5 10.29,367.3 73.19,279.4 106.9,213 141.8,144 176.6,33.65 253.9,33.7 332.2,33.75 368.8,144.9 402.7,215.5 Z">
                    <button type="button" @click="changePage('fifth')" class="!text-4xl md:!text-5xl">Clients</button>
                </li>
                <li class="js-menu-item"
                    data-morph="M 402.7,215.5 C 433.9,280.4 488.1,367.2 447.7,426.8 410.1,482.2 316.7,460.2 249.7,460.6 182.8,461.1 88.08,485.5 51.26,429.5 10.29,367.3 73.19,279.4 106.9,213 141.8,144 176.6,33.65 253.9,33.7 332.2,33.75 368.8,144.9 402.7,215.5 Z">
                    <button type="button" @click="changePage('sixth')" class="!text-4xl md:!text-5xl">About</button>
                </li>
            </ul>
        </div>
        <!--/Menu-->

        <!-- Close -->
        <div
            class="menu__trigger menu__trigger--close js-menu-close absolute inset-0 container mx-auto flex justify-end px-5 mt-11">
            <span>Close</span>
        </div>
        <!-- End Close -->

    </div>

</template>

<script setup>
import { onMounted, inject } from 'vue';
import { gsap } from 'gsap';

const pageNumber = inject('pageNumber');
const navDirection = inject('navDirection');

let timeline;
let menuInner;
let blurBg;

const closeMenu = () => {
    timeline.timeScale(1.25);
    timeline.reverse();
    setTimeout(() => {
        menuInner.classList.add("hidden");
        blurBg.classList.toggle("opacity-0");
        setTimeout(() => {
            blurBg.classList.toggle("hidden");
        }, 300);
    }, 800);
}

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

    closeMenu();
}

onMounted(() => {
    menuInner = document.querySelector(".js-menu-inner");
    const menuTrigger = document.querySelector(".js-menu-trigger");
    const menuItem = document.querySelectorAll(".js-menu-items-list li");
    const menuClose = document.querySelector(".js-menu-close");
    blurBg = document.querySelector(".js-bg");

    timeline = gsap.timeline({ paused: true });

    timeline
        .to(menuInner, {
            duration: .5,
            autoAlpha: 1,
            ease: "power4.out"
        }, "start")
        .fromTo(menuItem, {
            x: -30,
            autoAlpha: 0
        }, {
            x: 0,
            autoAlpha: 1,
            delay: 0.35,
            duration: 0.4,
            ease: "back.out(1)",
            stagger: 0.15
        }, "start")
        .fromTo(menuClose, {
            x: -10,
            autoAlpha: 0
        }, {
            x: 0,
            autoAlpha: 1,
            delay: 1,
            duration: 0.2,
            ease: "power1.out"
        }, "start");

    // Event Open Menu
    menuTrigger.addEventListener("click", function () {
        menuInner.classList.remove("hidden");
        blurBg.classList.toggle("hidden");
        setTimeout(() => {
            blurBg.classList.toggle("opacity-0");
        }, 100);
        timeline.play();
    });

    // Event Close Menu
    menuClose.addEventListener("click", function () {
        closeMenu();
    });
});
</script>

<style>
.menu__trigger {
    cursor: pointer;
}

.menu__trigger span {
    position: relative;
    font-weight: 700;
    letter-spacing: -1px;
    text-transform: uppercase;
    font-size: 16px;
}

.menu__trigger:hover:after {
    transform: translateX(0);
}

.menu__trigger--close {
    visibility: hidden;
    opacity: 0;
}

.menu__logo {
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    padding: 5px;
    transform: translateY(-50%);
    cursor: pointer;
}

.menu__logo svg {
    width: 185px;
    margin: 0 auto;
    display: block;
}

.menu__logo h1 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: 900;
    font-size: 36px;
    text-align: center;
    letter-spacing: -1.5px;
    line-height: 28px;
}

.menu__inner {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    z-index: 1;
    border-radius: 10px;
    overflow: hidden;
    visibility: hidden;
    opacity: 0;
}

.menu__items-wrapper {
    position: relative;
    padding-left: 22px;
}

.menu__items-list {
    position: relative;
    z-index: 1;
}

.menu__items-list li {
    margin-bottom: 8px;
}

.menu__items-list li button {
    color: white;
    text-decoration: none;
    font-size: 50px;
    line-height: 50px;
    text-transform: uppercase;
    display: block;
    letter-spacing: -1.2px;
    font-weight: 700;
}

.menu__items-shape {
    position: absolute;
    left: -32px;
    top: -60px;
}

.menu__items-shape svg {
    position: relative;
    display: block;
    width: 140px;
    height: 140px;
    min-height: 150px;
    margin: 0 auto;
}
</style>