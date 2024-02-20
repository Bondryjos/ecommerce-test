<template>
    <div>
      <NavBarAdmin>
        <template v-slot:default>
          <div>
            <v-row>
                <v-col cols="12" md="4" sm="2" xs="2">
                    <h1>Liste des véhicules</h1>
                    <v-table theme="dark">
    <thead class="pt-6">
      <tr>
        <th class="text-left">
          Véhicules
        </th>
        <th class="text-left">
          Prix
        </th>
        <th class="text-left">
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in paginatedVehiculesData" :key="index">
        <td>{{ item.titre }}</td>
        <td>{{ item.prix }}</td>
        <td>
          <v-btn @click="handleEditedFormulaire(item)">Voir</v-btn>
          <v-btn @click="deletevehicules(item)">supprimer</v-btn>
        </td>
      </tr>
    </tbody>
    <v-dialog v-model="editFormulaireDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-form   @submit.prevent="modifyvehicules" id="Vehicules_modify" class="mt-6">
        <v-card-text>
          <v-text-field v-model="editedFormulaire.titre" name="titre" label="titre"></v-text-field>
          <v-text-field v-model="editedFormulaire.prix" name="prix" label="prix"></v-text-field>
          <v-text-field v-model="editedFormulaire.description" name="description" label="description"></v-text-field>
          <v-text-field v-model="editedFormulaire.annee_mise_en_circulation" name="annee_mise_en_circulation" label="annee_mise_en_circulation"></v-text-field>
          <v-text-field v-model="editedFormulaire.kilometrage" name="kilometrage" label="kilometrage"></v-text-field>
          <v-file-input
        v-model="editedItem.image" 
        name="image"
        label="Télécharger une photo"
        accept="image/*"
        @change="handleFileChange"
      ></v-file-input>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="modifyvehicules">Modifier</v-btn>
          <v-btn @click="cancelEditFormulaire">Annuler</v-btn>
        </v-card-actions>
        <input type="hidden" name="vehicules_id" :value="editedFormulaire.vehicules_id"/>
      </v-form>
      </v-card>
    </v-dialog>
  </v-table>
  <v-pagination v-model="vehiculesPageNumber" :length="7" @input="nextPage"></v-pagination>
  <v-btn @click="handleEditedVehicules">ajouter</v-btn>
  <v-dialog v-model="editVehiculesDialog" max-width="500">
      <v-card>

        <v-card-title>
          Ajouter des véhicules
        </v-card-title>
        <v-form   @submit.prevent="submitForm" id="Vehicules" class="mt-6">
        <v-card-text>
          <!-- Formulaire de modification -->
          <v-text-field  label="prix" name="prix"></v-text-field>
          <v-text-field  label="annee_mise_en_circulation" name="annee_mise_en_circulation"></v-text-field>
          <v-text-field  label="kilometrage" name="kilometrage"></v-text-field>
          <v-text-field  label="titre" name="titre"></v-text-field>
          <v-text-field  label="description" name="description"></v-text-field>
          <v-file-input
        v-model="editedItem.image_accueil" 
        label="Télécharger une photo"
        accept="image/*"
        name="image"
        @change="handleFileChange"
      ></v-file-input>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="submitForm">ajouter</v-btn>
          <v-btn @click="cancelEditVehicules">Annuler</v-btn>
        </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
                </v-col>
                <v-col cols="12" md="4">
                    <h2>Formulaire</h2>
                    <v-table theme="dark">
    <thead class="pt-6">
      <tr>
        <th class="text-left">
          Nom
        </th>
        <th class="text-left">
        prenom
        </th>
        <th class="text-left">
          action
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in paginatedFormulairesData" :key="index">
        <td>{{ item.nom }}</td>
        <td>{{ item.prenom }}</td>
        <td>
          <v-btn @click="handleEditedContact(item)">voir</v-btn>
          <v-btn @click="deleteformulaires(item)">supprimer</v-btn>
          
        </td>
      </tr>
    </tbody>
    <v-dialog v-model="editContactDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-card-text>
         <div>
          <strong>nom :</strong> {{ editedContact.nom }}
         </div>
         <div>
         <strong>prenom :</strong> {{ editedContact.prenom }}
         </div>
         <div>
         <strong>gsm :</strong> {{ editedContact.gsm }}
         </div>
         <div>
         <strong>email :</strong> {{ editedContact.email }}
         </div>
         <div>
         <strong>message :</strong> {{ editedContact.message }}
         </div>
         <div> 
          {{ getVehicleById(editedContact.vehicules_id) == null ? 'Aucun véhicule trouvé' :getVehicleById(editedContact.vehicules_id).titre }}
         </div>
         <div>
          {{ getVehicleById(editedContact.vehicules_id) == null ? '' :getVehicleById(editedContact.vehicules_id).prix }}
         </div>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="saveEdit">Enregistrer</v-btn>
          <v-btn @click="cancelEditContact">Annuler</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-table>
  <v-pagination v-model="formulairesPageNumber" :length="7" @input="nextPage"></v-pagination>
                </v-col>
                <v-col cols="12" md="4" sm="2" xs="2">
                    <h1>avis</h1>
                    <v-table theme="dark">
    <thead>
      <tr>
        <th class="text-left">
          Nom
        </th>
        
        <th class="text-left">
          Note
      </th>
      <th class="text-left">
          Action
      </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in paginatedAvisData" :key="index">
        <td>{{ item.nom }}</td>
        <td>{{ item.note }}</td>
        <td>
          <v-btn @click="editItem(item)">Voir</v-btn>
          <v-btn @click="postavis(item)">poster</v-btn>
          <v-btn @click="deleteavis(item)">supprimer</v-btn>
          
        </td>
      </tr>
    </tbody>
    <v-dialog v-model="editDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-card-text>
          <div>
          <strong>nom :</strong> {{ editedItem.nom }}
         </div>
         <div>
         <strong>message :</strong> {{ editedItem.message }}
         </div>
         <div>
         <strong>note :</strong> {{ editedItem.note }}
         </div>
         
        </v-card-text>
        <v-card-actions>
          <v-btn @click="saveEdit">Enregistrer</v-btn>
          <v-btn @click="cancelEdit">Annuler</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-table>
  <v-pagination v-model="pageNumber" :length="7" @input="nextPage"></v-pagination>
                </v-col>
            </v-row>
          </div>
        </template>
      </NavBarAdmin>
      <FooterAdmin/>
    </div>
  </template>
  
  <script setup>
  import NavBarAdmin from "@/components/NavBarAdmin.vue";
  import FooterAdmin from "@/components/FooterAdmin.vue";
  import axios from 'axios';
  </script>
  <script>
