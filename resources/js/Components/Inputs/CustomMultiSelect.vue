<template>
    <div class="dropdown !static sm:!relative flex">
        <template v-if="!disabled">
            <VDropdown :placement="placement" @apply-hide="handleDropdownHide">
                <button ref="buttonRef" type="button"
                    class="w-full truncate flex items-center gap-1.5 rounded-md leading-3 border cursor-pointer font-semibold bg-white border-[#e0e6ed] dark:border-transparent dark:bg-[#121e32] text-gray-500 dark:text-white-dark">
                    <div class="flex items-center gap-2 px-2.5 py-2 rounded-md font-bold"
                        :class="{ 'text-primary': count.length > 0, style }">
                        <button v-if="multiple == true" type="button" @click="countFocus"
                            class="whitespace-nowrap flex justify-between items-center min-w-24 gap-1 text-sm">
                            <span v-if="count.length > 0" :class="buttonStyle" class="max-w-56 truncate">
                                <template v-if="count.length <= 2">
                                    {{count.map(item => item[label] || item.name).join(', ')}}
                                </template>
                                <template v-else>
                                    {{count.slice(0, 2).map(item => item[label] || item.name).join(', ')}} +{{
                                    count.length - 2 }}
                                </template>
                            </span>
                            <span v-else class="text-sm">
                                {{ placeholder ? (isTrans ? $t(`${parentKey}.${placeholder}`) : placeholder) :
                                $t('common.please_select') }}
                            </span>
                        </button>
                        <button v-if="multiple == false" type="button" @click="countFocus"
                            class="flex justify-between items-center min-w-24 gap-4 text-sm">
                            <span v-if="Object.keys(count)?.length > 0" :class="buttonStyle" class="max-w-56 truncate">
                                <span v-if="props.parentKey && isTrans">
                                    {{ $t(`${parentKey}.${checkObject(count[props.label])}`) ||
                                        checkObject(count[props.label] || count.name) }}
                                </span>
                                <span v-else>
                                    {{ checkObject(count[props.label] || count.name) }}
                                </span>
                            </span>
                            <span v-else class="text-sm">
                                {{ placeholder ? (isTrans ? $t(`${placeholderParentKey}.${placeholder}`) : placeholder)
                                    :
                                    $t('common.please_select') }}
                            </span>
                        </button>
                        <button v-if="checkObject(count[props.label] || count.name) || count.length > 0" type="button"
                            @click="clearCount"
                            :disabled="props.requireSelection && (props.multiple ? count.length === 1 : Object.keys(count).length > 0)"
                            :class="{ 'opacity-50 cursor-not-allowed': props.requireSelection && (props.multiple ? count.length === 1 : Object.keys(count).length > 0) }"
                            class="whitespace-nowrap flex justify-between items-center gap-1">
                            <Svg v-if="!requireSelection" name="close" class="size-4 text-gray-500"></Svg>
                        </button>
                        <Svg name="arrow_right" class="size-4 text-gray-500 rotate-90"></Svg>
                    </div>
                </button>

                <template #popper="{ hide }">
                    <ul :class="{ 'pt-2': searchable }"
                        class="relative py-1 w-full whitespace-nowrap text-sm dark:text-gray-200 dark:bg-[#1b2e4b] border !border-gray-200 dark:!border-gray-800 rounded-md overflow-hidden !my-0">
                        <li v-if="searchable" class="relative">
                            <div class="bg-white dark:bg-[#1b2e4b] p-1.5 absolute -top-2 left-0 right-0 z-10">
                                <div class="relative w-full">
                                    <input ref="focusInput" type="text" :placeholder="$t('common.search')"
                                        v-model="countFilter"
                                        class="form-input !py-1 shadow-none focus:border-gray-200 dark:focus:border-gray-800" />
                                    <button v-if="countFilter.length > 0" type="button" @click="clearFilter"
                                        class="absolute end-0 top-2 z-20 mx-2">
                                        <Svg name="close" class="size-5 text-gray-500"></Svg>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li :class="{ 'mt-9': searchable }">
                            <perfect-scrollbar class="relative max-h-52 min-w-52 overflow-auto" :class="style">
                                <button type="button" v-for="(countOption, i) in countOptions" :key="i"
                                    @click="() => { selectOption(countOption, hide); buttonRef?.focus(); }"
                                    class="w-full flex items-center justify-between gap-10 text-sm px-3.5 py-2 duration-150 hover:text-primary hover:bg-primary/10"
                                    :class="[{ '!bg-primary/10 !text-primary': checkSelect(countOption.id) }, buttonStyle]">
                                    <div class="flex items-center gap-2">
                                        <img v-if="countOption.image || has_image"
                                            class="inline-block size-8 rounded-full"
                                            :src="countOption?.image || `/assets/images/avatar.png`"
                                            alt="Image Description" />
                                        <slot name="prefix" :data="countOption"></slot>

                                        <div class="flex flex-col items-start">
                                            <h1 v-if="!countOption.slug" v-html="renderMarkdown(countOption.label)">
                                            </h1>
                                            <h1 v-if="countOption.slug && isTrans">
                                                {{ $t(`${parentKey}.${countOption.slug}`) }}
                                            </h1>
                                            <h1 v-if="countOption.slug && !isTrans">
                                                {{ countOption.label }}
                                            </h1>
                                            <p v-if="isInfo" class="text-xs text-gray-500">{{ countOption.description }}
                                            </p>
                                            <p v-if="isInfo" class="text-xs text-gray-500">{{ countOption?.email }}</p>
                                        </div>
                                    </div>
                                    <Svg name="check" class="size-5"
                                        :class="{ 'hidden': !checkSelect(countOption.id) }"></Svg>
                                </button>
                            </perfect-scrollbar>
                        </li>
                        <li v-if="countOptions.length == 0" class="my-2">
                            <div class="px-4 min-w-56">
                                {{ $t('common.no_results_found') }}
                            </div>
                        </li>
                    </ul>
                </template>
            </VDropdown>

            <input :disabled="disabled" type="text" :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)" class="form-input hidden" />
        </template>
        <template v-else>
            <div class="flex items-center gap-2 px-2 py-1.5 rounded-md font-bold " :class="style">
                <span> {{ count.name }} </span>
            </div>
        </template>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, inject, watch } from 'vue';
