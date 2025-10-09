    <template>
        <div class="main-section menu antialiased relative font-nunito text-black dark:text-gray-200 font-normal collapsible-vertical full ltr"
            :class="{ 'toggle-sidebar': sidebar }">
            <!--  BEGIN MAIN CONTAINER  -->
            <div class="relative">
                <!-- sidebar menu overlay -->
                <div class="fixed inset-0 bg-[black]/60 z-50 lg:hidden" :class="{ hidden: !sidebar }"
                    @click="toggleSidebar" />

                <!-- screen loader -->
                <div v-show="isShowMainLoader"
                    class="screen_loader fixed inset-0 bg-[#fafafa] dark:bg-[#060818] z-[60] grid place-content-center animate__animated">
                    <svg width="64" height="64" viewBox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#4361ee">
                        <path
                            d="M67.447 58c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10zm9.448 9.447c0 5.523 4.477 10 10 10 5.522 0 10-4.477 10-10s-4.478-10-10-10c-5.523 0-10 4.477-10 10zm-9.448 9.448c-5.523 0-10 4.477-10 10 0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zM58 67.447c0-5.523-4.477-10-10-10s-10 4.477-10 10 4.477 10 10 10 10-4.477 10-10z">
                            <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="-360 67 67"
                                dur="2.5s" repeatCount="indefinite" />
                        </path>
                        <path
                            d="M28.19 40.31c6.627 0 12-5.374 12-12 0-6.628-5.373-12-12-12-6.628 0-12 5.372-12 12 0 6.626 5.372 12 12 12zm30.72-19.825c4.686 4.687 12.284 4.687 16.97 0 4.686-4.686 4.686-12.284 0-16.97-4.686-4.687-12.284-4.687-16.97 0-4.687 4.686-4.687 12.284 0 16.97zm35.74 7.705c0 6.627 5.37 12 12 12 6.626 0 12-5.373 12-12 0-6.628-5.374-12-12-12-6.63 0-12 5.372-12 12zm19.822 30.72c-4.686 4.686-4.686 12.284 0 16.97 4.687 4.686 12.285 4.686 16.97 0 4.687-4.686 4.687-12.284 0-16.97-4.685-4.687-12.283-4.687-16.97 0zm-7.704 35.74c-6.627 0-12 5.37-12 12 0 6.626 5.373 12 12 12s12-5.374 12-12c0-6.63-5.373-12-12-12zm-30.72 19.822c-4.686-4.686-12.284-4.686-16.97 0-4.686 4.687-4.686 12.285 0 16.97 4.686 4.687 12.284 4.687 16.97 0 4.687-4.685 4.687-12.283 0-16.97zm-35.74-7.704c0-6.627-5.372-12-12-12-6.626 0-12 5.373-12 12s5.374 12 12 12c6.628 0 12-5.373 12-12zm-19.823-30.72c4.687-4.686 4.687-12.284 0-16.97-4.686-4.686-12.284-4.686-16.97 0-4.687 4.686-4.687 12.284 0 16.97 4.686 4.687 12.284 4.687 16.97 0z">
                            <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="360 67 67"
                                dur="8s" repeatCount="indefinite" />
                        </path>
                    </svg>
                </div>

                <div class="main-container min-h-screen pt-16" :class="[navbar]">
                    <!--  BEGIN SIDEBAR  -->
                    <Sidebar @toggle-sidebar="toggleSidebar" />
                    <!--  END SIDEBAR  -->

                    <!--  BEGIN CONTENT AREA  -->
                    <div class="main-content">
                        <!--  BEGIN TOP NAVBAR  -->
                        <Header @toggle-sidebar="toggleSidebar" @check-settings="checkSettings" />
                        <!--  END TOP NAVBAR  -->
                        <div class="p-6 animation">
                            <slot />
                            <!-- BEGIN FOOTER -->
                            <Footer />
                            <!-- END FOOTER -->
                        </div>
                    </div>
                    <!--  END CONTENT AREA  -->
                </div>
            </div>
        </div>
    </template>
<script setup>
import { ref, onMounted, provide, watch } from 'vue'
import Sidebar from '@/Components/Layout/Sidebar.vue'
import Header from '@/Components/Layout/Header.vue'
import Footer from '@/Components/Layout/Footer.vue'
import { getDefaultSettings } from '@/settings.js'
import { usePage } from '@inertiajs/vue3'
import useTranslate from '@/plugins/useTranslate'
import { useFontSettings } from '@/Composables/useFontSize'

const page = usePage()

// Initialize font settings
const { loadFontPreference } = useFontSettings()

// Settings and theme management
const settings = getDefaultSettings()

const theme = ref(page.props.auth?.user?.settings?.theme || settings.theme)
const rtlClass = ref(page.props.auth?.user?.settings?.direction || settings.rtl)
const sidebar = ref(settings.sidebar)
const navbar = ref(settings.navbar)
const isShowMainLoader = ref(settings.isShowMainLoader)
const language = ref(settings.locale)

const toggleSidebar = () => {
    sidebar.value = !sidebar.value
    settings.toggleSidebar(sidebar.value);
};

const toggleMobileMenu = () => {
    if (window.innerWidth < 1024) {
        sidebar.value = !sidebar.value;
    }
};

watch(
    () => page.url,
    () => {
        if (window.innerWidth < 1024) {
            sidebar.value = false;
        }
        // Reload font settings on page navigation
        loadFontPreference()
    }
);

const checkSettings = () => {
    theme.value = localStorage.getItem('theme') || settings.theme
    rtlClass.value = localStorage.getItem('rtlClass') || settings.rtl
    language.value = localStorage.getItem('language') || settings.locale
    console.log('Settings checked:', { theme: theme.value, rtlClass: rtlClass.value, language: language.value });
    // Reload font settings when settings are checked
    loadFontPreference()
}

onMounted(() => {
    setTimeout(() => {
        isShowMainLoader.value = false
    }, 500)
    console.log('User language:', page.props.auth?.user?.settings?.language.direction);

    // Initialize theme and language settings
    settings.toggleTheme(page.props.auth?.user?.settings?.theme)
    settings.toggleDir(page.props.auth?.user?.settings?.language.direction)
    settings.changeLanguage(page.props.auth?.user?.settings?.language.name)
    settings.toggleFontScale(page.props.auth?.user?.settings?.font_scale)
    settings.toggleFontWeight(page.props.auth?.user?.settings?.font_weight)

    // Initialize font settings
    loadFontPreference()
})

const translations = usePage().props.translations
const t = useTranslate(translations)

provide('t', t)
provide('theme', theme)
provide('rtlClass', rtlClass)
provide('language', language)
</script>
