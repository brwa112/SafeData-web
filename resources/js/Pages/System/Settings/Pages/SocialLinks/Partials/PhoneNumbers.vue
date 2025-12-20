<template>
    <div class="panel md:w-1/2">
        <div class="mb-3 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.phone_numbers') }}</h5>
        </div>

        <!-- Add/Edit Form -->
        <div class="mb-4">
            <form @submit.prevent="submitForm" class="flex items-start gap-3">
                <div class="flex-1">
                    <input v-model="phoneForm.phone_number" type="text" class="form-input"
                        :class="{ 'border-danger': phoneForm.errors.phone_number }"
                        :placeholder="$t('system.phone_number')" />
                    <div class="mt-1 text-sm text-danger" v-if="phoneForm.errors.phone_number">
                        {{ phoneForm.errors.phone_number }}
                    </div>
                </div>
                <button :disabled="phoneForm.processing" type="submit"
                    class="btn btn-sm h-[38px] flex items-center gap-1"
                    :class="isEditing ? 'btn-success' : 'btn-primary'">
                    <Spinner v-if="phoneForm.processing" class="size-4" />
                    <Svg v-else :name="isEditing ? 'check' : 'plus'" class="size-4"></Svg>
                    <span>{{ isEditing ? $t('common.edit') : $t('common.save') }}</span>
                </button>
                <button v-if="isEditing" type="button" @click="cancelEdit"
                    class="btn btn-dark btn-sm h-[38px] flex items-center justify-center" v-tippy="$t('common.cancel')">
                    <Svg name="close" class="size-4"></Svg>
                </button>
            </form>
        </div>

        <!-- Phone Numbers List -->
        <div>
            <ul class="space-y-3">
                <li v-for="(number, index) in phoneNumbersList" :key="number.id" class="flex items-center gap-3"
                    :class="{ 'opacity-50': phoneForm.id === number.id }">
                    <div class="btn btn-dark btn-sm font-bold h-[38px] w-[38px] flex items-center justify-center">
                        {{ index + 1 }}
                    </div>
                    <div class="flex-1 form-input bg-gray-50 dark:bg-gray-800">
                        {{ number.phone_number }}
                    </div>
                    <button type="button" @click="editPhoneNumber(number)"
                        class="btn btn-primary btn-sm h-[38px] w-[38px] flex items-center justify-center"
                        :disabled="phoneForm.processing" v-tippy="$t('common.edit')">
                        <Svg name="pencil" class="size-5"></Svg>
                    </button>
                    <button type="button" @click="callDelete(number.id)"
                        class="btn btn-danger btn-sm h-[38px] w-[38px] flex items-center justify-center"
                        :disabled="phoneForm.processing" v-tippy="$t('common.delete')">
                        <Svg name="trash" class="size-5"></Svg>
                    </button>
                </li>

                <li v-if="phoneNumbersList.length === 0" class="text-center py-8">
                    <span class="text-gray-500">
                        {{ $t('system.no_phone_numbers_added') }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { inject, computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
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
    id: null,
    phone_number: '',
    user_id: page.props.auth.user.id
});

// Check if we're in edit mode
const isEditing = computed(() => phoneForm.id !== null);

const editPhoneNumber = (number) => {
    phoneForm.id = number.id;
    phoneForm.phone_number = number.phone_number;
    phoneForm.clearErrors();
};

const cancelEdit = () => {
    phoneForm.id = null;
    phoneForm.phone_number = '';
    phoneForm.clearErrors();
};

const resetForm = () => {
    phoneForm.reset();
    phoneForm.clearErrors();
};

const submitForm = () => {
    if (isEditing.value) {
        // Update existing phone number
        phoneForm.put(route('control.system.settings.social-links.update-phone', phoneForm.id), {
            preserveScroll: true,
            onSuccess: () => {
                resetForm();
                $helpers.toast(trans('common.updated'), 'success');
            }
        });
    } else {
        // Create new phone number
        phoneForm.post(route('control.system.settings.social-links.store-phone'), {
            preserveScroll: true,
            onSuccess: () => {
                resetForm();
                $helpers.toast(trans('common.created'), 'success');
            }
        });
    }
};

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
            // If we're editing the item being deleted, cancel edit
            if (phoneForm.id === id) {
                cancelEdit();
            }
            phoneForm.delete(route('control.system.settings.social-links.destroy', id), {
                preserveScroll: true,
                onSuccess: () => {
                    $helpers.toast(trans('common.record') + ' ' + trans('common.deleted'));
                },
            });
        }
    });
};
</script>
