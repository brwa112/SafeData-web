<template>
    <Head>
        <title>{{ $t('system.calendar') }}</title>
    </Head>

    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <div class="flex whitespace-nowrap">
                <ul class="flex flex-wrap space-x-2 rtl:space-x-reverse">
                    <li class="text-gray-400">
                        <span>{{ $t('system.system') }}</span>
                    </li>
                    <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                        <Link :href="route('control.system.settings') + '#pages'" class="duration-200 hover:text-primary">
                        {{ $t("system.pages") }}
                        </Link>
                    </li>
                    <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                        <span>{{ $t('system.calendar') }}</span>
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
                <button @click="saveAllSections" :disabled="academicForm.processing" type="button" class="btn btn-primary">
                    <Spinner v-if="academicForm.processing" />
                    {{ $t('system.save_changes') }}
                </button>
            </div>
        </div>

        <div class="pt-4 space-y-4">

            <!-- Academic Section -->
            <AcademicSection :form="academicForm" :selectLanguage="selectLanguage" />

            <!-- Official Section -->
            <OfficialSection :form="officialForm" :selectLanguage="selectLanguage" />

            <!-- Important Section -->
            <ImportantSection :form="importantForm" :selectLanguage="selectLanguage" />

            <!-- Bottom Actions -->
            <div
                class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-[#d3d3d3] dark:border-[#1b2e4b] p-3 -mx-6">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <!-- <span class="hidden md:block">{{ $t('system.select_language') }}</span> -->
                        <CustomMultiSelect v-model="selectBranch" :list="branchList" label="label" value="id"
                            :showValue="false" :require-selection="true" :isTrans="false" />
                        <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                            :showValue="false" parent-key="system" placeholder="languages" :require-selection="true" />
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <Link :href="route('control.system.settings') + '#pages'" class="btn btn-sm btn-outline-secondary">
                        {{ $t('common.back') }}
                        </Link>
                        <button @click="saveAllSections" :disabled="academicForm.processing" type="button"
                            class="btn btn-sm btn-primary sm:min-w-[120px]">
                            <Spinner v-if="academicForm.processing" />
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

// Import partial components
import AcademicSection from './Partials/AcademicSection.vue';
import OfficialSection from './Partials/OfficialSection.vue';
import ImportantSection from './Partials/ImportantSection.vue';

const props = defineProps([
    'academic',
    'official',
    'important',
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
    router.visit(route('control.system.pages.calendar.index'), {
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

// Academic Section Form
const academicForm = useForm({
    description: $helpers.parseTranslation(props.academic?.description),
    activities: $helpers.parseTranslation(props.academic?.activities) || { en: [], ckb: [], ar: [] },
    is_active: props.academic?.is_active || false,
});

// Official Section Form
const officialForm = useForm({
    description: $helpers.parseTranslation(props.official?.description),
    holidays: $helpers.parseTranslation(props.official?.holidays) || { en: [], ckb: [], ar: [] },
    is_active: props.official?.is_active || false,
});

// Important Section Form
const importantForm = useForm({
    events: $helpers.parseTranslation(props.important?.events) || { en: [], ckb: [], ar: [] },
    is_active: props.important?.is_active || false,
});

const saveAllSections = () => {
    academicForm.transform((data) => ({
        ...data,
        description: $helpers.toPlain(data.description),
        activities: $helpers.toPlain(data.activities),
        branch_id: selectBranch.value?.id,
    })).post(route('control.system.pages.calendar.academic.update'), {
        preserveScroll: true,
        preserveState: true,
        onError: (errors) => {
            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('frontend.calendar.academic_title') }), 'error');
            console.error('Academic Section Errors:', errors);
        },
        onSuccess: () => {
            // Save Official
            officialForm.transform((data) => ({
                ...data,
                description: $helpers.toPlain(data.description),
                holidays: $helpers.toPlain(data.holidays),
                branch_id: selectBranch.value?.id,
            })).post(route('control.system.pages.calendar.official.update'), {
                preserveScroll: true,
                preserveState: true,
                onError: (errors) => {
                    $helpers.toast(trans('system.fix_errors_in_section', { section: trans('frontend.calendar.official_title') }), 'error');
                    console.error('Official Section Errors:', errors);
                },
                onSuccess: () => {
                    // Save Important
                    importantForm.transform((data) => ({
                        ...data,
                        events: $helpers.toPlain(data.events),
                        branch_id: selectBranch.value?.id,
                    })).post(route('control.system.pages.calendar.important.update'), {
                        preserveScroll: true,
                        preserveState: true,
                        onError: (errors) => {
                            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('frontend.calendar.important_title') }), 'error');
                            console.error('Important Section Errors:', errors);
                        },
                        onSuccess: () => {
                            $helpers.toast(trans('system.section_updated'), 'success');
                        }
                    });
                }
            });
        }
    });
};
</script>
