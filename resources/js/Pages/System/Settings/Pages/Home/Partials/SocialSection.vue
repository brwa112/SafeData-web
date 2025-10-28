<template>
    <div class="panel">
        <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.home_social') }}</h5>
            <label class="relative h-6 w-12">
                <input v-model="form.is_active" type="checkbox"
                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" />
                <span
                    class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
            </label>
        </div>
        <form class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="youtube_link">{{ $t('system.youtube_link') }}</label>
                    <input v-model="form.youtube" id="youtube_link" type="url" class="form-input"
                        placeholder="https://youtube.com/@yourhandle" />
                    <div class="mt-1 text-sm text-danger" v-if="form.errors['metadata.youtube']"
                        v-html="form.errors['metadata.youtube']">
                    </div>
                </div>
                <div>
                    <label for="facebook_link">{{ $t('system.facebook_link') }}</label>
                    <input v-model="form.facebook" id="facebook_link" type="url" class="form-input"
                        placeholder="https://facebook.com/yourpage" />
                    <div class="mt-1 text-sm text-danger" v-if="form.errors['metadata.facebook']"
                        v-html="form.errors['metadata.facebook']">
                    </div>
                </div>
                <div>
                    <label for="instagram_link">{{ $t('system.instagram_link') }}</label>
                    <input v-model="form.instagram" id="instagram_link" type="url" class="form-input"
                        placeholder="https://instagram.com/yourprofile" />
                    <div class="mt-1 text-sm text-danger" v-if="form.errors['metadata.instagram']"
                        v-html="form.errors['metadata.instagram']">
                    </div>
                </div>
                <div>
                    <label for="twitter_link">{{ $t('system.twitter_link') }}</label>
                    <input v-model="form.twitter" id="twitter_link" type="url" class="form-input"
                        placeholder="https://twitter.com/yourhandle" />
                    <div class="mt-1 text-sm text-danger" v-if="form.errors['metadata.twitter']"
                        v-html="form.errors['metadata.twitter']">
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
defineProps({
    form: {
        type: Object,
        required: true
    }
});
</script>