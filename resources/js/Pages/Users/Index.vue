<template>

    <Head>
        <title>{{ $t('system.users') }}</title>
    </Head>

    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li class="text-gray-500">
                    <span>{{ $t('system.system') }}</span>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <span>{{ $t('system.users') }}</span>
                </li>
            </ul>
            <div class="flex items-center gap-2">

                <Link v-if="$can('create_users')" :href="route('control.system.users.create')" type="button"
                    class="btn btn-primary btn-sm shadow-none flex items-center gap-1">
                <Svg name="new" class="size-4"></Svg>
                <span>{{ $t('common.new') }} {{ $t('system.user') }}</span>
                </Link>

            </div>
        </div>
        <div class="pt-5">
            <div class="panel pb-0">
                <div v-if="0" class="flex items-center flex-wrap gap-x-0 lg:gap-x-1.5 gap-y-1.5 mb-1.5 -mt-1.5">

                    <!-- Owner -->
                    <!-- <div class="mb-1.5">
                        <CustomMultiSelect v-model="form.user" :list="owners" :label="$t('system.owner')"
                            :multiple="true" />
                    </div> -->

                    <!-- Customer -->
                    <!-- <div class="mb-1.5">
                        <CustomMultiSelect v-model="form.customer" :list="customers" :label="$t('system.customer')"
                            :multiple="true" />
                    </div> -->

                    <!-- Created Date -->
                    <!-- <div class="mb-1.5">
                        <Datepicker v-model="form.created_at" :label="$t('system.created_at')" />
                    </div> -->

                    <!-- Horizontal Buttons -->
                    <div class="flex items-center gap-5 md:ms-auto lg:ms-0">
                        <!-- <div class="hidden lg:block w-[3px] h-8 mb-1.5 mx-2 bg-gray-100 dark:bg-gray-800"></div> -->

                        <div class="relative inline-flex mb-1.5 mx-2 md:mx-0 whitespace-nowrap">
                            <button type="button" @click="groupFilter = 'all'"
                                :class="{ 'bg-primary hover:bg-primary/95 text-white': groupFilter === 'all' }"
                                class="btn btn-sm hover:bg-gray-100 shadow-none dark:hover:bg-gray-700 rounded-e-none border border-e-0 border-gray-200 dark:border-gray-700">
                                {{ $t('system.all') + ' ' + $t('system.users') }}
                            </button>
                            <button type="button" @click="groupFilter = 'my'"
                                :class="{ 'bg-primary hover:bg-primary/95 text-white': groupFilter === 'my' }"
                                class="btn btn-sm hover:bg-gray-100 shadow-none dark:hover:bg-gray-700 rounded-s-none border border-gray-200 dark:border-gray-700">
                                <span class="ltr:hidden">{{ $t('system.users') + $t('system.my') }}</span>
                                <span class="rtl:hidden">{{ $t('system.my') + ' ' + $t('system.users') }}</span>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Datatable -->
                <Datatable :rows="users" :columns="columns" :totalRows="users.data?.length" @change="apply_filter"
                    v-model:search="filters.search" v-model:numberRows="filters.number_rows" :filter="props.filter"
                    v-model:sortBy="filters.sort_by" v-model:sortDirection="filters.sort_direction">

                    <template #user="data">
                        <div class="flex items-center gap-2">
                            <img :src="data.value.avatar ? data.value.avatar : `/assets/images/avatar.png`"
                                class="w-9 h-9 rounded-full max-w-none" alt="user-profile" />
                            <div class="flex flex-col">
                                <div class="font-semibold">{{ data.value.name }}</div>
                                <div class="font-semibold text-xs text-gray-400">{{ data.value.email }}</div>
                            </div>
                        </div>
                    </template>

                    <template #is_active="data">
                        <span class="capitalize" :class="data.value.is_active ? 'text-success' : 'text-danger'">
                            {{ data.value.is_active ? $t('system.yes') : $t('system.no') }}
                        </span>
                    </template>

                    <template #roles="data">
                        <div class="flex flex-col">
                            <div v-for="(role, index) in data.value.roles" :key="index" class="flex items-center gap-1">
                                <div class="size-1.5 bg-green-500 rounded-full"></div>
                                <div class="font-semibold capitalize">{{ role.name }}</div>
                            </div>
                        </div>
                    </template>

                    <template #actions="data">
                        <div class="flex gap-2">
                            <!-- <div class="text-center">
                                <Link :href="route('control.dashboard.system.user-details', data.value.id)" type="button"
                                    v-tippy>
                                <Svg name="eye" class="size-5"></Svg>
                                </Link>
                                <tippy>{{ $t('system.view') }}</tippy>
                            </div> -->
                            <div class="text-center">
                                <Link v-if="$can('edit_users')"
                                    :href="route('control.system.users.edit', data.value.id)" v-tippy>
                                <Svg name="pencil" class="size-5"></Svg>
                                </Link>
                                <tippy>{{ $t('system.update') }}</tippy>
                            </div>
                            <div v-if="$can('delete_users')" class="text-center">
                                <button type="button" v-tippy @click="callDelete(data.value.id)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('system.delete') }}</tippy>
                            </div>
                        </div>
                    </template>

                </Datatable>

            </div>
        </div>
    </div>
</template>
<script setup>
import { inject, reactive, ref } from 'vue';
import { useForm, Link, Head, router } from '@inertiajs/vue3';
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';
import Svg from '@/Components/Svg.vue';
import { wTrans } from 'laravel-vue-i18n';
import { trans } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
import PhoneSelect from '@/Components/Inputs/PhoneSelect.vue';
import Datatable from '@/Components/Datatable.vue';
import { initializeFilters, useFilters, updateFilters, resetFilters, doesFilterApplied } from '@/Plugins/FiltersPlugin';

const rtlClass = inject('rtlClass');
const $helpers = inject('helpers');

const groupFilter = ref('all');

const props = defineProps([
    'users',
    'filter',
]);

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

const columns =
    ref([
        {
            field: 'id',
            title: wTrans('common.id'),
            isUnique: true,
            width: '25px',
            type: 'number',
        },
        {
            field: 'user',
            title: wTrans('system.user')
        },
        {
            field: 'phone',
            title: wTrans('system.phone')
        },
        {
            field: 'roles',
            title: wTrans('system.roles')
        },
        {
            field: 'is_active',
            title: wTrans('system.is_active')
        },
        {
            field: 'actions',
            title: wTrans('common.actions'),
            sort: false
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
            router.delete(route('control.system.users.destroy', { user: id }), {
                onSuccess: () => {
                    $helpers.toast(trans('common.record') + ' ' + trans('common.deleted'));
                },
            });
        }
    });
};


</script>