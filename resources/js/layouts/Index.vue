<template>
    <div class="w-full bg-gray-100">
        <Header/>
        <section class="mt-[80px] flex h-auto">
            <Sidebar/>
        </section>
        <section class="duration-200" :class="isSideBarOpen ? 'ml-[120px]' : '' ">
            <perfect-scrollbar>
                <div class="m-4">
                    <router-view></router-view>
                </div>
            </perfect-scrollbar>
        </section>
        <footer></footer>
    </div>
</template>


<script setup>
import Header from "./Header.vue"
import Sidebar from "./Sidebar.vue";
import {storeToRefs} from "pinia";
import {useSideBarStore} from "../stores/sidebar-store";

const {isSideBarOpen, toggleSideBar} = storeToRefs(useSideBarStore());
</script>

<style scoped>
.ps {
    min-height: calc(100vh - 80px);
}
</style>
