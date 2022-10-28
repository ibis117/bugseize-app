import { createApp } from 'vue'
import { createPinia } from 'pinia'
import naive from 'naive-ui'

import App from './App.vue'
import router from './router'
import PerfectScrollbar from 'vue3-perfect-scrollbar'
import 'vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css'

import '../css/app.css'


const app = createApp(App)

app.use(naive)
app.use(createPinia())
app.use(router)
app.use(PerfectScrollbar)
app.mount('#app')
