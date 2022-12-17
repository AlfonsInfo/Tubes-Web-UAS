<template>
  <div>
    <div style="height: 500px">
      <v-card class="mx-auto mt-15" style="padding:50px" max-width="1300" color="white" elevation="10">
    <v-img style="height:400px"
      src="https://img.freepik.com/free-photo/free-time-students-bachelor-s-campus-life-rhythm-five-friendly-students-are-walking_8353-6408.jpg"
    >
    <!-- https://api.unsplash.com/photos/random?client_id=M__Uerb4lLxpi4X0bx5Gy4DpfZHg0qHWnAwx50WkgWM -->
      <v-row
        align="end"
        class="fill-height"
      >
        <v-col
          align-self="start"
          class="pa-0"
          cols="12"
        >
          <v-avatar
            class="profile"
            size="164"
            style=" top: 200px; margin-start:20px"
          >
            <v-img src="https://cdn.vuetifyjs.com/images/profiles/marcus.jpg"></v-img>
          </v-avatar>
        </v-col>
        <v-col class="py-0">
          <v-list-item  
            color="rgba(0, 0, 0, .4)"
            dark
          >
            <v-list-item-content>
              <v-list-item-title class="text-h6" style="margin-start:20px">
                {{User.nama}}
              </v-list-item-title>
              <v-list-item-subtitle style="margin-start:20px" >{{User.npm}}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-col>
      </v-row>
    </v-img>
      <v-card-actions>
      <v-btn
        text
        color="teal accent-4"
        @click="reveal = true"
      >
        Lihat Profile Pengguna
      </v-btn>
    </v-card-actions>

    <v-expand-transition>
      <v-card
        v-if="reveal"
        class="transition-fast-in-fast-out v-card--reveal"
        style="height: 100%;"
      >
        <div style="padding: 20px">
          <!-- <v-row v-for="tampil in tampils " :key="tampil.text">
            <v-col>{{tampil.text}}</v-col>

            <v-col>{{tampil}}</v-col>
          </v-row> -->
          <p>Nama :   {{User.nama}}</p>
          <v-divider></v-divider>
          <p>Email :  {{User.email}}</p>
          <v-divider></v-divider>
          <p>NPM :  {{User.npm}}</p>
          <v-divider></v-divider>
          <p>SKS :  {{User.jumlah_sks}}</p>
        </div>
        <v-card-actions class="pt-0">
          <v-btn
            text
            color="teal accent-4"
            @click="reveal = false"
          >
            Close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-expand-transition>
      </v-card>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
/* eslint-disable */
import axios from 'axios'
import { onMounted, reactive, ref } from 'vue';
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
    });

    let tampils = [
        // { text:"Nama :", value: reactive(User.nama)},
        // { text:"Email :", value: reactive(User.email)},
        // { text:"NPM :", value: reactive(User.npm)},
        // { text:"Jumlah SKS :", value: reactive(User.jumlah_sks)},
    ];
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

    onMounted(()=>{
      userProfile()
    })  

    return{
      User,
      tampils
    }
  }

}
</script>
<style>
</style>
