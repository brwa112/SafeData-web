<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Elements</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Progress Bar</span>
            </li>
        </ul>
        <div class="pt-5 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Basic</h5>
                </div>
                <div class="mb-5 space-y-5">
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-primary h-4 rounded-full w-3/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-secondary h-4 rounded-full w-4/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-success h-4 rounded-full w-5/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-warning h-4 rounded-full w-6/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-danger h-4 rounded-full w-7/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-info h-4 rounded-full w-8/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-black dark:bg-dark h-4 rounded-full w-9/12"></div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Gradient</h5>
                </div>
                <div class="mb-5 space-y-5">
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-gradient-to-r from-[#0081ff] to-[#0045ff] h-4 rounded-full w-3/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-gradient-to-r from-[#04befe] to-[#4481eb] h-4 rounded-full w-4/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-gradient-to-r from-[#3cba92] to-[#0ba360] h-4 rounded-full w-5/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-gradient-to-r from-[#f09819] to-[#ff5858] h-4 rounded-full w-6/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-gradient-to-r from-[#d09693] to-[#c71d6f] h-4 rounded-full w-7/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-gradient-to-r from-[#7579ff] to-[#b224ef] h-4 rounded-full w-8/12"></div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-gradient-to-r from-[#2b5876] to-[#4e4376] h-4 rounded-full w-9/12"></div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Striped</h5>
                </div>
                <div class="mb-5 space-y-5">
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full test">
                        <div class="bg-primary h-4 rounded-full w-3/12 striped-bar"></div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Animated</h5>
                </div>
                <div class="mb-5 space-y-5">
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-primary h-4 rounded-full w-6/12 animated-progress striped-bar"></div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Labels</h5>
                </div>
                <div class="mb-5 space-y-5">
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div class="bg-info h-4 rounded-full w-4/5 text-center text-white text-xs">80%</div>
                    </div>
                    <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                        <div
                            class="bg-danger h-4 rounded-full w-11/12 text-center text-white flex justify-between items-center px-2 text-xs">
                            <span>PHP</span><span>90%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Stacked</h5>
                </div>
                <div class="mb-5 space-y-5">
                    <div class="space-y-2">
                        <h3 class="text-base">Basic</h3>
                        <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
                            <div
                                class="bg-success h-4 ltr:rounded-l-full rtl:rounded-r-full w-2/12 text-center text-white text-xs">
                            </div>
                            <div class="bg-warning h-4 w-4/12 text-center text-white text-xs"></div>
                            <div
                                class="bg-danger h-4 ltr:rounded-r-full rtl:rounded-l-full w-3/12 text-center text-white text-xs">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-base">Striped</h3>
                        <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
                            <div
                                class="bg-primary h-4 ltr:rounded-l-full rtl:rounded-r-full w-2/12 text-center text-white text-xs striped-bar-sm">
                            </div>
                            <div class="bg-success h-4 w-4/12 text-center text-white text-xs striped-bar-sm"></div>
                            <div
                                class="bg-info h-4 ltr:rounded-r-full rtl:rounded-l-full w-3/12 text-center text-white text-xs striped-bar-sm">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-base">Animated</h3>
                        <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
                            <div
                                class="bg-info h-4 ltr:rounded-l-full rtl:rounded-r-full w-2/12 animated-progress text-center text-white text-xs striped-bar-sm">
                            </div>
                            <div
                                class="bg-secondary h-4 w-4/12 animated-progress text-center text-white text-xs striped-bar-sm">
                            </div>
                            <div
                                class="bg-primary h-4 ltr:rounded-r-full rtl:rounded-l-full w-3/12 animated-progress text-center text-white text-xs striped-bar-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel lg:row-span-2 lg:row-start-3">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Progress Bars Different Sizes</h5>
                </div>
                <div class="mb-5 space-y-5">
                    <div class="space-y-1">
                        <h3 class="text-primary">Default Progress Bar Size</h3>
                        <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
                            <div class="bg-primary h-4 rounded-full rounded-bl-full w-3/12 text-center text-white text-xs">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-base text-success">Progress-sm</h3>
                        <div class="w-full h-1 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
                            <div class="bg-success h-1 rounded-full rounded-bl-full w-5/12 text-center text-white text-xs">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-base text-warning">Progress-md</h3>
                        <div class="w-full h-2.5 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
                            <div
                                class="bg-warning h-2.5 rounded-full rounded-bl-full w-7/12 text-center text-white text-xs">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-base text-info">Progress-lg</h3>
                        <div class="w-full h-5 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
                            <div class="bg-info h-5 rounded-full rounded-bl-full w-8/12 text-center text-white text-xs">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-base text-danger">Progress-xl</h3>
                        <div class="w-full h-6 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
                            <div class="bg-danger h-6 rounded-full rounded-bl-full w-10/12 text-center text-white text-xs">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>
<style>
.striped-bar {
    background-image: linear-gradient(45deg,
            hsla(0, 0%, 100%, 0.15) 25%,
            transparent 0,
            transparent 50%,
            hsla(0, 0%, 100%, 0.15) 0,
            hsla(0, 0%, 100%, 0.15) 75%,
            transparent 0,
            transparent);
    background-size: 1rem 1rem;
}

.striped-bar-sm {
    background-image: linear-gradient(45deg,
            hsla(0, 0%, 100%, 0.15) 25%,
            transparent 0,
            transparent 50%,
            hsla(0, 0%, 100%, 0.15) 0,
            hsla(0, 0%, 100%, 0.15) 75%,
            transparent 0,
            transparent);
    background-size: 1rem 1rem;
}
</style>
