<template>
    <div class="datatable relative">

        <!-- Table Header -->
        <div v-if="isTop" class="w-full pb-1.5">
            <perfect-scrollbar class="w-full">
                <div class="flex items-center gap-2">
                    <!-- Customize Columns Dropdown -->
                    <div class="dropdown !static sm:!relative flex">
                        <VDropdown :placement="rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="0"
                            class="align-middle" @apply-hide="handleDropdownHide">
                            <button type="button"
                                class="flex items-center gap-2 rounded-md p-2.5 leading-3 border cursor-pointer font-semibold bg-white border-[#e0e6ed] dark:border-transparent dark:bg-[#121e32] text-gray-500 dark:text-white-dark">
                                <Svg name="column" class="size-4"></Svg>
                            </button>

                            <template #popper="{ hide }">
                                <ul
                                    class="whitespace-nowrap text-gray-500 dark:text-white-dark  dark:bg-[#121e32] border border-gray-200 dark:border-[#191e3a] rounded shadow-lg p-1">
                                    <li class=" text-gray-500 dark:text-white-dark text-xs mx-2 mb-1">
                                        {{ $t('common.columns') }}
                                    </li>
                                    <template v-for="(col, i) in columns" :key="i">
                                        <li>
                                            <div class="flex items-center px-2 py-0.5">
                                                <label class="cursor-pointer mb-0">
                                                    <input type="checkbox" class="form-checkbox" :id="`chk-${i}`"
                                                        :value="col.field"
                                                        @change="(e) => $helpers.updateDatatableColumnVisibility(col, e.target.checked, columns)"
                                                        :checked="!col.hide" />
                                                    <span :for="`chk-${i}`">{{ col.title }}</span>
                                                </label>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </template>
                        </VDropdown>
                    </div>

                    <!-- Search Input -->
                    <div class="relative block sm:min-w-64">
                        <input ref="searchInput" v-model="search" type="text"
                            class="form-input shadow-none dark:!border-transparent pe-8 min-w-44"
                            :placeholder="$t('common.search')" />
                        <Svg name="search" class="size-4 absolute end-2 top-1/2 -translate-y-1/2"></Svg>
                    </div>
                    <!-- Actions -->
                    <vue3-json-excel v-if="exportable" type="xlsx" :data="prepareData(props.rows.data)" :name="namefile"
                        class="flex items-center gap-1.5 rounded-md p-2.5 leading-3 border cursor-pointer font-semibold bg-white border-[#e0e6ed] dark:border-transparent dark:bg-[#121e32] text-gray-500 dark:text-white-dark">
                        <Svg name="export" class="size-4"></Svg>
                        {{ $t('common.export') }}
                    </vue3-json-excel>
                    <button v-if="importable" type="button" @click="openImport"
                        :class="['flex items-center gap-1.5 rounded-md p-2.5 leading-3 border font-semibold bg-white border-[#e0e6ed] dark:border-transparent dark:bg-[#121e32] text-gray-500 dark:text-white-dark', { 'opacity-50 cursor-not-allowed': false }]">
                        <Svg name="export" class="size-4 rotate-180"></Svg>
                        {{ $t('common.import') }}
                    </button>
                    <button v-if="selectedCount" type="button" @click="confirmBulkDelete"
                        :disabled="selectedCount === 0"
                        :class="['flex items-center gap-1.5 rounded-md p-2.5 leading-3 border font-semibold bg-white border-[#e0e6ed] dark:border-transparent dark:bg-[#121e32] text-gray-500 dark:text-white-dark', { 'opacity-50 cursor-not-allowed': selectedCount === 0 }]">
                        <Svg name="trash_fill" class="size-4"></Svg>
                        {{ $t('common.delete') }}
                        <span class="text-xs text-gray-400">({{ selectedCount || 0 }})</span>
                    </button>
                    <button v-if="false && selectedCount" type="button" @click="confirmBulkRestore"
                        :disabled="selectedCount === 0"
                        :class="['flex items-center gap-1.5 rounded-md p-2.5 leading-3 border font-semibold bg-white border-[#e0e6ed] dark:border-transparent dark:bg-[#121e32] text-gray-500 dark:text-white-dark', { 'opacity-50 cursor-not-allowed': selectedCount === 0 }]">
                        <Svg name="restore" class="size-4"></Svg>
                        {{ $t('common.restore') }}
                        <span class="text-xs text-gray-400">({{ selectedCount || 0 }})</span>
                    </button>
                    <vue3-json-excel v-if="exportable && selectedCount > 0" type="xlsx" :data="prepareSelectedData()"
                        :name="namefileSelected"
                        class="flex items-center gap-1.5 rounded-md p-2.5 leading-3 border cursor-pointer font-semibold bg-white border-[#e0e6ed] dark:border-transparent dark:bg-[#121e32] text-gray-500 dark:text-white-dark">
                        <Svg name="export" class="size-4"></Svg>
                        {{ $t('common.export') }}
                        <span class="text-xs text-gray-400">({{ selectedCount || 0 }})</span>
                    </vue3-json-excel>
                    <slot name="datatable-actions"></slot>
                </div>
            </perfect-scrollbar>
        </div>

        <!-- Table -->
        <vue3-datatable ref="datatable" :skin="''" :columns="columns" :rows="rows" v-bind="$attrs"
            :hasCheckbox="checkable" :firstArrow="double_arrows" :lastArrow="last_arrow" :previousArrow="previous_arrow"
            :nextArrow="next_arrow" :pagination="false" :sortable="true" :sortColumn="filter.sort_by"
            :sortDirection="filter.sort_direction" :isServerMode="true" :stickyHeader="stickyHeader"
            :stickyFirstColumn="stickyFirstColumn" :totalRows="totalRows" @change="changeSort($event)"
            class="alt-pagination whitespace-nowrap">
            <template v-for="column in columns" v-slot:[column.field]="data">
                <slot class="capitalize" v-if="hasSlot(column.field)" :name="column.field" v-bind="data"></slot>
                <template v-else>
                    <span class="capitalize">
                        {{typeof column?.format == 'function' ? column.format(get_property(rows.find(x => x.id
                            ==
                            data.value.id), column.field), rows.find(x => x.id == data.value.id)) :
                            get_property(rows.find(x => x.id == data.value.id), column.field)}}
                    </span>
                </template>
            </template>
        </vue3-datatable>

        <!-- Pagination -->
        <div v-if="isPaginate" class="flex flex-col md:flex-row items-center justify-between gap-2 py-2.5">
            <div class="flex items-center gap-2">
                <div class="w-20">
                    <MultiSelect :list="perPageOptions" v-model="pagePerSelected" :label="'name'" :multiple="false"
                        :placeholder="false" />
                </div>
                <span class="text-sm text-gray-500 dark:text-white-dark">
                    {{ $t('common.showing') }} {{ props.rows.meta ? props.rows.meta.current_page :
                        props.rows.current_page }} {{
                        $t('common.of') }}
                    {{ props.rows.meta ? props.rows.meta.last_page : props.rows.current_page }}
                </span>
            </div>
            <div class="block">
                <Pagination :data="props.rows" />
            </div>
        </div>

    </div>
