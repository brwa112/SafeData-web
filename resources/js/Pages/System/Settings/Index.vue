<template>

    <Head>
        <title>{{ $t('system.settings') }}</title>
    </Head>

    <div class="max-w-lg">

        <div class="flex items-center justify-between">
            <h5 class="font-semibold text-lg px-2">{{ $t('system.settings') }}</h5>
            <!-- <input type="text" placeholder="Search...." class="form-input max-w-max" /> -->
        </div>

        <TabGroup as="div" class="mb-5">
            <perfect-scrollbar class="relative">
                <TabList class="mt-2 mb-3 border-b border-white-light dark:border-[#191e3a]">
                    <div class="flex whitespace-nowrap">

                        <!-- Settings -->
                        <Tab as="template" v-slot="{ selected }"
                            v-if="$can('view_system_settings|view_usertypes|view_group_permissions|view_logs|view_font_size|view_theme|view_languages|view_keys|view_translations')">
                            <button type="button"
                                class="p-5 py-3 -mb-[1px] flex items-center gap-2 hover:border-b border-transparent hover:!border-secondary hover:text-secondary !outline-none transition duration-300"
                                :class="{ 'border-b !border-secondary text-secondary': selected }">
                                <Svg name="setup" class="size-5 opacity-90"></Svg>
                                {{ $t('system.settings') }}
                            </button>
                        </Tab>

                        <!-- Pages -->
                        <Tab as="template" v-slot="{ selected }"
                            v-if="$can('view_home')">
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
                    v-if="$can('view_system_settings|view_usertypes|view_group_permissions|view_logs|view_font_size|view_theme|view_languages|view_keys|view_translations')">
                    <div class="panel p-2">
                        <div class="border-2 rounded dark:border-[#191e3a] overflow-hidden">
                            <div class="flex flex-col divide-y-2 dark:divide-[#191e3a]">

                                <SettingMenu link="control.system.settings.usertype.index" label="user_type"
                                    icon="users" can="view_usertypes" />

                                <SettingMenu link="control.system.settings.group_permissions.index"
                                    label="group_permissions" icon="shield" is="developer"
                                    can="view_group_permissions" />

                                <SettingMenu link="control.system.settings.logs.index" label="logs" icon="note"
                                    can="view_logs" />

                                <SettingMenu link="control.system.settings.fontSize.index" label="font_size" icon="file"
                                    can="view_font_size" />

                                <SettingMenu link="control.system.settings.theme.index" label="theme" icon="moon"
                                    can="view_theme" />

                                <SettingMenu link="control.system.settings.languages.index" label="languages"
                                    icon="earth" can="view_languages" />

                                <SettingMenu link="control.system.settings.keys.index" label="keys" icon="key"
                                    can="view_keys" />

                                <SettingMenu link="control.system.settings.translations.index" label="translations"
                                    icon="earth" can="view_translations" />

                                <SettingMenu link="control.system.settings.theme.index" label="themes" icon="sun"
                                    can="view_themes" />

                            </div>
                        </div>
                    </div>
                </TabPanel>
                <!-- Pages -->
                <TabPanel
                    v-if="$can('view_system_settings|view_usertypes|view_group_permissions|view_logs|view_font_size|view_theme|view_languages|view_keys|view_translations')">
                    <div class="panel p-2">
                        <div class="border-2 rounded dark:border-[#191e3a] overflow-hidden">
                            <div class="flex flex-col divide-y-2 dark:divide-[#191e3a]">

                                <SettingMenu link="control.system.pages.home.index" label="home" icon="home_angle"
                                    can="view_home" />

                            </div>
                        </div>
                    </div>
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>

</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import SettingMenu from '@/Components/Ui/SettingMenu.vue';
</script>