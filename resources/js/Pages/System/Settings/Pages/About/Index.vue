<template>

    <Head>
        <title>{{ $t('system.logs') }}</title>
    </Head>
    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <div class="flex whitespace-nowrap">
                <ul class="flex flex-wrap space-x-2 rtl:space-x-reverse">
                    <li class="text-gray-400">
                        <span>{{ $t('system.system') }}</span>
                    </li>
                    <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                        <Link :href="route('control.system.settings')" class="duration-200 hover:text-primary">
                        {{ $t("system.settings") }}
                        </Link>
                    </li>
                    <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                        <span>{{ $t('system.logs') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-4">
            <div class="panel ">
                <!-- Filters -->
                <perfect-scrollbar class="relative max-w-max">
                    <div class="flex items-center gap-2 w-full mb-2 whitespace-nowrap">

                        <!--Filtered by User -->
                        <CustomMultiSelect v-model="filters.user_id" @change="apply_filter" :list="props.users"
                            value="id" :multiple="false" placeholder-parent-key="system" placeholder="email"
                            label="email" />

                        <!--Filtered by Event Type -->
                        <CustomMultiSelect v-model="filters.event" @change="apply_filter" :list="props.events"
                            value="value" :multiple="false" placeholder-parent-key="system" placeholder="event_type"
                            label="label" />

                        <!--Filtered by Subject Type -->
                        <CustomMultiSelect v-model="filters.subject_type" @change="apply_filter" :list="props.subjectTypes"
                            value="value" :multiple="false" placeholder-parent-key="system" placeholder="model"
                            label="label" />

                        <!-- Date Range Picker -->
                        <CustomDatePicker v-model="dateRangeModel" filter-key="created_at" parent-key="system"
                            placeholder="select_created_at_range" @apply-filter="handleApplyFilter"
                            @clear-filter="handleClearFilter" />
                    </div>
                </perfect-scrollbar>

                <!-- Datatable -->
                <Datatable :rows="logs" :columns="columns" :totalRows="logs.data?.length" @change="apply_filter"
                    v-model:search="filters.search" v-model:numberRows="filters.number_rows" :filter="props.filter"
                    v-model:sortBy="filters.sort_by" v-model:sortDirection="filters.sort_direction">

                    <template #updated_at="data">
                        <span v-tippy dir="ltr" class="text-sm font-bold ltr">
                            {{ data.value.updated_at ? $helpers.formatCustomDate(data.value.updated_at) : '' }}
                        </span>
                        <tippy>{{ $helpers.formatCustomDate(data.value.updated_at, true) }}</tippy>
                    </template>

                    <template #created_at="data">
                        <span v-tippy dir="ltr" class="text-sm font-bold ltr">
                            {{ data.value.created_at ? $helpers.formatCustomDate(data.value.created_at) : '' }}
                        </span>
                        <tippy>{{ $helpers.formatCustomDate(data.value.created_at, true) }}</tippy>
                    </template>
                </Datatable>
            </div>
        </div>
    </div>
</template>
<script setup>
import { inject, ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { wTrans } from 'laravel-vue-i18n';
import Datatable from '@/Components/Datatable.vue';
import { initializeFilters, updateFilters, } from '@/Plugins/FiltersPlugin';
import CustomDatePicker from '@/Components/Inputs/CustomDatePicker.vue';
import { useDateFilters } from '@/composables/useDateFilters.js';
import CustomMultiSelect from '@/Components/Inputs/CustomMultiSelect.vue';

const props = defineProps([
    'users',
    'logs',
    'events',
    'subjectTypes',
    'filter',
]);

console.log(props.events);

const $helpers = inject('helpers');

const filters = initializeFilters({
    search: '',
    number_rows: 10,
    sort_by: 'id',
    sort_direction: 'desc',
    start_date: props.filter.start_date || '',
    end_date: props.filter.end_date || '',
    event: props.filter.event || '',
    subject_type: props.filter.subject_type || '',
}, {
    user_id: (id) => {
        return props.users.find(u => u.id == id) || null;
    },
    event: (event) => {
        return props.events.find(e => e.value == event) || null;
    },
    subject_type: (type) => {
        return props.subjectTypes.find(t => t.value == type) || null;
    },
});

// console.log(props.filter.user_id, props.users.find(u => u.id == props.filter.user_id).email);

const apply_filter = () => {
    updateFilters({
        ...filters,
        user_id: filters.user_id || props.users.find(u => u.id == props.filter.user_id) || '',
        event: filters.event ? filters.event.value : '',
        subject_type: filters.subject_type ? filters.subject_type.value : '',
        start_date: filters.start_date || '',
        end_date: filters.end_date || '',
    });
};

const { dateRangeModel, handleApplyFilter, handleClearFilter } = useDateFilters(filters, apply_filter);

// Watch for changes in filters and apply them
const columns =
    ref([
        {
            field: 'id',
            title: 'ID',
            width: '25px',
            type: 'number',
        },
        {
            field: 'users.name',
            title: wTrans('common.user')
        },
        {
            field: 'users.email',
            title: wTrans('common.email')
        },
        {
            field: 'action',
            title: wTrans('common.action')
        },
        {
            field: 'event',
            title: wTrans('common.event')
        },
        {
            field: 'subject_type',
            title: wTrans('common.model')
        },
        {
            field: 'row_id',
            title: wTrans('common.row_id')
        },
        {
            field: 'created_at',
            title: wTrans('common.created_at'),
            type: 'date',
        },
    ]) || [];
</script>