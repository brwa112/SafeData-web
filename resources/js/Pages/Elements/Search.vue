<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Elements</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Search</span>
            </li>
        </ul>
        <div class="pt-5 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="panel lg:row-span-2">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Live Search</h5>
                </div>
                <div class="mb-5 space-y-5">
                    <div>
                        <form class="mx-auto w-full sm:w-1/2 mb-5">
                            <div class="relative">
                                <input type="text" placeholder="Search Attendees..."
                                    class="form-input shadow-[0_0_4px_2px_rgb(31_45_61_/_10%)] bg-white rounded-full h-11 placeholder:tracking-wider ltr:pr-11 rtl:pl-11"
                                    v-model="search" />
                                <button type="button"
                                    class="btn btn-primary absolute ltr:right-1 rtl:left-1 inset-y-0 m-auto rounded-full w-9 h-9 p-0 flex items-center justify-center">
                                    <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                            opacity="0.5"></circle>
                                        <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                        <div class="p-4 border border-white-dark/20 rounded-lg space-y-4 overflow-x-auto w-full block">
                            <template v-for="(item, i) in searchResults" :key="i">
                                <div
                                    class="bg-white dark:bg-[#1b2e4b] rounded-xl shadow-[0_0_4px_2px_rgb(31_45_61_/_10%)] p-3 flex items-center justify-between text-gray-500 font-semibold min-w-[625px] hover:text-primary transition-all duration-300 hover:scale-[1.01]">
                                    <div class="user-profile">
                                        <img :src="`/assets/images/${item.thumb}`" alt=""
                                            class="w-8 h-8 rounded-md object-cover" />
                                    </div>
                                    <div>{{ item.name }}</div>
                                    <div>{{ item.email }}</div>
                                    <div class="badge border-2 border-dashed" :class="item.statusClass">
                                        {{ item.status }}
                                    </div>
                                    <div class="cursor-pointer">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 opacity-70">
                                            <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                                            <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                                stroke-width="1.5"></circle>
                                            <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                                        </svg>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Overlay</h5>
                </div>
                <div class="mb-5 space-y-5">
                    <form>
                        <div class="search-form-overlay relative border border-white-dark/20 rounded-md h-12 w-full"
                            @click="focus = true" :class="focus && 'input-focused'">
                            <input type="text" placeholder="Search..."
                                class="form-input bg-white h-full placeholder:tracking-wider hidden ltr:pl-12 rtl:pr-12 peer"
                                :class="{ '!block': focus }" @blur="focus = false" />
                            <button type="submit"
                                class="text-dark/70 absolute ltr:right-1 rtl:left-1 inset-y-0 my-auto w-9 h-9 p-0 flex items-center justify-center peer-focus:text-primary"
                                :class="{ 'ltr:!right-auto ltr:left-1 rtl:right-1': focus }">
                                <svg class="mx-auto" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                        opacity="0.5"></circle>
                                    <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Search Box</h5>
                </div>
                <div class="mb-5 space-y-5">
                    <form>
                        <div class="relative border border-white-dark/20 w-full flex">
                            <button type="submit" placeholder="Let's find your question in fast way"
                                class="text-primary m-auto p-3 flex items-center justify-center">
                                <svg class="mx-auto" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                        opacity="0.5"></circle>
                                    <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                </svg>
                            </button>
                            <input type="text" placeholder="Let's find your question in fast way"
                                class="form-input border-0 border-l rounded-none bg-white focus:shadow-[0_0_5px_2px_rgb(194_213_255_/_62%)] dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none py-3" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, computed } from 'vue';

const search = ref('');
const items = [
    {
        thumb: 'profile-5.jpeg',
        name: 'Alan Green',
        email: 'alan@mail.com',
        status: 'Active',
        statusClass: 'badge badge-outline-primary',
    },
    {
        thumb: 'profile-11.jpeg',
        name: 'Linda Nelson',
        email: 'Linda@mail.com',
        status: 'Busy',
        statusClass: 'badge badge-outline-danger',
    },
    {
        thumb: 'profile-12.jpeg',
        name: 'Lila Perry',
        email: 'Lila@mail.com',
        status: 'Closed',
        statusClass: 'badge badge-outline-warning',
    },
    {
        thumb: 'profile-3.jpeg',
        name: 'Andy King',
        email: 'Andy@mail.com',
        status: 'Active',
        statusClass: 'badge badge-outline-primary',
    },
    {
        thumb: 'profile-15.jpeg',
        name: 'Jesse Cory',
        email: 'Jesse@mail.com',
        status: 'Busy',
        statusClass: 'badge badge-outline-danger',
    },
];
const focus = ref(false);

const searchResults = computed(() => {
    return items.filter((item) => {
        return (
            item.name.toLowerCase().includes(search.value.toLowerCase()) ||
            item.email.toLowerCase().includes(search.value.toLowerCase()) ||
            item.status.toLowerCase().includes(search.value.toLowerCase())
        );
    });
});
</script>
