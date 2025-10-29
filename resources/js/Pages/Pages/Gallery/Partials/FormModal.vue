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
                                {{ $t('nav.gallery') }}
                            </div>
                            <div class="p-5">
                                <form @submit.prevent="onSubmit" v-shortkey="['ctrl', 's']" @shortkey="onSubmit"
                                    class="space-y-5">

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

                                        <!-- Description (Multilingual) -->
                                        <div class="col-span-full">
                                            <label :for="'description_' + language">
                                                {{ $t('pages.content') }} ({{ $t(`system.${language}`) }})
                                            </label>
                                            <textarea :id="'description_' + language" rows="6"
                                                v-model="form.description[language]" :placeholder="$t('pages.content')"
                                                class="form-input"
                                                :class="{ 'border border-red-300 rounded-md': form.errors['description.' + language] }"></textarea>
                                            <div class="mt-1 text-sm text-danger"
                                                v-if="form.errors['description.' + language]"
                                                v-html="form.errors['description.' + language]">
                                            </div>
                                        </div>

                                        <!-- Category (Single Select) -->
                                        <div>
                                            <label for="category_id">
                                                {{ $t('pages.category') }}
                                            </label>
                                            <MultiSelect v-model="selectedCategory" :list="categoryList"
                                                :multiple="false" label="label" />
                                            <div class="mt-1 text-sm text-danger" v-if="form.errors.category_id"
                                                v-html="form.errors.category_id">
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
                                                Supported formats: JPEG, PNG, JPG, GIF, WEBP (Max: 10MB each)
                                            </p>
                                            <p class="text-xs text-gray-500 mb-2 -mt-1">
                                                
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
                                                        <input ref="fileInput" type="file" accept="image/*"
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
    categories: {
        type: Array,
        required: true
    },
    branches: {
        type: Array,
        required: false,
        default: () => []
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

// MultiSelect state
const selectedCategory = ref({});
const selectedBranch = ref({});

const branchList = computed(() => {
    return props.branches.map(b => ({ id: b.id, slug: b.slug, name: b.name, label: $helpers.getTranslation(b.name, language.value) }));
});

const categoryList = computed(() => {
    return props.categories.map(c => ({ id: c.id, slug: c.slug, name: c.name, label: $helpers.getTranslation(c.name, language.value) }));
});

watch(() => props.imagesForm, (v) => {
    existingImages.value = v?.images || [];
}, { immediate: true });

watch(selectedCategory, (newValue) => {
    props.form.category_id = newValue?.id || '';
});

watch(selectedBranch, (newValue) => {
    props.form.branch_id = newValue?.id || '';
});

watch(() => props.form.category_id, (newId) => {
    if (newId) {
        const cat = categoryList.value.find(c => c.id === newId);
        if (cat) selectedCategory.value = cat;
    } else {
        selectedCategory.value = {};
    }
}, { immediate: true });

const onClose = () => {
    emit('close');
};

const onSubmit = () => {
    emit('submit');
};

// Clear new images and reset file input when modal is closed to ensure form is clean after save/close
watch(() => props.showModal, (val) => {
    if (!val) {
        // clear previews and attached files
        newImages.value = [];
        props.form.images = [];
        // reset internal file input element if present
        if (fileInput.value) fileInput.value.value = null;
    }
});

// File handlers
const handleFileSelect = (e) => {
    const files = e.target.files;
    if (!files || files.length === 0) return;

    // Only allow a single image for Gallery form. Use the first selected file.
    const file = files[0];
    const reader = new FileReader();
    reader.onload = (ev) => {
        // replace any previous newImages with the single selected image
        newImages.value = [{ file: file, preview: ev.target.result }];
    };
    reader.readAsDataURL(file);

    // Attach single file to parent form (replace any existing selection)
    props.form.images = [file];
};

const removeExistingImage = (index) => {
    const img = existingImages.value[index];
    if (!img) return;
    props.form.deleted_image_ids = props.form.deleted_image_ids || [];
    props.form.deleted_image_ids.push(img.id);
    existingImages.value.splice(index, 1);
};

const removeNewImage = (index) => {
    // For single-image flow, just clear newImages and the form.images array
    newImages.value.splice(index, 1);
    props.form.images = [];
};

// Sync branch prop when form.branch_id changes (edit case)
watch(() => props.form.branch_id, (newId) => {
    if (newId) {
        const br = branchList.value.find(b => b.id === newId);
        if (br) selectedBranch.value = br;
    } else {
        selectedBranch.value = {};
    }
}, { immediate: true });
</script>
