<template>
  <v-stepper v-model="step" :items="items" show-actions class="mt-12" id="service">
    <template v-for="(item, index) in garageId" :key="index">
      <v-step :complete="step > index">
        <v-row :class="{'flex-row-reverse': index % 2 !== 0}" v-if="step === index + 1">
          <v-col cols="12" md="4">
            <v-img :src="item.image_service" height="400"></v-img>
          </v-col>
          <v-col cols="12" md="8">
            <h2>{{ item.titre_service }}</h2>
            <p>{{ item.description_service }}</p>
          </v-col>
        </v-row>
      </v-step>
    </template>
  </v-stepper>
</template>

<script setup>
import axios from 'axios';
</script>

<script>
export default {
  data() {
    return {
      garageId: [],
      step: 1,
      items: [
        'Service 1',
        'Service 2',
        'Service 3',
      ],
    };
  },
  mounted() {
    this.fetchGarageId();
  },
  methods: {
    fetchGarageId() {
      axios.get('/ecommerce-test/php/garage.php', { withCredentials: true })
        .then(response => {
          this.garageId = response.data;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
  },
};
</script>
