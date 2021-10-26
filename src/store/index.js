import { createStore } from "vuex";
import User from './Modules/User'
import Users from './Modules/Users'
import Opr from './Modules/Opr'
import Money from './Modules/Money'
const store = createStore({
  modules: {
    User,
    Users,
    Opr,
    Money,
  },
});

export default store;
