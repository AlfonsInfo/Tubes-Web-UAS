<template>
<div>
    <div style="height: 500px">
      <v-sheet class="mx-auto mt-15" style="padding:50px" max-width="1000" color="white" elevation="10">
        <form @submit.prevent="updateSpama">
          <h1>Update Data Spama</h1>
          <v-text-field
            v-model="spama.nama_kegiatan"
            label="Nama Kegiatan"
            required
          ></v-text-field>
          <v-text-field
            v-model="spama.penyelenggara"
            label="Penyelenggara"
            required
          ></v-text-field>
          <v-textarea
            v-model="spama.deskripsi_kegiatan"
            label="Deskrpsi Kegiatan"
            required
          ></v-textarea>
          <v-menu v-model="menu2" :close-on-content-click="false" min-width="auto">
              <template v-slot:activator="{ on, attrs }">
                <v-text-field v-model="spama.tanggal" label="Tanggal" v-bind="attrs" v-on="on"></v-text-field>
              </template>
                  <v-date-picker v-model="spama.tanggal" @input="menu2 = false">
                  </v-date-picker>
            </v-menu>
          <!-- <v-text-field
            v-model="User.password"
            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[rules.required, rules.min]"
            :type="show1 ? 'text' : 'password'"
            label="Password"
            hint="At least 8 characters"
            counter
            @click:append="show1 = !show1"
          ></v-text-field> -->
          <!-- <v-btn class="primary mr-5" type=""> Ubah Password </v-btn> -->
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
import { onMounted, reactive, ref } from 'vue';
import router from "../../router";

export default {
  menu2: false,
  data: () => ({
      reveal: false,
    }),
  setup()
  {
    const spama = reactive({
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
        .get(`http://localhost:8000/api/spamas${id}`,{
            headers:{
              'Authorization' : `Bearer ${token}`
            }},)
        .then((response) => {
          spama.nama_kegiatan = response.data.data.nama_kegiatan
          spama.penyelenggara = response.data.data.penyelenggara
          spama.deskripsi_kegiatan = response.data.data.deskripsi_kegiatan
          spama.tanggal = response.data.data.tanggal
          console.log(response)
          })
        .catch((error)=>{
          console.log(error)
        })
    }

    function updateSpama() {
            let nama_kegiatan = spama.nama_kegiatan;
            let penyelenggara = spama.penyelenggara;
            let deskripsi_kegiatan = spama.deskripsi_kegiatan;
            let tanggal = spama.tanggal;
            
            let id = localStorage.getItem( 'id_user')
            let token = localStorage.getItem( 'token')
            axios
                .put("http://localhost:8000/api/spamas/" + id,{ 
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
                  router.push("Spama");

                })
                .catch((error) => {
                  console.log(error)
                    // validation.value = error.response.data;
                });
        }

    onMounted(()=>{
      userSpama();
    })  

    return{
      spama,
      updateSpama

    }
  }

}
</script>

<style>

</style>
