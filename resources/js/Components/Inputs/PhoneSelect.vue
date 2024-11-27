<template>
    <div dir="ltr" class="dropdown flex">
        <Popper :placement="rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="0" class="align-middle">
            <button type="button" @click="phoneFocus"
                class="bg-[#eee] whitespace-nowrap flex justify-center items-center gap-1 rounded-l-md px-5 py-2 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">
                <img :src="phone.icon" alt="Flag" class="flag-icon size-5 object-contain">
                <span>
                    {{ phone.code }}
                </span>
            </button>
            <template #content="{ close }">
                <perfect-scrollbar :options="{
                    swipeEasing: true,
                    wheelPropagation: false,
                }" class="relative bg-white dark:bg-[#1b2e4b] p-2 mt-2 whitespace-nowrap shadow-sm rounded overflow-hidden border-x border-dark-light dark:border-[#213554] max-h-80 min-w-64">
                    <div class="bg-white dark:bg-[#1b2e4b] border-t border-x border-dark-light dark:border-[#213554] py-1.5 px-2 mt-2 fixed top-0 left-0 right-0 rounded-t-md">
                        <input ref="focusInput" type="text" placeholder="Search..." v-model="phoneFilter"
                            class="form-input py-1 rounded-none focus:border-gray-200" />
                    </div>
                    <div @click="close()" class="mt-10 w-full min-w-full">
                        <button type="button" v-for="phoneOption in phoneOptions" @click="close(), phone = phoneOption"
                            class="w-full flex items-center gap-3 px-1.5 py-1.5 duration-100 hover:bg-gray-100 dark:hover:bg-[#273e5f]">
                            <img :src="phoneOption.icon" alt="Flag" class="flag-icon size-5 object-contain">
                            {{ phoneOption.label }}
                        </button>
                    </div>
                    <div v-if="phoneOptions.length == 0" class="mt-10">
                        <div class="px-4 min-w-56">
                            {{ $t('form.no_results_found') }}
                        </div>
                    </div>
                </perfect-scrollbar>
            </template>
        </Popper>
        <input id="staticMask1" type="text" :placeholder="phone.filter" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)" class="form-input rounded-l-none"
            v-maska="phone.filter" />
    </div>
</template>

<script setup>
import { ref, computed, inject, defineProps } from 'vue';

defineProps(['modelValue']);
// const rtlClass = inject('rtlClass');
const rtlClass = 'ltr';

const phones = ref([
    {
        id: 1,
        name: 'Afghanistan',
        code: '+93',
        icon: '/assets/images/flags/AC.svg',
        filter: '+93(###)###-####',
    },
    {
        id: 2,
        name: 'Albania',
        code: '+355',
        icon: '/assets/images/flags/AL.svg',
        filter: '+355(###)###-###',
    },
    {
        id: 3,
        name: 'Algeria',
        code: '+213',
        icon: '/assets/images/flags/DZ.svg',
        filter: '+213(###)###-####',
    },
    {
        id: 4,
        name: 'American Samoa',
        code: '+1-684',
        icon: '/assets/images/flags/AS.svg',
        filter: '+1-684-###-####',
    },
    {
        id: 5,
        name: 'Andorra',
        code: '+376',
        icon: '/assets/images/flags/AD.svg',
        filter: '+376(###)###-###',
    },
    {
        id: 6,
        name: 'Angola',
        code: '+244',
        icon: '/assets/images/flags/AO.svg',
        filter: '+244(###)###-###',
    },
    {
        id: 7,
        name: 'Anguilla',
        code: '+1-264',
        icon: '/assets/images/flags/AI.svg',
        filter: '+1-264-###-####',
    },
    {
        id: 8,
        name: 'Antarctica',
        code: '+672',
        icon: '/assets/images/flags/KU.svg',
        filter: '+672(###)###-###',
    },
    {
        id: 9,
        name: 'Antigua and Barbuda',
        code: '+1-268',
        icon: '/assets/images/flags/AG.svg',
        filter: '+1-268-###-####',
    },
    {
        id: 10,
        name: 'Argentina',
        code: '+54',
        icon: '/assets/images/flags/AR.svg',
        filter: '+54(###)###-####',
    },
    {
        id: 11,
        name: 'Armenia',
        code: '+374',
        icon: '/assets/images/flags/AM.svg',
        filter: '+374(###)###-###',
    },
    {
        id: 12,
        name: 'Aruba',
        code: '+297',
        icon: '/assets/images/flags/AW.svg',
        filter: '+297(###)###-###',
    },
    {
        id: 13,
        name: 'Australia',
        code: '+61',
        icon: '/assets/images/flags/AU.svg',
        filter: '+61(###)###-###',
    },
    {
        id: 14,
        name: 'Austria',
        code: '+43',
        icon: '/assets/images/flags/AT.svg',
        filter: '+43(###)###-###',
    },
    {
        id: 15,
        name: 'Azerbaijan',
        code: '+994',
        icon: '/assets/images/flags/AZ.svg',
        filter: '+994(###)###-###',
    },
    {
        id: 16,
        name: 'Bahamas',
        code: '+1-242',
        icon: '/assets/images/flags/BS.svg',
        filter: '+1-242-###-####',
    },
    {
        id: 17,
        name: 'Bahrain',
        code: '+973',
        icon: '/assets/images/flags/BH.svg',
        filter: '+973(###)###-###',
    },
    {
        id: 18,
        name: 'Bangladesh',
        code: '+880',
        icon: '/assets/images/flags/BD.svg',
        filter: '+880(###)###-###',
    },
    {
        id: 19,
        name: 'Barbados',
        code: '+1-246',
        icon: '/assets/images/flags/BB.svg',
        filter: '+1-246-###-####',
    },
    {
        id: 20,
        name: 'Belarus',
        code: '+375',
        icon: '/assets/images/flags/BY.svg',
        filter: '+375(###)###-###',
    },
    {
        id: 21,
        name: 'Belgium',
        code: '+32',
        icon: '/assets/images/flags/BE.svg',
        filter: '+32(###)###-###',
    }
]);
const phoneOptions = computed(() => {
    return phones.value.filter((item) => {
        return item.name.toLowerCase().includes(phoneFilter.value.toLowerCase()) ||
            item.code.includes(phoneFilter.value);
    }).map((item) => {
        return {
            ...item,
            label: `${item.code} - ${item.name}`,
            icon: item.icon,
            filter: item.filter,
        };
    });
});
const phone = ref(phones.value[0]);
const phoneFilter = ref('');

const focusInput = ref(null);
const phoneFocus = () => {
    setTimeout(() => {
        focusInput.value.focus();
    }, 100);
};
</script>