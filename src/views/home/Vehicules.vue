<template>
<NavBar/>
<v-main>
    <v-container>
        <v-row>
            <v-col cols="12" md="3">
                <v-card class="mt-14">
                    <v-card-title>
                        Filtre
                    </v-card-title>
                    <v-divider></v-divider>
                    <h6 class="pl-2">nombre de kilométrage</h6>
 
 <v-slider
    v-model="KilometrageSlider"
    class="align-center"
    :max="KilometrageMax"
    :min="KilometrageMin"
    color="orange"
    hide-details
  >
  <v-spacer></v-spacer>
    <template v-slot:append>
      <v-text-field
        v-model="KilometrageSlider"
        hide-details
        single-line
        density="compact"
        type="number"
        style="width: 100px"
      ></v-text-field>
      <span>km</span>
    </template>
  </v-slider>
  <h6 class="pl-2">Prix</h6>
 
 <v-slider
    v-model="EuroSlider"
    class="align-center"
    :max="EuroMax"
    :min="EuroMin"
    color="orange"
    hide-details
  >
  <v-spacer></v-spacer>
    <template v-slot:append>
      <v-text-field
        v-model="EuroSlider"
        hide-details
        single-line
        density="compact"
        type="number"
        style="width: 100px"
      ></v-text-field>
      <span>€</span>
    </template>
  </v-slider>
  <h6 class="pl-2">Année</h6>
 
 <v-slider
    v-model="AnneeSlider"
    class="align-center"
    :max="AnneeMax"
    :min="AnneeMin"
    color="orange"
    hide-details
  >
  <v-spacer></v-spacer>
    <template v-slot:append>
      <v-text-field
        v-model="AnneeSlider"
        hide-details
        single-line
        density="compact"
        type="number"
        style="width: 100px"
      ></v-text-field>
     
    </template>
  </v-slider>
  <v-btn @click="submitFilter">appliquer filtre</v-btn>
                </v-card>
            </v-col>
            <v-col cols="12" md="9">
                
  <v-card class="d-flex align-center flex-wrap-reverse bg-surface-variant">
  <v-card class="mx-auto my-6" max-width="250"  v-for="(item, index) in paginatedVehiculesData" :key="index">
    <v-img cover :src="item.image" height="200"></v-img>
    <v-card-title>
      <h2>{{ item.titre }}</h2>
      <v-spacer></v-spacer>
      <span>{{ item.prix }}</span>
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
      <v-card>
        <v-img cover :src="selectedItem.image" height="400"></v-img>
        <v-card-title>
          <h2>{{ selectedItem.titre }}</h2>
          <v-spacer></v-spacer>
          <span>{{ selectedItem.prix }}</span>
        </v-card-title>
        <v-card-text>
          {{ selectedItem.description }}
        </v-card-text>
        <v-divider></v-divider>
        <h2>Caractéristiques</h2>
        <v-list-item>
          <v-list>{{selectedItem.annee_mise_en_circulation }}<span> année mise en circulation</span></v-list>
          <v-list>{{ selectedItem.kilometrage }} <span> kilomètre</span></v-list>
        </v-list-item>
        <v-spacer></v-spacer>
        <h3>Formulaire</h3>
        <Formulaire :vehicules_id="selectedItem.vehicules_id" />
        <v-btn color="orange" @click="closeDetailsModal">Fermer</v-btn>
        
      </v-card>
      
   
    </v-dialog>
  </v-card>
</v-card>
  <div class="text-center">
    <v-pagination v-model="pageNumber" :length="20" @input="nextPage"></v-pagination>
  </div>
            </v-col>
        </v-row>
        
    </v-container>
</v-main>
<Footer/>
</template>
<script setup>
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";
import Formulaire from "@/components/Formulaire.vue";
import axios from 'axios';
</script>
<script>
  export default {
    data: () => {
      return {
        pageNumber: 1,
        size: 9,
        KilometrageMin: 10000,
        KilometrageMax: 500000,
        KilometrageSlider: 200000,
        EuroMin: 4790,
        EuroMax:50000,
        EuroSlider:20000,
        AnneeMin:1950,
        AnneeMax:2024,
        AnneeSlider:2010,
        VehiculesData: [],
      detailsModal: false,
      selectedItem: null,
      
      
    };
  },
  mounted() {
    this.submitFilter();
    
  },computed: {
  pageCount() {
      let l = this.VehiculesData.length,
        s = this.size;
      return Math.ceil(l / s) - 1;
    },
    paginatedVehiculesData() {
      const start = this.pageNumber * this.size - this.size,
        end = start + this.size;
      return this.VehiculesData.slice(start, end);
    },
  },
   methods: {
    nextPage(page) {
      this.pageNumber = page;
    },
    submitFilter() {
      axios.get('/ecommerce-test/php/VehiculesAccueil.php?filter=1&kilometrage='+this.KilometrageSlider+"&prix="+this.EuroSlider+"&annee="+this.AnneeSlider,{withcredentials: true})
        .then(response => {
          this.VehiculesData = response.data;
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

<style>

</style>