<script setup>
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    status: {
        type: String,
    }
});

const form = useForm({
    value: '',
});

const submit = () => {
    form.post(route('get-status'), {
        onFinish: () => form.reset('value'),
    });
};
</script>

<template>
    <Head title="Covid Vaccine Center" />
    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="value" value="NID" />
                <TextInput
                    id="value"
                    v-model="form.value"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.value" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    search
                </PrimaryButton>
            </div>
        </form>

        <div v-if="status">
            {{ status }}
            <Link v-if="status == 'Not Registered'" :href="route('register')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    register now
            </Link>
        </div>


    </AuthenticationCard>
</template>
