<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Components</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Modals</span>
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
                <span class="ltr:mr-3 rtl:ml-3">Documentation: </span><a href="https://headlessui.com/vue/dialog"
                    target="_blank" class="block hover:underline">https://headlessui.com/vue/dialog</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- basic -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Basic</h5>
                    </div>

                    <div class="mb-5">
                        <!-- Trigger -->
                        <div class="flex items-center justify-center">
                            <button type="button" class="btn btn-primary" @click="modal1 = true">Launch modal</button>
                        </div>

                        <!-- Modal -->
                        <TransitionRoot appear :show="modal1" as="template">
                            <Dialog as="div" @close="modal1 = false" class="relative z-50">
                                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                    leave-to="opacity-0">
                                    <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                </TransitionChild>

                                <div class="fixed inset-0 overflow-y-auto">
                                    <div class="flex min-h-full items-start justify-center px-4 py-8">
                                        <TransitionChild as="template" enter="duration-300 ease-out"
                                            enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                            leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                            leave-to="opacity-0 scale-95">
                                            <DialogPanel
                                                class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                                <button type="button"
                                                    class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                    @click="modal1 = false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-6 h-6">
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                    </svg>
                                                </button>
                                                <div
                                                    class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                    Modal Title
                                                </div>
                                                <div class="p-5">
                                                    <p>
                                                        Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros.
                                                        Phasellus egestas sit amet velit sed
                                                        luctus. Orci varius natoque penatibus et magnis dis parturient
                                                        montes, nascetur ridiculus mus.
                                                        Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut sit
                                                        amet ullamcorper mi.
                                                    </p>

                                                    <div class="flex justify-end items-center mt-8">
                                                        <button type="button" @click="modal1 = false"
                                                            class="btn btn-outline-danger">Discard</button>
                                                        <button type="button" @click="modal1 = false"
                                                            class="btn btn-primary ltr:ml-4 rtl:mr-4">Save</button>
                                                    </div>
                                                </div>
                                            </DialogPanel>
                                        </TransitionChild>
                                    </div>
                                </div>
                            </Dialog>
                        </TransitionRoot>
                    </div>

                </div>

                <!-- Vertically Centered -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Vertically Centered</h5>
                    </div>
                    <div class="mb-5">
                        <!-- Trigger -->
                        <div class="flex items-center justify-center">
                            <button type="button" class="btn btn-info" @click="modal2 = true">Launch modal</button>
                        </div>

                        <!-- Modal -->
                        <TransitionRoot appear :show="modal2" as="template">
                            <Dialog as="div" @close="modal2 = false" class="relative z-50">
                                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                    leave-to="opacity-0">
                                    <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                </TransitionChild>

                                <div class="fixed inset-0 overflow-y-auto">
                                    <div class="flex min-h-full items-center justify-center px-4 py-8">
                                        <TransitionChild as="template" enter="duration-300 ease-out"
                                            enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                            leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                            leave-to="opacity-0 scale-95">
                                            <DialogPanel
                                                class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                                <button type="button"
                                                    class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                    @click="modal2 = false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-6 h-6">
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                    </svg>
                                                </button>
                                                <div
                                                    class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                    Modal Title
                                                </div>
                                                <div class="p-5">
                                                    <p>
                                                        Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros.
                                                        Phasellus egestas sit amet velit sed
                                                        luctus. Orci varius natoque penatibus et magnis dis parturient
                                                        montes, nascetur ridiculus mus.
                                                        Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut sit
                                                        amet ullamcorper mi.
                                                    </p>

                                                    <div class="flex justify-end items-center mt-8">
                                                        <button type="button" @click="modal2 = false"
                                                            class="btn btn-outline-danger">Discard</button>
                                                        <button type="button" @click="modal2 = false"
                                                            class="btn btn-primary ltr:ml-4 rtl:mr-4">Save</button>
                                                    </div>
                                                </div>
                                            </DialogPanel>
                                        </TransitionChild>
                                    </div>
                                </div>
                            </Dialog>
                        </TransitionRoot>
                    </div>

                </div>

                <!-- static -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Static</h5>
                    </div>
                    <div class="mb-5">
                        <!-- Trigger -->
                        <div class="flex items-center justify-center">
                            <button type="button" class="btn btn-secondary" @click="modal3 = true">Static modal</button>
                        </div>

                        <!-- Modal -->
                        <TransitionRoot appear :show="modal3" as="template">
                            <Dialog as="div" class="relative z-50">
                                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                    leave-to="opacity-0">
                                    <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                </TransitionChild>

                                <div class="fixed inset-0 overflow-y-auto">
                                    <div class="flex min-h-full items-start justify-center px-4 py-8">
                                        <TransitionChild as="template" enter="duration-300 ease-out"
                                            enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                            leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                            leave-to="opacity-0 scale-95">
                                            <DialogPanel
                                                class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                                <button type="button"
                                                    class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                    @click="modal3 = false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-6 h-6">
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                    </svg>
                                                </button>
                                                <div
                                                    class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                    Modal Title
                                                </div>
                                                <div class="p-5">
                                                    <p>
                                                        Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros.
                                                        Phasellus egestas sit amet velit sed
                                                        luctus. Orci varius natoque penatibus et magnis dis parturient
                                                        montes, nascetur ridiculus mus.
                                                        Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut sit
                                                        amet ullamcorper mi.
                                                    </p>

                                                    <div class="flex justify-end items-center mt-8">
                                                        <button type="button" @click="modal3 = false"
                                                            class="btn btn-outline-danger">Discard</button>
                                                        <button type="button" @click="modal3 = false"
                                                            class="btn btn-primary ltr:ml-4 rtl:mr-4">Save</button>
                                                    </div>
                                                </div>
                                            </DialogPanel>
                                        </TransitionChild>
                                    </div>
                                </div>
                            </Dialog>
                        </TransitionRoot>
                    </div>

                </div>

                <!-- Remove animation -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Remove animation</h5>
                    </div>
                    <div class="mb-5">
                        <!-- Trigger -->
                        <div class="flex items-center justify-center">
                            <button type="button" class="btn btn-success" @click="modal4 = true">Launch modal</button>
                        </div>

                        <!-- Modal -->
                        <Dialog as="div" :open="modal4" @close="modal4 = false" class="relative z-50">
                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />

                            <div class="fixed inset-0 overflow-y-auto">
                                <div class="flex min-h-full items-start justify-center px-4 py-8">
                                    <DialogPanel
                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                        <button type="button"
                                            class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                            @click="modal4 = false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                        <div
                                            class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                            Modal Title
                                        </div>
                                        <div class="p-5">
                                            <p>
                                                Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros. Phasellus
                                                egestas sit amet velit sed luctus.
                                                Orci varius natoque penatibus et magnis dis parturient montes, nascetur
                                                ridiculus mus. Suspendisse potenti.
                                                Vivamus ultrices sed urna ac pulvinar. Ut sit amet ullamcorper mi.
                                            </p>

                                            <div class="flex justify-end items-center mt-8">
                                                <button type="button" @click="modal4 = false"
                                                    class="btn btn-outline-danger">Discard</button>
                                                <button type="button" @click="modal4 = false"
                                                    class="btn btn-primary ltr:ml-4 rtl:mr-4">Save</button>
                                            </div>
                                        </div>
                                    </DialogPanel>
                                </div>
                            </div>
                        </Dialog>
                    </div>

                </div>

                <!-- Optional sizes -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Optional sizes</h5>
                    </div>
                    <div class="mb-5">
                        <div class="flex items-center justify-center gap-2">
                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-warning" @click="modal5 = true">Extra large</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal5" as="template">
                                    <Dialog as="div" @close="modal5 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <TransitionChild as="template" enter="duration-300 ease-out"
                                                    enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                                    leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                                    leave-to="opacity-0 scale-95">
                                                    <DialogPanel
                                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-5xl text-black dark:text-white-dark">
                                                        <button type="button"
                                                            class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                            @click="modal5 = false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                height="24px" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="w-6 h-6">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                        <div
                                                            class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                            Modal Title
                                                        </div>
                                                        <div class="p-5">
                                                            <p>
                                                                Mauris mi tellus, pharetra vel mattis sed, tempus ultrices
                                                                eros. Phasellus egestas sit amet
                                                                velit sed luctus. Orci varius natoque penatibus et magnis
                                                                dis parturient montes, nascetur
                                                                ridiculus mus. Suspendisse potenti. Vivamus ultrices sed
                                                                urna ac pulvinar. Ut sit amet
                                                                ullamcorper mi.
                                                            </p>

                                                            <div class="flex justify-end items-center mt-8">
                                                                <button type="button" @click="modal5 = false"
                                                                    class="btn btn-outline-danger">Discard</button>
                                                                <button type="button" @click="modal5 = false"
                                                                    class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </DialogPanel>
                                                </TransitionChild>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-danger" @click="modal6 = true">Large</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal6" as="template">
                                    <Dialog as="div" @close="modal6 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <TransitionChild as="template" enter="duration-300 ease-out"
                                                    enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                                    leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                                    leave-to="opacity-0 scale-95">
                                                    <DialogPanel
                                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-xl text-black dark:text-white-dark">
                                                        <button type="button"
                                                            class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                            @click="modal6 = false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                height="24px" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="w-6 h-6">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                        <div
                                                            class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                            Modal Title
                                                        </div>
                                                        <div class="p-5">
                                                            <p>
                                                                Mauris mi tellus, pharetra vel mattis sed, tempus ultrices
                                                                eros. Phasellus egestas sit amet
                                                                velit sed luctus. Orci varius natoque penatibus et magnis
                                                                dis parturient montes, nascetur
                                                                ridiculus mus. Suspendisse potenti. Vivamus ultrices sed
                                                                urna ac pulvinar. Ut sit amet
                                                                ullamcorper mi.
                                                            </p>

                                                            <div class="flex justify-end items-center mt-8">
                                                                <button type="button" @click="modal6 = false"
                                                                    class="btn btn-outline-danger">Discard</button>
                                                                <button type="button" @click="modal6 = false"
                                                                    class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </DialogPanel>
                                                </TransitionChild>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-secondary" @click="modal7 = true">Small</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal7" as="template">
                                    <Dialog as="div" @close="modal7 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <TransitionChild as="template" enter="duration-300 ease-out"
                                                    enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                                    leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                                    leave-to="opacity-0 scale-95">
                                                    <DialogPanel
                                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-sm text-black dark:text-white-dark">
                                                        <button type="button"
                                                            class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                            @click="modal7 = false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                height="24px" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="w-6 h-6">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                        <div
                                                            class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                            Modal Title
                                                        </div>
                                                        <div class="p-5">
                                                            <p>
                                                                Mauris mi tellus, pharetra vel mattis sed, tempus ultrices
                                                                eros. Phasellus egestas sit amet
                                                                velit sed luctus. Orci varius natoque penatibus et magnis
                                                                dis parturient montes, nascetur
                                                                ridiculus mus. Suspendisse potenti. Vivamus ultrices sed
                                                                urna ac pulvinar. Ut sit amet
                                                                ullamcorper mi.
                                                            </p>

                                                            <div class="flex justify-end items-center mt-8">
                                                                <button type="button" @click="modal7 = false"
                                                                    class="btn btn-outline-danger">Discard</button>
                                                                <button type="button" @click="modal7 = false"
                                                                    class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </DialogPanel>
                                                </TransitionChild>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Video -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Video</h5>
                    </div>

                    <div class="mb-5">
                        <!-- Trigger -->
                        <div class="flex items-center justify-center">
                            <button type="button" class="btn btn-primary" @click="modal8 = true">Play Youtube</button>
                        </div>

                        <!-- Modal -->
                        <TransitionRoot appear :show="modal8" as="template">
                            <Dialog as="div" @close="modal8 = false" class="relative z-50">
                                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                    leave-to="opacity-0">
                                    <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                </TransitionChild>

                                <div class="fixed inset-0 overflow-y-auto">
                                    <div class="flex min-h-full items-start justify-center px-4 py-8">
                                        <TransitionChild as="template" enter="duration-300 ease-out"
                                            enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                            leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                            leave-to="opacity-0 scale-95">
                                            <DialogPanel class="relative overflow-hidden w-full max-w-3xl py-8">
                                                <button type="button"
                                                    class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                    @click="modal8 = false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-6 h-6">
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                    </svg>
                                                </button>
                                                <div class="p-5">
                                                    <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                                        class="w-full h-[250px] md:h-[550px]"></iframe>
                                                </div>
                                            </DialogPanel>
                                        </TransitionChild>
                                    </div>
                                </div>
                            </Dialog>
                        </TransitionRoot>
                    </div>


                </div>

                <!-- Animation Style Modal -->
                <div class="panel lg:col-span-2">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Animation Style Modal</h5>
                    </div>
                    <div class="mb-5">
                        <div class="flex flex-wrap items-center justify-center gap-2">
                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-primary" @click="modal9 = true">FadeIn</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal9" as="template">
                                    <Dialog as="div" @close="modal9 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <DialogPanel
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark animate__animated animate__fadeIn">
                                                    <button type="button"
                                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                        @click="modal9 = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" class="w-6 h-6">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <div
                                                        class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                        Modal Title
                                                    </div>
                                                    <div class="p-5">
                                                        <p>
                                                            Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros.
                                                            Phasellus egestas sit amet velit
                                                            sed luctus. Orci varius natoque penatibus et magnis dis
                                                            parturient montes, nascetur ridiculus mus.
                                                            Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut
                                                            sit amet ullamcorper mi.
                                                        </p>

                                                        <div class="flex justify-end items-center mt-8">
                                                            <button type="button" @click="modal9 = false"
                                                                class="btn btn-outline-danger">Discard</button>
                                                            <button type="button" @click="modal9 = false"
                                                                class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </DialogPanel>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-info" @click="modal10 = true">SlideIn Down</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal10" as="template">
                                    <Dialog as="div" @close="modal10 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <DialogPanel
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark animate__animated animate__slideInDown">
                                                    <button type="button"
                                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                        @click="modal10 = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" class="w-6 h-6">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <div
                                                        class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                        Modal Title
                                                    </div>
                                                    <div class="p-5">
                                                        <p>
                                                            Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros.
                                                            Phasellus egestas sit amet velit
                                                            sed luctus. Orci varius natoque penatibus et magnis dis
                                                            parturient montes, nascetur ridiculus mus.
                                                            Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut
                                                            sit amet ullamcorper mi.
                                                        </p>

                                                        <div class="flex justify-end items-center mt-8">
                                                            <button type="button" @click="modal10 = false"
                                                                class="btn btn-outline-danger">Discard</button>
                                                            <button type="button" @click="modal10 = false"
                                                                class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </DialogPanel>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-success" @click="modal11 = true">FadeIn Up</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal11" as="template">
                                    <Dialog as="div" @close="modal11 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <DialogPanel
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark animate__animated animate__fadeInUp">
                                                    <button type="button"
                                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                        @click="modal11 = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" class="w-6 h-6">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <div
                                                        class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                        Modal Title
                                                    </div>
                                                    <div class="p-5">
                                                        <p>
                                                            Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros.
                                                            Phasellus egestas sit amet velit
                                                            sed luctus. Orci varius natoque penatibus et magnis dis
                                                            parturient montes, nascetur ridiculus mus.
                                                            Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut
                                                            sit amet ullamcorper mi.
                                                        </p>

                                                        <div class="flex justify-end items-center mt-8">
                                                            <button type="button" @click="modal11 = false"
                                                                class="btn btn-outline-danger">Discard</button>
                                                            <button type="button" @click="modal11 = false"
                                                                class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </DialogPanel>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-warning" @click="modal12 = true">SlideIn Up</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal12" as="template">
                                    <Dialog as="div" @close="modal12 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <DialogPanel
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark animate__animated animate__slideInUp">
                                                    <button type="button"
                                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                        @click="modal12 = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" class="w-6 h-6">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <div
                                                        class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                        Modal Title
                                                    </div>
                                                    <div class="p-5">
                                                        <p>
                                                            Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros.
                                                            Phasellus egestas sit amet velit
                                                            sed luctus. Orci varius natoque penatibus et magnis dis
                                                            parturient montes, nascetur ridiculus mus.
                                                            Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut
                                                            sit amet ullamcorper mi.
                                                        </p>

                                                        <div class="flex justify-end items-center mt-8">
                                                            <button type="button" @click="modal12 = false"
                                                                class="btn btn-outline-danger">Discard</button>
                                                            <button type="button" @click="modal12 = false"
                                                                class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </DialogPanel>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-danger" @click="modal13 = true">FadeIn Left</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal13" as="template">
                                    <Dialog as="div" @close="modal13 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <DialogPanel
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark animate__animated"
                                                    :class="store.rtlClass === 'rtl' ? 'animate__fadeInRight' : 'animate__fadeInLeft'">
                                                    <button type="button"
                                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                        @click="modal13 = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" class="w-6 h-6">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <div
                                                        class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                        Modal Title
                                                    </div>
                                                    <div class="p-5">
                                                        <p>
                                                            Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros.
                                                            Phasellus egestas sit amet velit
                                                            sed luctus. Orci varius natoque penatibus et magnis dis
                                                            parturient montes, nascetur ridiculus mus.
                                                            Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut
                                                            sit amet ullamcorper mi.
                                                        </p>

                                                        <div class="flex justify-end items-center mt-8">
                                                            <button type="button" @click="modal13 = false"
                                                                class="btn btn-outline-danger">Discard</button>
                                                            <button type="button" @click="modal13 = false"
                                                                class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </DialogPanel>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-secondary" @click="modal14 = true">RotateIn
                                    Left</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal14" as="template">
                                    <Dialog as="div" @close="modal14 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <DialogPanel
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark animate__animated"
                                                    :class="store.rtlClass === 'rtl' ? 'animate__rotateInDownRight' : 'animate__rotateInDownLeft'">
                                                    <button type="button"
                                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                        @click="modal14 = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" class="w-6 h-6">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <div
                                                        class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                        Modal Title
                                                    </div>
                                                    <div class="p-5">
                                                        <p>
                                                            Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros.
                                                            Phasellus egestas sit amet velit
                                                            sed luctus. Orci varius natoque penatibus et magnis dis
                                                            parturient montes, nascetur ridiculus mus.
                                                            Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut
                                                            sit amet ullamcorper mi.
                                                        </p>

                                                        <div class="flex justify-end items-center mt-8">
                                                            <button type="button" @click="modal14 = false"
                                                                class="btn btn-outline-danger">Discard</button>
                                                            <button type="button" @click="modal14 = false"
                                                                class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </DialogPanel>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-dark" @click="modal15 = true">FadeIn Right</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal15" as="template">
                                    <Dialog as="div" @close="modal15 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <DialogPanel
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark animate__animated"
                                                    :class="store.rtlClass === 'rtl' ? 'animate__fadeInLeft' : 'animate__fadeInRight'">
                                                    <button type="button"
                                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                        @click="modal15 = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" class="w-6 h-6">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <div
                                                        class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                        Modal Title
                                                    </div>
                                                    <div class="p-5">
                                                        <p>
                                                            Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros.
                                                            Phasellus egestas sit amet velit
                                                            sed luctus. Orci varius natoque penatibus et magnis dis
                                                            parturient montes, nascetur ridiculus mus.
                                                            Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut
                                                            sit amet ullamcorper mi.
                                                        </p>

                                                        <div class="flex justify-end items-center mt-8">
                                                            <button type="button" @click="modal15 = false"
                                                                class="btn btn-outline-danger">Discard</button>
                                                            <button type="button" @click="modal15 = false"
                                                                class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </DialogPanel>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-primary" @click="modal16 = true">ZoomIn Up</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal16" as="template">
                                    <Dialog as="div" @close="modal16 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <DialogPanel
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark animate__animated animate__zoomInUp">
                                                    <button type="button"
                                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                        @click="modal16 = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" class="w-6 h-6">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <div
                                                        class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                        Modal Title
                                                    </div>
                                                    <div class="p-5">
                                                        <p>
                                                            Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros.
                                                            Phasellus egestas sit amet velit
                                                            sed luctus. Orci varius natoque penatibus et magnis dis
                                                            parturient montes, nascetur ridiculus mus.
                                                            Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut
                                                            sit amet ullamcorper mi.
                                                        </p>

                                                        <div class="flex justify-end items-center mt-8">
                                                            <button type="button" @click="modal16 = false"
                                                                class="btn btn-outline-danger">Discard</button>
                                                            <button type="button" @click="modal16 = false"
                                                                class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </DialogPanel>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Custom -->
                <div class="panel lg:col-span-2">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Custom</h5>
                    </div>
                    <div class="mb-5">
                        <p class="text-center mb-4">More Custom Modals.</p>
                        <div class="flex flex-wrap items-center justify-center gap-2">
                            <!-- standard  -->
                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-primary" @click="modal17 = true">Standard</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal17" as="template">
                                    <Dialog as="div" @close="modal17 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <TransitionChild as="template" enter="duration-300 ease-out"
                                                    enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                                    leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                                    leave-to="opacity-0 scale-95">
                                                    <DialogPanel
                                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                                        <div
                                                            class="flex items-center justify-center dark:text-white-dark/70 text-base font-medium text-[#1f2937] p-5">
                                                            <div
                                                                class="flex items-center justify-center w-16 h-16 rounded-full bg-[#f1f2f3] dark:bg-white/10">
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg" class="w-7 h-7">
                                                                    <path
                                                                        d="M19.0001 9.7041V9C19.0001 5.13401 15.8661 2 12.0001 2C8.13407 2 5.00006 5.13401 5.00006 9V9.7041C5.00006 10.5491 4.74995 11.3752 4.28123 12.0783L3.13263 13.8012C2.08349 15.3749 2.88442 17.5139 4.70913 18.0116C9.48258 19.3134 14.5175 19.3134 19.291 18.0116C21.1157 17.5139 21.9166 15.3749 20.8675 13.8012L19.7189 12.0783C19.2502 11.3752 19.0001 10.5491 19.0001 9.7041Z"
                                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                                    <path opacity="0.5"
                                                                        d="M7.5 19C8.15503 20.7478 9.92246 22 12 22C14.0775 22 15.845 20.7478 16.5 19"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="p-5">
                                                            <div class="text-white-dark text-center text-sm">
                                                                <p>
                                                                    Vivamus vitae hendrerit neque. Orci varius natoque
                                                                    penatibus et magnis dis parturient
                                                                    montes, nascetur ridiculus mus. Morbi consequat auctor
                                                                    turpis, vitae dictum augue efficitur
                                                                    vitae. Vestibulum a risus ipsum. Quisque nec lacus
                                                                    dolor. Quisque ornare tempor orci id
                                                                    rutrum.
                                                                </p>
                                                            </div>
                                                            <div class="flex justify-end items-center mt-8">
                                                                <button type="button" class="btn btn-outline-danger"
                                                                    @click="modal17 = false">Discard</button>
                                                                <button type="button"
                                                                    class="btn btn-primary ltr:ml-4 rtl:mr-4"
                                                                    @click="modal17 = false">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </DialogPanel>
                                                </TransitionChild>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <!-- tabs -->
                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-info" @click="modal18 = true">Tabs</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal18" as="template">
                                    <Dialog as="div" @close="modal18 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <TransitionChild as="template" enter="duration-300 ease-out"
                                                    enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                                    leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                                    leave-to="opacity-0 scale-95">
                                                    <DialogPanel
                                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                                        <button type="button"
                                                            class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                            @click="modal18 = false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                height="24px" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="w-6 h-6">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                        <div
                                                            class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                            Tabs
                                                        </div>
                                                        <div class="p-5">
                                                            <TabGroup as="div">
                                                                <TabList
                                                                    class="flex flex-wrap mt-3 border-b border-white-light dark:border-[#191e3a]">
                                                                    <Tab as="template" v-slot="{ selected }">
                                                                        <a href="javascript:;"
                                                                            class="p-3.5 py-2 -mb-[1px] block border border-transparent hover:text-primary dark:hover:border-b-black !outline-none"
                                                                            :class="{
                                                                                '!border-white-light !border-b-white  text-primary dark:!border-[#191e3a] dark:!border-b-black':
                                                                                    selected,
                                                                            }">Home</a>
                                                                    </Tab>
                                                                    <Tab as="template" v-slot="{ selected }">
                                                                        <a href="javascript:;"
                                                                            class="p-3.5 py-2 -mb-[1px] block border border-transparent hover:text-primary dark:hover:border-b-black !outline-none"
                                                                            :class="{
                                                                                '!border-white-light !border-b-white text-primary dark:!border-[#191e3a] dark:!border-b-black':
                                                                                    selected,
                                                                            }">Profile</a>
                                                                    </Tab>
                                                                    <Tab as="template" v-slot="{ selected }">
                                                                        <a href="javascript:;"
                                                                            class="p-3.5 py-2 -mb-[1px] block border border-transparent hover:text-primary dark:hover:border-b-black !outline-none"
                                                                            :class="{
                                                                                '!border-white-light !border-b-white text-primary dark:!border-[#191e3a] dark:!border-b-black':
                                                                                    selected,
                                                                            }">Contact</a>
                                                                    </Tab>
                                                                    <Tab as="template" disabled>
                                                                        <a href="javascript:;"
                                                                            class="p-3.5 py-2 -mb-[1px] block pointer-events-none text-white-light dark:text-dark">Disabled</a>
                                                                    </Tab>
                                                                </TabList>
                                                                <TabPanels class="pt-5 flex-1 text-sm">
                                                                    <TabPanel>
                                                                        <h4 class="font-semibold text-2xl mb-4">We move your
                                                                            world!</h4>
                                                                        <p class="mb-4">
                                                                            Lorem ipsum dolor sit amet, consectetur
                                                                            adipisicing elit, sed do eiusmod tempor
                                                                            incididunt ut labore et dolore magna aliqua. Ut
                                                                            enim ad minim veniam, quis nostrud
                                                                            exercitation ullamco laboris nisi ut aliquip ex
                                                                            ea commodo consequat.
                                                                        </p>
                                                                        <p>
                                                                            Lorem ipsum dolor sit amet, consectetur
                                                                            adipisicing elit, sed do eiusmod tempor
                                                                            incididunt ut labore et dolore magna aliqua. Ut
                                                                            enim ad minim veniam, quis nostrud
                                                                            exercitation ullamco laboris nisi ut aliquip ex
                                                                            ea commodo consequat.
                                                                        </p>
                                                                    </TabPanel>
                                                                    <TabPanel>
                                                                        <div class="flex items-start">
                                                                            <div
                                                                                class="w-20 h-20 ltr:mr-4 rtl:ml-4 flex-none">
                                                                                <img src="/public/assets/images/profile-34.jpeg"
                                                                                    alt=""
                                                                                    class="w-20 h-20 m-0 rounded-full ring-2 ring-[#ebedf2] dark:ring-white-dark object-cover" />
                                                                            </div>
                                                                            <div class="flex-auto">
                                                                                <h5 class="text-xl font-medium mb-4">Media
                                                                                    heading</h5>
                                                                                <p class="text-white-dark">
                                                                                    Cras sit amet nibh libero, in gravida
                                                                                    nulla. Nulla vel metus scelerisque
                                                                                    ante sollicitudin. Cras purus odio,
                                                                                    vestibulum in vulputate at, tempus
                                                                                    viverra turpis. Fusce condimentum nunc
                                                                                    ac nisi vulputate fringilla. Donec
                                                                                    lacinia congue felis in faucibus.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </TabPanel>
                                                                    <TabPanel>
                                                                        <p>
                                                                            Lorem ipsum dolor sit amet, consectetur
                                                                            adipisicing elit, sed do eiusmod tempor
                                                                            incididunt ut labore et dolore magna aliqua. Ut
                                                                            enim ad minim veniam, quis nostrud
                                                                            exercitation ullamco laboris nisi ut aliquip ex
                                                                            ea commodo consequat. Duis aute
                                                                            irure dolor in reprehenderit in voluptate velit
                                                                            esse cillum dolore eu fugiat nulla
                                                                            pariatur. Excepteur sint occaecat cupidatat non
                                                                            proident, sunt in culpa qui officia
                                                                            deserunt mollit anim id est laborum.
                                                                        </p>
                                                                    </TabPanel>
                                                                    <TabPanel>Disabled</TabPanel>
                                                                </TabPanels>
                                                            </TabGroup>
                                                            <div class="flex justify-end items-center mt-8">
                                                                <button type="button" @click="modal18 = false"
                                                                    class="btn btn-outline-danger">Discard</button>
                                                                <button type="button" @click="modal18 = false"
                                                                    class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </DialogPanel>
                                                </TransitionChild>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <!-- profile -->
                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-success" @click="modal19 = true">Profile</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal19" as="template">
                                    <Dialog as="div" @close="modal19 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <TransitionChild as="template" enter="duration-300 ease-out"
                                                    enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                                    leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                                    leave-to="opacity-0 scale-95">
                                                    <DialogPanel
                                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-[300px] text-black dark:text-white-dark bg-secondary dark:bg-secondary">
                                                        <div class="px-5 pt-5 text-right">
                                                            <button type="button"
                                                                class="text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                                @click="modal19 = false">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="w-5 h-5">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="p-5">
                                                            <div class="text-white dark:text-white-light text-center">
                                                                <div
                                                                    class="rounded-full w-20 h-20 mx-auto mb-7 overflow-hidden">
                                                                    <img src="/public/assets/images/profile-16.jpeg" alt=""
                                                                        class="w-full h-full object-cover" />
                                                                </div>
                                                                <p class="font-semibold">Click on view to access <br />your
                                                                    profile.</p>
                                                            </div>
                                                            <div class="flex justify-center items-center mt-8 mb-5">
                                                                <button type="button"
                                                                    class="btn bg-white text-black dark:btn-dark">View</button>
                                                            </div>
                                                        </div>
                                                    </DialogPanel>
                                                </TransitionChild>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <!-- login -->
                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-warning" @click="modal20 = true">Login</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal20" as="template">
                                    <Dialog as="div" @close="modal20 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <TransitionChild as="template" enter="duration-300 ease-out"
                                                    enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                                    leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                                    leave-to="opacity-0 scale-95">
                                                    <DialogPanel
                                                        class="panel border-0 px-4 py-1 rounded-lg overflow-hidden w-full max-w-sm text-black dark:text-white-dark">
                                                        <button type="button"
                                                            class="absolute top-7 ltr:right-9 rtl:left-9 text-white-dark hover:text-dark outline-none"
                                                            @click="modal20 = false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                height="24px" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="w-5 h-5">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                        <div
                                                            class="text-lg font-semibold ltr:pl-5 rtl:pr-5 py-5 ltr:pr-[50px] rtl:pl-[50px]">
                                                            Login</div>
                                                        <div class="p-5">
                                                            <form>
                                                                <div class="relative mb-4">
                                                                    <span
                                                                        class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                            class="w-5 h-5">
                                                                            <circle cx="12" cy="6" r="4"
                                                                                stroke="currentColor" stroke-width="1.5" />
                                                                            <ellipse opacity="0.5" cx="12" cy="17" rx="7"
                                                                                ry="4" stroke="currentColor"
                                                                                stroke-width="1.5" />
                                                                        </svg>
                                                                    </span>
                                                                    <input type="email" placeholder="Email"
                                                                        class="form-input ltr:pl-10 rtl:pr-10" />
                                                                </div>
                                                                <div class="relative mb-4">
                                                                    <span
                                                                        class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                            class="w-5 h-5">
                                                                            <path
                                                                                d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z"
                                                                                stroke="currentColor" stroke-width="1.5" />
                                                                            <path opacity="0.5"
                                                                                d="M6 10V8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8V10"
                                                                                stroke="currentColor" stroke-width="1.5"
                                                                                stroke-linecap="round" />
                                                                        </svg>
                                                                    </span>
                                                                    <input type="password" placeholder="Password"
                                                                        class="form-input ltr:pl-10 rtl:pr-10" />
                                                                </div>
                                                                <button type="button"
                                                                    class="btn btn-primary w-full">Login</button>
                                                            </form>
                                                        </div>
                                                        <div
                                                            class="my-4 text-center text-xs text-white-dark dark:text-white-dark/70">
                                                            OR</div>
                                                        <div class="flex items-center justify-center gap-3 mb-5">
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-outline-primary flex gap-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="w-5 h-5">
                                                                    <path
                                                                        d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                                    </path>
                                                                </svg>
                                                                <span>Facebook</span>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-outline-danger flex gap-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="w-5 h-5">
                                                                    <path
                                                                        d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                                                    </path>
                                                                </svg>
                                                                <span>Github</span>
                                                            </a>
                                                        </div>
                                                        <div
                                                            class="p-5 border-t border-[#ebe9f1] dark:border-white/10 text-sm">
                                                            <p class="text-center text-white-dark dark:text-white-dark/70">
                                                                Looking to
                                                                <a href="javascript:;"
                                                                    class="text-[#515365] hover:underline dark:text-white-dark">create
                                                                    an account?</a>
                                                            </p>
                                                        </div>
                                                    </DialogPanel>
                                                </TransitionChild>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <!-- Register -->
                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-danger" @click="modal21 = true">Register</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal21" as="template">
                                    <Dialog as="div" @close="modal21 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <TransitionChild as="template" enter="duration-300 ease-out"
                                                    enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                                    leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                                    leave-to="opacity-0 scale-95">
                                                    <DialogPanel
                                                        class="panel border-0 px-4 py-1 rounded-lg overflow-hidden w-full max-w-sm text-black dark:text-white-dark">
                                                        <button type="button"
                                                            class="absolute top-7 ltr:right-9 rtl:left-9 text-white-dark hover:text-dark outline-none"
                                                            @click="modal21 = false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                height="24px" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="w-5 h-5">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                        <div
                                                            class="text-lg font-semibold ltr:pl-5 rtl:pr-5 py-5 ltr:pr-[50px] rtl:pl-[50px]">
                                                            Register</div>
                                                        <div class="p-5">
                                                            <form>
                                                                <div class="relative mb-4">
                                                                    <span
                                                                        class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                            class="w-5 h-5">
                                                                            <circle cx="12" cy="6" r="4"
                                                                                stroke="currentColor" stroke-width="1.5" />
                                                                            <ellipse opacity="0.5" cx="12" cy="17" rx="7"
                                                                                ry="4" stroke="currentColor"
                                                                                stroke-width="1.5" />
                                                                        </svg>
                                                                    </span>
                                                                    <input type="text" placeholder="Name"
                                                                        class="form-input ltr:pl-10 rtl:pr-10" />
                                                                </div>
                                                                <div class="relative mb-4">
                                                                    <span
                                                                        class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                            class="w-5 h-5">
                                                                            <path
                                                                                d="M12 18C8.68629 18 6 15.3137 6 12C6 8.68629 8.68629 6 12 6C15.3137 6 18 8.68629 18 12C18 12.7215 17.8726 13.4133 17.6392 14.054C17.5551 14.285 17.4075 14.4861 17.2268 14.6527L17.1463 14.727C16.591 15.2392 15.7573 15.3049 15.1288 14.8858C14.6735 14.5823 14.4 14.0713 14.4 13.5241V12M14.4 12C14.4 13.3255 13.3255 14.4 12 14.4C10.6745 14.4 9.6 13.3255 9.6 12C9.6 10.6745 10.6745 9.6 12 9.6C13.3255 9.6 14.4 10.6745 14.4 12Z"
                                                                                stroke="currentColor" stroke-width="1.5"
                                                                                stroke-linecap="round" />
                                                                            <path opacity="0.5"
                                                                                d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12Z"
                                                                                stroke="currentColor" stroke-width="1.5" />
                                                                        </svg>
                                                                    </span>
                                                                    <input type="email" placeholder="Email"
                                                                        class="form-input ltr:pl-10 rtl:pr-10" />
                                                                </div>
                                                                <div class="relative mb-4">
                                                                    <span
                                                                        class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                            class="w-5 h-5">
                                                                            <path
                                                                                d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z"
                                                                                stroke="currentColor" stroke-width="1.5" />
                                                                            <path opacity="0.5"
                                                                                d="M6 10V8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8V10"
                                                                                stroke="currentColor" stroke-width="1.5"
                                                                                stroke-linecap="round" />
                                                                        </svg>
                                                                    </span>
                                                                    <input type="password" placeholder="Password"
                                                                        class="form-input ltr:pl-10 rtl:pr-10" />
                                                                </div>
                                                                <button type="button"
                                                                    class="btn btn-primary w-full">Submit</button>
                                                            </form>
                                                        </div>
                                                        <div
                                                            class="my-4 text-center text-xs text-white-dark dark:text-white-dark/70">
                                                            OR</div>
                                                        <div class="flex items-center justify-center gap-3 mb-5">
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-outline-primary flex gap-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="w-5 h-5">
                                                                    <path
                                                                        d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                                    </path>
                                                                </svg>
                                                                <span>Facebook</span>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-outline-danger flex gap-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="w-5 h-5">
                                                                    <path
                                                                        d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                                                    </path>
                                                                </svg>
                                                                <span>Github</span>
                                                            </a>
                                                        </div>
                                                        <div
                                                            class="p-5 border-t border-[#ebe9f1] dark:border-white/10 text-sm">
                                                            <p class="text-center text-white-dark dark:text-white-dark/70">
                                                                Already have
                                                                <a href="javascript:;"
                                                                    class="text-[#515365] hover:underline dark:text-white-dark">Login?</a>
                                                            </p>
                                                        </div>
                                                    </DialogPanel>
                                                </TransitionChild>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
                            </div>

                            <!-- slider -->
                            <div>
                                <!-- Trigger -->
                                <button type="button" class="btn btn-secondary" @click="modal22 = true">Slider</button>

                                <!-- Modal -->
                                <TransitionRoot appear :show="modal22" as="template">
                                    <Dialog as="div" @close="modal22 = false" class="relative z-50">
                                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                            leave-to="opacity-0">
                                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                        </TransitionChild>

                                        <div class="fixed inset-0 overflow-y-auto">
                                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                                <TransitionChild as="template" enter="duration-300 ease-out"
                                                    enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                                    leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                                    leave-to="opacity-0 scale-95">
                                                    <DialogPanel
                                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-xl text-black dark:text-white-dark">
                                                        <button type="button"
                                                            class="absolute top-7 ltr:right-5 rtl:left-5 text-white-dark hover:text-dark outline-none"
                                                            @click="modal22 = false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                height="24px" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="w-5 h-5">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                        <div
                                                            class="text-lg font-semibold ltr:pl-5 rtl:pr-5 py-5 ltr:pr-[50px] rtl:pl-[50px]">
                                                            Slider</div>
                                                        <div class="px-5">
                                                            <swiper :modules="[Navigation, Pagination]"
                                                                :navigation="{ nextEl: '.swiper-button-next-ex1', prevEl: '.swiper-button-prev-ex1' }"
                                                                :pagination="{ clickable: true }"
                                                                class="max-w-3xl mx-auto mb-5" id="slider1"
                                                                :dir="store.rtlClass"
                                                                :key="store.rtlClass === 'rtl' ? 'true' : 'false'">
                                                                <template v-for="(item, i) in 3" :key="i">
                                                                    <swiper-slide>
                                                                        <img :src="`/public/assets/images/carousel${item}.jpeg`"
                                                                            class="w-full" alt="" />
                                                                    </swiper-slide>
                                                                </template>
                                                                <a href="javascript:;"
                                                                    class="swiper-button-prev-ex1 grid place-content-center ltr:left-2 rtl:right-2 p-1 transition text-primary hover:text-white border border-primary hover:border-primary hover:bg-primary rounded-full absolute z-[999] top-1/2 -translate-y-1/2">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                        class="w-5 h-5 rtl:rotate-180">
                                                                        <path d="M15 5L9 12L15 19" stroke="currentColor"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </a>
                                                                <a href="javascript:;"
                                                                    class="swiper-button-next-ex1 grid place-content-center ltr:right-2 rtl:left-2 p-1 transition text-primary hover:text-white border border-primary hover:border-primary hover:bg-primary rounded-full absolute z-[999] top-1/2 -translate-y-1/2">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                        class="w-5 h-5 ltr:rotate-180">
                                                                        <path d="M15 5L9 12L15 19" stroke="currentColor"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </a>
                                                            </swiper>
                                                        </div>
                                                    </DialogPanel>
                                                </TransitionChild>
                                            </div>
                                        </div>
                                    </Dialog>
                                </TransitionRoot>
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
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay, TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const modal1 = ref(false);
const modal2 = ref(false);
const modal3 = ref(false);
const modal4 = ref(false);
const modal5 = ref(false);
const modal6 = ref(false);
const modal7 = ref(false);
const modal8 = ref(false);
const modal9 = ref(false);
const modal10 = ref(false);
const modal11 = ref(false);
const modal12 = ref(false);
const modal13 = ref(false);
const modal14 = ref(false);
const modal15 = ref(false);
const modal16 = ref(false);
const modal17 = ref(false);
const modal18 = ref(false);
const modal19 = ref(false);
const modal20 = ref(false);
const modal21 = ref(false);
const modal22 = ref(false);
</script>
