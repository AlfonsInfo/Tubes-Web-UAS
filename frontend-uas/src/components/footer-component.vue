<template>
  <v-footer color="primary lighten-1" padless>
    <v-row justify="center" no-gutters>
      <v-btn
        v-for="link in links"
        :key="link.id"
        color="white"
        text
        rounded
        class="my-2"
        :to="link.to"
        >{{ link.title }}</v-btn
      >
      <v-col class="primary lighten-1 py-4 text-center white--text" cols="12">
        {{ new Date().getFullYear() }} — <strong>Kelompok H Web B</strong>
      </v-col>
    </v-row>
  </v-footer>
</template>

<script>
/* eslint-disable */

export default {
  data() {
    return {
      links: [
        { id: 1, title: "Home", to: "/" },
        { id: 2, title: "About Us", to: "about-us" },
        { id: 3, title: "Team", to: "team" },
        { id: 4, title: "Service", to: "service" },
        { id: 5, title: "Contact Us", to: "contact-us" },
      ],
    };
  },
};
</script>
        
        <style>
</style>