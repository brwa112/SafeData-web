<template>

    <Head>
        <title>{{ $t('nav.news') + ' ' + $t('pages.hashtag') }}</title>
    </Head>

    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li class="text-gray-500">
                    <span>{{ $t('pages.pages') }}</span>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <Link :href="route('control.pages.news.index')" class="hover:underline">
                    <span>{{ $t('pages.news') }}</span>
                    </Link>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <span>{{ $t('pages.hashtag') }}</span>
                </li>
            </ul>
            <div class="flex items-center gap-3">
                <button type="button" class="btn btn-sm btn-primary shadow-none flex items-center gap-1"
                    @click="toggleModal()">
                    <Svg name="new" class="size-4"></Svg>
                    <span>{{ $t('common.new') }} {{ $t('pages.hashtag') }}</span>
                </button>
            </div>
        </div>

        <!-- Modal -->
        <FormModal :showModal="showModal" :form="form" @submit="save" @close="toggleModal" />

        <!-- Datatable Section -->
        <div class="pt-5">
            <div class="panel pb-0">
                <Datatable :rows="hashtags" :columns="columns" :totalRows="hashtags.data?.length"
                    @change="apply_filter" v-model:search="filters.search" v-model:numberRows="filters.number_rows"
                    :filter="props.filter" v-model:sortBy="filters.sort_by"
                    v-model:sortDirection="filters.sort_direction">

                    <template #datatable-actions>
                        <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                            placeholder="select_language" parent-key="system" :require-selection="true" />
                    </template>

                    <template #name="data">
                        <div class="flex flex-col">
                            <span class="font-semibold">#{{ $helpers.getTranslation(data.value.name,
                                selectLanguage.slug) }}</span>
                            <span class="text-xs text-gray-500">{{ data.value.slug }}</span>
                        </div>
                    </template>

                    <template #is_active="data">
                        <span v-if="data.value.is_active" class="badge bg-success">
                            {{ $t('common.active') }}
                        </span>
                        <span v-else class="badge bg-danger">
                            {{ $t('common.inactive') }}
                        </span>
                    </template>

                    <template #usage_count="data">
                        <div class="flex items-center gap-1.5">
                            <span class="text-sm font-semibold">{{ data.value.news_count || 0 }}</span>
                        </div>
                    </template>

                    <template #updated_at="data">
                        <span v-tippy dir="ltr" class="text-sm font-bold ltr">
                            {{ data.value.updated_at ? $helpers.formatCustomDate(data.value.updated_at) : '' }}
                        </span>
                        <tippy>{{ $helpers.formatCustomDate(data.value.updated_at, true) }}</tippy>
                    </template>

                    <template #actions="data">
                        <!-- Active Record Actions -->
                        <div v-if="data.value.deleted_at == null" class="flex items-center justify-end gap-2">
                            <div class="text-center">
                                <button type="button" v-tippy @click="toggleModal(data.value)">
                                    <Svg name="pencil" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t("common.edit") }}</tippy>
                            </div>

                            <div class="text-center">
                                <button type="button" v-tippy @click="callDelete(data.value.id)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t("common.delete") }}</tippy>
                            </div>
                        </div>

                        <!-- Deleted Record Actions -->
                        <div v-else class="flex gap-2">
                            <div class="text-center">
                                <button type="button" v-tippy @click="callForceDelete(data.value)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('common.delete') }}</tippy>
                            </div>
                            <div class="text-center">
                                <button type="button" v-tippy @click="callRestore(data.value)">
                                    <Svg name="restore" class="size-5 opacity-65"></Svg>
                                </button>
                                <tippy>{{ $t('common.restore') }}</tippy>
                            </div>
                        </div>
                    </template>

                </Datatable>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, ref, computed } from 'vue';
import { useForm, usePage, Link, router, Head } from '@inertiajs/vue3';
import { wTrans, trans } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
import Svg from '@/Components/Svg.vue';
import Datatable from '@/Components/Datatable.vue';
import CustomMultiSelect from '@/Components/Inputs/CustomMultiSelect.vue';
import { initializeFilters, updateFilters } from '@/Plugins/FiltersPlugin';
import FormModal from './Partials/FormModal.vue';

const props = defineProps({
    hashtags: Object,
    filter: Object,
});

const $helpers = inject('helpers');
const Languages = usePage().props.languages;
const selectLanguage = ref(Languages[0]);

const showModal = ref(false);

// Filters
const filters = initializeFilters({
    search: "",
    number_rows: 10,
    sort_by: "id",
    sort_direction: "desc",
});

const apply_filter = () => {
    updateFilters(filters);
};

// Columns definition
const columns = [
    { field: "id", title: wTrans('common.id'), sort: true },
    { field: "name", title: wTrans('common.name'), sort: true },
    { field: "is_active", title: wTrans('common.status'), sort: true },
    { field: "usage_count", title: wTrans('common.usage'), sort: false },
    { field: "updated_at", title: wTrans('common.updated_at'), sort: true },
    { field: "actions", title: wTrans('common.actions'), sort: false },
];

// Form initialization
const form = useForm({
    id: null,
    name: {
        en: '',
        ckb: '',
        ar: ''
    },
    is_active: true,
});

// Toggle modal
const toggleModal = (hashtag = null) => {
    if (hashtag) {
        form.id = hashtag.id;
        form.name = hashtag.name || { en: '', ckb: '', ar: '' };
        form.is_active = hashtag.is_active;
    } else {
        form.reset();
        form.clearErrors();
    }
    showModal.value = !showModal.value;
};

// Save hashtag
const save = () => {
    if (form.id) {
        form.post(route('control.pages.hashtags.update', form.id), {
            preserveScroll: true,
            onSuccess: () => {
                showModal.value = false;
                form.reset();
            }
        });
    } else {
        form.post(route('control.pages.hashtags.store'), {
            preserveScroll: true,
            onSuccess: () => {
                showModal.value = false;
                form.reset();
            }
        });
    }
};

// Delete hashtag
const callDelete = (id) => {
    Swal.fire({
        title: trans('common.are_you_sure'),
        text: trans('common.you_wont_be_able_to_revert_this'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: trans('common.yes_delete_it'),
        cancelButtonText: trans('common.cancel')
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('control.pages.hashtags.destroy', id), {
                preserveScroll: true,
            });
        }
    });
};

// Restore hashtag
const callRestore = (hashtag) => {
    Swal.fire({
        title: trans('common.are_you_sure'),
        text: trans('common.restore_confirmation'),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: trans('common.yes_restore_it'),
        cancelButtonText: trans('common.cancel')
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route('control.pages.hashtags.restore', hashtag.id), {}, {
                preserveScroll: true,
            });
        }
    });
};

// Force delete hashtag
const callForceDelete = (hashtag) => {
    Swal.fire({
        title: trans('common.are_you_sure'),
        text: trans('common.permanent_delete_warning'),
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: trans('common.yes_delete_permanently'),
        cancelButtonText: trans('common.cancel')
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('control.pages.hashtags.force_delete', hashtag.id), {
                preserveScroll: true,
            });
        }
    });
};
</script>
