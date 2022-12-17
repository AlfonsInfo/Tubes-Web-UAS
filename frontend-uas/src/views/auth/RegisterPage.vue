<template>
  <div>
    <div style="height: 500px">
      <v-sheet class="mx-auto mt-15" style="padding:50px" max-width="500" color="white" elevation="10">
        <form @submit.prevent="store">
          <h1>Register Akun</h1>
          <v-text-field
            v-model="registerAkun.nama"
            label="Nama Pengguna"
            required
          ></v-text-field>
          <v-text-field
            v-model="registerAkun.npm"
            label="NPM"
            required
          ></v-text-field>
          <v-text-field
            v-model="registerAkun.email"
            label="E-mail"
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
          <v-btn class="mr-1 blue white--text" type="submit"> submit </v-btn>
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




          // <label class="form-label"> Nama </label>
          // <input
          //   type="text"
          //   class="form-control"
          //   v-model="registerAkun.nama"
          //   placeholder="Masukan nama departemen"
          // />
          // <v-spacer></v-spacer>
          // <label class="form-label"> NPM </label>
          // <input
          //   type="text"
          //   class="form-control"
          //   v-model="registerAkun.npm"
          //   placeholder="Masukan NPM"
          // />
          // <v-spacer></v-spacer>
          // <label class="form-label"> Email </label>
          // <input
          //   type="text"
          //   class="form-control"
          //   v-model="registerAkun.email"
          //   placeholder="Masukan Email"
          // />
          // <v-spacer></v-spacer>
          // <label class="form-label"> Password </label>
          // <input
          //   type="text"
          //   class="form-control"
          //   v-model="registerAkun.password"
          //   placeholder="Masukan Password"
          // />
          // <v-spacer></v-spacer>