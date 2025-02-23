<template>
    <div class="mx-auto">

        <Head>
            <title>{{ $t('common.logo') }} - {{ $t(form.id ? 'system.edit_user' : 'system.new_user') }}</title>
        </Head>

        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li class="text-gray-500">
                <span>{{ $t('system.system') }}</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('control.system.users.index')" class="duration-200 hover:text-primary">
                {{ $t('system.users') }}
                </Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span v-if="form.id">{{ $t('system.edit_user') }}</span>
                <span v-else>{{ $t('system.new_user') }}</span>
            </li>
        </ul>

        <form @submit.prevent="save" v-shortkey="['ctrl', 's']" @shortkey="save" autocomplete="off" class="space-y-2">
            <div class="pt-5 flex flex-col lg:flex-row gap-5">
                <div class="w-full lg:w-4/12">
                    <div class="panel">
                        <!-- Image -->
                        <div class="custom-file-container w-auto" data-upload-id="image">

                            <!-- Image -->
                            <div class="flex flex-col justify-center items-center gap-px xl:gap-1.5">
                                <!-- Avatar -->
                                <div class="custom-file-container w-auto" data-upload-id="avatar">
                                    <div :class="{ 'border border-red-300 rounded-md': form.errors.avatar }"
                                        class="dropdown">
                                        <Popper :placement="rtlClass === 'rtl' ? 'bottom-end' : 'bottom-start'"
                                            offsetDistance="0" class="relative align-middle">
                                            <button type="button"
                                                class="group btn outline-none border-none hover:underline shadow-none btn-sm text-sm text-primary font-bold dropdown-toggle flex items-center gap-0.5">
                                                <div class="relative size-24 xl:size-32">
                                                    <div
                                                        class="custom-file-container__image-preview !size-24 xl:!size-32 !rounded-full !object-fit !mb-5 !mt-0 !overflow-hidden">
                                                    </div>
                                                    <div
                                                        class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full duration-500 opacity-0 group-hover:opacity-100">
                                                        <Svg name="edit_image"
                                                            class="size-7 xl:size-9 text-white"></Svg>
                                                    </div>
                                                </div>
                                            </button>
                                            <template #content="{ close }">
                                                <ul @click="close()"
                                                    class="whitespace-nowrap border border-gray-100 dark:border-gray-700 !-mt-5 !py-1">
                                                    <li>
                                                        <button type="button" @click="uploadImage">
                                                            {{ $t('common.upload_image') }}
                                                            <label class="hidden">
                                                                <button type="button"
                                                                    class="relative w-full custom-file-container__custom-file__custom-file-input !cursor-pointer !opacity-100 text-start px-4 !py-2 font-normal text-sm text-gray-600 hover:text-primary hover:bg-primary/10">
                                                                    <span class="relative z-10">{{
                                                                        $t('common.upload_image') }}</span>
                                                                    <input @input="form.avatar = $event.target.files[0]"
                                                                        ref="imageProfile" type="file" title=""
                                                                        class="absolute !inset-0 z-0 w-full !cursor-pointer opacity-0"
                                                                        accept="image/*" />
                                                                    <input type="hidden" name="MAX_FILE_SIZE"
                                                                        value="10485760" />
                                                                </button>
                                                                <span
                                                                    class="custom-file-container__custom-file__custom-file-control hidden"></span>
                                                            </label>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <!-- <button @click.prevent="form.avatar = ''" type="button" -->
                                                        <button @click="removeImage()" type="button"
                                                            class="custom-file-container__image-clear">
                                                            {{ $t('common.remove_image') }}
                                                        </button>
                                                    </li>
                                                </ul>
                                            </template>
                                        </Popper>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-1 text-danger text-center" v-if="form.errors.avatar"
                                v-html="form.errors.avatar">
                            </div>
                        </div>

                        <div class="col-span-full mx-auto w-2/3 border-b border-gray-100 dark:border-[#191e3a] my-3">
                        </div>

                        <!-- Information -->
                        <div class="mb-5">
                            <div class="grid grid-cols-1 gap-5">

                                <!-- Name -->
                                <div>
                                    <label for="name" class="required">{{ $t('system.name') }}</label>
                                    <input v-model="form.name" id="name" type="text"
                                        :placeholder="$t('common.enter') + ' ' + $t('system.name')" class="form-input"
                                        :class="{ 'border border-red-300 rounded-md': form.errors.name }" />
                                    <div class="mt-1 text-danger" v-if="form.errors.name" v-html="form.errors.name">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="required">{{ $t('system.email') }}</label>
                                    <VInput type="email" v-model="form.email"
                                        :class="{ 'border border-red-300 rounded-md': form.errors.email }">
                                        <template #before>
                                            @
                                        </template>
                                    </VInput>

                                    <div class="mt-1 text-danger" v-if="form.errors.email" v-html="form.errors.email">
                                    </div>
                                </div>

                                <!-- Phone One -->
                                <div class="col-span-full">
                                    <label for="phone" class="required">
                                        {{ $t('system.phone') }}
                                    </label>
                                    <PhoneSelect v-model="form.phone"
                                        :class="{ 'border border-red-300 rounded-md': form.errors.phone }" />
                                    <div class="mt-1 text-danger" v-if="form.errors.phone" v-html="form.errors.phone">
                                    </div>
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password" :class="{ 'required': !form?.id }">
                                        {{ $t('system.password') }}
                                    </label>

                                    <VInput :type="form.show_password ? 'text' : 'password'" v-model="form.password"
                                        :placeholder="$t('system.password')"
                                        :class="{ 'border border-red-300 rounded-md': form.errors.password }">
                                        <template #after>
                                            <Svg @click="form.show_password = !form.show_password"
                                                v-if="!form.show_password" name="eye"
                                                class="cursor-pointer size-5"></Svg>
                                            <Svg @click="form.show_password = !form.show_password" v-else
                                                name="eye_line" class="cursor-pointer size-5"></Svg>
                                        </template>
                                    </VInput>

                                    <div class="mt-1 text-danger" v-if="form.errors.password"
                                        v-html="form.errors.password"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-8/12 flex flex-col gap-5">
                    <!-- Access -->
                    <div class="panel">
                        <div class="mb-3">
                            <h5 class="font-semibold text-lg dark:text-white-light">
                                {{ $t('common.access') }}
                            </h5>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                            <div class="col-span-full flex items-end mx-1">
                                <div class="w-full flex items-center justify-between mb-1">
                                    <div class="flex items-center gap-2">
                                        <label for="user_activity">
                                            {{ $t('system.user_activity') }}
                                        </label>
                                        <label class="w-12 h-6 relative">
                                            <input type="checkbox" id="is_active" v-model="form.is_active"
                                                class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" />
                                            <span for="is_active"
                                                class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Roles -->
                    <div class="panel">
                        <div class="mb-3">
                            <h5 class="font-semibold text-lg dark:text-white-light">
                                {{ $t('system.roles') }}
                            </h5>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                            <div class="col-span-full xl:col-span-1">
                                <div class="flex flex-col gap-2 divide-y divide-gray-100 dark:divide-[#191e3a]">

                                    <div v-for="(role, i) in roles" :key="i"
                                        class="flex flex-col gap-2 -my-1 py-1.5 pt-2">
                                        <div class="flex items-center gap-2">
                                            <label :for="`role_${role.id}`"
                                                class="flex items-center justify-between gap-1 cursor-pointer">
                                                <span class="flex flex-col">
                                                    <span class="capitalize">{{ role.name }}</span>
                                                </span>
                                            </label>
                                            <label class="w-12 h-6 relative">
                                                <input @change="toggleRole($event.target.checked, role, roles)"
                                                    :checked="form.roles?.filter(x => x.name == role.name)?.length"
                                                    type="checkbox"
                                                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                                    :id="`role_${role.id}`" />
                                                <label :for="`role_${role.id}`"
                                                    class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></label>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Permissions -->
                    <div class="panel">
                        <div class="mb-3">
                            <h5 class="font-semibold text-lg dark:text-white-light">
                                {{ $t('system.permissions') }}
                            </h5>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                            <div class="flex flex-col gap-2 col-span-full xl:col-span-1">
                                <div v-if="all_permission_toggle" class="flex flex-wrap gap-y-1 gap-x-5 lg:gap-x-8">
                                    <label
                                        v-for="permission in (new Set(Object.values(permission_groups).flat().map(x => x.name.split('_').shift())))"
                                        :key="permission" class="inline-flex">
                                        <input @change="toggleAllSpecificPermission($event.target.checked, permission)"
                                            type="checkbox" class="form-checkbox size-4.5" />
                                        <span class="text-xs cursor-pointer">
                                            {{ $t('common.' + permission) }}
                                        </span>
                                    </label>
                                </div>

                                <div class="flex flex-col gap-2 divide-y divide-gray-100 dark:divide-[#191e3a]">
                                    <div v-for="(permissions, group) in permission_groups" :key="group"
                                        class="flex flex-col gap-1 pt-2">
                                        <label @click.prevent="toggleGroupPermissions(permissions)"
                                            class="max-w-max cursor-pointer capitalize">
                                            {{ group }}
                                        </label>
                                        <div class="flex flex-wrap gap-y-1 gap-x-5 lg:gap-x-8">
                                            <label v-for="(permission, i) in permissions" :key="i" class="inline-flex">
                                                <input
                                                    @change="togglePermission($event.target.checked, permission, permissions)"
                                                    :checked="form.permissions?.filter(x => x.name == permission.name)?.length"
                                                    type="checkbox" class="form-checkbox size-4.5" />
                                                <span class="text-xs cursor-pointer">
                                                    {{ $t('common.' + (permission?.name || '')
                                                        .replace('_' + group, '')) || (permission?.name || '')
                                                            .replace('_' + group, '') }}
                                                </span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full flex justify-end">
                <div class="mb-1 text-danger" v-if="form.errors.permissions" v-html="form.errors.permissions"></div>
            </div>
            <div class="w-full flex justify-end">
                <button :disabled="form.processing" class="btn btn-primary">
                    <Spinner v-if="form.processing" />
                    {{ $t('system.save_changes') }}
                </button>
            </div>
        </form>
    </div>
