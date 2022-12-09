/* eslint-disable */
import Vue from 'vue'
import  VueRouter from 'vue-router'
// import { component } from 'vue/types/umd';

Vue.use(VueRouter)
function importComponent(path)
{
    return ()=>import(`./components/${path}.vue`)
}
const router = new VueRouter ({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "",
            component: importComponent("DashboardPage"),
            children : [
                {
                    // Landing Page
                    path : "/",
                    name :  "Root",
                    component : importComponent("LandingPage"),                        
                },
                //     //Login
                // {
                //     path : "/",
                //     name : "Login",
                //     component : importComponent("LoginPage")    
                // },
                //     //Register
                //     {
                //         path : "/",
                //         name : "Register",
                //         component : importComponent("RegisterPage")    
                // },
            ]
        }
    ],
});
// const router  = createRouter({
//     history: createWebHistory(),
//     routes
// })
export default router;