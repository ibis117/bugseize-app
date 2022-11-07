<template>
    <n-breadcrumb separator=">" class="mb-2 p-2 bg-white">
        <n-breadcrumb-item>Home</n-breadcrumb-item>
        <n-breadcrumb-item>Project</n-breadcrumb-item>
        <n-breadcrumb-item>Detail</n-breadcrumb-item>
    </n-breadcrumb>


    <n-grid cols="4" x-gap="24" item-responsive responsive="screen">
        <n-grid-item span="1">
            <n-card>
                <n-space vertical>
                    <div class="flex items-center">
                        <n-icon size="30" color="#0e7a0d">
                            <project-outlined/>
                        </n-icon> <span class="text-lg ml-2">{{ project.name}}</span>
                    </div>
                    <div class="flex items-center">
                        <n-icon size="20" color="#0e7a0d">
                            <chrome-outlined/>
                        </n-icon> <a :href="prepareUrl(project.url)" class="text-md ml-2">{{ project.url}}</a>
                    </div>
                    <div class="bg-gray-200 p-2 leading-loose">
                        {{ project.key }}
                    </div>
                    <n-button @click="copyApiKey(project.key)">
                        <n-icon size="20" color="#0e7a0d">
                            <copy-outlined/>
                        </n-icon> <span class="ml-2">Copy Api Key</span>
                    </n-button>

                    <div class="text-md">
                        {{ project.description }}
                    </div>
                </n-space>
            </n-card>
        </n-grid-item>

        <n-grid-item span="3">
            <list-exception :id="project.id" :show-filter="false"/>
        </n-grid-item>

    </n-grid>
</template>

<script setup>

import {onMounted} from "vue";
import {useRoute} from "vue-router";
import {useProjectStore} from "../../stores/project-store";
import {storeToRefs} from "pinia";
import {ProjectOutlined, ChromeOutlined, CopyOutlined} from "@vicons/antd"
import ListException from "../exception/ListException.vue";

const route = useRoute()
const project_id = route.params.id;

const projectStore = useProjectStore();

const {project} = storeToRefs(projectStore)

projectStore.show(project_id);

const prepareUrl = (url) => {
    return `https:\\${url}`;
}

const copyApiKey = (key) => {
    navigator.clipboard.writeText(key);
    alert('token has been copied to clipboard');
}


</script>

<style scoped>

</style>
