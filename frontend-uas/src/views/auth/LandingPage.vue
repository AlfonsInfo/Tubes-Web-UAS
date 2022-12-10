<template>
    <div>
        <!-- Pesan Selamat Datang -->
        <div class="mt-5 ms-11">
        <h1>Selamat Datang di Situs Layanan Online Universitas !!</h1>
        </div>
        <!-- Akhir Pesan Selamat Datang -->
        <!-- Card -> Konten Landing Page-->
        <v-card :loading="loading" class="mx-auto my-12 " max-width="374">
            <v-img height="250" src="https://miro.medium.com/max/900/1*OrjCKmou1jT4It5so5gvOA.jpeg"></v-img>
            <v-card-title><strong>Panduan Menggunakan Layanan</strong></v-card-title>
            <!-- <v-card-title><strong>Pengumuman Ujian Akhir Semester</strong></v-card-title> -->
                <v-card-text>
                    <v-row align="center" class="mx-0">
                        <v-progress-linear value="60" height="15" striped color="deep-orange">
                            <template v-slot:default="{ value }">
                                <strong>{{ Math.ceil(value) }}</strong>
                            </template>
                        </v-progress-linear>
                    </v-row>
                    <div class="my-4 text-subtitle-1">Web programming refers to the writing, markup and coding involved in web development. The most common languages used for web programming are HTML, Javascript, and php</div>
                </v-card-text>
                <v-divider class="mx-4"></v-divider>
                <v-card-title>Schedule</v-card-title>
                <v-card-text>
                    <p>KSADOKSAOD AKSDOKSAD KDKSA </p>
                </v-card-text>
                <v-card-actions>
                <!-- @click="reser" -->
                <v-btn color="deep-purple lighten" text> Choose </v-btn>
                </v-card-actions>
        </v-card>
        <!-- Akhir dari Konten di card -->
            <router-view></router-view>

    </div>
</template>

<script>
/* eslint-disable */

export default {
    data()
    {
        return{
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



         <!-- <v-footer
                dark
                padless
            >
                <v-card
                flat
                tile
                class="indigo lighten-1 white--text text-center"
                >
                <v-card-text>
                    <v-btn
                    v-for="icon in icons"
                    :key="icon"
                    class="mx-4 white--text"
                    icon
                    >
                    <v-icon size="24px">
                        {{ icon }}
                    </v-icon>
                    </v-btn>
                </v-card-text>

                <v-card-text class="white--text pt-0">
                    Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo interdum. Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                </v-card-text>

                <v-divider></v-divider>

                <v-card-text class="white--text">
                    {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
                </v-card-text>
                </v-card>
            </v-footer> -->