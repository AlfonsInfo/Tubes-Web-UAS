<template>
    <div>
        <v-navigation-drawer class="fullheight" width="256" v-model="drawer" absolute temporary color="grey lighten-5">
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title class="title">Layanan Atma Mini </v-list-item-title>
                    <v-list-item-subtitle>Menu</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <v-list dense nav>
                <v-list-item v-for="item in items" :key="item.title" link color="light-blue darken-4" tag="router-link" :to="item.to">
                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar color="blue" dark>
            <v-app-bar-nav-icon @click="drawer = true" color="white"></v-app-bar-nav-icon>
            <v-spacer />
            <v-toolbar-title class="me-10">Website Layanan Atma</v-toolbar-title>
        </v-app-bar>
    <router-view></router-view>
    </div>
</template>

<script>
/* eslint-disable */
export default {
    data()
    {
        return{
            drawer : false,
            items : [{title:"Login", to:"/"},
                    {title:"Register", to:"skdaosk"},
                    ],
        }
    }    
}
</script>
<style></style>
