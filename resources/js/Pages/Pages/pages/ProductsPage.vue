<template>
    <div class="relative container 2xl:max-w-[100rem] mx-auto z-20 py-36">
        <div class="relative w-full flex flex-col items-center justify-center gap-10 text-white px-7">
            <h1 v-motion-slide-visible-bottom :duration="300" class="font-audi text-xl md:text-2xl xl:text-3xl">PRODUCTS
            </h1>
            <div class="relative w-full grid sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-7">
                <ProductCard v-motion-slide-visible-bottom :duration="300" v-for="product in products" :key="product.id"
                    :product="product" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import ProductCard from '../components/ProductCard.vue';

const props = defineProps([
    'products',
]);

</script>