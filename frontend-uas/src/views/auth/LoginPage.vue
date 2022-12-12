/ eslint-disable */
<template>
  <div>
        <div style="height: 500px">
      <v-sheet class="mx-auto mt-15" style="padding:50px" max-width="500" color="white" elevation="10">
        <form @submit.prevent="store">
          <h1>Login</h1>
          <v-text-field
            v-model="registerAkun.nama"
            label="Username"
            required
          ></v-text-field>
          <v-text-field
            v-model="registerAkun.password"
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
    const registerAkun = reactive({
      nama: "",
      npm: "",
      email: "",
      password: "",
    });
    const validation = ref([]);
    // const router = default/();

    function store() {
      console.log("Fungsi Store");
      let nama = registerAkun.nama;
      let npm = registerAkun.npm;
      let email = registerAkun.email;
      let password = registerAkun.password;
      axios
        .post("http://127.0.0.1:8000/api/register", {
          // http://127.0.0.1:8000/api/register
          nama: nama,
          npm: npm,
          email: email,
          password: password,
        })
        .then(() => {
          // console.log("Berhasil Register, Tunggu verifikasi");
          router.push({ name: "Login" });
          alert("Register Berhasil !!");
        })
        .catch((error) => {
          console.log("Gagal");
          alert("Registrasi Gagal !!");
          validation.value = error.response.data;
        });
    }

    return {
      registerAkun,
      store,
    };
  },
};
</script>

<style>
</style>
