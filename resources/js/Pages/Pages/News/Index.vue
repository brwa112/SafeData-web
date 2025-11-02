<template>
    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li class="text-gray-500">
                    <span>{{ $t('pages.pages') }}</span>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <span>{{ $t('pages.news') }}</span>
                </li>
            </ul>
            <div class="flex items-center gap-3">
                <!-- Categories Button -->
                <Link :href="route('control.pages.news-categories.index')"
                    class="btn btn-sm btn-secondary shadow-none flex items-center gap-1">
                    <Svg name="box" class="size-4"></Svg>
                    <span>{{ $t('pages.category') }}</span>
                </Link>

                <!-- Add New Button -->
                <button v-if="$can('create_news')" type="button"
                    class="btn btn-sm btn-primary shadow-none flex items-center gap-1" @click="toggleModal()">
                    <Svg name="new" class="size-4"></Svg>
                    <span>{{ $t('common.new') }} {{ $t('pages.news') }}</span>
                </button>
            </div>
        </div>

        <!-- Modal -->
        <FormModal :showModal="showModal" :form="form" :branches="branches" :categories="categories"
            :hashtags="hashtags" :imagesForm="imagesForm" @submit="save" @close="toggleModal" />

        <!-- Datatable Section -->
        <div class="pt-5">
            <div class="panel pb-0">

                <!-- Filters -->
                <perfect-scrollbar class="relative max-w-max">
                    <div class="flex items-center gap-2 w-full mb-2 whitespace-nowrap">
                        <!-- Branch Filter -->
                        <CustomMultiSelect v-model="selectedBranchFilter" :list="branchFilterList" label="label"
                            placeholder="branch" placeholder-parent-key="pages"
                            @update:modelValue="applyBranchFilter" />
                        <!-- Category Filter -->
                        <CustomMultiSelect v-model="selectedCategoryFilter" :list="categoryFilterList" label="label"
                            placeholder="category" placeholder-parent-key="pages"
                            @update:modelValue="applyCategoryFilter" />
                        <!-- Hashtag Filter -->
                        <CustomMultiSelect v-model="selectedHashtagFilter" :list="hashtagFilterList" :multiple="true"
                            label="label" placeholder="hashtag" parent-key="pages"
                            @update:modelValue="applyHashtagFilter" />
                        <!-- Date Range Filter -->
                        <CustomDatePicker v-model="dateRangeModel" filter-key="created_at" parent-key="system"
                            placeholder="select_created_at_range" @apply-filter="handleApplyFilter"
                            @clear-filter="handleClearFilter" />
                    </div>
                </perfect-scrollbar>

                <!-- Datatable -->
                <Datatable :rows="news" :columns="columns" :totalRows="news.data?.length" @change="apply_filter"
                    v-model:search="filters.search" v-model:numberRows="filters.number_rows" :filter="props.filter"
                    v-model:sortBy="filters.sort_by" v-model:sortDirection="filters.sort_direction">

                    <template #datatable-actions>
                        <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                            :showValue="false" parent-key="system" placeholder="languages" :require-selection="true" />
                    </template>

                    <template #title="data">
                        <div class="b-text-sm font-bold">
                            {{ $helpers.getTranslation(data.value.title, selectLanguage.slug) }}
                        </div>
                    </template>

                    <template #category="data">
                        <span v-if="data.value.category_name" class="badge bg-primary">
                            {{ $helpers.getTranslation(data.value.category_name?.name, selectLanguage.slug) }}
                        </span>
                    </template>

                    <template #branch="data">
                        <span v-if="data.value.branch_name" class="badge bg-success">
                            {{ $helpers.getTranslation(data.value.branch_name?.name, selectLanguage.slug) }}
                        </span>
                    </template>

                    <template #content="data">
                        <div class="b-text-sm text-gray-600">
                            {{ $helpers.excerpt($helpers.getTranslation(data.value.content || {}, selectLanguage.slug)) }}
                        </div>
                    </template>

                    <template #hashtags="data">
                        <div class="flex gap-1">
                            <span v-for="hashtag in data.value.hashtag_names" :key="hashtag.id"
                                class="badge bg-info text-xs">
                                #{{ $helpers.getTranslation(hashtag?.name, selectLanguage.slug) }}
                            </span>
                        </div>
                    </template>

                    <template #images="data">
                        <button type="button" @click="showImage(data.value.images, 0)"
                            v-if="data.value.images?.length > 0" class="flex items-center gap-2 text-center">
                            <img :src="data.value.images[0]?.thumb || data.value.images[0]?.url"
                                class="size-10 rounded-md max-w-none" alt="news-image" />
                            <span v-if="data.value.images.length > 1"
                                class="badge bg-secondary text-xs rounded-md size-10 flex items-center justify-center">
                                +{{ data.value.images.length - 1 }}
                            </span>
                        </button>
                        <span v-else class="text-gray-400">{{ $t('pages.no_images') }}</span>
                    </template>

                    <template #views="data">
                        <div class="flex items-center gap-1.5">
                            <Svg name="eye" class="size-4 opacity-70"></Svg>
                            <span class="b-text-sm font-semibold">{{ data.value.views || 0 }}</span>
                        </div>
                    </template>

                    <template #status="data">
                        <span v-if="data.value.is_active" class="badge bg-success">
                            {{ $t('common.active') }}
                        </span>
                        <span v-else class="badge bg-danger">
                            {{ $t('common.inactive') }}
                        </span>
                    </template>

                    <template #updated_at="data">
                        <span v-tippy dir="ltr" class="b-text-sm font-bold ltr">
                            {{ data.value.updated_at ? $helpers.formatCustomDate(data.value.updated_at) : '' }}
                        </span>
                        <tippy>{{ $helpers.formatCustomDate(data.value.updated_at, true) }}</tippy>
                    </template>

                    <template #created_at="data">
                        <span v-tippy dir="ltr" class="b-text-sm font-bold ltr">
                            {{ data.value.created_at ? $helpers.formatCustomDate(data.value.created_at) : '' }}
                        </span>
                        <tippy>{{ $helpers.formatCustomDate(data.value.created_at, true) }}</tippy>
                    </template>

                    <template v-if="$can('edit_news') || $can('delete_news') || $can('restore_news')" #actions="data">

                        <!-- Active Record Actions -->
                        <div v-if="data.value.deleted_at == null" class="flex items-center justify-end gap-2">
                            <div v-if="data.value.branch_name?.slug" class="text-center">
                                <button type="button" v-tippy @click="viewNews(data.value)">
                                    <Svg name="eye" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t("common.view") }}</tippy>
                            </div>

                            <div v-if="$can('edit_news')" class="text-center">
                                <button type="button" v-tippy @click="toggleModal(data.value)">
                                    <Svg name="pencil" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t("common.edit") }}</tippy>
                            </div>

                            <div v-if="$can('delete_news')" class="text-center">
                                <button type="button" v-tippy @click="callDelete(data.value.id)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t("common.delete") }}</tippy>
                            </div>
                        </div>

                        <!-- Deleted Record Actions -->
                        <div v-else class="flex gap-2">
                            <div v-if="$can('delete_news')" class="text-center">
                                <button type="button" v-tippy @click="callForceDelete(data.value)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('common.delete') }}</tippy>
                            </div>
                            <div v-if="$can('restore_news')" class="text-center">
                                <button type="button" v-tippy @click="callRestore(data.value)">
                                    <Svg name="restore" class="size-5 opacity-65"></Svg>
                                </button>
                                <tippy>{{ $t('common.restore') }}</tippy>
                            </div>
                        </div>
                    </template>

                </Datatable>

                <!-- Image Lightbox -->
                <vue-easy-lightbox :visible="visible" :imgs="items" :index="index" scrollDisabled moveDisabled loop
                    @hide="index = null; visible = false">
                </vue-easy-lightbox>

            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, ref, watch, computed } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import { wTrans, trans } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
