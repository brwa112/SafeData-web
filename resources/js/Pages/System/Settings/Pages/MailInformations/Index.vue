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
                        <span>{{ $t('system.mail_information') }}</span>
                    </li>
                </ul>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <button @click="save" :disabled="form.processing" type="button" class="btn btn-primary">
                    <Spinner v-if="form.processing" />
                    {{ $t('system.save_changes') }}
                </button>
            </div>
        </div>

        <div class="pt-4 space-y-4">
            <div class="panel">
                <div class="mb-5 flex items-center justify-between">
                    <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.contact') }}</h5>
                    <!-- <label class="relative h-6 w-12">
                <input v-model="form.is_active" type="checkbox" class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" />
                <span class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
            </label> -->
                </div>

                <form class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                    <!-- mailer  -->
                    <div>
                        <label>{{ $t('system.mailer') }}</label>
                        <input v-model="form.mailer" type="email" class="form-input" />
                        <div class="mt-1 text-sm text-danger" v-if="form.errors['mailer']" v-html="form.errors['mailer']">
                        </div>
                    </div>

                    <!-- host  -->
                    <div>
                        <label>{{ $t('system.host') }}</label>
                        <input v-model="form.host" type="email" class="form-input" />
                        <div class="mt-1 text-sm text-danger" v-if="form.errors['host']" v-html="form.errors['host']">
                        </div>
                    </div>

                    <!-- port  -->
                    <div>
                        <label>{{ $t('system.port') }}</label>
                        <input v-model="form.port" type="email" class="form-input" />
                        <div class="mt-1 text-sm text-danger" v-if="form.errors['port']" v-html="form.errors['port']">
                        </div>
                    </div>
                    <div>
                        <label>{{ $t('system.username') }}</label>
                        <input v-model="form.username" type="email" class="form-input" />
                        <div class="mt-1 text-sm text-danger" v-if="form.errors['username']"
                            v-html="form.errors['username']">
                        </div>
                    </div>

                    <!-- password  -->
                    <div>
                        <label>{{ $t('system.password') }}</label>
                        <input v-model="form.password" type="email" class="form-input" />
                        <div class="mt-1 text-sm text-danger" v-if="form.errors['password']"
                            v-html="form.errors['password']">
                        </div>
                    </div>

                    <!-- encryption  -->
                    <div>
                        <label>{{ $t('system.encryption') }}</label>
                        <input v-model="form.encryption" type="email" class="form-input" />
                        <div class="mt-1 text-sm text-danger" v-if="form.errors['encryption']"
                            v-html="form.errors['encryption']">
                        </div>
                    </div>

                    <!-- from address  -->
                    <div>
                        <label>{{ $t('system.from_address') }}</label>
                        <input v-model="form.from_address" type="email" class="form-input" />
                        <div class="mt-1 text-sm text-danger" v-if="form.errors['from_address']"
                            v-html="form.errors['from_address']">
                        </div>
                    </div>

                    <!-- from name  -->
                    <div>
                        <label>{{ $t('system.from_name') }}</label>
                        <input v-model="form.from_name" type="email" class="form-input" />
                        <div class="mt-1 text-sm text-danger" v-if="form.errors['from_name']"
                            v-html="form.errors['from_name']">
                        </div>
                    </div>
                </form>
            </div>
            <div
                class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-[#d3d3d3] dark:border-[#1b2e4b] p-3 -mx-6">
                <div class="flex flex-wrap items-center justify-end gap-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <Link :href="route('control.system.settings') + '#pages'"
                            class="btn btn-sm btn-outline-secondary">
                            {{ $t('common.back') }}
                        </Link>
                        <button @click="save" :disabled="form.processing" type="button"
                            class="btn btn-sm btn-primary sm:min-w-[120px]">
                            <Spinner v-if="form.processing" />
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
import Spinner from '@/Components/Spinner.vue';
import { trans } from 'laravel-vue-i18n';

const props = defineProps([
    'mail_Information',
]);

const $helpers = inject('helpers');
const page = usePage();

const form = useForm({
    mailer: props.mail_Information?.mailer || '',
    host: props.mail_Information?.host || '',
    port: props.mail_Information?.port || '',
    username: props.mail_Information?.username || '',
    password:  '',
    encryption: props.mail_Information?.encryption || '',
    from_address: props.mail_Information?.from_address || '',
    from_name: props.mail_Information?.from_name || '',
});



const save = () => {
    form.transform((data) => ({
        ...data,
    })).put(route('control.system.settings.mail-information.update'), {
        preserveScroll: true,
        preserveState: true,
        onError: (errors) => {
            $helpers.toast(trans('system.fix_errors_in_section', { section: trans('system.mail_information') }), 'error');
        },
        onSuccess: () => {
            $helpers.toast(trans('system.section_updated'), 'success');
        }
    });
}

</script>
