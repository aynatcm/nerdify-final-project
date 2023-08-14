<script setup>
import Header from "@/Components/Header.vue";
import Sidebar from "@/Components/Sidebar.vue";
import CreatePost from "@/Components/CreatePost.vue";
import Post from "@/Components/Post.vue";
import {usePage, Link} from "@inertiajs/vue3";

const user = usePage().props.auth.user;

defineProps({posts: Object})
</script>


<template>

    <Header></Header>

    <div class="flex">
        <Sidebar></Sidebar>

        <main class="mx-auto w-[625px] mt-3 mb-3">
            <CreatePost
                :image="user.image"
                :placeholder="'What’s on your mind?' + ' ' + user.name"
            ></CreatePost>

            <div v-for="post in posts.data" key="post">
                <Post :user="post.user" :post="post" :comments="post.comments"></Post>
            </div>

        </main>
    </div>


</template>
