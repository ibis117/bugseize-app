<template>
    <div class="w-full bg-slate-300">
        <Header/>
        <section class="mt-[80px] flex h-auto">
            <Sidebar/>
        </section>
        <section class="duration-200" :class="isSideBarOpen ? 'ml-[120px]' : '' ">
            <perfect-scrollbar>
                <div class="m-4">
<!--                    <router-view v-slot="{ Component }">-->
<!--                        <transition name="fade" mode="out-in">-->
<!--                            <component :is="Component" />-->
<!--                        </transition>-->
<!--                    </router-view>-->
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

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

</style>
