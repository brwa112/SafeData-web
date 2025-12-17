<template>
    <!-- Flair Mouse -->
    <div class="flair flair--3 size-full fixed top-0 left-0 !z-50 pointer-events-none">
        <div ref="lottieMouse" :class="(pageNumber == 0 && !checkNav) ? 'opacity-100 blur-none' : 'opacity-0 blur-3xl'"
            class="duration-1000 size-12">
        </div>
    </div>
    <!-- Shape Mouse -->
    <div class="shape shape--3 shape-one size-full fixed top-0 left-0 !z-50 pointer-events-none">
        <div :class="(pageNumber != 0) ? 'opacity-100 blur-none' : 'opacity-0 blur-3xl'"
            class="cursor-shape-one duration-500 size-3.5 bg-white rounded-full">
        </div>
    </div>
    <div class="shape shape--3 shape-two size-full fixed top-0 left-0 !z-50 pointer-events-none">
        <div :class="(pageNumber == 0 && checkNav) ? 'opacity-100 blur-none' : 'opacity-0 blur-3xl'"
            class="cursor-shape-two duration-500 size-3.5 bg-white rounded-full">
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, inject } from 'vue';
import lottie from 'lottie-web-light'
import { gsap } from "gsap";

const pageNumber = inject('pageNumber');
const lottieMouse = ref(null);
const checkNav = ref(false);

onMounted(() => {

    // Mouse Moving
    gsap.set(".flair", { xPercent: -1, yPercent: -1.5, opacity: 0 });
    gsap.set(".shape", { xPercent: -0.38, yPercent: -0.4, opacity: 0 });

    let xToFlair = gsap.quickTo(".flair", "x", { duration: 0.1, ease: "power3" }),
        yToFlair = gsap.quickTo(".flair", "y", { duration: 0.1, ease: "power3" });
    let xToShape = gsap.quickTo(".shape", "x", { duration: 0.1, ease: "power3" }),
        yToShape = gsap.quickTo(".shape", "y", { duration: 0.1, ease: "power3" });

    // Function to handle mouse movement
    const handleMouseMove = e => {
        xToFlair(e.clientX);
        yToFlair(e.clientY);
        gsap.to(".flair", { opacity: 1, duration: 0.5 });

        xToShape(e.clientX);
        yToShape(e.clientY);
        gsap.to(".shape", { opacity: 1, duration: 0.5 });

        // i want if target equals to nav set class hidden
        const shape = document.querySelector('.shape-one');
        const shapeTwo = document.querySelector('.shape-two');
        const cursorShape = document.querySelector('.cursor-shape-one');
        const cursorShapeTwo = document.querySelector('.cursor-shape-two');

        if (e.target.classList.contains('.btn-nav')) {
            shape.classList.add('mix-blend-difference');
            shapeTwo.classList.add('mix-blend-difference');
            cursorShape.classList.add('scale-[2.5]');
            cursorShapeTwo.classList.add('scale-[2.5]');
        } else {
            shape.classList.remove('mix-blend-difference');
            shapeTwo.classList.remove('mix-blend-difference');
            cursorShape.classList.remove('scale-[2.5]');
            cursorShapeTwo.classList.remove('scale-[2.5]');
        }

        // check if hover element parent class have this .hoverable
        if (e.target.closest('.hoverable')) {
            checkNav.value = true;
        } else {
            checkNav.value = false;
        }
    };

    // Function to handle mouse leaving the window
    const handleMouseLeave = () => {
        gsap.to(".flair", { opacity: 0, duration: 0.5 });
        gsap.to(".shape", { opacity: 0, duration: 0.5 });
    };

    // Attach event listeners
    window.addEventListener("mousemove", handleMouseMove);
    window.addEventListener("mouseout", handleMouseLeave);
    // window.addEventListener("mouseleave", handleMouseLeave);

    // i want get element when mouse on it

    // Lottie Mouse
    lottie.loadAnimation({
        container: lottieMouse.value,
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: '/anim/mouse.json' // Replace with your animation path
    });
});

</script>