<template>
    <div class="flex">
        <input :type="type" :placeholder="placeholder" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="form-input ltr:rounded-r-none rtl:rounded-l-none flex-1" />
        <div
            class="bg-[#eee] flex justify-center items-center px-3 font-semibold rounded-md ltr:rounded-l-none rtl:rounded-r-none border ltr:border-l-0 rtl:border-r-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">
            <span v-html="icon"></span>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps } from 'vue';

defineProps(['modelValue', 'type', 'placeholder', 'icon']);

</script>