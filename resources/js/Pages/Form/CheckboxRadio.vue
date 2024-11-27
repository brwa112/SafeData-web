<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Forms</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Checkbox and Radio</span>
            </li>
        </ul>
        <div class="pt-5 space-y-8">
            <div class="space-y-8">
                <!-- Checkbox -->
                <h4 class="badge bg-primary inline-block hover:top-0 text-base mb-0">Checkbox</h4>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Default</h5>
                        </div>
                        <div class="mb-5">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox" checked />
                                        <span>Primary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-success" />
                                        <span>Success</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-secondary" />
                                        <span>Secondary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-danger" />
                                        <span>Danger</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-warning" />
                                        <span>Warning</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-info" />
                                        <span>Info</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-dark" />
                                        <span>Dark</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Default Rounded</h5>
                        </div>
                        <div class="mb-5">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox rounded-full" checked />
                                        <span>Primary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-success rounded-full" />
                                        <span>Success</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-secondary rounded-full" />
                                        <span>Secondary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-danger rounded-full" />
                                        <span>Danger</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-warning rounded-full" />
                                        <span>Warning</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-info rounded-full" />
                                        <span>Info</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox text-dark rounded-full" />
                                        <span>Dark</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Outline</h5>
                        </div>
                        <div class="mb-5">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-primary" checked />
                                        <span>Primary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-success" />
                                        <span>Success</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-secondary" />
                                        <span>Secondary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-danger" />
                                        <span>Danger</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-warning" />
                                        <span>Warning</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-info" />
                                        <span>Info</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-dark" />
                                        <span>Dark</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Outline Rounded</h5>
                        </div>
                        <div class="mb-5">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-primary rounded-full" checked />
                                        <span>Primary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-success rounded-full" />
                                        <span>Success</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-secondary rounded-full" />
                                        <span>Secondary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-danger rounded-full" />
                                        <span>Danger</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-warning rounded-full" />
                                        <span>Warning</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-info rounded-full" />
                                        <span>Info</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="checkbox" class="form-checkbox outline-dark rounded-full" />
                                        <span>Dark</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Default Text Color</h5>
                        </div>
                        <div class="mb-5">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox peer" checked />
                                            <span class="peer-checked:text-primary">Primary</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-success peer" />
                                            <span class="peer-checked:text-success">Success</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-secondary peer" />
                                            <span class="peer-checked:text-secondary">Secondary</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-danger peer" />
                                            <span class="peer-checked:text-danger">Danger</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-warning peer" />
                                            <span class="peer-checked:text-warning">Warning</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-info peer" />
                                            <span class="peer-checked:text-info">Info</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-dark peer" />
                                            <span class="peer-checked:text-dark">Dark</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox outline-primary peer" checked />
                                            <span class="peer-checked:text-primary">Primary</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox outline-success peer" />
                                            <span class="peer-checked:text-success">Success</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox outline-secondary peer" />
                                            <span class="peer-checked:text-secondary">Secondary</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox outline-danger peer" />
                                            <span class="peer-checked:text-danger">Danger</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox outline-warning peer" />
                                            <span class="peer-checked:text-warning">Warning</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox outline-info peer" />
                                            <span class="peer-checked:text-info">Info</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox outline-dark peer" />
                                            <span class="peer-checked:text-dark">Dark</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Rounded Text Color</h5>
                        </div>
                        <div class="mb-5">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox rounded-full peer" checked />
                                            <span class="peer-checked:text-primary">Primary</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-success rounded-full peer" />
                                            <span class="peer-checked:text-success">Success</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-secondary rounded-full peer" />
                                            <span class="peer-checked:text-secondary">Secondary</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-danger rounded-full peer" />
                                            <span class="peer-checked:text-danger">Danger</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-warning rounded-full peer" />
                                            <span class="peer-checked:text-warning">Warning</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-info rounded-full peer" />
                                            <span class="peer-checked:text-info">Info</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox text-dark rounded-full peer" />
                                            <span class="peer-checked:text-dark">Dark</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox outline-primary rounded-full peer"
                                                checked />
                                            <span class="peer-checked:text-primary">Primary</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox"
                                                class="form-checkbox outline-success rounded-full peer" />
                                            <span class="peer-checked:text-success">Success</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox"
                                                class="form-checkbox outline-secondary rounded-full peer" />
                                            <span class="peer-checked:text-secondary">Secondary</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox outline-danger rounded-full peer" />
                                            <span class="peer-checked:text-danger">Danger</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox"
                                                class="form-checkbox outline-warning rounded-full peer" />
                                            <span class="peer-checked:text-warning">Warning</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox outline-info rounded-full peer" />
                                            <span class="peer-checked:text-info">Info</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex">
                                            <input type="checkbox" class="form-checkbox outline-dark rounded-full peer" />
                                            <span class="peer-checked:text-dark">Dark</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-8">
                <!-- Radio -->
                <h4 class="badge bg-primary inline-block hover:top-0 text-base mb-0">Radio</h4>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Default</h5>
                        </div>
                        <div class="mb-5">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_radio" class="form-radio" checked />
                                        <span>Primary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_radio" class="form-radio text-success" />
                                        <span>Success</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_radio" class="form-radio text-secondary" />
                                        <span>Secondary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_radio" class="form-radio text-danger" />
                                        <span>Danger</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_radio" class="form-radio text-warning" />
                                        <span>Warning</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_radio" class="form-radio text-info" />
                                        <span>Info</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_radio" class="form-radio text-dark" />
                                        <span>Dark</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Square</h5>
                        </div>
                        <div class="mb-5">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_radio" class="form-radio rounded-none" checked />
                                        <span>Primary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_radio"
                                            class="form-radio text-success rounded-none" />
                                        <span>Success</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_radio"
                                            class="form-radio text-secondary rounded-none" />
                                        <span>Secondary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_radio"
                                            class="form-radio text-danger rounded-none" />
                                        <span>Danger</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_radio"
                                            class="form-radio text-warning rounded-none" />
                                        <span>Warning</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_radio" class="form-radio text-info rounded-none" />
                                        <span>Info</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_radio" class="form-radio text-dark rounded-none" />
                                        <span>Dark</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Outline</h5>
                        </div>
                        <div class="mb-5">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="outline_radio" class="form-radio outline-primary"
                                            checked />
                                        <span>Primary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="outline_radio" class="form-radio outline-success" />
                                        <span>Success</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="outline_radio" class="form-radio outline-secondary" />
                                        <span>Secondary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="outline_radio" class="form-radio outline-danger" />
                                        <span>Danger</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="outline_radio" class="form-radio outline-warning" />
                                        <span>Warning</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="outline_radio" class="form-radio outline-info" />
                                        <span>Info</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="outline_radio" class="form-radio outline-dark" />
                                        <span>Dark</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Default Text Color</h5>
                        </div>
                        <div class="mb-5">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_text_color" class="form-radio peer" checked />
                                        <span class="peer-checked:text-primary">Primary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_text_color"
                                            class="form-radio text-success peer" />
                                        <span class="peer-checked:text-success">Success</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_text_color"
                                            class="form-radio text-secondary peer" />
                                        <span class="peer-checked:text-secondary">Secondary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_text_color" class="form-radio text-danger peer" />
                                        <span class="peer-checked:text-danger">Danger</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_text_color"
                                            class="form-radio text-warning peer" />
                                        <span class="peer-checked:text-warning">Warning</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_text_color" class="form-radio text-info peer" />
                                        <span class="peer-checked:text-info">Info</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="default_text_color" class="form-radio text-dark peer" />
                                        <span class="peer-checked:text-dark">Dark</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Square Text Color</h5>
                        </div>
                        <div class="mb-5">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_text_radio" class="form-radio rounded-none peer"
                                            checked />
                                        <span class="peer-checked:text-primary">Primary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_text_radio"
                                            class="form-radio text-success rounded-none peer" />
                                        <span class="peer-checked:text-success">Success</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_text_radio"
                                            class="form-radio text-secondary rounded-none peer" />
                                        <span class="peer-checked:text-secondary">Secondary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_text_radio"
                                            class="form-radio text-danger rounded-none peer" />
                                        <span class="peer-checked:text-danger">Danger</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_text_radio"
                                            class="form-radio text-warning rounded-none peer" />
                                        <span class="peer-checked:text-warning">Warning</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_text_radio"
                                            class="form-radio text-info rounded-none peer" />
                                        <span class="peer-checked:text-info">Info</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="square_text_radio"
                                            class="form-radio text-dark rounded-none peer" />
                                        <span class="peer-checked:text-dark">Dark</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="flex items-center justify-between mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Outline Text Color</h5>
                        </div>
                        <div class="mb-5">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="classic_text_radio"
                                            class="form-radio outline-primary peer" checked />
                                        <span class="peer-checked:text-primary">Primary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="classic_text_radio"
                                            class="form-radio outline-success peer" />
                                        <span class="peer-checked:text-success">Success</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="classic_text_radio"
                                            class="form-radio outline-secondary peer" />
                                        <span class="peer-checked:text-secondary">Secondary</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="classic_text_radio"
                                            class="form-radio outline-danger peer" />
                                        <span class="peer-checked:text-danger">Danger</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="classic_text_radio"
                                            class="form-radio outline-warning peer" />
                                        <span class="peer-checked:text-warning">Warning</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="classic_text_radio"
                                            class="form-radio outline-info peer" />
                                        <span class="peer-checked:text-info">Info</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex">
                                        <input type="radio" name="classic_text_radio"
                                            class="form-radio outline-dark peer" />
                                        <span class="peer-checked:text-dark">Dark</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>
