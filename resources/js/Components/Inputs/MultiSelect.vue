<template>
    <div>
        <multiselect :label="label" :track-by="trackBy" :options="list"
            :class="{ 'border border-red-300 rounded-md': error }"
            class="custom-multiselect w-full whitespace-nowrap capitalize" v-model="valueInput" :multiple="multiple"
            :placeholder="placeholder ? $t('common.please_select') : ''" :value="modelValue" selected-label=""
            select-label="" deselect-label="">
            <template v-slot:noResult>
                {{ $t('common.no_results_found') }}
            </template>
            <template v-slot:option="{ option }">
                <div v-if="option && typeof option === 'object' && option !== null"
                    class="w-full flex items-center justify-between gap-2 capitalize">
                    <div class="flex items-center gap-2">
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
                    <!-- Check icon for selected items -->
                    <Svg v-if="isSelected(option)" name="check" class="h-5 w-5 text-primary"></Svg>
                </div>
                <div v-if="option && typeof option === 'string' && option !== null"
                    class="w-full flex items-center gap-2">
                    <!-- <span>{{ option }}</span> -->
                </div>
            </template>
            <template v-slot:singleLabel="{ option }">
                <div v-if="option && typeof option === 'object' && option !== null"
                    class="w-full flex items-center capitalize">
                    <span v-if="parentKey">
                        {{ $t(`${parentKey}.${option[label]}`) }} {{ option.value && showValue ? ' - ' : '' }}
                    </span>
                    <span v-else>{{ checkObject(option[label]) }} {{ option.value && showValue ? ' - ' : '' }}</span>
                    <span v-if="showValue">{{ option.value }}</span>
                </div>
            </template>
        </multiselect>
        <p v-if="error" class="text-red-500 b-text-xs mt-1 ms-0.5">{{ error }}</p>
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
    if (typeof valueInput.value === 'object' && valueInput.value !== null && Object.keys(valueInput.value).length === 0) {
        valueInput.value = null;
    }
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

// Check if an option is selected
const isSelected = (option) => {
    if (!option || !valueInput.value) return false;

    if (props.multiple && Array.isArray(valueInput.value)) {
        // For multiple select, check if option is in the array
        return valueInput.value.some(item => {
            if (typeof item === 'object' && typeof option === 'object') {
                return item[props.trackBy] === option[props.trackBy];
            }
            return item === option;
        });
    } else {
        // For single select, compare with the single value
        if (typeof valueInput.value === 'object' && typeof option === 'object') {
            return valueInput.value[props.trackBy] === option[props.trackBy];
        }
        return valueInput.value === option;
    }
};
</script>

<style>
.multiselect__content {
    width: 100% !important;
}
</style>