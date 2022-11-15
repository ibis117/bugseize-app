<template>
    <n-card title="Create User">
        <n-form
            ref="formRef"
            :model="role"
            :rules="rules"
            size="medium"
        >
            <n-grid cols="2" x-gap="24" responsive="screen">
                <n-form-item-gi label="Full Name" path="name">
                    <n-input v-model:value="role.name" placeholder="Input Name"/>
                </n-form-item-gi>
            </n-grid>

            <n-checkbox-group v-model:value="selectedPermissions">
                <n-space item-style="display: flex;" align="center">
                    <n-checkbox :value="permission.id" :label="permission.name" v-for="permission in permissions" />
                </n-space>
            </n-checkbox-group>

            <div class="flex justify-end mt-4">
                <n-button @click="submitForm">
                    Submit
                </n-button>
            </div>
        </n-form>
    </n-card>
</template>

<script setup>
import {ref, defineProps, onMounted} from "vue";
import {storeToRefs} from "pinia";
import {useRoleStore} from "../../stores/role-store";
import {usePermissionStore} from "../../stores/permission-store";

const checkedValues = ref([]);
const formRef = ref(null)
const roleStore = useRoleStore();
const {role, getRoleId, permissions, selectedPermissions} = storeToRefs(roleStore)
const props = defineProps({
    isUpdate: {
        type: Boolean,
        default: false
    }
});

usePermissionStore().list()

if (props.isUpdate) {
    roleStore.setSelectedPermissions();
}

const submitForm = (e) => {
    e.preventDefault();
    formRef.value?.validate((errors) => {
        if (!errors) {
            if (props.isUpdate) {
                roleStore.update()
                    .then(res => {
                        roleStore.selectedPermissions = [];
                        roleStore.role = {};
                        emit('onSubmit');
                    });
            } else {
                roleStore.create()
                    .then(res => {
                        roleStore.selectedPermissions = [];
                        roleStore.role = {};
                        emit('onSubmit');
                    });
            }
        }
    });
}

const isChecked = (permission, selectedPermissions) => {
    for (let perm of selectedPermissions) {
        if (perm === permission.id) {
            return perm;
        }
    }
    return null;
}

const emit = defineEmits(['onSubmit'])

const rules = {
    name: {
        required: true,
        message: "Please enter name",
        trigger: 'change'
    }
}

</script>

<style scoped>

</style>
