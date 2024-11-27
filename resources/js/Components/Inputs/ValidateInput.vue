<template>
    <div :class="{ 'has-error': error, 'has-success': isSubmit && !error }">
        <div class="flex">
            <div
                class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">
                @
            </div>
            <input id="Email" type="text" :placeholder="$t('form.enter_email')" :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                class="form-input ltr:rounded-l-none rtl:rounded-r-none" />
        </div>
        <template v-if="isSubmit && !error">
            <p class="text-[#1abc9c] mt-1 text-xs mx-10">Looks Good!</p>
        </template>
        <template v-if="isSubmit && error">
            <p class="text-danger mt-1 text-xs mx-10">Please fill the Email</p>
        </template>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps(['modelValue', 'type', 'isSubmit', 'error']);

</script>