</template>
<script setup>
import { inject, onMounted, ref, computed } from 'vue';
import FileUploadWithPreview from 'file-upload-with-preview';
import 'file-upload-with-preview/dist/file-upload-with-preview.min.css';
import { useVuelidate } from '@vuelidate/core';
import { required, email } from '@vuelidate/validators';
import Svg from '@/Components/Svg.vue';
import Swal from 'sweetalert2';
import PhoneSelect from '@/Components/Inputs/PhoneSelect.vue';
import MultiSelect from '@/Components/Inputs/MultiSelect.vue';
import ValidateInput from '@/Components/Inputs/ValidateInput.vue';
import { useForm, usePage, Link, Head } from '@inertiajs/vue3';
import InputWithCurrency from '@/Components/Inputs/InputWithCurrency.vue';
import VInput from '@/Components/Inputs/VInput.vue';
import Spinner from '@/Components/Spinner.vue';
import $helpers from '@/helpers';
import { trans } from 'laravel-vue-i18n';

const rtlClass = inject('rtlClass');

const props = defineProps({
    user: Object,
    roles: Array,
    permission_groups: {},
    permission_group_names: {},
});

console.log(props.roles);
const avatar = ref(props.user?.avatar);

const inetilizeAvatar = () => {
    new FileUploadWithPreview('avatar', {
        images: {
            baseImage: avatar.value || '/assets/images/avatar.png',
        },
    });
}

