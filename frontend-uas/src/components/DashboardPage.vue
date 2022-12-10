<template>
    <div>
               <v-app-bar color="red lighten-3" dark>
            <v-app-bar-nav-icon @click="drawer = true" color="white"></v-app-bar-nav-icon>
            <v-spacer />
        </v-app-bar>
    <router-view></router-view>
    </div>
</template>

<script>
/* eslint-disable */
export default {
    name:"LandingPage", 

}
</script>
<style></style>
