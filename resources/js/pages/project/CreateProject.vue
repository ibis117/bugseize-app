<template>
    <n-card title="Create Project">
        <n-form
            ref="formRef"
            :model="project"
            :rules="rules"
            size="medium"
        >
            <n-grid cols="2" x-gap="8" responsive="screen">
                <n-form-item-gi  label="Project Name" path="name">
                    <n-input v-model:value="project.name" placeholder="Input Name"/>
                </n-form-item-gi>
                <n-form-item-gi label="Site Url" path="url">
                    <n-input-group-label>https://</n-input-group-label>
                    <n-input v-model:value="project.url" placeholder="Project Url"/>
                </n-form-item-gi>
                <n-form-item-gi span="24" label="Description" path="description">
                    <n-input type="textarea" v-model:value="project.description" placeholder="Project Description"/>
                </n-form-item-gi>
                <n-form-item-gi>
                    <n-button @click="submitForm">
                        Submit
                    </n-button>
                </n-form-item-gi>
            </n-grid>
        </n-form>
    </n-card>
</template>

<script setup>
import {ref} from "vue";
import {useProjectStore} from "../../stores/project-store";
import {storeToRefs} from "pinia";

const formRef = ref(null)
const projectStore = useProjectStore();
const {project} = storeToRefs(projectStore)


const submitForm = (e) => {
    e.preventDefault();
    formRef.value?.validate((errors) => {
        if (!errors) {
            projectStore.create()
                .then(res => {
                    emit('onSubmit');
                });
        }
    });
}

const emit = defineEmits(['onSubmit'])

const rules = {
    name: {
        required: true,
        message: "Please enter project name",
        trigger: 'change'
    },
    url: {
        required: true,
        message: "Please enter project website url",
        trigger: 'change'
    },
    description: {
        required: false,
        message: "Pleas Enter Description of project",
    }
}

</script>

<style scoped>

</style>
