<template>

  <nav class="fixed top-0 inset-x-0 z-50 bg-white shadow-md">

    <!-- Top bar -->
    <div dir="ltr" class="bg-f-primary text-white py-4 px-4 hidden xl:block">
      <div class="max-w-[85%] 3xl:max-w-[70%] mx-auto flex justify-between items-center gap-2 text-sm">
        <!-- Contact Info -->
        <div class="flex items-center gap-4 md:gap-6">
          <a v-if="contactInfo.phone" :href="`tel:${contactInfo.phone}`"
            class="flex items-center gap-1 hover:text-f-primary-200 transition-colors">
            <Svg name="call_fill" class="size-5"></Svg>
            <span dir="ltr" class="opacity-80 text-xs md:text-sm">{{ contactInfo.phone }}</span>
          </a>
          <a v-if="contactInfo.email" :href="`mailto:${contactInfo.email}`"
            class="flex items-center gap-1 hover:text-f-primary-200 transition-colors">
            <Svg name="email_fill" class="size-5"></Svg>
            <span class="opacity-80 text-xs md:text-sm">{{ contactInfo.email }}</span>
          </a>
        </div>
        <div class="flex items-center gap-2">
          <a v-if="socialLinks.facebook" :href="socialLinks.facebook" target="_blank" rel="noopener noreferrer"
            class="hover:text-f-primary-200 transition-colors" aria-label="Facebook">
            <Svg name="facebook_fill" class="size-5"></Svg>
          </a>
          <a v-if="socialLinks.instagram" :href="socialLinks.instagram" target="_blank" rel="noopener noreferrer"
            class="hover:text-f-primary-200 transition-colors" aria-label="Instagram">
            <Svg name="instagram_fill" class="size-5"></Svg>
          </a>
          <a v-if="socialLinks.youtube" :href="socialLinks.youtube" target="_blank" rel="noopener noreferrer"
            class="hover:text-f-primary-200 transition-colors" aria-label="YouTube">
            <Svg name="youtube" class="h-6 opacity-85"></Svg>
          </a>
          <a v-if="socialLinks.twitter" :href="socialLinks.twitter" target="_blank" rel="noopener noreferrer"
            class="hover:text-f-primary-200 transition-colors" aria-label="Twitter">
            <Svg name="twitter" class="size-3.5"></Svg>
          </a>
        </div>
      </div>
    </div>

    <!-- Main navigation -->
    <div class="sm:container 3xl:max-w-[85%] mx-auto px-4 py-2 flex justify-between items-center">
      <!-- Logo -->
      <div class="flex items-center gap-x-2 md:gap-x-3">
        <img :src="'/img/logo.png'" alt="Kurd Genius Schools Logo" class="size-12 md:size-[60px] object-contain" />
        <div class="text-sm md:text-base font-bold hidden 2xl:block">{{ $t('frontend.nav.school_name') }}</div>
        <div class="text-xl font-bold block 2xl:hidden">{{ $t('frontend.nav.school_abbr') }}</div>
      </div>

      <!-- Desktop Navigation Menu -->
      <div class="hidden xl:flex items-center gap-x-8">
        <Link :href="branchRoute('/')" class="hover:text-f-primary font-medium transition-colors"
          :class="{ 'font-semibold text-f-primary': $page.component.startsWith('Frontend/Pages/Home') }">
        {{ $t('frontend.nav.home') }}
        </Link>
        <Link :href="branchRoute('/about')" class="hover:text-f-primary font-medium transition-colors"
          :class="{ 'font-semibold text-f-primary': $page.component.startsWith('Frontend/Pages/About') }">
        {{ $t('frontend.nav.about') }}
        </Link>
        <Link :href="branchRoute('/campus')" class="hover:text-f-primary font-medium transition-colors"
          :class="{ 'font-semibold text-f-primary': $page.component.startsWith('Frontend/Pages/Campus') }">
        {{ $t('frontend.nav.campus') }}
        </Link>
        <Link :href="branchRoute('/calendar')" class="hover:text-f-primary font-medium transition-colors"
          :class="{ 'font-semibold text-f-primary': $page.component.startsWith('Frontend/Pages/Calendar') }">
        {{ $t('frontend.nav.calendar') }}
        </Link>
        <Link :href="branchRoute('/academics')" class="hover:text-f-primary font-medium transition-colors"
          :class="{ 'font-semibold text-f-primary': $page.component.startsWith('Frontend/Pages/Academic') }">
        {{ $t('frontend.nav.academics') }}
        </Link>
        <Link :href="branchRoute('/admission')" class="hover:text-f-primary font-medium transition-colors"
          :class="{ 'font-semibold text-f-primary': $page.component.startsWith('Frontend/Pages/Admission') }">
        {{ $t('frontend.nav.admission') }}
        </Link>
        <Link :href="branchRoute('/news')" class="hover:text-f-primary font-medium transition-colors"
          :class="{ 'font-semibold text-f-primary': $page.component.startsWith('Frontend/Pages/News') }">
        {{ $t('frontend.nav.news') }}
        </Link>
      </div>

      <!-- Desktop Right side controls -->
      <div class="flex items-center gap-x-3">
        <!-- Branches dropdown -->
        <Menu as="div" class="relative">
          <MenuButton
            class="hover:text-f-primary-200 font-medium flex items-center gap-x-1 transition-colors cursor-pointer">
            <Svg name="building_fill" class="size-5 text-black"></Svg>
            <span class="hidden sm:block">{{ $t('frontend.nav.branches') }}</span>
            <Svg name="arrow_down" class="size-4"></Svg>
          </MenuButton>

          <Transition enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0">
            <MenuItems
              class="absolute mt-2 w-72 bg-white shadow-lg rounded-md overflow-hidden z-50 end-1/2 sm:end-0 ltr:translate-x-1/2 ltr:sm:translate-x-0 rtl:-translate-x-1/2 rtl:sm:translate-x-0">
              <div class="py-1">
                <MenuItem v-for="branch in branches" :key="branch.id" :as="'button'" @click="selectBranch(branch)"
                  class="w-full text-left px-4 py-1.5 hover:bg-gray-100 transition-colors cursor-pointer">
                <div class="flex items-center justify-between gap-2">
                  <div class="flex items-center gap-1.5 text-start">
                    <div v-if="branch.logo_url" class="block size-5">
                      <img :src="branch.logo_url" :alt="getBranchName(branch)" class="size-5 object-contain" />
                    </div>
                    <div v-else class="block size-5">
                      <Svg name="building_fill" class="size-5 text-gray-400"></Svg>
                    </div>
                    <span class="text-[10px] md:text-xs"
                      :class="{ 'font-semibold text-f-primary': selectedBranch?.id === branch.id }">
                      {{ getBranchName(branch) }}
                    </span>
                  </div>
                  <span v-if="selectedBranch?.id === branch.id" class="text-f-primary">
                    <Svg name="check" class="size-4"></Svg>
                  </span>
                </div>
                </MenuItem>
              </div>
            </MenuItems>
          </Transition>
        </Menu>

        <!-- Language selector -->
        <Menu as="div" class="relative">
          <MenuButton class="text-f-primary font-semibold flex items-center gap-x-1 cursor-pointer">
            <span>{{ $t('system.' + currentLanguage.slug) }}</span>
            <Svg name="arrow_down" class="size-4"></Svg>
          </MenuButton>

          <Transition enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0">
            <MenuItems class="absolute mt-2 w-40 bg-white shadow-lg rounded-md overflow-hidden z-50 end-0">
              <div class="py-1">
                <MenuItem v-for="language in availableLanguages" :key="language.id" :as="'button'"
                  @click="selectLanguage(language)"
                  class="w-full text-left px-4 py-1.5 hover:bg-gray-100 transition-colors cursor-pointer">
                <div class="flex items-center justify-between">
                  <span :class="{ 'font-semibold text-f-primary': currentLanguage.id === language.id }">
                    {{ $t('system.' + language.slug) }}
                  </span>
                  <span v-if="currentLanguage.id === language.id" class="text-f-primary">
                    <Svg name="check" class="size-4"></Svg>
                  </span>
                </div>
                </MenuItem>
              </div>
            </MenuItems>
          </Transition>
        </Menu>

        <!-- Mobile menu button -->
        <button @click="toggleMobileMenu" class="block xl:hidden p-2 rounded-md hover:bg-gray-100 transition-colors">
          <Svg name="menu" class="size-6"></Svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <Transition enter-active-class="transition-opacity duration-200" enter-from-class="opacity-0"
      enter-to-class="opacity-100" leave-active-class="transition-opacity duration-200" leave-from-class="opacity-100"
      leave-to-class="opacity-0">
      <div v-if="isMobileMenuOpen" class="fixed inset-0 bg-black/50 z-40 xl:hidden" @click="closeMobileMenu">
      </div>
    </Transition>

    <!-- Mobile Menu Sidebar -->
    <Transition enter-active-class="transition-transform duration-300 ease-out"
      enter-from-class="transform ltr:translate-x-full rtl:-translate-x-full" enter-to-class="transform translate-x-0"
      leave-active-class="transition-transform duration-300 ease-in" leave-from-class="transform translate-x-0"
      leave-to-class="transform ltr:translate-x-full rtl:-translate-x-full">
      <div v-if="isMobileMenuOpen" class="fixed inset-y-0 end-0 w-80 max-w-[90vw] bg-white shadow-2xl z-50 xl:hidden">
        <div class="h-full flex flex-col">
          <!-- Mobile Menu Header -->
          <div class="flex items-center p-4 ltr:justify-end rtl:justify-start">
            <button @click="closeMobileMenu" class="p-2 rounded-md hover:bg-gray-100 transition-colors">
              <Svg name="close" class="size-5 text-black"></Svg>
            </button>
          </div>

          <!-- Mobile Menu Content -->
          <div class="flex flex-col h-full">
            <!-- Links -->
            <div class="w-full py-4 my-auto mx-auto text-center">
              <Link :href="branchRoute('/')" @click="closeMobileMenu"
                class="w-full flex items-center justify-center px-6 py-5 text-xl text-gray-800 transition-colors"
                :class="{ 'font-semibold !text-f-primary': $page.component.startsWith('Frontend/Pages/Home') }">
              {{ $t('frontend.nav.home') }}
              </Link>
              <Link :href="branchRoute('/about')" @click="closeMobileMenu"
                class="w-full flex items-center justify-center px-6 py-5 text-xl text-gray-800 transition-colors"
                :class="{ 'font-semibold !text-f-primary': $page.component.startsWith('Frontend/Pages/About') }">
              {{ $t('frontend.nav.about') }}
              </Link>
              <Link :href="branchRoute('/campus')" @click="closeMobileMenu"
                class="w-full flex items-center justify-center px-6 py-5 text-xl text-gray-800 transition-colors"
                :class="{ 'font-semibold !text-f-primary': $page.component.startsWith('Frontend/Pages/Campus') }">
              {{ $t('frontend.nav.campus') }}
              </Link>
              <Link :href="branchRoute('/calendar')" @click="closeMobileMenu"
                class="w-full flex items-center justify-center px-6 py-5 text-xl text-gray-800 transition-colors"
                :class="{ 'font-semibold !text-f-primary': $page.component.startsWith('Frontend/Pages/Calendar') }">
              {{ $t('frontend.nav.calendar') }}
              </Link>
              <Link :href="branchRoute('/academics')" @click="closeMobileMenu"
                class="w-full flex items-center justify-center px-6 py-5 text-xl text-gray-800 transition-colors"
                :class="{ 'font-semibold !text-f-primary': $page.component.startsWith('Frontend/Pages/Academic') }">
              {{ $t('frontend.nav.academics') }}
              </Link>
              <Link :href="branchRoute('/admission')" @click="closeMobileMenu"
                class="w-full flex items-center justify-center px-6 py-5 text-xl text-gray-800 transition-colors"
                :class="{ 'font-semibold !text-f-primary': $page.component.startsWith('Frontend/Pages/Admission') }">
              {{ $t('frontend.nav.admission') }}
              </Link>
              <Link :href="branchRoute('/news')" @click="closeMobileMenu"
                class="w-full flex items-center justify-center px-6 py-5 text-xl text-gray-800 transition-colors"
                :class="{ 'font-semibold !text-f-primary': $page.component.startsWith('Frontend/Pages/News') }">
              {{ $t('frontend.nav.news') }}
              </Link>
            </div>
            <!-- Mobile Contact Info -->
            <div class="mt-auto">
              <div class="py-4">
                <div class="space-y-3 px-6">
                  <a v-if="contactInfo.phone" :href="`tel:${contactInfo.phone}`" class="flex items-center gap-3">
                    <Svg name="call_fill" class="size-5 text-f-primary"></Svg>
                    <span dir="ltr" class="text-sm text-gray-700">{{ contactInfo.phone }}</span>
                  </a>
                  <a v-if="contactInfo.email" :href="`mailto:${contactInfo.email}`" class="flex items-center gap-3">
                    <Svg name="email_fill" class="size-5 text-f-primary"></Svg>
                    <span class="text-sm text-gray-700">{{ contactInfo.email }}</span>
                  </a>
                  <div class="flex items-center gap-4 pt-2">
                    <a v-if="socialLinks.facebook" :href="socialLinks.facebook" target="_blank"
                      rel="noopener noreferrer" class="text-f-primary hover:text-f-primary-600 transition-colors"
                      aria-label="Facebook">
                      <Svg name="facebook_fill" class="size-6"></Svg>
                    </a>
                    <a v-if="socialLinks.instagram" :href="socialLinks.instagram" target="_blank"
                      rel="noopener noreferrer" class="text-f-primary hover:text-f-primary-600 transition-colors"
                      aria-label="Instagram">
                      <Svg name="instagram_fill" class="size-6"></Svg>
                    </a>
                    <a v-if="socialLinks.youtube" :href="socialLinks.youtube" target="_blank" rel="noopener noreferrer"
                      class="text-f-primary hover:text-f-primary-600 transition-colors" aria-label="YouTube">
                      <Svg name="youtube" class="h-7 opacity-85"></Svg>
                    </a>
                    <a v-if="socialLinks.twitter" :href="socialLinks.twitter" target="_blank" rel="noopener noreferrer"
                      class="text-f-primary hover:text-f-primary-600 transition-colors" aria-label="Twitter">
                      <Svg name="twitter" class="size-4.5"></Svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </nav>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import { loadLanguageAsync } from 'laravel-vue-i18n';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
