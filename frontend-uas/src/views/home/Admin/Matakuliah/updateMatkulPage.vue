<template>
  <div>
    <div style="height: 500px">
      <v-sheet class="mx-auto mt-15" style="padding:50px" max-width="800" color="white" elevation="10">
        <form @submit.prevent="store">
          <h1>Update Matakuliah</h1>
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
import { onMounted, computed, reactive, ref } from "vue";
import router from "../../../../router";
// import { useRoute } from "vue-router";
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

      // const id = computed(()=> router.currentRoute.params.id)
      // console.log(id)
    const matakuliah = reactive({
      nama_matkul: "",
      kode_matkul: "",
      sks: "",
      kelas: "",
      dosen: "",
      sesi: "",
    });


    function selectMatkul(){
    const id = computed(()=> router.currentRoute.params.id)
    axios
        .get(`http://127.0.0.1:8000/api/matkuls/${id.value}`,{
            headers:{
              'Authorization' : `Bearer ${localStorage.getItem('token')}`
            }},)
        .then((response) => {
          console.log(response)
          matakuliah.nama_matkul = response.data.data.nama_matkul
          matakuliah.kode_matkul = response.data.data.kode_matkul
          matakuliah.sks = response.data.data.sks
          matakuliah.kelas = response.data.data.kelas
          matakuliah.dosen = response.data.data.dosen
          matakuliah.sesi = response.data.data.sesi
          console.log(response)
          })
        .catch((error)=>{
          console.log(error)
        })
    }
    const validation = ref([]);
      // const router = default/();
    // const id = router.
    // const id = router.params.id
    // console.log(id)
    function store() {
      console.log("Fungsi Store");
      let nama_matkul = matakuliah.nama_matkul;
      let kode_matkul = matakuliah.kode_matkul;
      let sks = matakuliah.sks;
      let kelas = matakuliah.kelas;
      let dosen = matakuliah.dosen;
      let sesi = matakuliah.sesi;
      const id = computed(()=> router.currentRoute.params.id)
      // // console.log(id)
      axios
        .put(`http://127.0.0.1:8000/api/matkuls/${id.value}`, {
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
          alert("Berhasil diubah !!");
          router.push({ name: "Matkul" });
        })
        .catch((error) => {
          console.log("Gagal");
          alert("Registrasi Gagal !!");
          validation.value = error.response.data;
        });
    }
    // console.log(localStorage.getItem('token'))
      onMounted(()=>{
      selectMatkul();
    })  
    return {
      matakuliah,
      store,
    };
    
  },
};
</script>
<style>
</style>