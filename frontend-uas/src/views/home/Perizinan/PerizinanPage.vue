<template>
<div>
    <v-container>
      <v-card>
            <v-list-item>
                <v-list-item-avatar color="grey"></v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title class="headline">To Do List</v-list-item-title>
                    <v-list-item-subtitle>by 200710909</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
            <v-card-title>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    outlined
                    hide
                    details
                    style="margin-top: 30px;"
                ></v-text-field>
                <v-spacer></v-spacer>
                <v-btn color="success" dark @click="dialog = true"> Tambah </v-btn>
            </v-card-title>
        </v-card>
      <v-card>
        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">NAMA MAHASISWA</th>
                <th class="text-left">PESAN</th>
                <th class="text-left">WAKTU IZIN</th>
                <th class="text-left">WAKTU SELESAI</th>
                <th class="text-left">STATUS IZIN</th>
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
              </tr>
            </tbody>
          </template>
        </v-simple-table>

        </v-card>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
                <v-card-title>
                    <span class="headline">Form Todo List</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-text-field v-model="perizinans.nama" label="Nama" required></v-text-field>
                        <v-text-field v-model="perizinans.pesan" label="Pesan" required></v-text-field>

                        <v-textarea v-model="perizinans.tanggal_izin" label="Note" required></v-textarea>
                        <v-select v-model="perizinans.tanggal_selesai" :items="[`Selesai`, `Belum Selesai`]" label="Status"
                            required></v-select>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="cancel"> Cancel</v-btn>
                    <v-btn color="blue darken-1" text @click="save"> Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
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
            axios.get('http://localhost:8000/api/perizinans/')

                .then(response => {
                    perizinans.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })
        return { perizinans }


    },
}
</script>

<style>

</style>
