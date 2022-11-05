<template>
    <n-card title="Exceptions">
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

const exceptionStore = useExceptionStore()
const {exceptions} = storeToRefs(exceptionStore)
const router = useRouter();
const props = defineProps({
    id: {
        type: String,
        default: null
    }
})

exceptionStore.list({id: props.id});

const onShow = (exception) => {
    router.push(`/exception/${exception.id}`)
}

</script>

<style scoped>


</style>