</template>

<script setup>
import { inject, onMounted, onUnmounted, ref, useSlots, defineAsyncComponent, watch, reactive, provide, computed, nextTick } from 'vue';
import Vue3Datatable from '@bhplugin/vue3-datatable';
import Svg from '@/Components/Svg.vue';
import vue3JsonExcel from 'vue-json-excel3';
import Pagination from '@Components/Common/Pagination.vue';
import MultiSelect from '@Components/Inputs/MultiSelect.vue';

const $helpers = inject('helpers');
const rtlClass = inject('rtlClass');

const props = defineProps({
    columns: Array,
    rows: [Object, Array],
    skin: {
        type: String,
        default: 'whitespace-nowrap table-hover table-striped'
    },
    searchable: {
        type: Boolean,
        default: true
    },
    customize_column: {
        type: Boolean,
        default: true
    },
    exportable: {
        type: Boolean,
        default: true
    },
    importable: {
        type: Boolean,
        default: false
    },
    checkable: {
        type: Boolean,
        default: true
    },
    search: {
        type: String,
        default: ''
    },
    isPaginate: {
        type: Boolean,
        default: true
    },
    totalRows: {
        type: Number,
        default: 0
    },
    isTop: {
        type: Boolean,
        default: true
    },
    numberRows: {
        type: [Number, String],
        default: 10
    },
    sortBy: {
        type: String,
        // default: 'id'
    },
    sortDirection: {
        type: String,
        // default: 'desc'
    },
    filter: {
        type: Object,
        default: () => ({})
    },
    stickyHeader: {
        type: Boolean,
        default: false
    },
    stickyFirstColumn: {
        type: Boolean,
        default: true
    }
});

