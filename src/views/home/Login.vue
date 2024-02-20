<template>
<NavBar/>

<v-card max-width="350" class="mx-auto mt-16 mb-16">
    <v-form @submit.prevent="submitForm" id="formulaire_de_connection">
        <v-card-title class="mb-12 text-center">
            
         Espace personnel
        </v-card-title>
        <v-text-field
        name="email"
        label="email"></v-text-field>
        <v-text-field
        name="mot_de_passe"
        label="mot de passe"></v-text-field>
        <input type="hidden" name="loginUser" value="1">
        <v-btn type="submit">se connecter </v-btn>
    </v-form>
</v-card>
<Footer/>
</template>
<script setup>
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";
import axios from 'axios';
</script>
<script>
export default {
  data() {
    return {
      email:'',
      mot_de_passe:'',
    };
  },
  methods: {
    submitForm() {
      

      const formData = new FormData(document.querySelector('#formulaire_de_connection'));

      console.log(new URLSearchParams(formData).toString()) 

fetch('/ecommerce-test/php/login.php', {
  method: 'POST',
  credentials: 'include',
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: new URLSearchParams(formData).toString(),
})
  .then(response => response.json())
  .then(data => {
    console.log(data);
    if (data.status) {
      this.$router.push('/admin');
    } else {
      console.log('Échec de la connexion');
    }
  })
  .catch(error => console.error('Erreur lors de la soumission du formulaire:', error));


    },
  },
};
</script>