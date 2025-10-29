<template>
    <div class="panel">
        <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.message') }}</h5>
            <label class="relative h-6 w-12">
                <input v-model="form.is_active" type="checkbox"
                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" />
                <span
                    class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
            </label>
        </div>

        <form class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <div class="space-y-4">
                <div>
                    <label>{{ $t('system.description') }} ({{ $t(`system.${selectLanguage.slug}`) }})</label>
                    <textarea v-model="form.description[selectLanguage.slug]" class="form-input h-28"></textarea>
                    <div class="mt-1 text-sm text-danger" v-if="form.errors['description.' + selectLanguage.slug]" v-html="form.errors['description.' + selectLanguage.slug]"></div>
                </div>

                <div>
                    <label>{{ $t('system.author') }} ({{ $t(`system.${selectLanguage.slug}`) }})</label>
                    <input v-model="form.author[selectLanguage.slug]" type="text" class="form-input" />
                        <div class="mt-1 text-sm text-danger" v-if="form.errors['author.' + selectLanguage.slug]" v-html="form.errors['author.' + selectLanguage.slug]"></div>
                </div>
            </div>

            <div>
                <label>{{ $t('system.author_image') }}</label>
                <ImageUpload v-model="form.image" field-name="author_image"
                    @update:form="(data) => { if (data.remove_author_image !== undefined) form.remove_author_image = data.remove_author_image; }" />
                    <div class="mt-2 text-sm text-danger" v-if="form.errors['author_image']" v-html="form.errors['author_image']"></div>
            </div>
        </form>
    </div>
</template>

<script setup>
import ImageUpload from '@/Components/Inputs/ImageUpload.vue';

const props = defineProps({ form: { type: Object, required: true }, selectLanguage: { type: Object, required: true } });
</script>
