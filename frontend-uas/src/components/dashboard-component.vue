<template>
  <div>
    <v-navigation-drawer
      class="fullheight"
      width="256"
      v-model="drawer"
      absolute
      temporary
      color="grey lighten-5"
    >
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title"
            >Layanan Atma Mini
          </v-list-item-title>
          <v-list-item-subtitle>Menu</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>
      <v-list dense nav :key="componentKey">
      <div v-if="token == null">
          <v-list-item
            v-for="item in items"
            :key="item.title"
            link
            color="light-blue darken-4"
            tag="router-link"
            :to="item.to">
            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>
        <!-- Menu bagi yang sudah autentikasi -->
          <div  v-if="token !=null">
          <v-list-item
          v-for="item in itemsUser"
          :key="item.title"
          link
          color="light-blue darken-4"
          tag="router-link"
          :to="item.to"
          @click="FunctionFactory(item.title)">
          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
  <v-divider></v-divider>
          </div>
        <!-- Akhir bagian menu autentikasi  -->
      </v-list>
    </v-navigation-drawer>
    <v-app-bar color="blue" dark>
      <v-app-bar-nav-icon
        @click="drawer = true"
        color="white"
      ></v-app-bar-nav-icon>
      <v-spacer />
      <v-toolbar-title class="me-10">Website Layanan Atma</v-toolbar-title>
    </v-app-bar>
    <router-view></router-view>
  </div>
</template>

<script>
/* eslint-disable */
import axios from "axios";
export default {
  data() {
    return {
      componentKey : 0,
      drawer: false,
      items: [
        { title: "Home", to: "/",  },
        { title: "Login", to: "/Login",  },
        { title: "Register", to: "Register",  },
      ],
      token: null,
      itemsUser: [
        { title: "Dashboard", to: "/Dashboard",  },
        { title: "CRUD1", to: "/crud1",  },
        { title: "CRUD2", to: "/crud2",  },
        { title: "CRUD3", to: "/crud3",  },
        { title: "Log Out", to: "/"   },
      ],
    };
  },

  methods:{
    FunctionFactory(tipe){
      if(tipe == "Log Out")
      {
          console.log(this.token);
          axios.post("http://127.0.0.1:8000/api/logout",{},{
            headers:{
              'Authorization' : `Bearer ${this.token}`
            }
          }).then(
            (response)=>{
                console.log(response);   
              alert("Log Out dari Situs Layanan Atma ");
              localStorage.removeItem( 'token');
              window.dispatchEvent(new CustomEvent('tokenstorage-changed', {
              detail: {
              storage: localStorage.getItem('token')
              }
            }))  
            }
          ).catch((error)=>{
            console.log(error);
          });

          
      }else{ }
    },
  },

  created()
  {
    console.log(this.token == null);
    console.log(this.token);
    // this.token = [...this.token];
  },
  mounted() {
    window.addEventListener('tokenstorage-changed', (event) => {
      this.token = event.detail.storage;
    });
  },
};
</script>
<style></style>
