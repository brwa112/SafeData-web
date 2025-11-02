<template>
    <TransitionRoot appear :show="showModal" as="template">
        <Dialog as="div" @close="close" class="relative z-50">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <DialogOverlay class="fixed inset-0 bg-[black]/60" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-start justify-center px-4 py-8">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="panel border-0 p-0 overflow-hidden rounded-lg w-full max-w-3xl text-black dark:text-white-dark">
                            <button type="button"
                                class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                @click="close">
                                <Svg name="close" class="size-6"></Svg>
                            </button>
                            <div
                                class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                <span v-if="form.id">
                                    {{ $t('common.edit') }}
                                </span>
                                <span v-else>
                                    {{ $t('common.new') }}
                                </span>
                                {{ $t('pages.category') }}
                            </div>
                            <div class="p-5">
                                <form @submit.prevent="submit" class="space-y-5">
                                    <!-- Language Tabs for Translations -->
                                    <div class="border-b border-gray-200 dark:border-gray-700">
                                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                                            <li v-for="lang in Languages" :key="lang.slug" class="mr-2">
                                                <button type="button" @click="selectLanguage = lang" :class="{
                                                    'border-primary text-primary': selectLanguage.slug === lang.slug,
                                                    'border-transparent': selectLanguage.slug !== lang.slug
                                                }"
                                                    class="inline-block p-2 -mt-2 text-sm font-medium border-b-2 rounded-t-lg hover:text-primary hover:border-primary">
                                                    {{ $t(`system.${lang.slug}`) }}
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Name Fields -->
                                    <div>
                                        <label :for="'name_' + selectLanguage.slug">
                                            {{ $t('common.name') }} ({{ $t(`system.${selectLanguage.slug}`) }}) <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input :id="'name_' + selectLanguage.slug" type="text"
                                            v-model="form.name[selectLanguage.slug]" :placeholder="$t('common.name')"
                                            class="form-input"
                                            :class="{ 'border border-red-300 rounded-md': form.errors['name.' + selectLanguage.slug] }" />
                                        <div class="mt-1 text-sm text-danger"
                                            v-if="form.errors['name.' + selectLanguage.slug]"
                                            v-html="form.errors['name.' + selectLanguage.slug]">
                                        </div>
                                    </div>

                                    <!-- Status Toggle -->
                                    <div>
                                        <label class="flex items-center cursor-pointer">
                                            <input v-model="form.is_active" type="checkbox"
                                                class="form-checkbox text-success" />
                                            <span class="text-white-dark ltr:ml-2 rtl:mr-2">{{ $t('common.is_active')
                                                }}</span>
                                        </label>
                                    </div>

                                    <!-- Submit Buttons -->
                                    <div class="flex justify-end items-center gap-3 pt-5 mt-8 border-t border-gray-200 dark:border-gray-700">
                                        <button type="button" class="btn btn-outline-danger" @click="close">
                                            {{ $t('common.cancel') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary" :disabled="form.processing">
                                            {{ form.processing ? $t('common.processing') : $t('common.save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';
import Svg from '@/Components/Svg.vue';

const props = defineProps({
    showModal: Boolean,
    form: Object,
});

const emit = defineEmits(['submit', 'close']);

const Languages = usePage().props.languages;
const selectLanguage = ref(Languages[0]);

const submit = () => {
    emit('submit');
};

const close = () => {
    selectLanguage.value = Languages[0];
    emit('close');
};
</script>
