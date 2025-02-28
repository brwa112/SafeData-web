<template>

    <Head>
        <title>{{ $t('pages.product') }}</title>
    </Head>

    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li class="text-gray-500">
                    <span>{{ $t('pages.pages') }}</span>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <span>{{ $t('pages.products') }}</span>
                </li>
            </ul>
            <!-- add new row -->
            <div class="block">
                <!-- Trigger -->
                <div class="flex items-center justify-center">
                    <button v-if="$can('create_products')" type="button"
                        class="btn btn-sm btn-primary shadow-none flex items-center gap-1" @click="toggleModal()">
                        <Svg name="new" class="size-4"></Svg>
                        <span>{{ $t('common.new') }} {{ $t('pages.product') }}</span>
                    </button>
                </div>

                <!-- Create Modal -->
                <TransitionRoot appear :show="showModal" as="template">
                    <Dialog as="div" @close="toggleModal()" class="relative z-50">
                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                            leave-to="opacity-0">
                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                        </TransitionChild>

                        <div class="fixed inset-0 overflow-y-auto">
                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                <TransitionChild as="template" enter="duration-300 ease-out"
                                    enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                    leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                    leave-to="opacity-0 scale-95">
                                    <DialogPanel
                                        class="panel border-0 p-0 overflow-hidden rounded-lg w-full max-w-2xl text-black dark:text-white-dark">
                                        <button type="button"
                                            class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                            @click="toggleModal()">
                                            <Svg name="close" class="size-6"></Svg>
                                        </button>
                                        <div
                                            class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                            <span v-if="form.id">
                                                {{ $t('common.edit') }}
                                            </span>
                                            <span v-else>
                                                {{ $t('common.new') }}
                                            </span>
                                            {{ $t('pages.product') }}
                                        </div>
                                        <div class="p-5">
                                            <form @submit.prevent="save()" v-shortkey="['ctrl', 's']" @shortkey="save"
                                                class="space-y-5">
                                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-sm">
                                                    <div class="col-span-full">
                                                        <label for="name">
                                                            {{ $t('common.name') }}
                                                        </label>
                                                        <input id="name" type="text" v-model="form.name"
                                                            :placeholder="$t('common.name')" class="form-input"
                                                            :class="{ 'border border-red-300 rounded-md': form.errors.name }" />
                                                        <div class="mt-1 text-danger" v-if="form.errors.name"
                                                            v-html="form.errors.name">
                                                        </div>
                                                    </div>
                                                    <div class="col-span-full">
                                                        <label for="description">
                                                            {{ $t('common.description') }}
                                                        </label>
                                                        <textarea id="description" type="text"
                                                            v-model="form.description"
                                                            :placeholder="$t('common.description')" class="form-input"
                                                            rows="8"
                                                            :class="{ 'border border-red-300 rounded-md': form.errors.description }"></textarea>
                                                        <div class="mt-1 text-danger" v-if="form.errors.description"
                                                            v-html="form.errors.description">
                                                        </div>
                                                    </div>
                                                    <div class="col-span-full">
                                                        <label for="url">
                                                            {{ $t('pages.url') }}
                                                        </label>
                                                        <input id="url" type="text" v-model="form.url"
                                                            :placeholder="$t('pages.url')" class="form-input"
                                                            :class="{ 'border border-red-300 rounded-md': form.errors.url }" />
                                                        <div class="mt-1 text-danger" v-if="form.errors.url"
                                                            v-html="form.errors.url">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end items-center mt-5">
                                                    <button @click="toggleModal()" type="button"
                                                        class="btn btn-outline-danger">
                                                        {{ $t('common.discard') }}
                                                    </button>
                                                    <button :disabled="form.processing"
                                                        class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                        <Spinner v-if="form.processing" />
                                                        {{ $t('common.save') }}
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </DialogPanel>
                                </TransitionChild>
                            </div>
                        </div>
                    </Dialog>
                </TransitionRoot>
            </div>
        </div>
        <div class="pt-5">
            <div class="panel pb-0">

                <!-- Datatable -->
                <Datatable :rows="products" :columns="columns" :totalRows="products.data?.length" @change="apply_filter"
                    v-model:search="filters.search" v-model:numberRows="filters.number_rows" :filter="props.filter"
                    v-model:sortBy="filters.sort_by" v-model:sortDirection="filters.sort_direction">

                    <template #description="data">
                        <div class="truncate max-w-96">
                            {{ data.value.description }}
                        </div>
                    </template>

                    <template #url="data">
                        <a v-if="data.value.url" :href="data.value.url" class="text-primary hover:underline" target="_blank">
                            {{ $t('pages.view_link') }}
                        </a>
                    </template>

                    <template v-if="$can('edit_products') || $can('delete_products')" #actions="data">
                        <div class="flex gap-2">
                            <div v-if="$can('edit_products')" class="text-center">
                                <button type="button" v-tippy @click="toggleModal(data.value)">
                                    <Svg name="pencil" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('common.update') }}</tippy>
                            </div>
                            <div v-if="$can('delete_products')" class="text-center">
                                <button type="button" v-tippy @click="callDelete(data.value.id)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('common.delete') }}</tippy>
                            </div>
                        </div>
                    </template>

                </Datatable>

            </div>
        </div>
    </div>
