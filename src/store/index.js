import { createStore } from "vuex";
import User from './Modules/User'
import Users from './Modules/Users'
const store = createStore({
  modules: {
    User,
    Users,
  },
});

export default store;
