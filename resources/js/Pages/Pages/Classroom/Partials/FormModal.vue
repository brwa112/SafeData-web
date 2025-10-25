<template>
    <TransitionRoot appear :show="showModal" as="template">
        <Dialog as="div" @close="onClose" class="relative z-50">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <DialogOverlay class="fixed inset-0 bg-[black]/60" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-start justify-center px-4 py-8">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="panel border-0 p-0 overflow-hidden rounded-lg w-full max-w-3xl text-black dark:text-white-dark">
                            <button type="button"
                                class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                @click="onClose">
                                <Svg name="close" class="size-6"></Svg>
                            </button>
                            <div
                                class="b-text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                <span v-if="form.id">
                                    {{ $t('common.edit') }}
                                </span>
                                <span v-else>
                                    {{ $t('common.new') }}
                                </span>
                                {{ $t('nav.classroom') }}
                            </div>
                            <div class="p-5">
                                <form @submit.prevent="onSubmit" v-shortkey="['ctrl', 's']" @shortkey="onSubmit"
                                    class="space-y-5">
                                    <!-- Language Tabs for Translations -->
                                    <div class="border-b border-gray-200 dark:border-gray-700">
                                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                                            <li v-for="lang in Languages" :key="lang.slug" class="mr-2">
                                                <button type="button" @click="language = lang.slug" :class="{
                                                    'border-primary text-primary': language === lang.slug,
                                                    'border-transparent': language !== lang.slug
                                                }"
                                                    class="inline-block p-2 -mt-2 text-sm font-medium border-b-2 rounded-t-lg hover:text-primary hover:border-primary">
                                                    {{ $t(`system.${lang.slug}`) }}
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <!-- Title (Multilingual) -->
                                        <div class="col-span-full">
                                            <label :for="'title_' + language">
                                                {{ $t('pages.title') }} ({{ $t(`system.${language}`) }}) <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input :id="'title_' + language" type="text" v-model="form.title[language]"
                                                :placeholder="$t('pages.title')" class="form-input"
                                                :class="{ 'border border-red-300 rounded-md': form.errors['title.' + language] }" />
                                            <div class="mt-1 text-sm text-danger"
                                                v-if="form.errors['title.' + language]"
                                                v-html="form.errors['title.' + language]">
                                            </div>
                                        </div>

                                        <!-- Content (Multilingual) -->
                                        <div class="col-span-full">
                                            <label :for="'content_' + language">
                                                {{ $t('pages.content') }} ({{ $t(`system.${language}`) }}) <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <textarea :id="'content_' + language" rows="8"
                                                v-model="form.content[language]" :placeholder="$t('pages.content')"
                                                class="form-input"
                                                :class="{ 'border border-red-300 rounded-md': form.errors['content.' + language] }"></textarea>
                                            <div class="mt-1 text-sm text-danger"
                                                v-if="form.errors['content.' + language]"
                                                v-html="form.errors['content.' + language]">
                                            </div>
                                        </div>

                                        <!-- Branch (Single Select) -->
                                        <div>
                                            <label for="branch_id">
                                                {{ $t('pages.branch') }} <span class="text-danger">*</span>
                                            </label>
                                            <MultiSelect v-model="selectedBranch" :list="branchList" :multiple="false"
                                                label="label" />
                                            <div class="mt-1 text-sm text-danger" v-if="form.errors.branch_id"
                                                v-html="form.errors.branch_id">
                                            </div>
                                        </div>

                                        <!-- Images -->
                                        <div class="col-span-full">
                                            <label for="images">
                                                {{ $t('pages.images') }}
                                            </label>
                                            <p class="text-xs text-gray-500 mb-2">
                                                {{ $t('pages.first_image_featured') }}
                                            </p>
                                            <p class="text-xs text-gray-500 mb-2">
                                                Supported formats: JPEG, PNG, JPG, GIF, WEBP (Max: 5MB each)
                                            </p>

                                            <!-- Existing Images Preview -->
                                            <div v-if="existingImages.length > 0" class="flex gap-4 mb-4">
                                                <div v-for="(image, index) in existingImages" :key="image.id"
                                                    class="relative group">
                                                    <img :src="image.thumb || image.url"
                                                        class="size-32 object-cover rounded-lg"
                                                        :alt="'Image ' + (index + 1)" />
                                                    <span v-if="index === 0"
                                                        class="absolute top-2 left-2 bg-primary text-white text-xs px-2 py-1 rounded">
                                                        {{ $t('pages.featured') }}
                                                    </span>
                                                    <button type="button" @click="removeExistingImage(index)"
                                                        class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                                        <Svg name="close" class="size-4"></Svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- New Images Upload -->
                                            <div class="flex gap-3">
                                                <div
                                                    class="size-32 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg flex items-center justify-center">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <Svg name="image_line" class="size-12 text-gray-400 mb-2"></Svg>
                                                        <input ref="fileInput" type="file" multiple accept="image/*"
                                                            @change="handleFileSelect" class="hidden" />
                                                        <button type="button" @click="$refs.fileInput.click()"
                                                            class="btn btn-sm btn-primary shadow-none">
                                                            {{ $t('common.upload_image') }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- New Images Preview -->
                                                <div v-if="newImages.length > 0" class="grid grid-cols-4 gap-4">
                                                    <div v-for="(image, index) in newImages" :key="index"
                                                        class="relative group">
                                                        <img :src="image.preview"
                                                            class="size-32 object-cover rounded-lg"
                                                            :alt="'New Image ' + (index + 1)" />
                                                        <button type="button" @click="removeNewImage(index)"
                                                            class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <Svg name="close" class="size-4"></Svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-1 text-sm text-danger" v-if="form.errors.images">
                                                <div v-if="typeof form.errors.images === 'string'"
                                                    v-html="form.errors.images"></div>
                                                <div v-else>
                                                    <div v-for="(error, key) in form.errors.images" :key="key">
                                                        {{ error }}
                                                    </div>
                                                </div>
                                            </div>
                                            <template v-for="(error, key) in form.errors" :key="key">
                                                <div class="mt-1 text-sm text-danger"
                                                    v-if="typeof key === 'string' && key.startsWith('images.')">
                                                    {{ error }}
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Order -->
                                        <div>
                                            <label for="order">
                                                {{ $t('pages.order') }}
                                            </label>
                                            <input id="order" type="number" min="0" v-model="form.order"
                                                :placeholder="$t('common.order')" class="form-input"
                                                :class="{ 'border border-red-300 rounded-md': form.errors.order }" />
                                            <div class="mt-1 text-sm text-danger" v-if="form.errors.order"
                                                v-html="form.errors.order">
                                            </div>
                                        </div>

                                        <!-- Is Active -->
                                        <div class="flex items-center mt-8">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="checkbox" v-model="form.is_active" class="form-checkbox" />
                                                <span class="ml-1">{{ $t('system.is_active') }}</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex justify-end items-center mt-5">
                                        <button @click="onClose" type="button" class="btn btn-outline-danger">
                                            {{ $t('common.discard') }}
                                        </button>
                                        <button :disabled="form.processing" type="submit"
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
</template>

<script setup>
import { inject, ref, watch, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';
import Svg from '@/Components/Svg.vue';
import Spinner from '@/Components/Spinner.vue';
import MultiSelect from '@/Components/Inputs/MultiSelect.vue';

const props = defineProps({
    showModal: {
        type: Boolean,
        required: true
    },
    form: {
        type: Object,
        required: true
    },
    branches: {
        type: Array,
        required: true
    },
    imagesForm: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['submit', 'close']);

const $helpers = inject('helpers');
const Languages = usePage().props.languages;

// Language state for form
const language = ref(Languages[0]?.slug || 'en');

// File input ref
const fileInput = ref(null);

// Image states
const existingImages = ref([]);
const newImages = ref([]);
const removedImages = ref([]);

// MultiSelect states
const selectedBranch = ref({});

// Prepare branch list with labels for current language
const branchList = computed(() => {
    return props.branches.map(branch => ({
        id: branch.id,
        slug: branch.slug,
        name: branch.name,
        label: $helpers.getTranslation(branch.name, language.value)
    }));
});

// Update form fields when selected values change
watch(selectedBranch, (newValue) => {
    const newId = newValue?.id || '';
    if (props.form.branch_id !== newId) {
        props.form.branch_id = newId;
    }
});

// Watch for form.branch_id changes to sync with selectedBranch
watch(() => props.form.branch_id, (newId) => {
    if (newId) {
        const branch = branchList.value.find(b => b.id === newId);
        if (branch) {
            selectedBranch.value = branch;
        }
    } else {
        selectedBranch.value = {};
    }
}, { immediate: true });

// Watch for language changes to update selected items with new labels
watch(language, () => {
    // Update selectedBranch with new label
    if (selectedBranch.value?.id) {
        const branch = branchList.value.find(b => b.id === selectedBranch.value.id);
        if (branch) {
            selectedBranch.value = branch;
        }
    }
});

// Watch for existing images from imagesForm
watch(() => props.imagesForm.images, (newValue) => {
    if (Array.isArray(newValue)) {
        existingImages.value = [...newValue];
        removedImages.value = [];
    } else {
        existingImages.value = [];
        removedImages.value = [];
    }
}, { immediate: true });

// Watch for modal closing to reset new images
watch(() => props.showModal, (newValue) => {
    if (!newValue) {
        newImages.value = [];
        removedImages.value = [];
    }
});

// Handle file selection
const handleFileSelect = (event) => {
    const files = Array.from(event.target.files);

    files.forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            newImages.value.push({
                file: file,
                preview: e.target.result
            });
            updateFormImages();
        };
        reader.readAsDataURL(file);
    });

    event.target.value = '';
};

// Remove existing image
const removeExistingImage = (index) => {
    const removed = existingImages.value.splice(index, 1);
    if (removed.length > 0) {
        removedImages.value.push(removed[0]);
    }
    updateFormImages();
};

// Remove new image
const removeNewImage = (index) => {
    newImages.value.splice(index, 1);
    updateFormImages();
};

// Update form images
const updateFormImages = () => {
    const allFiles = newImages.value.map(img => img.file);
    props.form.images = allFiles;
    props.form.deleted_image_ids = removedImages.value.map(img => img.id);
    props.form.remove_images = existingImages.value.length === 0 && removedImages.value.length > 0;
};

const onSubmit = () => {
    emit('submit');
};

const onClose = () => {
    newImages.value = [];
    removedImages.value = [];

    if (props.form.errors) {
        Object.keys(props.form.errors).forEach(key => {
            if (key.startsWith('images')) {
                delete props.form.errors[key];
            }
        });
    }

    emit('close');
};
</script>
