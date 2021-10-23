import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/404",
    name: "404",
    component: () => import("../views/404.vue"),
  },

  //Login and regiter routes 
  {
    path: "/register",
    name: "Register",
    component: () => import("../views/Auth/Register.vue"),
  },
  {
    path: "/login",
    name: "Login",
    component: () => import("../views/Auth/Login.vue"),
  },
  //finish

  //Index Routes
  {
    path: "/",
    name: "Index",
    component: () => import("../views/Index.vue"),
  },
  //Profile Routes
  {
    path: "/u/:slug",
    name: "Profile",
    component: () => import("../views/Profile/Profile.vue"),
  },
  {
    path: "/profile/setting",
    name: "ProfileSettings",
    component: () => import("../views/Profile/ProfileSettings.vue"),
  },
  {
    path: "/profile/changepassword",
    name: "ChangePassword",
    component: () => import("../views/Profile/ChangePassword.vue"),
  },

  //Adminpanel User
  {
    path: "/adminpanel/users",
    name: "AdminpanelUsers",
    component: () => import("../views/Adminpanel/User/List.vue"),
  },
  {
    path: "/adminpanel/users/:id/edit",
    name: "AdminpanelEditUser",
    component: () => import("../views/Adminpanel/User/Edit.vue"),
  },
  //Finish
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

//is auth middleware
router.beforeEach((to, _, next) => {
  const token = localStorage.getItem("token");
  const role = localStorage.getItem("role")
  const notAuthRoutes = ["Register", "Login"];
  const authReqRoutes = ["Index",'Profile','ProfileSettings','ChangePassword']
  const adminRoutes = ["AdminpanelUsers","AdminpanelEditUser"]
  if (!to.matched.length) {
    router.push({ name: "404" });
  } else if (notAuthRoutes.indexOf(to.name) > -1 && token) {
    router.push({ name: "Index" });
  } else if (authReqRoutes.indexOf(to.name) > -1 && !token) {
    router.push({ name: "Login" });
  } else if (adminRoutes.indexOf(to.name) > -1 && role != 1) {
    router.push({ name: "Index" });
  }else {
    next();
  }
});
export default router;
