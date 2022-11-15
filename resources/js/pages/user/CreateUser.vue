<template>
    <n-card title="Create User">
        <n-form
            ref="formRef"
            :model="user"
            :rules="rules"
            size="medium"
        >
            <n-grid cols="2" x-gap="24" responsive="screen">
                <n-form-item-gi  label="Full Name" path="name">
                    <n-input v-model:value="user.name" placeholder="Input Name"/>
                </n-form-item-gi>

                <n-form-item-gi label="Username" path="username">
                    <n-input v-model:value="user.username" placeholder="Input Username"/>
                </n-form-item-gi>

                <n-form-item-gi label="Email" path="email">
                    <n-input v-model:value="user.email" placeholder="Input Email"/>
                </n-form-item-gi>

                <n-form-item-gi label="Password" path="password" v-if="!isUpdate">
                    <n-input
                        type="password"
                        show-password-on="click"
                        placeholder="Input Password"
                        v-model:value="user.password"
                    >
                        <template #password-visible-icon>
                            <n-icon :size="16" :component="GlassesOutline" />
                        </template>
                        <template #password-invisible-icon>
                            <n-icon :size="16" :component="Glasses" />
                        </template>
                    </n-input>
                </n-form-item-gi>

                <n-form-item-gi label="Client" path="client">
                    <n-select
                        v-model:value="userStore.selectedClient"
                        :options="clients"
                        label-field="name"
                        value-field="id" />
                </n-form-item-gi>

                <n-form-item-gi label="Role" path="role">
                    <n-select
                        v-model:value="userStore.selectedRole"
                        :options="roles"
                        label-field="name"
                        value-field="id" />
                </n-form-item-gi>
            </n-grid>
            <div class="flex justify-end mt-4">
                <n-button @click="submitForm">
                    Submit
                </n-button>
            </div>
        </n-form>
    </n-card>
</template>

<script setup>
import {ref, defineProps} from "vue";
import {storeToRefs} from "pinia";
import {useUserStore} from "../../stores/user-store";
import {useClientStore} from "../../stores/client-store";
import {useRoleStore} from "../../stores/role-store";


const props = defineProps({
    isUpdate: {
        type: Boolean,
        default: false
    }
});

const formRef = ref(null)
const userStore = useUserStore();

useClientStore().list();
useRoleStore().list();

if (props.isUpdate) {
    userStore.setSelectedRole();
    userStore.setSelectedClient();
}

const {user, clients, roles} = storeToRefs(userStore)

const submitForm = (e) => {
    e.preventDefault();
    formRef.value?.validate((errors) => {
        if (!errors) {
            if (props.isUpdate) {
                userStore.update()
                    .then(res => {
                        emit('onSubmit');
                    });
            } else {
                userStore.create()
                    .then(res => {
                        emit('onSubmit');
                    });
            }
        }
    });
}

const emit = defineEmits(['onSubmit'])

const rules = {
    name: {
        required: true,
        message: "Please enter name",
        trigger: 'change'
    },
    username: {
        required: true,
        message: "Please enter username",
        trigger: 'change'
    },
    email: {
        required: true,
        message: "Please enter email",
        trigger: 'change'
    },
    password: {
        required: true,
        message: "Please enter password",
        trigger: 'change'
    },
    client: {
        required: false,
        message: "Please select client",
        trigger: 'change'
    },
    role: {
        required: false,
        message: "Please select role",
        trigger: 'change'
    },
}

</script>

<style scoped>

</style>
