<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Forms</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Switches</span>
            </li>
        </ul>
        <div class="pt-5 space-y-8">
            <div class="space-y-8">
                <h4 class="badge bg-primary inline-block hover:top-0 text-base">Icon</h4>
                <!-- Icons -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Default</h5>
                        </div>
                        <div class="mb-5">
                            <label class="w-12 h-6 relative">
                                <input type="checkbox"
                                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                    id="custom_switch_checkbox1" />
                                <span for="custom_switch_checkbox1"
                                    class="outline_checkbox bg-icon border-2 border-[#ebedf2] dark:border-white-dark block h-full before:absolute before:left-1 before:bg-[#ebedf2] dark:before:bg-white-dark before:bottom-1 before:w-4 before:h-4 before:bg-[url('/public/assets/images/close.svg')] before:bg-no-repeat before:bg-center peer-checked:before:left-7 peer-checked:before:bg-[url('/public/assets/images/checked.svg')] peer-checked:border-primary peer-checked:before:bg-primary before:transition-all before:duration-300"></span>
                            </label>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Rounded</h5>
                        </div>
                        <div class="mb-5">
                            <label class="w-12 h-6 relative">
                                <input type="checkbox"
                                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                    id="custom_switch_checkbox2" />
                                <span for="custom_switch_checkbox2"
                                    class="outline_checkbox bg-icon border-2 border-[#ebedf2] dark:border-white-dark block h-full rounded-full before:absolute before:left-1 before:bg-[#ebedf2] dark:before:bg-white-dark before:bottom-1 before:w-4 before:h-4 before:rounded-full before:bg-[url('/public/assets/images/close.svg')] before:bg-no-repeat before:bg-center peer-checked:before:left-7 peer-checked:before:bg-[url('/public/assets/images/checked.svg')] peer-checked:border-primary peer-checked:before:bg-primary before:transition-all before:duration-300"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-8">
                <h4 class="badge bg-primary inline-block hover:top-0 text-base">Solid</h4>
                <!-- Solid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Default</h5>
                        </div>
                        <div class="mb-5">
                            <label class="w-12 h-6 relative">
                                <input type="checkbox"
                                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                    id="custom_switch_checkbox3" />
                                <span for="custom_switch_checkbox3"
                                    class="bg-[#ebedf2] dark:bg-dark block h-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                            </label>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Rounded</h5>
                        </div>
                        <div class="mb-5">
                            <label class="w-12 h-6 relative">
                                <input type="checkbox"
                                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                    id="custom_switch_checkbox4" />
                                <span for="custom_switch_checkbox4"
                                    class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-8">
                <h4 class="badge bg-primary inline-block hover:top-0 text-base">Outline</h4>
                <!-- Outline -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Default</h5>
                        </div>
                        <div class="mb-5">
                            <label class="w-12 h-6 relative">
                                <input type="checkbox"
                                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                    id="custom_switch_checkbox5" />
                                <span for="custom_switch_checkbox5"
                                    class="outline_checkbox border-2 border-[#ebedf2] dark:border-white-dark block h-full before:absolute before:left-1 before:bg-[#ebedf2] dark:before:bg-white-dark before:bottom-1 before:w-4 before:h-4 peer-checked:before:left-7 peer-checked:border-primary peer-checked:before:bg-primary before:transition-all before:duration-300"></span>
                            </label>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Rounded</h5>
                        </div>
                        <div class="mb-5">
                            <label class="w-12 h-6 relative">
                                <input type="checkbox"
                                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                    id="custom_switch_checkbox6" />
                                <span for="custom_switch_checkbox6"
                                    class="outline_checkbox border-2 border-[#ebedf2] dark:border-white-dark block h-full rounded-full before:absolute before:left-1 before:bg-[#ebedf2] dark:before:bg-white-dark before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:border-primary peer-checked:before:bg-primary before:transition-all before:duration-300"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>