onMounted(() => {
    inetilizeAvatar();
});

const imageProfile = ref(null);
const uploadImage = () => {
    imageProfile.value.click();
};

let form = useForm({
    id: props.user?.id || null,
    name: props.user?.name || '',
    avatar: null,
    email: props.user?.email || '',
    phone: props.user?.phone || '',
    password: '',
    permissions: props.user?.permissions || [],
    roles: props.user?.roles || [],
    is_active: props.user?.is_active == 1 ? true : false,
    remove_avatar: false,
});


const save = () => {

    if (!form?.id) {
        form.post(route('control.system.users.store'), {
            formData: true,
            // preserveScroll: true,
            onSuccess: () => {
                // $helpers.toast('Created.');
                $helpers.toast(trans('common.record') + ' ' + trans('common.created'));
            },
        });
        return;
    }

    form
        .transform((data) => {
            data._method = 'PUT';
            return data;
        })
        .post(route('control.system.users.update', form.id), {
            formData: true,
            // preserveScroll: true,
            onSuccess: () => {
                // $helpers.toast('Updated.');
                $helpers.toast(trans('common.record') + ' ' + trans('common.updated'));
            },
        });
};

const removeImage = () => {
    form.avatar = '';
    form.remove_avatar = true;
    avatar.value = '';
    imageProfile.value = null;
    inetilizeAvatar();
    console.log('removeImage');
};


