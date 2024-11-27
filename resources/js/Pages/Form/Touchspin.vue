<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Forms</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>TouchSpin</span>
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
                <span class="ltr:mr-3 rtl:ml-3">Documentation: </span><a
                    href="https://www.npmjs.com/package/vue3-number-spinner" target="_blank"
                    class="block hover:underline">https://www.npmjs.com/package/vue3-number-spinner</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Basic -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Button Spin</h5>
                    </div>
                    <div class="mb-5">
                        <div class="relative">
                            <div class="flex">
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border border-r-0 border-primary"
                                    @click="value1--">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <number-spinner v-model="value1" :min="0" :max="100" :step="1" :keyStep="1"
                                    class="form-input rounded-none text-center" />
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-r-md rtl:rounded-l-md px-3 font-semibold border border-l-0 border-primary"
                                    @click="value1++">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- step of 5 -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Spin button with step of 5</h5>
                    </div>
                    <div class="mb-5">
                        <div class="relative">
                            <div class="flex">
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border border-r-0 border-primary"
                                    @click="value2 -= 5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <number-spinner v-model="value2" :min="0" :max="50" :step="5" :keyStep="5"
                                    class="form-input rounded-none text-center" />
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-r-md rtl:rounded-l-md px-3 font-semibold border border-l-0 border-primary"
                                    @click="value2 += 5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wrapping value -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Wrapping value spin button</h5>
                    </div>
                    <div class="mb-5">
                        <div class="relative">
                            <div class="flex">
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border border-r-0 border-primary"
                                    @click="value3 -= 1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <number-spinner v-model="value3" :min="0" :max="21" :step="1" :keyStep="1" :circular="true"
                                    class="form-input rounded-none text-center" />
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-r-md rtl:rounded-l-md px-3 font-semibold border border-l-0 border-primary"
                                    @click="value3 += 1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Size -->
                <div class="panel lg:row-span-2">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Size</h5>
                    </div>
                    <!-- large -->
                    <div class="mb-5">
                        <div class="mb-5">
                            <label for="sizeLarge">Large size</label>
                            <div class="flex">
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border border-r-0 border-primary"
                                    @click="value4--">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <number-spinner v-model="value4" :min="0" :max="25" :step="1" :keyStep="1"
                                    class="form-input form-input-lg rounded-none text-center" />
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-r-md rtl:rounded-l-md px-3 font-semibold border border-l-0 border-primary"
                                    @click="value4++">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- default -->
                        <div class="mb-5">
                            <label for="sizeDefault">Default size</label>
                            <div class="flex">
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border border-r-0 border-primary"
                                    @click="value5--">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <number-spinner v-model="value5" :min="0" :max="25" :step="1" :keyStep="1"
                                    class="form-input rounded-none text-center" />
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-r-md rtl:rounded-l-md px-3 font-semibold border border-l-0 border-primary"
                                    @click="value5++">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- small -->
                        <div>
                            <label for="sizeSmall">Small size</label>
                            <div class="flex">
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border border-r-0 border-primary"
                                    @click="value6--">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <number-spinner v-model="value6" :min="0" :max="25" :step="1" :keyStep="1"
                                    class="form-input form-input-sm rounded-none text-center" />
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-r-md rtl:rounded-l-md px-3 font-semibold border border-l-0 border-primary"
                                    @click="value6++">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Inline Buttons -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Inline spin button</h5>
                    </div>
                    <div class="mb-5">
                        <div class="mb-5">
                            <div class="inline-flex">
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border border-r-0 border-primary"
                                    @click="value7--">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <number-spinner v-model="value7" :min="0" :max="25" :step="1" :keyStep="1"
                                    class="form-input rounded-none text-center" />
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-r-md rtl:rounded-l-md px-3 font-semibold border border-l-0 border-primary"
                                    @click="value7++">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vertical Buttons -->
                <div class="panel lg:row-span-2">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Vertical spin button</h5>
                    </div>
                    <div class="mb-5">
                        <div class="mb-5">
                            <div class="inline-flex flex-col w-[50px]">
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center rounded-t-md p-3 font-semibold border border-b-0 border-primary"
                                    @click="value8--">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <number-spinner v-model="value8" :min="0" :max="25" :step="1" :keyStep="1" :vertical="true"
                                    class="form-input rounded-none text-center px-2" />
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center rounded-b-md p-3 font-semibold border border-t-0 border-primary"
                                    @click="value8++">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- text with spin  -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Text with spin button</h5>
                    </div>
                    <div class="mb-5">
                        <div class="relative">
                            <div class="flex">
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border border-r-0 border-primary"
                                    @click="value9--">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <number-spinner v-model="value9" :format="dayFormatter" :min="0" :max="6" :step="1"
                                    :keyStep="1" class="form-input rounded-none text-center" />
                                <button type="button"
                                    class="bg-primary text-white flex justify-center items-center ltr:rounded-r-md rtl:rounded-l-md px-3 font-semibold border border-l-0 border-primary"
                                    @click="value9++">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Change Button Class -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Change button class</h5>
                    </div>
                    <div class="mb-5">
                        <div class="relative">
                            <div class="flex">
                                <button type="button"
                                    class="bg-danger text-white flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border border-r-0 border-danger"
                                    @click="value10--">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <number-spinner v-model="value10" :min="0" :max="25" :step="1" :keyStep="1"
                                    class="form-input rounded-none text-center" />
                                <button type="button"
                                    class="bg-warning text-white flex justify-center items-center ltr:rounded-r-md rtl:rounded-l-md px-3 font-semibold border border-l-0 border-warning"
                                    @click="value10++">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { NumberSpinner } from 'vue3-number-spinner';

const value1 = ref(0);
const value2 = ref(0);
const value3 = ref(0);
const value4 = ref(0);
const value5 = ref(0);
const value6 = ref(0);
const value7 = ref(0);
const value8 = ref(0);
const value9 = ref(0);
const value10 = ref(0);
const days = ref(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);

const dayFormatter = (value) => {
    return days.value[value];
};
</script>
