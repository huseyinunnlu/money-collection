// import { appAxios } from "@/utils/appAxios";
// import CryptoJs from "crypto-js";
// import { notify } from "@kyvg/vue3-notification";
// import router from "../../router";

export default {
    state: {
      emissions: [],
      scwpms: [],
      kuphur: [],
      printPlaces: [],
      tertip: [],
      series: [],
      signatures: [],
    },
    getters: {
          _Emissions: (state) => state.emissions,
          _scwpms: (state) => state.scwpms,
          _kuphur: (state) => state.kuphur,
          _printPlaces: (state) => state.printPlaces,
          _tertip: (state) => state.tertip,
          _series : (state) => state.series,
          _signatures : (state) => state.signatures,
    },
    actions: {},
    mutations: {},
  };
  