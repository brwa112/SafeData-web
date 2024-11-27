<template>
    <div
        class="bg-white dark:bg-gray-900 dark:before:absolute before:inset-0 before:z-0 before:bg-gradient-to-br before:from-primary/15 before:via-transparent before:to-transparent min-h-dvh flex items-center justify-center py-14 md:py-0">
        <div class="container xl:max-w-5xl px-3">
            <div class="grid grid-cols-10 gap-10 lg:gap-2">
                <div class="col-span-full md:col-span-5 flex flex-col gap-5 lg:gap-6">
                    <div class="max-w-max bg-gray-100 dark:bg-gray-800 px-12 lg:px-16 py-2 lg:py-3">
                        <svg class="size-5 text-black dark:text-gray-200" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M9 10C10.1046 10 11 9.10457 11 8C11 6.89543 10.1046 6 9 6C7.89543 6 7 6.89543 7 8C7 9.10457 7.89543 10 9 10Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M2.66998 18.95L7.59998 15.64C8.38998 15.11 9.52998 15.17 10.24 15.78L10.57 16.07C11.35 16.74 12.61 16.74 13.39 16.07L17.55 12.5C18.33 11.83 19.59 11.83 20.37 12.5L22 13.9"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h2 class="font-bold text-2xl lg:text-4xl text-[#344055] dark:text-gray-200">
                        {{ $t('auth.sign_in') }}
                    </h2>
                    <p class="mb-1 text-lg lg:text-xl max-w-md text-gray-400 dark:text-gray-500">
                        {{ $t('auth.detail_sign_in') }}
                    </p>
                    <div class="w-full h-2 border-t-2 border-dashed border-gray-100 dark:border-gray-800"></div>
                    <!-- Forms -->
                    <TabGroup as="div" class="max-w-md relative z-10">
                        <TabList
                            class="max-w-max flex flex-wrap justify-start rtl:space-x-reverse bg-gray-100/90 dark:bg-gray-800 rounded-full">
                            <Tab as="template" v-slot="{ selected }">
                                <button type="button"
                                    class="px-7 py-2 rtl:pb-2.5 lg:px-10 lg:py-2 rtl:lg:pb-2.5 text-gray-400 dark:text-gray-500 text-base lg:text-lg block rounded-full !outline-none transition duration-300"
                                    :class="{ 'bg-[#DFE9FA] dark:bg-primary text-primary dark:!text-[#DFE9FA] font-bold': selected }">
                                    {{ $t('auth.employee') }}
                                </button>
                            </Tab>
                            <Tab as="template" v-slot="{ selected }">
                                <button type="button"
                                    class="px-7 py-2 rtl:pb-2.5 lg:px-10 lg:py-2 rtl:lg:pb-2.5 text-gray-400 dark:text-gray-500 text-base lg:text-lg block rounded-full !outline-none transition duration-300"
                                    :class="{ 'bg-[#DFE9FA] dark:bg-primary text-primary dark:!text-[#DFE9FA] font-bold': selected }">
                                    {{ $t('auth.manager') }}
                                </button>
                            </Tab>
                        </TabList>
                        <TabPanels class="pt-10 flex-1 text-sm">
                            <TabPanel>
                                <form class="space-y-7" @submit.prevent="login">
                                    <!-- Email -->
                                    <div class="relative">
                                        <input type="email" v-model="form.email"
                                            class="peer py-2.5 rtl:pb-3 lg:py-3.5 rtl:lg:pb-4 px-5 ps-14 block w-full border-2 border-gray-200 rounded-xl lg:rounded-2xl text-base lg:text-lg focus:ring-0 outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-gray-800 dark:text-gray-300 dark:placeholder-gray-500"
                                            :placeholder="$t('auth.phone_number')">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-6 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                                fill="none">
                                                <path class="fill-gray-900/40 dark:fill-gray-400/70"
                                                    d="M11.79 14.21L8.52 17.48C8.16 17.16 7.81 16.83 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.09 13.57 11.44 13.91 11.79 14.21Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-700 dark:fill-gray-300"
                                                    d="M21.9696 18.33C21.9696 18.61 21.9196 18.9 21.8196 19.18C21.7896 19.26 21.7596 19.34 21.7196 19.42C21.5496 19.78 21.3296 20.12 21.0396 20.44C20.5496 20.98 20.0096 21.37 19.3996 21.62C19.3896 21.62 19.3796 21.63 19.3696 21.63C18.7796 21.87 18.1396 22 17.4496 22C16.4296 22 15.3396 21.76 14.1896 21.27C13.0396 20.78 11.8896 20.12 10.7496 19.29C10.3596 19 9.96961 18.71 9.59961 18.4L12.8696 15.13C13.1496 15.34 13.3996 15.5 13.6096 15.61C13.6596 15.63 13.7196 15.66 13.7896 15.69C13.8696 15.72 13.9496 15.73 14.0396 15.73C14.2096 15.73 14.3396 15.67 14.4496 15.56L15.2096 14.81C15.4596 14.56 15.6996 14.37 15.9296 14.25C16.1596 14.11 16.3896 14.04 16.6396 14.04C16.8296 14.04 17.0296 14.08 17.2496 14.17C17.4696 14.26 17.6996 14.39 17.9496 14.56L21.2596 16.91C21.5196 17.09 21.6996 17.3 21.8096 17.55C21.9096 17.8 21.9696 18.05 21.9696 18.33Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="relative">
                                        <input :type="passwordView" v-model="form.password"
                                            class="relative z-0 peer py-2.5 rtl:pb-3 lg:py-3.5 rtl:lg:pb-4 px-5 ps-14 block w-full border-2 border-gray-200 rounded-xl lg:rounded-2xl text-base lg:text-lg focus:ring-0 outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-gray-800 dark:text-gray-300 dark:placeholder-gray-500"
                                            :placeholder="$t('auth.password')">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-5 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                                fill="none">
                                                <path class="fill-gray-900 dark:fill-gray-400"
                                                    d="M15 22C14.59 22 14.25 21.66 14.25 21.25V2.75C14.25 2.34 14.59 2 15 2C15.41 2 15.75 2.34 15.75 2.75V21.25C15.75 21.66 15.41 22 15 22Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900/40 dark:fill-gray-400/70"
                                                    d="M6.5 20H12.5V4H6.5C4.29 4 2.5 5.79 2.5 8V16C2.5 18.21 4.29 20 6.5 20Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900/40 dark:fill-gray-400/70"
                                                    d="M18 20H15V4H18C20.21 4 22 5.79 22 8V16C22 18.21 20.21 20 18 20Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900 dark:fill-gray-100"
                                                    d="M5.75 13C5.62 13 5.49 12.97 5.37 12.92C5.25 12.87 5.14 12.8 5.04 12.71C4.95 12.61 4.88 12.5 4.82 12.38C4.77 12.26 4.75 12.13 4.75 12C4.75 11.74 4.86 11.48 5.04 11.29C5.09 11.25 5.14 11.21 5.19 11.17C5.25 11.13 5.31 11.1 5.37 11.08C5.43 11.05 5.49 11.03 5.55 11.02C5.89 10.95 6.23 11.06 6.46 11.29C6.64 11.48 6.75 11.74 6.75 12C6.75 12.13 6.72 12.26 6.67 12.38C6.62 12.5 6.55 12.61 6.46 12.71C6.36 12.8 6.25 12.87 6.13 12.92C6.01 12.97 5.88 13 5.75 13Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900 dark:fill-gray-100"
                                                    d="M9.25 13C9.12 13 8.99 12.97 8.87 12.92C8.75 12.87 8.64 12.8 8.54 12.71C8.35 12.52 8.25 12.27 8.25 12C8.25 11.87 8.28 11.74 8.33 11.62C8.38 11.49 8.45 11.39 8.54 11.29C8.91 10.92 9.58 10.92 9.96 11.29C10.14 11.48 10.25 11.74 10.25 12C10.25 12.13 10.22 12.26 10.17 12.38C10.12 12.5 10.05 12.61 9.96 12.71C9.86 12.8 9.75 12.87 9.63 12.92C9.51 12.97 9.38 13 9.25 13Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </div>
                                        <button type="button" @click="passwordToggle" v-if="passwordView === 'password'"
                                            class="absolute inset-y-0 end-5 z-20 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                                fill="none">
                                                <path class="fill-gray-900/40 dark:fill-gray-400/70"
                                                    d="M21.25 9.14999C20.76 8.36999 20.2 7.66999 19.62 7.03999L15.85 10.81C15.97 11.18 16.04 11.58 16.04 12C16.04 14.24 14.23 16.04 12 16.04C11.58 16.04 11.18 15.97 10.81 15.85L7.35 19.31C8.81 20.13 10.39 20.56 12 20.56C13.78 20.56 15.51 20.04 17.09 19.07C18.67 18.09 20.09 16.66 21.25 14.84C22.25 13.28 22.25 10.72 21.25 9.14999Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900 dark:fill-gray-400"
                                                    d="M14.02 9.98L9.98 14.02C9.47 13.5 9.14 12.78 9.14 12C9.14 10.43 10.42 9.14 12 9.14C12.78 9.14 13.5 9.47 14.02 9.98Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900/40 dark:fill-gray-400/70"
                                                    d="M18.25 5.74999L14.86 9.13999C14.13 8.39999 13.12 7.95999 12 7.95999C9.76 7.95999 7.96 9.76999 7.96 12C7.96 13.12 8.41 14.13 9.14 14.86L5.76 18.25H5.75C4.64 17.35 3.62 16.2 2.75 14.84C1.75 13.27 1.75 10.72 2.75 9.14999C3.91 7.32999 5.33 5.89999 6.91 4.91999C8.49 3.95999 10.22 3.42999 12 3.42999C14.23 3.42999 16.39 4.24999 18.25 5.74999Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900 dark:fill-gray-100"
                                                    d="M14.86 12C14.86 13.57 13.58 14.86 12 14.86C11.94 14.86 11.89 14.86 11.83 14.84L14.84 11.83C14.86 11.89 14.86 11.94 14.86 12Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900 dark:fill-gray-200"
                                                    d="M21.77 2.23C21.47 1.93 20.98 1.93 20.68 2.23L2.23 20.69C1.93 20.99 1.93 21.48 2.23 21.78C2.38 21.92 2.57 22 2.77 22C2.97 22 3.16 21.92 3.31 21.77L21.77 3.31C22.08 3.01 22.08 2.53 21.77 2.23Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </button>
                                        <button type="button" @click="passwordToggle" v-else
                                            class="absolute inset-y-0 end-5 z-20 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24">
                                                <path fill="currentColor" class="fill-gray-900/30 dark:fill-gray-400/70"
                                                    d="M2 12c0 1.64.425 2.191 1.275 3.296C4.972 17.5 7.818 20 12 20c4.182 0 7.028-2.5 8.725-4.704C21.575 14.192 22 13.639 22 12c0-1.64-.425-2.191-1.275-3.296C19.028 6.5 16.182 4 12 4C7.818 4 4.972 6.5 3.275 8.704C2.425 9.81 2 10.361 2 12" />
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    class="fill-gray-900/70 dark:fill-gray-100/70"
                                                    d="M8.25 12a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0m1.5 0a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    <button type="submit" :disabled="form.processing"
                                        class="btn btn-primary duration-300 hover:bg-primary/90 shadow-none !mt-8 lg:!mt-10 py-2.5 rtl:pb-3 lg:py-3.5 rtl:lg:pb-4 px-5 rounded-full text-base lg:text-lg font-normal max-w-max min-w-44 lg:min-w-72">
                                        {{ $t('auth.login') }}
                                    </button>
                                </form>
                            </TabPanel>
                            <TabPanel>
                                <form class="space-y-7" @submit.prevent="login">
                                    <!-- Email -->
                                    <div class="relative">
                                        <input type="email"
                                            class="peer py-2.5 rtl:pb-3 lg:py-3.5 rtl:lg:pb-4 px-5 ps-14 block w-full border-2 border-gray-200 rounded-xl lg:rounded-2xl text-base lg:text-lg focus:ring-0 outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-gray-800 dark:text-gray-300 dark:placeholder-gray-500"
                                            :placeholder="$t('auth.phone_number')">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-6 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                                fill="none">
                                                <path class="fill-gray-900/40 dark:fill-gray-400/70"
                                                    d="M11.79 14.21L8.52 17.48C8.16 17.16 7.81 16.83 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.09 13.57 11.44 13.91 11.79 14.21Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-700 dark:fill-gray-300"
                                                    d="M21.9696 18.33C21.9696 18.61 21.9196 18.9 21.8196 19.18C21.7896 19.26 21.7596 19.34 21.7196 19.42C21.5496 19.78 21.3296 20.12 21.0396 20.44C20.5496 20.98 20.0096 21.37 19.3996 21.62C19.3896 21.62 19.3796 21.63 19.3696 21.63C18.7796 21.87 18.1396 22 17.4496 22C16.4296 22 15.3396 21.76 14.1896 21.27C13.0396 20.78 11.8896 20.12 10.7496 19.29C10.3596 19 9.96961 18.71 9.59961 18.4L12.8696 15.13C13.1496 15.34 13.3996 15.5 13.6096 15.61C13.6596 15.63 13.7196 15.66 13.7896 15.69C13.8696 15.72 13.9496 15.73 14.0396 15.73C14.2096 15.73 14.3396 15.67 14.4496 15.56L15.2096 14.81C15.4596 14.56 15.6996 14.37 15.9296 14.25C16.1596 14.11 16.3896 14.04 16.6396 14.04C16.8296 14.04 17.0296 14.08 17.2496 14.17C17.4696 14.26 17.6996 14.39 17.9496 14.56L21.2596 16.91C21.5196 17.09 21.6996 17.3 21.8096 17.55C21.9096 17.8 21.9696 18.05 21.9696 18.33Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="relative">
                                        <input :type="passwordView"
                                            class="relative z-0 peer py-2.5 rtl:pb-3 lg:py-3.5 rtl:lg:pb-4 px-5 ps-14 block w-full border-2 border-gray-200 rounded-xl lg:rounded-2xl text-base lg:text-lg focus:ring-0 outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-gray-800 dark:text-gray-300 dark:placeholder-gray-500"
                                            :placeholder="$t('auth.password')">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-5 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                                fill="none">
                                                <path class="fill-gray-900 dark:fill-gray-400"
                                                    d="M15 22C14.59 22 14.25 21.66 14.25 21.25V2.75C14.25 2.34 14.59 2 15 2C15.41 2 15.75 2.34 15.75 2.75V21.25C15.75 21.66 15.41 22 15 22Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900/40 dark:fill-gray-400/70"
                                                    d="M6.5 20H12.5V4H6.5C4.29 4 2.5 5.79 2.5 8V16C2.5 18.21 4.29 20 6.5 20Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900/40 dark:fill-gray-400/70"
                                                    d="M18 20H15V4H18C20.21 4 22 5.79 22 8V16C22 18.21 20.21 20 18 20Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900 dark:fill-gray-100"
                                                    d="M5.75 13C5.62 13 5.49 12.97 5.37 12.92C5.25 12.87 5.14 12.8 5.04 12.71C4.95 12.61 4.88 12.5 4.82 12.38C4.77 12.26 4.75 12.13 4.75 12C4.75 11.74 4.86 11.48 5.04 11.29C5.09 11.25 5.14 11.21 5.19 11.17C5.25 11.13 5.31 11.1 5.37 11.08C5.43 11.05 5.49 11.03 5.55 11.02C5.89 10.95 6.23 11.06 6.46 11.29C6.64 11.48 6.75 11.74 6.75 12C6.75 12.13 6.72 12.26 6.67 12.38C6.62 12.5 6.55 12.61 6.46 12.71C6.36 12.8 6.25 12.87 6.13 12.92C6.01 12.97 5.88 13 5.75 13Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900 dark:fill-gray-100"
                                                    d="M9.25 13C9.12 13 8.99 12.97 8.87 12.92C8.75 12.87 8.64 12.8 8.54 12.71C8.35 12.52 8.25 12.27 8.25 12C8.25 11.87 8.28 11.74 8.33 11.62C8.38 11.49 8.45 11.39 8.54 11.29C8.91 10.92 9.58 10.92 9.96 11.29C10.14 11.48 10.25 11.74 10.25 12C10.25 12.13 10.22 12.26 10.17 12.38C10.12 12.5 10.05 12.61 9.96 12.71C9.86 12.8 9.75 12.87 9.63 12.92C9.51 12.97 9.38 13 9.25 13Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </div>
                                        <button type="button" @click="passwordToggle" v-if="passwordView === 'password'"
                                            class="absolute inset-y-0 end-5 z-20 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24"
                                                fill="none">
                                                <path class="fill-gray-900/40 dark:fill-gray-400/70"
                                                    d="M21.25 9.14999C20.76 8.36999 20.2 7.66999 19.62 7.03999L15.85 10.81C15.97 11.18 16.04 11.58 16.04 12C16.04 14.24 14.23 16.04 12 16.04C11.58 16.04 11.18 15.97 10.81 15.85L7.35 19.31C8.81 20.13 10.39 20.56 12 20.56C13.78 20.56 15.51 20.04 17.09 19.07C18.67 18.09 20.09 16.66 21.25 14.84C22.25 13.28 22.25 10.72 21.25 9.14999Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900 dark:fill-gray-400"
                                                    d="M14.02 9.98L9.98 14.02C9.47 13.5 9.14 12.78 9.14 12C9.14 10.43 10.42 9.14 12 9.14C12.78 9.14 13.5 9.47 14.02 9.98Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900/40 dark:fill-gray-400/70"
                                                    d="M18.25 5.74999L14.86 9.13999C14.13 8.39999 13.12 7.95999 12 7.95999C9.76 7.95999 7.96 9.76999 7.96 12C7.96 13.12 8.41 14.13 9.14 14.86L5.76 18.25H5.75C4.64 17.35 3.62 16.2 2.75 14.84C1.75 13.27 1.75 10.72 2.75 9.14999C3.91 7.32999 5.33 5.89999 6.91 4.91999C8.49 3.95999 10.22 3.42999 12 3.42999C14.23 3.42999 16.39 4.24999 18.25 5.74999Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900 dark:fill-gray-100"
                                                    d="M14.86 12C14.86 13.57 13.58 14.86 12 14.86C11.94 14.86 11.89 14.86 11.83 14.84L14.84 11.83C14.86 11.89 14.86 11.94 14.86 12Z"
                                                    fill="currentColor" />
                                                <path class="fill-gray-900 dark:fill-gray-200"
                                                    d="M21.77 2.23C21.47 1.93 20.98 1.93 20.68 2.23L2.23 20.69C1.93 20.99 1.93 21.48 2.23 21.78C2.38 21.92 2.57 22 2.77 22C2.97 22 3.16 21.92 3.31 21.77L21.77 3.31C22.08 3.01 22.08 2.53 21.77 2.23Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </button>
                                        <button type="button" @click="passwordToggle" v-else
                                            class="absolute inset-y-0 end-5 z-20 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24">
                                                <path fill="currentColor" class="fill-gray-900/30 dark:fill-gray-400/70"
                                                    d="M2 12c0 1.64.425 2.191 1.275 3.296C4.972 17.5 7.818 20 12 20c4.182 0 7.028-2.5 8.725-4.704C21.575 14.192 22 13.639 22 12c0-1.64-.425-2.191-1.275-3.296C19.028 6.5 16.182 4 12 4C7.818 4 4.972 6.5 3.275 8.704C2.425 9.81 2 10.361 2 12" />
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    class="fill-gray-900/70 dark:fill-gray-100/70"
                                                    d="M8.25 12a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0m1.5 0a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    <button type="submit" :disabled="form.processing"
                                        class="btn btn-primary duration-300 hover:bg-primary/90 shadow-none !mt-8 lg:!mt-10 py-2.5 rtl:pb-3 lg:py-3.5 rtl:lg:pb-4 px-5 rounded-full text-base lg:text-lg font-normal max-w-max min-w-44 lg:min-w-72">
                                        {{ $t('auth.login') }}
                                    </button>
                                </form>
                            </TabPanel>
                        </TabPanels>
                    </TabGroup>
                </div>
                <div
                    class="col-span-full md:col-span-5 lg:col-span-4 lg:col-start-7 flex flex-col items-center justify-center text-center lg:mx-3 pb-20 relative after:absolute after:inset-0 after:z-10 after:bg-primary/[.93] bg-[url('/public/assets/images/login/bg-login.jpg')] bg-center bg-[250%,100%] bg-no-repeat rounded-[2rem] overflow-hidden p-5">

                    <div class="w-full flex flex-row-reverse items-center justify-between gap-1">
                        <!-- Language -->
                        <div class="relative z-30">
                            <Menu as="div" class="relative inline-block text-left">
                                <div>
                                    <MenuButton v-slot="{ open }"
                                        class="flex items-center gap-4 w-full text-dark-blue/80 bg-white dark:bg-gray-800 font-bold text-sm p-2.5 px-3.5 rounded-xl">
                                        <template v-for="language in languages" :key="language.code">
                                            <div v-if="language.code == lang" class="flex items-center gap-2.5">
                                                <img :src="`/assets/images/langs/${lang}.png`" alt="lang"
                                                    class="size-[1.125rem]">
                                                <span class="rtl:mb-0.5 ltr:text-[.8rem]">
                                                    {{ $t(`auth.${language.name}`) }}
                                                </span>
                                            </div>
                                        </template>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="size-3.5 text-dark-blue duration-200" :class="{ 'rotate-180': open }"
                                            viewBox="0 0 18 9">
                                            <path fill="none"
                                                d="M16.92 0.949951L10.4 7.46995C9.62996 8.23995 8.36996 8.23995 7.59996 7.46995L1.07996 0.949951"
                                                stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </MenuButton>
                                </div>

                                <transition enter-active-class="transition duration-200 ease-out"
                                    enter-from-class="transform opacity-0" enter-to-class="transform opacity-200"
                                    leave-active-class="transition duration-200 ease-in"
                                    leave-from-class="transform opacity-100" leave-to-class="transform opacity-0">
                                    <MenuItems
                                        class="absolute end-0 z-50 mt-2 w-full min-w-36 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 px-2 py-1 rounded-lg bg-white dark:bg-gray-800 shadow-sm ring-0 focus:outline-none">
                                        <MenuItem v-slot="{ close }">
                                        <div class="px-1 py-1">
                                            <button @click="close, toggleDirection('ltr', 'en')" :class="[
                                                'group flex w-full items-center rounded-md py-1 text-sm font-bold',
                                            ]">
                                                <div class="flex items-center gap-2.5">
                                                    <img :src="'/assets/images/langs/en.png'" alt="lang" class="size-4">
                                                    <span class="rtl:mb-0.5">
                                                        {{ $t('auth.english') }}
                                                    </span>
                                                </div>
                                            </button>
                                        </div>
                                        </MenuItem>
                                        <MenuItem v-slot="{ close }">
                                        <div class="px-1 py-1">
                                            <button @click="close, toggleDirection('rtl', 'ar')" :class="[
                                                'group flex w-full items-center rounded-md py-1 text-sm font-bold',
                                            ]">
                                                <div class="flex items-center gap-2.5">
                                                    <img :src="'/assets/images/langs/ar.png'" alt="lang" class="size-4">
                                                    <span class="rtl:mb-0.5">
                                                        {{ $t('auth.arabic') }}
                                                    </span>
                                                </div>
                                            </button>
                                        </div>
                                        </MenuItem>
                                        <MenuItem v-slot="{ close }">
                                        <div class="px-1 py-1">
                                            <button @click="close, toggleDirection('rtl', 'ckb')" :class="[
                                                'group flex w-full items-center rounded-md py-1 text-sm font-bold',
                                            ]">
                                                <div class="flex items-center gap-2.5">
                                                    <img :src="'/assets/images/langs/ckb.png'" alt="lang"
                                                        class="size-4">
                                                    <span class="rtl:mb-0.5">
                                                        {{ $t('auth.kurdish') }}
                                                    </span>
                                                </div>
                                            </button>
                                        </div>
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>

                        <!-- Mode Dark/Light -->
                        <div class="relative z-30">
                            <label class="w-12 h-6 relative">
                                <input type="checkbox" @click="toggleTheme" :checked="theme === 'dark'"
                                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                    id="custom_switch_checkbox2" />
                                <span for="custom_switch_checkbox2"
                                    class="outline_checkbox bg-icon border-2 border-transparent dark:border-white-dark block h-full rounded-full before:absolute before:left-1 before:bg-[#ebedf2] dark:before:bg-white-dark before:bottom-1 before:w-4 before:h-4 before:rounded-full before:bg-[url('/public/assets/images/sun.svg')] before:bg-no-repeat before:bg-center peer-checked:before:left-7 peer-checked:before:bg-[url('/public/assets/images/moon.svg')] peer-checked:border-primary peer-checked:before:bg-primary before:transition-all before:duration-300"></span>
                            </label>
                        </div>
                    </div>


                    <div class="relative z-20 mx-5">
                        <img :src="'../assets/images/login/build.svg'" alt="logo" class="size-72">
                    </div>
                    <!-- Slider -->
                    <div class="login-carosel max-w-full z-30">
                        <Carousel :autoplay="2000" :wrap-around="true">
                            <Slide v-for="(item, i) in items" :key="i">
                                <div class="carousel__item">
                                    <div class="flex flex-col gap-5 max-h-80 cursor-grab">
                                        <h2 class="relative z-20 font-bold text-3xl text-white">
                                            {{ item.title }}
                                        </h2>
                                        <p class="relative z-20 mb-1 text-xl max-w-lg text-gray-300">
                                            {{ item.description }}
                                        </p>
                                    </div>
                                </div>
                            </Slide>

                            <template #addons>
                                <Pagination />
                            </template>
                        </Carousel>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, inject, defineEmits } from 'vue'
import { Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import { Menu, MenuItem, MenuButton, MenuItems } from '@headlessui/vue';
import { loadLanguageAsync } from 'laravel-vue-i18n';
import { getDefaultSettings } from '@/settings.js';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'

const settings = getDefaultSettings()
const emits = defineEmits();

const form = useForm({
    email: 'test@example.com',
    password: 'password',
    // email: '',
    // password: '',
});

const login = () => {
    form.post(route('login'), {
        onSuccess: () => {
            form.reset()
        },
    })
}

const passwordView = ref('password')

const passwordToggle = () => {
    passwordView.value = passwordView.value === 'password' ? 'text' : 'password'
}

const dir = inject('rtlClass')
const lang = ref(localStorage.getItem('language') || 'en')
const languages = ref([
    { name: 'english', code: 'en' },
    { name: 'arabic', code: 'ar' },
    { name: 'kurdish', code: 'ckb' },
    { name: 'turkey', code: 'tr' }
])

const toggleDirection = (direction, language) => {
    dir.value = direction
    settings.toggleDir(direction)
    lang.value = language
    settings.changeLanguage(language)
    loadLanguageAsync(language)
}

const theme = ref(inject('theme'))
const toggleTheme = () => {
    theme.value = theme.value === 'light' ? 'dark' : 'light';
    settings.toggleTheme(theme.value);
    emits('checkSettings');
};

const items = ref([
    {
        title: 'لۆریم ئیپسوم دۆلۆر',
        description: 'واین لیرن سیت دۆلۆر.فلیکویس ئیسلاند لیۆ تو ئیسوس ئاوکتەر کویس لێکتۆر سویسپیکت ڤیبلوم بلارسا تیرانیک تریپ توون ئیپسوم دۆلۆر سیت ئەمیت',
    },
    {
        title: 'لۆریم ئیپسوم دۆلۆر',
        description: 'واین لیرن سیت دۆلۆر.فلیکویس ئیسلاند لیۆ تو ئیسوس ئاوکتەر کویس لێکتۆر سویسپیکت ڤیبلوم بلارسا تیرانیک تریپ توون ئیپسوم دۆلۆر سیت ئەمیت',
    },
    {
        title: 'لۆریم ئیپسوم دۆلۆر',
        description: 'واین لیرن سیت دۆلۆر.فلیکویس ئیسلاند لیۆ تو ئیسوس ئاوکتەر کویس لێکتۆر سویسپیکت ڤیبلوم بلارسا تیرانیک تریپ توون ئیپسوم دۆلۆر سیت ئەمیت',
    },
    {
        title: 'لۆریم ئیپسوم دۆلۆر',
        description: 'واین لیرن سیت دۆلۆر.فلیکویس ئیسلاند لیۆ تو ئیسوس ئاوکتەر کویس لێکتۆر سویسپیکت ڤیبلوم بلارسا تیرانیک تریپ توون ئیپسوم دۆلۆر سیت ئەمیت',
    },
]);

</script>

<script>
import layout from '@/Layouts/Public.vue'

export default {
    layout: layout,
}
</script>

<style>
.login-carosel .carousel__pagination {
    margin-top: 40px !important;
}

.login-carosel .carousel__pagination .carousel__pagination-item .carousel__pagination-button {
    transition-duration: 1s !important;
}

.login-carosel .carousel__pagination .carousel__pagination-item .carousel__pagination-button::after {
    width: 5px !important;
    height: 5px !important;
    border-radius: 100% !important;
    transition-duration: .3s !important;
    background-color: rgba(255, 255, 255, 0.672) !important;
}

.login-carosel .carousel__pagination .carousel__pagination-item .carousel__pagination-button--active::after {
    width: 13px !important;
    height: 5px !important;
    border-radius: 10px !important;
    transition-duration: .3s !important;
    background-color: #fff !important;
}
</style>