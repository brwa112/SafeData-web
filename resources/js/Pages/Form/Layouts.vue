<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Forms</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Layouts</span>
            </li>
        </ul>
        <div class="pt-5 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Stack -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Stack Forms</h5>
                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div>
                            <input type="email" placeholder="Enter Email" class="form-input" />
                            <span class="text-white-dark text-[11px] inline-block mt-1">We'll never share your email with anyone else.</span>
                        </div>
                        <div>
                            <input type="password" placeholder="Enter Password" class="form-input" />
                        </div>
                        <div>
                            <label class="inline-flex items-center mt-1 cursor-pointer">
                                <input type="checkbox" class="form-checkbox" />
                                <span class="text-white-dark">Subscribe to weekly newsletter</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                    </form>
                </div>
            </div>
            <!-- Horizontal -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Horizontal form</h5>
                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div class="flex sm:flex-row flex-col">
                            <label for="horizontalEmail" class="mb-0 sm:w-1/4 sm:ltr:mr-2 rtl:ml-2">Email</label>
                            <input id="horizontalEmail" type="email" placeholder="Enter Email" class="form-input flex-1" />
                        </div>
                        <div class="flex sm:flex-row flex-col">
                            <label for="horizontalPassword" class="mb-0 sm:w-1/4 sm:ltr:mr-2 rtl:ml-2">Password</label>
                            <input id="horizontalPassword" type="password" placeholder="Enter Password" class="form-input flex-1" />
                        </div>
                        <div class="flex sm:flex-row flex-col">
                            <label class="sm:w-1/4 sm:ltr:mr-2 rtl:ml-2">Choose Segements</label>
                            <div class="flex-1">
                                <div class="mb-2">
                                    <label class="inline-flex mt-1 cursor-pointer">
                                        <input type="radio" name="segements" class="form-radio" />
                                        <span class="text-white-dark">Segements 1</span>
                                    </label>
                                </div>
                                <div class="mb-2">
                                    <label class="inline-flex mt-1 cursor-pointer">
                                        <input type="radio" name="segements" class="form-radio" />
                                        <span class="text-white-dark">Segements 2</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex mt-1">
                                        <input type="radio" name="segements" class="form-radio" disabled />
                                        <span class="text-white-dark">Segements 3 ( disabled )</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex sm:flex-row flex-col">
                            <label class="font-semibold sm:w-1/4 sm:ltr:mr-2 rtl:ml-2">Apply</label>
                            <label class="inline-flex mb-0 cursor-pointer">
                                <input type="checkbox" class="form-checkbox" />
                                <span class="text-white-dark">Terms Conditions</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                    </form>
                </div>
            </div>
            <!-- Registration -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Registration Forms</h5>
                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div>
                            <input type="email" placeholder="Enter Email Address *" class="form-input" />
                        </div>
                        <div>
                            <input type="password" placeholder="Enter Password *" class="form-input" />
                        </div>
                        <div>
                            <input type="password" placeholder="Enter Confirm Password *" class="form-input" />
                        </div>
                        <div class="!mt-2">
                            <span class="text-white-dark text-[11px] inline-block">*Required Fields</span>
                        </div>
                        <div>
                            <label class="inline-flex cursor-pointer">
                                <input type="checkbox" class="form-checkbox" />
                                <span class="text-white-dark">Subscribe to weekly newsletter</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                    </form>
                </div>
            </div>
            <!-- Login -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Login Forms</h5>
                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div>
                            <input type="text" placeholder="Enter Full Name *" class="form-input" />
                        </div>
                        <div>
                            <input type="email" placeholder="Enter Email Address *" class="form-input" />
                        </div>
                        <div>
                            <input type="password" placeholder="Enter Password *" class="form-input" />
                        </div>
                        <div class="!mt-2">
                            <span class="text-white-dark text-[11px] inline-block">*Required Fields</span>
                        </div>
                        <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                    </form>
                </div>
            </div>
            <!-- Grid -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Forms Grid</h5>
                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="gridEmail">Email</label>
                                <input id="gridEmail" type="email" placeholder="Enter Email" class="form-input" />
                            </div>
                            <div>
                                <label for="gridPassword">Password</label>
                                <input id="gridPassword" type="Password" placeholder="Enter Password" class="form-input" />
                            </div>
                        </div>
                        <div>
                            <label for="gridAddress1">Address</label>
                            <input id="gridAddress1" type="text" placeholder="Enter Address" value="1234 Main St" class="form-input" />
                        </div>
                        <div>
                            <label for="gridAddress2">Address2</label>
                            <input id="gridAddress2" type="text" placeholder="Enter Address2" value="Apartment, studio, or floor" class="form-input" />
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <div class="md:col-span-2">
                                <label for="gridCity">City</label>
                                <input id="gridCity" type="text" placeholder="Enter City" class="form-input" />
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
                                <input id="gridZip" type="text" placeholder="Enter Zip" class="form-input" />
                            </div>
                        </div>
                        <div>
                            <label class="flex items-center mt-1 cursor-pointer">
                                <input type="checkbox" class="form-checkbox" />
                                <span class="text-white-dark">Check me out</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                    </form>
                </div>
            </div>
            <!-- Inline -->
            <div class="panel lg:col-span-2">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Inline Forms</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div class="flex flex-col md:flex-row gap-4 items-center max-w-[900px] mx-auto">
                            <input type="email" placeholder="Jane Doe" class="form-input flex-1" />
                            <div class="flex flex-1">
                                <div
                                    class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]"
                                >
                                    @
                                </div>
                                <input type="text" placeholder="Username" class="form-input ltr:rounded-l-none rtl:rounded-r-none" />
                            </div>
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" class="form-checkbox" />
                                    <span class="text-white-dark">Remember me</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary py-2.5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Auto-sizing -->
            <div class="panel lg:col-span-2">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Auto-sizing</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div class="flex flex-col md:flex-row gap-4 items-center max-w-[900px] mx-auto">
                            <input type="email" placeholder="Jane Doe" class="form-input flex-1" />
                            <div class="flex flex-1">
                                <div
                                    class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]"
                                >
                                    @
                                </div>
                                <input type="text" placeholder="Username" class="form-input ltr:rounded-l-none rtl:rounded-r-none" />
                            </div>
                            <div>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="form-checkbox" />
                                    <span class="text-white-dark">Remember me</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary py-2.5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Actions Buttons -->
            <div class="panel lg:row-start-3 lg:col-start-2">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Actions Buttons</h5>
                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div>
                            <label for="actionName">Full Name:</label>
                            <input id="actionName" type="text" placeholder="Enter Full Name" class="form-input" />
                        </div>
                        <div>
                            <label for="actionEmail">Email:</label>
                            <div class="flex flex-1">
                                <div
                                    class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]"
                                >
                                    @
                                </div>
                                <input id="actionEmail" type="email" placeholder="" class="form-input ltr:rounded-l-none rtl:rounded-r-none" />
                            </div>
                        </div>
                        <div>
                            <label for="actionWeb">Website:</label>
                            <input id="actionWeb" type="text" placeholder="https://" class="form-input" />
                        </div>
                        <div>
                            <label for="actionPassword">Password:</label>
                            <input id="actionPassword" type="password" placeholder="Enter Password" class="form-input" />
                        </div>
                        <div>
                            <label for="actionCpass">Confirm Password:</label>
                            <input id="actionCpass" type="password" placeholder="Enter Confirm Password" class="form-input" />
                        </div>
                        <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>
