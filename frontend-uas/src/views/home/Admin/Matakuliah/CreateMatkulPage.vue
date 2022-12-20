<template>
  <div>
    <div style="height: 500px">
      <v-sheet class="mx-auto mt-15" style="padding:50px" max-width="800" color="white" elevation="10">
        <form @submit.prevent="store">
          <h1>Tambah Matakuliah</h1>
          <v-text-field
            v-model="matakuliah.nama_matkul"
            label="Nama Mata Kuliah"
            required
          ></v-text-field>
          <v-text-field
            v-model="matakuliah.kode_matkul"
            label="Kode Matakuliah"
            required
          ></v-text-field>
          <v-text-field
            v-model="matakuliah.sks"
            label="SKS"
            required
          ></v-text-field>
          <v-text-field
            v-model="matakuliah.kelas"
            label="Kelas"
            required
          ></v-text-field>
          <v-text-field
            v-model="matakuliah.dosen"
            label="Dosen"
            required
          ></v-text-field>
          <v-text-field
            v-model="matakuliah.sesi"
            label="Sesi"
            required
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
import router from "../../../../router";
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
    const matakuliah = reactive({
      nama_matkul: "",
      kode_matkul: "",
      sks: "",
      kelas: "",
      dosen: "",
      sesi: "",
    });
    const validation = ref([]);
    // const router = default/();

    function store() {
      console.log("Fungsi Store");
      let nama_matkul = matakuliah.nama_matkul;
      let kode_matkul = matakuliah.kode_matkul;
      let sks = matakuliah.sks;
      let kelas = matakuliah.kelas;
      let dosen = matakuliah.dosen;
      let sesi = matakuliah.sesi;
      axios
        .post("http://127.0.0.1:8000/api/matkuls", {
          // http://127.0.0.1:8000/api/register
          nama_matkul: nama_matkul,
          kode_matkul: kode_matkul,
          sks: Number(sks),
          kelas: kelas,
          dosen: dosen,
          sesi: Number(sesi),
        },{
             headers:{
              'Authorization' : `Bearer ${localStorage.getItem('token')}`
            }
        })
      .then(() => {
          // console.log("Berhasil Register, Tunggu verifikasi");
          alert("Berhasil ditambahkan !!");
          router.push({ name: "Matkul" });
        })
        .catch((error) => {
          console.log("Gagal");
          alert("Registrasi Gagal !!");
          validation.value = error.response.data;
        });
    }
    // console.log(localStorage.getItem('token'))

    return {
      matakuliah,
      store,
    };
    
  },
};
</script>
<style>
</style>