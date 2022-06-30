<template>
  <v-app dark>

    <SideBar/>

    <v-main>
      <v-container>
        <Nuxt />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import SideBar from '../components/SideBar.vue';
export default {
    name: "DefaultLayout",
    components: { SideBar }
}
</script>
