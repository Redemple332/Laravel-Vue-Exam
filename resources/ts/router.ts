import {
    createRouter,
    createWebHistory,
    RouteRecordRaw,
  } from "vue-router";
  
  import Home from "./vue/views/Home.vue";
  import About from "./vue/views/About.vue";
  import Login from "./vue/views/Login.vue";
  import axios from "axios"
  
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
      beforeEnter: (to, form, next) =>{
        axios.get('/api/athenticated').then(()=>{
            next()
        }).catch(()=>{
            return next({ name: 'Login page'})
        })
      }
    },
    {
      path: "/login",
      name: "Login page",
      component: Login
     
    }
  ];
  
  const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
  });
  
  export default router;