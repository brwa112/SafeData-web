<template>
    <div>
        <multiselect :label="label" :track-by="trackBy" :options="list"
            :class="{ 'border border-red-300 rounded-md': error }" class="custom-multiselect w-full whitespace-nowrap"
            v-model="valueInput" :multiple="multiple" :placeholder="placeholder ? $t('common.please_select') : ''"
            :value="modelValue" selected-label="" select-label="" deselect-label="">
            <template v-slot:noResult>
                {{ $t('common.no_results_found') }}
            </template>
            <template v-slot:option="{ option }">
                <div v-if="option && typeof option === 'object' && option !== null"
                    class="w-full flex items-center gap-2">
                    <slot name="prefix" :data="option"></slot>

                    <span v-if="parentKey">
                        {{ $t(`${parentKey}.${option[label]}`) }}
                        {{ option.value && showValue ? ' - ' : '' }}
                    </span>
                    <span v-else>
                        {{ checkObject(option[label]) }} {{ option.value && showValue ? ' - ' : '' }}
                    </span>
                    <span v-if="showValue">{{ option.value }}</span>
                </div>
                <div v-if="option && typeof option === 'string' && option !== null"
                    class="w-full flex items-center gap-2">
                    <!-- <span>{{ option }}</span> -->
                </div>
            </template>
            <template v-slot:singleLabel="{ option }">
                <div v-if="option && typeof option === 'object' && option !== null" class="w-full flex items-center">
                    <span v-if="parentKey">{{ $t(`${parentKey}.${option[label]}`) }} {{ option.value && showValue ? ' - ' : '' }}</span>
                    <span v-else>{{ checkObject(option[label]) }} {{ option.value && showValue ? ' - ' : '' }}</span>
                    <span v-if="showValue">{{ option.value }}</span>
                </div>
            </template>
        </multiselect>
        <p v-if="error" class="text-red-500 text-xs mt-1 ms-0.5">{{ error }}</p>
    </div>
</template>

<script setup>
import { ref, watch, onMounted, inject } from 'vue';
import Multiselect from '@suadelabs/vue3-multiselect';
import '@suadelabs/vue3-multiselect/dist/vue3-multiselect.css';

const props = defineProps({
    list: {
        type: Array,
        required: true,
    },
    modelValue: {
        type: [String, Array, Object],
        default: '',
    },
    multiple: {
        type: Boolean,
        default: false,
    },
    label: {
        type: String,
        default: 'name',
    },
    trackBy: {
        default: 'id',
    },
    placeholder: {
        type: Boolean,
        default: true,
    },
    error: {
        type: String,
        default: '',
    },
    showValue: {
        type: Boolean,
        default: true,
    },
    parentKey: {
        type: String,
        default: '',
    },
});

const language = ref(localStorage.getItem('language') || 'en');

const emits = defineEmits(['update:modelValue']);

const valueInput = ref(props.modelValue);

onMounted(() => {
    valueInput.value = props.modelValue;
});

watch(() => props.modelValue, (newValue) => {
    valueInput.value = newValue;
});

watch(valueInput, (newValue) => {
    emits('update:modelValue', newValue);
});

const checkObject = (value) => {
    if (typeof value === 'object' && value !== null) {
        return value[language.value] || value['en'];
    }

    return value;
};
</script>

<style>
.multiselect__content {
    width: 100% !important;
}
</style>