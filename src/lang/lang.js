import { createI18n } from "vue-i18n/index";
import store from "@/store/index.js";
import en from "./en.json"
import tr from "./tr.json"

let selectedLang = store.getters._SelLang;

if(!selectedLang) {
    selectedLang = navigator.language
}

export const i18n = createI18n({
    locale: selectedLang,
    legacy:false,
    fallbackLocale: 'en-US',
    globalInjection: true,
    messages: {
        "en-US":en,
        "tr":tr,
    }
});

