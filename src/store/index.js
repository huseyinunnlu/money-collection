import { createStore } from "vuex";
import User from './Modules/User'
import Users from './Modules/Users'
import Opr from './Modules/Opr'
const store = createStore({
  modules: {
    User,
    Users,
    Opr
  },
});

export default store;
