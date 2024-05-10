<template>
  <Head title="Top Gainers And Losers" />

  <MainLayout>
    <v-container>
      <Breadcrumbs :breadcrumbs="breadcrumbs"/>

      <v-row>
        <v-col
          cols="12"
          md="4"
          sm="6"
        >

          <div class="d-flex ga-2">
            <v-icon icon="fa:fa-solid fa-money-bill-trend-up"></v-icon>
            <h6 class="text-h6 mb-3">Top Gainers</h6>
          </div>

          <div v-for="(item, index) in topGainersAndLosers.top_gainers" :key="item.ticker">
            <v-card 
              class="mb-5"
              color="teal-lighten-1"
              hover
              v-motion-fade-visible
            >
              <v-card-text>
                <div class="position-absolute top-0 right-0 pa-3 bg-lime-accent-1 rounded-bs-lg">{{ index + 1 }}</div>
                <div>Ticker: {{ item.ticker }}</div>
                <div>Price: {{ item.price }}</div>
                <div>Change Amount: {{ item.change_amount }}</div>
                <div>Change Percentage: {{ item.change_percentage }}</div>
                <div>Volume: {{ item.volume }}</div>
              </v-card-text>
            </v-card>
          </div>
        </v-col>

        <v-col
          cols="12"
          md="4"
          sm="6"
        >
          <div class="d-flex ga-2">
            <v-icon icon="fa:fa-solid fa-arrow-trend-down"></v-icon>
            <h6 class="text-h6 mb-3">Top Losers</h6>
          </div>

          <div v-for="(item, index) in topGainersAndLosers.top_losers" :key="item.ticker">
            <v-card 
              class="mb-5"
              color="red-lighten-1"
              hover
              variant="outlined"
              v-motion
              :initial="{opacity: 0, x: 100}"
              :visible="{opacity: 1, x: 0}"
            >
              <v-card-text>
                <div class="position-absolute top-0 right-0 pa-3 bg-lime-accent-1 rounded-bs-lg">{{ index + 1 }}</div>
                <div>Ticker: {{ item.ticker }}</div>
                <div>Price: {{ item.price }}</div>
                <div>Change Amount: {{ item.change_amount }}</div>
                <div>Change Percentage: {{ item.change_percentage }}</div>
                <div>Volume: {{ item.volume }}</div>
              </v-card-text>
            </v-card>
          </div>
        </v-col>

        <v-col
          cols="12"
          md="4"
          sm="6"
        >

          <div class="d-flex ga-2">
            <img style="width: 50px;" src="/icons/business.png"/>
            <h6 class="text-h6 mb-3">Top Most Actively Traded</h6>
          </div>

          <div v-for="(item, index) in topGainersAndLosers.most_actively_traded" :key="item.ticker">
            <v-card 
              class="mb-5"
              color="light-green-lighten-1"
              hover
              variant="tonal"
              v-motion-fade-visible-once
            >
              <v-card-text>
                <div class="position-absolute top-0 right-0 pa-3 bg-lime-accent-1 rounded-bs-lg">{{ index + 1 }}</div>
                <div>Ticker: {{ item.ticker }}</div>
                <div>Price: {{ item.price }}</div>
                <div>Change Amount: {{ item.change_amount }}</div>
                <div>Change Percentage: {{ item.change_percentage }}</div>
                <div>Volume: {{ item.volume }}</div>
              </v-card-text>
            </v-card>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </MainLayout>

</template>


<script setup lang="ts">
import Breadcrumbs from '@/Components/Other/Breadcrumbs.vue';
import { BreadcrumbsType, TopGainersAndLosers } from '@/Composables/types';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbsType[] = [
  {
    title: 'Home',
    disabled: false,
    to: 'home'
  },
  {
    title: 'Top Gainers And Losers',
    disabled: true,
    to: 'alpha-intelligence.topGainersAndLosers'
  }
]

const props = defineProps<{
  topGainersAndLosers: TopGainersAndLosers
}>()
</script>