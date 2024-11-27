<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Elements</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Jumbotron</span>
            </li>
        </ul>
        <div class="pt-5 grid grid-cols-1 xl:grid-cols-2 gap-6">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Basic</h5>
                </div>
                <div class="mb-5">
                    <div class="w-full">
                        <div
                            class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light">
                            <h2 class="text-dark mb-5 mt-4 text-center text-5xl dark:text-white-light">Hello, world!</h2>
                            <p class="lead mt-3 mb-4 dark:text-white-light">
                                This is a simple hero unit, a simple jumbotron-style component for calling extra attention
                                to featured content or information.
                            </p>
                            <hr class="my-4 dark:border-[#191e3a]" />
                            <p class="mb-5">It uses utility classes for typography and spacing to space content out within
                                the larger container.</p>
                            <p class="lead"><button type="button" class="btn btn-dark">Learn more</button></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Jumbotron Fluid</h5>
                </div>
                <div class="mb-5">
                    <div class="w-full">
                        <div
                            class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light">
                            <h2 class="text-dark mb-5 mt-4 text-center text-5xl dark:text-white-light">Fluid Jumbotron</h2>
                            <p class="lead mt-3 mb-4 dark:text-white-light">
                                This is a modified jumbotron that occupies the entire horizontal space of its parent.
                            </p>
                            <blockquote
                                class="text-black p-5 ltr:pl-3.5 rtl:pr-3.5 bg-white shadow-md rounded-tr-md rounded-br-md border border-white-light border-l-2 !border-l-primary dark:bg-[#060818] dark:border-[#060818]">
                                <div class="flex items-start">
                                    <div class="w-14 h-14 ltr:mr-5 rtl:ml-5 flex-none">
                                        <img src="/public/assets/images/profile-34.jpeg" alt=""
                                            class="w-14 h-14 rounded-full object-cover m-auto" />
                                    </div>
                                    <p class="not-italic text-[#515365] text-sm dark:text-white-light m-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a
                                        ante.
                                    </p>
                                </div>
                                <small
                                    class="ltr:text-right rtl:text-left w-full not-italic text-xs text-[#777] block before:w-3 before:h-[1px] before:bg-[#777] before:inline-block before:opacity-50 before:relative before:-top-1 before:ltr:mr-1 rtl:before:ml-1">Someone
                                    famous <cite class="italic">Source Title</cite></small>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>
