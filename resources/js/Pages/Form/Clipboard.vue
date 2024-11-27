<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Forms</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Clipboard</span>
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
                <span class="ltr:mr-3 rtl:ml-3">Documentation: </span><a href="https://www.npmjs.com/package/vue-clipboard3"
                    target="_blank" class="block hover:underline">https://www.npmjs.com/package/vue-clipboard3</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Copy from input -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Copy from input</h5>
                    </div>
                    <div class="mb-5">
                        <div class="bg-[#f1f2f3] p-5 rounded dark:bg-[#060818]">
                            <form>
                                <input type="text" class="form-input" v-model="message1" id="message1" />
                                <div class="flex flex-wrap gap-2 mt-5">
                                    <button type="button" class="btn btn-primary" @click="copy(message1)">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                                            <path
                                                d="M6 11C6 8.17157 6 6.75736 6.87868 5.87868C7.75736 5 9.17157 5 12 5H15C17.8284 5 19.2426 5 20.1213 5.87868C21 6.75736 21 8.17157 21 11V16C21 18.8284 21 20.2426 20.1213 21.1213C19.2426 22 17.8284 22 15 22H12C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V11Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M6 19C4.34315 19 3 17.6569 3 16V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H15C16.6569 2 18 3.34315 18 5"
                                                stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                        Copy from Input
                                    </button>
                                    <button type="button" class="btn btn-dark" @click="cut(message1)" @blur="message1 = ''">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2">
                                            <path
                                                d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015"
                                                stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                        Cut from Input
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Copy form Textarea -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Copy form Textarea</h5>
                    </div>
                    <div class="mb-5">
                        <div class="bg-[#f1f2f3] p-5 rounded dark:bg-[#060818]">
                            <form>
                                <textarea rows="3" wrap="soft" class="form-textarea" v-model="message2"
                                    id="message2"></textarea>
                                <div class="flex flex-wrap gap-2 mt-5">
                                    <button type="button" class="btn btn-primary" @click="copy(message2)">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                                            <path
                                                d="M6 11C6 8.17157 6 6.75736 6.87868 5.87868C7.75736 5 9.17157 5 12 5H15C17.8284 5 19.2426 5 20.1213 5.87868C21 6.75736 21 8.17157 21 11V16C21 18.8284 21 20.2426 20.1213 21.1213C19.2426 22 17.8284 22 15 22H12C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V11Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M6 19C4.34315 19 3 17.6569 3 16V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H15C16.6569 2 18 3.34315 18 5"
                                                stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                        Copy from Input
                                    </button>
                                    <button type="button" class="btn btn-dark" @click="cut(message2)" @blur="message2 = ''">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2">
                                            <path
                                                d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015"
                                                stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                        Cut from Input
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Copy Text from Paragraph -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Copy Text from Paragraph</h5>
                    </div>
                    <div class="mb-5">
                        <div class="bg-[#f1f2f3] p-5 rounded dark:bg-[#060818]">
                            <form>
                                <p class="mb-3 font-semibold">Here is your OTP <span class="text-2xl"
                                        id="copyOTP">22991</span>.</p>
                                <p class="font-semibold">Please do not share it to anyone</p>
                                <div class="flex flex-wrap gap-2 mt-5">
                                    <button type="button" class="btn btn-primary" @click="copy('22991')">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                                            <path
                                                d="M6 11C6 8.17157 6 6.75736 6.87868 5.87868C7.75736 5 9.17157 5 12 5H15C17.8284 5 19.2426 5 20.1213 5.87868C21 6.75736 21 8.17157 21 11V16C21 18.8284 21 20.2426 20.1213 21.1213C19.2426 22 17.8284 22 15 22H12C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V11Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M6 19C4.34315 19 3 17.6569 3 16V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H15C16.6569 2 18 3.34315 18 5"
                                                stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                        Copy from Paragraph
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Advanced -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Copy Hidden Text (Advanced)</h5>
                    </div>
                    <div class="mb-5">
                        <div class="bg-[#f1f2f3] p-5 rounded dark:bg-[#060818]">
                            <form>
                                <p class="mb-3 font-semibold"><span> Link -> </span> <span id="copyLink">
                                        http://www.admin-dashboard.com/code</span></p>
                                <span class="absolute opacity-0" id="copyHiddenCode">2291</span>
                                <div class="flex flex-wrap gap-2 mt-5">
                                    <button type="button" class="btn btn-primary"
                                        @click="copy('http://www.admin-dashboard.com/code')">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                                            <path
                                                d="M6 11C6 8.17157 6 6.75736 6.87868 5.87868C7.75736 5 9.17157 5 12 5H15C17.8284 5 19.2426 5 20.1213 5.87868C21 6.75736 21 8.17157 21 11V16C21 18.8284 21 20.2426 20.1213 21.1213C19.2426 22 17.8284 22 15 22H12C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V11Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M6 19C4.34315 19 3 17.6569 3 16V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H15C16.6569 2 18 3.34315 18 5"
                                                stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                        Copy Link
                                    </button>
                                    <button type="button" class="btn btn-dark" @click="copy('2291')">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                                            <path
                                                d="M6 11C6 8.17157 6 6.75736 6.87868 5.87868C7.75736 5 9.17157 5 12 5H15C17.8284 5 19.2426 5 20.1213 5.87868C21 6.75736 21 8.17157 21 11V16C21 18.8284 21 20.2426 20.1213 21.1213C19.2426 22 17.8284 22 15 22H12C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V11Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M6 19C4.34315 19 3 17.6569 3 16V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H15C16.6569 2 18 3.34315 18 5"
                                                stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                        Copy Hidden Code
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import useClipboard from 'vue-clipboard3';
import Swal from 'sweetalert2';

const message1 = ref('http://www.admin-dashboard.com');
const message2 = ref('Lorem ipsum dolor sit amet, consectetur adipiscing elit...');

const { toClipboard } = useClipboard();
const copy = async (msg) => {
    if (msg) {
        await toClipboard(msg);
        showMessage('Copied successfully.');
    }
};

const cut = async (msg) => {
    if (msg) {
        await toClipboard(msg);
        showMessage('Cut successfully.');
    }
};

const showMessage = (msg = '', type = 'success') => {
    const toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        customClass: { container: 'toast' },
    });
    toast.fire({
        icon: type,
        title: msg,
        padding: '10px 20px',
    });
};
</script>
