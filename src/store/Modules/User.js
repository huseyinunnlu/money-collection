// import { appAxios } from "@/utils/appAxios";
// import CryptoJs from "crypto-js";
// import { notify } from "@kyvg/vue3-notification";
// import router from "../../router";

export default {
    state: {
      user: [],
      isAuth: false,
    },
    getters: {
          _User: (state) => state.user,
          _IsAuth: (state) => state.isAuth,
    },
    actions: {},
    mutations: {},
  };
  