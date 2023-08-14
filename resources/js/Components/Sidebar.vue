<script setup>
import {Link, usePage} from "@inertiajs/vue3";

const user = usePage().props.auth.user

</script>

<template>
    <div class="w-[250px] h-auto px-2.5 pt-2 pb-2 bg-white">
        <Link :href="route('user.show', {id: user.id})">
            <div
                class="flex gap-x-4 justify-center pt-3 pb-3 items-center bg-[#fafafb] border-2 border-[#e2e2ea] rounded-2xl">
                <div class="rounded-full w-[65px] overflow-hidden">
                    <img :src="user.image" alt="User avatar"
                         class="w-full object-cover"/>
                </div>

                <div>
                    <h2 class="font-semibold text-[#171725] text-sm">{{ user.name }}</h2>
                    <span class="text-[#92929D] text-[12px]">@{{ user.name }}</span>
                </div>

            </div>
        </Link>

        <div class="pt-5">
            <div class="relative mb-4">
                <span
                    class="before:block before:absolute before:bg-[#0062FF] before:w-[3px] before:h-full before:rounded-e-lg">
                </span>
                <div class="flex items-center">
                    <img src="/img/Feed.svg" alt="Logo" class="px-4"/>
                    <span class="text-sm text-[#0062FF] font-semibold">Feed</span>
                </div>
            </div>

            <div class="relative mb-4">
                <!--                <span-->
                <!--                    class="before:block before:absolute before:bg-[#0062FF] before:w-[3px] before:h-full before:rounded-e-lg">-->
                <!--                </span>-->
                <div class="flex items-center">
                    <img src="/img/Friends.svg" alt="Logo" class="px-4"/>
                    <span class="text-sm text-[#171725] font-semibold">Friends</span>
                </div>
            </div>

            <div class="relative mb-4">
                <!--                <span-->
                <!--                    class="before:block before:absolute before:bg-[#0062FF] before:w-[3px] before:h-full before:rounded-e-lg">-->
                <!--                </span>-->
                <div class="flex items-center">
                    <img src="/img/Photos.svg" alt="Logo" class="px-4"/>
                    <span class="text-sm text-[#171725] font-semibold">Photos</span>
                </div>
            </div>
        </div>
    </div>
</template>

