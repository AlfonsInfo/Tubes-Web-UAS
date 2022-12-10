/* eslint-disable */
import Vue from 'vue'
import  VueRouter from 'vue-router'


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
            name: "dashboard",
            component: importComponent("dashboard-component"),
            children : [
                {
                    // Landing Page
                    path : "/",
                    name :  "Root",
                    component: () => import("@/views/auth/LandingPage.vue"),
                    children:[
                        {
                            path: "/",
                            name :"footer",
                            component : importComponent("footer-component"),}
                    ],                        
                },
                    //Login
                {
                    path : "/Login",
                    name : "Login",
                    component: () => import("@/views/auth/LoginPage.vue"),
                    children:[
                        {
                            path: "/",
                            name :"footer",
                            component : importComponent("footer-component"),}
                    ], 
                },
                    //Register
                    {
                        path : "/Register",
                        name : "Register",
                        component: () => import("@/views/auth/RegisterPage.vue"),
                        children:[
                            {
                                path: "/Register",
                                name :"footer",
                                component : importComponent("footer-component"),}
                        ], 
                },
            ]
        }
    ],
});
export default router;