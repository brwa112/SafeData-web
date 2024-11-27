<template>
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-t from-indigo-200 to-indigo-300">
        <div class="text-center p-5">
            <h2 class="text-3xl md:text-5xl mb-10 font-bold">Under Maintenance</h2>
            <h4 class="mb-5 font-semibold text-xl sm:text-2xl text-primary">Thank you for visiting us.</h4>
            <p class="text-base">
                We are currently working on making some improvements <br class="sm:block hidden" />to give you better user
                experience. <br />
                <br />Please visit us again shortly.
            </p>
            <Link href="/" class="btn btn-primary mt-5 w-max mx-auto">Home</Link>
        </div>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<script>
import layout from '@/Layouts/Public.vue'

export default {
    layout: layout,
}
</script>