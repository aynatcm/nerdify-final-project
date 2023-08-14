<script setup>
import {useGeneralStore} from '@/stores/general';
import {storeToRefs} from 'pinia';
import {Link, usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import Logout from 'vue-material-design-icons/Logout.vue'
import CropperModal from "@/Components/CropperModal.vue";
import ImageDisplay from "@/Components/ImageDisplay.vue";
import CreatePostOverlay from "@/Components/CreatePostOverlay.vue";

const useGeneral = useGeneralStore()
const {isPostOverlay, isCropperModal, isImageDisplay} = storeToRefs(useGeneral)

const user = usePage().props.auth.user

let showMenu = ref(false)

</script>

<template>
    <div>
        <header class="flex border-b-2 border-gray-500 items-center justify-between px-9 py-6 bg-white">
            <div>
                <Link href="/">
                    <img src="/img/Logo.svg" alt="Logo image">
                </Link>
            </div>

            <div class="flex items-center gap-x-6">
                <button>
                    <img src="/img/Notification.svg" alt="User avatar">
                </button>

                <button @click="showMenu = !showMenu" class="flex -space-x-2 overflow-hidden items-center gap-x-4">
                    <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white" :src="user.image" alt=""/>
                    <img class="inline-block rounded-full ring-2 ring-white" src="/img/Dropdown.svg" alt=""/>
                </button>

                <div
                    v-if="showMenu"
                    class="absolute bg-white shadow-xl top-32 right-0 w-[330px] rounded-lg p-1 border mt-1 z-50">

                    <Link :href="route('user.show', {id: user.id})">
                        <div class="flex items-center gap-3 hover:bg-gray-200 py-2 rounded-lg">
                            <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white" :src="user.image"
                                 alt="image of user"/>
                            <span>{{ user.name }}</span>
                        </div>
                    </Link>
                    <Link
                        class="w-full"
                        method="post"
                        as="button"
                        :href="route('logout')">
                        <div class="flex items-center gap-3 hover:bg-gray-200 px-2 py-2.5 rounded-lg">
                            <Logout class="pl-2" :size="30"></Logout>
                            <span>Logout</span>
                        </div>
                    </Link>
                </div>
            </div>
        </header>

        <CreatePostOverlay
            v-if="isPostOverlay"
            @showModal="isPostOverlay = false"
        />

        <CropperModal
            v-if="isCropperModal"
            @showModal="isCropperModal = false"
        />

        <ImageDisplay
            v-if="isImageDisplay"
        />
    </div>
</template>

