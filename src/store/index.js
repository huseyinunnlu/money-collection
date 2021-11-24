import { createStore } from "vuex";
import User from './Modules/User'
import Users from './Modules/Users'
import Opr from './Modules/Opr'
import Money from './Modules/Money'
import Profile from './Modules/Profile'
import Collection from './Modules/Collection'
import Index from './Modules/Index/Index'
import Lang from './Modules/Lang/Lang.js'
const store = createStore({
  modules: {
    User,
    Users,
    Opr,
    Money,
    Profile,
    Index,
    Collection,
    Lang,
  },
});

export default store;
