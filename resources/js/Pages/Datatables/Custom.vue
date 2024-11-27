<template>
    <div>
        <div class="panel pb-0">
            <div class="flex md:items-center md:flex-row flex-col mb-5 gap-5">
                <div class="flex items-center gap-3">
                    <h5 class="font-semibold text-lg dark:text-white-light">
                        Custom Datatable
                    </h5>
                    <!-- add new row -->
                    <div class="block">
                        <!-- Trigger -->
                        <div class="flex items-center justify-center">
                            <button type="button" class="btn btn-primary shadow-none flex items-center gap-1"
                                @click="modal1 = true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M3 10c0-3.771 0-5.657 1.172-6.828C5.343 2 7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172C21 4.343 21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828C18.657 22 16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172C3 19.657 3 17.771 3 14z"
                                        opacity=".5" />
                                    <path fill="currentColor"
                                        d="M16.519 16.501c.175-.136.334-.295.651-.612l3.957-3.958c.096-.095.052-.26-.075-.305a4.332 4.332 0 0 1-1.644-1.034a4.332 4.332 0 0 1-1.034-1.644c-.045-.127-.21-.171-.305-.075L14.11 12.83c-.317.317-.476.476-.612.651c-.161.207-.3.43-.412.666c-.095.2-.166.414-.308.84l-.184.55l-.292.875l-.273.82a.584.584 0 0 0 .738.738l.82-.273l.875-.292l.55-.184c.426-.142.64-.212.84-.308c.236-.113.46-.25.666-.412m5.849-5.809a2.163 2.163 0 1 0-3.06-3.059l-.126.128a.524.524 0 0 0-.148.465c.02.107.055.265.12.452c.13.375.376.867.839 1.33a3.5 3.5 0 0 0 1.33.839c.188.065.345.1.452.12a.525.525 0 0 0 .465-.148z" />
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M7.25 9A.75.75 0 0 1 8 8.25h6.5a.75.75 0 0 1 0 1.5H8A.75.75 0 0 1 7.25 9m0 4a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75m0 4a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75"
                                        clip-rule="evenodd" />
                                </svg>
                                New Row
                            </button>
                        </div>

                        <!-- Modal -->
                        <TransitionRoot appear :show="modal1" as="template">
                            <Dialog as="div" @close="modal1 = false" class="relative z-50">
                                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                    leave-to="opacity-0">
                                    <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                </TransitionChild>

                                <div class="fixed inset-0 overflow-y-auto">
                                    <div class="flex min-h-full items-start justify-center px-4 py-8">
                                        <TransitionChild as="template" enter="duration-300 ease-out"
                                            enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                            leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                            leave-to="opacity-0 scale-95">
                                            <DialogPanel
                                                class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                                <button type="button"
                                                    class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                    @click="modal1 = false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-6 h-6">
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                    </svg>
                                                </button>
                                                <div
                                                    class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                    Add New Row
                                                </div>
                                                <div class="p-5">
                                                    <form class="space-y-5">
                                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                            <div>
                                                                <label for="gridEmail">Email</label>
                                                                <input id="gridEmail" type="email" placeholder="Enter Email"
                                                                    class="form-input" />
                                                            </div>
                                                            <div>
                                                                <label for="gridPassword">Password</label>
                                                                <input id="gridPassword" type="Password"
                                                                    placeholder="Enter Password" class="form-input" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label for="gridAddress1">Address</label>
                                                            <input id="gridAddress1" type="text" placeholder="Enter Address"
                                                                value="1234 Main St" class="form-input" />
                                                        </div>
                                                        <div>
                                                            <label for="gridAddress2">Address2</label>
                                                            <input id="gridAddress2" type="text"
                                                                placeholder="Enter Address2"
                                                                value="Apartment, studio, or floor" class="form-input" />
                                                        </div>
                                                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                                            <div class="md:col-span-2">
                                                                <label for="gridCity">City</label>
                                                                <input id="gridCity" type="text" placeholder="Enter City"
                                                                    class="form-input" />
                                                            </div>
                                                            <div>
                                                                <label for="gridState">State</label>
                                                                <select id="gridState" class="form-select text-white-dark">
                                                                    <option>Choose...</option>
                                                                    <option>...</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <label for="gridZip">Zip</label>
                                                                <input id="gridZip" type="text" placeholder="Enter Zip"
                                                                    class="form-input" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label class="flex items-center mt-1 cursor-pointer">
                                                                <input type="checkbox" class="form-checkbox" />
                                                                <span class="text-white-dark">Check me out</span>
                                                            </label>
                                                        </div>
                                                    </form>

                                                    <div class="flex justify-end items-center mt-5">
                                                        <button type="button" @click="modal1 = false"
                                                            class="btn btn-outline-danger">Discard</button>
                                                        <button type="button" @click="modal1 = false"
                                                            class="btn btn-primary ltr:ml-4 rtl:mr-4">Save</button>
                                                    </div>
                                                </div>
                                            </DialogPanel>
                                        </TransitionChild>
                                    </div>
                                </div>
                            </Dialog>
                        </TransitionRoot>
                    </div>
                </div>
                <div class="flex items-center gap-2 ltr:ml-auto rtl:mr-auto">
                    <!-- filter search -->
                    <div class="dropdown">
                        <Popper :placement="rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="0"
                            class="align-middle">
                            <button type="button"
                                class="flex items-center gap-1 border font-semibold border-[#e0e6ed] dark:border-[#253b5c] rounded-md px-4 py-2 text-sm dark:bg-[#1b2e4b] dark:text-white-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path fill="#1C274C" fill-rule="evenodd" opacity=".8"
                                        d="M5 3h14L8.816 13.184a2.705 2.705 0 0 0-.778-1.086c-.228-.198-.547-.377-1.183-.736l-2.913-1.64c-.949-.533-1.423-.8-1.682-1.23C2 8.061 2 7.541 2 6.503v-.69c0-1.326 0-1.99.44-2.402C2.878 3 3.585 3 5 3"
                                        clip-rule="evenodd" />
                                    <path fill="#1C274C"
                                        d="M22 6.504v-.69c0-1.326 0-1.99-.44-2.402C21.122 3 20.415 3 19 3L8.815 13.184c.05.129.09.263.121.403c.064.285.064.619.064 1.286v2.67c0 .909 0 1.364.252 1.718c.252.355.7.53 1.594.88c1.879.734 2.818 1.101 3.486.683c.668-.417.668-1.372.668-3.282v-2.67c0-.666 0-1 .063-1.285a2.68 2.68 0 0 1 .9-1.49c.227-.197.545-.376 1.182-.735l2.913-1.64c.948-.533 1.423-.8 1.682-1.23c.26-.43.26-.95.26-1.988"
                                        opacity=".5" />
                                </svg>
                                <span class="ltr:mr-1 rtl:ml-1">Filter</span>
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <template #content>
                                <ul class="whitespace-nowrap">
                                    <li>
                                        <div class="flex flex-col gap-2 px-2 w-56">
                                            <div class="md:flex-auto flex-1">
                                                <input v-model="minAge" type="text" class="form-input"
                                                    placeholder="Minimum age..." />
                                            </div>
                                            <div class="md:flex-auto flex-1">
                                                <input v-model="maxAge" type="text" class="form-input"
                                                    placeholder="Maximum age..." />
                                            </div>
                                            <div class="flex justify-end gap-2 w-full">
                                                <div class="flex items-center">
                                                    <button type="button" class="btn btn-outline-primary"
                                                        @click="filterChange(false)">Reset</button>
                                                </div>
                                                <div class="flex items-center">
                                                    <button type="button" class="btn btn-primary shadow-none"
                                                        @click="filterChange(true)">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </template>
                        </Popper>
                    </div>
                    <!-- columns filter -->
                    <div class="dropdown">
                        <Popper :placement="rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'" offsetDistance="0"
                            class="align-middle">
                            <button type="button"
                                class="flex items-center border font-semibold border-[#e0e6ed] dark:border-[#253b5c] rounded-md p-1 text-sm dark:bg-[#1b2e4b] dark:text-white-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect x="12" y="2" width="10" height="10" rx="2" fill="#1C274C" opacity=".8" />
                                    <path opacity="0.6"
                                        d="M12 7H11C9.11438 7 8.17157 7 7.58579 7.58579C7 8.17157 7 9.11438 7 11V13C7 14.8856 7 15.8284 7.58579 16.4142C8.17157 17 9.11438 17 11 17H13C14.8856 17 15.8284 17 16.4142 16.4142C17 15.8284 17 14.8856 17 13V12H16C14.1144 12 13.1716 12 12.5858 11.4142C12 10.8284 12 9.88562 12 8V7Z"
                                        fill="#1C274C" />
                                    <path opacity="0.4"
                                        d="M7 12V13C7 14.8856 7 15.8284 7.58579 16.4142C8.17157 17 9.11438 17 11 17H12V18C12 19.8856 12 20.8284 11.4142 21.4142C10.8284 22 9.88562 22 8 22H6C4.11438 22 3.17157 22 2.58579 21.4142C2 20.8284 2 19.8856 2 18V16C2 14.1144 2 13.1716 2.58579 12.5858C3.17157 12 4.11438 12 6 12H7Z"
                                        fill="#1C274C" />
                                </svg>
                            </button>
                            <template #content>
                                <ul class="whitespace-nowrap">
                                    <template v-for="(col, i) in cols" :key="i">
                                        <li>
                                            <div class="flex items-center px-4 py-1">
                                                <label class="cursor-pointer mb-0">
                                                    <input type="checkbox" class="form-checkbox" :id="`chk-${i}`"
                                                        :value="col.field" @change="col.hide = !$event.target.checked"
                                                        :checked="!col.hide" />
                                                    <span :for="`chk-${i}`" class="ltr:ml-2 rtl:mr-2">
                                                        {{ col.title }}
                                                    </span>
                                                </label>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </template>
                        </Popper>
                    </div>
                    <div>
                        <input v-model="search" type="text" class="form-input" placeholder="Search..." />
                    </div>
                </div>
            </div>

            <div class="datatable relative">

                <!-- table -->
                <vue3-datatable :rows="filterRows" :columns="cols" :totalRows="filterRows?.length" :search="search"
                    :hasCheckbox="true" :sortable="true" skin="whitespace-nowrap table-hover table-striped"
                    firstArrow='<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>'
                    lastArrow='<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg> '
                    previousArrow='<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>'
                    nextArrow='<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>'
                    class="alt-pagination">

                    <template #firstName="data">
                        <div class="flex items-center gap-2">
                            <img :src="`/assets/images/profile-${getRandomNumber(1, 34)}.jpeg`"
                                class="w-9 h-9 rounded-full max-w-none" alt="user-profile" />
                            <div class="font-semibold">{{ data.value.firstName + ' ' + data.value.lastName }}</div>
                        </div>
                    </template>

                    <template #dob="data">
                        {{ formatDate(data.value.dob) }}
                    </template>

                    <template #isActive="data">
                        <span class="capitalize" :class="data.value.isActive ? 'text-success' : 'text-danger'">{{
                            data.value.isActive }}</span>
                    </template>

                    <template #actions="data">
                        <div class="flex gap-2">
                            <div class="text-center">
                                <button type="button" v-tippy>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="6" r="4" fill="currentColor" stroke-width="1.5" opacity="0.7" />
                                        <path opacity="0.4"
                                            d="M15 20.6151C14.0907 20.8619 13.0736 21 12 21C8.13401 21 5 19.2091 5 17C5 14.7909 8.13401 13 12 13C15.866 13 19 14.7909 19 17C19 17.3453 18.9234 17.6804 18.7795 18"
                                            fill="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <tippy>User</tippy>
                            </div>
                            <div class="text-center">
                                <button type="button" v-tippy>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                        <path d="M9.5 4L4 10L14 10M20 10L17.5 10" fill="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" opacity="0.7" />
                                        <path d="M14.5 20L20 14L10 14M4 14L6.5 14" fill="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" opacity="0.7" />
                                    </svg>
                                </button>
                                <tippy>Side</tippy>
                            </div>
                            <div class="text-center">
                                <button type="button" v-tippy>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.4"
                                            d="M11.4001 18.1612L11.4001 18.1612L18.796 10.7653C17.7894 10.3464 16.5972 9.6582 15.4697 8.53068C14.342 7.40298 13.6537 6.21058 13.2348 5.2039L5.83882 12.5999L5.83879 12.5999C5.26166 13.1771 4.97307 13.4657 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L7.47918 20.5844C8.25351 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5343 19.0269 10.823 18.7383 11.4001 18.1612Z"
                                            fill="currentColor" />
                                        <path opacity="0.7"
                                            d="M20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178L14.3999 4.03882C14.4121 4.0755 14.4246 4.11268 14.4377 4.15035C14.7628 5.0875 15.3763 6.31601 16.5303 7.47002C17.6843 8.62403 18.9128 9.23749 19.85 9.56262C19.8875 9.57563 19.9245 9.58817 19.961 9.60026L20.8482 8.71306Z"
                                            fill="currentColor" />
                                    </svg>
                                </button>
                                <tippy>Update</tippy>
                            </div>
                            <div class="text-center">
                                <button type="button" v-tippy>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.4"
                                            d="M3 6.52381C3 6.12932 3.32671 5.80952 3.72973 5.80952H8.51787C8.52437 4.9683 8.61554 3.81504 9.45037 3.01668C10.1074 2.38839 11.0081 2 12 2C12.9919 2 13.8926 2.38839 14.5496 3.01668C15.3844 3.81504 15.4756 4.9683 15.4821 5.80952H20.2703C20.6733 5.80952 21 6.12932 21 6.52381C21 6.9183 20.6733 7.2381 20.2703 7.2381H3.72973C3.32671 7.2381 3 6.9183 3 6.52381Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" opacity="0.6"
                                            d="M11.5956 22H12.4044C15.1871 22 16.5785 22 17.4831 21.1141C18.3878 20.2281 18.4803 18.7749 18.6654 15.8685L18.9321 11.6806C19.0326 10.1036 19.0828 9.31511 18.6289 8.81545C18.1751 8.31579 17.4087 8.31579 15.876 8.31579H8.12404C6.59127 8.31579 5.82488 8.31579 5.37105 8.81545C4.91722 9.31511 4.96744 10.1036 5.06788 11.6806L5.33459 15.8685C5.5197 18.7749 5.61225 20.2281 6.51689 21.1141C7.42153 22 8.81289 22 11.5956 22ZM10.2463 12.1885C10.2051 11.7546 9.83753 11.4381 9.42537 11.4815C9.01321 11.5249 8.71251 11.9117 8.75372 12.3456L9.25372 17.6087C9.29494 18.0426 9.66247 18.3591 10.0746 18.3157C10.4868 18.2724 10.7875 17.8855 10.7463 17.4516L10.2463 12.1885ZM14.5746 11.4815C14.9868 11.5249 15.2875 11.9117 15.2463 12.3456L14.7463 17.6087C14.7051 18.0426 14.3375 18.3591 13.9254 18.3157C13.5132 18.2724 13.2125 17.8855 13.2537 17.4516L13.7537 12.1885C13.7949 11.7546 14.1625 11.4381 14.5746 11.4815Z"
                                            fill="currentColor" />
                                    </svg>
                                </button>
                                <tippy>Delete</tippy>
                            </div>
                        </div>
                    </template>

                    <template #address="data">
                        <div class="flex gap-1">
                            <span>{{ data.value.address.street }}, </span>
                            <span>{{ data.value.address.city }}, </span>
                            <span>{{ data.value.address.zipcode }}</span>
                        </div>
                    </template>

                    <template #email="data">
                        <a :href="`mailto:${data.value.email}`" class="underline text-blue-600">{{ data.value.email }}</a>
                    </template>

                    <template #status>
                        <span class="badge" :class="`badge-outline-${randomStatusColor()}`">{{ randomStatus() }}</span>
                    </template>

                    <template #soldRent="data">
                        <!-- create group button for this -->
                        <div class="flex items-center capitalize">
                            <template v-if="data.value.soldRent.value == 'rent'">
                                <button type="button" class="btn rounded-r-none py-1 px-2 shadow-none"
                                    @click="soldRentChange(data.value, true)"
                                    :class="data.value.soldRent.status == true ? 'btn-info' : 'btn-outline-info'">
                                    Rent
                                </button>
                                <button type="button" class="btn rounded-l-none border-l-0 py-1 px-2 shadow-none"
                                    @click="soldRentChange(data.value, false)"
                                    :class="!data.value.soldRent.status ? 'btn-info' : 'btn-outline-info'">
                                    Not Rent
                                </button>
                            </template>
                            <template v-if="data.value.soldRent.value == 'sold'">
                                <button type="button" class="btn rounded-r-none py-1 px-2 shadow-none"
                                    @click="soldRentChange(data.value, true)"
                                    :class="data.value.soldRent.status == true ? 'btn-success' : 'btn-outline-success'">
                                    Sold
                                </button>
                                <button type="button" class="btn rounded-l-none border-l-0 py-1 px-2 shadow-none"
                                    @click="soldRentChange(data.value, false)"
                                    :class="!data.value.soldRent.status == true ? 'btn-success' : 'btn-outline-success'">
                                    Not Sold
                                </button>
                            </template>
                        </div>
                    </template>

                </vue3-datatable>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, inject } from 'vue';
