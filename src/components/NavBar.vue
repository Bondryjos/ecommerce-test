<template>

  
    <v-app-bar  >
      <v-app-bar-nav-icon class="d-md-none" variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-img src="../assets/_cb7b3830-27a1-4baa-a3d6-00cfca23f410-removebg-preview.png" max-height="100" contain></v-img>
      
<v-app-bar-title class="d-none d-sm-flex" style="font-family: 'Fredoka',sans-serif;">Garage <span style="color:orange">v.parrot</span></v-app-bar-title>
<v-spacer></v-spacer>


<router-link :to="{ path: '/' }" class="nav-link">
  <v-btn  @click="scroll('home')" class="d-none d-sm-flex" style="color:black" >Accueil</v-btn></router-link>
<router-link :to="{ path: '/' }" class="nav-link">
  <v-btn text  @click="scroll('service')" class="d-none d-sm-flex" style="color:black" >service</v-btn></router-link>
<router-link :to="{ path: '/vehicules' }" class="nav-link">
  <v-btn class=" d-none d-sm-flex" style="color:black" >Nos véhicules</v-btn></router-link>
<router-link :to="{ path: '/' }" class="nav-link">
  <v-btn text @click="scroll('contact')" class="d-none d-sm-flex color-nav" style="color:black" >contact</v-btn></router-link>
<v-spacer></v-spacer>
<router-link :to="{ path: '/login' }" class="nav-link">
  <v-btn  style="color:black" >Se connecter</v-btn></router-link>
</v-app-bar>
<v-navigation-drawer
        v-model="drawer"
        location="bottom"
        temporary
      >
      <template v-for="item in items" :key="item">
        <router-link :to="getLink(item)" class="nav-link">
          <v-list @click="scroll(item)" class="text-black">{{ item }}</v-list>
        </router-link>
      </template>
      </v-navigation-drawer>

   

  
  
 



  </template>
  
  <script>
  export default {
    
    data: () => ({
      drawer: false,
      group: null,
      items: [
       'accueil','service','vehicules','contact'
      ],
    }),   
    watch: {
      group () {
        this.drawer = false
      },
    },
    methods: {
      getLink(item) {
      if (item === 'accueil') return '/';
      if (item === 'service') return '/';
      if (item === 'vehicules') return '/vehicules';
      if (item === 'contact') return '/';
    },
    
      scroll(refName) {
      const element = document.getElementById(refName);
      element.scrollIntoView({ behavior: "smooth" });
    },
  },
  }
    
  </script>
  
  <style scoped>

.nav-link{
  text-decoration: none;
}
.text-black{
  color:black;
}

  
</style>