<template>
    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li class="text-gray-500">
                    <span>{{ $t('pages.pages') }}</span>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <span>{{ $t('nav.gallery') }}</span>
                </li>
            </ul>

            <div class="flex items-center gap-3">
                <button v-if="$can('create_gallery')" type="button"
                    class="btn btn-sm btn-primary shadow-none flex items-center gap-1" @click="toggleModal()">
                    <Svg name="new" class="size-4"></Svg>
                    <span>{{ $t('common.new') }} {{ $t('nav.gallery') }}</span>
                </button>
            </div>
        </div>

        <FormModal :showModal="showModal" :form="form" :categories="props.categories" :branches="props.branches"
            :imagesForm="imagesForm" @submit="save" @close="toggleModal" />

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
                        <!-- (hashtags removed for Gallery) -->
                        <!-- Date Range Filter -->
                        <CustomDatePicker v-model="dateRangeModel" filter-key="created_at" parent-key="system"
                            placeholder="select_created_at_range" @apply-filter="handleApplyFilter"
                            @clear-filter="handleClearFilter" />
                    </div>
                </perfect-scrollbar>

                <Datatable :rows="props.gallery" :columns="columns" :totalRows="props.gallery.data?.length"
                    @change="apply_filter" v-model:search="filters.search" v-model:numberRows="filters.number_rows"
                    :filter="props.filter" v-model:sortBy="filters.sort_by"
                    v-model:sortDirection="filters.sort_direction">

                    <template #datatable-actions>
                        <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                            :showValue="false" parent-key="system" placeholder="languages" :require-selection="true" />
                    </template>

                    <template #title="data">
                        <div class="b-text-sm font-bold">{{ $helpers.getTranslation(data.value.title || {},
                            selectLanguage.slug) }}
                        </div>
                    </template>

                    <template #branch="data">
                        <span v-if="data.value.branch_name" class="badge bg-success">{{
                            $helpers.getTranslation(data.value.branch_name.name || {}, selectLanguage.slug) }}</span>
                        <span v-else class="text-gray-400">-</span>
                    </template>

                    <template #description="data">
                        <div class="b-text-sm text-gray-600">
                            {{ $helpers.excerpt($helpers.getTranslation(data.value.description || {},
                            selectLanguage.slug)) }}
                        </div>
                    </template>

                    <template #category="data">
                        <span v-if="data.value.category" class="badge bg-primary">{{
                            $helpers.getTranslation(data.value.category.name || {}, selectLanguage.slug) }}</span>
                        <span v-else class="text-gray-400">-</span>
                    </template>

                    <template #image="data">
                        <button type="button" @click="showImage(data.value.images, 0)"
                            v-if="data.value.images?.length > 0" class="flex items-center gap-2 text-center">
                            <img :src="data.value.images[0]?.thumb || data.value.images[0]?.url"
                                class="size-10 rounded-md max-w-none" alt="gallery-image" />
                            <span v-if="data.value.images.length > 1"
                                class="badge bg-secondary text-xs rounded-md size-10 flex items-center justify-center">
                                +{{ data.value.images.length - 1 }}
                            </span>
                        </button>
                        <span v-else class="text-gray-400">{{ $t('pages.no_images') }}</span>
                    </template>

                    <template #status="data">
                        <span v-if="data.value.is_active" class="badge bg-success">
                            {{ $t('common.active') }}
                        </span>
                        <span v-else class="badge bg-danger">
                            {{ $t('common.inactive') }}
                        </span>
                    </template>

                    <template #created_at="data">
                        <span v-tippy dir="ltr" class="b-text-sm font-bold ltr">
                            {{ data.value.created_at ? $helpers.formatCustomDate(data.value.created_at) : '' }}
                        </span>
                        <tippy>{{ $helpers.formatCustomDate(data.value.created_at, true) }}</tippy>
                    </template>

                    <template v-if="$can('edit_gallery') || $can('delete_gallery') || $can('restore_gallery')"
                        #actions="data">

                        <!-- Active Record Actions -->
                        <div v-if="data.value.deleted_at == null" class="flex items-center justify-end gap-2">
                            <div v-if="$can('edit_gallery')" class="text-center">
                                <button type="button" v-tippy @click="toggleModal(data.value)">
                                    <Svg name="pencil" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t("common.edit") }}</tippy>
                            </div>

                            <div v-if="$can('delete_gallery')" class="text-center">
                                <button type="button" v-tippy @click="callDelete(data.value.id)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t("common.delete") }}</tippy>
                            </div>
                        </div>

                        <!-- Deleted Record Actions -->
                        <div v-else class="flex gap-2">
                            <div v-if="$can('delete_gallery')" class="text-center">
                                <button type="button" v-tippy @click="callForceDelete(data.value)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('common.delete') }}</tippy>
                            </div>
                            <div v-if="$can('restore_gallery')" class="text-center">
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
                    @hide="index = null; visible = false"></vue-easy-lightbox>
            </div>
        </div>

        <input ref="fileInput" type="file" name="images[]" multiple accept="image/*" class="hidden"
            @change="handleFiles" />
    </div>