import Vue3Datatable from '@bhplugin/vue3-datatable';
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';

const rtlClass = inject('rtlClass');

const modal1 = ref(false);
const minAge = ref('');
const maxAge = ref('');
const search = ref('');

const cols =
    ref([
        { field: 'id', title: 'ID', isUnique: true },
        { field: 'firstName', title: 'Full Name' },
        { field: 'email', title: 'Email', type: 'button' },
        { field: 'address', title: 'Address', type: 'object' },
        { field: 'isActive', title: 'Active', type: 'boolean' },
        { field: 'phone', title: 'Phone' },
        { field: 'age', title: 'Age' },
        { field: 'soldRent', title: 'Sold / Rent', type: 'badge' },
        { field: 'dob', title: 'Date of Birth', type: 'date' },
        { field: 'company', title: 'Company' },
        { field: 'status', title: 'Status', type: 'badge', sort: false },
        { field: 'actions', title: 'Actions', sort: false },
    ]) || [];

const rows = ref(
    [
        {
            id: 1,
            firstName: 'Caroline',
            lastName: 'Jensen',
            email: 'carolinejensen@zidant.com',
            dob: '2004-05-28',
            address: {
                street: '529 Scholes Street',
                city: 'Temperanceville',
                zipcode: 5235,
                geo: {
                    lat: 23.806115,
                    lng: 164.677197,
                },
            },
            phone: '+1 (821) 447-3782',
            isActive: true,
            age: 39,
            soldRent: {
                value: 'sold',
                status: true,
            },
            company: 'POLARAX',
            status: 'approved',
        },
        {
            id: 2,
            firstName: 'Celeste',
            lastName: 'Grant',
            email: 'celestegrant@polarax.com',
            dob: '1989-11-19',
            address: {
                street: '639 Kimball Street',
                city: 'Bascom',
                zipcode: 8907,
                geo: {
                    lat: 65.954483,
                    lng: 98.906478,
                },
            },
            phone: '+1 (838) 515-3408',
            isActive: false,
            age: 32,
            soldRent: {
                value: 'rent',
                status: true,
            },
            company: 'MANGLO',
            status: 'cancel',
        },
        {
            id: 3,
            firstName: 'Tillman',
            lastName: 'Forbes',
            email: 'tillmanforbes@manglo.com',
            dob: '2016-09-05',
            address: {
                street: '240 Vandalia Avenue',
                city: 'Thynedale',
                zipcode: 8994,
                geo: {
                    lat: -34.949388,
                    lng: -82.958111,
                },
            },
            phone: '+1 (969) 496-2892',
            isActive: false,
            age: 26,
            soldRent: {
                value: 'sold',
                status: false,
            },
            company: 'APPLIDECK',
            status: 'pending',
        },
        {
            id: 4,
            firstName: 'Daisy',
            lastName: 'Whitley',
            email: 'daisywhitley@applideck.com',
            dob: '1987-03-23',
            address: {
                street: '350 Pleasant Place',
                city: 'Idledale',
                zipcode: 9369,
                geo: {
                    lat: -54.458809,
                    lng: -127.476556,
                },
            },
            phone: '+1 (861) 564-2877',
            isActive: true,
            age: 21,
            soldRent: {
                value: 'sold',
                status: true,
            },
            company: 'VOLAX',
            status: 'pending',
        },
        {
            id: 5,
            firstName: 'Weber',
            lastName: 'Bowman',
            email: 'weberbowman@volax.com',
            dob: '1983-02-24',
            address: {
                street: '154 Conway Street',
                city: 'Broadlands',
                zipcode: 8131,
                geo: {
                    lat: 54.501351,
                    lng: -167.47138,
                },
            },
            phone: '+1 (962) 466-3483',
            isActive: false,
            age: 26,
            soldRent: {
                value: 'rent',
                status: false,
            },
            company: 'ORBAXTER',
            status: 'success',
        },
        {
            id: 6,
            firstName: 'Buckley',
            lastName: 'Townsend',
            email: 'buckleytownsend@orbaxter.com',
            dob: '2011-05-29',
            address: {
                street: '131 Guernsey Street',
                city: 'Vallonia',
                zipcode: 6779,
                geo: {
                    lat: -2.681655,
                    lng: 3.528942,
                },
            },
            phone: '+1 (884) 595-2643',
            isActive: true,
            age: 40,
            soldRent: {
                value: 'rent',
                status: false,
            },
            company: 'OPPORTECH',
            status: 'pending',
        },
        {
            id: 7,
            firstName: 'Latoya',
            lastName: 'Bradshaw',
            email: 'latoyabradshaw@opportech.com',
            dob: '2010-11-23',
            address: {
                street: '668 Lenox Road',
                city: 'Lowgap',
                zipcode: 992,
                geo: {
                    lat: 36.026423,
                    lng: 130.412198,
                },
            },
            phone: '+1 (906) 474-3155',
            isActive: true,
            age: 24,
            soldRent: {
                value: 'sold',
                status: true,
            },
            company: 'GORGANIC',
            status: 'cancel',
        },
        {
            id: 8,
            firstName: 'Kate',
            lastName: 'Lindsay',
            email: 'katelindsay@gorganic.com',
            dob: '1987-07-02',
            address: {
                street: '773 Harrison Avenue',
                city: 'Carlton',
                zipcode: 5909,
                geo: {
                    lat: 42.464724,
                    lng: -12.948403,
                },
            },
            phone: '+1 (930) 546-2952',
            isActive: true,
            age: 24,
            soldRent: {
                value: 'rent',
                status: false,
            },
            company: 'AVIT',
            status: 'success',
        },
        {
            id: 9,
            firstName: 'Marva',
            lastName: 'Sandoval',
            email: 'marvasandoval@avit.com',
            dob: '2010-11-02',
            address: {
                street: '200 Malta Street',
                city: 'Tuskahoma',
                zipcode: 1292,
                geo: {
                    lat: -52.206169,
                    lng: 74.19452,
                },
            },
            phone: '+1 (927) 566-3600',
            isActive: false,
            age: 28,
            soldRent: {
                value: 'sold',
                status: true,
            },
            company: 'QUILCH',
            status: 'paid',
        },
        {
            id: 10,
            firstName: 'Decker',
            lastName: 'Russell',
            email: 'deckerrussell@quilch.com',
            dob: '1994-04-21',
            address: {
                street: '708 Bath Avenue',
                city: 'Coultervillle',
                zipcode: 1268,
                geo: {
                    lat: -41.550295,
                    lng: -146.598075,
                },
            },
            phone: '+1 (846) 535-3283',
            isActive: false,
            age: 27,
            soldRent: {
                value: 'rent',
                status: false,
            },
            company: 'MEMORA',
            status: 'approved',
        },
        {
            id: 11,
            firstName: 'Odom',
            lastName: 'Mills',
            email: 'odommills@memora.com',
            dob: '2010-01-24',
            address: {
                street: '907 Blake Avenue',
                city: 'Churchill',
                zipcode: 4400,
                geo: {
                    lat: -56.061694,
                    lng: -130.238523,
                },
            },
            phone: '+1 (995) 525-3402',
            isActive: true,
            age: 34,
            soldRent: {
                value: 'rent',
                status: true,
            },
            company: 'ZORROMOP',
            status: 'cancel',
        },
        {
            id: 12,
            firstName: 'Sellers',
            lastName: 'Walters',
            email: 'sellerswalters@zorromop.com',
            dob: '1975-11-12',
            address: {
                street: '978 Oakland Place',
                city: 'Gloucester',
                zipcode: 3802,
                geo: {
                    lat: 11.732587,
                    lng: 96.118099,
                },
            },
            phone: '+1 (830) 430-3157',
            isActive: true,
            age: 28,
            soldRent: {
                value: 'sold',
                status: true,
            },
            company: 'ORBOID',
            status: 'pending',
        },
        {
            id: 13,
            firstName: 'Wendi',
            lastName: 'Powers',
            email: 'wendipowers@orboid.com',
            dob: '1979-06-02',
            address: {
                street: '376 Greenpoint Avenue',
                city: 'Elliott',
                zipcode: 9149,
                geo: {
                    lat: -78.159578,
                    lng: -9.835103,
                },
            },
            phone: '+1 (863) 457-2088',
            isActive: true,
            age: 31,
            soldRent: {
                value: 'sold',
                status: true,
            },
            company: 'SNORUS',
            status: 'approved',
        },
        {
            id: 14,
            firstName: 'Sophie',
            lastName: 'Horn',
            email: 'sophiehorn@snorus.com',
            dob: '2018-09-20',
            address: {
                street: '343 Doughty Street',
                city: 'Homestead',
                zipcode: 330,
                geo: {
                    lat: 65.484087,
                    lng: 137.413998,
                },
            },
            phone: '+1 (885) 418-3948',
            isActive: true,
            age: 22,
            soldRent: {
                value: 'sold',
                status: false,
            },
            company: 'XTH',
            status: 'pending',
        },
        {
            id: 15,
            firstName: 'Levine',
            lastName: 'Rodriquez',
            email: 'levinerodriquez@xth.com',
            dob: '1973-02-08',
            address: {
                street: '643 Allen Avenue',
                city: 'Weedville',
                zipcode: 8931,
                geo: {
                    lat: -63.185586,
                    lng: 117.327808,
                },
            },
            phone: '+1 (999) 565-3239',
            isActive: true,
            age: 27,
            soldRent: {
                value: 'sold',
                status: true,
            },
            company: 'COMTRACT',
            status: 'cancel',
        },
        {
            id: 16,
            firstName: 'Little',
            lastName: 'Hatfield',
            email: 'littlehatfield@comtract.com',
            dob: '2012-01-03',
            address: {
                street: '194 Anthony Street',
                city: 'Williston',
                zipcode: 7456,
                geo: {
                    lat: 47.480837,
                    lng: 6.085909,
                },
            },
            phone: '+1 (812) 488-3011',
            isActive: false,
            age: 33,
            soldRent: {
                value: 'sold',
                status: false,
            },
            company: 'ZIDANT',
            status: 'success',
        },
        {
            id: 17,
            firstName: 'Larson',
            lastName: 'Kelly',
            email: 'larsonkelly@zidant.com',
            dob: '2010-06-14',
            address: {
                street: '978 Indiana Place',
                city: 'Innsbrook',
                zipcode: 639,
                geo: {
                    lat: -71.766732,
                    lng: 150.854345,
                },
            },
            phone: '+1 (892) 484-2162',
            isActive: true,
            age: 20,
            soldRent: {
                value: 'rent',
                status: false,
            },
            company: 'SUREPLEX',
            status: 'pending',
        },
        {
            id: 18,
            firstName: 'Kendra',
            lastName: 'Molina',
            email: 'kendramolina@sureplex.com',
            dob: '2002-07-19',
            address: {
                street: '567 Charles Place',
                city: 'Kimmell',
                zipcode: 1966,
                geo: {
                    lat: 50.765816,
                    lng: -117.106499,
                },
            },
            phone: '+1 (920) 528-3330',
            isActive: false,
            age: 31,
            soldRent: {
                value: 'sold',
                status: true,
            },
            company: 'DANJA',
            status: 'cancel',
        },
        {
            id: 19,
            firstName: 'Ebony',
            lastName: 'Livingston',
            email: 'ebonylivingston@danja.com',
            dob: '1994-10-18',
            address: {
                street: '284 Cass Place',
                city: 'Navarre',
                zipcode: 948,
                geo: {
                    lat: 65.271256,
                    lng: -83.064729,
                },
            },
            phone: '+1 (970) 591-3039',
            isActive: false,
            age: 33,
            soldRent: {
                value: 'rent',
                status: true,
            },
            company: 'EURON',
            status: 'success',
        },
        {
            id: 20,
            firstName: 'Kaufman',
            lastName: 'Rush',
            email: 'kaufmanrush@euron.com',
            dob: '2011-07-10',
            address: {
                street: '408 Kingsland Avenue',
                city: 'Beaulieu',
                zipcode: 7911,
                geo: {
                    lat: 41.513153,
                    lng: 54.821641,
                },
            },
            phone: '+1 (924) 463-2934',
            isActive: false,
            age: 39,
            soldRent: {
                value: 'sold',
                status: false,
            },
            company: 'ILLUMITY',
            status: 'pending',
        },
        {
            id: 21,
            firstName: 'Frank',
            lastName: 'Hays',
            email: 'frankhays@illumity.com',
            dob: '2005-06-15',
            address: {
                street: '973 Caton Place',
                city: 'Dargan',
                zipcode: 4104,
                geo: {
                    lat: 63.314988,
                    lng: -138.771323,
                },
            },
            phone: '+1 (930) 577-2670',
            isActive: false,
            age: 31,
            soldRent: {
                value: 'rent',
                status: false,
            },
            company: 'SYBIXTEX',
            status: 'cancel',
        },
        {
            id: 22,
            firstName: 'Carmella',
            lastName: 'Mccarty',
            email: 'carmellamccarty@sybixtex.com',
            dob: '1980-03-06',
            address: {
                street: '919 Judge Street',
                city: 'Canby',
                zipcode: 8283,
                geo: {
                    lat: 9.198597,
                    lng: -138.809971,
                },
            },
            phone: '+1 (876) 456-3218',
            isActive: true,
            age: 21,
            soldRent: {
                value: 'sold',
                status: true,
            },
            company: 'ZEDALIS',
            status: 'success',
        },
        {
            id: 23,
            firstName: 'Massey',
            lastName: 'Owen',
            email: 'masseyowen@zedalis.com',
            dob: '2012-03-01',
            address: {
                street: '108 Seaview Avenue',
                city: 'Slovan',
                zipcode: 3599,
                geo: {
                    lat: -74.648318,
                    lng: 99.620699,
                },
            },
            phone: '+1 (917) 567-3786',
            isActive: false,
            age: 40,
            soldRent: {
                value: 'sold',
                status: false,
            },
            company: 'DYNO',
            status: 'paid',
        },
        {
            id: 24,
            firstName: 'Lottie',
            lastName: 'Lowery',
            email: 'lottielowery@dyno.com',
            dob: '1982-10-10',
            address: {
                street: '557 Meserole Avenue',
                city: 'Fowlerville',
                zipcode: 4991,
                geo: {
                    lat: 54.811546,
                    lng: -20.996515,
                },
            },
            phone: '+1 (912) 539-3498',
            isActive: true,
            age: 36,
            soldRent: {
                value: 'rent',
                status: false,
            },
            company: 'MULTIFLEX',
            status: 'paid',
        },
        {
            id: 25,
            firstName: 'Addie',
            lastName: 'Luna',
            email: 'addieluna@multiflex.com',
            dob: '1988-05-01',
            address: {
                street: '688 Bulwer Place',
                city: 'Harmon',
                zipcode: 7664,
                geo: {
                    lat: -12.762766,
                    lng: -39.924497,
                },
            },
            phone: '+1 (962) 537-2981',
            isActive: true,
            age: 32,
            soldRent: {
                value: 'sold',
                status: true,
            },
            company: 'PHARMACON',
            status: 'pending',
        },
    ] || []
);

