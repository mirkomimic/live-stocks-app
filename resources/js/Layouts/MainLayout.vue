<template>
  <v-app>
    <v-app-bar 
      scroll-behavior="hide"
      scroll-threshold="50"
      elevation="2"
      density="comfortable"
    >
      <NavBar></NavBar>
    </v-app-bar>

    <v-main>
      <Transition name="fade" appear>
        <div>
          <slot/>
        </div>
      </Transition>
    </v-main>

    <v-bottom-navigation :elevation="0" v-if="display.smAndDown">
      <!-- <BottomNav/> -->
    </v-bottom-navigation>

    <v-footer style="z-index: 20;" v-if="display.mdAndUp">
      <!-- <MainFooter/> -->
    </v-footer>

  </v-app>
</template>

<script setup lang="ts">
import NavBar from '@/Components/NavBar.vue';
import { ref } from 'vue';
import { useDisplay } from 'vuetify';

const display = ref(useDisplay()) 

</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>