import Svg from '@/Components/Svg.vue';
import Datatable from '@/Components/Datatable.vue';
import { initializeFilters, updateFilters } from '@/Plugins/FiltersPlugin';
import VueEasyLightbox from 'vue-easy-lightbox';
import CustomMultiSelect from '@/Components/Inputs/CustomMultiSelect.vue';
import CustomDatePicker from '@/Components/Inputs/CustomDatePicker.vue';
import { useDateFilters } from '@/composables/useDateFilters.js';
import FormModal from './Partials/FormModal.vue';

const props = defineProps({
    news: Object,
    branches: Array,
    categories: Array,
    hashtags: Array,
    filter: Object,
});

const $helpers = inject('helpers');
const authUser = usePage().props.auth.user;
const Languages = usePage().props.languages;
const selectLanguage = ref(Languages[0]);

// Lightbox state
const items = ref([]);
const index = ref(null);
const visible = ref(false);
const showModal = ref(false);

// Show image in lightbox
const showImage = (images, startIndex = 0) => {
    if (Array.isArray(images)) {
        // If images array is passed, show all images
        items.value = images.map(img => ({ src: img.url || img }));
    } else {
        // If single image URL is passed, show only that image
        items.value = [{ src: images }];
    }
    index.value = startIndex;
    visible.value = true;
};