let filterRows = ref(rows.value);

const rangeChange = () => {
    let dt = rows.value;
    if (minAge.value != '' && minAge.value != null) {
        dt = dt.filter((d) => d.age >= Number(minAge.value));
    }
    if (maxAge.value != '' && maxAge.value != null) {
        dt = dt.filter((d) => d.age <= Number(maxAge.value));
    }
    filterRows.value = dt;
};

const filterChange = (status) => {
    if (status) {
        rangeChange();
    } else {
        filterRows.value = rows.value;
    }
};

const soldRentChange = (row, status) => {
    row.soldRent.status = status;
};

const formatDate = (date) => {
    const d = new Date(date);
    return `${d.getDate()}/${d.getMonth() + 1}/${d.getFullYear()}`;
};

const getRandomNumber = (min, max) => {
    return Math.floor(Math.random() * (max - min + 1)) + min;
};

const randomStatusColor = () => {
    const color = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
    const random = Math.floor(Math.random() * color.length);
    return color[random];
};

const randomStatus = () => {
    const status = ['PAID', 'APPROVED', 'FAILED', 'CANCEL', 'SUCCESS', 'PENDING', 'COMPLETE'];
    const random = Math.floor(Math.random() * status.length);
    return status[random];
};
</script>

<style>
/* alt-pagination */
.alt-pagination .bh-pagination .bh-page-item {
    @apply !w-max min-w-[32px] !rounded;
}

/* next-prev-pagination */
.next-prev-pagination .bh-pagination .bh-page-item {
    @apply !w-max min-w-[100px] !rounded;
}

.next-prev-pagination .bh-pagination>div:first-child {
    @apply flex-col font-semibold;
}

.next-prev-pagination .bh-pagination .bh-pagination-number {
    @apply mx-auto gap-3;
}</style>
