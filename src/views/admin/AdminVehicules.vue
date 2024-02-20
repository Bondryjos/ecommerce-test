<template>
    <div>
      <NavBarAdmin>
        <template v-slot:default>
          <div>
            <v-row>
                <v-col cols="12" md="3" sm="2" xs="2">
                    <h1>Liste des employés </h1>
                    
                
                    <v-table theme="dark">
    <thead class="pt-6">
      <tr>
        <th class="text-left">
          Name
        </th>
        <th class="text-left">
          Role
        </th>
        <th class="text-left">
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in paginatedUsersData" :key="index">
        <td>{{ item.nom }}</td>
        <td>{{ item.role }}</td>
        <td>
          <v-btn @click="deleteusers(item)">supprimer</v-btn>
        </td>
      </tr>
    </tbody>
  </v-table>
  <v-pagination v-model="pageNumber" :length="7" @input="nextPage"></v-pagination>
  <v-btn @click="handleEditedEmployes">ajouter</v-btn>
  <v-dialog v-model="editEmployesDialog" max-width="500">
      <v-card>
        <v-card-title>
          Ajouter des employés
        </v-card-title>
        <v-form   @submit.prevent="submitForm" id="Employes" class="mt-6">
        <v-card-text>
          <v-text-field  label="nom" name="nom"></v-text-field>
          <v-text-field  label="email" name="email"></v-text-field>
          <v-text-field  label="mot_de_passe" name="mot_de_passe"></v-text-field>
          <v-text-field  label="role" name="role"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="submitForm">Ajouter</v-btn>
          <v-btn @click=" cancelEditEmployes">Annuler</v-btn>
        </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
