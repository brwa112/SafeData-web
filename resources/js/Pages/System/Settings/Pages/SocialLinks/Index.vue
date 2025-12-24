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
                        <Link :href="route('control.system.settings') + '#pages'"
                            class="duration-200 hover:text-primary">
                            {{ $t("system.pages") }}
                        </Link>
                    </li>
                    <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                        <span>{{ $t('system.social_links') }}</span>
                    </li>
                </ul>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <button @click="saveAllSections" :disabled="linksForm.processing" type="button" class="btn btn-primary">
                    <Spinner v-if="linksForm.processing" />
                    {{ $t('system.save_changes') }}
                </button>
            </div>
        </div>

        <div class="pt-4 space-y-4">
            <!-- Social Links / Contact Section -->
            <SocialLinks :form="linksForm" />

            <PhoneNumbers :phone_numbers="props.phone_numbers" />

            <div
                class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-[#d3d3d3] dark:border-[#1b2e4b] p-3 -mx-6">
                <div class="flex flex-wrap items-center justify-end gap-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <Link :href="route('control.system.settings') + '#pages'"
                            class="btn btn-sm btn-outline-secondary">
                            {{ $t('common.back') }}
                        </Link>
                        <button @click="saveAllSections" :disabled="linksForm.processing" type="button"
                            class="btn btn-sm btn-primary sm:min-w-[120px]">
                            <Spinner v-if="linksForm.processing" />
                            {{ $t('system.save_changes') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- {{ links }} -->
</template>

<script setup>
import { inject, ref, watch, computed } from 'vue';
import { Head, Link, useForm, router, usePage } from '@inertiajs/vue3';
import Spinner from '@/Components/Spinner.vue';
import { trans } from 'laravel-vue-i18n';

import SocialLinks from './Partials/SocialLinks.vue';
import PhoneNumbers from './Partials/PhoneNumbers.vue';

const props = defineProps([
    'links',
    'phone_numbers',
]);

const $helpers = inject('helpers');
const page = usePage();

const linksForm = useForm({
    facebook: props.links?.facebook || '',
    instagram: props.links?.instagram || '',
    telegram: props.links?.telegram || '',
    whatsapp: props.links?.whatsapp || '',
    email: props.links?.email || '',
});

const saveAllSections = () => {
    linksForm.transform((data) => ({
        ...data,
    })).put(route('control.system.settings.social-links.update'), {
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

</script>
