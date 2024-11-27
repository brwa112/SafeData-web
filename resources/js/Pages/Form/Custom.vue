<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Forms</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Custom</span>
            </li>
        </ul>
        <div class="pt-5 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Icon Input -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Icon Input</h5>
                </div>
                <div class="mb-5">
                    <IconInput type="number" placeholder="Size Form" v-model="size_from" icon="M²" />
                </div>
            </div>
            <!-- MultiSelect Input -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Select Input</h5>
                </div>
                <div class="mb-5">
                    <MultiSelect v-model="country" :list="countries" />
                </div>
            </div>
            <!-- Phone Input -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Phone Input</h5>
                </div>
                <div class="mb-5">
                    <PhoneSelect v-model="ownerMobile" />
                </div>
            </div>
            <!-- Social Input -->
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Social Input</h5>
                </div>
                <div class="mb-5">
                    <SocialInput type="fb" />
                </div>
            </div>
            <!-- Validate Input -->
            <form @click.prevent="submitForm" class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Validate Input</h5>
                </div>
                <div class="mb-5">
                    <ValidateInput v-model="form.email1" type="email" :isSubmit="isSubmitForm"
                        :error="formValidation.form.email1.$error" />
                </div>
                <!-- Button Submit -->
                <div class="w-full flex justify-end">
                    <button type="submit" class="btn btn-primary">{{ $t('form.save_changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import IconInput from '@/Components/Inputs/IconInput.vue';
import MultiSelect from '@/Components/Inputs/MultiSelect.vue';
import PhoneSelect from '@/Components/Inputs/PhoneSelect.vue';
import SocialInput from '@/Components/Inputs/SocialInput.vue';
import ValidateInput from '@/Components/Inputs/ValidateInput.vue';
import { useVuelidate } from '@vuelidate/core';
import { required, email, sameAs } from '@vuelidate/validators';
import Swal from 'sweetalert2';

const size_from = ref('');
const countries = ref(['Iraq', 'USA', 'UK', 'Canada', 'Australia', 'Germany', 'France', 'Italy']);
const country = ref('');
const ownerMobile = ref('');

const form = ref({
    email1: '',
    email2: '',
    email3: '',
});
const isSubmitForm = ref(false);
const rules2 = {
    form: {
        email1: { required, email },
        email2: { required, email },
        email3: { required, email },
    },
};
const formValidation = useVuelidate(rules2, { form });
const submitForm = () => {
    isSubmitForm.value = true;
    formValidation.value.form.$touch();
    if (formValidation.value.form.$invalid) {
        return false;
    }
    //form validated success
    showMessage('Form submitted successfully.');
};
const showMessage = (msg = '', type = 'success') => {
    const toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        customClass: { container: 'toast' },
    });
    toast.fire({
        icon: type,
        title: msg,
        padding: '10px 20px',
    });
};
</script>
