<template>
    <div>
        <n-grid x-gap="12" cols="6">
            <n-gi span="1" v-for="(project, projectIndex) in projects" :key="projectIndex">
                <n-card :title="project.name" class="mb-4" hoverable>
                    <n-thing>
                        <template #description>
                            <n-space>
                                <div class="inline-block flex items-center">
                                    <n-icon size="20">
                                        <info-circle/>
                                    </n-icon>
                                    <span class="text-base ml-2">{{ project.issue_count }}</span>
                                </div>
                                <div class="inline-block flex items-center">
                                    <n-icon size="20">
                                        <bug/>
                                    </n-icon>
                                    <span class="text-base ml-2">{{ project.exception_count }}</span>
                                </div>
                            </n-space>
                        </template>
                    </n-thing>
                </n-card>
            </n-gi>
        </n-grid>

        <n-card title="Recent Exceptions">
            <n-list hoverable clickable>
                <n-list-item v-for="(exception,indexException) in exceptions" :key="indexException">
                    <n-space justify="space-between" align="center">
                        <n-thing :title="exception.exception" content-style="margin-top: 10px;">
                            <template #description>
                                <n-space size="small" style="margin-top: 4px">
                                    <div>
                                        <n-tag :bordered="false" type="info" size="small">
                                            {{ exception.status.toUpperCase() }}
                                        </n-tag>
                                        {{ moment(exception.created_at).fromNow() }}
                                    </div>
                                </n-space>
                            </template>
                        </n-thing>

                        <n-thing>
                            <n-icon size="20">
                                <angle-right/>
                            </n-icon>
                        </n-thing>
                    </n-space>
                </n-list-item>
            </n-list>
        </n-card>
    </div>
</template>

<script setup>

import {useCentrifuge} from "../composable/centrifuge";
import {onMounted} from "vue";
import {useDashboardStore} from "../stores/dashboard-store";
import {useAuthStore} from "../stores/auth-store";
import {storeToRefs} from "pinia";
import {AngleRight, InfoCircle, Bug} from '@vicons/fa';
import moment from "moment";


const {centrifuge} = useCentrifuge();
const authStore = useAuthStore();
const dashboardStore = useDashboardStore();
const {exceptions, projects} = storeToRefs(dashboardStore)

dashboardStore.listProject();

onMounted(() => {
    recentExceptions();
    authStore.getUser()
        .then(res => {
            const channelName = `recent-exception#${res.id}`
            subscribe(channelName);
        });

})

const recentExceptions = () => {
    dashboardStore.recentExceptions();
}

const subscribe = (channelName) => {
    const sub = centrifuge.newSubscription(channelName);
    sub.on('publication', function (ctx) {
        recentExceptions();
        console.log("publish", ctx.data);
    }).on('subscribing', function (ctx) {
        console.log('subscribing', ctx);
    }).on('subscribed', function (ctx) {
        console.log('subscribed', ctx);
    }).on('unsubscribed', function (ctx) {
        console.log('unsubscribed', ctx);
    }).subscribe();
}

</script>

<style scoped>


</style>