import { getDefaultSettings } from '@/settings.js';
import helpers from '@/helpers';

const isMobileMenuOpen = ref(false);

// Initialize settings
const settings = getDefaultSettings();
const page = usePage();

// Language management - using data from middleware
const availableLanguages = ref(page.props.languages);

const currentLanguage = ref(
  availableLanguages.value.find(lang =>
    lang.slug === (page.props.locale || localStorage.getItem('language') || 'en')
  ) || availableLanguages.value[0]
);

// Branches management - get from backend
const branches = ref(page.props.branches || []);
const selectedBranch = ref(page.props.selectedBranch || branches.value[0]);

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

// branchRoute is now available globally - no need to import or define

// Helper function to get translated branch name
const getBranchName = (branch) => {
  if (!branch || !branch.name) return '';
  return helpers.getTranslatedText(branch.name, page);
};

function selectBranch(b) {
  selectedBranch.value = b;
  // Set the f-primary color based on the selected branch
  document.documentElement.style.setProperty('--color-f-primary', b.color);

  // Navigate to branch-specific URL
  // Get current path without branch prefix
  const currentPath = window.location.pathname;
  const segments = currentPath.split('/').filter(s => s);

  // Remove old branch slug if present
  const branchSlugs = branches.value.map(br => br.slug);
  if (segments.length > 0 && branchSlugs.includes(segments[0])) {
    segments.shift(); // Remove first segment (old branch)
  }

  // Build new URL with new branch slug
  const newPath = segments.length > 0
    ? `/${b.slug}/${segments.join('/')}`
    : `/${b.slug}`;

  router.visit(newPath, {
    preserveState: false,
    preserveScroll: false,
  });
}

