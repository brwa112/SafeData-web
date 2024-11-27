<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Elements</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Popovers</span>
            </li>
        </ul>
        <div class="pt-5 space-y-8">
            <div class="panel p-3 flex items-center text-primary overflow-x-auto whitespace-nowrap">
                <div class="ring-2 ring-primary/30 rounded-full bg-primary text-white p-1.5 ltr:mr-3 rtl:ml-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="w-3.5 h-3.5">
                        <path
                            d="M19.0001 9.7041V9C19.0001 5.13401 15.8661 2 12.0001 2C8.13407 2 5.00006 5.13401 5.00006 9V9.7041C5.00006 10.5491 4.74995 11.3752 4.28123 12.0783L3.13263 13.8012C2.08349 15.3749 2.88442 17.5139 4.70913 18.0116C9.48258 19.3134 14.5175 19.3134 19.291 18.0116C21.1157 17.5139 21.9166 15.3749 20.8675 13.8012L19.7189 12.0783C19.2502 11.3752 19.0001 10.5491 19.0001 9.7041Z"
                            stroke="currentColor" stroke-width="1.5" />
                        <path opacity="0.5" d="M7.5 19C8.15503 20.7478 9.92246 22 12 22C14.0775 22 15.845 20.7478 16.5 19"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>
                <span class="ltr:mr-3 rtl:ml-3">Documentation: </span><a href="https://www.npmjs.com/package/tippy.vue"
                    target="_blank" class="block hover:underline">https://www.npmjs.com/package/tippy.vue</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Default</h5>
                    </div>
                    <div class="mb-5">
                        <div class="flex justify-center w-full gap-4">
                            <a href="javascript:;" v-tippy:anchor class="btn bg-primary btn-primary">Link</a>
                            <tippy target="anchor" trigger="click">Popover using ANCHOR tag</tippy>

                            <button type="button" v-tippy:button class="btn btn-success">Button</button>
                            <tippy target="button" trigger="click">Popover using BUTTON tag</tippy>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Placement</h5>

                    </div>
                    <div class="mb-5">
                        <div class="flex flex-wrap justify-center gap-4 w-full">
                            <button type="button" v-tippy:top class="btn btn-info">Popover on top</button>
                            <tippy target="top" trigger="click" placement="top">Popover on top</tippy>

                            <button type="button" v-tippy:left class="btn btn-secondary">Popover on left</button>
                            <tippy target="left" trigger="click" :placement="rtlClass === 'rtl' ? 'right' : 'left'">
                                Popover on left</tippy>

                            <button type="button" v-tippy:right class="btn btn-danger">Popover on right</button>
                            <tippy target="right" trigger="click" :placement="rtlClass === 'rtl' ? 'left' : 'right'">
                                Popover on right</tippy>

                            <button type="button" v-tippy:bottom class="btn btn-warning">Popover on bottom</button>
                            <tippy target="bottom" trigger="click" placement="bottom">Popover on bottom</tippy>
                        </div>
                    </div>
                </div>

                <div class="panel lg:row-start-1 lg:col-start-2">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Dismissible popover</h5>
                    </div>
                    <div class="mb-5">
                        <div class="flex justify-center gap-4 w-full">
                            <button type="button" v-tippy:dismissible data-dismissable="true" class="btn btn-dark">Popover
                                on left</button>
                            <tippy target="dismissible" trigger="click"
                                :placement="rtlClass === 'rtl' ? 'right' : 'left'">Popover on left</tippy>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Options</h5>
                    </div>
                    <div class="mb-5">
                        <div class="flex flex-wrap justify-center gap-4 w-full">
                            <button type="button" v-tippy:hover class="btn btn-primary">On Hover</button>
                            <tippy target="hover" trigger="mouseenter">On hover</tippy>

                            <button type="button" v-tippy:focus class="btn btn-secondary">On Focus</button>
                            <tippy target="focus" trigger="focus">On focus</tippy>

                            <button type="button" v-tippy:delay class="btn btn-info">Delay</button>
                            <tippy target="delay" delay="1000" trigger="click">Delay 1s</tippy>

                            <button type="button" v-tippy:noanimation class="btn btn-dark">Disabled Animation</button>
                            <tippy target="noanimation" animation="false" trigger="click">Disabled animation</tippy>
                        </div>
                    </div>
                </div>

                <div class="panel lg:col-span-2">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Colors</h5>
                    </div>
                    <div class="mb-5">
                        <div class="flex flex-wrap justify-center gap-4 w-full">
                            <button type="button" v-tippy:primary class="btn btn-primary">Primary</button>
                            <tippy target="primary" trigger="click" :extra="{ theme: 'primary' }">Primary</tippy>

                            <button type="button" v-tippy:success class="btn btn-success">Success</button>
                            <tippy target="success" trigger="click" :extra="{ theme: 'success' }">Success</tippy>

                            <button type="button" v-tippy:info class="btn btn-info">Info</button>
                            <tippy target="info" trigger="click" :extra="{ theme: 'info' }">Info</tippy>

                            <button type="button" v-tippy:danger class="btn btn-danger">Danger</button>
                            <tippy target="danger" trigger="click" :extra="{ theme: 'danger' }">Danger</tippy>

                            <button type="button" v-tippy:warning class="btn btn-warning">Warning</button>
                            <tippy target="warning" trigger="click" :extra="{ theme: 'warning' }">Warning</tippy>

                            <button type="button" v-tippy:secondary class="btn btn-secondary">Secondary</button>
                            <tippy target="secondary" trigger="click" :extra="{ theme: 'secondary' }">Secondary</tippy>

                            <button type="button" v-tippy:dark class="btn btn-dark">Dark</button>
                            <tippy target="dark" trigger="click" :extra="{ theme: 'dark' }">Dark</tippy>
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
