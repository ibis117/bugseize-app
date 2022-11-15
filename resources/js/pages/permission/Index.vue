<template>
    <n-card title="Permissions">
        <template #header-extra>
            <n-button @click="syncPermission">Sync Permission</n-button>
        </template>
        <n-skeleton text :repeat="7" height="50px" v-if="isLoading"/>
        <div v-else>
            <EasyDataTable
                v-model:items-selected="selectedList"
                buttons-pagination
                :headers="headers"
                :items="permissionList"
                table-class-name="customize-table"
                header-text-direction="start"
                body-text-direction="start"
                :table-height="400"
                hide-footer
                @click-row="onShow"
            >
                <!--                show-index-->
                <template #item-operation="item">
                    <div>
                        <n-button class="m-1" @click="onEdit(item)">Edit</n-button>
                        <n-button class="m-1" @click="onDelete(item.id)">Delete</n-button>
                    </div>
                </template>

            </EasyDataTable>
        </div>
        <div class="flex mt-4 justify-end">
            <n-pagination v-model:page="pagination.currentPage" :page-count="pagination.lastPage"
                          @update:page="onPageChange"/>
        </div>


    </n-card>
</template>

<script setup>

import {usePermissionStore} from "../../stores/permission-store";
import {storeToRefs} from "pinia";
import {ref} from "vue";


const permissionStore = usePermissionStore()
const {permissionList, selectedList, pagination, filters} = storeToRefs(permissionStore)
const showModal = ref(false);
const isLoading = ref(false);
const isUpdate = ref(false);
permissionStore.list();

const headers = [
    {text: "Name", value: "name"},
    {text: "Group", value: "group_name"},
    {text: "operation", value: "operation"},
]

const onSubmit = () => {
    showModal.value = false;
    permissionStore.list();
}

const onPageChange = () => {

}

const onShow = (row) => {

}

const onDelete = (id) => {
    permissionStore.delete(id).then(res => {
        permissionStore.list();
    });
}

const onCreate = () => {
    isUpdate.value = false;
    showModal.value = true;
}

const onEdit = (row) => {
    isUpdate.value = true;
    permissionStore.permission = row;
    showModal.value = true;
}

const syncPermission = () => {
    permissionStore.sync().then(res => {
        permissionStore.list();
    });
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
</style>