</template>

<script setup>
import { inject, ref, reactive, computed, watch } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import Svg from '@/Components/Svg.vue';
import Datatable from '@/Components/Datatable.vue';
import CustomMultiSelect from '@/Components/Inputs/CustomMultiSelect.vue';
import CustomDatePicker from '@/Components/Inputs/CustomDatePicker.vue';
import VueEasyLightbox from 'vue-easy-lightbox';
import { wTrans, trans } from 'laravel-vue-i18n';
import FormModal from './Partials/FormModal.vue';
import { initializeFilters, updateFilters } from '@/Plugins/FiltersPlugin';
import { useDateFilters } from '@/composables/useDateFilters.js';

// receive gallery paginated data from controller
const props = defineProps({ gallery: Object, categories: Array, branches: Array, filter: Object });

const $helpers = inject('helpers');
const authUser = usePage().props.auth.user;

// Lightbox state
const items = ref([]);
const index = ref(null);
const visible = ref(false);

const showImage = (images, startIndex = 0) => {
    if (!images) return;
    if (Array.isArray(images)) {
        items.value = images.map(img => ({ src: img.url || img }));
    } else {
        items.value = [{ src: images }];
    }
    index.value = startIndex;
    visible.value = true;
};

// Filters (use same pattern as News)
const filters = initializeFilters({
    search: "",
    number_rows: 10,
    sort_by: "id",
    sort_direction: "desc",
    start_date: (props.filter && props.filter.start_date) || '',
    end_date: (props.filter && props.filter.end_date) || '',
    branch_id: (props.filter && props.filter.branch_id) || '',
    category_id: (props.filter && props.filter.category_id) || '',
});

const apply_filter = () => {
    updateFilters({
        ...filters,
        start_date: filters.start_date,
        end_date: filters.end_date,
        branch_id: filters.branch_id,
        category_id: filters.category_id,
    });
};

const { dateRangeModel, handleApplyFilter, handleClearFilter } = useDateFilters(filters, apply_filter);

// Datatable columns (add title and category similar to News)
const columns = ref([
    { field: 'id', title: 'ID', width: '40px', type: 'number' },
    { field: 'title', title: wTrans('pages.title'), sort: true },
    { field: 'description', title: wTrans('pages.content'), hide: true },
    { field: 'branch', title: wTrans('pages.branch'), sort: true },
    { field: 'category', title: wTrans('pages.category'), sort: true },
    { field: 'image', title: wTrans('pages.images'), sort: false },
    { field: 'status', title: wTrans('common.status'), sort: true },
    { field: 'created_at', title: wTrans('common.created_at'), type: 'date' },
    { field: 'actions', title: wTrans('common.actions'), width: '80px', sort: false },
]);

// excerpt helper moved to global helpers

// Upload form (includes multilingual title/description, category)
const page = usePage();
const Languages = page.props.languages || [];

const showModal = ref(false);
const selectLanguage = ref(Languages[0]);

