<template>
    <header class="w-full bg-white h-[80px] top-0 shadow fixed z-30">
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
                        <n-dropdown trigger="click"
                                    :options="[{label: 'Account Setings', key: 'Account Setings'}, {label: 'Billing History', key: 'Billing History'}, {label: 'Sign Out', key: 'Sign Out'}]">
                            <n-avatar round size="large">S</n-avatar>
                        </n-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import {Archway, Bars, AngleDown, Bell} from '@vicons/fa'
import {useSideBarStore} from "../stores/sidebar-store";
import {storeToRefs} from "pinia";

const {isSideBarOpen, toggleSideBar} = useSideBarStore();

</script>

<style scoped>

</style>
