<template>
    <div class="flex min-h-screen justify-center items-center bg-slate-50">
        <n-card class="w-[350px] shadow-lg">
            <form method="post" @submit.prevent="onLogin">
                <n-form-item label="Username">
                    <n-input
                        placeholder="Input Username"
                        v-model:value="credentials.username"/>
                </n-form-item>

                <n-form-item label="Password">
                    <n-input
                        type="password"
                        show-password-on="click"
                        v-model:value="credentials.password"
                        placeholder="Input Password"/>
                </n-form-item>

                <n-button block class="bg-green-500 text-white" attr-type="submit">LogIn</n-button>
            </form>
        </n-card>
    </div>
</template>

<script setup>

import {useAuthStore} from "../../stores/auth-store";
import {storeToRefs} from "pinia";

const authStore = useAuthStore();

const {credentials} = storeToRefs(authStore);


const onLogin = () => {
    authStore.login();
}

</script>

<style scoped>

</style>
