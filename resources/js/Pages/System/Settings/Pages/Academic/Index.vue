<template>
    <Head>
        <title>{{ $t('system.academic') }}</title>
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
                        <span>{{ $t('system.academic') }}</span>
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

            <!-- Choose Section -->
            <ChooseSection :form="chooseForm" :selectLanguage="selectLanguage" />

            <!-- Approach Section -->
            <ApproachSection :form="approachForm" :selectLanguage="selectLanguage" />

            <!-- Bottom Actions -->
            <div
                class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-[#d3d3d3] dark:border-[#1b2e4b] p-3 -mx-6">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div class="flex items-center gap-3">
                        <span class="hidden md:block">{{ $t('system.select_language') }}</span>
                        <CustomMultiSelect v-model="selectBranch" :list="branchList" label="label" value="id"
                            :showValue="false" :require-selection="true" :isTrans="false" />
                        <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                            :showValue="false" parent-key="system" placeholder="languages" :require-selection="true" />
                    </div>
                    <div class="flex items-center gap-3">
                        <Link :href="route('control.system.settings')" class="btn btn-sm btn-outline-secondary">
                        {{ $t('common.back') }}
                        </Link>
                        <button @click="saveAllSections" :disabled="chooseForm.processing" type="button"
                            class="btn btn-sm btn-primary sm:min-w-[120px]">
                            <Spinner v-if="chooseForm.processing" />
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
import ChooseSection from './Partials/ChooseSection.vue';
import ApproachSection from './Partials/ApproachSection.vue';

const props = defineProps([
    'choose',
    'approach',
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
    router.visit(route('control.system.pages.academic.index'), {
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

// Choose Section Form
const chooseForm = useForm({
    description: $helpers.parseTranslation(props.choose?.description),
    reasons: $helpers.parseTranslation(props.choose?.reasons) || { en: [], ckb: [] },
    is_active: props.choose?.is_active || false,
});

// Approach Section Form
const approachForm = useForm({
    description: $helpers.parseTranslation(props.approach?.description),
    features: $helpers.parseTranslation(props.approach?.features) || { en: [], ckb: [] },
    is_active: props.approach?.is_active || false,
});

const saveAllSections = () => {
    chooseForm.transform((data) => ({
        ...data,
        description: $helpers.toPlain(data.description),
        reasons: $helpers.toPlain(data.reasons),
        branch_id: selectBranch.value?.id,
    })).post(route('control.system.pages.academic.choose.update'), {
        preserveScroll: true,
        preserveState: true,
        onError: (errors) => {
            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.choose_section') }), 'error');
            console.error('Choose Section Errors:', errors);
        },
        onSuccess: () => {
            // Save Approach
            approachForm.transform((data) => ({
                ...data,
                description: $helpers.toPlain(data.description),
                features: $helpers.toPlain(data.features),
                branch_id: selectBranch.value?.id,
            })).post(route('control.system.pages.academic.approach.update'), {
                preserveScroll: true,
                preserveState: true,
                onError: (errors) => {
                    $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.approach_section') }), 'error');
                    console.error('Approach Section Errors:', errors);
                },
                onSuccess: () => {
                    $helpers.toast(trans('system.section_updated'), 'success');
                }
            });
        }
    });
};
</script>
