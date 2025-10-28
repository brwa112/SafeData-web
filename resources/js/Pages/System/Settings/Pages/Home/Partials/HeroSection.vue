<template>
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
</template>

<script setup>
import { computed } from 'vue';
import ImageUpload from '@/Components/Inputs/ImageUpload.vue';

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    selectLanguage: {
        type: Object,
        required: true
    }
});

const handleVideoUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        props.form.background_video = file;
        props.form.remove_hero_background = false;
    }
};

const removeVideo = () => {
    props.form.background_video = null;
    props.form.remove_hero_background = true;
};

// Compute video preview URL
const videoPreviewUrl = computed(() => {
    if (!props.form.background_video) return null;
    if (props.form.background_video instanceof File) {
        return URL.createObjectURL(props.form.background_video);
    }
    return props.form.background_video; // Already a URL string
});
</script>