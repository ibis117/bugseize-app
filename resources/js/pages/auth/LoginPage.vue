<template>
    <div class="flex min-h-screen justify-center items-center bg-slate-50">
        <n-card class="w-[350px] shadow-lg">
            <form method="post" @submit.prevent="onLogin">
                <n-form-item label="Username">
                    <n-input placeholder="Input Username" />
                </n-form-item>

                <n-form-item label="Password">
                    <n-input type="password" show-password-on="click" placeholder="Input Password" />
                </n-form-item>

                <n-button block class="bg-green-500 text-white" attr-type="submit">LogIn</n-button>
            </form>
        </n-card>
    </div>
</template>

<script setup>

const onLogin = () => {
    alert('opk');
}

</script>

<style scoped>

</style>
