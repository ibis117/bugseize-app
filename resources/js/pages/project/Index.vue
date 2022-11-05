<template>
    <n-card title="Projects">
        <template #header-extra>
            <n-button @click="showModal = true">Add Project</n-button>
        </template>
        <n-skeleton text :repeat="7" height="50px" v-if="isLoading"/>
        <div v-else>
            <EasyDataTable
                v-model:items-selected="projectStore.selected"
                buttons-pagination
                :headers="headers"
                :items="projects"
                table-class-name="customize-table"
                show-index
                header-text-direction="center"
                body-text-direction="center"
                :table-height="400"
                hide-footer
                v-model:server-options="projectStore.pagination"
                @click-row="onShow"
            >
                <template #item-operation="item">
                    <div>
                        <n-button class="m-1">Edit</n-button>
                        <n-button class="m-1">Delete</n-button>
                    </div>
                </template>

            </EasyDataTable>
        </div>
        <div class="flex mt-4 justify-end">
            <n-pagination v-model:page="projectStore.currentPage" :page-count="projectStore.lastPage"
                          @update:page="onPageChange"/>
        </div>

        <n-modal v-model:show="showModal" preset="card" class="w-11/12">
            <create-project @on-submit="onSubmit"/>
        </n-modal>

    </n-card>
</template>

<script setup>

import {useProjectStore} from "../../stores/project-store";
import {storeToRefs} from "pinia";
import {ref} from "vue";
import CreateProject from "./CreateProject.vue";
import {useRouter} from "vue-router";

const router = useRouter()
const projectStore = useProjectStore()

const {projects} = storeToRefs(projectStore)

const isLoading = ref(false);
const showModal = ref(false);

projectStore.list();

const headers = [
    {text: "name", value: "name"},
    {text: "url", value: "url"},
    {text: "operation", value: "operation"},
];

const onPageChange = () => {
    isLoading.value = true
    projectStore.list().finally(() => isLoading.value = false);
}

const onSubmit = () => {
    showModal.value = false;
    projectStore.list();
}

const onShow = (item) => {
    router.push(`/project/${item.id}`)
}

</script>

<style scoped>
.customize-table {

    --easy-table-header-font-size: 14px;
    --easy-table-header-height: 50px;

    --easy-table-header-item-padding: 10px 15px;


    --easy-table-body-row-height: 20px;
    --easy-table-body-row-font-size: 12px;
    --easy-table-body-item-padding: 4px 6px;


    --easy-table-footer-font-size: 14px;
    --easy-table-footer-padding: 0px 10px;
    --easy-table-footer-height: 50px;

    --easy-table-rows-per-page-selector-width: 70px;
    --easy-table-rows-per-page-selector-option-padding: 10px;
}

tbody {
    min-height: 500px;
}
</style>
