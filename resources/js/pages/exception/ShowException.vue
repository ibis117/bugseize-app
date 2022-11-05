<template>
    <n-grid cols="4" x-gap="18" item-responsive responsive="screen">
        <n-grid-item span="1">
            <n-card>
                <div class="py-4">
                    <div class="font-semibold">Environment</div>
                    <span class="inline-block rounded px-2 py-1 bg-slate-200">{{ exception.environment }}</span>
                </div>
                <div class="py-4">
                    <div class="font-semibold">Method</div>
                    <span class="inline-block rounded px-2 py-1 bg-slate-200">{{ exception.method }}</span>
                </div>

                <div class="py-4">
                    <div class="font-semibold">URL</div>
                    <span class="inline-block rounded px-2 py-1 bg-slate-200">{{ exception.full_url }}</span>
                </div>

                <div class="py-4">
                    <div class="font-semibold">File</div>
                    <span class="inline-block rounded px-2 py-1 bg-slate-200">{{ exception.file }}</span>
                </div>

                <div class="py-4">
                    <div class="font-semibold">Line</div>
                    <span class="inline-block rounded px-2 py-1 bg-slate-200">{{ exception.line }}</span>
                </div>

                <div class="py-4">
                    <div class="font-semibold mb-2">Reported</div>
                    <span class="inline-block rounded px-2 py-1 bg-slate-200"> {{ moment(exception.created_at).fromNow()  }}</span>
                    <span class="inline-block rounded px-2 py-1 bg-slate-200 mt-1"> {{ moment(exception.created_at).format('lll') }}</span>
                </div>
            </n-card>
        </n-grid-item>

        <n-grid-item span="3">
            <n-card title="" style="min-height: 50px" >
                <n-tabs type="line" animated>
                    <n-tab-pane name="Exception" tab="Exception">
                        <show-code :data="exception.executor" :line="exception.line" />
                    </n-tab-pane>
                    <n-tab-pane name="Request" tab="Request">
                        <div class="">
                            <div class="mt-4 flex shadow-lg border rounded-lg">
                                <span class="p-4 bg-slate-100 w-1/5">HOST</span>
                                <span class="p-4">{{ exception.host }}</span>
                            </div>

                            <div class="mt-4 flex shadow-lg border rounded-lg">
                                <span class="p-4 bg-slate-200 w-1/5">CONNECTION</span>
                                <span class="p-4">{{ exception.connection }}</span>
                            </div>

                            <div class="mt-4 flex shadow-lg border rounded-lg">
                                <span class="p-4 bg-slate-200 w-1/5">ACCEPT</span>
                                <span class="p-4">{{ exception.connection }}</span>
                            </div>

                            <div class="mt-4 flex shadow-lg border rounded-lg">
                                <span class="p-4 bg-slate-200 w-1/5">ACCEPT-ENCODING</span>
                                <span class="p-4">{{ exception.connection }}</span>
                            </div>

                            <div class="mt-4 flex shadow-lg border rounded-lg">
                                <span class="p-4 bg-slate-200 w-1/5">ACCEPT-LANGUAGE</span>
                                <span class="p-4">{{ exception.connection }}</span>
                            </div>

                            <div class="mt-4 flex shadow-lg border rounded-lg">
                                <span class="p-4 bg-slate-200 w-1/5">COOKIE</span>
                                <span class="p-4">{{ exception.connection }}</span>
                            </div>
                        </div>
                    </n-tab-pane>
                    <n-tab-pane name="Server" tab="Server">
                        Server
                    </n-tab-pane>
                    <n-tab-pane name="Stack Trace" tab="Stack Trace">
                        <div v-for="trace in exception.errors.split('\n')">
                            <span class="block leading-loose p-2">{{ trace }}</span>
                        </div>
                    </n-tab-pane>
                </n-tabs>
            </n-card>
        </n-grid-item>
    </n-grid>
</template>

<script setup>
import {useExceptionStore} from "../../stores/exception-store";
import {storeToRefs} from "pinia";
import { AngleRight } from '@vicons/fa'
import moment from "moment";
import {useRoute} from "vue-router";
import ShowCode from "../../components/ShowCode.vue"

const route = useRoute()
const exceptionStore = useExceptionStore()
const {exception} = storeToRefs(exceptionStore)
const exception_id = route.params.id;
exceptionStore.show(exception_id);



</script>

<style scoped>

</style>
