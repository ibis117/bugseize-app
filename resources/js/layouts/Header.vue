<template>
    <n-layout class="w-full h-[80px] top-0 shadow fixed z-30">
        <div class="flex justify-between">
            <div class="flex items-center">
                <div class="w-[120px] text-center relative text-purple-500 p-4">
                    <n-icon size="40">
                        <archway/>
                    </n-icon>
                </div>
                <div class="flex justify-center mx-2">
                    <n-icon size="30" @click="toggleSideBar">
                        <bars/>
                    </n-icon>
                </div>
                <div class="hidden md:block md:flex">
                    <div class="mx-2">
                        <n-dropdown
                            trigger="hover"
                            :options="[{label: 'Menu One', key: 'menu-one'}, {label: 'Menu Two', key: 'menu-two'}]">
                            <n-button>
                                Menu Menu
                                <template #icon>
                                    <n-icon>
                                        <angle-down/>
                                    </n-icon>
                                </template>
                            </n-button>
                        </n-dropdown>
                    </div>
                    <div class="mx-2">
                        <n-input round type="text" placeholder="Search"/>
                    </div>
                </div>
            </div>

            <div class="flex items-center">
                <div class="flex justify-center items-center p-4">
                    <div class="mx-4">
                        <n-dropdown trigger="click"
                                    :options="[{label: 'New Message', key: 'New Message'}, {label: 'Hi, HOw r u?', key: 'Hi, HOw r u?'}, {label: 'Renewal Time', key: 'Renewal Time'}]">
                            <n-badge value="1" color="#a855f7">
                                <n-icon size="24">
                                    <bell/>
                                </n-icon>
                            </n-badge>
                        </n-dropdown>

                    </div>
                    <div class="mx-4">
                        <n-dropdown trigger="click" @select="onDropDownSelect"
                                    :options="[{label: 'Profile', key: 'Profile'}, {label: 'Logout', key: 'Logout'}]">
                            <n-button circle>{{ user?.username.charAt(0).toUpperCase() }}</n-button>
                        </n-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </n-layout>
</template>

<script setup>
import {Archway, Bars, AngleDown, Bell} from '@vicons/fa'
import {useSideBarStore} from "../stores/sidebar-store";
import {storeToRefs} from "pinia";
import {useAuthStore} from "../stores/auth-store";
import {onMounted} from "vue";

const {isSideBarOpen, toggleSideBar} = useSideBarStore();
const authStore = useAuthStore()
const {user} = storeToRefs(authStore)

onMounted(() => {
    authStore.getUser();
})

const onDropDownSelect = (key) => {
    if (key === 'Logout') {
        authStore.logout();
    }
}

</script>

<style scoped>

</style>
