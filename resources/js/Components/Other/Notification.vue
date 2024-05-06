<template>
  <v-snackbar
    v-model="isOpen"
    location="top right"
    position="fixed"
    timeout="5000"
    variant="elevated"
    color="rgba(33,250,182,0.7)"
    vertical
  >
    <div class="text-subtitle-1 pb-2 font-weight-bold">Message</div>

    <p>{{ props.message }}</p>

    <template v-slot:actions>
      <v-btn
        color="black"
        variant="text"
        @click="isOpen = false"
      >
        Close
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script setup lang="ts">

const isOpen = defineModel<boolean>()

const props = defineProps<{
  message: string
}>();
</script>
