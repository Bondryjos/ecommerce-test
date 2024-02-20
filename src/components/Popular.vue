<template>
  <v-card class="mx-auto my-6" max-width="250" v-for="(item, index) in vehiculesId" :key="index">
    <v-img cover :src="item.image" height="200"></v-img>
    <v-card-title>
      <h2>{{ item.titre }}</h2>
      <v-spacer></v-spacer>
      <span>{{ item.prix }}€</span>
    </v-card-title>
    <v-card-text>
      {{ item.description }}
    </v-card-text>
    <v-divider></v-divider>
    <h2>caractéristique</h2>
    <v-chip-group>
      <v-chip>{{ item.annee_mise_en_circulation }}<span>année mise en circulation</span></v-chip>
      <v-chip>{{ item. kilometrage }}<span>kilomètre</span></v-chip>
    </v-chip-group>
    <v-spacer></v-spacer>
    <v-btn color="orange" @click="openDetailsModal(item)">voir plus</v-btn>

    <v-dialog v-model="detailsModal" max-width="800">
      
      <v-card  >
        <v-img cover :src="selectedItem.image" height="400"></v-img>
        <v-card-title>
          <h2>{{ selectedItem.titre }}</h2>
          <v-spacer></v-spacer>
          <span>{{ selectedItem.prix }} €</span>
        </v-card-title>
        <v-card-text>
          {{ selectedItem.description }}
        </v-card-text>
        <v-divider></v-divider>
        <h2>Caractéristiques</h2>
        <v-list-item>
          <v-list style="background-color: gray;">{{selectedItem.annee_mise_en_circulation }}<span> année mise en circulation</span></v-list>
          <v-list style="background-color: gray;">{{selectedItem.kilometrage }} <span> kilomètre</span></v-list>
        </v-list-item>
        <v-spacer></v-spacer>
        <Formulaire :vehicules_id="vehicules_id" />
        <v-btn color="orange" @click="closeDetailsModal">Fermer</v-btn>
        
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script setup>
import Formulaire from "@/components/Formulaire.vue";
import axios from 'axios';
</script>

<script>
export default {
  data() {
    return {
      vehiculesId: [],
      detailsModal: false,
      selectedItem: null,
    };
  }, mounted() {
    this.fetchVehiculesId();
  },
  

  methods: {
    fetchVehiculesId() {
      axios.get('/ecommerce-test/php/VehiculesAccueil.php?limit=4',{withcredentials: true})
        .then(response => {
          this.vehiculesId = response.data;
        console.log(response.data);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    openDetailsModal(item) {
      this.selectedItem = item; 
      this.detailsModal = true;
    },
    closeDetailsModal() {
       this.detailsModal = false;
    },
    
  },
};
</script>
<style scoped>
.custom-chip-group {
  width: 100%;
}
</style>