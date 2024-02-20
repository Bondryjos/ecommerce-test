<template>
    <div>
      <NavBarAdmin>

        <template v-slot:default>
          <div>
            <v-row>
                <v-col cols="12" md="4" sm="2" xs="2">
                 
                </v-col>
                <v-col cols="12" md="6">
                    <h2>Bienvenue dans l'espace d'administration</h2>
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
export default  {
  data() {
    return {
    }
  },created(){
    this. VerifyConnection()
},methods :{
  async VerifyConnection(){
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
}
  }

</script>