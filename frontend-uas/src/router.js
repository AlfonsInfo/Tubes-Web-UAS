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
                    component : importComponent("LandingPage"),                        
                },
                    //Login
                {
                    path : "/Login",
                    name : "Login",
                    component : importComponent("LoginPage")    
                },
                    //Register
                    {
                        path : "/Register",
                        name : "Register",
                        component : importComponent("RegisterPage")    
                },
            ]
        }
    ],
});
export default router;