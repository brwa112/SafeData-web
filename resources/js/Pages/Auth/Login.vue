<template>
    <div>
        <div class="absolute inset-0">
            <img :src="'/assets/images/auth/bg-gradient.png'" alt="image" class="h-full w-full object-cover" />
        </div>
        <div
            class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">
            <img :src="'/assets/images/auth/coming-soon-object1.png'" alt="image"
                class="absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2" />
            <img :src="'/assets/images/auth/coming-soon-object2.png'" alt="image"
                class="absolute left-24 top-0 h-40 md:left-[30%]" />
            <img :src="'/assets/images/auth/coming-soon-object3.png'" alt="image"
                class="absolute right-0 top-0 h-[300px]" />
            <img :src="'/assets/images/auth/polygon-object.svg'" alt="image" class="absolute bottom-0 end-[28%]" />
            <div
                class="relative flex w-full max-w-[1502px] flex-col justify-between overflow-hidden rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 lg:min-h-[758px] lg:flex-row lg:gap-10 xl:gap-0">
                <div
                    class="relative hidden w-full items-center justify-center bg-[linear-gradient(225deg,rgba(239,18,98,1)_0%,rgba(67,97,238,1)_100%)] p-5 lg:inline-flex lg:max-w-[835px] xl:-ms-28 ltr:xl:skew-x-[14deg] rtl:xl:skew-x-[-14deg]">
                    <div
                        class="absolute inset-y-0 w-8 from-primary/10 via-transparent to-transparent ltr:-right-10 ltr:bg-gradient-to-r rtl:-left-10 rtl:bg-gradient-to-l xl:w-16 ltr:xl:-right-20 rtl:xl:-left-20">
                    </div>
                    <div class="ltr:xl:-skew-x-[14deg] rtl:xl:skew-x-[14deg]">
                        <div class="w-48 block lg:w-72 ms-10">
                            <img :src="'/assets/images/auth/logo-white.svg'" alt="Logo" class="w-full" />
                        </div>
                        <div class="mt-24 hidden w-full max-w-[430px] lg:block">
                            <img :src="'/assets/images/auth/login.svg'" alt="Cover Image" class="w-full" />
                        </div>
                    </div>
                </div>
                <div
                    class="relative flex w-full flex-col items-center justify-center gap-6 px-4 pb-16 pt-6 sm:px-6 lg:max-w-[667px]">
                    <div
                        class="flex w-full max-w-[440px] items-center gap-2 lg:absolute lg:end-6 lg:top-6 lg:max-w-full">
                        <div class="w-8 block lg:hidden">
                            <img :src="'/assets/images/logo.svg'" alt="Logo" class="mx-auto w-10" />
                        </div>
                        <div class="dropdown ms-auto w-max">
                            <Popper :placement="dir === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="8"
                                class="align-middle">
                                <button type="button"
                                    class="block p-2 rounded-full bg-white-light dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60">
                                    <img :src="`/assets/images/langs/${lang}.png`" alt="flag"
                                        class="w-5 h-5 object-cover rounded-full" />
                                </button>
                                <template #content="{ close }">
                                    <ul
                                        class="!px-2 !mt-2 text-dark dark:text-white-dark grid grid-cols-2 gap-2 font-semibold dark:text-white-light/90 w-[280px]">
                                        <template v-for="item in languages" :key="item.code">
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
                    </div>
                    <div class="w-full max-w-[440px] lg:mt-16">
                        <div class="mb-10">
                            <h1 class="text-xl font-extrabold uppercase !leading-snug text-primary md:text-2xl">
                                {{ $t('auth.sign_in') }}
                            </h1>
                            <p class="text-base font-bold leading-normal text-white-dark">
                                {{ $t('auth.detail_sign_in') }}
                            </p>

                            <!-- error -->
                            <p v-if="errors.length" class="text-red-500 text-sm mt-2">
                                {{ errors }}
                            </p>

                        </div>
                        <form @submit.prevent="login" class="space-y-5 dark:text-white">
                            <div>
                                <label for="Email">{{ $t('auth.email') }}</label>
                                <div class="relative text-white-dark">
                                    <input id="Email" type="email" placeholder="Enter Email" v-model="form.email"
                                        class="form-input ps-10 placeholder:text-white-dark" />
                                    <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                        <icon-mail :fill="true" />
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label for="Password">{{ $t('auth.password') }}</label>
                                <div class="relative text-white-dark">
                                    <input id="Password" placeholder="Enter Password" :type="passwordView"
                                        v-model="form.password" class="form-input ps-10 placeholder:text-white-dark" />
                                    <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                        <icon-lock-dots :fill="true" />
                                    </span>
                                    <button type="button" @click="passwordToggle" v-if="passwordView === 'password'"
                                        class="absolute inset-y-0 end-5 z-20 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                            fill="none">
                                            <path class="fill-gray-900/25 dark:fill-gray-400/70"
                                                d="M21.25 9.14999C20.76 8.36999 20.2 7.66999 19.62 7.03999L15.85 10.81C15.97 11.18 16.04 11.58 16.04 12C16.04 14.24 14.23 16.04 12 16.04C11.58 16.04 11.18 15.97 10.81 15.85L7.35 19.31C8.81 20.13 10.39 20.56 12 20.56C13.78 20.56 15.51 20.04 17.09 19.07C18.67 18.09 20.09 16.66 21.25 14.84C22.25 13.28 22.25 10.72 21.25 9.14999Z"
                                                fill="currentColor" />
                                            <path class="fill-gray-900/50 dark:fill-gray-400"
                                                d="M14.02 9.98L9.98 14.02C9.47 13.5 9.14 12.78 9.14 12C9.14 10.43 10.42 9.14 12 9.14C12.78 9.14 13.5 9.47 14.02 9.98Z"
                                                fill="currentColor" />
                                            <path class="fill-gray-900/25 dark:fill-gray-400/70"
                                                d="M18.25 5.74999L14.86 9.13999C14.13 8.39999 13.12 7.95999 12 7.95999C9.76 7.95999 7.96 9.76999 7.96 12C7.96 13.12 8.41 14.13 9.14 14.86L5.76 18.25H5.75C4.64 17.35 3.62 16.2 2.75 14.84C1.75 13.27 1.75 10.72 2.75 9.14999C3.91 7.32999 5.33 5.89999 6.91 4.91999C8.49 3.95999 10.22 3.42999 12 3.42999C14.23 3.42999 16.39 4.24999 18.25 5.74999Z"
                                                fill="currentColor" />
                                            <path class="fill-gray-900/50 dark:fill-gray-100"
                                                d="M14.86 12C14.86 13.57 13.58 14.86 12 14.86C11.94 14.86 11.89 14.86 11.83 14.84L14.84 11.83C14.86 11.89 14.86 11.94 14.86 12Z"
                                                fill="currentColor" />
                                            <path class="fill-gray-900/50 dark:fill-gray-200"
                                                d="M21.77 2.23C21.47 1.93 20.98 1.93 20.68 2.23L2.23 20.69C1.93 20.99 1.93 21.48 2.23 21.78C2.38 21.92 2.57 22 2.77 22C2.97 22 3.16 21.92 3.31 21.77L21.77 3.31C22.08 3.01 22.08 2.53 21.77 2.23Z"
                                                fill="currentColor" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="passwordToggle" v-else
                                        class="absolute inset-y-0 end-5 z-20 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24">
                                            <path fill="currentColor" class="fill-gray-900/25 dark:fill-gray-400/70"
                                                d="M2 12c0 1.64.425 2.191 1.275 3.296C4.972 17.5 7.818 20 12 20c4.182 0 7.028-2.5 8.725-4.704C21.575 14.192 22 13.639 22 12c0-1.64-.425-2.191-1.275-3.296C19.028 6.5 16.182 4 12 4C7.818 4 4.972 6.5 3.275 8.704C2.425 9.81 2 10.361 2 12" />
                                            <path fill="currentColor" fill-rule="evenodd"
                                                class="fill-gray-900/30 dark:fill-gray-100/70"
                                                d="M8.25 12a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0m1.5 0a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- <div>
                                <label class="flex cursor-pointer items-center">
                                    <input type="checkbox" class="form-checkbox bg-white dark:bg-black" />
                                    <span class="text-white-dark">Subscribe to weekly newsletter</span>
                                </label>
                            </div> -->
                            <button type="submit" :disabled="form.processing"
                                class="btn btn-primary !mt-6 w-full border-0 uppercase">
                                {{ $t('auth.login') }}
                            </button>
                        </form>

                        <!-- <div class="relative my-7 text-center md:mb-9">
                            <span
                                class="absolute inset-x-0 top-1/2 h-px w-full -translate-y-1/2 bg-white-light dark:bg-white-dark"></span>
                            <span
                                class="relative bg-white px-2 font-bold uppercase text-white-dark dark:bg-dark dark:text-white-light">or</span>
                        </div> -->
                        <!-- <div class="mb-10 md:mb-[60px]">
                            <ul class="flex justify-center gap-3.5 text-white">
                                <li>
                                    <a href="javascript:"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-full p-0 transition hover:scale-110"
                                        style="background: linear-gradient(135deg, rgba(239, 18, 98, 1) 0%, rgba(67, 97, 238, 1) 100%)">
                                        <icon-instagram />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-full p-0 transition hover:scale-110"
                                        style="background: linear-gradient(135deg, rgba(239, 18, 98, 1) 0%, rgba(67, 97, 238, 1) 100%)">
                                        <icon-facebook-circle />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-full p-0 transition hover:scale-110"
                                        style="background: linear-gradient(135deg, rgba(239, 18, 98, 1) 0%, rgba(67, 97, 238, 1) 100%)">
                                        <icon-twitter :fill="true" />
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-full p-0 transition hover:scale-110"
                                        style="background: linear-gradient(135deg, rgba(239, 18, 98, 1) 0%, rgba(67, 97, 238, 1) 100%)">
                                        <icon-google />
                                    </a>
                                </li>
                            </ul>
                        </div> -->
                        <!-- <div class="text-center dark:text-white">
                            Don't have an account ?
                            <button type="button"
                                class="uppercase text-primary underline transition hover:text-black dark:hover:text-white">
                                SIGN UP
                            </button>
                        </div> -->
                    </div>
                    <p class="absolute bottom-6 w-full text-center dark:text-white">
                        © {{ new Date().getFullYear() }}.VRISTO All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, inject } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { loadLanguageAsync } from 'laravel-vue-i18n';
