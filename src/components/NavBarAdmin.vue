<template>
  <v-card>
    <v-layout>
      <v-navigation-drawer
        v-model="drawer"
        :rail="rail"
        permanent
        @click="rail = false"
      >
        <v-list-item
          prepend-avatar="../assets/_cb7b3830-27a1-4baa-a3d6-00cfca23f410-removebg-preview.png"
          title="John Leider"
          nav
        >
          <template v-slot:append>
            <v-btn
              variant="text"
              icon="mdi-chevron-left"
              @click.stop="rail = !rail"
            ></v-btn>
          </template>
        </v-list-item>

        <v-divider></v-divider>

        <v-list density="compact" nav>
          <router-link :to="{ path: '/admin' }" class="nav-link"> <v-list-item prepend-icon="mdi-home-city" title="Home" value="home" style="color: black;"></v-list-item></router-link>
          <router-link :to="{ path: '/adminvehicules' }" class="nav-link"><v-list-item prepend-icon="mdi-account" title="Admin" value="account" style="color: black;"></v-list-item></router-link>
          <router-link :to="{ path: '/adminemploye' }" class="nav-link"> <v-list-item prepend-icon="mdi-account-group-outline" title="Employe" value="employe" style="color: black;"></v-list-item></router-link>
          <v-list-item @click="logout" prepend-icon="mdi mdi-logout" title="Déconnexion" value="déconnexion" style="color: black;"> </v-list-item>
        </v-list>
      </v-navigation-drawer>
      <v-layout column>
        <v-main style="flex-grow: 1; flex-basis: 0; max-width: 100%; height: 850px; overflow-y: auto; padding: 50px;">
          <v-card-text>
            <slot></slot>
          </v-card-text>
        </v-main>
      </v-layout>
    </v-layout>
  </v-card>
</template>
<script setup>
import axios from 'axios';
</script>

<script>
export default {
  data() {
    return {
      drawer: true,
      rail: true,
    };
  },
  methods: {
    logout() {
      axios.post('/ecommerce-test/php/logout.php', {}, { withCredentials: true })
        .then(response => {
          console.log('Status:', response.status);
          console.log('Data:', response.data); 
          if (response.data.status) {
            this.$router.push('/login');
          } else {
            console.log('Erreur lors de la déconnexion');
          }
        })
        .catch(error => {
          console.error('Erreur lors de la déconnexion:', error);
        });
    },
  },
};
</script>
<style>
.nav-link{
  text-decoration: none;
}
</style>