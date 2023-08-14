<script setup>
import {Link, Head, usePage} from '@inertiajs/vue3';
import Sidebar from "@/Components/Sidebar.vue";
import CreatePost from "@/Components/CreatePost.vue";
import Post from "@/Components/Post.vue";
import Header from "@/Components/Header.vue";

import {useGeneralStore} from '@/stores/general';
import {storeToRefs} from 'pinia';

const useGeneral = useGeneralStore()
const {isCropperModal, isImageDisplay} = storeToRefs(useGeneral)

defineProps({posts: Object, user: Object})
</script>

<template>
    <Header></Header>

    <div class="flex">
        <Sidebar></Sidebar>

        <main class="mx-auto w-full mt-3 mb-3">
            <div class="w-full bg-[#fafafb]">
                <div class="max-w-[1100px] pt-[56px] mx-auto pb-5">
                    <div class="relative">

                        <div class="absolute top-5 right-5">
                            <Link
                                v-if="$page.props.auth.user.id === user.id"
                                :href="route('profile.edit')"
                                class="flex justify-center w-7/12 md:w-[160px] items-baseline md:my-0 my-4 bg-[rgba(23,23,37,0.50)] hover:bg-[rgba(23,23,37,0.70)] rounded-full cursor-pointer text-white border-2 border-white py-2.5 px-3"
                            >
                                Edit Profile
                            </Link>
                        </div>

                        <div>
                            <img src="/img/background-profile.png" alt="image profile" class="w-full">
                        </div>

                        <div id="profile-info"
                             class="absolute top-[75%] flex md:flex-row flex-col items-center justify-between px-4">
                            <div class="flex md:flex-row flex-col gap-4 md:-mt-6 -mt-16 items-start">
                                <img :src="user.image" alt="Profile user image"
                                     class="rounded-full w-[165px] border-white border-4">
                                <div>
                                    <button
                                        v-if="$page.props.auth.user.id === user.id"
                                        @click="isCropperModal = true"
                                        class="absolute right-[50%] top-[70px] bg-gray-200 hover:bg-gray-300 p-1.5 rounded-full cursor-pointer"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                            <path
                                                d="M149.1 64.8L138.7 96H64C28.7 96 0 124.7 0 160V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H373.3L362.9 64.8C356.4 45.2 338.1 32 317.4 32H194.6c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/>
                                        </svg>
                                    </button>

                                    <div class="md:mt-4 text-center md:text-left -mt-3">
                                        <div class="text-[28px] font-extrabold pt-1 text-white">
                                            {{ user.name }}
                                        </div>

                                        <div class="text-[17px] font-light mb-1.5 text-white text-right md:text-left">
                                            @{{ user.name }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="text-[17px] font-bold text-gray-600 mb-1.5 text-right md:text-right flex gap-x-5 justify-end pt-2.5 pr-[147px] bg-white pb-3 rounded-bl-2xl rounded-br-2xl">
                        <button class="flex justify-center flex-col gap-y-1">
                            <span class="text-[#0062FF]">Post</span>
                            <span class="text-[#0062FF] border-b-2 border-b-[#0062FF]">10.3k</span>
                        </button>
                        <button class="flex justify-center flex-col gap-y-1">
                            <span class="text-[#92929D]">Followers</span>
                            <span class="text-[#44444F] ">10.3k</span>
                        </button>
                        <button class="flex justify-center flex-col gap-y-1">
                            <span class="text-[#92929D]">Following</span>
                            <span class="text-[#44444F] ">10.3k</span>
                        </button>
                        <button class="flex justify-center flex-col gap-y-1">
                            <span class="text-[#92929D]">Likes</span>
                            <span class="text-[#44444F] ">10.3k</span>
                        </button>
                        <div class="flex justify-center flex-col gap-y-1">
                            <span class="text-[#92929D]">Photos</span>
                            <span class="text-[#44444F] ">10.3k</span>
                        </div>
                        <button class="flex justify-center flex-col gap-y-1">
                            <span class="text-[#92929D]">Saved</span>
                            <span class="text-[#44444F] ">10.3k</span>
                        </button>
                    </div>


                </div>

                <div class="max-w-[1100px] mx-auto flex gap-x-[5rem]">

                    <div class="flex flex-col gap-y-4">
                        <div class="bg-white rounded-2xl w-[400px] py-4 px-5">
                            <span class="font-bold">Complete Your profile</span>
                            <div class="flex gap-x-2 w-full pt-5">
                            <span class="h-[6px] block bg-[#E2E2EA] w-[80%] rounded-full relative">
                                <span class="block bg-[#0062FF] w-[80%] rounded-full absolute top-0 left-0 h-full">

                                </span>
                            </span>
                                <span class="w-[20%] block">75%</span>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl w-[400px] py-4 px-5">
                            <span class="block font-bold pb-2">About Me</span>
                            <hr class="block"/>
                            <div class="w-full pt-5 pb-5">
                                <p class="pb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A blanditiis dolorum
                                    ducimus eveniet iusto natus nesciunt temporibus velit! Animi autem cumque id quos
                                    tempore. Assumenda impedit minima praesentium qui sapiente!
                                </p>
                                <hr/>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl w-[400px] py-4 px-5">
                            <span class="block font-bold pb-2">Photos</span>
                            <hr class="block pb-2"/>
                            <div class="w-full flex flex-wrap items-center justify-start pt-1">

                                <span v-for="photo in posts.data" :key="photo" class="w-1/3">
                                    <img v-if="photo.image" :src="photo.image" alt="image post"
                                         class="aspect-square object-cover p-1 rounded-lg cursor-pointer"
                                         @click="isImageDisplay = photo.image">
                                </span>

                            </div>
                        </div>


                    </div>

                    <div class="flex flex-col gap-y-4">
                        <CreatePost
                            v-if="$page.props.auth.user.id === user.id"
                            :image="user.image"
                            :placeholder="'What’s on your mind?' + ' ' + user.name"
                        ></CreatePost>

                        <div v-for="post in posts.data" key="post">
                            <Post :user="post.user" :post="post" :comments="post.comments"></Post>
                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>
</template>