import Svg from '@/Components/Svg.vue';

const props = defineProps({
    modelValue: {
        type: [String, Array, Object],
        default: null,
    },
    list: {
        type: Array,
        required: true,
    },
    multiple: {
        type: Boolean,
        default: false,
    },
    label: {
        type: String,
        default: 'name',
    },
    displayField: {
        type: String,
        default: 'name',
    },
    style: {
        type: String,
        default: '',
    },
    has_image: {
        type: Boolean,
        default: false,
    },
    searchable: {
        type: Boolean,
        default: true,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    placement: {
        type: String,
        default: 'bottom-start',
    },
    buttonStyle: {
        type: String,
        default: '',
    },
    listStyle: {
        type: String,
        default: '',
    },
    parentKey: {
        type: String,
        default: '',
    },
    placeholder: {
        type: String,
        default: '',
    },
    placeholderParentKey: {
        type: String,
        default: 'system',
    },
    isInfo: {
        type: Boolean,
        default: false,
    },
    requireSelection: {
        type: Boolean,
        default: false,
    },
    isTrans: {
        type: Boolean,
        default: true,
    },
});

const rtlClass = inject('rtlClass');
const language = inject('language');

const emit = defineEmits(['update:modelValue', 'change']);

const count = ref([]);
const focusInput = ref(null);
const buttonRef = ref(null);

onMounted(() => {
    if (props.multiple) {
        count.value = props.modelValue ? props.modelValue : [];
    } else {
        count.value = props.modelValue ? props.modelValue : {};
    }
});

// Handle dropdown hide to ensure focus returns properly
const handleDropdownHide = () => {
    // Return focus to the button when dropdown closes
    setTimeout(() => {
        buttonRef.value?.focus();
    }, 50);
};

const countFilter = ref('');

const countOptions = computed(() => {
    return props.list
        .filter((item) => {
            const searchString = countFilter.value.toLowerCase();

            // Use the label prop to determine which field to search
            const labelField = props.label || 'name';
            const itemValue = typeof item[labelField] === 'string' ? item[labelField].toLowerCase().includes(searchString) : false;

            // Fallback to original fields for backward compatibility
            const itemName = typeof item.name === 'string' ? item.name.toLowerCase().includes(searchString) : false;
            const itemTitle = typeof item.title === 'string' ? item.title.toLowerCase().includes(searchString) : false;
            const itemDisplayName = typeof item.display_name === 'string' ? item.display_name.toLowerCase().includes(searchString) : false;

            return itemValue || itemName || itemTitle || itemDisplayName;
        })
        .map((item) => ({
            ...item,
            label: item[props.label] || item.name || item.title,
            description: item.description,
            email: item.email,
            filter: item.filter,
        }));
});


// Already declared above, reusing here
const countFocus = () => {
    setTimeout(() => {
        focusInput?.value?.focus();
    }, 100);
};

const selectOption = (option, hide) => {
    if (props.multiple) {
        const index = count.value.findIndex((item) => item.id === option.id);
        if (index !== -1) {
            // Prevent deselecting if requireSelection is true and only one item is selected
            if (props.requireSelection && count.value.length === 1) {
                return;
            }
            count.value.splice(index, 1);
        } else {
            count.value.push(option);
        }
    } else {
        // Prevent deselecting if requireSelection is true and trying to select the same option
        if (props.requireSelection && count.value.id === option.id) {
            return;
        }
        count.value = option;
    }

    emit('update:modelValue', count.value);
    emit('change', count.value);

    if (!props.multiple) {
        // Return focus to button after selecting in single-select mode
        hide();
        setTimeout(() => {
            buttonRef.value?.focus();
        }, 50);
    }
};

const checkSelect = (id) => {

    if (!id || !count.value) return false;

    if (!props.multiple) {
        return count.value.id === id;
    } else {
        return count.value?.length && count.value.some((item) => item.id === id);
    }
};

const clearFilter = () => {
    setTimeout(() => {
        countFilter.value = '';
    }, 100);
};

const clearCount = () => {
    // Prevent clearing if requireSelection is true
    if (props.requireSelection) {
        return;
    }

    count.value = props.multiple ? [] : {};
    emit('update:modelValue', count.value);
    emit('change', count.value);
};

const checkObject = (value) => {
    if (typeof value === 'object' && value !== null) {
        return value[language.value] || value['en'];
    }

    return value;
};

watch(() => props.modelValue, (newValue) => {
    if (props.multiple) {
        count.value = newValue ? newValue : [];
    } else {
        count.value = newValue ? newValue : {};
    }
}, { deep: true });


import { marked } from 'marked';

const renderMarkdown = (body) => {
    if (!body) return '';

    if (!body.includes('*')) return body;

    let content = body

        .replace(/\n/g, '  \n')
        .replace(/\*\*/g, '___DOUBLE_ASTERISK___')
        .replace(/\*([^*]+)\*/g, '**$1**')
        .replace(/___DOUBLE_ASTERISK___/g, '**');

    const renderer = new marked.Renderer();
    return marked.parseInline(content, { renderer });
};

</script>
