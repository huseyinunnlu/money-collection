// import { appAxios } from "@/utils/appAxios";
// import CryptoJs from "crypto-js";
// import { notify } from "@kyvg/vue3-notification";
// import router from "../../router";

export default {
    state: {
        lastCollected:[],
    },
    getters:{
        _LastCollected: (state) => state.lastCollected
    }
}