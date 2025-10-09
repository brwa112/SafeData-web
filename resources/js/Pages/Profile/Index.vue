<template>
    <div class="space-y-6">
        <!-- Breadcrumb -->
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li class="text-gray-500">
                <span>{{ $t('system.system') }}</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>{{ $t('system.profile') }}</span>
            </li>
        </ul>

        <!-- Main Content -->
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Profile Information Card -->
            <div class="w-full md:max-w-xs">
                <div class="panel p-6">
                    <div class="text-center">
                        <!-- Profile Avatar -->
                        <div class="relative inline-block mb-3">
                            <!-- <ImageUpload v-model="imageForm.avatar" v-model:form="imageForm" field-name="avatar"
                                :custom-class="'!size-24 !rounded-full'" /> -->
                            <ImageUpload v-model="imageForm.avatar" :form="imageForm" field-name="avatar"
                                :custom-class="'!size-24 !rounded-full'" @update:form="updateImageForm" />
                            <!-- <img src="http://127.0.0.1:8000/storage/2/logo.png" alt=""> -->
                        </div>

                        <!-- User Info -->
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-1">
                            {{ user.name }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            {{ user.email }}
                        </p>

                        <!-- Profile Stats -->
                        <div class="grid grid-cols-1 gap-4 text-center border-t pt-4 dark:border-gray-700">
                            <div>
                                <div class="text-lg font-semibold text-primary capitalize">
                                    {{ userRoles }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $t('system.privilege') }}</div>
                            </div>
                            <!-- <div>
                                <div class="text-lg font-semibold text-success">
                                    {{ $t(`system.${userAuthority}`) }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $t('system.authority') }}</div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Panel -->
            <div class="w-full md:max-w-xl">
                <div class="panel p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-primary/10 p-2 rounded-lg">
                            <Svg name="setup" class="size-5 text-primary"></Svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $t('system.appearance_settings') }}
                            </h2>
                        </div>
                    </div>

                    <form @submit.prevent="updateSettings" class="space-y-6">
                        <!-- Typography Section -->
                        <div class="space-y-4">
                            <h3
                                class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2 dark:border-gray-700">
                                {{ $t('system.typography') }}
                            </h3>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $t('system.font_size') }}
                                    </label>
                                    <MultiSelect v-model="form.font_scale" :list="scaleOptions" label="name"
                                        value="value" :showValue="false" :error="form.errors.font_scale" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $t('system.font_weight') }}
                                    </label>
                                    <MultiSelect v-model="form.font_weight" :list="weightOptions" label="name"
                                        value="value" :showValue="false" :error="form.errors.font_weight" />
                                </div>
                            </div>
                        </div>

                        <!-- Localization Section -->
                        <div class="space-y-4">
                            <h3
                                class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2 dark:border-gray-700">
                                {{ $t('system.localization') }}
                            </h3>
                            <div class="grid grid-cols-1 lg:grid-cols-1 gap-4">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $t('system.language') }}
                                    </label>
                                    <MultiSelect v-model="form.language_id" :list="page.props.languages" label="slug"
                                        parent-key="system" :error="form.errors.language_id" />
                                </div>
                            </div>
                        </div>

                        <!-- Theme Section -->
                        <div class="space-y-4">
                            <h3
                                class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2 dark:border-gray-700">
                                {{ $t('system.visual_theme') }}
                            </h3>
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $t('system.theme') }}
                                </label>
                                <MultiSelect v-model="form.theme" :list="props.theme" label="slug" value="name"
                                    parent-key="system" :showValue="false" :error="form.errors.theme" />
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-6 border-t dark:border-gray-700">
                            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                                <button type="button" class="btn btn-sm btn-outline-secondary px-6 py-2"
                                    @click="resetForm">
                                    {{ $t('system.reset') }}
                                </button>
                                <button type="submit"
                                    class="btn btn-sm btn-primary shadow-none px-6 py-2 flex items-center space-x-2"
                                    :disabled="isLoading">
                                    <Svg v-if="isLoading" name="main_spinner" class="animate-spin w-4 h-4"></Svg>
                                    <span>{{ isLoading ? $t('system.saving') : $t('system.save_changes') }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { wTrans, trans } from 'laravel-vue-i18n';
import { inject, ref, computed, watch } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import MultiSelect from '@/Components/Inputs/MultiSelect.vue';
import Svg from '@/Components/Svg.vue';
import ImageUpload from '@/Components/Inputs/ImageUpload.vue';
import { useFontSettings } from '@/Composables/useFontSize';
import Swal from 'sweetalert2';

const { fontScale, scaleOptions, fontWeight, weightOptions, isLoading, setFontScale, setFontWeight } = useFontSettings();

const props = defineProps({
    theme: {
        type: Array,
        required: false,
        default: () => [],
    },
});

const $helpers = inject('helpers');
const page = usePage();

// In your profile page script:
const imageForm = ref({
    avatar: page.props.auth.user.avatar || null,
    remove_avatar: false
});

// Update the watch to properly sync
watch(imageForm, (newVal) => {
    form.avatar = newVal.avatar || null;
    form.remove_avatar = newVal.remove_avatar || false;
}, { deep: true });

// Add proper form update handler
const updateImageForm = (newForm) => {
    imageForm.value = newForm;
};

// Fix the main form initialization
const form = useForm({
    avatar: page.props.auth.user.avatar || null,
    remove_avatar: false,
    font_scale: null,
    font_weight: null,
    language_id: page.props.languages?.length > 0 ? (
        page.props.languages.find(d => d.id === page.props.auth.user.settings?.language_id) || page.props.languages.find(d => d.id === page.props.auth.user.settings?.language?.id) ||
        page.props.languages[0]
    ) : null,
    theme: props.theme?.length > 0 ? (
        props.theme.find(d => d.name === page.props.auth.user.settings?.theme) ||
        props.theme[0]
    ) : null,
});

console.log('Initial form:', form);

const user = computed(() => page.props.auth.user || {});
const userRoles = computed(() => (user.value.roles?.map(r => r.name).join(', ') || (user.value.role || '')));
const userAuthority = computed(() => user.value.typeuser.slug || '-');

watch(fontScale, (newFontScale) => {
    const newFontScaleObject = scaleOptions.value.find(scale => scale.value === newFontScale);
    if (newFontScaleObject) {
        form.font_scale = newFontScaleObject;
    }
}, { immediate: true });

watch(fontWeight, (newFontWeight) => {
    const newFontWeightObject = weightOptions.value.find(weight => weight.value === newFontWeight);
    if (newFontWeightObject) {
        form.font_weight = newFontWeightObject;
    }
});

const resetForm = () => {
    Swal.fire({
        icon: 'warning',
        title: trans('common.are_you_sure_you_want_to_reset'),
        text: trans('common.reset_this'),
        showCancelButton: true,
        confirmButtonText: trans('common.yes_reset_it'),
        cancelButtonText: trans('common.cancel'),
        padding: '2em',
        customClass: 'sweet-alerts',
    }).then((result) => {
        if (result.value) {

            imageForm.value.avatar = page.props.auth.user.avatar || null;

            const english = page.props.languages?.find(l => (l.slug && l.slug.toLowerCase() === 'en') || (l.name && l.name.toLowerCase().includes('english'))) || page.props.languages?.[0] || null;
            form.language_id = english;
            if (english?.name) localStorage.setItem('language', english.name);

            form.direction = 'ltr';
            localStorage.setItem('direction', 'ltr');

            const lightTheme = props.theme?.find(t => t.name && t.name.toLowerCase() === 'light') || props.theme?.[0] || null;
            form.theme = lightTheme;
            if (lightTheme?.name) localStorage.setItem('theme', lightTheme.name);

            const defaultScale = scaleOptions.value?.find(s => s.value === 'medium' || (s.name && s.name.toLowerCase() === 'medium')) || scaleOptions.value?.[0] || null;
            form.font_scale = defaultScale;
            if (defaultScale?.value) {
                setFontScale(defaultScale.value);
                localStorage.setItem('fontScale', defaultScale.value);
            }

            const defaultWeight = weightOptions.value?.find(w => w.value === 'normal' || w.value === 400 || (w.name && w.name.toLowerCase() === 'normal')) || weightOptions.value?.[0] || null;
            form.font_weight = defaultWeight;
            if (defaultWeight?.value) {
                setFontWeight(defaultWeight.value);
                localStorage.setItem('fontWeight', defaultWeight.value);
            }
            updateSettings();
        }
    });
};

const updateSettings = () => {
    form.post(route('control.system.users.setting'), {
        onSuccess: (response) => {
            $helpers.toast(trans('common.record') + ' ' + trans('common.updated'));

            if (form.language_id?.name) {
                localStorage.setItem('language', form.language_id.name);
            }
            if (form.theme?.name) {
                localStorage.setItem('theme', form.theme.name);
            }
            if (form.font_scale?.value) {
                localStorage.setItem('fontScale', form.font_scale.value);
                setFontScale(form.font_scale.value);
            }
            if (form.font_weight?.value) {
                localStorage.setItem('fontWeight', form.font_weight.value);
                setFontWeight(form.font_weight.value);
            }

            if (form.direction) {
                localStorage.setItem('direction', form.direction);
            }

            window.location.reload();
        },
        onError: (errors) => {
            console.error('Failed to update settings:', errors);
        }
    });

};
</script>
