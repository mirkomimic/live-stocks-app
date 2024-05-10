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
      <Notification v-model="notificationProp.isOpen" :message="notificationProp.message"/>

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
import { useDisplay } from 'vuetify';
import Notification from '@/Components/Other/Notification.vue';
import { Ref, ref } from 'vue';
import { UserNotification } from '@/Composables/types';
import { usePage } from '@inertiajs/vue3';

const notificationProp: Ref<{
  isOpen: boolean,
  message: string
}> = ref({
  isOpen: false,
  message: ''
})

const display = ref(useDisplay()) 

window.Echo.private('App.Models.User.' + usePage().props.auth.user?.id).notification((notification: UserNotification) => {
  notificationProp.value.isOpen = true
  notificationProp.value.message = notification.message
});

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