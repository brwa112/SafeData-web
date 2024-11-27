<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Forms</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Basic</span>
            </li>
        </ul>
        <div class="pt-5 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Basic -->
            <!-- type=text -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input Text</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <input type="text" placeholder="Some Text..." class="form-input" required />
                        <button type="submit" class="btn btn-primary mt-6">Submit</button>
                    </form>
                </div>
            </div>

            <!-- type=password -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input Password</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <input type="password" placeholder="Enter Password" class="form-input" required />
                        <button type="submit" class="btn btn-primary mt-6">Submit</button>
                    </form>
                </div>
            </div>

            <!-- type=email -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input Email</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <input type="email" placeholder="email@mail.com" class="form-input" required />
                        <button type="submit" class="btn btn-primary mt-6">Submit</button>
                    </form>
                </div>
            </div>

            <!-- type=url -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input Url</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <input type="url" placeholder="https://dummyurl.com" class="form-input" required />
                        <button type="submit" class="btn btn-primary mt-6">Submit</button>
                    </form>
                </div>
            </div>

            <!-- type=tel -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input Telephone</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <input type="tel" placeholder="6-(666)-111-7777" class="form-input" required />
                        <button type="submit" class="btn btn-primary mt-6">Submit</button>
                    </form>
                </div>
            </div>

            <!-- type=search -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input Search</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <input type="search" placeholder="Search..." class="form-input" required />
                        <button type="button" class="btn btn-primary mt-6">Submit</button>
                    </form>
                </div>
            </div>

            <!-- type=range -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input Range</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <input type="range" class="w-full py-2.5" min="0" max="100" />
                    </form>
                </div>
            </div>

            <!-- input with label -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input With Label</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <label for="fullname">Full Name</label>
                        <input id="fullname" type="text" placeholder="Enter Full Name" value="Alan Green"
                            class="form-input" />
                    </form>
                </div>
            </div>

            <!-- form controls -->
            <div class="panel lg:row-span-3">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Form controls</h5>
                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div>
                            <label for="ctnEmail">Email address</label>
                            <input id="ctnEmail" type="email" placeholder="name@example.com" class="form-input" required />
                        </div>
                        <div>
                            <label for="ctnSelect1">Example select</label>
                            <select id="ctnSelect1" class="form-select text-white-dark" required>
                                <option>Open this select menu</option>
                                <option>One</option>
                                <option>Two</option>
                                <option>Three</option>
                            </select>
                        </div>
                        <div>
                            <label for="ctnSelect2">Example multiple select</label>
                            <select id="ctnSelect2" multiple class="form-multiselect text-white-dark" required>
                                <option>Open this select menu</option>
                                <option>One</option>
                                <option>Two</option>
                                <option>Three</option>
                            </select>
                        </div>
                        <div>
                            <label for="ctnTextarea">Example textarea</label>
                            <textarea id="ctnTextarea" rows="3" class="form-textarea" placeholder="Enter Address"
                                required></textarea>
                        </div>
                        <div>
                            <label for="ctnFile">Example file input</label>
                            <input id="ctnFile" type="file"
                                class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file-ml-5 file:text-white file:hover:bg-primary"
                                required />
                        </div>
                        <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Form Grid Layouts -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Form grid</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div class="grid grid-cols-1 sm:flex justify-between gap-5">
                            <input type="text" placeholder="Enter First Name" class="form-input" />
                            <input type="text" placeholder="Enter Last Name" class="form-input" />
                        </div>
                        <button type="button" class="btn btn-primary mt-6">Submit</button>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Form row</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div class="grid grid-cols-1 sm:flex justify-between gap-5">
                            <input type="text" placeholder="Enter First Name" class="form-input" />
                            <input type="text" placeholder="Enter Last Name" class="form-input" />
                        </div>
                        <button type="button" class="btn btn-primary mt-6">Submit</button>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Form groups</h5>
                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div>
                            <label for="groupFname">First Name</label>
                            <input id="groupFname" type="text" placeholder="Enter First Name" class="form-input" />
                        </div>
                        <div>
                            <label for="groupLname">Last Name</label>
                            <input id="groupLname" type="text" placeholder="Enter Last Name" class="form-input" />
                        </div>
                        <button type="button" class="btn btn-primary !mt-6">Submit</button>
                    </form>
                </div>
            </div>
            <div class="panel lg:col-span-2">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Column sizing</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-2">
                            <input type="text" placeholder="Enter City" class="form-input lg:col-span-2" />
                            <input type="text" placeholder="Enter State" class="form-input" />
                            <input type="text" placeholder="Enter Zip" class="form-input" />
                        </div>
                        <button type="button" class="btn btn-primary mt-6">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Helper Text -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input with help text ( Default Left)</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div>
                            <input type="text" placeholder="Enter First Name" class="form-input" />
                            <span class="text-white-dark text-xs">I am the helper text.</span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input with badge help text (Default Left)</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div>
                            <input type="text" placeholder="Enter First Name" class="form-input mb-2" />
                            <span class="badge bg-primary text-xs hover:top-0">I am the helper text.</span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input with block badge help text (Default Left)
                    </h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div>
                            <input type="text" placeholder="Enter First Name" class="form-input mb-2" />
                            <span class="badge bg-primary block text-xs hover:top-0">I am the helper text.</span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Inline Help text</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div>
                            <label for="Txtpassword">Password</label>
                            <input id="Txtpassword" type="password" placeholder="Enter Password" class="form-input w-3/5" />
                            <span class="text-xs text-white-dark ltr:pl-2 rtl:pr-2">Min 8-20 char</span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sizing -->
            <div class="panel lg:col-span-2">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input Fields</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="inputLarge">Large Input</label>
                                <input id="inputLarge" type="text" placeholder="Large Input"
                                    class="form-input form-input-lg" />
                            </div>
                            <div>
                                <label for="inputDefault">Default Input</label>
                                <input id="inputDefault" type="text" placeholder="Default Input" class="form-input" />
                            </div>
                            <div>
                                <label for="inputSmall">Small Input</label>
                                <input id="inputSmall" type="text" placeholder="Small Input"
                                    class="form-input form-input-sm" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel lg:col-span-2">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Select Field</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <select class="form-select form-select-lg text-white-dark">
                                    <option>Open this select menu</option>
                                    <option>One</option>
                                    <option>Two</option>
                                    <option>Three</option>
                                </select>
                            </div>
                            <div>
                                <select class="form-select text-white-dark">
                                    <option>Open this select menu</option>
                                    <option>One</option>
                                    <option>Two</option>
                                    <option>Three</option>
                                </select>
                            </div>
                            <div>
                                <select class="form-select form-select-sm text-white-dark">
                                    <option>Open this select menu</option>
                                    <option>One</option>
                                    <option>Two</option>
                                    <option>Three</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Horizontal form label sizing</h5>
                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                            <label for="hrLargeinput">Email</label>
                            <input id="hrLargeinput" type="email" placeholder="name@example.com"
                                class="form-input py-2.5 text-base" />
                        </div>
                        <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                            <label for="hrDefaultinput">Email</label>
                            <input id="hrDefaultinput" type="email" placeholder="name@example.com" class="form-input" />
                        </div>
                        <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                            <label for="hrSmallinput">Email</label>
                            <input id="hrSmallinput" type="email" placeholder="name@example.com"
                                class="form-input py-1.5 text-xs" />
                        </div>
                    </form>
                </div>
            </div>
            <!-- Readonly -->
            <div class="panel lg:row-start-[14]">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Input Readonly</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div>
                            <input type="text" placeholder="Readonly input here…"
                                class="form-input disabled:pointer-events-none" readonly />
                        </div>
                    </form>
                </div>
            </div>
            <!-- Disabled -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Disabled Fields</h5>

                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div>
                            <label for="disInput" class="text-white-dark">Disabled input</label>
                            <input id="disInput" type="text" placeholder="Readonly input here…"
                                class="form-input disabled:pointer-events-none disabled:bg-[#eee] dark:disabled:bg-[#1b2e4b] cursor-not-allowed"
                                disabled />
                        </div>
                        <div>
                            <label for="disSelect" class="text-white-dark">Disabled select menu</label>
                            <select id="disSelect"
                                class="form-select disabled:pointer-events-none disabled:bg-[#eee] dark:disabled:bg-[#1b2e4b] text-white-dark"
                                disabled>
                                <option>Open this select menu</option>
                                <option>One</option>
                                <option>Two</option>
                                <option>Three</option>
                            </select>
                        </div>
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox" disabled />
                                <span class="text-white-dark">Can't check this</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary !mt-6 disabled:pointer-events-none disabled:opacity-60"
                            disabled>Submit</button>
                    </form>
                </div>
            </div>
            <!-- Custom -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Checkboxes</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div>
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" class="form-checkbox" checked />
                                <span class="text-white-dark">Checkbox</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Radio</h5>
                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="custom_radio2" class="form-radio" checked />
                                <span class="text-white-dark">Toggle this custom radio</span>
                            </label>
                        </div>
                        <div>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="custom_radio2" class="form-radio" />
                                <span class="text-white-dark">Or toggle this other custom radio</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Disabled</h5>
                </div>
                <div class="mb-5">
                    <form class="space-y-5">
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox" disabled />
                                <span class="text-white-dark">Check this custom checkbox</span>
                            </label>
                        </div>
                        <div>
                            <label class="flex items-center">
                                <input type="radio" class="form-radio" disabled />
                                <span class="text-white-dark">Toggle this custom radio</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Select menu</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div>
                            <select class="form-select text-white-dark">
                                <option>Open this select menu</option>
                                <option>One</option>
                                <option>Two</option>
                                <option>Three</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Multiselect</h5>
                </div>
                <div class="mb-5">
                    <form>
                        <div>
                            <select size="4" multiple class="form-multiselect text-white-dark !bg-none">
                                <option>Open this select menu</option>
                                <option>One</option>
                                <option>Two</option>
                                <option>Three</option>
                                <option>Four</option>
                                <option>Five</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>
