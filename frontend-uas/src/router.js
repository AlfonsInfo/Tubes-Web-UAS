import Vue from 'vue'
import VueRouter from 'vue-router'
import { component } from 'vue/types/umd';
import router from './router';


Vue.use(VueRouter)

function importComponent(path)
{
    return ()=>import(`./components/${path}.vue`)
}

const routes = new VueRouter ({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "admin",
            component: importComponent("Dashboard"),
            children : [
                {
                    // Landing Page
                    path : "/",
                    name :  "Root",
                    component : importComponent("LandingPage"),                        
                },
                    //Login
                {
                    path : "/",
                    name : "Login",
                    component : importComponent("LoginPage")    
                },
                    //Register
                    {
                        path : "/",
                        name : "Register",
                        component : importComponent("RegisterPage")    
                },
            ]
        }
    ],

});


export default router;