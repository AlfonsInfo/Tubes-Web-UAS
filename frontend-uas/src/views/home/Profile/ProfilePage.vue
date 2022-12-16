<template>
  <div>
    <div>Profil Pengguna</div>
  </div>
</template>

<script>
/* eslint-disable */
import axios from 'axios'
import { onMounted } from 'vue';
export default {
  setup()
  {
    
    function userProfile(){
      let id = localStorage.getItem( 'id_user')
      let token =  localStorage.getItem('token')
      console.log("token :" + token)
    axios
        .get(`http://127.0.0.1:8000/api/User/${id}`,{
            headers:{
              'Authorization' : `Bearer ${token}`
            }})
        .then((response) => {
          console.log(response)
        })
        .catch((error)=>{
          console.log(error)
        })
    }

    onMounted(()=>{
      userProfile()
    })  
  }

}
</script>
<style>
</style>
