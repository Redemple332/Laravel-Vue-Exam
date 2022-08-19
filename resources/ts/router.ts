import {
    createRouter,
    createWebHistory,
    RouteRecordRaw,
  } from "vue-router";
  
  import Home from "./vue/views/Home.vue";
  import About from "./vue/views/About.vue";
  import Login from "./vue/views/Login.vue";

  
  const routes: Array<RouteRecordRaw> = [
    {
      path: "/",
      name: "Home page",
      component: Home,
    },
    {
      path: "/about",
      name: "About page",
      component: About,
    },
    {
      path: "/login",
      name: "Login page",
      component: Login,
    }
  ];
  
  const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
  });
  
  export default router;