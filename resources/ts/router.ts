import {
    createRouter,
    createWebHistory,
    RouteRecordRaw,
  } from "vue-router";
  
  import Home from "./vue/views/Home.vue";
  import About from "./vue/views/About.vue";
  import Login from "./vue/views/Login.vue";
  import Role from "./vue/views/Role.vue";
  import UserForm from "./vue/views/UserForm.vue";


  import axios from "axios"
  
  const routes: Array<RouteRecordRaw> = [
    {
      path: "/",
      name: "Home page",
      component: Home,
      beforeEnter: (to, form, next) =>{
        axios.get('/api/athenticated').then(()=>{
            next()
        }).catch(()=>{
            return next({ name: 'Login page'})
        })
      }
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
      beforeEnter: (to, form, next) =>{
        axios.get('/api/athenticated').then(()=>{
          return next({ name: 'Home page'})
        }).catch(()=>{
           return next()
        })
      }   
    },
    {
      path: "/roles",
      name: "Role page",
      component: Role,
      beforeEnter: (to, form, next) =>{
        axios.get('/api/athenticated').then(()=>{
            next()
        }).catch(()=>{
            return next({ name: 'Login page'})
        })
      }
    },
  ];
  
  const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
  });
  
  export default router;