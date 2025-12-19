<template>
    <div class="panel md:w-1/2">
        <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.phone_numbers') }}</h5>
        </div>

        <form @submit.prevent="SavePhoneNumber" class="flex items-start gap-3">
            <div class="flex-1">
                <input v-model="phoneForm.phone_number" type="text" class="form-input" placeholder="Phone Number" />
                <div class="mt-1 text-sm text-danger" v-if="phoneForm.errors['phone_number']"
                    v-html="phoneForm.errors['phone_number']">
                </div>
            </div>
            <button :disabled="phoneForm.processing" type="submit"
                class="btn btn-primary px-4 py-2 h-[38px] flex items-center justify-center">
                <Spinner v-if="phoneForm.processing" />
                <span v-else>{{ $t('common.save') }}</span>
            </button>
        </form>
        <div>
            <ul class="mt-4 space-y-2">
                <li v-if="phoneNumbersList.length > 0" v-for="(number, index) in phoneNumbersList" :key="index"
                    class="flex items-center justify-between p-2 border border-gray-200 dark:border-gray-700 rounded">
                    <span>{{ number.phone_number }}</span>
                 
                    <div class="text-center">
                        <button type="button" v-tippy @click="callDelete(number.id)">
                            <Svg name="trash" class="size-5"></Svg>
                        </button>
                        <tippy>{{ $t('common.delete') }}</tippy>
                    </div>
                </li>
                <li v-if="phoneNumbersList.length === 0">
                    <span class="text-gray-500">
                        {{ $t('system.no_phone_numbers_added') }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { inject, ref, watch, computed } from 'vue';
import { Head, Link, useForm, router, usePage } from '@inertiajs/vue3';
import Spinner from '@/Components/Spinner.vue';
import { trans } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
const props = defineProps({
    phone_numbers: {
        type: [Array],
        default: () => []
    }
});

const $helpers = inject('helpers');
const page = usePage();

// Handle both paginated (object with data) and non-paginated (array) responses
const phoneNumbersList = computed(() => {
    if (!props.phone_numbers) return [];
    if (Array.isArray(props.phone_numbers)) return props.phone_numbers;
    if (props.phone_numbers.data) return props.phone_numbers.data;
    return [];
});

const phoneForm = useForm({
    phone_number: '',
    user_id: page.props.auth.user.id
});

const SavePhoneNumber = () => {
    phoneForm.transform((data) => ({
        ...data,
    })).post(route('control.system.settings.social-links.store'), {
        preserveScroll: true,
        preserveState: true,
        onError: (errors) => {
            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.phone_numbers') }), 'error');
        },
        onSuccess: () => {
            phoneForm.reset();
            $helpers.toast(trans('system.section_updated'), 'success');
        }
    });
}


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
            phoneForm.delete(route('control.system.settings.social-links.destroy', id), {
                onSuccess: () => {
                    // Swal.fire({ title: trans('common.deleted'), text: trans('common.record') + ' ' + trans('common.deleted'), icon: 'success', customClass: 'sweet-alerts' });
                    $helpers.toast(trans('common.record') + ' ' + trans('common.deleted'));
                },
            });

        }
    });
};

</script>
