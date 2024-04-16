<template>
  <v-layout>
    <v-main>
      <v-fade-transition>
        <div v-if="animatePage">
          <slot/>
        </div>
      </v-fade-transition>
    </v-main>
  </v-layout>
</template>

<script setup lang="ts">
import { Ref } from 'vue';
import { ref, onMounted } from 'vue';

let animatePage: Ref<boolean> = ref(false)

onMounted(() => {
  animatePage.value = true
})
</script>