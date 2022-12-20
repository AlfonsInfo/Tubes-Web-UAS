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
                    <th class="text-left">AKSI</th>
                   </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(perizinans, id) in perizinans" :key="id"
                  >
                    <td>{{ perizinans.id }}</td>
                    <td>{{ perizinans.pesan }}</td>
                    <td>{{ perizinans.tanggal_izin }}</td>
                    <td>{{ perizinans.tanggal_selesai }}</td>
                    <td>{{ perizinans.tipe }}</td>
                    <!-- :style="(perizinans.status) ? 'red':'green'" -->
                    <td>{{ (perizinans.status_perizinan) ? "Telah dikonfirmasi":"Belum dikonfirmasi" }}</td>
                    <td>
                        <v-btn class="ma-2" outlined small fab color="green" @click="konfirmIzin(perizinans.id)">
                            <v-icon>mdi-check</v-icon>
                        </v-btn>
                        <v-btn class="ma-2" outlined small fab color="red" @click="izinDelete(perizinans.id)">
                            <v-icon>mdi-trash-can-outline</v-icon>
                        </v-btn>
`                    </td>
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
            function initPerizinan()
            {
                axios.get('http://localhost:8000/api/perizinan/',{
                    headers:{
                    'Authorization' : `Bearer ${localStorage.getItem('token')}`
                    }})
    
                    .then(response => {
                        perizinans.value = response.data.data
                        console.log(perizinans)
                    }).catch(error => {
                        console.log(error)
                    })
            }
            function izinDelete(id){ 
                console.log(id)

            let confirmDelete = confirm("Apakah yakin ingin menghapus ?")

            if (confirmDelete == true){
            // token = localStorage.getItem('token'),
            axios.delete(`http://localhost:8000/api/perizinans/${id}`,{
                headers:{
                'Authorization' : `Bearer ${localStorage.getItem('token')}`
                }
            })
                .then(() => {
                alert("Delete Berhasil")
                initPerizinan()
                // perizinans.value.splice(perizinans.value.indexOf($id), 1);
                }).catch(error => {
                console.log(error)
                });
            }
            }

            function konfirmIzin(id)
            {
              let token = localStorage.getItem( 'token')
              axios
                  .put(`http://localhost:8000/api/perizinans/${id}`,{
                    status_perizinan: 1 
                  },{
              headers:{
                'Authorization' : `Bearer ${token}`
              }})
                  .then((response) => {
                    console.log(response)
                    console.log("Sukses")   
                    alert("Berhasil Update");
                    initPerizinan()
                  })
                  .catch((error) => {
                    console.log(error.response.data)
                    alert("Gagal Update");
                      // validation.value = error.response.data;
                  });
          
            }

    
            onMounted(() => {
                initPerizinan()
            })
            return { 
                perizinans,
                izinDelete,
                konfirmIzin
             }
    
    
        },
    }
    </script>
    
    <style>
    
    </style>
    