const datatable = ref(null);
const selection = ref([]);
const buttonRef = ref(null);


const selectedCount = computed(() => Array.isArray(selection.value) ? selection.value.length : 0);

const rows = ref(props.isPaginate ? props.rows.data : props.rows);
const totalRows = ref(props.totalRows);

watch(() => props.rows, (newValue) => {
    rows.value = props.isPaginate ? newValue.data : newValue;
});

watch(() => props.totalRows, (newValue) => {
    totalRows.value = newValue;
});

const numberRows = ref(props.numberRows);

// per-page options for multiselect
const perPageOptions = [
    { id: 10, name: '10' },
    { id: 25, name: '25' },
    { id: 50, name: '50' },
    { id: 100, name: '100' }
];

// local selected option object for MultiSelect component
const pagePerSelected = ref(perPageOptions.find(o => String(o.id) === String(props.numberRows)) || perPageOptions[0]);

// sync pagePerSelected -> numberRows and reset datatable
watch(pagePerSelected, (newVal) => {
    if (newVal && newVal.id) {
        numberRows.value = newVal.id;
        resetDatatable();
    }
});



const emits = defineEmits([
    'update:search', 'change', 'update:numberRows', 'update:sortBy', 'update:sortDirection',
    'update:selection', 'bulk-delete', 'bulk-restore', 'import'
]);

watch(selection, (newVal) => {
    emits('update:selection', newVal);
});

const updateSelectionFromDom = () => {
    try {
        if (!datatable.value || !datatable.value.$el) return;
        const el = datatable.value.$el;
        const inputs = Array.from(el.querySelectorAll('input[type="checkbox"]'));
        const rowCheckboxes = inputs.filter(i => i.value !== undefined && i.value !== '' && !i.closest('thead'));
        const ids = rowCheckboxes.filter(i => i.checked).map(i => i.value);
        selection.value = ids;
    } catch (err) {
        // noop
    }
};

const onDatatableChange = (e) => {
    if (e.target && e.target.type === 'checkbox') {
        updateSelectionFromDom();
    }
};

onUnmounted(() => {
    if (datatable.value && datatable.value.$el) {
        try { datatable.value.$el.removeEventListener('change', onDatatableChange); } catch (e) { }
    }
});


watch(numberRows, (newValue) => {
    emits('update:numberRows', newValue);
    emits('change', newValue);
});

const changeSort = (data) => {
    emits('update:sortBy', data.sort_column);
    emits('update:sortDirection', data.sort_direction);
    emits('change', data);
};

watch(() => props.sortDirection, (newValue) => {
    datatable.value.sortDirection = newValue;
});

const search = ref(props.search);
const columns = ref(props.columns);

const filtered = (rows) => {
    return rows.filter(row => {
        return Object.values(row).some(value => {
            return String(value).toLowerCase().includes(search.value.toLowerCase());
        });
    });
};

const searchInput = ref(null);

const checkSearchFocus = () => {
    const urlParams = new URLSearchParams(window.location.search);
    const searchFilter = urlParams.get('filter[search]');

    if (searchFilter !== null && searchInput.value) {
        nextTick(() => {
            searchInput.value.focus();
        });
    }
};