async function selectLanguage(language) {
  // Update local ref first
  currentLanguage.value = language;

  // Use centralized settings to handle language change
  settings.changeLanguage(language.slug);

  // Update direction based on language data or fallback
  const direction = language.direction || ((language.slug === 'ar' || language.slug === 'ckb') ? 'rtl' : 'ltr');
  settings.toggleDir(direction);

  try {
    // Load the new language asynchronously for laravel-vue-i18n
    await loadLanguageAsync(language.slug);
  } catch (error) {
    console.warn('Could not load language:', language.slug, error);
  }

  // Use Inertia to refresh the page with new language context
  router.visit(window.location.href, {
    preserveState: false,
    preserveScroll: true,
    only: ['locale', 'lang']
  });
}

function toggleMobileMenu() {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
}

function closeMobileMenu() {
  isMobileMenuOpen.value = false;
}

// Initialize the f-primary color and direction when component mounts
onMounted(() => {
  // Ensure selectedBranch is properly set from page props
  if (page.props.selectedBranch) {
    selectedBranch.value = page.props.selectedBranch;
  }
  // Set the primary color based on the selected branch
  if (selectedBranch.value?.color) {
    document.documentElement.style.setProperty('--color-f-primary', selectedBranch.value.color);
  }

  // Set initial direction based on current language
  const savedDirection = localStorage.getItem('rtlClass') ||
    ((page.props.locale === 'ar' || page.props.locale === 'ckb') ? 'rtl' : 'ltr');
  settings.toggleDir(savedDirection);

  // Ensure currentLanguage is in sync with page props
  const currentLang = availableLanguages.value.find(lang =>
    lang.slug === (page.props.locale || localStorage.getItem('language') || 'en')
  );
  if (currentLang) {
    currentLanguage.value = currentLang;
  }
});
</script>
