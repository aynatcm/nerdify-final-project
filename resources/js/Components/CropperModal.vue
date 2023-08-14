<script setup>
import {ref} from "vue";
import {router} from "@inertiajs/vue3";
import {CircleStencil, Cropper} from "vue-advanced-cropper";
import 'vue-advanced-cropper/dist/style.css'

const emit = defineEmits(['showModal'])

let fileInput = ref(null)
let cropper = ref(null)
let uploadedImage = ref(null)
let croppedImageData = {
    file: null,
    imageUrl: null,
    height: null,
    width: null,
    left: null,
    top: null,
}

const getImageUploaded = (e) => {
    const file = e.target.files[0];
    uploadedImage.value = URL.createObjectURL(file)
}

const crop = () => {
    const {coordinates, canvas} = cropper.value.getResult()
    croppedImageData.imageUrl = canvas.toDataURL()

    let data = new FormData();
    data.append('image', fileInput.value.files[0] || '')
    data.append('height', fileInput.value.height || '')
    data.append('width', fileInput.value.width || '')
    data.append('left', fileInput.value.left || '')
    data.append('top', fileInput.value.top || '')

    router.post('/user/update-image', data, {
        preserveState: false,
    })

    emit("showModal", false)
}

</script>

<template>
    <div class="fixed z-50">
        <div class="fixed inset-0 bg-white bg-opacity-60"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex flex-col min-h-full justify-center items-center py-2">
                <div class="transform overflow-hidden rounded-lg bg-white shadow-2xl transition-all max-w-xl">
                    <div class="flex items-center py-4 border-b border-b-gray-300">
                        <div class="text-[22px] font-extrabold w-full text-center">
                            Update profile picture
                        </div>

                        <div class="absolute right-3 rounded-full p-2 bg-gray-200 hover:bg-gray-300 cursor-pointer"
                             @click="$emit('showModal',false)">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                <path
                                    d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center bg-white px-4 pb-4">
                        <div>
                            <div class="my-4">
                                <label for="image"
                                       class="flex items-center justify-center bg-[#E7F3FF] hover:bg-[#DBE7F2] font-bold py-2 px-2 rounded-md text-[#1977F2] w-full cursor-pointer gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path
                                            d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                                    </svg>
                                    Upload Photo
                                </label>

                                <input type="file" id="image" ref="fileInput" class="hidden" @change="getImageUploaded">
                            </div>

                            <div class="w-[350px] mx-auto">
                                <Cropper
                                    class="object-cover"
                                    ref="cropper"
                                    :stencil-component="CircleStencil"
                                    :src="uploadedImage"
                                />
                            </div>

                            <div class="flex gap-x-4" :class="uploadedImage ? 'pt-4': ''">
                                <button @click="$emit('showModal',false)"
                                        class="w-full justify-center rounded-md py-2 text-gray-600 hover:text-gray-800 font-bold hover:shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-0">
                                    Cancel
                                </button>

                                <button v-if="uploadedImage" @click="crop" type="button"
                                        class="w-full rounded-md bg-blue-500 py-2 text-white font-bold shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-0">
                                    Crop Image
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

