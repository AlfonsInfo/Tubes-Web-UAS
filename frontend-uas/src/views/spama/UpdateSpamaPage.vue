<template>
  <div>
      <div style="height: 500px">
        <v-sheet class="mx-auto mt-15" style="padding:50px" max-width="1000" color="white" elevation="10">
          <form @submit.prevent="updateSpama">
            <h1>Update Data Spama</h1>
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
  import axios from 'axios'
  import { onMounted, reactive, ref, computed} from 'vue';
  import router from "../../router";
  
  export default {
    menu2: false,
    data: () => ({
        reveal: false,
      }),
    setup()
    {
      const Spama = reactive({
          nama_kegiatan: "",
          penyelenggara:"",
          deskripsi_kegiatan:"",
          tanggal:null,
      });
  
      function userSpama(){
        let id = localStorage.getItem( 'id_user')
        let token =  localStorage.getItem('token')
        console.log("token :" + token)
      axios
          .get(`http://127.0.0.1:8000/api/spamas/${id}`,{
              headers:{
                'Authorization' : `Bearer ${token}`
              }},)
          .then((response) => {
            Spama.nama_kegiatan = response.data.data.nama_kegiatan
            Spama.penyelenggara = response.data.data.penyelenggara
            Spama.deskripsi_kegiatan = response.data.data.deskripsi_kegiatan
            Spama.tanggal = response.data.data.tanggal
            console.log(response)
            })
          .catch((error)=>{
            console.log(error.response.data)
          })
      }
  
      function updateSpama() {
            let nama_kegiatan = Spama.nama_kegiatan;
            let penyelenggara = Spama.penyelenggara;
            let deskripsi_kegiatan = Spama.deskripsi_kegiatan;
            let tanggal = Spama.tanggal;
              
              // let id = localStorage.getItem( 'id_user')
              const id = computed(()=> router.currentRoute.params.id)
              let token = localStorage.getItem( 'token')
              axios
                  .put(`http://localhost:8000/api/spamas/${id.value}`,{ 
                      nama_kegiatan: nama_kegiatan,
                      penyelenggara : penyelenggara,
                      deskripsi_kegiatan :deskripsi_kegiatan,
                      tanggal : tanggal,
                  },{
              headers:{
                'Authorization' : `Bearer ${token}`
              }})
                  .then((response) => {
                    console.log(response)
                    console.log("Sukses")   
                    alert("Berhasil Update");
                    router.push({ name: "Spama"});
  
                  })
                  .catch((error) => {
                    console.log(error.response.data)
                      // validation.value = error.response.data;
                  });
          }
  
      onMounted(()=>{
        userSpama();
      })  
  
      return{
        Spama,
        updateSpama
  
      }
    }
  
  }
  </script>
  
  <style>
  
  </style>
  