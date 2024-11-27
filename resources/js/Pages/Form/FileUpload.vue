<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Forms</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>File Upload</span>
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
                    href="https://www.npmjs.com/package/file-upload-with-preview" target="_blank"
                    class="block hover:underline">https://www.npmjs.com/package/file-upload-with-preview</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Single File -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Single File Upload</h5>
                    </div>
                    <div class="mb-5">
                        <div class="custom-file-container" data-upload-id="myFirstImage">
                            <div class="label-container">
                                <label>Upload </label> <a href="javascript:;" class="custom-file-container__image-clear"
                                    title="Clear Image">×</a>
                            </div>
                            <label class="custom-file-container__custom-file">
                                <input type="file" class="custom-file-container__custom-file__custom-file-input"
                                    accept="image/*" />
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span
                                    class="custom-file-container__custom-file__custom-file-control ltr:pr-20 rtl:pl-20"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
                        </div>
                    </div>
                </div>
                <!-- Multiple File -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Multiple File</h5>
                    </div>
                    <div class="mb-5">
                        <div class="custom-file-container" data-upload-id="mySecondImage">
                            <div class="label-container">
                                <label>Upload </label> <a href="javascript:;" class="custom-file-container__image-clear"
                                    title="Clear Image">×</a>
                            </div>
                            <label class="custom-file-container__custom-file">
                                <input type="file" class="custom-file-container__custom-file__custom-file-input" multiple />
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span
                                    class="custom-file-container__custom-file__custom-file-control ltr:pr-20 rtl:pl-20"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { onMounted } from 'vue';
import FileUploadWithPreview from 'file-upload-with-preview';
import 'file-upload-with-preview/dist/file-upload-with-preview.min.css';

onMounted(() => {
    // single image upload
    new FileUploadWithPreview('myFirstImage', {
        images: {
            baseImage: '/assets/images/file-preview.svg',
            backgroundImage: '',
        },
    });

    // multiple image upload
    new FileUploadWithPreview('mySecondImage', {
        images: {
            baseImage: '/assets/images/file-preview.svg',
            backgroundImage: '',
        },
        multiple: true,
    });
});
</script>
