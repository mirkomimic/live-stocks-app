<script setup lang="ts">
import Breadcrumbs from '@/Components/Other/Breadcrumbs.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import { BreadcrumbsType } from '@/Composables/types';
import MainLayout from '@/Layouts/MainLayout.vue';

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();

const breadcrumbs: BreadcrumbsType[] = [
  {
    title: 'Home',
    disabled: true,
    to: 'home',
  },
]
</script>

<template>
  <Head title="Profile" />

  <MainLayout>
    <v-container fluid class="pa-0 ma-0 ps-lg-10">
      <Breadcrumbs :breadcrumbs="breadcrumbs"/>
    </v-container>

    <div class="text-h5 w-75 mx-auto my-5 text-teal-lighten-3">Profile</div>

    <div class="mb-5">
      <UpdateProfileInformationForm
        :must-verify-email="mustVerifyEmail"
        :status="status"
      />
    </div>

    <div class="mb-5">
      <UpdatePasswordForm/>
    </div>

    <div class="mb-5">
      <DeleteUserForm/>
    </div>

  </MainLayout>
  
</template>