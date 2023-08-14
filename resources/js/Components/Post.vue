<script setup>
import {toRefs, reactive} from 'vue';
import {Link, router} from '@inertiajs/vue3';

import {useGeneralStore} from '@/stores/general';
import {storeToRefs} from 'pinia';

const useGeneral = useGeneralStore()
const {isImageDisplay} = storeToRefs(useGeneral)

const form = reactive({comment: null})

const props = defineProps({
    user: Object,
    post: Object,
    comments: Object,
});

const {post, user, comments} = toRefs(props)

const createComment = () => {
    router.post('/comment', {
            post_id: post.value.id,
            text: form.comment
        },
        {
            preserveScroll: true,
        })
}

const deleteComment = (id) => {
    router.delete('/comment/' + id, {
        preserveScroll: true
    })
}

const deletePost = (id) => {
    router.delete('/post/' + id, {
        preserveScroll: true
    })
}

const isUser = () => {
    router.get('/user/' + user.value.id)
}
</script>

<template>

    <section class="w-[625px] mt-5 px-5 py-5 bg-white rounded-xl">
        <div class="flex justify-between items-center">
            <div class="flex gap-x-2.5">
                <button @click="isUser">
                    <img :src="user.image" alt="Profile picture" class="rounded-full w-[45px]"/>
                </button>
                <div>
                    <h4 class="font-semibold text-sm text-[#171725]">{{ user.name }}</h4>
                    <span class="font-normal text-[12px] text-[#92929D]">{{ post.created_at }}</span>
                </div>
            </div>

            <div>
                <button>
                    <svg width="34" height="24" viewBox="0 0 34 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <rect y="5" width="34" height="14" rx="7" fill="#F1F1F5"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M12 12C12 10.8954 11.1046 10 10 10C8.89543 10 8 10.8954 8 12C8 13.1046 8.89543 14 10 14C11.1046 14 12 13.1046 12 12Z"
                              fill="#92929D"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M19 12C19 10.8954 18.1046 10 17 10C15.8954 10 15 10.8954 15 12C15 13.1046 15.8954 14 17 14C18.1046 14 19 13.1046 19 12Z"
                              fill="#92929D"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M26 12C26 10.8954 25.1046 10 24 10C22.8954 10 22 10.8954 22 12C22 13.1046 22.8954 14 24 14C25.1046 14 26 13.1046 26 12Z"
                              fill="#92929D"/>
                    </svg>
                </button>
            </div>
        </div>

        <div>
            <p class="font-medium text-sm text-[#44444F] pt-5 pb-4">
                {{
                    post.text
                }}
            </p>
        </div>

        <div class="flex gap-x-4 flex-wrap gap-y-4">
            <img v-if="post.image" :src="post.image" alt="post image" class="cursor-pointer mx-auto" @click="isImageDisplay = post.image"/>
        </div>

        <div class="mt-5 mb-4">
            <hr/>

            <div class="flex gap-x-12 pb-5 pt-5">

                <button class="text-sm font-medium text-[#44444F] flex gap-x-2 items-center">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M10.5139 15.2841L6.06545 18.6848C5.0587 19.4545 3.61004 18.7355 3.60796 17.4701L3.60414 15.1541C1.53288 14.656 0 12.7858 0 10.564V4.72006C0 2.11409 2.10604 0 4.70588 0H15.2941C17.894 0 20 2.11409 20 4.72006V10.564C20 13.17 17.894 15.2841 15.2941 15.2841H10.5139ZM5.60639 16.5183L9.56816 13.4896C9.74255 13.3563 9.95597 13.2841 10.1755 13.2841H15.2941C16.7877 13.2841 18 12.0671 18 10.564V4.72006C18 3.21696 16.7877 2 15.2941 2H4.70588C3.21232 2 2 3.21696 2 4.72006V10.564C2 12.0388 3.16906 13.243 4.63013 13.2831C5.17089 13.2979 5.60181 13.7401 5.6027 14.281L5.60639 16.5183Z"
                              fill="#92929D"/>
                    </svg>
                    {{ comments.length }} Comments
                </button>

                <button class="text-sm font-medium text-[#44444F] flex gap-x-2 items-center">
                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M11 2.12905L11.2215 1.9013C13.6871 -0.633767 17.6965 -0.633767 20.1621 1.9013C22.6126 4.42082 22.6126 8.49457 20.1621 11.0141L12.4337 18.9602C11.6636 19.752 10.3974 19.7696 9.60556 18.9994C9.58574 18.98 9.58574 18.98 9.56629 18.9602L1.83787 11.0141C-0.612625 8.49457 -0.612625 4.42082 1.83787 1.9013C4.3035 -0.633767 8.31287 -0.633767 10.7785 1.9013L11 2.12905ZM18.7284 9.61964C20.4239 7.87644 20.4239 5.03895 18.7284 3.29574C17.0481 1.56809 14.3355 1.56809 12.6552 3.29574L11.7169 4.26053C11.3242 4.66424 10.6758 4.66424 10.2831 4.26053L9.34478 3.29574C7.66445 1.56809 4.95192 1.56809 3.27159 3.29574C1.57614 5.03895 1.57614 7.87644 3.27159 9.61964L11 17.5657L18.7284 9.61964Z"
                              fill="#92929D"/>
                    </svg>

                    120K Likes (Soon xd)
                </button>


                <button class="text-sm font-medium text-[#44444F] flex gap-x-2 items-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M7.85738 1.04762H17.1431C19.247 1.04762 20.9526 2.7532 20.9526 4.85715V20.2119C20.9526 21.2639 20.0998 22.1167 19.0479 22.1167C18.6153 22.1167 18.1956 21.9694 17.8579 21.6992L12.5002 17.4125L7.1426 21.6992C6.32119 22.3564 5.12253 22.2233 4.46532 21.4019C4.19508 21.0642 4.04785 20.6445 4.04785 20.2119V4.85715C4.04785 2.7532 5.75343 1.04762 7.85738 1.04762ZM7.85738 2.95238C6.8054 2.95238 5.95261 3.80518 5.95261 4.85715V20.2119L11.3102 15.9253C12.0059 15.3686 12.9945 15.3686 13.6902 15.9253L19.0479 20.2119V4.85715C19.0479 3.80518 18.1951 2.95238 17.1431 2.95238H7.85738Z"
                              fill="#92929D"/>
                    </svg>

                    12 Saved (Contratenme porfavor)
                </button>


            </div>


            <hr/>
        </div>

        <div id="comments" class="px-3">
            <div id="create-comment" class="flex items-center justify-between py-2">
                <div class="flex items-center w-full">
                    <Link :href="route('user.show',{id: $page.props.auth.user.id})">
                        <img :src="$page.props.auth.user.image" alt="Profile picture" class="rounded-full w-[45px]"/>
                    </Link>
                    <div class="flex items-center justify-center px-2 rounded-full w-full bg-[#FAFAFB]">
                        <input
                            v-model="form.comment"
                            class="w-full py-4 px-3 rounded-lg bg-transparent border-none p-0 text-sm placeholder-[#92929D] ring-0 focus:ring-0"
                            placeholder="Write your comment…"
                            type="text">
                        <button @click="createComment">
                            Send
                        </button>
                    </div>
                </div>
            </div>

            <div v-if="comments" id="comments" class="max-h-[120px] overflow-auto pb-2 px-4">
                <div class="flex items-center justify-between pb-2" v-for="comment in comments" key="comment">
                    <div class="flex items-center w-full mb-1">
                        <Link :href="route('post.index')">
                            <img :src="comment.user.image" alt="Profile picture" class="rounded-full w-[45px]"/>
                        </Link>
                        <div class="flex items-center w-full">
                            <div class="flex items-center bg-[#FAFAFB] text-xs p-2 rounded-lg w-full">
                                {{ comment.text }}
                            </div>

                            <button v-if="$page.props.auth.user.id === comment.user.id"
                                    @click="deleteComment(comment.id)"
                                    class="rounded-full p-1.5 ml-2 cursor-pointer hover:bg-[#f2f2f2]">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>


