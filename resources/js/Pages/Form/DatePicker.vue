<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Forms</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Date and Range Picker</span>
            </li>
        </ul>
        <div class="pt-5 space-y-8">
            <div class="bg-[#009688]/[.26] text-[#009688] py-1 px-2 rounded inline-block text-base">Date and Time Picker
            </div>
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
                    href="https://www.npmjs.com/package/vue-flatpickr-component" target="_blank"
                    class="block hover:underline">https://www.npmjs.com/package/vue-flatpickr-component</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Basic -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Basic</h5>
                    </div>
                    <div class="mb-5">
                        <flat-pickr v-model="date1" class="form-input" :config="basic"></flat-pickr>
                    </div>
                </div>

                <!-- Date & time -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Date Time</h5>
                    </div>
                    <div class="mb-2.5">Use <code class="text-danger">{enableTime: true, dateFormat: 'Y-m-d H:i'}</code>
                        option to enable time support</div>
                    <div class="mb-5">
                        <flat-pickr v-model="date2" class="form-input" :config="dateTime"></flat-pickr>
                    </div>
                </div>

                <!-- range-calendar -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Range Calendar</h5>
                    </div>
                    <div class="mb-2.5">Use <code class="text-danger">{mode: 'range'}</code> select the date with range.
                    </div>
                    <div class="mb-5">
                        <flat-pickr v-model="date3" class="form-input" :config="rangeCalendar"></flat-pickr>
                    </div>
                </div>

                <!-- preloading time -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Preloading Time</h5>
                    </div>
                    <div class="mb-2.5">
                        Use <code class="text-danger">{noCalendar: true, enableTime: true, dateFormat: 'H:i'}</code> with
                        Date Time options to disable calendar
                        and show time picker only.
                    </div>
                    <div class="mb-5">
                        <flat-pickr v-model="date4" class="form-input" :config="preloadingTime"></flat-pickr>
                    </div>
                </div>
            </div>

            <!-- range picker -->
            <div class="bg-[#009688]/[.26] text-[#009688] py-1 px-2 rounded inline-block text-base">Javascript Range Slider
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Top-Left -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Postion : Top-Left</h5>
                    </div>
                    <div class="mb-5 pt-5">
                        <div class="font-bold">
                            <span
                                class="inline-block py-1 px-2 rounded text-primary border border-white-light dark:border-dark">{{
                                    slider1 }}</span>
                            <span>%</span>
                        </div>
                        <input type="range" class="w-full py-2.5" min="0" max="100" v-model="slider1" />
                    </div>
                </div>

                <!-- Top-right -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Postion : Top-right</h5>
                    </div>
                    <div class="mb-5">
                        <div class="font-bold ltr:text-right rtl:text-left">
                            <span
                                class="inline-block py-1 px-2 rounded text-primary border border-white-light dark:border-dark">{{
                                    slider2 }}</span>
                            <span>%</span>
                        </div>
                        <input type="range" class="w-full py-2.5" min="0" max="100" v-model="slider2" />
                    </div>
                </div>

                <!-- bottom-left -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Postion : Bottom-Left</h5>
                    </div>
                    <div class="mb-5">
                        <input type="range" class="w-full py-2.5" min="0" max="100" v-model="slider3" />
                        <div class="font-bold">
                            <span
                                class="inline-block py-1 px-2 rounded text-primary border border-white-light dark:border-dark">{{
                                    slider3 }}</span>
                            <span>%</span>
                        </div>
                    </div>
                </div>

                <!-- Bottom-right -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Postion : Bottom-right</h5>
                    </div>
                    <div class="mb-5">
                        <input type="range" class="w-full py-2.5" min="0" max="100" v-model="slider4" />
                        <div class="font-bold ltr:text-right rtl:text-left">
                            <span
                                class="inline-block py-1 px-2 rounded text-primary border border-white-light dark:border-dark">{{
                                    slider4 }}</span>
                            <span>%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nouislider -->
            <div class="bg-[#009688]/[.26] text-[#009688] py-1 px-2 rounded inline-block text-base">noUI Slider</div>

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
                    href="https://www.npmjs.com/package/vue-simple-range-slider" target="_blank"
                    class="block hover:underline">https://www.npmjs.com/package/vue-simple-range-slider</a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 range-slider">
                <!-- Using HTML5 input elements -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Using HTML5 input elements</h5>
                    </div>
                    <div class="mb-5 pt-5">
                        <VueSimpleRangeSlider style="width: 100%" :min="0" :max="100" v-model="nouiSlider1"
                                :update="slider1Update(nouiSlider1)" :bar-color="theme === 'dark' ? '#1b2e4b' : '#ffffff'"
                                active-bar-color="#4361ee"></VueSimpleRangeSlider>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 my-4">
                            <div class="mb-3">
                                <select v-model="nouiMin1" class="form-select w-full" id="select"
                                    @change="selectUpdateValue()">
                                    <template v-for="(i, index) in 100" :key="i">
                                        <option>{{ index }}</option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <input type="number" v-model="nouiMax1" class="form-input" :min="-20" :max="100" step="1"
                                    @blur="selectUpdateValue()" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Non linear slider -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Non linear slider</h5>
                    </div>
                    <div class="mb-5 pt-5">
                        <VueSimpleRangeSlider style="width: 100%" :min="0" :max="10000" v-model="nouiSlider2"
                            :bar-color="theme === 'dark' ? '#1b2e4b' : '#ffffff'" active-bar-color="#4361ee"
                            :update="slider2Update(nouiSlider2)">
                        </VueSimpleRangeSlider>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 my-5 font-bold">
                            <div>
                                <span class="text-primary mr-2" id="nouiMin2">{{ parseInt(nouiSlider2[0]).toFixed(2)
                                }}</span><span
                                    class="border border-white-light dark:border-dark py-1 px-2 text-dark dark:text-white-dark rounded"
                                    id="nouiMin2Perc">{{ nouiMin2Perc }}%</span>
                            </div>
                            <div class="ltr:text-right rtl:text-left">
                                <span class="text-primary mr-2" id="nouiMax2">{{ parseInt(nouiSlider2[1]).toFixed(2)
                                }}</span><span
                                    class="border border-white-light dark:border-dark py-1 px-2 text-dark dark:text-white-dark rounded"
                                    id="nouiMax2Perc">{{ nouiMax2Perc }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Locking slider -->
                <div class="panel lg:col-span-2">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Locking sliders together</h5>
                    </div>
                    <div class="mb-5 pt-5">
                        <VueSimpleRangeSlider style="width: 100%" :min="0" :max="100" v-model="nouiSlider3"
                            :bar-color="theme === 'dark' ? '#1b2e4b' : '#ffffff'" active-bar-color="#4361ee"
                            :update="setLockSlider1()">
                        </VueSimpleRangeSlider>
                        <div class="text-primary font-bold mb-10" id="locking_slider1_value"></div>
                        <VueSimpleRangeSlider style="width: 100%" :min="0" v-model="nouiSlider4"
                            :bar-color="theme === 'dark' ? '#1b2e4b' : '#ffffff'" active-bar-color="#4361ee">
                        </VueSimpleRangeSlider>
                        <div class="text-primary font-bold mb-10" id="locking_slider2_value"></div>
                        <div class="ltr:text-right rtl:text-left">
                            <button type="button" class="btn btn-primary" id="lockbutton" @click="setLock">{{ lockedState ?
                                'Unlock' : 'Lock' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted, inject } from 'vue';

//flatpickr
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
// range slider
import VueSimpleRangeSlider from 'vue-simple-range-slider';
import 'vue-simple-range-slider/css';

const theme = inject('theme');
const rtlClass = inject('rtlClass');

const date1 = ref('2022-07-05');
const basic = ref({
    dateFormat: 'Y-m-d',
    position: rtlClass === 'rtl' ? 'auto right' : 'auto left',
});

const date2 = ref('2022-07-05 12:00');
const dateTime = ref({
    enableTime: true,
    dateFormat: 'Y-m-d H:i',
    position: rtlClass === 'rtl' ? 'auto right' : 'auto left',
});

const date3 = ref('2022-07-05 to 2022-07-10');
const rangeCalendar = ref({
    dateFormat: 'Y-m-d',
    mode: 'range',
    position: rtlClass === 'rtl' ? 'auto right' : 'auto left',
});

const date4 = ref('13:45');
const preloadingTime = ref({
    noCalendar: true,
    enableTime: true,
    dateFormat: 'H:i',
    position: rtlClass === 'rtl' ? 'auto right' : 'auto left',
});

const slider1 = ref(0);
const slider2 = ref(0);
const slider3 = ref(0);
const slider4 = ref(0);

const nouiMin1 = ref(20);
const nouiMax1 = ref(40);
const nouiSlider1 = ref([nouiMin1.value, nouiMax1.value]);

const nouiSlider2 = ref([500, 4000]);
const nouiMin2Perc = ref(0);
const nouiMax2Perc = ref(0);

onMounted(() => {
    setLock();
});

const slider1Update = (range) => {
    if (range) {
        nouiMin1.value = range[0];
        nouiMax1.value = JSON.parse(JSON.stringify(range[1]));
    }
};
const slider2Update = (range) => {
    if (range) {
        nouiMin2Perc.value = parseFloat((range[0] * 0.01).toFixed(2));
        nouiMax2Perc.value = parseFloat((range[1] * 0.01).toFixed(2));
    }
};
const selectUpdateValue = () => {
    nouiSlider1.value = [nouiMin1.value, nouiMax1.value];
};

const nouiSlider3 = ref(5);
const nouiSlider4 = ref(10);
const lockedState = ref(false);
const lockingSlider1 = ref(0);
const lockingSlider2 = ref(0);

const setLock = () => {
    lockedState.value = !lockedState.value;
    if (lockedState.value) {
        lockingSlider1.value = nouiSlider3.value;
        lockingSlider2.value = nouiSlider4.value;
    }
};

const setLockSlider1 = () => {
    if (!lockedState.value) {
        return false;
    }

    if (lockingSlider1.value > lockingSlider2.value) {
        nouiSlider4.value = nouiSlider3.value - lockingSlider1.value;
    } else if (lockingSlider1.value < lockingSlider2.value) {
        nouiSlider4.value = lockingSlider1.value + nouiSlider3.value;
    } else {
        nouiSlider4.value = nouiSlider3.value;
    }
};
</script>