import { getDefaultSettings } from '@/settings.js';
import 'vue3-carousel/dist/carousel.css'
import { usePage } from '@inertiajs/vue3';

import IconMail from '@/components/icon/icon-mail.vue';
import IconLockDots from '@/components/icon/icon-lock-dots.vue';

const settings = getDefaultSettings()
const emits = defineEmits();

const page = usePage()

console.log(page.props)

const form = useForm({
    email: 'test@example.com',
    password: 'password',
});

const errors = ref(form.errors)

const login = () => {
    form.post(route('login'), {
        onSuccess: () => {
            form.reset()
        },
        onError: (e) => {
            errors.value = e
            console.log(errors.value)
        }
    })
}

const passwordView = ref('password')

const passwordToggle = () => {
    passwordView.value = passwordView.value === 'password' ? 'text' : 'password'
}

const dir = inject('rtlClass')
const lang = ref(localStorage.getItem('language') || 'en')
const languages = ref(settings.languageList)

const currentLang = ref(languages.value.find((item) => item.code === lang.value))

const toggleDirection = (direction, language) => {
    dir.value = direction
    settings.toggleDir(direction)
    lang.value = language
    settings.changeLanguage(language)
    currentLang.value = language;
    loadLanguageAsync(language)
}

const theme = ref(inject('theme'))
const toggleTheme = () => {
    theme.value = theme.value === 'light' ? 'dark' : 'light';
    settings.toggleTheme(theme.value);
    emits('checkSettings');
};

</script>

<script>
import layout from '@/Layouts/Public.vue'

export default {
    layout: layout,
}
</script>