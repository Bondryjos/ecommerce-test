<template>
 
   
    <NavBar />
    
      <v-row id="home">
    <v-col cols="12" md="8" class="mx-auto ma-auto">
    <v-carousel v-model="item_default" :show-arrows="false" class="mt-8">
    <v-carousel-item
      v-for="(item,i) in garageId"
      :key="i"
      :src="item.image_accueil" 
      cover
      >
      
      <v-row>
<v-col>
  <div>
   <h2 class="pl-6 mt-16  " style="color:#FEFEE2; font-family: 'Montserrat', sans-serif; text-shadow: 1px 1px 2px rgba(0, 0, 0, 20);">{{ item.titre_accueil }}</h2>
  </div>
  <div>
  <p class="pl-6 mt-16 " style="color:#FEFEE2 ; text-shadow: 1px 1px 2px rgba(0, 0, 0, 20);"><strong>{{ item.description_accueil }}</strong></p> 
  </div>
</v-col>
      </v-row>
    </v-carousel-item>
  </v-carousel>
</v-col >
</v-row>
<Featured/>
<h2 class="mt-6 text-center">Nos Véhicules </h2>
<GroupCard v-for="(card, index) in 1" :key="index"/>

<h2 class="mt-12 pl-16">les avis de nos clients </h2>

<v-row  class=" mt-12 px-16 ">
    <v-col cols="12"  md="4"  v-for="(item,i) in avisId" :key="i">
    <v-card  width="100%" max-width="350"  class="mx-auto" >
        
                <v-card-title class="bg-orange" >
                    {{ item.nom}}
                </v-card-title>
                
               <v-divider></v-divider>
               
                <v-card-text>
                    {{ item.message }}
                </v-card-text>
                <div class="text-center">
    <v-rating
      v-model="item.note"
      color="orange-lighten-1"
      active-color="orange"
    ></v-rating>
  </div>
            
        <v-card-text >
            <div class="text-center">
    
  </div>

        </v-card-text>

    </v-card>
    
    </v-col>
    
   
</v-row>
<h2 class="mx-auto pl-16">laissez votre avis </h2>
    <v-sheet width="300" class="mx-auto">

<v-form   @submit.prevent="submitForm" id="Avis_users" class="mt-6">
  <v-text-field
    name="nom"
    label="Name"
    required
  ></v-text-field>
  
  <v-text-field
    name="message"
    label="Avis"
    required
  ></v-text-field>

  <v-select
  v-model="select"
  :items="ratings"
  name="note"
  label="Note"
  required
></v-select>


 

  <div class="d-flex flex-column">
    <input type="hidden" name="AvisUsers" value="1">
    <v-btn
      color="orange"
      class="mt-4"
      block
      type="submit"
    >
      envoyer
    </v-btn>  
    <span :style="{ backgroundColor: retouravistype=== true ? 'green' : (retouravistype=== false ? 'red' : 'blue') }">{{ retouravis }}</span> 
  </div>
</v-form>
</v-sheet>


<v-container>
  
  <v-row class="mt-12">
    <v-col cols="12" md="6">

      <h2>Contact info</h2>
      
      <h6>numéro de téléphone :</h6>
      <v-list v-for="(item,i) in garageId"
      :key="i">
        <v-list-title>
           {{ item.gsm }}
        </v-list-title>
      </v-list>
      <h6>adresse :</h6>
      <v-icon class="mdi mdi-map-marker">
      
    </v-icon>
      <v-list v-for="(item,i) in garageId"
      :key="i">
        <v-list-title>
           {{ item.adresse }}
        </v-list-title>
      </v-list>
    </v-col>
   
    <Formulaire/>
  </v-row>
</v-container>

<Footer/>






  
  
</template>

<script setup >
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";
import Featured from "@/components/Featured.vue";
import GroupCard from "@/components/GroupCard.vue";
import Formulaire from "@/components/Formulaire.vue";
import axios from 'axios';
</script>
<script >
export default {
  data() {
    return {
      garageId: [],
      avisId: [],
      clients: [],
      item_default:0,
      nom:'',
      message:'',
      select:5,
      ratings: [1, 2, 3, 4, 5],
      retouravis:'',
      retouravistype:false,
    };
  },
  mounted() {
    this.fetchGarageId();
    this.fetchAvis();
    console.log('garageId:', this.garageId);
  console.log('clients:', this.clients);
  console.log('garageId contents:', JSON.stringify(this.garageId));
  },
  methods: {
    fetchGarageId() {
      axios.get('/ecommerce-test/php/garage.php',{withcredentials: true})
        .then(response => {
          this.garageId = response.data;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    fetchAvis() {
      axios.get('/ecommerce-test/php/AvisAccueil.php',{withcredentials: true})
        .then(response => {
          this.avisId = response.data;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    submitForm() {
      

      axios.post('/ecommerce-test/php/Avis.php', document.querySelector('#Avis_users'),{withcredentials: true})
        .then(response => {
        this.retouravis=response.data.message;
        this.retouravistype=response.data.status==='success'?true:false;
          console.log(response)
          if (response.data.status) {
            
          } else {
            console.log('Échec de l\'envoie');
          }
        })
        .catch(error => {
          console.error('Erreur lors de la soumission du formulaire:', error);
        });
    },
  },
};
</script>
<style scoped>

</style>