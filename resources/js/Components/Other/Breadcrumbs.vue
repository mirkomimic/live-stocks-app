<template>
  <v-breadcrumbs :items="props.breadcrumbs" icon="mdi-home" divider="/">
    <template v-slot:item="{item}">
      <v-breadcrumbs-item :disabled="item.disabled">
        <Link :href="route(item.to)" as="button">{{ item.title }}</Link>
      </v-breadcrumbs-item>
    </template>
  </v-breadcrumbs>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { BreadcrumbsType } from '@/Composables/types';

const props = defineProps<{
  breadcrumbs: BreadcrumbsType[]
}>()
</script>