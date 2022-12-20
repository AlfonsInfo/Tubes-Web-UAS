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
                    name : "LandingPage",
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

                },
                    //Halaman Setelah Login
                    {
                        path : "/Dashboard",
                        name : "Dashboard",
                        component: () => import("@/views/home/DashboardPage.vue"),
                    },
                    //Halaman Profil
                    {
                        path : "/Profile",
                        name : "Profile",
                        component: () => import("@/views/home/Profile/ProfilePage.vue"),
                    },
                    //Update Profile
                    {
                        path : "/UpdateProfile",
                        name : "UpdateProfile",
                        component: () => import("@/views/home/Profile/UpdateProfilePage.vue"),
                    },
                    //Pengambilan Matakuliah                            
                    {
                        path : "/PengambilanMatkul",
                        name : "PengambilanMatkul",
                        component:  () => import("@/views/home/KRS/indexPengambilanMatkulPage.vue"),
                    },
                    //Perizinan                            
                    {
                        path : "/perizinan",
                        name : "Perizinan",
                        component:  () => import("@/views/home/Perizinan/PerizinanPage.vue"),
                    },
                    {
                        path : "/create-perizinan",
                        name : "create-perizinan",
                        component:  () => import("@/views/home/Perizinan/CreatePerizinan.vue"),
                    },
                    //Spama
                    {
                        path : "/Spama",
                        name : "Spama",
                        component: () => import("@/views/spama/SpamaPage.vue"),
                    },
                    //Update Spama
                    {
                        path : "/UpdateSpama/:id",
                        name : "UpdateSpama",
                        component: () => import("@/views/spama/UpdateSpamaPage.vue"),
                    },
                    //Create Spama
                    {
                        path : "/CreateSpama/",
                        name : "CreateSpama",
                        component: () => import("@/views/spama/CreateSpamaPage.vue"),
                    },
                    // Bagian Admin
                    // Dashboard admin
                    {
                        path : "/Admin",
                        name : "Admin",
                        component: () => import("@/views/home/Admin/AdminPage.vue"),
                    },
                    {
                        path : "/perizinan-admin",
                        name : "perizinan-admin",
                        component: () => import("@/views/home/Admin/AdminPerizinan.vue"),
                    },
                    // Matkul
                    // Landing Matkul
                    {
                        path : "/tambah-matakuliah",
                        name : "tambah-matakuliah",
                        component: () => import("@/views/home/Admin/Matakuliah/CreateMatkulPage.vue"),
                    },
                    {
                        path : "/Matkul",
                        name : "Matkul",
                        component: () => import("@/views/home/Admin/Matakuliah/MatkulPage.vue"),
                    },
                    {
                        path : "/ubah-matakuliah/:id",
                        name : "ubah-matakuliah",
                        component: () => import("@/views/home/Admin/Matakuliah/updateMatkulPage.vue"),
                    },    

                    // Akhir bagian Admin
                     // Fitur Tambahan
                    {
                        path : "/about-us",
                        name : "AboutUs",
                        component: () => import("@/views/public/AboutUsPage.vue"),
                        children:[
                            {
                                path: "/about-us",
                                component: () => import("@/components/footer-component.vue"),
                            }
                        ], 
                    },
                {   
                    path : "/team",
                    name : "Team",
                    component: () => import("@/views/public/TeamPage.vue"),
                    children:[
                        {
                            path: "/team",
                            component : importComponent("footer-component"),}
                    ], 
                },
                {   
                    path : "/service",
                    name : "service",
                    component: () => import("@/views/public/ServicePage.vue"),
                    children:[
                        {
                            path: "/service",
                            component : importComponent("footer-component"),}
                    ], 
                },
                {   
                    path : "/contact-us",
                    name : "contact-us",
                    component: () => import("@/views/public/ContactUsPage.vue"),
                    children:[
                        {
                            path: "/contact-us",
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