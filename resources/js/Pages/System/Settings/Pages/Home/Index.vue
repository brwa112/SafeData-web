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
                        <Link :href="route('control.system.settings')" class="duration-200 hover:text-primary">
                        {{ $t("system.pages") }}
                        </Link>
                    </li>
                    <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                        <span>{{ $t('system.home') }}</span>
                    </li>
                </ul>
            </div>
            <div class="flex items-center gap-2">
                <!-- Branch Selector -->
                <CustomMultiSelect v-model="selectBranch" :list="branchList" label="label" value="id" :showValue="false"
                    :require-selection="true" :isTrans="false" />
                <!-- Language Selector -->
                <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                    :showValue="false" parent-key="system" placeholder="languages" :require-selection="true" />
                <button @click="saveAllSections" type="button" class="btn btn-primary">
                    <span>{{ $t('system.save_changes') }}</span>
                </button>
            </div>
        </div>

        <div class="pt-4 space-y-4">

            <!-- Hero Section -->
            <div class="panel">
                <div class="mb-5 flex items-center justify-between">
                    <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.home_hero') }}</h5>
                    <label class="relative h-6 w-12">
                        <input v-model="form.is_active" type="checkbox"
                            class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" />
                        <span
                            class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                    </label>
                </div>
                <form class="space-y-5">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="space-y-4">
                            <div>
                                <label for="hero_title">{{ $t('system.hero_title') }} ({{
                                    $t(`system.${selectLanguage.slug}`) }})</label>
                                <input v-model="form.title[selectLanguage.slug]" id="hero_title" type="text"
                                    class="form-input" />
                                <div class="mt-1 text-sm text-danger" v-if="form.errors['title.' + selectLanguage.slug]"
                                    v-html="form.errors['title.' + selectLanguage.slug]">
                                </div>
                            </div>
                            <div>
                                <label for="hero_subtitle">{{ $t('system.hero_subtitle') }} ({{
                                    $t(`system.${selectLanguage.slug}`) }})</label>
                                <input v-model="form.subtitle[selectLanguage.slug]" id="hero_subtitle" type="text"
                                    class="form-input" />
                                <div class="mt-1 text-sm text-danger"
                                    v-if="form.errors['subtitle.' + selectLanguage.slug]"
                                    v-html="form.errors['subtitle.' + selectLanguage.slug]">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label for="expert_tutors">{{ $t('system.expert_tutors') }}</label>
                                    <input v-model.number="form.expert_tutors" id="expert_tutors" type="number"
                                        class="form-input" />
                                    <div class="mt-1 text-sm text-danger" v-if="form.errors['metadata.expert_tutors']"
                                        v-html="form.errors['metadata.expert_tutors']">
                                    </div>
                                </div>
                                <div>
                                    <label for="students">{{ $t('system.students') }}</label>
                                    <input v-model.number="form.students" id="students" type="number"
                                        class="form-input" />
                                    <div class="mt-1 text-sm text-danger" v-if="form.errors['metadata.students']"
                                        v-html="form.errors['metadata.students']">
                                    </div>
                                </div>
                                <div>
                                    <label for="experience">{{ $t('system.years_experience') }}</label>
                                    <input v-model.number="form.experience" id="experience" type="number"
                                        class="form-input" />
                                    <div class="mt-1 text-sm text-danger" v-if="form.errors['metadata.experience']"
                                        v-html="form.errors['metadata.experience']">
                                    </div>
                                </div>
                                <div>
                                    <label for="campuses">{{ $t('system.campuses') }}</label>
                                    <input v-model.number="form.campuses" id="campuses" type="number"
                                        class="form-input" />
                                    <div class="mt-1 text-sm text-danger" v-if="form.errors['metadata.campuses']"
                                        v-html="form.errors['metadata.campuses']">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label>{{ $t('system.background_media') }}</label>
                            <div class="flex gap-2 mb-2">
                                <button @click="form.media_type = 'image'" type="button"
                                    :class="form.media_type === 'image' ? 'btn-primary' : 'btn-outline-primary'"
                                    class="btn">
                                    {{ $t('system.image') }}
                                </button>
                                <button @click="form.media_type = 'video'" type="button"
                                    :class="form.media_type === 'video' ? 'btn-primary' : 'btn-outline-primary'"
                                    class="btn">
                                    {{ $t('system.video') }}
                                </button>
                            </div>
                            <div v-if="form.media_type === 'image'">
                                <ImageUpload v-model="form.background_image" field-name="hero_background"
                                    @update:form="(data) => { if (data.remove_hero_background !== undefined) form.remove_hero_background = data.remove_hero_background; }" />
                            </div>
                            <div v-else>
                                <div v-if="videoPreviewUrl" class="mb-3">
                                    <video :src="videoPreviewUrl" controls
                                        class="w-full rounded-lg max-h-64 bg-black"></video>
                                    <button @click="removeVideo" type="button" class="btn btn-sm btn-danger mt-2">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        {{ $t('system.remove_video') }}
                                    </button>
                                </div>
                                <input @change="handleVideoUpload" type="file" accept="video/*" class="form-input" />
                                <p class="text-xs text-gray-500 mt-1">{{ $t('system.upload_background_video') }}</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- History Section -->
            <div class="panel">
                <div class="mb-5 flex items-center justify-between">
                    <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.home_history') }}</h5>
                    <label class="relative h-6 w-12">
                        <input v-model="historyForm.is_active" type="checkbox"
                            class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" />
                        <span
                            class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                    </label>
                </div>
                <form class="space-y-5">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div>
                            <label for="history_description">{{ $t('system.history_description') }} ({{
                                $t(`system.${selectLanguage.slug}`)
                            }})</label>
                            <textarea v-model="historyForm.description[selectLanguage.slug]" id="history_description"
                                rows="9" class="form-textarea"></textarea>
                            <div class="mt-1 text-sm text-danger"
                                v-if="historyForm.errors['description.' + selectLanguage.slug]"
                                v-html="historyForm.errors['description.' + selectLanguage.slug]">
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label>{{ $t('system.image') }} 1</label>
                                <ImageUpload v-model="historyForm.image_1" field-name="history_image_1"
                                    @update:form="(data) => { if (data.remove_history_image_1 !== undefined) historyForm.remove_history_image_1 = data.remove_history_image_1; }" />
                            </div>
                            <div>
                                <label>{{ $t('system.image') }} 2</label>
                                <ImageUpload v-model="historyForm.image_2" field-name="history_image_2"
                                    @update:form="(data) => { if (data.remove_history_image_2 !== undefined) historyForm.remove_history_image_2 = data.remove_history_image_2; }" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Principal Message Section -->
            <div class="panel">
                <div class="mb-5 flex items-center justify-between">
                    <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.home_message') }}</h5>
                    <label class="relative h-6 w-12">
                        <input v-model="messageForm.is_active" type="checkbox"
                            class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" />
                        <span
                            class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                    </label>
                </div>
                <form class="space-y-5">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div>
                            <label for="message_description">{{ $t('system.message_description') }} ({{
                                $t(`system.${selectLanguage.slug}`)
                            }})</label>
                            <textarea v-model="messageForm.description[selectLanguage.slug]" id="message_description"
                                rows="9" class="form-textarea"></textarea>
                            <div class="mt-1 text-sm text-danger"
                                v-if="messageForm.errors['description.' + selectLanguage.slug]"
                                v-html="messageForm.errors['description.' + selectLanguage.slug]">
                            </div>
                        </div>
                        <div>
                            <label>{{ $t('system.principal_image') }}</label>
                            <ImageUpload v-model="messageForm.image" field-name="message_image"
                                @update:form="(data) => { if (data.remove_message_image !== undefined) messageForm.remove_message_image = data.remove_message_image; }" />
                        </div>
                    </div>
                </form>
            </div>

            <!-- Mission Section -->
            <div class="panel">
                <div class="mb-5 flex items-center justify-between">
                    <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.home_mission') }}</h5>
                    <label class="relative h-6 w-12">
                        <input v-model="missionForm.is_active" type="checkbox"
                            class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" />
                        <span
                            class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                    </label>
                </div>
                <form class="space-y-5">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div>
                            <label for="mission_description">{{ $t('system.mission_description') }} ({{
                                $t(`system.${selectLanguage.slug}`)
                            }})</label>
                            <textarea v-model="missionForm.description[selectLanguage.slug]" id="mission_description"
                                rows="12" class="form-textarea"></textarea>
                            <div class="mt-1 text-sm text-danger"
                                v-if="missionForm.errors['description.' + selectLanguage.slug]"
                                v-html="missionForm.errors['description.' + selectLanguage.slug]">
                            </div>
                        </div>
                        <div>
                            <label>{{ $t('system.background_image') }}</label>
                            <ImageUpload v-model="missionForm.image" field-name="mission_image"
                                @update:form="(data) => { if (data.remove_mission_image !== undefined) missionForm.remove_mission_image = data.remove_mission_image; }" />
                        </div>
                    </div>
                </form>
            </div>

            <!-- Social Links Section -->
            <div class="panel">
                <div class="mb-5 flex items-center justify-between">
                    <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.home_social') }}</h5>
                    <label class="relative h-6 w-12">
                        <input v-model="socialForm.is_active" type="checkbox"
                            class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" />
                        <span
                            class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                    </label>
                </div>
                <form class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="youtube_link">{{ $t('system.youtube_link') }}</label>
                            <input v-model="socialForm.youtube" id="youtube_link" type="url" class="form-input"
                                placeholder="https://youtube.com/@yourhandle" />
                            <div class="mt-1 text-sm text-danger" v-if="socialForm.errors['metadata.youtube']"
                                v-html="socialForm.errors['metadata.youtube']">
                            </div>
                        </div>
                        <div>
                            <label for="facebook_link">{{ $t('system.facebook_link') }}</label>
                            <input v-model="socialForm.facebook" id="facebook_link" type="url" class="form-input"
                                placeholder="https://facebook.com/yourpage" />
                            <div class="mt-1 text-sm text-danger" v-if="socialForm.errors['metadata.facebook']"
                                v-html="socialForm.errors['metadata.facebook']">
                            </div>
                        </div>
                        <div>
                            <label for="instagram_link">{{ $t('system.instagram_link') }}</label>
                            <input v-model="socialForm.instagram" id="instagram_link" type="url" class="form-input"
                                placeholder="https://instagram.com/yourprofile" />
                            <div class="mt-1 text-sm text-danger" v-if="socialForm.errors['metadata.instagram']"
                                v-html="socialForm.errors['metadata.instagram']">
                            </div>
                        </div>
                        <div>
                            <label for="twitter_link">{{ $t('system.twitter_link') }}</label>
                            <input v-model="socialForm.twitter" id="twitter_link" type="url" class="form-input"
                                placeholder="https://twitter.com/yourhandle" />
                            <div class="mt-1 text-sm text-danger" v-if="socialForm.errors['metadata.twitter']"
                                v-html="socialForm.errors['metadata.twitter']">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Bottom Actions -->
            <div
                class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-[#d3d3d3] dark:border-[#1b2e4b] p-3 -mx-6">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div class="flex items-center gap-3">
                        <span class="hidden md:block">{{ $t('system.select_language') }}</span>
                        <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                            :showValue="false" parent-key="system" placeholder="languages" :require-selection="true" />
                    </div>
                    <div class="flex items-center gap-3">
                        <Link :href="route('control.system.settings')" class="btn btn-sm btn-outline-secondary">
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
import ImageUpload from '@/Components/Inputs/ImageUpload.vue';
import CustomMultiSelect from '@/Components/Inputs/CustomMultiSelect.vue';
import Spinner from '@/Components/Spinner.vue';
import { trans } from 'laravel-vue-i18n';

const props = defineProps([
    'hero',
    'history',
    'message',
    'mission',
    'social',
    'branches',
]);

const $helpers = inject('helpers');
const Languages = usePage().props.languages;
const selectLanguage = ref(Languages[0]);
const branchList = computed(() => {
    return usePage().props.branches.map(branch => ({
        id: branch.id,
        slug: branch.slug,
        name: branch.name,
        label: $helpers.getTranslation(branch.name, selectLanguage.value.slug)
    }));
});
const selectBranch = ref(branchList.value[0]);

// Watch for language changes and update selectBranch with the new translation
watch(selectLanguage, () => {
    if (selectBranch.value) {
        // Find the same branch in the updated branchList with new translation
        const updatedBranch = branchList.value.find(branch => branch.id === selectBranch.value.id);
        if (updatedBranch) {
            selectBranch.value = updatedBranch;
        }
    }
}, { deep: true });

// Helper function to parse translatable fields
const parseTranslation = (value) => {
    if (!value) return { en: '', ckb: '', ar: '' };
    if (typeof value === 'object') return value;
    if (typeof value === 'string') {
        try {
            return JSON.parse(value);
        } catch (e) {
            return { en: value, ckb: '', ar: '' };
        }
    }
    return { en: '', ckb: '', ar: '' };
};

// Hero Section Form
const form = useForm({
    title: parseTranslation(props.hero?.title),
    subtitle: parseTranslation(props.hero?.subtitle),
    media_type: props.hero?.metadata?.media_type || 'image',
    background_image: props.hero?.hero_image || null,
    background_video: props.hero?.background_video || null,
    remove_hero_background: false,
    expert_tutors: props.hero?.metadata?.expert_tutors || 23,
    students: props.hero?.metadata?.students || 352,
    experience: props.hero?.metadata?.experience || 6,
    campuses: props.hero?.metadata?.campuses || 3,
    is_active: props.hero?.is_active || false,
});

// History Section Form
const historyForm = useForm({
    description: parseTranslation(props.history?.description),
    image_1: props.history?.images?.[0] || null,
    image_2: props.history?.images?.[1] || null,
    remove_history_image_1: false,
    remove_history_image_2: false,
    is_active: props.history?.is_active || false,
});

// Principal Message Form
const messageForm = useForm({
    description: parseTranslation(props.message?.description),
    image: props.message?.author_image || null,
    remove_message_image: false,
    is_active: props.message?.is_active || false,
});

// Mission Section Form
const missionForm = useForm({
    description: parseTranslation(props.mission?.description),
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

const handleVideoUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.background_video = file;
        form.remove_hero_background = false;
    }
};

const removeVideo = () => {
    form.background_video = null;
    form.remove_hero_background = true;
};

// Compute video preview URL
const videoPreviewUrl = computed(() => {
    if (!form.background_video) return null;
    if (form.background_video instanceof File) {
        return URL.createObjectURL(form.background_video);
    }
    return form.background_video; // Already a URL string
});

const saveAllSections = () => {
    form.transform((data) => {
        const formData = {
            ...data,
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
        preserveScroll: true,
        onError: (errors) => {
            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.home_hero') }), 'error');
        },
        onSuccess: () => {
            // Save History
            historyForm.transform((data) => {
                const formData = {
                    ...data,
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
                preserveScroll: true,
                onError: (errors) => {
                    $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.home_history') }), 'error');
                },
                onSuccess: () => {
                    // Save Message
                    messageForm.transform((data) => {
                        const formData = {
                            ...data,
                            branch_id: selectBranch.value?.id
                        };

                        // Only include image if it's a File object
                        if (!(data.image instanceof File)) {
                            delete formData.image;
                        }

                        return formData;
                    }).post(route('control.system.pages.home.message.update'), {
                        preserveScroll: true,
                        onError: (errors) => {
                            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.home_message') }), 'error');
                        },
                        onSuccess: () => {
                            // Save Mission
                            missionForm.transform((data) => {
                                const formData = {
                                    ...data,
                                    branch_id: selectBranch.value?.id
                                };

                                // Only include image if it's a File object
                                if (!(data.image instanceof File)) {
                                    delete formData.image;
                                }

                                return formData;
                            }).post(route('control.system.pages.home.mission.update'), {
                                preserveScroll: true,
                                onError: (errors) => {
                                    $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.home_mission') }), 'error');
                                },
                                onSuccess: () => {
                                    // Save Social
                                    socialForm.transform((data) => ({
                                        ...data,
                                        metadata: {
                                            youtube: data.youtube,
                                            facebook: data.facebook,
                                            instagram: data.instagram,
                                            twitter: data.twitter,
                                        }
                                    })).post(route('control.system.pages.home.social.update'), {
                                        preserveScroll: true,
                                        onError: (errors) => {
                                            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.home_social') }), 'error');
                                        },
                                        onSuccess: () => {
                                            $helpers.toast(trans('system.home_section_updated'), 'success');
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