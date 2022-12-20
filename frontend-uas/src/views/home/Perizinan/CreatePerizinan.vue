<template>
    <div>
      <div style="height: 500px">
        <v-sheet class="mx-auto mt-15" style="padding:50px" max-width="800" color="white" elevation="10">
          <form @submit.prevent="createIzin">
            <h1>BUAT SURAT IZIN</h1>
            <!-- <v-text-field
              v-model="Izin.nama_mahasiswa"
              label="Nama Mahasiswa"
              required
            ></v-text-field> -->
            <v-textarea
              v-model="Izin.pesan"
              label="Alasan"
              required
            ></v-textarea>
            <v-menu v-model="menu1" :close-on-content-click="false" min-width="auto">
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field v-model="Izin.tanggal_mulai" label="Waktu Mulai Izin" v-bind="attrs" v-on="on"></v-text-field>
                </template>
                    <v-date-picker v-model="Izin.tanggal_mulai" @input="menu1 = false" required>
                    </v-date-picker>
              </v-menu>
              <v-menu v-model="menu2" :close-on-content-click="false" min-width="auto">
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field v-model="Izin.tanggal_selesai" label="Waktu Selesai Izin" v-bind="attrs" v-on="on"></v-text-field>
                </template>
                    <v-date-picker v-model="Izin.tanggal_selesai" @input="menu2 = false" required>
                    </v-date-picker>
              </v-menu>

              <v-text-field
              v-model="Izin.status"
              label="Status"
              required
            ></v-text-field>
            <v-btn class="mr-1 blue white--text" type="submit"> Simpan </v-btn>
          </form>
        </v-sheet>
      </div>
      <router-view></router-view>
    </div>
  </template>
  
  <script>
  /* eslint-disable */
  import { reactive, ref } from "vue";
  import router from "../../../router";
  // import { defaults } from "vue-router";
  import axios from "axios";
  
  export default {
      data: () => ({
        menu1: false,
        menu2: false,
          reveal: false,
      }),
    setup() {
      const Izin = reactive({
        nama_mahasiswa: "",
        pesan: "",
        tanggal_mulai: null,
        tanggal_selesai: null,
        status: "",
      });
      const validation = ref([]);
      // const router = default/();
  
      function createIzin() {
        console.log("Fungsi Create Izin");
        // let nama_mahasiswa = Izin.nama_mahasiswa;
        let pesan = Izin.pesan;
        let tanggal_mulai = Izin.tanggal_mulai;
        let tanggal_selesai = Izin.tanggal_selesai;
        let status = Izin.status;
        let id_mahasiswa = localStorage.getItem( 'id_user')
        axios
          .post("http://localhost:8000/api/perizinans", {
            id_user: localStorage.getItem('id_user'),
            // nama: nama_mahasiswa,
            pesan : pesan,
            tanggal_izin :tanggal_mulai,
            tanggal_selesai : tanggal_selesai,
            tipe : status,
          },{
               headers:{
                'Authorization' : `Bearer ${localStorage.getItem('token')}`
              }
          })
        .then(() => {
            // console.log("Berhasil Register, Tunggu verifikasi");
            alert("Berhasil Create");
            router.push({ name: "Perizinan" });
          })
          .catch((error) => {
            console.log(error)
            alert("Gagal Create");
            // validation.value = error.response.data;
          });
      }
  
      return {
        Izin,
        createIzin,
      };
      
    },
  };
  </script>
  <style>
  </style>