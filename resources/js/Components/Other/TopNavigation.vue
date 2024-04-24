<template>
  <div v-for="(item, index) in navItems" :key="index">
    <Link
      v-if="!item.items"
      :href="route(String(item.href))"
      as="button"
    >
      <v-btn class="pa-1">{{ item.name }}</v-btn>
    </Link>
    <v-menu 
      v-else
      open-on-hover
    >
      <template v-slot:activator="{ props }">
        <v-btn
          v-bind="props"
          class="pa-1"
          append-icon="mdi-chevron-down"
        >
          {{ item.name }}
        </v-btn>
      </template>
      <v-list>
        <v-list-item
          v-for="(subItem, index) in item.items"
          :key="index"
          :value="index"
        >
          <v-list-item-title>
            <Link
              :href="route(String(subItem.href))"
              as="button"
              >{{ subItem.name }}
            </Link>
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const navItems = [
  {
    name: 'Stocks',
    href: 'home',
  },
  {
    name: 'Crypto',
    items: [
      {
        name: 'Daily',
        href: 'crypto.index',
      },
      {
        name: 'Intraday',
        href: 'crypto.intraday',
      },
    ]
  },
]
</script>