</template>
<script setup>
import { inject, onMounted, ref, watch } from 'vue';
import { useForm, Head, usePage } from '@inertiajs/vue3';
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';
import { wTrans, trans } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
import Svg from '@/Components/Svg.vue';
import Spinner from '@/Components/Spinner.vue';
import Datatable from '@/Components/Datatable.vue';
import { initializeFilters, useFilters, updateFilters, resetFilters, doesFilterApplied } from '@/Plugins/FiltersPlugin';

const props = defineProps([
    'products',
    'filter',
]);

const rtlClass = inject('rtlClass');
const $helpers = inject('helpers');
const Languages = usePage().props.languages;
const language = ref(Languages[0]);

const filters = initializeFilters({
    search: '',
    number_rows: 10,
    sort_by: 'id',
    sort_direction: 'desc',
});

const apply_filter = () => {
    updateFilters({
        ...filters,
    });
};

let form = useForm({
    id: '',
    name: '',
    description: '',
    url: '',
});

const save = () => {

    if (form?.id) {
        form.put(route('control.pages.products.update', form), {
            onSuccess: () => {
                toggleModal();
                $helpers.toast(trans('common.record') + ' ' + trans('common.updated'));
            },
        });
        return;
    }

    form.post(route('control.pages.products.store'), {
        onSuccess: () => {
            toggleModal();
            $helpers.toast(trans('common.record') + ' ' + trans('common.created'));
        },
    });
}

const toggleModal = (row) => {

    if (row) {
        form = useForm({
            id: row.id,
            name: row.name,
            description: row.description,
            url: row.url,
        });
    }
    showModal.value = !showModal.value;

    if (!showModal.value) {
        form = useForm({
            name: '',
            description: '',
            url: '',
        });
    }
};

const showModal = ref(false);

const columns =
    ref([
        {
            field: 'id',
            title: 'ID',
            width: '25px',
            type: 'number',
        },
        {
            field: 'name',
            title: wTrans('common.name')
        },
        {
            field: 'description',
            title: wTrans('common.description')
        },
        {
            field: 'url',
            title: wTrans('pages.url')
        },
        {
            field: 'actions',
            title: wTrans('common.actions'),
            width: '50px'
        },
    ]) || [];

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
            form.delete(route('control.pages.products.destroy', id), {
                onSuccess: () => {
                    // Swal.fire({ title: trans('common.deleted'), text: trans('common.record') + ' ' + trans('common.deleted'), icon: 'success', customClass: 'sweet-alerts' });
                    $helpers.toast(trans('common.record') + ' ' + trans('common.deleted'));
                },
            });

        }
    });
};

</script>