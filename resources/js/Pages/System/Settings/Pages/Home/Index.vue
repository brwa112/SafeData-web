<template>

    <Head>
        <title>{{ $t('system.home') }}</title>
    </Head>

    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <div class="flex whitespace-nowrap">
                <ul class="flex flex-wrap space-x-2 rtl:space-x-reverse">
                    <li class="text-gray-400">
                        <span>{{ $t('system.system') }}</span>
                    </li>
                    <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                        <Link :href="route('control.system.settings') + '#pages'"
                            class="duration-200 hover:text-primary">
                        {{ $t("system.pages") }}
                        </Link>
                    </li>
                    <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                        <span>{{ $t('system.home') }}</span>
                    </li>
                </ul>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <!-- Branch Selector -->
                <CustomMultiSelect v-model="selectBranch" :list="branchList" label="label" value="id" :showValue="false"
                    :require-selection="true" :isTrans="false" />
                <!-- Language Selector -->
                <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                    :showValue="false" parent-key="system" placeholder="languages" :require-selection="true" />
                <button @click="saveAllSections" :disabled="form.processing" type="button" class="btn btn-primary">
                    <Spinner v-if="form.processing" />
                    {{ $t('system.save_changes') }}
                </button>
            </div>
        </div>

        <div class="pt-4 space-y-4">

            <!-- Hero Section -->
            <HeroSection :form="form" :selectLanguage="selectLanguage" :uploadProgress="uploadProgress"
                :isUploading="isUploading" />

            <!-- History Section -->
            <HistorySection :form="historyForm" :selectLanguage="selectLanguage" />

            <!-- Principal Message Section -->
            <MessageSection :form="messageForm" :selectLanguage="selectLanguage" />

            <!-- Mission Section -->
            <MissionSection :form="missionForm" :selectLanguage="selectLanguage" />

            <!-- Social Links Section -->
            <SocialSection :form="socialForm" />

            <!-- Bottom Actions -->
            <div
                class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-[#d3d3d3] dark:border-[#1b2e4b] p-3 -mx-6">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <!-- <span class="hidden md:block">{{ $t('system.select_language') }}</span> -->
                        <CustomMultiSelect v-model="selectBranch" :list="branchList" label="label" value="id"
                            :showValue="false" :require-selection="true" :isTrans="false" buttonStyle="max-w-32" />
                        <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                            :showValue="false" parent-key="system" placeholder="languages" :require-selection="true" />
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <Link :href="route('control.system.settings') + '#pages'"
                            class="btn btn-sm btn-outline-secondary">
                        {{ $t('common.back') }}
                        </Link>
                        <button @click="saveAllSections" :disabled="form.processing" type="button"
                            class="btn btn-sm btn-primary sm:min-w-[120px]">
                            <Spinner v-if="form.processing" />
                            {{ $t('system.save_changes') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, ref, reactive, watch, computed } from 'vue';
import { Head, Link, useForm, router, usePage } from '@inertiajs/vue3';
import CustomMultiSelect from '@/Components/Inputs/CustomMultiSelect.vue';
import Spinner from '@/Components/Spinner.vue';
import { trans } from 'laravel-vue-i18n';

// Import partial components
import HeroSection from './Partials/HeroSection.vue';
import HistorySection from './Partials/HistorySection.vue';
import MessageSection from './Partials/MessageSection.vue';
import MissionSection from './Partials/MissionSection.vue';
import SocialSection from './Partials/SocialSection.vue';


const props = defineProps([
    'hero',
    'history',
    'message',
    'mission',
    'social',
]);

const $helpers = inject('helpers');
const page = usePage();
const Languages = page.props.languages;
const urlParams = new URLSearchParams(window.location.search || '');
const initialLangParam = urlParams.get('lang') || page.props.ziggy.query.lang || (Languages[0] && Languages[0].slug) || null;
const selectLanguage = ref(Languages.find(l => l.slug === initialLangParam) ?? Languages[0]);
const branchList = computed(() => {
    return page.props.branches.map(branch => ({
        id: branch.id,
        slug: branch.slug,
        name: branch.name,
        label: $helpers.getTranslation(branch.name, usePage().props.locale)
    }));
});

// Upload progress tracking
const uploadProgress = ref(0);
const isUploading = ref(false);

// Initial branch: prefer server-selected branch (from middleware) or ?branch_id in URL; coerce to number
const selectBranch = ref(branchList.value.find(b => Number(b.id) === Number(page.props.ziggy.query.branch_id)) ?? branchList.value[0]);

// Watch for branches prop to refresh data by calling route
watch(() => selectBranch.value, () => {
    const branchId = selectBranch.value?.id;
    const lang = selectLanguage.value?.slug;
    router.visit(route('control.system.pages.home.index'), {
        method: 'get',
        data: { branch_id: branchId, lang },
        // Don't preserve component state so forms re-initialize with new props
        preserveState: false,
        preserveScroll: true,
    });
}, { deep: true });

// Hero Section Form
const form = useForm({
    title: $helpers.parseTranslation(props.hero?.title),
    subtitle: $helpers.parseTranslation(props.hero?.subtitle),
    media_type: props.hero?.metadata?.media_type || 'image',
    background_image: props.hero?.hero_image || null,
    background_video: props.hero?.background_video || null,
    remove_hero_image: false,
    remove_hero_video: false,
    expert_tutors: props.hero?.metadata?.expert_tutors || 23,
    students: props.hero?.metadata?.students || 352,
    experience: props.hero?.metadata?.experience || 6,
    campuses: props.hero?.metadata?.campuses || 3,
    is_active: props.hero?.is_active || false,
});

// History Section Form
const historyForm = useForm({
    description: $helpers.parseTranslation(props.history?.description),
    image_1: props.history?.images?.[0] || null,
    image_2: props.history?.images?.[1] || null,
    remove_history_image_1: false,
    remove_history_image_2: false,
    is_active: props.history?.is_active || false,
});

// Principal Message Form
const messageForm = useForm({
    description: $helpers.parseTranslation(props.message?.description),
    image: props.message?.author_image || null,
    remove_message_image: false,
    is_active: props.message?.is_active || false,
});

// Mission Section Form
const missionForm = useForm({
    description: $helpers.parseTranslation(props.mission?.description),
    image: props.mission?.image || null,
    remove_mission_image: false,
    is_active: props.mission?.is_active || false,
});

// Social Links Form (HomeKnow)
const socialForm = useForm({
    youtube: props.social?.metadata?.youtube || '',
    facebook: props.social?.metadata?.facebook || '',
    instagram: props.social?.metadata?.instagram || '',
    twitter: props.social?.metadata?.twitter || '',
    is_active: props.social?.is_active || false,
});

// Ensure selectBranch follows server-provided selectedBranch (from middleware or ?branch_id=)
watch(() => page.props.selectedBranch, (newSelected) => {
    if (!newSelected) return;
    const found = branchList.value.find(b => b.id === newSelected.id);
    if (found) {
        selectBranch.value = found;
    } else if (branchList.value.length > 0) {
        // Fallback: select first branch
        selectBranch.value = branchList.value[0];
    }
}, { immediate: true });

const saveAllSections = () => {
    // Check if we have a video file to upload
    const hasVideoUpload = form.background_video instanceof File;

    if (hasVideoUpload) {
        isUploading.value = true;
        uploadProgress.value = 0;
    }

    form.transform((data) => {
        const formData = {
            ...data,
            // ensure translatable nested fields are plain objects (not reactive Proxies)
            title: $helpers.toPlain(data.title),
            subtitle: $helpers.toPlain(data.subtitle),
            branch_id: selectBranch.value?.id,
            metadata: {
                media_type: data.media_type,
                expert_tutors: data.expert_tutors,
                students: data.students,
                experience: data.experience,
                campuses: data.campuses,
            }
        };

        // Only include image/video if it's a File object (newly uploaded), not a URL string
        if (!(data.background_image instanceof File)) {
            delete formData.background_image;
        }
        if (!(data.background_video instanceof File)) {
            delete formData.background_video;
        }

        return formData;
    }).post(route('control.system.pages.home.hero.update'), {
        forceFormData: true,
        preserveScroll: true,
        preserveState: true,
        onProgress: (progress) => {
            if (progress.percentage) {
                uploadProgress.value = progress.percentage;
            }
        },
        onError: (errors) => {
            isUploading.value = false;
            uploadProgress.value = 0;
            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.home_hero') }), 'error');
            console.error('Hero Section Errors:', errors);
        },
        onSuccess: () => {
            isUploading.value = false;
            uploadProgress.value = 0;

            // Save History
            historyForm.transform((data) => {
                const formData = {
                    ...data,
                    // make sure reactive/Proxy translation objects become plain objects
                    description: $helpers.toPlain(data.description),
                    branch_id: selectBranch.value?.id
                };

                // Only include images if they're File objects
                if (!(data.image_1 instanceof File)) {
                    delete formData.image_1;
                }
                if (!(data.image_2 instanceof File)) {
                    delete formData.image_2;
                }

                return formData;
            }).post(route('control.system.pages.home.history.update'), {
                forceFormData: true,
                preserveScroll: true,
                preserveState: true,
                onError: (errors) => {
                    $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.home_history') }), 'error');
                    console.error('History Section Errors:', errors);
                },
                onSuccess: () => {
                    // Save Message
                    messageForm.transform((data) => {
                        const formData = {
                            ...data,
                            // ensure description is a plain object (not a Proxy)
                            description: $helpers.toPlain(data.description),
                            branch_id: selectBranch.value?.id
                        };

                        // Only include image if it's a File object
                        if (!(data.image instanceof File)) {
                            delete formData.image;
                        }

                        return formData;
                    }).post(route('control.system.pages.home.message.update'), {
                        forceFormData: true,
                        preserveScroll: true,
                        preserveState: true,
                        onError: (errors) => {
                            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.home_message') }), 'error');
                        },
                        onSuccess: () => {
                            // Save Mission
                            missionForm.transform((data) => {
                                const formData = {
                                    ...data,
                                    // ensure description is a plain object (not a Proxy)
                                    description: $helpers.toPlain(data.description),
                                    branch_id: selectBranch.value?.id
                                };

                                // Only include image if it's a File object
                                if (!(data.image instanceof File)) {
                                    delete formData.image;
                                }

                                return formData;
                            }).post(route('control.system.pages.home.mission.update'), {
                                forceFormData: true,
                                preserveScroll: true,
                                preserveState: true,
                                onError: (errors) => {
                                    $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.home_mission') }), 'error');
                                },
                                onSuccess: () => {
                                    // Save Social
                                    socialForm.transform((data) => ({
                                        ...data,
                                        branch_id: selectBranch.value?.id,
                                        metadata: {
                                            youtube: data.youtube,
                                            facebook: data.facebook,
                                            instagram: data.instagram,
                                            twitter: data.twitter,
                                        }
                                    })).post(route('control.system.pages.home.social.update'), {
                                        preserveScroll: true,
                                        preserveState: true,
                                        onError: (errors) => {
                                            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.home_social') }), 'error');
                                        },
                                        onSuccess: () => {
                                            $helpers.toast(trans('system.section_updated'), 'success');
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
        }
    });
};
</script>