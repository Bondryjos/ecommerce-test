<template>
<v-card class="d-flex align-center flex-wrap-reverse bg-surface-variant">
<Popular v-for="(Popular, index) in 3" :key="index"/>
</v-card>
</template>
<script setup>
import Popular from './Popular.vue';

</script>
<style>

</style>