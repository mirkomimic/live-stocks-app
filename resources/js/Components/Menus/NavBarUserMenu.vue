<template>
  <div class="pa-2">
    <v-menu
      open-on-hover
      location="bottom"
      open-delay="50"
      close-delay="50"
      transition="fade-transition"
    >
      <template v-slot:activator="{ props }">
        <v-btn
          v-bind="props"
          icon
          width="35"
          height="35"
        >
          <v-img width="35" src="/images/user-placeholder.png" alt="" class="rounded-circle"/>
        </v-btn>
        <v-icon v-bind="props" icon="mdi-chevron-down"></v-icon>
      </template>
      <v-list density="compact" rounded="lg" class="mt-2">

        <Link :href="route('profile.edit')" as="button">
          <v-list-item :title="user.name" :subtitle="user.email" append-icon="mdi-account" value="profile.edit"/>
        </Link>
        <div>
          <v-list-item @click="router.post(route('logout'))" title="Logout" append-icon="mdi-logout" value="logout"/>
        </div>

      </v-list>
    </v-menu>
  </div>
</template>

<script setup lang="ts">
import { Link, router, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user

const items = [
  {
    icon: 'mdi-account',
    title: user.name,
    subtitle: user.email,
    value: 'profile.edit'
  },
  {
    icon: 'mdi-logout',
    title: 'Logout',
    // action: () => router.post(route('logout'))
    value: 'logout'
  },
]
</script>