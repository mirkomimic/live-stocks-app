<template>
  <v-toolbar
    color="transparent"
    density="compact"
  >
    <v-container class="py-0 h-100">
      <div class="ml-auto d-flex align-center ga-4 h-100">

        <div class="d-none d-md-block">
          <Link href="/" as="button">
            <img width="70" src=""> ICON
          </Link>
        </div>

        <v-spacer></v-spacer>

        <!-- <Link
          href="/"
          as="button"
          class="h-100 -mb-1"
          :class="{'text-cyan-lighten-1': route().current('home')}"
        >
          Stocks
        </Link>
        <Link
          :href="route('crypto.index')"
          as="button"
          class="h-100 -mb-1"
          :class="{'text-cyan-lighten-1': route().current('crypto.index')}"
        >
          Crypto
        </Link> -->

        <TopNavigation/>

        <v-spacer></v-spacer>

        <Link v-if="!$page.props.auth.user" :href="route('login')" as="button">Log in</Link>
        <Link v-if="!$page.props.auth.user" :href="route('register')" as="button">Register</Link>
        <v-switch
          @click="toggleTheme(theme)"
          density="compact"
          true-icon="mdi-white-balance-sunny"
          false-icon="mdi-weather-night"
          color="orange-darken-3"
          value="secondary"
          hide-details
        ></v-switch>
        <NavBarUserMenu v-if="$page.props.auth.user"/>
      </div>
    </v-container>
  </v-toolbar>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { toggleTheme } from '@/Composables/helpers'
import { useTheme } from 'vuetify'
import NavBarUserMenu from './Menus/NavBarUserMenu.vue';
import TopNavigation from './Other/TopNavigation.vue';

const theme = useTheme()

</script>