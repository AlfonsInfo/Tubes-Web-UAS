<template>
    <v-footer color="primary lighten-1" padless>
        <v-row justify="center" no-gutters>
        <v-btn v-for="link in links" :key="link" color="white" text rounded class="my-2">{{ link.title  }}</v-btn>
            <v-col class="primary lighten-1 py-4 text-center white--text" cols="12">
                {{ new Date().getFullYear() }} — <strong>Kelompok H Web B</strong>
            </v-col>
        </v-row>
    </v-footer>
</template>

<script>
/* eslint-disable */

export default {
    data()
    {
        return {
            links:[
                {title :'Home'},
                {title :'About Us'},
                {title :'Team'},
                {title :'Service'},
                {title :'Contact Us'},
                ]
        }
    }
}
</script>
        
        <style>
        
        </style>