<template>
    <multiselect :options="list" class="custom-multiselect" v-model="valueInput" :placeholder="$t('form.please_select')"
        :value="modelValue" selected-label="" select-label="" deselect-label="">
        <template v-slot:noResult>
            {{ $t('form.no_results_found') }}
        </template>
        <template v-slot:option="{ option }">
            <div v-if="option && typeof option === 'object' && option !== null" class="flex items-center gap-2">
                <span>{{ option.name }} - </span>
                <span>{{ option.value }}</span>
            </div>
        </template>
        <template v-slot:singleLabel="{ option }">
            <div v-if="option && typeof option === 'object' && option !== null" class="flex items-center gap-2">
                <span>{{ option.name }} - </span>
                <span>{{ option.value }}</span>
            </div>
        </template>
    </multiselect>
</template>

<script setup>
import { ref, defineProps, watch, defineEmits, onMounted } from 'vue';
import Multiselect from '@suadelabs/vue3-multiselect';
import '@suadelabs/vue3-multiselect/dist/vue3-multiselect.css';

const props = defineProps(['modelValue', 'list']);
const emits = defineEmits();

onMounted(() => {
    valueInput.value = props.modelValue;
});

const valueInput = ref('');

watch(valueInput, () => {
    emits('update:modelValue', valueInput.value);
});
</script>