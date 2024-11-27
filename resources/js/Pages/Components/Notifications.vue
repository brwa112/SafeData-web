<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Components</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Notifications</span>
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
                <span class="ltr:mr-3 rtl:ml-3">Documentation: </span><a href="https://www.npmjs.com/package/sweetalert2"
                    target="_blank" class="block hover:underline">https://www.npmjs.com/package/sweetalert2</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- basic -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Basic</h5>

                    </div>
                    <div class="mb-5">
                        <div class="flex items-center justify-center">
                            <button type="button" class="btn btn-primary"
                                @click="showMessage('Hello, world! This is a toast message.')">Open Toast</button>
                        </div>
                    </div>

                </div>
                <!-- Position -->
                <div class="panel lg:row-span-2">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Position</h5>

                    </div>
                    <div class="mb-5">
                        <h6 class="font-semibold text-base dark:text-white-light mb-3 text-center">Top Position</h6>
                        <div class="flex items-center justify-center mb-10 gap-2">
                            <button type="button" class="btn btn-success"
                                @click="showMessage('Example notification text.', store.rtlClass === 'rtl' ? 'top-end' : 'top-start')">
                                Top Left
                            </button>
                            <button type="button" class="btn btn-secondary"
                                @click="showMessage('Example notification text', 'top')">Top Center</button>
                            <button type="button" class="btn btn-info"
                                @click="showMessage('Example notification text.', store.rtlClass === 'rtl' ? 'top-start' : 'top-end')">
                                Top Right
                            </button>
                        </div>
                        <h6 class="font-semibold text-base dark:text-white-light mb-3 text-center">Bottom Position</h6>
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" class="btn btn-dark"
                                @click="showMessage('Example notification text.', store.rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start')">
                                Bottom Left
                            </button>
                            <button type="button" class="btn btn-primary"
                                @click="showMessage('Example notification text.', 'bottom')">Bottom Center</button>
                            <button type="button" class="btn btn-secondary"
                                @click="showMessage('Example notification text.', store.rtlClass === 'rtl' ? 'bottom-start' : 'bottom-end')">
                                Bottom Right
                            </button>
                        </div>
                    </div>

                </div>
                <!-- No Action -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">No Action</h5>
                    </div>
                    <div class="mb-5">
                        <div class="flex items-center justify-center">
                            <button type="button" class="btn btn-success"
                                @click="showMessage('Example notification text.', 'bottom-start', false)">
                                No Action
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Click Callback -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Click Callback</h5>
                    </div>
                    <div class="mb-5">
                        <div class="flex items-center justify-center">
                            <button type="button" class="btn btn-info" @click="clickCallable()">Click Callback</button>
                        </div>
                    </div>

                </div>
                <!-- Duration -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Duration</h5>
                    </div>
                    <div class="mb-5">
                        <div class="flex items-center justify-center">
                            <button type="button" class="btn btn-dark"
                                @click="showMessage((msg = 'Example notification text.'), (position = 'bottom-start'), (duration = 5000))">
                                Duration
                            </button>
                        </div>
                    </div>

                </div>
                <!-- Background Color -->
                <div class="panel lg:col-span-2">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Background Color</h5>
                    </div>
                    <div class="mb-5">
                        <div
                            class="grid grid-cols-2 sm:grid-cols-1 sm:flex items-center justify-center gap-2 colored-toast">
                            <div>
                                <button type="button" class="btn btn-primary"
                                    @click="coloredToast('primary')">Primary</button>
                                <div id="primary-toast"></div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary"
                                    @click="coloredToast('secondary')">Secondary</button>
                                <div id="secondary-toast"></div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success"
                                    @click="coloredToast('success')">Success</button>
                                <div id="success-toast"></div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-danger" @click="coloredToast('danger')">Danger</button>
                                <div id="danger-toast"></div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-warning"
                                    @click="coloredToast('warning')">Warning</button>
                                <div id="warning-toast"></div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-info" @click="coloredToast('info')">Info</button>
                                <div id="info-toast"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Swal from 'sweetalert2';

const showMessage = (msg = 'Example notification text.', position = 'bottom-start', showCloseButton = true, closeButtonHtml = '', duration = 3000) => {
    const toast = Swal.mixin({
        toast: true,
        position: (position || 'bottom-start'),
        showConfirmButton: false,
        timer: duration,
        showCloseButton: showCloseButton,
    });
    toast.fire({
        title: msg,
    });
};

const clickCallable = () => {
    Swal.fire({
        toast: true,
        position: 'bottom-start',
        text: 'Custom callback when action button is clicked.',
        showCloseButton: true,
        showConfirmButton: false,
    }).then((result) => {
        Swal.fire({
            toast: true,
            position: 'bottom-start',
            text: 'Thanks for clicking the Dismiss button!',
            showCloseButton: true,
            showConfirmButton: false,
        });
    });
};

const coloredToast = (color) => {
    const toast = Swal.mixin({
        toast: true,
        position: 'bottom-start',
        showConfirmButton: false,
        timer: 3000,
        showCloseButton: true,
        customClass: {
            popup: `color-${color}`,
        },
        target: document.getElementById(color + '-toast') || 'body',
    });
    toast.fire({
        title: 'Example notification text.',
    });
};
</script>
