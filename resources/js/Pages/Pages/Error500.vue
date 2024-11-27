<template>
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-t  from-indigo-200 to-indigo-300">
        <div class="text-center p-5 font-semibold">
            <h2 class="text-[50px] md:text-[80px] leading-none mb-8 font-bold">Error 500</h2>
            <h4 class="mb-5 font-semibold text-xl sm:text-5xl text-primary">Ooops!</h4>
            <p class="text-base">Internal Server Error!</p>
            <Link href="/" class="btn btn-primary mt-10 w-max mx-auto">Home</Link>
        </div>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<script>
import layout from '@/Layouts/Public.vue'

export default {
    layout: layout,
}
</script>