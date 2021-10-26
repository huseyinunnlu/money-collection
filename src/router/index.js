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

  //Adminpanel Money operations

  {
    path: "/adminpanel/money",
    name: "AdminMoneyOperations",
    component: () => import("../views/Adminpanel/MoneyOperations/Index.vue"),
  },

  //Emissions
  {
    path: "/adminpanel/emissions",
    name: "AdminEmissions",
    component: () => import("../views/Adminpanel/MoneyOperations/Emissions/List.vue"),
  },
  {
    path: "/adminpanel/emission/:id/edit",
    name: "AdminEditEmission",
    component: () => import("../views/Adminpanel/MoneyOperations/Emissions/Edit.vue"),
  },

  //SCWPM

  {
    path: "/adminpanel/scwpm",
    name: "AdminSCWPM",
    component: () => import("../views/Adminpanel/MoneyOperations/SCWPM/List.vue"),
  },
  {
    path: "/adminpanel/emission/:id/edit",
    name: "AdminEditSCWPM",
    component: () => import("../views/Adminpanel/MoneyOperations/SCWPM/Edit.vue"),
  },
  
  //Kuphür
  
  {
    path: "/adminpanel/kuphur",
    name: "AdminKuphur",
    component: () => import("../views/Adminpanel/MoneyOperations/Kuphur/List.vue"),
  },
  {
    path: "/adminpanel/kuphur/:id/edit",
    name: "AdminEditKuphur",
    component: () => import("../views/Adminpanel/MoneyOperations/Kuphur/Edit.vue"),
  },
  
  //Print place

  {
    path: "/adminpanel/printplace",
    name: "AdminPrintPlace",
    component: () => import("../views/Adminpanel/MoneyOperations/PrintPlace/List.vue"),
  },
  {
    path: "/adminpanel/printplace/:id/edit",
    name: "AdminEditPrintPlace",
    component: () => import("../views/Adminpanel/MoneyOperations/PrintPlace/Edit.vue"),
  },

  //Tertip

  {
    path: "/adminpanel/tertip",
    name: "AdminTertip",
    component: () => import("../views/Adminpanel/MoneyOperations/Tertip/List.vue"),
  },
  {
    path: "/adminpanel/tertip/:id/edit",
    name: "AdminEditTertip",
    component: () => import("../views/Adminpanel/MoneyOperations/Tertip/Edit.vue"),
  },

  //Serie

  {
    path: "/adminpanel/serie",
    name: "AdminSerie",
    component: () => import("../views/Adminpanel/MoneyOperations/Serie/List.vue"),
  },
  {
    path: "/adminpanel/serie/:id/edit",
    name: "AdminEditSerie",
    component: () => import("../views/Adminpanel/MoneyOperations/Serie/Edit.vue"),
  },

  //Signature

  {
    path: "/adminpanel/signature",
    name: "AdminSignature",
    component: () => import("../views/Adminpanel/MoneyOperations/Signature/List.vue"),
  },
  {
    path: "/adminpanel/signature/:id/edit",
    name: "AdminEditSignature",
    component: () => import("../views/Adminpanel/MoneyOperations/Signature/Edit.vue"),
  },

  //Finish

  //Money

  //List 
  
  {
    path: "/money",
    name: "Money",
    component: () => import("../views/Moneys/List.vue"),
  },

  {
    path: "/money/:id/edit",
    name: "AdminMoneyEdit",
    component: () => import("../views/Moneys/Edit.vue"),
  },
  {
    path: "/money/:id/details",
    name: "AdminMoneyShow",
    component: () => import("../views/Moneys/Show.vue"),
  },

  //finish
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
  const authReqRoutes = ["Index",'Profile','ProfileSettings','ChangePassword',"Money"]
  const adminRoutes = ["AdminpanelUsers","AdminpanelEditUser","AdminMoneyOperations","AdminEmissions","AdminEditEmission","AdminSCWPM","AdminEditSCWPM","AdminKuphur","AdminEditKuphur","AdminPrintPlace","AdminEditPrintPlace","AdminTertip","AdminEditTertip","AdminEditSerie","AdminSerie","AdminEditSignature","AdminSignature","AdminMoneyEdit"]
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
