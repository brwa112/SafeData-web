<template>
    <section class="mt-12 lg:mt-24 mb-16">
        <div class="w-full sm:container 3xl:max-w-[85%] py-16 lg:py-20 mx-auto px-4">
            <div class="flex flex-col md:flex-row items-end gap-12 lg:gap-16 xl:gap-24">
                <!-- Left Side - Contact Information -->
                <div class="w-full space-y-8">
                    <!-- Title -->
                    <div class="mb-8 lg:mb-11">
                        <h2 class="text-3xl lg:text-4xl xl:text-[32px] font-semibold text-gray-900 mb-2">
                            {{ $t('frontend.contact_form.title') }}
                        </h2>
                    </div>
                    <!-- Information Section -->
                    <div class="mb-11">
                        <h3 class="text-lg lg:text-xl font-medium mb-5">
                            {{ $t('frontend.contact_form.information') }}
                        </h3>
                        <div class="space-y-6">
                            <!-- Phone -->
                            <div class="flex items-center gap-4">
                                <img :src="'/img/about/phone.svg'" alt="Phone Icon" />
                                <span dir="ltr" class="text-base font-medium">{{ contactPhone }}</span>
                            </div>
                            <!-- Email -->
                            <div class="flex items-center gap-4">
                                <img :src="'/img/about/monitor.svg'" alt="Email Icon" />
                                <span class="text-base font-medium">{{ contactEmail }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div>
                        <h3 class="text-lg lg:text-xl font-medium mb-5">
                            {{ $t('frontend.contact_form.address') }}
                        </h3>
                        <div class="flex items-start gap-4">
                            <img :src="'/img/about/map_location.svg'" alt="Location Icon" />
                            <p class="text-base font-medium leading-relaxed">
                                {{ contactAddress }}
                            </p>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="relative">
                        <div class="w-full h-48 bg-gray-200 rounded-3xl overflow-hidden">
                            <iframe v-if="mapIframe" :src="mapIframe" width="100%" height="100%" style="border:0;"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                class="rounded-xl">
                            </iframe>
                            <iframe v-else
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3217.5!2d45.4454!3d35.5606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzXCsDMzJzM4LjIiTiA0NcKwMjYnNDMuNCJF!5e0!3m2!1sen!2s!4v1234567890"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" class="rounded-xl">
                            </iframe>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Contact Form -->
                <div class="w-full h-full">
                    <div class="w-full bg-f-primary/5 p-5 lg:p-8 pt-7 lg:pt-10 rounded-3xl">
                        <!-- Success Message -->
                        <div v-if="showSuccess" class="mb-3 p-2.5 bg-green-50 border border-green-200 rounded-xl">
                            <div class="flex items-center gap-1.5">
                                <svg class="size-3.5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-green-700 font-medium text-xs">
                                    Thank you! Your message has been sent successfully.
                                </p>
                            </div>
                        </div>
                        <form @submit.prevent="submitForm" class="space-y-4">
                            <!-- Name and Email Row -->
                            <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 xl:gap-7">
                                <!-- Name Field -->
                                <div>
                                    <input v-model="form.name" type="text"
                                        :placeholder="$t('frontend.contact_form.name')" required
                                        class="w-full px-7 py-3.5 lg:py-4.5 xl:py-6 bg-white border border-transparent rounded-full text-gray-900 placeholder-gray-600 outline-none transition-all duration-200" />
                                </div>
                                <!-- Email Field -->
                                <div>
                                    <input v-model="form.email" type="email"
                                        :placeholder="$t('frontend.contact_form.email')" required
                                        class="w-full px-7 py-3.5 lg:py-4.5 xl:py-6 bg-white border border-transparent rounded-full text-gray-900 placeholder-gray-600 outline-none transition-all duration-200" />
                                </div>
                            </div>
                            <!-- Message Field -->
                            <div class="h-full">
                                <textarea v-model="form.message" :placeholder="$t('frontend.contact_form.message')"
                                    rows="9" required
                                    class="w-full px-7 py-3.5 lg:py-4.5 xl:py-6 bg-white border border-transparent rounded-3xl text-gray-900 placeholder-gray-600 outline-none transition-all duration-200 resize-none"></textarea>
                            </div>
                            <!-- Submit Button -->
                            <div class="xl:pt-2">
                                <button type="submit" :disabled="isSubmitting"
                                    class="w-full bg-f-primary hover:bg-white text-white hover:text-f-primary hover:font-semibold py-2.5 lg:py-3.5 xl:py-5 px-8 rounded-full border-4 border-f-primary transition-all duration-500 text-base font-light transform">
                                    <span v-if="!isSubmitting">{{ $t('frontend.contact_form.submit') }}</span>
                                    <span v-else class="flex items-center justify-center gap-2">
                                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        {{ $t('frontend.contact_form.submitting') }}
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { usePage } from '@inertiajs/vue3';
import helpers from '@/helpers';

const props = defineProps({
    data: {
        type: Object,
        default: () => ({})
    }
});

console.log(props.data);

const page = usePage();

// Contact information computed properties
const contactPhone = computed(() => {
    return props.data.contact_phone || '+964 123 456 7890';
});

const contactEmail = computed(() => {
    return props.data.contact_email || 'info@kurdgenius.com';
});

const contactAddress = computed(() => {
    return helpers.getTranslatedText(props.data.contact_address, page) || 'Kurd Genius School - Qaiwan City, Raparin - Sulaymaniyah, Kurdistan Region, Iraq';
});

const mapIframe = computed(() => {
    return props.data.map_iframe || '';
});

// Form data
const form = reactive({
    name: '',
    email: '',
    message: ''
})

// Loading and success states
const isSubmitting = ref(false)
const showSuccess = ref(false)

// Form submission handler
const submitForm = async () => {
    isSubmitting.value = true

    try {
        // Simulate API call delay
        await new Promise(resolve => setTimeout(resolve, 1000))

        // Here you would typically send the form data to your backend
        console.log('Form submitted:', form)

        // Reset form
        form.name = ''
        form.email = ''
        form.message = ''

        // Show success message
        showSuccess.value = true

        // Hide success message after 5 seconds
        setTimeout(() => {
            showSuccess.value = false
        }, 5000)

    } catch (error) {
        console.error('Error submitting form:', error)
        // Handle error (you could add an error state here)
    } finally {
        isSubmitting.value = false
    }
}
</script>
