<template>
    <div class="fixed inset-x-0 top-0 shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] z-50"
        :class="{ 'dark text-white-dark': store.semidark }">
        <div class="relative bg-white flex w-full items-center gap-2 px-5 py-3 dark:bg-[#0e1726]">
            <div class="horizontal-logo flex justify-between items-center ltr:mr-2 rtl:ml-2">
                <div class="main-logo flex items-center shrink-0">
                    <img class="w-8 ml-[5px] flex-none" :src="'/assets/images/safelogo.png'" alt="" />
                    <h1
                        class="text-xl ms-2 font-bold leading-none align-middle uppercase inline text-white dark:text-white-light">
                        {{ $t('common.logo') }}
                    </h1>
                </div>
            </div>
            <div class="flex-1 flex items-center gap-2 dark:text-[#d0d2d6]">

                <div class="flex-1 flex items-center gap-3">

                    <div class="w-full lg:w-10/12 mx-auto flex items-center gap-2">
                        <!-- Collapse Menu -->
                        <button type="button"
                            class="collapse-icon flex-none duration-200 dark:text-[#d0d2d6] hover:text-primary dark:hover:text-primary flex ms-4 p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:bg-white-light/90 dark:hover:bg-dark/60"
                            @click="toggleSidebar">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>

                        <!-- Search -->
                        <!-- <div class="sm:w-full bg-gray-50 bg-opacity-5 rounded-full p-2 sm:p-0 sm:px-2">

                            <form
                                class="sm:relative absolute inset-x-0 sm:top-0 top-1/2 sm:translate-y-0 -translate-y-1/2 mx-0 z-40 sm:block hidden"
                                :class="{ '!block': search }" @submit.prevent="search = false">
                                <div class="relative">
                                    <input type="text"
                                        class="form-input px-4 sm:px-1 py-2 !ps-10 sm:!ps-9 rounded-none lg:min-w-56 text-sm bg-white dark:bg-text-gray-800 sm:bg-transparent dark:sm:bg-transparent focus:right-0 focus:outline-none border-transparent dark:border-transparent focus:border-1 focus:border-transparent dark:focus:border-transparent"
                                        :placeholder="$t('nav.search')" />
                                    <div
                                        class="hidden sm:block absolute size-5 top-1/2 -translate-y-1/2 start-2 appearance-none peer-focus:text-primary">
                                        <Svg name="search" class="size-5"></Svg>
                                    </div>
                                    <button type="button" @click="search = !search"
                                        class="block sm:hidden absolute size-5 top-1/2 -translate-y-1/2 start-2 appearance-none peer-focus:text-primary">
                                        <Svg name="close" class="size-5"></Svg>
                                    </button>
                                </div>
                            </form>

                            <button type="button"
                                class="search_btn flex items-center justify-center sm:hidden rounded-full bg-white-light/40 dark:bg-dark/40 hover:bg-white-light/90 dark:hover:bg-dark/60"
                                @click="search = !search">
                                <Svg name="search" class="size-5"></Svg>
                            </button>
                        </div> -->
                    </div>
                </div>

                <div class="flex items-center gap-2">

                    <!-- User Profile -->
                    <div class="dropdown shrink-0">
                        <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="8"
                            class="!block align-middle" @open:popper="isProfilePopperOpen = true"
                            @close:popper="isProfilePopperOpen = false">
                            <button type="button" class="relative group block">
                                <div class="flex items-center px-1 py-1">
                                    <div class="flex-none">
                                        <img class="rounded-full size-9 object-cover" alt="avatar"
                                            :src="$page.props.auth.user.avatar || '/assets/images/avatar.png'" />
                                    </div>
                                    <div
                                        class="ps-7 pe-2 py-0.5 -ms-5 hidden md:flex items-center gap-5 text-start bg-gray-50 bg-opacity-5 rounded-e-full">
                                        <div class="block -space-y-0.5">
                                            <h4 class="text-xs font-bold">
                                                {{ $page.props.auth.user.name }}
                                            </h4>
                                            <p class="text-black/60 dark:text-dark-light/60" style="font-size: 10px;">
                                                {{ $page.props.auth.user.email }}
                                            </p>
                                        </div>
                                        <Svg name="arrow_left" class="size-5 duration-200 -rotate-90"
                                            :class="{ 'rotate-0': isProfilePopperOpen }"></Svg>
                                    </div>
                                </div>
                            </button>
                            <template #content="{ close }">
                                <ul
                                    class="text-dark dark:text-gray-200 !py-0 !mt-2 w-[230px] font-semibold dark:text-white-light/90">
                                    <li>
                                        <div class="flex items-center px-4 py-4">
                                            <div class="flex-none">
                                                <img class="rounded-md w-10 h-10 object-cover"
                                                    :src="$page.props.auth.user.avatar || '/assets/images/avatar.png'"
                                                    alt="avatar" />
                                            </div>
                                            <div class="ltr:pl-4 rtl:pr-4 truncate">
                                                <h4 class="text-base">
                                                    {{ $page.props.auth.user.name }}
                                                </h4>
                                                <p class="text-black/60 dark:text-dark-light/60" style="font-size: 14px;">
                                                    {{ $page.props.auth.user.email }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <Link :href="route('control.profile')" class="dark:hover:text-white" @click="close()">
                                        <Svg name="user_outline" class="size-4.5 ltr:mr-2 rtl:ml-2 shrink-0"></Svg>

                                        {{ $t('nav.profile') }}
                                        </Link>
                                    </li>

                                    <!-- Logout -->
                                    <li class="border-t border-white-light dark:border-white-light/10">
                                        <button type="button" @click="openLogout(), close()" class="text-danger !py-3">
                                            <Svg name="logout"
                                                class="size-4.5 ltr:mr-2 rtl:ml-2 rotate-90 shrink-0"></Svg>

                                            {{ $t('nav.sign_out') }}
                                        </button>
                                        <TransitionRoot appear :show="isOpenLogout" as="template">
                                            <Dialog as="div" @close="closeLogout">
                                                <TransitionChild as="template" enter="duration-300 ease-out"
                                                    enter-from="opacity-0" enter-to="opacity-100"
                                                    leave="duration-200 ease-in" leave-from="opacity-100"
                                                    leave-to="opacity-0">
                                                    <div class="fixed inset-0 z-50 bg-black/25 dark:bg-black/55" />
                                                </TransitionChild>

                                                <div class="fixed inset-0 z-[60] overflow-y-auto">
                                                    <div class="flex min-h-full items-center justify-center p-4">
                                                        <TransitionChild as="template" enter="duration-300 ease-out"
                                                            enter-from="opacity-0 scale-95"
                                                            enter-to="opacity-100 scale-100"
                                                            leave="duration-200 ease-in"
                                                            leave-from="opacity-100 scale-100"
                                                            leave-to="opacity-0 scale-95">
                                                            <DialogPanel
                                                                class="w-full max-w-md transform overflow-hidden rounded-lg bg-white dark:bg-[#182438] p-6 shadow-xl transition-all">
                                                                <DialogTitle as="h3"
                                                                    class="text-lg font-medium leading-6 text-gray-900 dark:text-info-light">
                                                                    {{ $t('nav.sign_out') }}
                                                                </DialogTitle>
                                                                <div class="mt-2">
                                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                                        {{ $t('nav.sign_out_message') }}
                                                                    </p>
                                                                </div>

                                                                <div class="mt-4 flex gap-3">
                                                                    <button type="button"
                                                                        class="inline-flex justify-center rounded-md border border-transparent duration-300 bg-blue-100 dark:bg-blue-500 px-4 py-2 text-sm font-medium text-blue-900 dark:text-gray-100 hover:bg-blue-200 dark:hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                                                        @click="closeLogout">
                                                                        {{ $t('common.cancel') }}
                                                                    </button>
                                                                    <Link :href="route('auth.logout')"
                                                                        class="inline-flex justify-center rounded-md border border-transparent duration-300 bg-red-100 dark:bg-red-500 px-4 py-2 text-sm font-medium text-red-900 dark:text-gray-100 hover:bg-red-200 dark:hover:bg-red-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2"
                                                                        @click="closeLogout">
                                                                    {{ $t('nav.sign_out') }}
                                                                    </Link>
                                                                </div>
                                                            </DialogPanel>
                                                        </TransitionChild>
                                                    </div>
                                                </div>
                                            </Dialog>
                                        </TransitionRoot>
                                    </li>
                                </ul>
                            </template>
                        </Popper>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed, reactive, watch, inject } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Menu, MenuItem, MenuButton, MenuItems } from '@headlessui/vue';
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'
import { getDefaultSettings } from '@/settings.js';
import { loadLanguageAsync } from 'laravel-vue-i18n';


const settings = getDefaultSettings()
const emits = defineEmits();
const page = usePage()

const search = ref(false);

const isProfilePopperOpen = ref(false);

const store = reactive({
    semidark: settings.semidark,
    isDarkMode: settings.isDarkMode,
    theme: inject('theme'),
    rtlClass: inject('rtlClass'),
    // languageList: languageList,
});

const toggleSidebar = () => {
    emits('toggleSidebar');
};

const isOpenLogout = ref(false)

function closeLogout() {
    isOpenLogout.value = false
}
function openLogout() {
    isOpenLogout.value = true
}
</script>
