<template>
    <n-card title="Roles">
        <template #header-extra>
            <n-button @click="onCreate">Add Role</n-button>
        </template>
        <n-skeleton text :repeat="7" height="50px" v-if="isLoading"/>
        <div v-else>
            <EasyDataTable
                v-model:items-selected="selectedList"
                buttons-pagination
                :headers="headers"
                :items="roleList"
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

        <n-modal v-model:show="showModal" preset="card" class="w-11/12" v-if="showModal">
            <create-role @onSubmit="onSubmit" :is-update="isUpdate" />
        </n-modal>

    </n-card>
</template>

<script setup>

import {useRoleStore} from "../../stores/role-store";
import {storeToRefs} from "pinia";
import {ref} from "vue";
import CreateRole from "./CreateRole.vue";


const roleStore = useRoleStore()
const {roleList, selectedList, pagination, filters} = storeToRefs(roleStore)
const showModal = ref(false);
const isLoading = ref(false);
const isUpdate = ref(false);
roleStore.list();

const headers = [
    {text: "name", value: "name"},
    {text: "operation", value: "operation"},
]

const onSubmit = () => {
    showModal.value = false;
    roleStore.list();
}

const onPageChange = () => {

}

const onShow = (row) => {

}

const onDelete = (id) => {
    roleStore.delete(id).then(res => {
        roleStore.list();
    });
}

const onCreate = () => {
    roleStore.selectedPermissions = [];
    roleStore.role = {};
    isUpdate.value = false;
    showModal.value = true;
}

const onEdit = (row) => {
    isUpdate.value = true;
    roleStore.role = row;
    showModal.value = true;
}


</script>

<style scoped>

</style>
