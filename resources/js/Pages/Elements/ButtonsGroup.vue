<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Elements</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Button Group</span>
            </li>
        </ul>
        <div class="pt-5 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Horizontal</h5>
                </div>
                <div class="mb-5 text-center">
                    <div class="relative inline-flex align-middle">
                        <button type="button" class="btn btn-dark ltr:rounded-r-none rtl:rounded-l-none">Left</button>
                        <button type="button" class="btn btn-dark rounded-none">Middle</button>
                        <button type="button" class="btn btn-dark ltr:rounded-l-none rtl:rounded-r-none">Right</button>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input Group</h5>
                </div>
                <div class="mb-5">
                    <div class="flex flex-wrap justify-center sm:justify-between items-center gap-4 w-full">
                        <div>
                            <div class="relative inline-flex align-middle">
                                <button type="button" class="btn btn-dark ltr:rounded-r-none rtl:rounded-l-none">1</button>
                                <button type="button" class="btn btn-dark rounded-none">2</button>
                                <button type="button" class="btn btn-dark rounded-none">3</button>
                                <button type="button" class="btn btn-dark ltr:rounded-l-none rtl:rounded-r-none">4</button>
                            </div>
                        </div>
                        <div class="flex relative items-stretch flex-wrap">
                            <div class="ltr:-mr-px rtl:-ml-px flex">
                                <span
                                    class="border border-[#e0e6ed] dark:border-[#17263c] ltr:rounded-l rtl:rounded-r bg-[#f1f2f3] flex items-center justify-center text-black px-4 py-1.5 dark:bg-[#1a1c2d] dark:text-white-dark">@</span>
                            </div>
                            <input type="text" placeholder="Input group example"
                                class="flex-1 form-input ltr:rounded-l-none rtl:rounded-r-none" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Vertical</h5>
                </div>
                <div class="mb-5 text-center">
                    <div class="relative inline-flex align-middle flex-col items-start justify-center">
                        <button type="button" class="btn btn-dark rounded-b-none w-full">Button</button>
                        <div class="dropdown">
                            <Popper :placement="rtlClass === 'rtl' ? 'bottom-start' : 'bottom-end'" offsetDistance="0"
                                class="align-middle">
                                <a href="javascript:;" class="btn dropdown-toggle btn-dark rounded-none">
                                    Dropdown
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ltr:ml-2 rtl:mr-2 inline-block">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <template #content="{ close }">
                                    <ul @click="close()">
                                        <li>
                                            <a href="javascript:;">Dropdown link</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Dropdown link</a>
                                        </li>
                                    </ul>
                                </template>
                            </Popper>
                        </div>
                        <button type="button" class="btn btn-dark rounded-none w-full">Button</button>
                        <button type="button" class="btn btn-dark rounded-none w-full">Button</button>
                        <div class="dropdown">
                            <Popper :placement="rtlClass === 'rtl' ? 'top-start' : 'top-end'" offsetDistance="0"
                                class="align-middle">
                                <a href="javascript:;" class="btn dropdown-toggle btn-dark rounded-t-none">
                                    Dropdown
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ltr:ml-2 rtl:mr-2 inline-block">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <template #content="{ close }">
                                    <ul @click="close()">
                                        <li>
                                            <a href="javascript:;">Dropdown link</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Dropdown link</a>
                                        </li>
                                    </ul>
                                </template>
                            </Popper>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { inject } from 'vue';

const rtlClass = inject('rtlClass');
</script>
