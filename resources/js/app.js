import {createApp, markRaw} from 'vue'
import { createPinia } from 'pinia'
import naive from 'naive-ui'
import App from './App.vue'
import router from './router'
import PerfectScrollbar from 'vue3-perfect-scrollbar'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

import 'vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css'
import '../css/app.css'
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

const app = createApp(App)

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate)
pinia.use(({store}) => {
    store.router = markRaw(router)
})
app.component('EasyDataTable', Vue3EasyDataTable)
app.use(naive)
app.use(pinia)
app.use(router)
app.use(PerfectScrollbar)
app.mount('#app')
