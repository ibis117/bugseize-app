<template>
    <n-card title="Issues">
        <n-list hoverable clickable>
            <n-list-item v-for="(issue,indexException) in issues" :key="indexException">
                <n-space justify="space-between" align="center">
                    <n-thing :title="issue.exception" content-style="margin-top: 10px;">
                        <template #description>
                            <n-space size="small" style="margin-top: 4px">
                                <div>
                                    <n-tag :bordered="false" type="info" size="small">
                                        {{ issue.status.toUpperCase() }}
                                    </n-tag>
                                    <n-tag :bordered="false" type="info" size="small">
                                        Occurrence
                                        <n-badge :value="issue.exceptions_count" />
                                    </n-tag>
                                    {{ moment(issue.last_occured_at).fromNow() }}
                                </div>
                            </n-space>
                        </template>
                    </n-thing>

                    <n-thing>
                        <n-icon size="20">
                            <angle-right/>
                        </n-icon>
                    </n-thing>
                </n-space>
            </n-list-item>
        </n-list>
    </n-card>
</template>

<script setup>
import {useIssueStore} from "../../stores/issue-store";
import {storeToRefs} from "pinia";
import { AngleRight } from '@vicons/fa'
import moment from "moment";
import {useRouter} from "vue-router";

const issueStore = useIssueStore()
const {issues} = storeToRefs(issueStore)
const router = useRouter();
const props = defineProps({
    id: {
        type: String,
        default: null
    }
})

issueStore.list({id: props.id});

const onShow = (issue) => {
    router.push(`/issue/${issue.id}`)
}



</script>

<style scoped>

</style>
