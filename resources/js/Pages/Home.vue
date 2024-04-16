<script setup lang="ts">
import Breadcrumbs from '@/Components/Other/Breadcrumbs.vue';
import { BreadcrumbsType } from '@/Composables/types';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

const breadcrumbs: BreadcrumbsType[] = [
  {
    title: 'Home',
    disabled: true,
    to: 'home'
  }
]

// window.Echo.channel('testChannel').listen('testEvent', (e: any) => {
//   console.log(e.message);
// })


</script>

<template>

  <Head title="Home" />

  <MainLayout>
    <v-container>
      <Breadcrumbs :breadcrumbs="breadcrumbs"/>
    </v-container>
  </MainLayout>

  <div class="">


  
  </div>
</template>