// import { appAxios } from "@/utils/appAxios";
// import CryptoJs from "crypto-js";
// import { notify } from "@kyvg/vue3-notification";
// import router from "../../router";

export default {
    state: {
        profile:[],
        collecion:[],
    },
    getters:{
        _Profile : (state) => state.profile,
        _Collection : (state) => state.collection
    }
}