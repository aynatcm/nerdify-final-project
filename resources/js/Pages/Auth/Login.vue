<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in"/>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="w-[360px] m-auto">
            <h1 class="font-semibold text-lg text-[#171725] text-center pt-7.5 pb-5">Login to your acount</h1>
            <div>

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Your email"
                />

                <InputError class="mt-2" :message="form.errors.email"/>
            </div>

            <div class="mt-4">

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    placeholder="Your password"
                />

                <InputError class="mt-2" :message="form.errors.password"/>
            </div>

            <!--            <div class="block mt-4">-->
            <!--                <label class="flex items-center">-->
            <!--                    <Checkbox name="remember" v-model:checked="form.remember"/>-->
            <!--                    <span class="ml-2 text-sm text-gray-600">Remember me</span>-->
            <!--                </label>-->
            <!--            </div>-->

            <div class="flex items-center justify-center mt-4 flex-col gap-y-2.5">
                <!--                <Link-->
                <!--                    v-if="canResetPassword"-->
                <!--                    :href="route('password.request')"-->
                <!--                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
                <!--                >-->
                <!--                    Forgot your password?-->
                <!--                </Link>-->

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
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
                    :href="route('register')"
                    class="text-[#0062FF] font-semibold text-sm"
                >
                    <span class="flex gap-x-2 items-center justify-center">
                    Can’t login? <svg width="3" height="3" viewBox="0 0 3 3" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M1.5 3C2.32843 3 3 2.32843 3 1.5C3 0.671573 2.32843 0 1.5 0C0.671573 0 0 0.671573 0 1.5C0 2.32843 0.671573 3 1.5 3Z"
      fill="#0062FF"/>
</svg>
 Sign Up?

                    </span>
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
