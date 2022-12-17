<template>
<div>
    <v-container>
            <h3>Clientes Registrados </h3><br>
            <v-card>
                <v-data-table :headers="headers" :items="albums">
                </v-data-table>
            </v-card>
    </v-container>
</div>
</template>

<script>
/* eslint-disable */
export default {
    data(){
        return {
            headers: [
        { 
          text: "Note", value: "note" 
        },
        {
          text: "Task",
          align: "start",
          sortable: true,
          value: "task",
        },
        { text: "Priority", value: "priority" },
        { text: "Status", value: "status" },
        { text: "Actions", value: "actions" },
      ],
      albums: [
        {
          task: "Coding",
          priority: "Urgent",
          note: "Code for your life",
          status: "Belum Selesai",
        },
        {
          task: "Cooking",
          priority: "Normal",
          note: "Indomie saat bergadang ngerjain coding terbaek",
          status: "Selesai",
        },
        {
          task: "Gaming",
          priority: "Not Important",
          note: "wasting time",
          status: "Belum Selesai",
        },
      ],
        }
    }

}
</script>

<style>

</style>
