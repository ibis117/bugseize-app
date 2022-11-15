<template>
    <n-card title="Create User">
        <n-form
            ref="formRef"
            :model="client"
            :rules="rules"
            size="medium"
        >
            <n-grid cols="2" x-gap="24" responsive="screen">
                <n-form-item-gi  label="Full Name" path="name">
                    <n-input v-model:value="client.name" placeholder="Input Name"/>
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
import {useClientStore} from "../../stores/client-store";

const formRef = ref(null)
const clientStore = useClientStore();
const {client} = storeToRefs(clientStore)

const props = defineProps({
    isUpdate: {
        type: Boolean,
        default: false
    }
});

const submitForm = (e) => {
    e.preventDefault();
    formRef.value?.validate((errors) => {
        if (!errors) {
            if (props.isUpdate) {
                clientStore.update()
                    .then(res => {
                        emit('onSubmit');
                    });
            } else {
                clientStore.create()
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
    }
}

</script>

<style scoped>

</style>
