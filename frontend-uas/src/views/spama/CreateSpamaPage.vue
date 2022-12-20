<template>
  <div>
    <div style="height: 500px">
      <v-sheet class="mx-auto mt-15" style="padding:50px" max-width="800" color="white" elevation="10">
        <form @submit.prevent="createSpama">
          <h1>Tambah Poin Spama</h1>
          <v-text-field
            v-model="Spama.nama_kegiatan"
            label="Nama Kegiatan"
            required
          ></v-text-field>
          <v-text-field
            v-model="Spama.penyelenggara"
            label="Penyelenggara"
            required
          ></v-text-field>
          <v-textarea
            v-model="Spama.deskripsi_kegiatan"
            label="Deskripsi Kegiatan"
            required
          ></v-textarea>
          <v-menu v-model="menu2" :close-on-content-click="false" min-width="auto">
              <template v-slot:activator="{ on, attrs }">
                <v-text-field v-model="Spama.tanggal" label="Tanggal" v-bind="attrs" v-on="on"></v-text-field>
              </template>
                  <v-date-picker v-model="Spama.tanggal" @input="menu2 = false" required>
                  </v-date-picker>
            </v-menu>
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
import router from "../../router";
// import { defaults } from "vue-router";
import axios from "axios";

export default {
  menu2: false,
  data: () => ({
        reveal: false,
    }),
  setup() {
    const Spama = reactive({
      nama_kegiatan: "",
      penyelenggara: "",
      deskripsi_kegiatan: "",
      tanggal: null,
    });
    const validation = ref([]);
    // const router = default/();

    function createSpama() {
      console.log("Fungsi Create Spama");
      let nama_kegiatan = Spama.nama_kegiatan;
      let penyelenggara = Spama.penyelenggara;
      let deskripsi_kegiatan = Spama.deskripsi_kegiatan;
      let tanggal = Spama.tanggal;
      let id_mahasiswa = localStorage.getItem( 'id_user')
      axios
        .post("http://127.0.0.1:8000/api/spamas", {
          // http://127.0.0.1:8000/api/register
          nama_kegiatan: nama_kegiatan,
          penyelenggara : penyelenggara,
          deskripsi_kegiatan :deskripsi_kegiatan,
          tanggal : tanggal,
          id_mahasiswa: id_mahasiswa
        },{
             headers:{
              'Authorization' : `Bearer ${localStorage.getItem('token')}`
            }
        })
      .then(() => {
          // console.log("Berhasil Register, Tunggu verifikasi");
          alert("Berhasil Create");
          router.push({ name: "Spama" });
        })
        .catch((error) => {
          console.log(error.response.data)
          alert("Gagal Create");
          validation.value = error.response.data;
        });
    }
    // console.log(localStorage.getItem('token'))

    return {
      Spama,
      createSpama,
    };
    
  },
};
</script>
<style>
</style>