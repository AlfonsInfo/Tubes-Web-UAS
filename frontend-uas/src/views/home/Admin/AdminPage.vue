<template>
  <div>
    <div class="d-flex justify-align-center">

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
    <v-card-title>Tambah Kelas</v-card-title>
    <v-card-text>
      <v-row
        align="center"
        class="mx-0"
      >
      </v-row>
      <div class="my-4 text-subtitle-1">
        <!-- Tambah Kelas -->
      </div>
      <div>Tambah Kelas Baru</div>
    </v-card-text>
    <v-divider class="mx-4"></v-divider>
    <v-card-actions>
      <v-btn
        color="deep-purple lighten-2"
        text
        to="/matkul">
        Buka Kelas Untuk Mahasiswa
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
      <div>Cek Perijinan Mahasiswa</div>
    </v-card-text>
    <v-divider class="mx-4"></v-divider>
    <v-card-actions>
      <v-btn
        color="deep-purple lighten-2"
        text
        to="/perizinan-admin">
        Perijinan
      </v-btn>
    </v-card-actions>
  </v-card>
    </div>

    <router-view></router-view>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>