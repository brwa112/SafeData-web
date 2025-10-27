<template>
    <!-- Image -->
    <div class="custom-file-container" :data-upload-id="fieldName">
        <!-- Avatar -->
        <div class="custom-file-container w-auto" :data-upload-id="fieldName">
            <div class="dropdown">
                <Popper :placement="rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="0"
                    class="relative align-middle">
                    <button type="button" :class="customClass"
                        class="group outline-none border-none hover:underline b-text-sm text-primary font-bold dropdown-toggle flex items-center gap-0.5">
                        <div class="relative size-24 xl:size-32" :class="customClass">
                            <div class="custom-file-container__image-preview size-24 xl:size-32 rounded-lg !object-fit !mb-0 !mt-0 !overflow-hidden"
                                :class="customClass">
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-lg duration-500 opacity-0 group-hover:opacity-100"
                                :class="customClass">
                                <Svg name="edit_image" class="size-7 xl:size-9 text-white"></Svg>
                            </div>
                        </div>
                    </button>
                    <template #content="{ close }">
                        <ul @click="close()"
                            class="whitespace-nowrap border border-gray-100 dark:border-gray-700 !-mt-5 !py-1">
                            <li>
                                <button type="button" @click="uploadImage()">
                                    {{ $t('common.upload_image') }}
                                    <label class="hidden">
                                        <button type="button"
                                            class="relative w-full custom-file-container__custom-file__custom-file-input !cursor-pointer !opacity-100 text-start px-4 !py-2 font-normal b-text-sm text-gray-600 hover:text-primary hover:bg-primary/10">
                                            <span class="relative z-10">{{
                                                $t('common.upload_image')
                                            }}</span>
                                            <input @input="handleFileInput($event)" ref="imageProfile" type="file"
                                                class="absolute !inset-0 z-0 w-full !cursor-pointer opacity-0"
                                                accept="image/*" />
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        </button>
                                        <span
                                            class="custom-file-container__custom-file__custom-file-control hidden"></span>
                                    </label>
                                </button>
                            </li>
                            <li>
                                <button @click="removeImage()" type="button" class="custom-file-container__image-clear">
                                    {{ $t('common.remove_image') }}
                                </button>
                            </li>
                        </ul>
                    </template>
                </Popper>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, inject, onMounted } from 'vue';
import Svg from '@/Components/Svg.vue';
import FileUploadWithPreview from 'file-upload-with-preview';
import 'file-upload-with-preview/dist/file-upload-with-preview.min.css';

const rtlClass = inject('rtlClass');

const props = defineProps({
    modelValue: {
        type: [Object, String],
        default: '',
    },
    label: {
        type: String,
        default: 'name',
    },
    customClass: {
        type: String,
        default: '',
    },
    fieldName: {
        type: String,
        default: 'logo', // default to 'logo' for backward compatibility
    },
});

const logo = ref(null);

watch(() => props.modelValue, (newValue) => {
    logo.value = newValue;
});

watch(() => logo.value, (newValue) => {
    emits('update:modelValue', newValue);
});

const inetilizeAvatar = () => {
    new FileUploadWithPreview(props.fieldName, {
        images: {
            baseImage: logo.value || '/assets/images/avatar.png',
        },
    });
}

const imageProfile = ref(null);
const uploadImage = () => {
    imageProfile.value.click();
};

const handleFileInput = (event) => {
    const file = event.target.files[0];
    if (file) {
        logo.value = file;
        form.value[props.fieldName] = file;
        form.value[`remove_${props.fieldName}`] = false;
        emits('update:modelValue', file);
        emits('update:form', form.value);
    }
};

const emits = defineEmits(['update:modelValue', 'update:form']);

const form = ref({});

// Initialize form with dynamic field names
const initializeForm = () => {
    form.value[props.fieldName] = '';
    form.value[`remove_${props.fieldName}`] = false;
};

const removeImage = () => {
    form.value[props.fieldName] = '';
    form.value[`remove_${props.fieldName}`] = true;
    logo.value = '';
    if (imageProfile.value) {
        imageProfile.value.value = '';
    }
    inetilizeAvatar();

    emits('update:modelValue', form.value[props.fieldName]);
    emits('update:form', form.value);
};

onMounted(() => {
    initializeForm();
    logo.value = props.modelValue;
    setTimeout(() => {
        inetilizeAvatar();
    }, 100);
});

</script>