/ eslint-disable */
<template>
  <div>
        <div style="height: 500px">
      <v-sheet class="mx-auto mt-15" style="padding:50px" max-width="500" color="white" elevation="10">
        <form @submit.prevent="Login">
          <h1>Login</h1>
          <v-text-field
            v-model="inputAkun.email"
            label="Email"
            required
          ></v-text-field>
        <v-text-field
            v-model="inputAkun.password"
            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[rules.required, rules.min]"
            :type="show1 ? 'text' : 'password'"
            label="Password"
            hint="At least 8 characters"
            counter
            @click:append="show1 = !show1"
          ></v-text-field>
          <!-- <a href="">Forget Password?</a> -->
          <v-btn class="mr-1 blue white--text mr-10" type="submit"> submit </v-btn>
          <v-btn class="blue--text" type=""> Forget Password? </v-btn>
          <v-spacer></v-spacer>
          <v-chip class="blue white--text mt-8 ms-10">Not Have a Account ? Register</v-chip>
          <v-divider class="mt-5"></v-divider>
          <p>Text mahasiswa login npm - pegawai login npp</p>
        </form>
      </v-sheet>
    </div>

    <router-view></router-view>
  </div>
</template>

<script>
/* eslint-disable */
import { reactive, ref } from "vue";
import router from "../../router";
// import { defaults } from "vue-router";
import axios from "axios";
// import Vue from 'vue/types/umd';
export default {
  data() {
    return {
      show1: false,
      rules: {
        required: (value) => !!value || "Required.",
        min: (v) => v.length >= 8 || "Min 8 characters",
      },
    };
  },
  setup() {
    const inputAkun = reactive({
      email: "",
      password: "",
    });
    const validation = ref([]);
    // const router = default/();
    // routerlink 
    function Login() {
      console.log("Fungsi Login");
      let email = inputAkun.email;
      let password = inputAkun.password;
      console.log("Data " , email, password);
      axios
        .post("http://127.0.0.1:8000/api/login", {
          email: email,
          password: password,
        })
        .then((response) => {
          let access_token =response.data.data.original.access_token;
          let id_user = response.data.data.original.user.id;
          let nama_user = response.data.data.original.user.nama;
          localStorage.setItem( 'token', access_token );
          localStorage.setItem( 'id_user',id_user );
          localStorage.setItem( 'nama_user',nama_user );
          window.dispatchEvent(new CustomEvent('tokenstorage-changed', {
            detail: {
              storage: localStorage.getItem('token'),
              storage2:  localStorage.getItem( 'id_user')

            }
          }));
          console.log(localStorage.getItem('token'));
          console.log( localStorage.getItem('id_user'));
          alert("Berhasil Login");
          router.push({ name: "Dashboard" });

        })
        .catch((error) => {
          console.log(error)
          console.log("Gagal");
          // validation.value = error.response.data;

        });
    }

    return {
      inputAkun,
      Login,
    };
  },
};
</script>

<style>
</style>
