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
            component: importComponent("dashboard-component"),
            children : [
                {
                    // Landing Page
                    path : "/",
                    component: () => import("@/views/auth/LandingPage.vue"),
                    children:[
                        {
                            path: "/",
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
                            path: "/Login",
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
                                component : importComponent("footer-component"),}
                        ], 
                },
                    {
                        path : "/about-us",
                        name : "AboutUs",
                        component: () => import("@/views/public/AboutUsPage.vue"),
                        children:[
                            {
                                path: "/Register",
                                component : importComponent("footer-component"),}
                        ], 
                },


            ]
        },
        {
            path : '/verify-email',
            name : 'verifyEmail',
            component : () => import("@/views/auth/VerifyEmailPage.vue")
        }
    ],

    
});
export default router;