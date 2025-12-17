<template>
    <div class="relative overflow-x-hidden font-mont cursor-none">

        <NavComponent />

        <slot></slot>

        <div ref="backdrop" class="absolute inset-0 bg-black/50 z-50 backdrop-blur-md duration-1000 opacity-100"></div>

    </div>
</template>

<script setup>
import { ref, provide } from 'vue';
import NavComponent from '../components/NavComponent.vue';
import { Head } from '@inertiajs/vue3';

const pageNumber = ref(0);
const navDirection = ref(false);
provide('pageNumber', pageNumber);
provide('navDirection', navDirection);

const backdrop = ref(null);

// set timeout 1s change opacity to 0
setTimeout(() => {
    backdrop.value.classList.add('!opacity-0');
    setTimeout(() => {
        backdrop.value.classList.add('!hidden');
    }, 1000);
}, 300);
</script>

<style>
/* hidden scolling */
body::-webkit-scrollbar {
    display: none;
    /* Hide scrollbars for WebKit browsers */
}
</style>