// Filters
const filters = initializeFilters({
    search: "",
    number_rows: 10,
    sort_by: "id",
    sort_direction: "desc",
    start_date: props.filter.start_date || '',
    end_date: props.filter.end_date || '',
    branch_id: props.filter.branch_id || '',
    category_id: props.filter.category_id || '',
    hashtag_ids: props.filter.hashtag_ids || '',
});

const apply_filter = () => {
    updateFilters({
        ...filters,
        start_date: filters.start_date,
        end_date: filters.end_date,
        branch_id: filters.branch_id,
        category_id: filters.category_id,
        hashtag_ids: filters.hashtag_ids,
    });
};

const { dateRangeModel, handleApplyFilter, handleClearFilter } = useDateFilters(filters, apply_filter);

// Filter lists with translations
const branchFilterList = computed(() => {
    return [
        ...props.branches.map(branch => ({
            id: branch.id,
            label: $helpers.getTranslation(branch.name, selectLanguage.value.slug)
        }))
    ];
});

const categoryFilterList = computed(() => {
    return [
        ...props.categories.map(cat => ({
            id: cat.id,
            label: $helpers.getTranslation(cat.name, selectLanguage.value.slug)
        }))
    ];
});

const hashtagFilterList = computed(() => {
    return props.hashtags.map(tag => ({
        id: tag.id,
        label: '#' + $helpers.getTranslation(tag.name, selectLanguage.value.slug)
    }));
});

// Selected filter values
const selectedBranchFilter = ref(null);
const selectedCategoryFilter = ref(null);
const selectedHashtagFilter = ref([]);

// Initialize filter values from URL params using watchers
watch(branchFilterList, (newList) => {
    if (filters.branch_id && !selectedBranchFilter.value) {
        selectedBranchFilter.value = newList.find(b => b.id == filters.branch_id) || null;
    }
}, { immediate: true });

watch(categoryFilterList, (newList) => {
    if (filters.category_id && !selectedCategoryFilter.value) {
        selectedCategoryFilter.value = newList.find(c => c.id == filters.category_id) || null;
    }
}, { immediate: true });

watch(hashtagFilterList, (newList) => {
    if (filters.hashtag_ids && selectedHashtagFilter.value.length === 0) {
        const hashtagIds = filters.hashtag_ids.split(',').map(id => parseInt(id));
        selectedHashtagFilter.value = newList.filter(h => hashtagIds.includes(h.id));
    }
}, { immediate: true });

// Apply filter functions
const applyBranchFilter = (value) => {
    filters.branch_id = value?.id || '';
    apply_filter();
};

const applyCategoryFilter = (value) => {
    filters.category_id = value?.id || '';
    apply_filter();
};

const applyHashtagFilter = (values) => {
    filters.hashtag_ids = Array.isArray(values) && values.length > 0
        ? values.map(v => v.id).join(',')
        : '';
    apply_filter();
};

// Helper to create empty form data
const createEmptyFormData = () => ({
    id: '',
    slug: '',
    user_id: authUser.id,
    title: {},
    content: {},
    branch_id: '',
    category_id: '',
    hashtag_ids: [],
    order: 0,
    is_active: true,
    images: [],
    remove_images: false,
    deleted_image_ids: [],
});

// Form state
let form = useForm(createEmptyFormData());
const imagesForm = ref({});

// Save news (create or update)
const save = () => {
    // Determine route and action
    const isUpdate = !!form.id;
    const successMessage = trans('common.record') + ' ' + trans(isUpdate ? 'common.updated' : 'common.created');

    // For updates with file uploads, we need to use POST with _method field
    if (isUpdate) {
        console.log('Updating news with ID:', form.category_id);
        form.post(route('control.pages.news.update', { news: form.id }), {
            forceFormData: true,
            onSuccess: () => {
                toggleModal();
                $helpers.toast(successMessage);
            },
        });
    } else {
        form.post(route('control.pages.news.store'), {
            forceFormData: true,
            onSuccess: () => {
                toggleModal();
                $helpers.toast(successMessage);
            },
        });
    }
};

