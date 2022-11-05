<template>
    <n-card title="Projects">
        <template #header-extra>
            <n-button @click="showModal = true">Add Project</n-button>
        </template>

        <n-modal v-model:show="showModal" preset="card" class="w-11/12">
            <create-project @on-submit="onSubmit"/>
        </n-modal>

        <n-list hoverable clickable show-divider>
            <template v-for="(project, index) in projects" :key="index">
                <n-list-item class="shadow" @click="onShow(project)">
                    <n-thing :title="project.name" content-style="margin-top: 10px;">
                        <template #description>
                            <n-space size="small" style="margin-top: 4px">
                                <n-tag :bordered="false" type="info" size="medium" round strong>
                                    <template #avatar>
                                        <n-badge :value="project.read_exception_count" />
                                    </template>
                                    Unread Exceptions
                                </n-tag>
                                <n-tag :bordered="false" type="info" size="large" round strong>
                                    <template #avatar>
                                        <n-badge :value="project.exception_count" type="warning" />
                                    </template>
                                    Total Exceptions
                                </n-tag>
                            </n-space>
                        </template>
                    </n-thing>
                    <template #suffix>
                        <n-button>
                            <template #icon>
                                <n-icon><angle-right /></n-icon>
                            </template>
                        </n-button>
                    </template>
                </n-list-item>
            </template>
        </n-list>
    </n-card>
</template>

<script setup>
import {useProjectStore} from "../../stores/project-store";
import {storeToRefs} from "pinia";
import {ref} from "vue";
import CreateProject from "./CreateProject.vue";
import {useRouter} from "vue-router";
import { AngleRight } from '@vicons/fa'

const router = useRouter()
const projectStore = useProjectStore()

const {projects} = storeToRefs(projectStore)

const isLoading = ref(false);
const showModal = ref(false);

projectStore.list();

const onShow = (project) => {
    router.push(`project/${project.id}`)
}

const onSubmit = () => {
    showModal.value = false;
    projectStore.list();
}

</script>

<style scoped>

</style>
