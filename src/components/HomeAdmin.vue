<template>
    <nav-bar-admin>
      <template v-slot:content>
        <div v-if="$route.path === '/admin'">
          <h1>Home Page Content</h1>
          <p>hello world </p>
        </div>
      </template>
    </nav-bar-admin>
  </template>
  
  <script>
  import NavBarAdmin from "@/components/NavBarAdmin.vue";
  
  export default {
    components: {
      NavBarAdmin,
    },
  };
  </script>