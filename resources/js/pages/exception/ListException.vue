<template>
    <n-card title="Exceptions">
        <n-grid cols="12" x-gap="24" class="m-2" v-if="props.showFilter">
            <n-grid-item span="2">
                <n-select
                    v-model:value="filter.project_id"
                    :options="projects"
                    label-field="name"
                    value-field="id" />
            </n-grid-item>
        </n-grid>
        <n-list hoverable clickable>
                <n-list-item v-for="(exception,indexException) in exceptions" :key="indexException" @click="onShow(exception)">
                    <n-space justify="space-between" align="center">
                        <n-thing :title="exception.exception" content-style="margin-top: 10px;">
                            <template #description>
                                <n-space size="small" style="margin-top: 4px">
                                    <div>
                                        <n-tag :bordered="false" type="info" size="small">
                                            {{ exception.status.toUpperCase() }}
                                        </n-tag>
                                        {{ moment(exception.created_at).fromNow()  }}
                                    </div>
                                </n-space>
                            </template>
                        </n-thing>

                        <n-thing>
                            <n-icon size="20">
                                <angle-right />
                            </n-icon>
                        </n-thing>
                    </n-space>
                </n-list-item>
        </n-list>
    </n-card>
</template>

<script setup>
import {useExceptionStore} from "../../stores/exception-store";
import {storeToRefs} from "pinia";
import { AngleRight } from '@vicons/fa'
import moment from "moment";
import {useRouter} from "vue-router";
import {watch} from "vue";

const exceptionStore = useExceptionStore()
const {exceptions, projects, filter} = storeToRefs(exceptionStore)
const router = useRouter();
const props = defineProps({
    id: {
        type: String,
        default: null
    },
    showFilter: {
        type: Boolean,
        default: true
    }
})
if (props.id) {
    exceptionStore.filter.project_id = props.id
}

if (props.showFilter) {
    exceptionStore.projectList();
}
exceptionStore.list();

watch(
    exceptionStore.filter,
    (filter) => {
        exceptionStore.list();
    }
)

const onShow = (exception) => {
    router.push(`/exception/${exception.id}`)
}

</script>

<style scoped>


</style>
