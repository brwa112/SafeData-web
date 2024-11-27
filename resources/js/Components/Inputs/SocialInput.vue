<template>
    <div class="flex">
        <div
            class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">
            <Icons :type="type" />
        </div>
        <input id="Email" type="text" :placeholder="$t('form.facebook_link')"
            class="form-input ltr:rounded-l-none rtl:rounded-r-none" />
    </div>
</template>

<script setup>
import { ref, defineProps } from 'vue';
import Icons from '@/Components/Icons.vue';

defineProps(['modelValue', 'type']);

</script>