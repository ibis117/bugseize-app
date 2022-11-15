<template>
    <n-card title="Users">
        <template #header-extra>
            <n-button @click="showModal = true">Add User</n-button>
        </template>
        <n-skeleton text :repeat="7" height="50px" v-if="isLoading"/>
        <div v-else>
            <EasyDataTable
                v-model:items-selected="selectedList"
                buttons-pagination
                :headers="headers"
                :items="userList"
                table-class-name="customize-table"
                header-text-direction="start"
                body-text-direction="start"
                :table-height="400"
                hide-footer
                v-model:server-options="pagination"
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

        <n-modal v-model:show="showModal" preset="card" class="w-11/12">
            <create-user @onSubmit="onSubmit" :is-update="isUpdate" />
        </n-modal>

    </n-card>
</template>

<script setup>

import {useUserStore} from "../../stores/user-store";
import {storeToRefs} from "pinia";
import {ref} from "vue";
import CreateUser from "./CreateUser.vue";

const userStore = useUserStore()
const {userList, selectedList, pagination, filters} = storeToRefs(userStore)
const showModal = ref(false);
const isLoading = ref(false);
const isUpdate = ref(false);
userStore.list();

const headers = [
    {text: "name", value: "name"},
    {text: "username", value: "username"},
    {text: "email", value: "email"},
    {text: "email_verified_at", value: "email_verified_at"},
    {text: "operation", value: "operation"},
]

const onSubmit = () => {
    showModal.value = false;
    userStore.list();
}

const onPageChange = () => {

}

const onShow = (row) => {

}

const onDelete = (id) => {
    userStore.delete(id).then(res => {
        userStore.list();
    });
}

const onCreate = () => {
    isUpdate.value = false;
    userStore.user = {};
    showModal.value = true;
}

const onEdit = (row) => {
    isUpdate.value = true;
    userStore.user = row;
    showModal.value = true;
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
