import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Notifications from '@kyvg/vue3-notification'
import { appAxios } from "@/utils/appAxios"

const app = createApp(App);
app.use(store)
app.use(router)
app.use(Notifications)
app.config.globalProperties.$appAxios = appAxios;
app.mount('#app')
