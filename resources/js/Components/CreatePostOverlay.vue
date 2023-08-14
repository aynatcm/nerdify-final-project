<script setup>
import {reactive, ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import {useGeneralStore} from "@/stores/general.js";
import {storeToRefs} from "pinia";

const useGeneral = useGeneralStore()
const {isPostOverlay} = storeToRefs(useGeneral)

const emit = defineEmits(['showModal'])

const user = usePage().props.auth.user

let imageDisplay = ref('')

const form = reactive({
    text: null,
    image: null
})

let error = ref(null)

const createPost = () => {
    router.post('/post', form, {
        forceFormData: true,
        preserveScroll: true,
        onError: errors => {
            errors && errors.text ? error.value = errors.text : ''
            errors && errors.image ? error.value = errors.image : ''
        },
        onSuccess: () => {
            form.text = null
            form.image = null
            imageDisplay.value = null
            emit('showModal', false)
        }
    });
}

const getImageUploaded = (e) => {
    imageDisplay.value = URL.createObjectURL(e.target.files[0])
    form.image = e.target.files[0]
}

const clearImage = () => {
    imageDisplay.value = null
    form.image = null
}
</script>

<template>
    <div id="createPostOverlay" class="fixed z-50 top-0 left-0 w-full h-full bg-white bg-opacity-70">
        <div class="grid h-screen place-items-center p-4">
            <div class="bg-white w-full max-w-[600px] mx-auto shadow-xl rounded-xl">
                <div class="flex items-center relative my-3.5 mx-1">
                    <div class="text-[18px] font-extrabold w-full text-left pl-4">
                        Post Something
                    </div>

                    <div @click="isPostOverlay = false"
                         class="absolute right-3 rounded-full p-1.5 bg-gray-200 hover:bg-gray-300 cursor-pointer ">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                            <path
                                d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"/>
                        </svg>
                    </div>
                </div>

                <div class="border-t border-t-gray-300">
                    <div class="p-4">
                        <div class="flex items-start">
                            <img :src="user.image" alt="post image"
                                 class="rounded-full ml-1 min-w-[45px] max-h-[45px]">

                            <div class="max-h-[350px] h-full overflow-auto w-full">
                            <textarea cols="30" rows="3" v-model="form.text"
                                      class="w-full border-0 resize-none focus:ring-0 text-[22px]"
                                      placeholder="What's on your mind?"></textarea>
                                <div class="p-2 border border-gray-300 rounded-lg relative" v-if="form.image">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"
                                         class="absolute bg-white p-0.5 m-2 right-2 rounded-full border cursor-pointer"
                                         @click="clearImage()">
                                        <path
                                            d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"
                                            fill="#5E6771"/>
                                    </svg>
                                    <img :src="imageDisplay" alt="image" class="rounded-lg mx-auto">
                                </div>

                            </div>
                        </div>
                        <hr/>

                        <div class="rounded-xl mt-4 flex items-center justify-between">

                            <div class="flex items-center">
                                <label for="image" class="hover:bg-gray-200 rounded-full p-2 cursor-pointer">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M22.5 18.65C22.5 20.5061 20.9274 22 19 22H5C3.07258 22 1.5 20.5061 1.5 18.65V5.35C1.5 3.49395 3.07258 2 5 2H19C20.9274 2 22.5 3.49395 22.5 5.35V18.65ZM21.5 15.0708L16.7865 10.775L12.0725 15.0284L17.4604 21H19C20.3863 21 21.5 19.942 21.5 18.65V15.0708ZM21.5 13.7178V5.35C21.5 4.05803 20.3863 3 19 3H5C3.61372 3 2.5 4.05803 2.5 5.35V17.445L8.31356 11.646C8.51602 11.444 8.84633 11.4527 9.0379 11.6651L11.4026 14.2859L16.4533 9.72878C16.6443 9.55643 16.9349 9.55716 17.125 9.73045L21.5 13.7178ZM16.1135 21L8.64759 12.7253L2.50884 18.8487C2.61604 20.0487 3.68548 21 5 21H16.1135ZM8.19048 8.7C7.12564 8.7 6.2619 7.83843 6.2619 6.775C6.2619 5.71157 7.12564 4.85 8.19048 4.85C9.25532 4.85 10.119 5.71157 10.119 6.775C10.119 7.83843 9.25532 8.7 8.19048 8.7ZM8.19048 7.7C8.70359 7.7 9.11905 7.28558 9.11905 6.775C9.11905 6.26442 8.70359 5.85 8.19048 5.85C7.67736 5.85 7.2619 6.26442 7.2619 6.775C7.2619 7.28558 7.67736 7.7 8.19048 7.7Z"
                                              fill="#92929D"></path>
                                    </svg>
                                </label>
                                <input
                                    id="image"
                                    class="hidden"
                                    type="file"
                                    @input="getImageUploaded($event)"
                                >
                            </div>

                            <button class="bg-[#0062ff] text-white px-6 py-2 rounded-lg" @click="createPost">
                                Share Post
                            </button>

                        </div>

                        <div v-if="error">
                            <div class="w-full bg-red-100 text-red-600 rounded-lg mt-3 text-center">
                                <div class="p-0.5">
                                    {{ error }}
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

