<template>
  <div>
      <v-container>
        <v-card>
              <h1>Pusat Perijinan</h1>
              <v-card-title>
                  <!-- <v-text-field
                      v-model="search"
                      append-icon="mdi-magnify"
                      label="Search"
                      outlined
                      hide
                      details
                      style="margin-top: 30px;"
                  ></v-text-field> -->
                  <v-spacer></v-spacer>
                  <v-btn color="success" dark to="create-perizinan"> Tambah </v-btn>
              </v-card-title>
          </v-card>
        <v-card>
          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">NAMA MAHASISWA</th>
                  <th class="text-left">ALASAN</th>
                  <th class="text-left">WAKTU IZIN</th>
                  <th class="text-left">WAKTU SELESAI</th>
                  <th class="text-left">JENIS IZIN</th>
                  <th class="text-left">STATUS</th>
                 </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(perizinans, id) in perizinans" :key="id"
                >
                  <td>{{ perizinans.nama }}</td>
                  <td>{{ perizinans.pesan }}</td>
                  <td>{{ perizinans.tanggal_izin }}</td>
                  <td>{{ perizinans.tanggal_selesai }}</td>
                  <td>{{ perizinans.tipe }}</td>
                  <!-- :style="(perizinans.status) ? 'red':'green'" -->
                  <td>{{ (perizinans.status) ? "Telah dikonfirmasi":"Belum dikonfirmasi" }}</td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
  
          </v-card>
      </v-container>
  </div>
  </template>
  
  <script>
  /* eslint-disable */
  import axios from 'axios'
  import { onMounted, ref } from 'vue'
  
  export default {
    data(){
      return {
        
      dialog: false,
      }
    },
    setup() {
          let perizinans = ref([])
  
          onMounted(() => {
              axios.get('http://localhost:8000/api/perizinans/',{
                  headers:{
                  'Authorization' : `Bearer ${localStorage.getItem('token')}`
                  }})
  
                  .then(response => {
                      perizinans.value = response.data.data
                      console.log(perizinans)
                  }).catch(error => {
                      console.log(error)
                  })
          })
          return { perizinans }
  
  
      },
  }
  </script>
  
  <style>
  
  </style>
  