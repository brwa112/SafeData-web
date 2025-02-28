<template>
    <header :class="{ 'dark text-white-dark': !store.semidark }">
        <div class="shadow-sm">
            <div class="relative bg-white flex w-full items-center px-5 py-3 dark:bg-[#0e1726]">
                <div class="horizontal-logo !hidden justify-between items-center ltr:mr-2 rtl:ml-2">
                    <!-- <div class="hidden md:flex items-center px-1 py-1">
                        <div class="flex-none">
                            <img class="rounded-2xl size-11 object-cover" src="/public/assets/images/user-profile.jpeg"
                                alt="" />
                        </div>
                        <div class="ltr:pl-4 rtl:pr-4">
                            <h4 class="text-sm font-bold">
                                John Doe
                                <span class="text-xs bg-success-light rounded text-success px-1 mx-1">Pro</span>
                            </h4>
                            <p class="text-black/60 dark:text-dark-light/60">
                                Admin
                            </p>
                        </div>
                    </div> -->
                    <div class="main-logo flex items-center shrink-0">
                        <img class="w-8 ml-[5px] flex-none" :src="'/assets/images/logo.svg'" alt="" />
                        <span
                            class="text-2xl ltr:ml-1.5 rtl:mr-1.5 font-semibold align-middle lg:inline dark:text-white-light">VRISTO</span>
                    </div>

                    <button type="button"
                        class="collapse-icon flex-none duration-200 dark:text-[#d0d2d6] hover:text-primary dark:hover:text-primary flex lg:hidden ms-4 p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:bg-white-light/90 dark:hover:bg-dark/60"
                        @click="toggleSidebar">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                            <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </button>
                    <div class="h-6 w-0.5 bg-gray-300 dark:bg-gray-700 rounded-full me-4 ms-8"></div>
                </div>
                <div
                    class="flex-1 ltr:sm:ml-0 ltr:ml-auto sm:rtl:mr-0 rtl:mr-auto flex items-center space-x-4 lg:space-x-8 rtl:space-x-reverse dark:text-[#d0d2d6]">

                    <div class="flex items-center gap-3 me-auto">
                        <!-- <div class="ltr:mr-2 rtl:ml-2">
                            <ul class="flex items-center space-x-2 rtl:space-x-reverse dark:text-[#d0d2d6]">
                                <li>
                                    <button type="button"
                                        class="block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60">
                                        <Svg name="calender_outline" class="size-5"></Svg>
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60">
                                        <Svg name="siderbar" class="size-5"></Svg>
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60">
                                        <Svg name="chat-notification" class="size-5"></Svg>
                                    </button>
                                </li>
                            </ul>
                        </div> -->

                        <!-- Search -->
                        <div class="sm:border border-white-light dark:border-white/10 rounded-md px-2">
                            <form
                                class="sm:relative absolute inset-x-0 sm:top-0 top-1/2 sm:translate-y-0 -translate-y-1/2 mx-0 z-40 sm:block hidden"
                                :class="{ '!block': search }" @submit.prevent="search = false">
                                <div class="relative">
                                    <input type="text"
                                        class="form-input px-4 sm:px-1 py-3.5 sm:py-1.5 !pe-10 sm:!pe-6 rounded-none lg:min-w-56 text-sm bg-white dark:bg-text-gray-800 sm:bg-transparent dark:sm:bg-transparent focus:right-0 focus:outline-none border-transparent dark:border-transparent focus:border-1 focus:border-transparent dark:focus:border-transparent"
                                        :placeholder="$t('nav.search')" />
                                    <button type="button" @click="search = !search"
                                        class="absolute size-5 top-1/2 -translate-y-1/2 end-3 sm:end-0 appearance-none peer-focus:text-primary">
                                        <svg class="size-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor"
                                                stroke-width="1.5" />
                                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                                opacity="0.5" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>
                            </form>

                            <button type="button"
                                class="search_btn flex items-center justify-center sm:hidden rounded-full bg-white-light/40 dark:bg-dark/40 hover:bg-white-light/90 dark:hover:bg-dark/60"
                                @click="search = !search">
                                <svg class="size-5 mx-auto dark:text-[#d0d2d6]" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                        opacity="0.5" />
                                    <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">

                        <!-- Language -->
                        <div class="dropdown shrink-0">
                            <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'"
                                offsetDistance="8" class="align-middle">
                                <button type="button"
                                    class="block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60">
                                    <img :src="`/assets/images/langs/${lang}.png`" alt="flag"
                                        class="w-5 h-5 object-cover rounded-full" />
                                </button>
                                <template #content="{ close }">
                                    <ul
                                        class="!px-2 !mt-2 text-dark dark:text-white-dark grid grid-cols-1 gap-1 font-semibold dark:text-white-light/90 w-96 max-w-40">
                                        <template v-for="item in store.languageList" :key="item.code">
                                            <li>
                                                <button type="button" class="w-full hover:text-primary"
                                                    :class="{ '!bg-primary/10 !text-primary': lang === item.code }"
                                                    @click="toggleDirection(item.code == 'en' ? 'ltr' : 'rtl', item.code), close()">
                                                    <img class="w-5 h-5 object-cover rounded-full"
                                                        :src="`/assets/images/langs/${item.code}.png`" />
                                                    <span class="ltr:ml-3 rtl:mr-3 capitalize">
                                                        {{ $t(`common.` + item.name) }}
                                                    </span>
                                                </button>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                            </Popper>
                        </div>

                        <!-- Mode Dark/Light -->
                        <div>
                            <button type="button" v-show="store.theme === 'dark'"
                                class="flex items-center p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                                @click="toggleTheme">
                                <icon-sun />
                            </button>
                            <button type="button" v-show="store.theme === 'light'"
                                class="flex items-center p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60"
                                @click="toggleTheme">
                                <icon-moon />
                            </button>
                        </div>

                        <!-- Messages -->
                        <div class="dropdown shrink-0">
                            <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-start' : 'bottom-end'"
                                offsetDistance="8" class="align-middle">
                                <button type="button"
                                    class="block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60">
                                    <icon-mail-dot />
                                </button>
                                <template #content="{ close }">
                                    <ul
                                        class="top-11 !py-0 !mt-2 text-dark dark:text-white-dark w-[300px] sm:w-[375px] text-xs">
                                        <li class="mb-5">
                                            <div class="overflow-hidden relative rounded-t-md !p-5 text-white">
                                                <div
                                                    class="absolute h-full w-full bg-[url('/assets/images/menu-heade.jpg')] bg-no-repeat bg-center bg-cover inset-0">
                                                </div>
                                                <h4 class="font-semibold relative z-10 text-lg">
                                                    {{ $t('nav.messages') }}
                                                </h4>
                                            </div>
                                        </li>
                                        <template v-for="msg in messages" :key="msg.id">
                                            <li>
                                                <div class="flex items-center py-3 px-5">
                                                    <div v-html="msg.image"></div>
                                                    <span class="px-3 dark:text-gray-500">
                                                        <div class="font-semibold text-sm dark:text-white-light/90"
                                                            v-text="msg.title"></div>
                                                        <div v-text="msg.message"></div>
                                                    </span>
                                                    <span
                                                        class="font-semibold bg-white-dark/20 rounded text-dark/60 px-1 ltr:ml-auto rtl:mr-auto whitespace-pre dark:text-white-dark ltr:mr-2 rtl:ml-2"
                                                        v-text="msg.time"></span>
                                                    <button type="button" class="text-neutral-300 hover:text-danger"
                                                        @click="removeMessage(msg.id)">
                                                        <icon-x-circle />
                                                    </button>
                                                </div>
                                            </li>
                                        </template>
                                        <template v-if="messages?.length">
                                            <li
                                                class="border-t border-white-light text-center dark:border-white/10 mt-5">
                                                <div class="flex items-center py-4 px-5 text-primary font-semibold group dark:text-gray-400 justify-center cursor-pointer"
                                                    @click="close()">
                                                    <span class="group-hover:underline ltr:mr-1 rtl:ml-1">VIEW ALL
                                                        ACTIVITIES</span>

                                                    <icon-arrow-left
                                                        class="group-hover:translate-x-1 transition duration-300 ltr:ml-1 rtl:mr-1" />
                                                </div>
                                            </li>
                                        </template>
                                        <template v-if="!messages?.length">
                                            <li class="mb-5">
                                                <div
                                                    class="!grid place-content-center hover:!bg-transparent text-lg min-h-[200px]">
                                                    <div
                                                        class="mx-auto ring-4 ring-primary/30 rounded-full mb-4 text-primary">
                                                        <icon-info-circle :fill="true" class="w-10 h-10" />
                                                    </div>
                                                    No data available.
                                                </div>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                            </Popper>
                        </div>

                        <!-- Notification -->
                        <div class="dropdown shrink-0">
                            <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'"
                                offsetDistance="8" class="align-middle">
                                <button type="button"
                                    class="relative block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60">
                                    <icon-bell-bing />

                                    <span class="flex absolute w-3 h-3 ltr:right-0 rtl:left-0 top-0">
                                        <span
                                            class="animate-ping absolute ltr:-left-[3px] rtl:-right-[3px] -top-[3px] inline-flex h-full w-full rounded-full bg-success/50 opacity-75"></span>
                                        <span
                                            class="relative inline-flex rounded-full w-[6px] h-[6px] bg-success"></span>
                                    </span>
                                </button>
                                <template #content="{ close }">
                                    <ul
                                        class="!py-0 !mt-2 text-dark dark:text-white-dark w-[300px] sm:w-[350px] divide-y dark:divide-white/10">
                                        <li>
                                            <div class="flex items-center px-4 py-2 justify-between font-semibold">
                                                <h4 class="text-lg">
                                                    {{ $t('nav.notifications') }}
                                                </h4>
                                                <template v-if="notifications?.length">
                                                    <span class="badge bg-primary/80"
                                                        v-text="notifications?.length + 'New'"></span>
                                                </template>
                                            </div>
                                        </li>
                                        <template v-for="notification in notifications" :key="notification.id">
                                            <li class="dark:text-white-light/90">
                                                <div class="group flex items-center px-4 py-2">
                                                    <div class="grid place-content-center rounded">
                                                        <div class="w-12 h-12 relative">
                                                            <img class="w-12 h-12 rounded-full object-cover"
                                                                :src="`/assets/images/${notification.profile}`"
                                                                alt="" />
                                                            <span
                                                                class="bg-success w-2 h-2 rounded-full block absolute right-[6px] bottom-0"></span>
                                                        </div>
                                                    </div>
                                                    <div class="ltr:pl-3 rtl:pr-3 flex flex-auto">
                                                        <div class="ltr:pr-3 rtl:pl-3">
                                                            <h6 v-html="notification.message"></h6>
                                                            <span class="text-xs block font-normal dark:text-gray-500"
                                                                v-text="notification.time"></span>
                                                        </div>
                                                        <button type="button"
                                                            class="ltr:ml-auto rtl:mr-auto text-neutral-300 hover:text-danger opacity-0 group-hover:opacity-100"
                                                            @click="removeNotification(notification.id)">
                                                            <icon-x-circle />
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        </template>
                                        <template v-if="notifications?.length">
                                            <li>
                                                <div class="p-4">
                                                    <button class="btn btn-primary block w-full btn-small"
                                                        @click="close()">Read All Notifications</button>
                                                </div>
                                            </li>
                                        </template>
                                        <template v-if="!notifications?.length">
                                            <li>
                                                <div
                                                    class="!grid place-content-center hover:!bg-transparent text-lg min-h-[200px]">
                                                    <div
                                                        class="mx-auto ring-4 ring-primary/30 rounded-full mb-4 text-primary">
                                                        <icon-info-circle :fill="true" class="w-10 h-10" />
                                                    </div>
                                                    No data available.
                                                </div>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                            </Popper>
                        </div>

                        <!-- User Profile -->
                        <div class="dropdown shrink-0">
                            <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'"
                                offsetDistance="8" class="!block align-middle">
                                <button type="button" class="relative group block">
                                    <img class="w-9 h-9 rounded-full object-cover saturate-50 group-hover:saturate-100"
                                        :src="$page.props.auth.user.avatar || '/assets/images/avatar.png'"
                                        alt="avatar" />
                                </button>
                                <template #content="{ close }">
                                    <ul
                                        class="text-dark dark:text-white-dark !py-0 !mt-2 w-[230px] font-semibold dark:text-white-light/90">
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
                                                    <p class="text-black/60 dark:text-dark-light/60">
                                                        {{ $page.props.auth.user.email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <Link href="" class="dark:hover:text-white" @click="close()">
                                            <icon-user class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0" />

                                            {{ $t('nav.profile') }}
                                            </Link>
                                        </li>
                                        <li v-if="0">
                                            <Link href="" class="dark:hover:text-white" @click="close()">
                                            <icon-mail class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0" />

                                            {{ $t('nav.inbox') }}
                                            </Link>
                                        </li>

                                        <!-- Logout -->
                                        <li class="border-t border-white-light dark:border-white-light/10">
                                            <button type="button" @click="openLogout(), close()"
                                                class="text-danger !py-3">
                                                <icon-logout class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 rotate-90 shrink-0" />

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
                                                                        <p
                                                                            class="text-sm text-gray-500 dark:text-gray-400">
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
    </header>
</template>

<script setup>
import { ref, onMounted, computed, reactive, watch, inject } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Menu, MenuItem, MenuButton, MenuItems } from '@headlessui/vue';
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'
import { getDefaultSettings } from '@/settings.js';
import { loadLanguageAsync } from 'laravel-vue-i18n';

import IconCalendar from '@/components/icon/icon-calendar.vue';
import IconEdit from '@/components/icon/icon-edit.vue';
import IconChatNotification from '@/components/icon/icon-chat-notification.vue';
import IconSun from '@/components/icon/icon-sun.vue';
import IconMoon from '@/components/icon/icon-moon.vue';
import IconMailDot from '@/components/icon/icon-mail-dot.vue';
import IconBellBing from '@/components/icon/icon-bell-bing.vue';
import IconXCircle from '@/components/icon/icon-x-circle.vue';
import IconArrowLeft from '@/components/icon/icon-arrow-left.vue';
import IconInfoCircle from '@/components/icon/icon-info-circle.vue';
import IconUser from '@/components/icon/icon-user.vue';
import IconMail from '@/components/icon/icon-mail.vue';
import IconLockDots from '@/components/icon/icon-lock-dots.vue';
import IconLogout from '@/components/icon/icon-logout.vue';


const settings = getDefaultSettings()
const emits = defineEmits();

const search = ref(false);

const notifications = ref([
    {
        id: 1,
        profile: 'user-profile.jpeg',
        message: 'You have a new message from John Doe',
        time: '2 min ago',
    },
    {
        id: 2,
        profile: 'user-profile.jpeg',
        message: 'You have a new message from John Doe',
        time: '2 min ago',
    },
]);

const messages = ref([
    {
        id: 1,
        image: '<img class="w-12 h-12 rounded-full object-cover" src="/assets/images/user-profile.jpeg" alt="" />',
        title: 'John Doe',
        message: 'You have a new message from John Doe',
        time: '2 min ago',
    },
    {
        id: 2,
        image: '<img class="w-12 h-12 rounded-full object-cover" src="/assets/images/user-profile.jpeg" alt="" />',
        title: 'John Doe',
        message: 'You have a new message from John Doe',
        time: '2 min ago',
    },
]);

const store = reactive({
    semidark: settings.semidark,
    isDarkMode: settings.isDarkMode,
    theme: inject('theme'),
    rtlClass: inject('rtlClass'),
    languageList: settings.languageList,
});

const lang = ref(localStorage.getItem('language') || 'en');

const toggleDirection = (direction, language) => {
    store.rtlClass = direction
    settings.toggleDir(direction)
    lang.value = language
    settings.changeLanguage(language)
    loadLanguageAsync(language)
}

const toggleTheme = () => {
    store.theme = store.theme === 'light' ? 'dark' : 'light';
    settings.toggleTheme(store.theme);
    emits('checkSettings');
};

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
