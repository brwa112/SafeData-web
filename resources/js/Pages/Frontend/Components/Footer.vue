<template>
    <footer class="relative bg-f-primary text-white">
        <div class="relative z-[5] max-w-[90%] mx-auto px-4">
            <!-- Main Footer Content -->
            <div class="flex flex-col-reverse sm:flex-row justify-between gap-8 pb-16 pt-20 px-5 lg:px-10">
                <div class="w-full xl:w-3/4 3xl:w-2/3 mx-auto grid md:grid-cols-2 xl:flex justify-between gap-8">
                    <!-- About Section -->
                    <div class="space-y-1">
                        <h3 class="text-sm font-medium">{{ $t('frontend.footer.about') }}</h3>
                        <ul class="space-y-1">
                            <li>
                                <Link :href="branchRoute('/about')" class="text-white hover:text-white transition-colors text-sm">
                                    {{ $t('frontend.footer.history_achievements') }}
                                </Link>
                            </li>
                            <li>
                                <Link :href="branchRoute('/about')" class="text-white hover:text-white transition-colors text-sm">
                                    {{ $t('frontend.footer.principal_message') }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <!-- Contact Section -->
                    <div class="space-y-1">
                        <h3 class="text-sm font-medium">{{ $t('frontend.footer.contact') }}</h3>
                        <ul class="space-y-1 max-w-xs">
                            <li v-if="contactInfo.email">
                                <a :href="`mailto:${contactInfo.email}`"
                                    class="text-white hover:text-white transition-colors text-sm">
                                    {{ contactInfo.email }}
                                </a>
                            </li>
                            <li v-if="contactInfo.phone">
                                <a :href="`tel:${contactInfo.phone}`" dir="ltr"
                                    class="text-white hover:text-white transition-colors text-sm">
                                    {{ contactInfo.phone }}
                                </a>
                            </li>
                            <li v-if="contactInfo.address">
                                <span class="text-white text-sm">
                                    {{ contactInfo.address }}
                                </span>
                            </li>
                        </ul>
                    </div>
                    <!-- Academics Section -->
                    <div class="space-y-1">
                        <h3 class="text-sm font-medium">{{ $t('frontend.footer.academics') }}</h3>
                        <ul class="space-y-1">
                            <li>
                                <Link :href="branchRoute('/academics')" class="text-white hover:text-white transition-colors text-sm">
                                    {{ $t('frontend.footer.approach_to_education') }}
                                </Link>
                            </li>
                            <li>
                                <Link :href="branchRoute('/academics')" class="text-white hover:text-white transition-colors text-sm">
                                    {{ $t('frontend.footer.why_kurd_genius') }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <!-- Admission Section -->
                    <div class="space-y-1">
                        <h3 class="text-sm font-medium">{{ $t('frontend.footer.admission') }}</h3>
                        <ul class="space-y-1">
                            <li>
                                <Link :href="branchRoute('/admission')" class="text-white hover:text-white transition-colors text-sm">
                                    {{ $t('frontend.footer.school_policy') }}
                                </Link>
                            </li>
                            <li>
                                <Link :href="branchRoute('/admission')" class="text-white hover:text-white transition-colors text-sm">
                                    {{ $t('frontend.footer.application_form') }}
                                </Link>
                            </li>
                            <li>
                                <Link :href="branchRoute('/admission')" class="text-white hover:text-white transition-colors text-sm">
                                    {{ $t('frontend.footer.tuition_fee') }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Logo and Social Section -->
                <div class="flex flex-col items-center space-y-7 md:col-span-2 lg:col-span-1">
                    <!-- Brand Section -->
                    <div class="flex flex-col items-center">
                        <div class="size-20 bg-whitex rounded-full flex items-center justify-center p-3">
                            <img :src="'/img/logo.png'" alt="KGS Logo"
                                class="size-14 object-contain filter brightness-0 invert-[100]">
                        </div>
                        <p class="text-base font-light text-center">{{ $t('frontend.footer.tagline') }}</p>
                    </div>

                    <!-- Social Media Icons -->
                    <div class="flex items-center gap-2">
                        <a v-if="socialLinks.youtube" :href="socialLinks.youtube" target="_blank" rel="noopener noreferrer"
                            class="p-2.5 bg-white rounded-full flex items-center justify-center hover:bg-white/90 transition-all hover:-translate-y-0.5"
                            aria-label="YouTube">
                            <Svg name="youtube" class="size-6 text-black" />
                        </a>
                        <a v-if="socialLinks.facebook" :href="socialLinks.facebook" target="_blank" rel="noopener noreferrer"
                            class="p-2.5 bg-white rounded-full flex items-center justify-center hover:bg-white/90 transition-all hover:-translate-y-0.5"
                            aria-label="Facebook">
                            <Svg name="facebook_fill" class="size-6 text-black" />
                        </a>
                        <a v-if="socialLinks.instagram" :href="socialLinks.instagram" target="_blank" rel="noopener noreferrer"
                            class="p-2.5 bg-white rounded-full flex items-center justify-center hover:bg-white/90 transition-all hover:-translate-y-0.5"
                            aria-label="Instagram">
                            <Svg name="instagram_fill" class="size-6 text-black" />
                        </a>
                        <a v-if="socialLinks.twitter" :href="socialLinks.twitter" target="_blank" rel="noopener noreferrer"
                            class="p-3 bg-white rounded-full flex items-center justify-center hover:bg-white/90 transition-all hover:-translate-y-0.5"
                            aria-label="Twitter">
                            <Svg name="twitter" class="w-[22px] h-[22px] text-black" />
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-white py-10 px-6">
                <div class="flex flex-col md:flex-row md:justify-between items-center text-center gap-4">
                    <div class="text-sm text-white">
                        <span>{{ $t('frontend.footer.developed_by') }}</span>
                        <a href="https://safedatait.com" target="_blank" dir="ltr" class="text-sm">Safe Data Co.</a>
                    </div>
                    <p class="text-sm text-white">{{ $t('frontend.footer.copyright') }}</p>
                </div>
            </div>
        </div>
        <div
            class="absolute inset-y-0 end-0 start-2/3 rtl:bg-gradient-to-r ltr:bg-gradient-to-l from-gray-950/20 to-transparent">
        </div>
    </footer>
</template>

<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import helpers from '@/helpers';

const page = usePage();

// Contact info from AboutTouch model
const contactInfo = computed(() => {
  const info = page.props.info;
  if (!info) return { phone: null, email: null, address: null };
  
  return {
    phone: info.contact_phone || null,
    email: info.contact_email || null,
    address: info.contact_address ? helpers.getTranslatedText(info.contact_address, page) : null,
  };
});

// Social links from HomeKnow model
const socialLinks = computed(() => {
  const social = page.props.social;
  if (!social || !social.metadata) {
    return {
      facebook: null,
      instagram: null,
      youtube: null,
      twitter: null,
    };
  }
  
  return {
    facebook: social.metadata.facebook || null,
    instagram: social.metadata.instagram || null,
    youtube: social.metadata.youtube || null,
    twitter: social.metadata.twitter || null,
  };
});
</script>
