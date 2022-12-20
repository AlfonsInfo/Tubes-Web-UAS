<template>
<v-main class="list">
<v-card>
<v-list-item>
    <v-list-item-avatar color="grey"></v-list-item-avatar>
    <v-list-item-content>
        <v-list-item-title class="headline">Pengambilan Matakuliah</v-list-item-title>
    </v-list-item-content>
</v-list-item>

<!-- <v-card-title>
    <v-btn color="success" dark to="tambah-matakuliah" class="ml-auto"> Tambah </v-btn>
</v-card-title> -->

<div class="d-flex">

<v-card class="mr-5">
  <h1 class="pt-5 pl-4">Matakuliah</h1>
<v-data-table :headers="headers" :items="matkuls" :search="search" >

    <template v-slot:[`item.actions`]="{ item }"  >
        <v-btn class="ma-2" @click="ambilMatkul(item.id)" >
            <!-- <v-icon>mdi-pencil</v-icon> -->
            Pilih
        </v-btn>
        <!-- <v-btn class="ma-2" outlined small fab color="green" @click="matkulsDelete(item.id)">
            <v-icon>mdi-trash-can-outline</v-icon>
        </v-btn> -->

    </template>


</v-data-table>
</v-card>
<v-card>
  <h1 class="pt-5 pl-4">Daftar Pengambilan Kelas</h1>
<v-data-table :headers="headers2" :items="pengambilanMatkuls" :search="search" >

    <template v-slot:[`item.actions`]="{ item }"  >

        <v-btn class="ma-2" @click="batal(item.id_matkul)" >
            <!-- <v-icon>mdi-pencil</v-icon> -->
            Batal
        </v-btn>
    </template>

</v-data-table>
</v-card>
</div>

</v-card>
</v-main>
</template>
<script>
import axios from 'axios'
import { onMounted, reactive, ref, filter } from 'vue'
// import { filter } from '../vue/types/umd';

export default {
    setup() {
        let matkuls = ref([]);
        let pengambilanMatkuls = ref([])
        //Matakuliah
        function initMatkul(){ 
        axios.get('http://localhost:8000/api/matkuls',{
                headers:{
                'Authorization' : `Bearer ${localStorage.getItem('token')}`
                }},)
            .then(response => {
                console.log(response.data)
                matkuls.value = response.data.data
            }).catch(error => {
            console.log(error)
            });
        }

        function initDataAmbil(){ 
        axios.get('http://localhost:8000/api/pengambilanMatkuls',{
                headers:{
                'Authorization' : `Bearer ${localStorage.getItem('token')}`
                }},)
            .then(response => {
                console.log(response.data)
                filter
                pengambilanMatkuls.value = response.data.data

                pengambilanMatkuls.value = pengambilanMatkuls.value.filter((item) =>{ if(item.id_mahasiswa == localStorage.getItem('id_user')){ return item}})
            }).catch(error => {
            console.log(error)
            });
        }

        function ambilMatkul($id)
        {
            axios
                .post("http://127.0.0.1:8000/api/pengambilanMatkuls", {
                id_mahasiswa: localStorage.getItem('id_user'),
                id_matkul : $id,
        },{
             headers:{
              'Authorization' : `Bearer ${localStorage.getItem('token')}`
            }
        })
      .then(() => {
          // console.log("Berhasil Register, Tunggu verifikasi");
          alert("Berhasil ditambahkan !!");
          initDataAmbil()
        //   router.push({ name: "Matkul" });
        })
        .catch((error) => {
          console.log("Gagal");
          alert("Registrasi Gagal !!");
          validation.value = error.response.data;
        });
        }
        function batal($id)
        {
            console.log($id)
            axios.delete(`http://localhost:8000/api/pengambilanMatkul/` + $id,{
             headers:{
              'Authorization' : `Bearer ${localStorage.getItem('token')}`
            }
        })
        .then(() => {
            alert("Delete Berhasil")
            pengambilanMatkuls.value.splice(pengambilanMatkuls.value.indexOf($id), 1);
        })
        .catch(error => {
            console.log(error)
        });
        }

    //     //mounted
        onMounted(() => {
        initMatkul()
        initDataAmbil()
        })

        return {
            matkuls,
            pengambilanMatkuls,
            ambilMatkul,
            batal
}
        },


  data () {
    return {

      token: localStorage.getItem('token'),
      id_user: localStorage.getItem('id_user'),
      search: null,
      headers: [
      //   {
      //     text: 'ID',
      //     align: 'start',
      //     sortable: true,
      //     value : 'id',
      //     // value: rows
        // },
        { text: 'Nama Matakuliah', value: 'nama_matkul', filter: this.penyelenggaraFilter },
        { text: 'Kode Matakuliah', value: 'kode_matkul' },
        { text: 'SKS', value: 'sks' },
        { text: 'Dosen', value: 'dosen' },
        { text: 'Sesi', value: 'sesi' },
        { text: 'Actions', value: 'actions' },
      ],

      headers2: [
      //   {
      //     text: 'ID',
      //     align: 'start',
      //     sortable: true,
      //     value : 'id',
      //     // value: rows
        // },
        { text: 'NPM Mahasiswa', value: 'mahasiswas.npm', filter: this.penyelenggaraFilter },
        { text: 'Matakuliah', value : 'matkuls.nama_matkul'},
        { text: 'Kode Matakuliah', value: 'matkuls.kode_matkul' },
        { text: 'SKS', value: 'matkuls.sks' },
        { text: 'Dosen', value: 'matkuls.dosen' },
        { text: 'Actions', value: 'actions' },
      ],
      }
    }
  }
</script>
<style>
.text {
font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
font-size: 40px;
font-style: italic;
}
.notePrio {
color: white;
}
</style>
