<template>
    <n-card title="Examples">
        <template #header-extra>
            <n-button @click="showModal = true">Add Project</n-button>
        </template>
        <n-skeleton text :repeat="7" height="50px" v-if="isLoading"/>
        <div v-else>
            <EasyDataTable
                v-model:items-selected="selectedList"
                buttons-pagination
                :headers="headers"
                :items="exampleList"
                table-class-name="customize-table"
                show-index
                header-text-direction="center"
                body-text-direction="center"
                :table-height="400"
                hide-footer
                v-model:server-options="pagination"
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
            <n-pagination v-model:page="pagination.currentPage" :page-count="pagination.lastPage"
                          @update:page="onPageChange"/>
        </div>

        <n-modal v-model:show="showModal" preset="card" class="w-11/12">
            <!--create-->
        </n-modal>

    </n-card>
</template>

<script setup>

import {useExampleStore} from "../../stores/example-store";
import {useListAction} from "../../composable/crud/list-action";
import {storeToRefs} from "pinia";
import {ref} from "vue";

const exampleStore = useExampleStore()
const {exampleList, selectedList, pagination} = storeToRefs(exampleStore)
const {isLoading} = useListAction(exampleStore);
const showModal = ref(false);

const headers = [

];

const onPageChange = () => {

}

const onShow = (row) => {

}


</script>

<style scoped>

</style>
