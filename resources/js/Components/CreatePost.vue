<script setup>
import {toRef, toRefs} from "vue";
import {Link, usePage} from "@inertiajs/vue3";
import {useGeneralStore} from "@/stores/general.js";
import {storeToRefs} from "pinia";

const useGeneral = useGeneralStore();
const {isPostOverlay} = storeToRefs(useGeneral);

const props = defineProps({
    image: String,
    placeholder: String,
});

const {image, placeholder} = toRefs(props)

const user = usePage().props.auth.user;
</script>

<template>
    <div class="bg-white py-2.5 px-5 rounded-xl">
        <div>
            <h3 class="font-medium text-sm text-[#171725] pb-2">Post Something</h3>
            <hr>
        </div>

        <div>
            <div class="flex justify-between pt-2">
                <Link class="flex items-center justify-center" href="/">
                    <img :src="image" alt="Photo of user" class="rounded-full w-[45px]"/>
                </Link>
                <div @click="isPostOverlay = true"
                     type="text"
                     class="w-full block border-none cursor-pointer">
                    {{ placeholder }}
                </div>
            </div>

        </div>

    </div>
</template>

