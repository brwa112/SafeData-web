<template>
    <div class="panel">
        <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.home_history') }}</h5>
            <label class="relative h-6 w-12">
                <input v-model="form.is_active" type="checkbox"
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
                    <textarea v-model="form.description[selectLanguage.slug]" id="history_description"
                        rows="9" class="form-textarea"></textarea>
                    <div class="mt-1 text-sm text-danger"
                        v-if="form.errors['description.' + selectLanguage.slug]"
                        v-html="form.errors['description.' + selectLanguage.slug]">
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label>{{ $t('system.image') }} 1</label>
                        <ImageUpload v-model="form.image_1" field-name="history_image_1"
                            @update:form="(data) => { if (data.remove_history_image_1 !== undefined) form.remove_history_image_1 = data.remove_history_image_1; }" />
                    </div>
                    <div>
                        <label>{{ $t('system.image') }} 2</label>
                        <ImageUpload v-model="form.image_2" field-name="history_image_2"
                            @update:form="(data) => { if (data.remove_history_image_2 !== undefined) form.remove_history_image_2 = data.remove_history_image_2; }" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import ImageUpload from '@/Components/Inputs/ImageUpload.vue';

defineProps({
    form: {
        type: Object,
        required: true
    },
    selectLanguage: {
        type: Object,
        required: true
    }
});
</script>