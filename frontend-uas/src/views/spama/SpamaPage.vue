<template>
<v-main class="list">
<v-card>
<v-list-item>
    <v-list-item-avatar color="grey"></v-list-item-avatar>
    <v-list-item-content>
        <v-list-item-title class="headline">Spama</v-list-item-title>
        <v-list-item-subtitle>by Kelompok H</v-list-item-subtitle>
    </v-list-item-content>
</v-list-item>

<v-card-title>
    <v-text-field v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        outlined
        hide
        details
        style="margin-top: 30px"
    ></v-text-field>
    <v-spacer></v-spacer>
        <!-- Filter for penyelenggara -->
        <v-select
            :items="penyelenggaraList"
            v-model="penyelenggaraFilterValue"
            label="Filter"
        >
        </v-select>

    <v-spacer></v-spacer>
    <v-btn color="success" dark @click="dialog = true"> Tambah </v-btn>
</v-card-title>
</v-card>

<v-card>
<v-data-table :headers="headers" :items="todos" :search="search">
<!-- :single-expand="singleExpand" :expanded.sync="expanded" item-key="deskripsi_kegiatan" show-expand> -->

    <template v-slot:[`item.actions`]="{ item }">

        <v-btn class="ma-2" outlined small fab color="red" @click="editItem(item)">
            <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn class="ma-2" outlined small fab color="green" @click="deleteItem(item)">
            <v-icon>mdi-trash-can-outline</v-icon>
        </v-btn>

    </template>

    <template v-slot:[`item.checkbox`]="{ item }">
        <v-checkbox v-model="itemsToDelete" :value="item">

        </v-checkbox>

    </template>
</v-data-table>

</v-card>
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
            </v-menu>
            <!-- <v-select
                v-model="formTodo.status"
                :items="[`Selesai`, `Belum Selesai`]"
                label="Status"
                required
            ></v-select> -->
        </v-container>
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
</v-card-actions>
</v-card>
</v-main>
</template>
<script>
import axios from 'axios'
import { onMounted, ref } from 'vue'

export default {
  setup() {
    //reactive state
    let spamas = ref([])
    //mounted
    onMounted(() => {
      //get API from Laravel Backend
      axios.get('http://localhost:8000/api/spamas')
        .then(response => {
          //assign state posts with response data
          spamas.value = response.data.data
        }).catch(error => {
          console.log(error.response.data)
        })

      })

      //return
      return {
        spamas
      }
    },


  inputRules: [
    (v) => !!v || 'Must be filled!'
  ],
  menu2: false,
  name: 'ListItem',
  data () {
    return {
      snackbarNotImp: false,
      snackbarNormal: false,
      snackbarUrgent: false,
      timeout: 3000,
      search: null,
      dialog: false,
      dialogDelete: false,
      itemsToDelete: [],
      penyelenggaraFilterValue: null,
      headers: [
        {
          text: 'Nama Kegiatan',
          align: 'start',
          sortable: true,
          value: 'nama_kegiatan'
        },
        { text: 'Penyelenggara', value: 'penyelenggara', filter: this.penyelenggaraFilter },
        { text: 'Deskripsi Kegiatan', value: 'deskripsi_kegiatan' },
        { text: 'Tanggal', value: 'tanggal' },
        // { text: 'Status', value: 'status' },
        { text: 'Actions', value: 'actions' },
        { text: '', value: 'checkbox' }
      ],
      penyelenggaraList: [
        { text: 'All', value: null },
        { text: 'Fakultas', value: 'Fakultas' },
        { text: 'Universitas', value: 'Universitas' },
        { text: 'Prodi', value: 'Prodi' }
      ],
      editedIndex: -1,
      todos: [
        {
          nama_kegiatan: 'Coding',
          penyelenggara: 'Prodi',
          deskripsi_kegiatan: 'Code for your life',
          tanggal: '2022-12-20'
        //   status: 'Belum Selesai'
        },
        {
          nama_kegiatan: 'Cooking',
          penyelenggara: 'Fakultas',
          deskripsi_kegiatan: 'Indomie saat begadang ngerjain coding terbaek',
          tanggal: '2022-12-25'
        //   status: 'Selesai'
        },
        {
          nama_kegiatan: 'Gaming',
          penyelenggara: 'Universitas',
          deskripsi_kegiatan: 'Wasting time',
          tanggal: '2022-12-29'
        //   status: 'Belum Selesai'
        }
      ],
      formTodo: {
        nama_kegiatan: null,
        penyelenggara: null,
        deskripsi_kegiatan: null,
        tanggal: null
        // status: null
      }
    }
  },
  methods: {
    save () {
      if (this.editedIndex > -1) {
        Object.assign(this.todos[this.editedIndex], this.formTodo)
      } else {
        this.todos.push(this.formTodo)
      }
      this.resetForm()
      this.dialog = false
      this.editedIndex = -1
    },
    cancel () {
      this.resetForm()
      this.dialog = false
    },
    cancelDelete () {
      this.resetForm()
      this.dialogDelete = false
      this.editedIndex = -1
    },
    resetForm () {
      this.formTodo = {
        nama_kegiatan: null,
        penyelenggara: null,
        deskripsi_kegiatan: null,
        tanggal: null
        // status: null
      }
    },
    editItem (item) {
      this.editedIndex = this.todos.indexOf(item)
      this.formTodo = Object.assign({}, item)
      this.dialog = true
    },
    deleteItem (item) {
      this.editedIndex = this.todos.indexOf(item)
      this.formTodo = Object.assign({}, item)
      this.dialogDelete = true
    },
    deleteItemConfirm () {
      this.todos.splice(this.editedIndex, 1)
      this.cancelDelete()
    },
    deleteSelected () {
      this.todos = this.todos.filter(
        (item) => !this.itemsToDelete.includes(item)
      )
      this.itemsToDelete = []
    },
    penyelenggaraFilter (value) {
      if (!this.penyelenggaraFilterValue) {
        return true
      }
      return value === this.penyelenggaraFilterValue
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
