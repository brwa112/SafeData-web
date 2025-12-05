<template>
    <Head>
        <title>{{ $t('system.admission') }}</title>
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
                        <span>{{ $t('system.admission') }}</span>
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
                <button @click="saveAllSections" :disabled="policyForm.processing" type="button" class="btn btn-primary">
                    <Spinner v-if="policyForm.processing" />
                    {{ $t('system.save_changes') }}
                </button>
            </div>
        </div>

        <div class="pt-4 space-y-4">
            <!-- Policy Section -->
            <PolicySection :form="policyForm" :selectLanguage="selectLanguage" />

            <!-- Documents Section -->
            <DocumentsSection :form="documentsForm" :selectLanguage="selectLanguage" />

            <!-- Bottom Actions -->
            <div
                class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-[#d3d3d3] dark:border-[#1b2e4b] p-3 -mx-6">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <!-- <span class="hidden md:block">{{ $t('system.select_language') }}</span> -->
                        <CustomMultiSelect v-model="selectBranch" :list="branchList" label="label" value="id"
                            :showValue="false" :require-selection="true" :isTrans="false" buttonStyle="max-w-32" />
                        <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                            :showValue="false" parent-key="system" placeholder="languages" :require-selection="true" />
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <Link :href="route('control.system.settings') + '#pages'" class="btn btn-sm btn-outline-secondary">
                        {{ $t('common.back') }}
                        </Link>
                        <button @click="saveAllSections" :disabled="policyForm.processing" type="button"
                            class="btn btn-sm btn-primary sm:min-w-[120px]">
                            <Spinner v-if="policyForm.processing" />
                            {{ $t('system.save_changes') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, ref, computed, watch } from 'vue';
import { router, Head, Link, useForm, usePage } from '@inertiajs/vue3';
import PolicySection from './Partials/PolicySection.vue';
import DocumentsSection from './Partials/DocumentsSection.vue';
import CustomMultiSelect from '@/Components/Inputs/CustomMultiSelect.vue';
import Spinner from '@/Components/Spinner.vue';
import { trans } from 'laravel-vue-i18n';

const props = defineProps([
    'policy',
    'documents',
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
    router.visit(route('control.system.pages.admission.index'), {
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


// Helper to ensure 7 fixed cards with predefined levels
const ensureSevenCards = (steps) => {
    const parsed = $helpers.parseTranslation(steps);
    const result = {};
    
    // Fixed levels for 7 cards (English as default)
    const defaultLevels = ['First', 'Second', 'Third', 'Fourth', 'Read', 'Download', 'Message'];
    
    Languages.forEach(lang => {
        const langSlug = lang.slug;
        const existingSteps = parsed[langSlug] || [];
        
        // Always ensure exactly 7 cards with fixed levels
        result[langSlug] = Array(7).fill(null).map((_, index) => {
            const existing = existingSteps[index] || {};
            return { 
                level: existing.level || defaultLevels[index], // Use existing level or default
                title: existing.title || '' 
            };
        });
    });
    
    return result;
};

// Helper to ensure 4 fixed documents
const ensureFourDocuments = (documents) => {
    const parsed = $helpers.parseTranslation(documents);
    const result = {};
    
    Languages.forEach(lang => {
        const langSlug = lang.slug;
        const existingDocs = parsed[langSlug] || [];
        
        // Always ensure exactly 4 documents
        result[langSlug] = Array(4).fill(null).map((_, index) => {
            const existing = existingDocs[index] || {};
            return { 
                title: existing.title || '',
                icon: existing.icon || '',
                icon_preview: existing.icon || '',
                icon_file: null
            };
        });
    });
    
    return result;
};

// Initialize forms with Inertia useForm
const policyForm = useForm({
    description: $helpers.parseTranslation(props.policy?.description),
    steps: ensureSevenCards(props.policy?.steps),
    is_active: props.policy?.is_active ?? true,
});

const documentsForm = useForm({
    documents: ensureFourDocuments(props.documents?.documents),
    is_active: props.documents?.is_active ?? true,
    iconFiles: {}, // Shared icons across all languages
});

// Watch for props changes and reinitialize forms
watch(() => props.policy, (newPolicy) => {
    if (newPolicy) {
        policyForm.description = $helpers.parseTranslation(newPolicy.description);
        policyForm.steps = ensureSevenCards(newPolicy.steps);
        policyForm.is_active = newPolicy.is_active ?? true;
    }
}, { deep: true, immediate: false });

watch(() => props.documents, (newDocuments) => {
    if (newDocuments) {
        documentsForm.documents = ensureFourDocuments(newDocuments.documents);
        documentsForm.is_active = newDocuments.is_active ?? true;
        documentsForm.iconFiles = {};
    }
}, { deep: true, immediate: false });

const saveAllSections = () => {
    // Update policy
    policyForm.transform((data) => ({
        ...data,
        description: $helpers.toPlain(data.description),
        steps: $helpers.toPlain(data.steps),
        branch_id: selectBranch.value?.id,
    })).post(route('control.system.pages.admission.policy.update'), {
        preserveScroll: true,
        onError: (errors) => {
            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.policy_section') }), 'error');
            console.error('Policy Section Errors:', errors);
        },
        onSuccess: () => {
            // After policy is saved, save documents
            // Prepare documents data with file uploads
            const documentsData = {
                branch_id: selectBranch.value?.id,
                is_active: documentsForm.is_active
            };
            
            // Add documents data for each language
            Languages.forEach(lang => {
                const langSlug = lang.slug;
                documentsData[`documents_${langSlug}`] = JSON.stringify(
                    documentsForm.documents[langSlug].map(doc => ({
                        title: doc.title,
                        icon: doc.icon || ''
                    }))
                );
            });
            
            // Add shared icon files (same icon for all languages)
            if (documentsForm.iconFiles) {
                for (let i = 0; i < 4; i++) {
                    if (documentsForm.iconFiles[i]) {
                        documentsData[`icon_${i}`] = documentsForm.iconFiles[i];
                    }
                }
            }
            
            documentsForm.post(route('control.system.pages.admission.documents.update'), {
                data: documentsData,
                forceFormData: true,
                preserveScroll: true,
                onError: (errors) => {
                    $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.documents_section') }), 'error');
                    console.error('Documents Section Errors:', errors);
                },
                onSuccess: () => {
                    $helpers.toast(trans('system.section_updated'), 'success');
                }
            });
        },
    });
};
</script>