const all_permission_toggle = ref(false);

const toggleAllSpecificPermission = (checked, permission) => {

    let permissions = props.permission_groups;

    Object.keys(permissions).forEach(group => {
        toggleGroupPermissions(permissions[group], permission, !checked);
    });

}

const toggleGroupPermissions = (permissions, _permission = null, _checked = null) => {

    let checked = _checked || form.permissions.find(x => x.name == permissions[0].name);

    permissions.forEach(permission => {
        if (_permission) {
            if (_permission === permission.name.split('_').shift()) {
                permission = togglePermission(checked ? false : true, permission);
            }
            return;
        }

        permission = togglePermission(checked ? false : true, permission);

    });

}

// const toggleGroupPermissions = (permissions) => {

//     let checked = form.permissions.find(x => x.name == permissions[0].name);

//     permissions.forEach(permission => {
//         permission = togglePermission(checked ? false : true, permission);
//     });

// }

const togglePermission = (checked, permission, permissions = []) => {
    if (checked) {

        form.permissions = form.permissions || [];
        form.permissions.push(permission);

        const view = permissions.find(x => x?.name?.startsWith('view'))

        if ((!permission?.name?.startsWith('view') && view)) {
            togglePermission(checked, view);
        }

    } else {
        form.permissions = form.permissions.filter(x => x.name != permission.name);

        if (permission?.name?.startsWith('view') && !permission?.name?.startsWith('view_any') && permissions) {
            permissions.forEach(permission => {
                togglePermission(checked, permission);
            });
        }
    }

}


const toggleGroupPermissionsTo = (permissions, checked) => {
    console.log(permissions, checked);
    permissions.forEach(permission => {
        permission = togglePermissionTo(checked, permission);
    });
}

const togglePermissionTo = (checked, permission, permissions = []) => {
    form.permissions = form.permissions || [];
    if (checked) {
        form.permissions.push(permission);
    } else {
        form.permissions = form.permissions.filter(x => x.name != permission.name);
    }

}

const toggleRole = (checked, role, roles = []) => {
    console.log(checked, role, roles);
    let permissions = role.permissions || [];
    if (checked) {
        form.roles = form.roles || [];
        form.roles.push(role);
        toggleGroupPermissionsTo(permissions, true);

    } else {
        form.roles = form.roles.filter(x => x.name != role.name);
        toggleGroupPermissionsTo(permissions, false);
    }

}

</script>