<template>
    <Head>
        <title>{{ $t('system.about') }}</title>
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
                        <span>{{ $t('system.about') }}</span>
                    </li>
                </ul>
            </div>
            <div class="flex items-center gap-2">
                <CustomMultiSelect v-model="selectBranch" :list="branchList" label="label" value="id" :showValue="false"
                    :require-selection="true" :isTrans="false" />
                <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                    :showValue="false" parent-key="system" placeholder="languages" :require-selection="true" />
                <button @click="saveAllSections" type="button" class="btn btn-primary">
                    <span>{{ $t('system.save_changes') }}</span>
                </button>
            </div>
        </div>

        <div class="pt-4 space-y-4">

            <!-- About Section -->
            <AboutSection :form="aboutForm" :selectLanguage="selectLanguage" />

            <!-- Message Section -->
            <MessageSection :form="messageForm" :selectLanguage="selectLanguage" />

            <!-- Mission Section -->
            <MissionSection :form="missionForm" :selectLanguage="selectLanguage" />

            <!-- Touch / Contact Section -->
            <TouchSection :form="touchForm" :selectLanguage="selectLanguage" />

            <div class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-[#d3d3d3] dark:border-[#1b2e4b] p-3 -mx-6">
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
                        <button @click="saveAllSections" :disabled="aboutForm.processing" type="button"
                            class="btn btn-sm btn-primary sm:min-w-[120px]">
                            <Spinner v-if="aboutForm.processing" />
                            {{ $t('system.save_changes') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, ref, watch, computed } from 'vue';
import { Head, Link, useForm, router, usePage } from '@inertiajs/vue3';
import CustomMultiSelect from '@/Components/Inputs/CustomMultiSelect.vue';
import Spinner from '@/Components/Spinner.vue';
import { trans } from 'laravel-vue-i18n';

// Import partial components (we'll add these next)
import AboutSection from './Partials/AboutSection.vue';
import MessageSection from './Partials/MessageSection.vue';
import MissionSection from './Partials/MissionSection.vue';
import TouchSection from './Partials/TouchSection.vue';

const props = defineProps([
    'about',
    'message',
    'mission',
    'touch',
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

const selectBranch = ref(branchList.value.find(b => Number(b.id) === Number(page.props.ziggy.query.branch_id)) ?? branchList.value[0]);

watch(() => selectBranch.value, () => {
    const branchId = selectBranch.value?.id;
    const lang = selectLanguage.value?.slug;
    router.visit(route('control.system.pages.about.index'), {
        method: 'get',
        data: { branch_id: branchId, lang },
        preserveState: false,
        preserveScroll: true,
    });
}, { deep: true });

watch(() => page.props.selectedBranch, (newSelected) => {
    if (!newSelected) return;
    const found = branchList.value.find(b => b.id === newSelected.id);
    if (found) {
        selectBranch.value = found;
    } else if (branchList.value.length > 0) {
        selectBranch.value = branchList.value[0];
    }
}, { immediate: true });


const aboutForm = useForm({
    // only description, images and is_active exist in the current schema
    description: $helpers.parseTranslation(props.about?.description),
    // single image: use first item from the images array if present
    image: props.about?.image || null,
    remove_image: false,
    is_active: props.about?.is_active || false,
});

// media removed from About page: mediaForm intentionally omitted

const messageForm = useForm({
    description: $helpers.parseTranslation(props.message?.description),
    author: $helpers.parseTranslation(props.message?.author),
    order: props.message?.order ?? 0,
    image: props.message?.author_image || null,
    remove_author_image: false,
    is_active: props.message?.is_active || false,
});

const missionForm = useForm({
    description: $helpers.parseTranslation(props.mission?.description),
    is_active: props.mission?.is_active || false,
});

const touchForm = useForm({
    contact_email: props.touch?.contact_email || '',
    contact_phone: props.touch?.contact_phone || '',
    contact_address: $helpers.parseTranslation(props.touch?.contact_address),
    map_iframe: props.touch?.map_iframe || '',
    is_active: props.touch?.is_active || false,
});

const saveAllSections = () => {
    aboutForm.transform((data) => ({
        ...data,
        description: $helpers.toPlain(data.description),
        branch_id: selectBranch.value?.id,
    })).post(route('control.system.pages.about.about.update'), {
        preserveScroll: true,
        preserveState: true,
        onError: (errors) => {
            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.about') }), 'error');
            console.error('About Errors:', errors);
        },
        onSuccess: () => {
            // proceed to message section
            messageForm.transform((data) => ({
                ...data,
                description: $helpers.toPlain(data.description),
                author: $helpers.toPlain(data.author),
                order: data.order,
                branch_id: selectBranch.value?.id,
            })).post(route('control.system.pages.about.message.update'), {
                preserveScroll: true,
                preserveState: true,
                onError: (errors) => {
                    $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.message') }), 'error');
                },
                onSuccess: () => {
                    missionForm.transform((data) => ({
                        ...data,
                        description: $helpers.toPlain(data.description),
                        branch_id: selectBranch.value?.id,
                    })).post(route('control.system.pages.about.mission.update'), {
                        preserveScroll: true,
                        preserveState: true,
                        onError: (errors) => {
                            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.mission') }), 'error');
                        },
                        onSuccess: () => {
                            touchForm.transform((data) => ({
                                ...data,
                                contact_address: $helpers.toPlain(data.contact_address),
                                map_iframe: data.map_iframe,
                                branch_id: selectBranch.value?.id,
                            })).post(route('control.system.pages.about.touch.update'), {
                                preserveScroll: true,
                                preserveState: true,
                                onError: (errors) => {
                                    $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.touch') }), 'error');
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
};

// (gallery navigation is handled via dedicated Gallery admin page)
</script>
