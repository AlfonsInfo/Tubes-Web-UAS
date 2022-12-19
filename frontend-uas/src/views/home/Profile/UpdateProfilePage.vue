<template>
<div>
    <div style="height: 500px">
      <v-sheet class="mx-auto mt-15" style="padding:50px" max-width="1000" color="white" elevation="10">
        <form @submit.prevent="updateProfile">
          <h1>Update Data Profile</h1>
          <v-text-field readonly
            v-model="User.nama"
            label="Nama Pengguna"
            required
          ></v-text-field>
          <v-text-field readonly
            v-model="User.npm"
            label="NPM"
            required
          ></v-text-field>
          <v-text-field readonly
            v-model="User.email"
            label="E-mail"
            required
          ></v-text-field>
          <h3>Lengkapi Data</h3>
          <v-text-field 
            v-model="User.TTL"
            label="Tempat, Tanggal lahir"
            required
          ></v-text-field>
          <v-text-field 
            v-model="User.alamat"
            label="Alamat"
            required
          ></v-text-field>
          <v-text-field 
            v-model="User.agama"
            label="Agama"
            required
          ></v-text-field>
          <v-text-field 
            v-model="User.asal_sma"
            label="Asal SMA"
            required
          ></v-text-field>
          <v-text-field 
            v-model="User.nama_orang_tua"
            label="Nama Orang Tua"
            required
          ></v-text-field>
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
import router from "../../../router";

export default {
  data: () => ({
      reveal: false,
    }),
  setup()
  {
    const User = reactive({
        email: "",
        nama:"",
        npm:"",
        jumlah_sks:"",
        TTL:"",
        alamat:"",
        agama:"",
        asal_sma:"",
        nama_orang_tua:""
    });

    function userProfile(){
      let id = localStorage.getItem( 'id_user')
      let token =  localStorage.getItem('token')
      console.log("token :" + token)
    axios
        .get(`http://127.0.0.1:8000/api/User/${id}`,{
            headers:{
              'Authorization' : `Bearer ${token}`
            }},)
        .then((response) => {
          User.nama = response.data.data.nama
          User.npm = response.data.data.npm
          User.jumlah_sks = response.data.data.jumlah_sks
          User.email = response.data.data.email
          console.log(response)
          })
        .catch((error)=>{
          console.log(error)
        })
    }

    function updateProfile() {
            let nama = User.nama;
            let npm = User.npm;
            let email = User.email;
            let TTL = User.TTL;
            let alamat = User.alamat;
            let agama = User.agama
            let asal_sma = User.asal_sma;
            let nama_orang_tua = User.nama_orang_tua;
            
            let id = localStorage.getItem( 'id_user')
            let token = localStorage.getItem( 'token')
            axios
                .put("http://localhost:8000/api/User/" + id,{ 
                      nama : nama,
                      npm : npm,
                      email :email,
                      TTL : TTL,
                      alamat : alamat,
                      agama : agama,
                      asal_sma : asal_sma,
                      nama_orang_tua : nama_orang_tua,
                },{
            headers:{
              'Authorization' : `Bearer ${token}`
            }})
                .then((response) => {
                  console.log(response)
                  console.log("Sukses")   
                  alert("Berhasil Update");
                  router.push("Profile");

                })
                .catch((error) => {
                  console.log(error)
                    // validation.value = error.response.data;
                });
        }

    onMounted(()=>{
      userProfile();
    })  

    return{
      User,
      updateProfile

    }
  }

}
</script>

<style>

</style>
