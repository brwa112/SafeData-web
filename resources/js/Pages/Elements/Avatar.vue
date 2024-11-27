<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Elements</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Avatar</span>
            </li>
        </ul>
        <div class="pt-5 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Basic</h5>
                </div>
                <div class="mb-5">
                    <div class="flex items-center justify-center gap-2 flex-wrap">
                        <img class="w-20 h-20 rounded-full overflow-hidden object-cover"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-16 h-16 rounded-full overflow-hidden object-cover"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-14 h-14 rounded-full overflow-hidden object-cover"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-12 h-12 rounded-full overflow-hidden object-cover"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Indicators</h5>
                </div>
                <div class="mb-5">
                    <div class="flex items-center justify-center gap-2 flex-wrap">
                        <span class="w-20 h-20 relative">
                            <img class="w-20 h-20 rounded-full overflow-hidden object-cover"
                                src="/public/assets/images/profile-12.jpeg" alt="" />
                            <span
                                class="absolute ltr:right-0 rtl:left-0 bottom-0 w-7 h-7 rounded-full ring-2 ring-white dark:ring-white-dark bg-danger"></span>
                        </span>
                        <span class="w-16 h-16 relative">
                            <img class="w-16 h-16 rounded-full overflow-hidden object-cover"
                                src="/public/assets/images/profile-12.jpeg" alt="" />
                            <span
                                class="absolute ltr:right-0 rtl:left-0 bottom-0 w-6 h-6 rounded-full ring-2 ring-white dark:ring-white-dark bg-success"></span>
                        </span>
                        <span class="w-14 h-14 relative">
                            <img class="w-14 h-14 rounded-full overflow-hidden object-cover"
                                src="/public/assets/images/profile-12.jpeg" alt="" />
                            <span
                                class="absolute ltr:right-0 rtl:left-0 bottom-0 w-5 h-5 rounded-full ring-2 ring-white dark:ring-white-dark bg-secondary"></span>
                        </span>
                        <span class="w-12 h-12 relative">
                            <img class="w-12 h-12 rounded-full overflow-hidden object-cover"
                                src="/public/assets/images/profile-12.jpeg" alt="" />
                            <span
                                class="absolute ltr:right-0 rtl:left-0 bottom-0 w-4 h-4 rounded-full ring-2 ring-white dark:ring-white-dark bg-info"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Shapes</h5>
                </div>
                <div class="mb-5">
                    <div class="flex items-center justify-center gap-2 flex-wrap">
                        <img class="w-20 h-20 rounded-md overflow-hidden object-cover" src="/public/assets/images/profile-12.jpeg"
                            alt="" />
                        <img class="w-16 h-16 rounded-full overflow-hidden object-cover"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-14 h-14 rounded-md overflow-hidden object-cover" src="/public/assets/images/profile-12.jpeg"
                            alt="" />
                        <img class="w-10 h-10 overflow-hidden object-cover" src="/public/assets/images/profile-12.jpeg" alt="" />
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Initials</h5>
                </div>
                <div class="mb-5">
                    <div class="flex items-center justify-center gap-2 text-white flex-wrap">
                        <span
                            class="flex justify-center items-center w-20 h-20 text-center rounded-full object-cover bg-success text-2xl">AG</span>
                        <span
                            class="flex justify-center items-center w-16 h-16 text-center rounded-full object-cover bg-primary text-xl">AG</span>
                        <span
                            class="flex justify-center items-center w-14 h-14 text-center rounded-full object-cover bg-info text-lg">AG</span>
                        <span
                            class="flex justify-center items-center w-10 h-10 text-center rounded-full object-cover bg-danger text-base">AG</span>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Group</h5>
                </div>
                <div class="flex items-center justify-around mb-5 gap-10 flex-wrap">
                    <div class="flex items-center justify-center -space-x-4 rtl:space-x-reverse text-white">
                        <img class="w-16 h-16 rounded-full overflow-hidden object-cover ring-2 ring-white dark:ring-white-dark"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-16 h-16 rounded-full overflow-hidden object-cover ring-2 ring-white dark:ring-white-dark"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-16 h-16 rounded-full overflow-hidden object-cover ring-2 ring-white dark:ring-white-dark"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <span
                            class="flex justify-center items-center w-16 h-16 text-center rounded-full object-cover bg-info text-xl ring-2 ring-white dark:ring-white-dark">AG</span>
                    </div>
                    <div class="flex items-center justify-center -space-x-4 rtl:space-x-reverse text-white">
                        <img class="w-12 h-12 rounded-full overflow-hidden object-cover ring-2 ring-white dark:ring-white-dark"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-12 h-12 rounded-full overflow-hidden object-cover ring-2 ring-white dark:ring-white-dark"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-12 h-12 rounded-full overflow-hidden object-cover ring-2 ring-white dark:ring-white-dark"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <span
                            class="flex justify-center items-center w-12 h-12 text-center rounded-full object-cover bg-info text-base ring-2 ring-white dark:ring-white-dark">AG</span>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Animate Y-axis</h5>
                </div>
                <div class="mb-5">
                    <div class="flex items-center justify-center -space-x-4 rtl:space-x-reverse text-white">
                        <img class="w-12 h-12 rounded-full object-cover ring-2 ring-white dark:ring-white-dark relative transition-all duration-300 hover:hover:translate-y-2"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-12 h-12 rounded-full object-cover ring-2 ring-white dark:ring-white-dark relative transition-all duration-300 hover:hover:translate-y-2"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-12 h-12 rounded-full object-cover ring-2 ring-white dark:ring-white-dark relative transition-all duration-300 hover:hover:translate-y-2"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <span
                            class="flex justify-center items-center w-12 h-12 text-center rounded-full object-cover bg-info text-base ring-2 ring-white dark:ring-white-dark relative transition-all duration-300 hover:hover:translate-y-2">AG</span>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Animate X-axis</h5>
                </div>
                <div class="mb-5">
                    <div class="flex items-center justify-center -space-x-4 rtl:space-x-reverse text-white">
                        <img class="w-12 h-12 rounded-full object-cover ring-2 ring-white dark:ring-white-dark relative transition-all duration-300 hover:translate-x-2"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-12 h-12 rounded-full object-cover ring-2 ring-white dark:ring-white-dark relative transition-all duration-300 hover:translate-x-2"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <img class="w-12 h-12 rounded-full object-cover ring-2 ring-white dark:ring-white-dark relative transition-all duration-300 hover:translate-x-2"
                            src="/public/assets/images/profile-12.jpeg" alt="" />
                        <span
                            class="flex justify-center items-center w-12 h-12 text-center rounded-full object-cover bg-info text-base ring-2 ring-white dark:ring-white-dark relative transition-all duration-300 hover:translate-x-2">AG</span>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Tooltip</h5>
                </div>
                <div class="mb-5">
                    <div class="flex items-center justify-center -space-x-4 rtl:space-x-reverse text-white">
                        <span><img v-tippy
                                class="w-12 h-12 rounded-full object-cover ring-2 ring-white dark:ring-white-dark"
                                src="/public/assets/images/profile-12.jpeg" alt="" />
                            <tippy>Judy Holmes</tippy>
                        </span>
                        <span><img v-tippy
                                class="w-12 h-12 rounded-full object-cover ring-2 ring-white dark:ring-white-dark"
                                src="/public/assets/images/profile-12.jpeg" alt="" />
                            <tippy>Judy Holmes</tippy>
                        </span>
                        <span><img v-tippy
                                class="w-12 h-12 rounded-full object-cover ring-2 ring-white dark:ring-white-dark"
                                src="/public/assets/images/profile-12.jpeg" alt="" />
                            <tippy>Judy Holmes</tippy>
                        </span>
                        <span><span v-tippy
                                class="flex justify-center items-center w-12 h-12 text-center rounded-full object-cover bg-info text-base ring-2 ring-white dark:ring-white-dark">AG</span>
                            <tippy>Alan Green</tippy>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>