export default {
    data () {
    return {
      AvisData:[],
      VehiculesData:[],
      FormulairesData:[],
      pageNumber: 1,
      vehiculesPageNumber: 1,
      formulairesPageNumber: 1,
      size: 10,
      editDialog: false,
      editFormulaireDialog: false,
      editContactDialog: false,
      editVehiculesDialog:false,
      editAddDialog:false,
      editedItem: {},
      editedFormulaire:{},
      editedContact:{},
      editedVehicules:{},
    };
  },
  created(){
    this. VerifyAvis()
    this. VerifyVehicules()
    this. VerifyFormulaires()
    this. VerifyConnection()
},computed: {
  pageCount() {
      let l = this.AvisData.length,
        s = this.size;
      return Math.ceil(l / s) - 1;
    },
    vehiculesPageCount() {
    let l = this.VehiculesData.length,
      s = this.size;
    return Math.ceil(l / s) - 1;
  },
  formulairesPageCount() {
    let l = this.FormulairesData.length,
      s = this.size;
    return Math.ceil(l / s) - 1;
  },
    paginatedAvisData() {
      const start = this.pageNumber * this.size - this.size,
        end = start + this.size;
      return this.AvisData.slice(start, end);
    },
    paginatedVehiculesData() {
      const start = this.vehiculesPageNumber * this.size - this.size,
        end = start + this.size;
      return this.VehiculesData.slice(start, end);
    },
    paginatedFormulairesData() {
      const start = this.formulairesPageNumber * this.size - this.size,
        end = start + this.size;
      return this.FormulairesData.slice(start, end);
    }
  },
  methods: {
    nextPage(page) {
      this.pageNumber = page;
    },
    vehiculesNextPage(page) {
    this.vehiculesPageNumber = page;
  },
  formulairesNextPage(page) {
    this.formulairesPageNumber = page;
  },
    async VerifyAvis(){
    try {
        const response = await fetch('/ecommerce-test/php/AvisAdmin.php',{credentials: 'include'});
    
        const data = await response.json();
        if (data.status==true){
          this.AvisData=data.avis;

        }
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
  },
  async VerifyFormulaires(){
    try {
        const response = await fetch('/ecommerce-test/php/FormulairesAdmin.php',{credentials: 'include'});
    
        const data = await response.json();
        if (data.status==true){
          this.FormulairesData=data.formulaires;

        }
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
  },
    editItem(item) {
      this.editDialog = true;
      this.editedItem = { ...item };
    },
    saveEdit() {
      console.log('Enregistrer les modifications :', this.editedItem);
      this.editDialog = false;
    },
    cancelEdit() {
      this.editDialog = false;
    },
    handleEditedFormulaire(item) {
      this.editFormulaireDialog = true;
      this.editedFormulaire = { ...item };
      console.log(this.EditedFormulaire)
    },
    cancelEditFormulaire() {
      this.editFormulaireDialog = false;
    },
    handleEditedContact(item) {
      this.editContactDialog = true;
      this.editedContact = { ...item };
      console.log(this.editContact)
    },
    cancelEditContact() {
      this.editContactDialog = false;
    },
    handleEditedAdd(item) {
      this.editAddDialog = true;
    
    },
    cancelEditAdd() {
      this.editAddDialog = false;
    },
    handleEditedVehicules(item) {
      this.editVehiculesDialog = true;
      this.editedVehicules = { ...item };
      console.log(this.editVehicules)
    },
    cancelEditVehicules() {
      this.editVehiculesDialog = false;
    },
   async postavis(item){
      try {
        const formData = new URLSearchParams();
for (const key in item) {
  formData.append(key, item[key]);
}
        const response = await fetch('/ecommerce-test/php/AvisPost.php',{credentials: 'include' ,method:"post",headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: formData.toString(),});
       
        const data = await response.json();
        
          this.VerifyAvis();

       
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
    },
    async deleteavis(item){
      try {
        const formData = new URLSearchParams();
for (const key in item) {
  formData.append(key, item[key]);
}
        const response = await fetch('/ecommerce-test/php/DeletePost.php',{credentials: 'include' ,method:"post",headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: formData.toString(),});
       
        const data = await response.json();
        
          this.VerifyAvis();

       
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
    },
    async  submitForm() {
  try {
    const formData = new FormData(document.querySelector('#Vehicules'));
    const response = await fetch('/ecommerce-test/php/VehiculesAdmin.php', {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const responseData = await response.json();

    console.log(responseData);

    if (responseData.status) {
      this.editVehiculesDialog=false;
    } else {
      console.log('Échec de l\'envoie');
    }
  } catch (error) {
    console.error('Erreur lors de la soumission du formulaire:', error);
  }
},
async VerifyVehicules(){
    try {
        const response = await fetch('/ecommerce-test/php/RecupVehicules.php',{credentials: 'include'});
    
        const data = await response.json();
        if (data.status==true){
          this.VehiculesData=data.vehicules;

        }
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
  },
  async deletevehicules(item){
      try {
        const formData = new URLSearchParams();
for (const key in item) {
  formData.append(key, item[key]);
}
        const response = await fetch('/ecommerce-test/php/DeleteVehicules.php',{credentials: 'include' ,method:"post",headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: formData.toString(),});
       
        const data = await response.json();
        
          this.VerifyVehicules();

       
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
    },
    async deleteformulaires(item){
      try {
        const formData = new URLSearchParams();
for (const key in item) {
  formData.append(key, item[key]);
}
        const response = await fetch('/ecommerce-test/php/DeleteFormulaire.php',{credentials: 'include' ,method:"post",headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: formData.toString(),});
       
        const data = await response.json();
        
          this.VerifyFormulaires();

       
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
    }, getVehicleById(vehicleId) {
      const vehiculeTrouve = this.VehiculesData.find(vehicule => vehicule.vehicules_id === vehicleId);

      return vehiculeTrouve || null;
    },
    async  modifyvehicules() {
  try {
    const formData = new FormData(document.querySelector('#Vehicules_modify'));
    const response = await fetch('/ecommerce-test/php/UpdateVehicules.php', {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const responseData = await response.json();

    console.log(responseData);

    if (responseData.status) {
      this.editFormulaireDialog=false;
    } else {
      console.log('Échec de l\'envoie');
    }
  } catch (error) {
    console.error('Erreur lors de la soumission du formulaire:', error);
  }
},async VerifyConnection(){
    try {
        const response = await fetch('/ecommerce-test/php/verifier.php',{credentials: 'include'});
    
        const data = await response.json();
        if (data.status==false){
          this.$router.push('/login');
        }
        console.log('Retour: ', data);
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
  }


  },
};
</script>