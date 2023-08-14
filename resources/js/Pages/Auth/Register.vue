<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register"/>

        <form @submit.prevent="submit" class="w-[360px] m-auto">
            <h1 class="font-semibold text-lg text-[#171725] text-center pt-7.5 pb-5">Sign Up to your account</h1>

            <div class="mt-4">
                <TextInput
                    id="email"
                    type="email"
                    class="mb-4 block w-full bg-[#FAFAFB] py-3 rounded-xl text-[#92929D] border border-[#F1F1F5]"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    placeholder="Your email"
                />

                <InputError class="mt-2" :message="form.errors.email"/>
            </div>

            <div>

                <TextInput
                    id="name"
                    type="text"
                    class="mb-4 block w-full bg-[#FAFAFB] py-3 rounded-xl text-[#92929D] border border-[#F1F1F5]"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Your name"
                />

                <InputError class="mt-2" :message="form.errors.name"/>
            </div>


            <div>
                <TextInput
                    id="password"
                    type="password"
                    class="mb-4 block w-full bg-[#FAFAFB] py-3 rounded-xl text-[#92929D] border border-[#F1F1F5]"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    placeholder="Create Password"
                />

                <InputError class="mt-2" :message="form.errors.password"/>
            </div>

            <div>
                <TextInput
                    id="password"
                    type="password"
                    class="mb-4 block w-full bg-[#FAFAFB] py-3 rounded-xl text-[#92929D] border border-[#F1F1F5]"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm Password"
                />

                <InputError class="mt-2" :message="form.errors.password"/>
            </div>


            <div class="flex items-center justify-center mt-4 flex-col gap-y-2.5">

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
                OR
                <a class="rounded-xl border-2 w-full flex justify-center gap-x-2.5 py-2.5 text-[#696974] text-sm font-semibold"
                   href="/google-auth/redirect">
                    <img src="/img/Google.svg" alt="">
                    Continue with Google
                </a>
            </div>

            <div class="border-t-[#FAFAFB] mt-10 text-center">
                <Link
                    :href="route('login')"
                    class="text-[#0062FF] font-semibold text-sm"
                >
                    Already have an Square account? Log in
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
