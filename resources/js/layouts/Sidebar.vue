<template>
    <div class="flex bg-white h-auto"
         @mouseleave="sidebarStore.setSecondarySideBar(false)"
    >
        <aside class="w-[120px] bg-white shadow-lg left-0 fixed h-full transform duration-200"
               :class="isSideBarOpen ? 'translate-x-0 ease-in' : '-translate-x-full ease-out' ">
            <perfect-scrollbar>
                <div class="flex justify-center">
                    <ul class="w-full h-full">
                        <template v-for="(menu, menuIndex) in menuList" :key="menuIndex">
                            <li
                                class="group text-center relative text-gray-500 hover:text-purple-500 p-4 box-border border-b-2"
                                :class="isCurrentRoute(menu.path)"
                                @mouseenter="showSecondarySideBar(menu)"
                            >
                                <router-link :to="menu.path">
                                    <n-icon size="40" :component="menu.icon"/>
                                    <div class="text-xs">{{ menu.name }}</div>
                                </router-link>
                                <div class="absolute bottom-0 right-0 w-4 overflow-hidden inline-block">
                                    <div
                                        class="h-8 bg-white rotate-45 transform origin-bottom-left group-hover:bg-purple-500"></div>
                                </div>
                            </li>
                        </template>
                    </ul>
                </div>
            </perfect-scrollbar>
        </aside>

        <!--Secondary Sidebar Closed for now-->
        <aside class="left-[120px] h-full w-[200px] fixed bg-slate-50 shadow-lg z-10"
               :class="isSecondarySideBarOpen ? '' : 'hidden' ">
            <div class="flex justify-center">
                <ul class="w-full">
                    <template v-for="(subMenu, subMenuIndex) in subMenuList" :key="subMenuIndex">
                        <li class="text-center relative text-gray-500 hover:text-purple-500 p-2 box-border hover:bg-gray-200">
                            <router-link :to="subMenu.path" class="flex p-2 justify-start items-center">
                                <n-icon size="20" :component="subMenu?.icon" v-if="subMenu.hasOwnProperty('icon')" />
                                <div class="text-sm ml-2">{{ subMenu.name }}</div>
                            </router-link>
                        </li>
                    </template>
                </ul>
            </div>
        </aside>
    </div>
</template>

<script setup>
import {ChartBar, Bug, Archive, File} from '@vicons/fa'
import {storeToRefs} from "pinia";
import {useSideBarStore} from "../stores/sidebar-store";
import {computed, onMounted, ref, shallowRef} from "vue";
import {useRoute} from "vue-router";


const route = useRoute();

const sidebarStore = useSideBarStore()

const {isSideBarOpen, toggleSideBar, isSecondarySideBarOpen, currentHoverMenu} = storeToRefs(sidebarStore);

const hoveredMenu = shallowRef({});

onMounted(() => {
    window.addEventListener('resize', useSideBarStore().onResize);
})

const isCurrentRoute = (currentPath) => {
    let path = route.path;
    return path === currentPath ? 'text-purple-500' : '';
}

const menuList = [
    {name: 'Dashboard', path: '/', icon: ChartBar},
    // subMenu:[{ name: 'Dashboard One', path: '/', icon: File }]
    {name: 'Project', path: '/project', icon: Archive},
    {name: 'Exception', path: '/exception', icon: Bug},
]

const subMenuList = computed(() => {
    return hoveredMenu.value.subMenu ?? [];
})

const showSecondarySideBar = (menu) => {
    hoveredMenu.value = menu;
    if (menu.hasOwnProperty('subMenu') && menu?.subMenu?.length > 0) {
        sidebarStore.setSecondarySideBar(true);
        return;
    }
    sidebarStore.setSecondarySideBar(false);
}


</script>

<style scoped>
.ps {
    min-height: 600px;
}
</style>