watch(searchInput, () => {
    checkSearchFocus();
});

watch(() => props.rows, () => {
    checkSearchFocus();
});

watch(search, (newValue) => {
    emits('update:search', newValue);
    emits('change', newValue);
});

const slots = useSlots();

onMounted(() => {
    columns.value = columns.value.map(col => $helpers.getDatatableColumnVisibility(col))
});

const resetDatatable = () => {
    datatable.value.reset();
};

// Handle dropdown hide to ensure focus returns properly
const handleDropdownHide = () => {
    // Return focus to the button when dropdown closes
    setTimeout(() => {
        buttonRef.value?.focus();
    }, 50);
};

onMounted(() => {
    nextTick(() => {
        if (datatable.value && datatable.value.$el) {
            datatable.value.$el.addEventListener('change', onDatatableChange);
        }
    });
});

const clearSearchInput = () => {
    search.value = '';
};

// Import handling
const importInput = ref(null);
const openImport = () => {
    if (importInput.value) importInput.value.click();
};
const confirmBulkDelete = () => {
    if (selectedCount.value === 0) return;
    emits('bulk-delete', selection.value.slice());
};

const confirmBulkRestore = () => {
    if (selectedCount.value === 0) return;
    emits('bulk-restore', selection.value.slice());
};

defineExpose({
    clearSearchInput,
    resetDatatable
});

const hasSlot = (name) => {
    return slots[name] !== undefined;
};

const options = {
    timeZone: 'Asia/Baghdad',
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: false
};

const formatter = new Intl.DateTimeFormat('en-GB', options);
const parts = formatter.formatToParts(new Date());

const currentTimestamp = `${parts.find(p => p.type === 'year').value}_${parts.find(p => p.type === 'month').value}_${parts.find(p => p.type === 'day').value}_${parts.find(p => p.type === 'hour').value}_${parts.find(p => p.type === 'minute').value}_${parts.find(p => p.type === 'second').value}`;
const namefile = `Data_${currentTimestamp}.xlsx`;
const namefileSelected = `Data_selected_${currentTimestamp}.xlsx`;
const prepareData = (data) => {
    return data?.map(row => {
        return columns.value.filter(x => !x?.hide && !x?.field?.toString()?.startsWith('action')).map(col => {
            return {
                [col.title]: typeof col.export_format == 'function' ? col.export_format(row) : get_property(row, col.field)
            }
        }).reduce((acc, cur) => {
            return { ...acc, ...cur }
        }, {})
    })
};

const prepareSelectedData = () => {
    // selection contains ids (possibly strings) — match against rows.value
    const sel = Array.isArray(selection.value) ? selection.value.map(String) : [];
    const source = props.isPaginate ? (props.rows?.data || []) : (props.rows || []);
    const selectedRows = source.filter(r => sel.includes(String(r.id)));
    return prepareData(selectedRows);
};

const get_property = (obj, prop) => {
    var parts = prop.split(".");

    if (parts.length === 1) {
        return obj[prop];
    }

    if (Array.isArray(parts)) {
        var last = parts.pop(),
            l = parts.length,
            i = 1,
            current = parts[0];

        while ((obj = obj[current]) && i < l) {
            current = parts[i];
            i++;
        }

        if (obj) {
            return obj[last];
        }
    } else {
        throw "parts is not valid array";
    }
}

const double_arrows = '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /> </svg>';
const last_arrow = '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg> ';
const previous_arrow = '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>';
const next_arrow = '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>';
</script>

<style>
/* alt-pagination */
.alt-pagination .bh-pagination .bh-page-item {
    @apply !w-max min-w-[32px] !rounded;
}

/* next-prev-pagination */
.next-prev-pagination .bh-pagination .bh-page-item {
    @apply !w-max min-w-[100px] !rounded;
}

.next-prev-pagination .bh-pagination>div:first-child {
    @apply flex-col font-semibold;
}

.next-prev-pagination .bh-pagination .bh-pagination-number {
    @apply mx-auto gap-3;
}
</style>