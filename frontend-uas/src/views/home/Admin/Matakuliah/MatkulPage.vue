<template>
<v-main class="list">
<v-card>
<v-list-item>
    <v-list-item-avatar color="grey"></v-list-item-avatar>
    <v-list-item-content>
        <v-list-item-title class="headline">Pengambilan MataKuliah</v-list-item-title>
    </v-list-item-content>
</v-list-item>

<v-card-title>
    <v-btn color="success" dark to="tambah-matakuliah" class="ml-auto"> Tambah </v-btn>
</v-card-title>
<!-- </v-card> -->

<v-card>
<v-data-table :headers="headers" :items="matkuls" :search="search" >
<!-- :single-expand="singleExpand" :expanded.sync="expanded" item-key="deskripsi_kegiatan" show-expand> -->

    <template v-slot:[`item.actions`]="{ item }"  >

<!-- :to="{ name: 'departemen.edit', params: { id: departemen.id, nama_dpt: departemen.nama_departemen, nama_mng: departemen.nama_manager, jml_pg: departemen.jumlah_pegawai } }" -->

        <v-btn class="ma-2" outlined small fab color="red" :to="{ name: 'ubah-matakuliah', params: {id: item.id}}" >
            <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn class="ma-2" outlined small fab color="green" @click="matkulsDelete(item.id)">
            <v-icon>mdi-trash-can-outline</v-icon>
        </v-btn>

    </template>

    <!-- <template v-slot:[`item.checkbox`]="{ item }">
        <v-checkbox v-model="itemsToDelete" :value="item">

        </v-checkbox> -->

    <!-- </template> -->
</v-data-table>
</v-card>
<!-- 
<v-dialog v-model="dialog" persistent max-width="600px">
<v-card>
    <v-card-title>
        <span class="headline"> Form Spama </span>
    </v-card-title>

    <v-card-text>
        <v-container>
            <v-text-field
                v-model="formTodo.nama_kegiatan"
                label="Nama Kegiatan"
                required
            ></v-text-field>
            <v-select
                v-model="formTodo.penyelenggara"
                :items="[`Prodi`, `Fakultas`, `Universitas`]"
                label="Penyelenggara"
                required
            ></v-select>

            <v-textarea
                v-model="formTodo.deskripsi_kegiatan"
                label="Deskripsi Kegiatan"
                required
            ></v-textarea>
            <v-menu v-model="menu2" :close-on-content-click="false" min-width="auto">
              <template v-slot:activator="{ on, attrs }">
                <v-text-field v-model="formTodo.tanggal" label="Date" :rules="inputRules" v-bind="attrs" v-on="on"></v-text-field>
              </template>
                  <v-date-picker v-model="formTodo.tanggal" @input="menu2 = false">
                  </v-date-picker>
            </v-menu> -->
            <!-- <v-select
                v-model="formTodo.status"
                :items="[`Selesai`, `Belum Selesai`]"
                label="Status"
                required
            ></v-select> -->
        <!-- </v-container>
    </v-card-text>
    <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red darken-1" text @click="cancel"> Cancel </v-btn>
        <v-btn color="green darken-1" text @click="save"> Save </v-btn>
    </v-card-actions>
</v-card>
</v-dialog>
<v-dialog v-model="dialogDelete" max-width="500px">
<v-card>
<v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
<v-card-actions>
    <v-spacer></v-spacer>
    <v-btn color="red darken-1"  text @click="cancelDelete">No</v-btn>
    <v-btn color="green darken-1" text @click="deleteItemConfirm">Yes</v-btn>
    <v-spacer></v-spacer>
</v-card-actions>
</v-card>
</v-dialog>
<v-card v-if="itemsToDelete.length > 0">
<v-card-title>
    Delete Multiple
</v-card-title>
<ul>
    <li v-for="item in itemsToDelete" :key="item.nama_kegiatan" style="margin:10px;">
        {{ item.nama_kegiatan }}
    </li>
</ul>
<v-card-actions>
    <v-btn color="red accent-2" style="margin:5px;" @click="deleteSelected()">
        <span class="notePrio" style="margin:5px;">
            HAPUS SEMUA
        </span>
    </v-btn>
</v-card-actions> -->
</v-card>
</v-main>
</template>
<script>
import axios from 'axios'
import { onMounted, reactive, ref } from 'vue'

export default {
    setup() {
        let matkuls = ref([]);
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

        function matkulsDelete(id_matkul){ 
        // token = localStorage.getItem('token'),
        axios.delete(`http://localhost:8000/api/matkuls/${id_matkul}`,{
             headers:{
              'Authorization' : `Bearer ${localStorage.getItem('token')}`
            }
        })
            .then(() => {
            alert("Delete Berhasil")
            matkuls.value.splice(matkuls.value.indexOf(id_matkul), 1);
            }).catch(error => {
            console.log(error)
            });
        }
    //     //mounted
        onMounted(() => {
        initMatkul()
        })

        return {
          matkuls,
          matkulsDelete,
        }
        },


  data () {
    return {

      token: localStorage.getItem('token'),
      id_user: localStorage.getItem('id_user'),
      search: null,
      headers: [
        {
          text: 'ID',
          align: 'start',
          sortable: true,
          value : 'id',
          // value: rows
        },
        { text: 'Nama Matakuliah', value: 'nama_matkul', filter: this.penyelenggaraFilter },
        { text: 'Kode Matakuliah', value: 'kode_matkul' },
        { text: 'SKS', value: 'sks' },
        { text: 'Dosen', value: 'dosen' },
        { text: 'Sesi', value: 'sesi' },
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
