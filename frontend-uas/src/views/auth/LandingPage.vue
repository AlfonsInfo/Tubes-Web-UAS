<template>
  <div>
    <!-- Pesan Selamat Datang -->
    <div class="mt-5 ms-11">
      <h1>Selamat Datang di Situs Layanan Online Universitas !!</h1>
    </div>
 <v-card
    class="mx-auto my-12"
    max-width="700"
    
  >
    <template slot="progress">
      <v-progress-linear
        color="deep-purple"
        height="10"
        indeterminate
      ></v-progress-linear>
    </template>
    <v-img
      height="350"
      src="https://www.responsiveclassroom.org/wp-content/uploads/2016/04/DSC_2388-1024x682.jpg"
    ></v-img>
    <v-card-title>E Service Universitas </v-card-title>
    <v-card-text>
      <v-row
        align="center"
        class="mx-0">
      </v-row>
      <div class="my-4 text-subtitle-1">
        Layanan Elektronik
      </div>
      <div>Layanan Elektronik Untuk Pengambilan Kelas, Perijinan dan Pencatatan Poin Keaktifan.</div>
    </v-card-text>
    <v-divider class="mx-4"></v-divider>

  </v-card>
    <router-view></router-view>
  </div>
</template>

<script>
/* eslint-disable */

export default {
  data() {
    return {
      loading: false,
      links: [
        { title: "Home" },
        { title: "About Us" },
        { title: "Team" },
        { title: "Service" },
        { title: "Contact Us" },
      ],
    };
  },
};
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
                    {{ new Date().getFullYear() }} ??? <strong>Vuetify</strong>
                </v-card-text>
                </v-card>
            </v-footer> -->