// Toggle modal (open/close with optional row data for editing)
const toggleModal = (row = null) => {
    showModal.value = !showModal.value;

    if (row) {
        // Populate form with existing data for editing
        form.id = row.id;
        form.slug = row.slug;
        form.user_id = row.user_id || authUser.id;
        form.title = row.title || {};
        form.content = row.content || {};
        form.branch_id = row.branch?.id || '';
        form.category_id = row.category?.id || '';
        form.hashtag_ids = row.hashtag_ids || [];
        form.order = row.order || 0;
        form.is_active = row.is_active !== undefined ? row.is_active : true;
        form.images = [];
        form.remove_images = false;
        form.deleted_image_ids = [];

        imagesForm.value = {
            images: row.images || [],
        };
    } else if (!showModal.value) {
        // Reset form when closing modal
        Object.assign(form, createEmptyFormData());
        form.clearErrors();

        imagesForm.value = {
            images: [],
        };
    }
};

// Datatable columns configuration
const columns = ref([
    { field: 'id', title: 'ID', width: '25px', type: 'number' },
    { field: 'title', title: wTrans('pages.title') },
    { field: 'content', title: wTrans('pages.content'), hide: true },
    { field: 'branch', title: wTrans('pages.branch'), sort: true },
    { field: 'category', title: wTrans('pages.category'), sort: true },
    { field: 'hashtags', title: wTrans('pages.hashtag'), sort: true },
    { field: 'images', title: wTrans('pages.images'), sort: false },
    { field: 'views', title: wTrans('pages.views'), sort: true },
    { field: 'status', title: wTrans('common.status'), sort: true },
    { field: 'updated_at', title: wTrans('common.updated_at'), type: 'date', hide: true },
    { field: 'created_at', title: wTrans('common.created_at'), type: 'date' },
    { field: 'actions', title: wTrans('common.actions'), width: '50px', sort: false },
]);

// excerpt helper moved to global helpers

// View news on frontend
const viewNews = (row) => {
    if (row.branch_name?.slug) {
        const url = `/${row.branch_name.slug}/news/${row.id}`;
        window.open(url, '_blank');
    }
};

// Delete news with confirmation
const callDelete = (id) => {
    Swal.fire({
        icon: 'warning',
        title: trans('common.are_you_sure'),
        text: trans('common.delete_this'),
        showCancelButton: true,
        confirmButtonText: trans('common.confirm'),
        cancelButtonText: trans('common.cancel'),
        padding: '2em',
        customClass: 'sweet-alerts',
    }).then((result) => {
        if (result.value) {
            form.delete(route('control.pages.news.destroy', id), {
                onSuccess: () => $helpers.toast(trans('common.record') + ' ' + trans('common.deleted')),
            });
        }
    });
};

// Force delete news with confirmation
const callForceDelete = (row) => {
    Swal.fire({
        icon: 'warning',
        title: trans('common.are_you_sure'),
        text: trans('common.force_delete_this'),
        showCancelButton: true,
        confirmButtonText: trans('common.confirm'),
        cancelButtonText: trans('common.cancel'),
        padding: '2em',
        customClass: 'sweet-alerts',
    }).then((result) => {
        if (result.value) {
            form.delete(route('control.pages.news.force_delete', row.id), {
                onSuccess: () => $helpers.toast(trans('common.record') + ' ' + trans('common.deleted')),
            });
        }
    });
};

// Restore news with confirmation
const callRestore = (row) => {
    Swal.fire({
        icon: 'warning',
        title: trans('common.are_you_sure'),
        text: trans('common.restore_this'),
        showCancelButton: true,
        confirmButtonText: trans('common.confirm'),
        cancelButtonText: trans('common.cancel'),
        padding: '2em',
        customClass: 'sweet-alerts',
    }).then((result) => {
        if (result.value) {
            form.post(route('control.pages.news.restore', row.id), {
                onSuccess: () => $helpers.toast(trans('common.record') + ' ' + trans('common.restored')),
            });
        }
    });
};

</script>
