<template>
  <v-col cols="12" md="6">
    <v-card id="contact">
      <v-card-title>
        Formulaire de contact
      </v-card-title>
      <v-container>
        <v-form @submit.prevent="submitForm" id="Formulaires_users">
          <v-text-field v-model="prenom" name="prenom" label="prénom"></v-text-field>
          <v-text-field v-model="nom" name="nom" label="nom"></v-text-field>
          <v-text-field v-model="email" name="email" label="email"></v-text-field>
          <v-text-field v-model="gsm" name="gsm" label="numéro de télephone"></v-text-field>
          <v-text-field v-model="message" name="message" label="message"></v-text-field>
          <input type="hidden" name="vehicules_id" :value="vehicules_id">
          <input type="hidden" name="FormulairesUsers" value="1">
          <v-btn color="orange" type="submit">envoyer</v-btn>
          <span :style="{ backgroundColor: retourformulairestype=== true ? 'green' : (retourformulairestype=== false ? 'red' : 'blue') }">{{ retourformulaires }}</span>
        </v-form>
      </v-container>
    </v-card>
  </v-col>
</template>
<script setup>
import axios from 'axios'
</script>

<script>
export default {
  props: ['vehicules_id'],
  data() {
    return {
      prenom: '',
      nom: '',
      email: '',
      gsm: '',
      message: '',
      vehicules_id: this.vehicules_id,
      retourformulaires:'',
      retourformulairestype:false,
    };
  },
  methods: {
    submitForm() {
      const formData = {
    prenom: this.prenom,
    nom: this.nom,
    email: this.email,
    gsm: this.gsm,
    message: this.message,
    vehicules_id: this.vehicules_id,
    FormulairesUsers: 1,
  };
        axios.post('/ecommerce-test/php/Formulaire.php', formData, {
        withCredentials: true,
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })
      .then(response => {
        this.retourformulaires=response.data.message;
        this.retourformulairestype=response.data.status==='success'?true:false;
        console.log(response);
        if (response.data.status) {
         
        } else {
          console.log('Échec de l\'envoi');
        }
      })
      .catch(error => {
        console.error('Erreur lors de la soumission du formulaire:', error);
      });
    },
  },
};
</script>
