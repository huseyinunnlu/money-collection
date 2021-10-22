import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/404",
    name: "404",
    component: () => import("../views/404.vue"),
  },
  {
    path: "/",
    name: "Index",
    component: () => import("../views/Index.vue"),
  },
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
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

//is auth middleware
router.beforeEach((to, _, next) => {
  const token = localStorage.getItem("token");
  //const role = localStorage.getItem("role")
  const notAuthRoutes = ["Register", "Login"];
  const authReqRoutes = ["Index"]
  if (!to.matched.length) {
    router.push({ name: "404" });
  } else if (notAuthRoutes.indexOf(to.name) > -1 && token) {
    router.push({ name: "Index" });
  } else if (authReqRoutes.indexOf(to.name) > -1 && !token) {
    router.push({ name: "Login" });
  } else {
    next();
  }
});
export default router;
