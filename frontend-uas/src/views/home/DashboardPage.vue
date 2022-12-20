<template>
  <div>
    <div class="d-flex">
  <v-card
    class="mx-auto my-12"
    max-width="374"
  >
    <template slot="progress">
      <v-progress-linear
        color="deep-purple"
        height="10"
        indeterminate
      ></v-progress-linear>
    </template>
    <v-img
      height="250"
      src="https://www.responsiveclassroom.org/wp-content/uploads/2016/04/DSC_2388-1024x682.jpg"
    ></v-img>
    <v-card-title>Pengambilan Matakuliah </v-card-title>
    <v-card-text>
      <v-row
        align="center"
        class="mx-0">
      </v-row>
      <div class="my-4 text-subtitle-1">
        Rencana Studi
      </div>
      <div>Pengambilan matakuliah harus sesuai dengan jadwal KRS. Jika Ada kendala dapat menghubungi helpdesk Universitas.</div>
    </v-card-text>
    <v-divider class="mx-4"></v-divider>
    <v-card-actions>
      <v-btn
        color="deep-purple lighten-2"
        text
        to="/PengambilanMatkul">
        Pengambilan Kelas
      </v-btn>
    </v-card-actions>
  </v-card>

  <!-- Card 2 -->
  <v-card class="mx-auto my-12" max-width="374">
    <template slot="progress">
      <v-progress-linear
        color="deep-purple"
        height="10"
        indeterminate
      ></v-progress-linear>
    </template>
    <v-img
      height="250"
      src="https://www.studyandgoabroad.com/wp-content/uploads/2020/10/Benefits-of-Extracurricular-Activities-for-University-Students.jpg"
    ></v-img>
    <v-card-title>SPAMA</v-card-title>
    <v-card-text>
      <v-row
        align="center"
        class="mx-0"
      >
      </v-row>
      <div class="my-4 text-subtitle-1">
        Poin Keaktifan
      </div>
      <div>SPAMA merupakan sistem untuk mendaftarkan poin keaktifanmu</div>
    </v-card-text>
    <v-divider class="mx-4"></v-divider>
    <v-card-actions>
      <v-btn
        color="deep-purple lighten-2"
        text
        to="/Spama">
        Catat Poin Keaktifanmu
      </v-btn>
    </v-card-actions>
  </v-card>
  <!-- Card 3 -->
   <v-card
    class="mx-auto my-12"
    max-width="374"
  >
    <template slot="progress">
      <v-progress-linear
        color="deep-purple"
        height="10"
        indeterminate
      ></v-progress-linear>
    </template>

    <v-img
      height="250"
      src="http://lhs-lawfirm.com/images/jasa-hukum/perizinan.jpg"
    ></v-img>

    <v-card-title>Perizinan</v-card-title>

    <v-card-text>
      <v-row
        align="center"
        class="mx-0"
      >
      </v-row>
      <div class="my-4 text-subtitle-1">
        Layanan Perijinan
      </div>
      <div>Layanan online untuk melakukan perijinan</div>
    </v-card-text>
    <v-divider class="mx-4"></v-divider>
    <v-card-actions>
      <v-btn
        color="deep-purple lighten-2"
        text
        to="/perizinan">
        Perijinan
      </v-btn>
    </v-card-actions>
  </v-card>
    </div>
  </div>
</template>


<script>
import router from '../../router'
export default {
    setup(){
   
    }
}
</script>

<style>
</style>