</v-col>
                <v-col cols="12" md="5">
                    <h2>Information garage</h2>
                    <v-table theme="dark">
    <thead class="pt-6">
      <tr>
        <th class="text-left">
          Titre
        </th>
        <th class="text-left">
         Description
        </th>
        <th class="text-left">
          Image
        </th>
        <th class="text-left">
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="item in GaragesData"
        :key="item.garages_id"
      >
        <td>{{ item.titre_accueil }}</td>
        <td>{{ item.description_accueil }}</td>
        <td></td>
        <td>
          <v-btn @click="handleEditedGarage(item)">Voir</v-btn>
        </td>
      </tr>
    </tbody>
    <v-dialog v-model="editGarageDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-form  @submit.prevent=" modifygarages" id="Garage" >
        <v-card-text>
          <v-text-field v-model="editedGarage.titre_accueil" name="titre_accueil" label="Accueil"></v-text-field>
          <v-text-field v-model="editedGarage.description_accueil" name="description_accueil" label="Description_accueil"></v-text-field>
          <v-file-input
        v-model="editedItem.image_accueil" 
        name="image_accueil"
        label="Télécharger une photo"
        accept="image/*"
        @change="handleFileChange"
      ></v-file-input>
          <v-text-field v-model="editedGarage.titre_service " name="titre_service" label="Service"></v-text-field>
          <v-text-field v-model="editedGarage.description_service" name="description_service" label="Description_service"></v-text-field>
          <v-file-input
        v-model="editedItem.image_service" 
        name="image_service"
        label="Télécharger une photo"
        accept="image/*"
        @change="handleFileChange"
      ></v-file-input>
      <v-text-field v-model="editedGarage.gsm" name="gsm" label="numéro"></v-text-field>
      <v-text-field v-model="editedGarage.adresse" name="adresse" label="adresse"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="modifygarages">modifier</v-btn>
          <v-btn @click="cancelEditGarage">Annuler</v-btn>
        </v-card-actions>
        <input type="hidden" name="garages_id" :value="editedGarage.garages_id"/>
      </v-form>
      </v-card>
    </v-dialog>
  </v-table>
                </v-col>
                <v-col cols="12" md="3">
                  <h2>horaires</h2>
                  <v-table theme="dark">
    <thead class="pt-6">
      <tr>
        <th class="text-left">
         jours
        </th>
        <th class="text-left">
         Heure du matin
        </th>
        <th class="text-left">
          Horaires
        </th>
        <th class="text-left">
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="item in HorairesData"
        :key="item.horaires_id"
      >
      <td>{{ item.jours }}</td>
        <td>{{ item.horaires_du_matin }}</td>
        <td>{{ item.horaires_du_soir }}</td>
        <td><v-btn @click="handleEditedHoraires(item)">voir</v-btn></td>
      </tr>
    </tbody>
    <v-dialog v-model="editHorairesDialog" max-width="500">
      <v-card>
        <v-card-title>
          Modifier l'élément
        </v-card-title>
        <v-form  @submit.prevent=" modifyhoraires" id="Horaires" >
        <v-card-text>
          <v-text-field v-model="editedHoraires.jours" name="jours" label="jours"></v-text-field>
          <v-text-field v-model="editedHoraires.horaires_du_matin" name="horaires_du_matin" label="Horaires_du_matin"></v-text-field>
          <v-text-field v-model="editedHoraires.horaires_du_soir" name="horaires_du_soir" label="Horaires_du_soir"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="modifyhoraires">modifier</v-btn>
          <v-btn @click="cancelEditHoraires">Annuler</v-btn>
        </v-card-actions>
        <input type="hidden" name="horaires_id" :value="editedHoraires.horaires_id"/>
        </v-form>
      </v-card>
    </v-dialog>
  </v-table>
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
  </script>
  <script>
 export default {
    data () {
    return {
      GaragesData:[],
      HorairesData:[],
      UsersData:[],
      pageNumber: 1,
      size: 10,
      editDialog: false,
      editGarageDialog: false,
      editContactDialog: false,
      editHorairesDialog: false,
      editEmployesDialog: false,
      editUsersDialog: false,
      editedItem: {},
      editedGarage:{},
      editedContact:{},
      editedHoraires:{},
      editedEmployes:{},
      editedUsers:{},
      
      
    };
  },
  created(){
    this. VerifyGarages()
    this. VerifyHoraires()
    this. VerifyUsers()
    this. VerifyConnection()
},
computed: {
  pageCount() {
      let l = this.UsersData.length,
        s = this.size;
      return Math.ceil(l / s) - 1;
    },
    paginatedUsersData() {
      const start = this.pageNumber * this.size - this.size,
        end = start + this.size;
      return this.UsersData.slice(start, end);
    },
  },
  
  methods: {
    nextPage(page) {
      this.pageNumber = page;
    },
    async VerifyGarages(){
    try {
        const response = await fetch('/ecommerce-test/php/garageAdmin.php',{credentials: 'include'});
    
        const data = await response.json();
        if (data.status==true){
          this.GaragesData=data.garages;

        }
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
  },
  async VerifyHoraires(){
    try {
        const response = await fetch('/ecommerce-test/php/HorairesAdmin.php',{credentials: 'include'});
    
        const data = await response.json();
        if (data.status==true){
          this.HorairesData=data.horaires;

        }
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }
  },
  async VerifyUsers(){
    try {
        const response = await fetch('/ecommerce-test/php/UsersAdmin.php',{credentials: 'include'});
    
        const data = await response.json();
        if (data.status==true){
          this.UsersData=data.users;

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
    handleEditedGarage(item) {
      this.editGarageDialog = true;
      this.editedGarage = { ...item };
      console.log(this.editGarage)
    },
    cancelEditGarage() {
      this.editGarageDialog = false;
    },
    handleEditedUsers(item) {
      this.editUsersDialog = true;
      this.editedUsers = { ...item };
      console.log(this.editUsers)
    },
    cancelEditUsers() {
      this.editUsersDialog = false;
    },
    handleEditedHoraires(item) {
      this.editHorairesDialog = true;
      this.editedHoraires = { ...item };
      console.log(this.editHoraires)
    },
    cancelEditHoraires() {
      this.editHorairesDialog = false;
    },
    handleEditedEmployes(item) {
      this.editEmployesDialog = true;
      this.editedEmployes = { ...item };
      console.log(this.editEmployes)
    },
    cancelEditEmployes() {
      this.editEmployesDialog = false;
    },
    async  submitForm() {
  try {
    const formData = new FormData(document.querySelector('#Employes'));
    const response = await fetch('/ecommerce-test/php/EmployeAdmin.php', {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const responseData = await response.json();

    console.log(responseData);

    if (responseData.status) {
    this.editEmployesDialog=false;
    } else {
      console.log('Échec de l\'envoie');
    }
  } catch (error) {
    console.error('Erreur lors de la soumission du formulaire:', error);
  }
},
async deleteusers(item){
      try {
        const formData = new URLSearchParams();
for (const key in item) {
  formData.append(key, item[key]);
}
        const response = await fetch('/ecommerce-test/php/DeleteEmploye.php',{credentials: 'include' ,method:"post",headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: formData.toString(),});
       
        const data = await response.json();
        
          this.VerifyUsers();

       
      
      } catch (error) {
        console.error('Une erreur est survenu:', error);
      }

    },
    async  modifygarages() {
  try {
    const formData = new FormData(document.querySelector('#Garage'));
    const response = await fetch('/ecommerce-test/php/UpdateGarage.php', {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const responseData = await response.json();

    console.log(responseData);

    if (responseData.status) {
      this.editGarageDialog=false;
    } else {
      console.log('Échec de l\'envoie');
    }
  } catch (error) {
    console.error('Erreur lors de la soumission du formulaire:', error);
  }
},
async  modifyhoraires() {
  try {
    const formData = new FormData(document.querySelector('#Horaires'));
    const response = await fetch('/ecommerce-test/php/UpdateHoraires.php', {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const responseData = await response.json();

    console.log(responseData);

    if (responseData.status) {
      this.editHorairesDialog=false;
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
  