<template>
    <section
        class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4 mb-[120px] mt-[96px] md:mt-[116px] lg:mt-[128px] xl:mt-[168px] min-h-[100dvh]">
        <div class="w-full flex flex-col items-center gap-y-6">
            <div class="flex-1 flex flex-col items-center space-y-1 text-center">
                <p class="!leading-4 text-base lg:text-lg xl:text-xl font-normal">
                    {{ formattedDate }}
                </p>
                <h2
                    class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight max-w-md lg:max-w-xl xl:max-w-3xl">
                    {{ title }}
                </h2>
                <p
                    class="!leading-6 text-xs lg:text-sm xl:text-base font-normal text-pretty max-w-md lg:max-w-xl xl:max-w-3xl">
                    {{ hashtags }}
                </p>
            </div>
            <div class="flex flex-col items-center gap-8 w-full lg:w-2/3">
                <img :src="featuredImage" :alt="title"
                    class="w-full h-[240px] md:h-[320px] lg:h-[400px] xl:h-[480px] 2xl:h-[640px] object-cover" />
                <div class="prose prose-lg !leading-6 text-sm lg:text-base xl:text-xl font-normal text-pretty max-w-xl xl:max-w-3xl"
                    v-html="content"></div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';
import helpers from '@/helpers';

const props = defineProps({
    news: {
        type: Object,
        required: true,
    },
});

const page = usePage();

// Computed properties for translated content
const title = computed(() => {
    return helpers.getTranslatedText(props.news.title, page.props.locale);
});

const content = computed(() => {
    return helpers.getTranslatedText(props.news.content, page.props.locale);
});

const branchName = computed(() => {
    if (props.news.branch && props.news.branch.name) {
        return helpers.getTranslatedText(props.news.branch.name, page.props.locale);
    }
    return '';
});

const categoryName = computed(() => {
    if (props.news.category && props.news.category.name) {
        return helpers.getTranslatedText(props.news.category.name, page.props.locale);
    }
    return '';
});

const hashtags = computed(() => {
    if (props.news.hashtags && props.news.hashtags.length > 0) {
        return props.news.hashtags.map(tag => '#' + helpers.getTranslatedText(tag.name, page.props.locale)).join(' ');
    }
    return '';
});

const featuredImage = computed(() => {
    if (props.news.images && props.news.images.length > 0) {
        return props.news.images[0].large || props.news.images[0].url;
    }
    return `/img/news/default.jpg`;
});

const formattedDate = computed(() => {
    if (props.news.formatted_date) {
        return props.news.formatted_date;
    }
    if (props.news.created_at) {
        return new Date(props.news.created_at).toLocaleDateString();
    }
    return '';
});

defineOptions({
    layout: PublicLayout
});
</script>
