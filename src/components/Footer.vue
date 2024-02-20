<template>
    <v-footer class="bg-orange text-center d-flex flex-column " style="bottom: 0;" >
      <div class="d-flex w-100 pt-2">
        <v-row justify="center" no-gutters>
          <v-col cols="12" md="6">
            <h2>Information légale</h2>
            <ul>
             <li style="list-style:none;"><a href="poliquedeconfidentialité.pdf">Politique de confidentialité</a></li>
              <li style="list-style:none;"><a href="Mentions Légales - Garage automobile - 2024-02-18T01_54_43Z.pdf">Mentions légal</a></li>
              <li style="list-style:none;"><a href="conditiond'utilisation.pdf">Conditions d'utilisation</a></li>
            </ul>
          </v-col>
          <v-col cols="12" md="5" >
            <h2> Horaires d'ouverture</h2>
            <span class="text-caption" v-for="(item,i) in horairesId" :key="i">{{ item.jours }}: {{ item. horaires_du_matin }} // {{ item.horaires_du_soir }}<br/></span>
           
          </v-col>
          
        </v-row>
      </div>
      
    </v-footer>
  </template>

  <script setup>
import axios from 'axios'
</script>
  
  <script>
  export default {
    data() {
      return {
        horairesId: [],
        
      };
    },
    mounted() {
      this.fetchHorairesId();   
    },
    methods: {
      fetchHorairesId() {
        axios.get('/ecommerce-test/php/Horaires.php',{withcredentials: true})
          .then(response => {
            this.horairesId = response.data;
          })
          .catch(error => {
            console.error('Error:', error);
          });
      },
    },
  };
  </script>
  
  <style>
  </style>