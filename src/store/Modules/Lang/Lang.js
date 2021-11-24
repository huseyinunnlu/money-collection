export default {
  state: {
    langs: [
      {
        value: "tr",
        text: "Türkçe",
      },
      {
        value: "en-US",
        text: "English",
      },
    ],
    lang: localStorage.getItem("lang"),
  },
  getters: {
    _Langs: (state) => state.langs,
    _SelLang: (state) => state.lang
  },
};
