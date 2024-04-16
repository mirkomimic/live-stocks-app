<template>
  <v-snackbar
    v-model="$page.props.flash.isOpen"
    location="top right"
    position="fixed"
    variant="elevated"
    color="light-blue-darken-4"
    vertical
    timeout="5000"
  >
    <div class="text-subtitle-1 pb-2 font-weight-bold">Message</div>
    <p>{{ $page.props.flash.msg as }}</p>
    <template v-slot:actions>
      <v-btn
        color="black"
        variant="text"
        @click="$page.props.flash.isOpen = false"
      >
        Close
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
</script>