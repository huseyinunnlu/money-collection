import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import Notifications from "@kyvg/vue3-notification";
import { appAxios } from "@/utils/appAxios";
// import { createI18n } from "vue-i18n/index";

// const i18n = createI18n({
//   locale: "tr",
//   fallbackLocale: "en",
//   messages: {
//     en: {
//       message: "Hello",
//     },
//     tr: {
//       message: "Merhaba",
//     },
//   },
// });
// i18n.locale = 'en'
const app = createApp(App);
app.use(store);
app.use(router);
app.use(Notifications);
// app.use(i18n);
app.config.globalProperties.$appAxios = appAxios;
app.mount("#app");