const createEmptyForm = () => ({
    user_id: authUser.id,
    title: Languages.reduce((acc, l) => (acc[l.slug] = '', acc), {}),
    description: Languages.reduce((acc, l) => (acc[l.slug] = '', acc), {}),
    branch_id: '',
    category_id: '',
    order: 0,
    images: [],
    is_active: true,
    deleted_image_ids: [],
});

const form = useForm(createEmptyForm());

const fileInput = ref(null);
// triggerFile kept for compatibility but opens modal like News
const triggerFile = () => toggleModal();

const imagesForm = ref({ images: [] });

const save = () => {
    const isUpdate = !!form.id;
    if (isUpdate) {
        form.post(route('control.pages.gallery.update', { gallery: form.id }), { forceFormData: true, onSuccess: () => { toggleModal(); $helpers.toast(trans('common.record') + ' ' + trans('common.updated')); } });
    } else {
        form.post(route('control.pages.gallery.store'), { forceFormData: true, onSuccess: () => {
            // clear parent form and images before closing modal
            Object.assign(form, createEmptyForm());
            imagesForm.value = { images: [] };
            if (fileInput.value) fileInput.value.value = null;
            toggleModal();
            $helpers.toast(trans('common.record') + ' ' + trans('common.created'));
        } });
    }
};

const toggleModal = (row = null) => {
    showModal.value = !showModal.value;
    if (row) {
        // populate form for edit if row provided
        form.id = row.id || '';
        form.title = row.title || {};
        form.description = row.description || {};
        form.user_id = row.user_id || authUser.id;
        form.branch_id = row.branch_name?.id || '';
        form.category_id = row.category?.id || '';
        form.order = row.order || 0;
        form.images = [];
        form.deleted_image_ids = [];
        imagesForm.value = { images: row.images || [] };
    } else if (showModal.value) {
        // opening modal for create
        Object.assign(form, createEmptyForm());
        imagesForm.value = { images: [] };
    }
};

const handleFiles = (e) => {
    const files = e.target.files;
    if (!files || files.length === 0) return;

    form.clearErrors();
    form.images = [];
    for (let i = 0; i < files.length; i++) {
        form.images.push(files[i]);
    }

    // submit with metadata
    form.post(route('control.pages.gallery.store'), {
        forceFormData: true,
        onSuccess: (page) => {
            $helpers.toast(trans('common.record') + ' ' + trans('common.created'));
            // reset modal and input
            showModal.value = false;
            Object.assign(form, createEmptyForm());
            if (fileInput.value) fileInput.value.value = null;
        },
    });
};

const categoryList = computed(() => {
    return (props.categories || []).map(c => ({ id: c.id, label: $helpers.getTranslation(c.name, selectLanguage.value.slug) }));
});

// Filter select lists
const branchFilterList = computed(() => {
    return (props.branches || []).map(branch => ({ id: branch.id, label: $helpers.getTranslation(branch.name, selectLanguage.value.slug) }));
});

const categoryFilterList = computed(() => {
    return (props.categories || []).map(cat => ({ id: cat.id, label: $helpers.getTranslation(cat.name, selectLanguage.value.slug) }));
});

const selectedBranchFilter = ref(null);
const selectedCategoryFilter = ref(null);

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

const applyBranchFilter = (value) => {
    filters.branch_id = value?.id || '';
    apply_filter();
};

const applyCategoryFilter = (value) => {
    filters.category_id = value?.id || '';
    apply_filter();
};

// Delete with confirmation
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
            form.delete(route('control.pages.gallery.destroy', id), {
                onSuccess: () => $helpers.toast(trans('common.record') + ' ' + trans('common.deleted')),
            });
        }
    });
};

// Force delete gallery with confirmation
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
            form.delete(route('control.pages.gallery.force_delete', row.id), {
                onSuccess: () => $helpers.toast(trans('common.record') + ' ' + trans('common.deleted')),
            });
        }
    });
};

// Restore gallery with confirmation
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
            form.post(route('control.pages.gallery.restore', row.id), {
                onSuccess: () => $helpers.toast(trans('common.record') + ' ' + trans('common.restored')),
            });
        }
    });
};

</script>
