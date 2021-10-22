import { createStore } from "vuex";
import User from './Modules/User'
const store = createStore({
  modules: {
    User,
  },
});

export default store;
