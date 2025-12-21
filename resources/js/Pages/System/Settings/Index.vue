<template>

    <Head>
        <title>{{ $t('system.settings') }}</title>
    </Head>

    <div class="max-w-lg">

        <div class="flex items-center justify-between">
            <h5 class="font-semibold text-lg px-2">{{ $t('system.settings') }}</h5>
            <!-- <input type="text" placeholder="Search...." class="form-input max-w-max" /> -->
        </div>

        <TabGroup as="div" class="mb-5" :selectedIndex="selectedTab" @change="handleTabChange">
            <perfect-scrollbar class="relative">
                <TabList class="mt-2 mb-3 border-b border-white-light dark:border-[#191e3a]">
                    <div class="flex whitespace-nowrap">

                        <!-- Settings -->
                        <Tab as="template" v-slot="{ selected }"
                            v-if="$can('view_system_settings|view_group_permissions|view_logs|view_font_size|view_theme|view_languages|view_keys|view_translations')">
                            <button type="button"
                                class="p-5 py-3 -mb-[1px] flex items-center gap-2 hover:border-b border-transparent hover:!border-secondary hover:text-secondary !outline-none transition duration-300"
                                :class="{ 'border-b !border-secondary text-secondary': selected }">
                                <Svg name="setup" class="size-5 opacity-90"></Svg>
                                {{ $t('system.settings') }}
                            </button>
                        </Tab>

                        <!-- Pages -->
                        <Tab as="template" v-slot="{ selected }" v-if="$can('view_settings')">
                            <button type="button"
                                class="p-5 py-3 -mb-[1px] flex items-center gap-2 hover:border-b border-transparent hover:!border-secondary hover:text-secondary !outline-none transition duration-300"
                                :class="{ 'border-b !border-secondary text-secondary': selected }">
                                <Svg name="pages" class="size-5 opacity-70"></Svg>
                                {{ $t('system.pages') }}
                            </button>
                        </Tab>

                    </div>
                </TabList>
            </perfect-scrollbar>
            <TabPanels class="flex-1 text-sm">
                <!-- Settings -->
                <TabPanel
                    v-if="$can('view_system_settings|view_group_permissions|view_logs|view_font_size|view_theme|view_languages|view_keys|view_translations')">
                    <div class="panel p-2">
                        <div class="border-2 rounded dark:border-[#191e3a] overflow-hidden">
                            <div class="flex flex-col divide-y-2 dark:divide-[#191e3a]">

                                <!-- user types removed -->
                                <SettingMenu link="control.system.settings.group_permissions.index"
                                    label="group_permissions" icon="shield" is="developer"
                                    can="view_group_permissions" />
                                <SettingMenu link="control.system.settings.logs.index" label="logs" icon="note"
                                    can="view_logs" />
                                <SettingMenu link="control.system.settings.theme.index" label="theme" icon="moon"
                                    is="super_admin" can="view_theme" />
                                <SettingMenu link="control.system.settings.languages.index" label="languages"
                                    icon="earth" is="super_admin" can="view_languages" />
                                <SettingMenu link="control.system.settings.keys.index" label="keys" icon="key"
                                    is="super_admin" can="view_keys" />
                                <SettingMenu link="control.system.settings.translations.index" label="translations"
                                    icon="earth" is="super_admin" can="view_translations" />
                                <SettingMenu link="control.system.settings.theme.index" label="themes" icon="sun"
                                    is="super_admin" can="view_themes" />

                            </div>
                        </div>
                    </div>
                </TabPanel>
                <!-- Pages -->
                <!-- v-if="$can('')" -->
                <TabPanel>
                    <div class="panel p-2">
                        <div class="border-2 rounded dark:border-[#191e3a] overflow-hidden">
                            <div class="flex flex-col divide-y-2 dark:divide-[#191e3a]">
                                <SettingMenu link="control.system.settings.social-links.index" label="social_links"
                                    icon="link" can="view_settings" />

                                <SettingMenu link="control.system.settings.mail-information.index" label="mail_information"
                                    icon="link" can="view_settings" />
                            </div>
                        </div>
                    </div>
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>

</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import SettingMenu from '@/Components/Ui/SettingMenu.vue';

// Check URL hash to determine which tab to open
const selectedTab = ref(0);

// Initialize from URL hash on mount
onMounted(() => {
    const hash = window.location.hash;
    if (hash === '#pages') {
        selectedTab.value = 1; // Pages tab
    } else if (hash === '#settings' || !hash) {
        selectedTab.value = 0; // Settings tab (default)
    }
});

// Handle tab change and update URL hash
const handleTabChange = (index) => {
    selectedTab.value = index;
    if (index === 0) {
        window.location.hash = '#settings';
    } else if (index === 1) {
        window.location.hash = '#pages';
    }
};
</script>
