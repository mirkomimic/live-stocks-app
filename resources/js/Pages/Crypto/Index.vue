<template>
  <Head title="Crypto" />

  <MainLayout>
    <v-container>
      <Breadcrumbs :breadcrumbs="breadcrumbs"/>

      <div style="height: 500px;">
        <div class="d-flex ga-3">
          <v-select
            v-model="form.symbol"
            @update:modelValue="submit"
            label="Symbol"
            :items="['BTC', 'ETH']"
            variant="solo-filled"
          ></v-select>
  
          <v-select
            v-model="form.year"
            @update:modelValue="submit"
            label="Year"
            :items="['2023', '2024']"
            variant="solo-filled"
          ></v-select>
  
          <v-select
            v-model="form.month"
            @update:modelValue="submit"
            label="Month"
            :items="monthsObject"
            variant="solo-filled"
            item-title="title"
            item-value="title"
          ></v-select>
        </div>
  
        <div v-if="props.crypto.labels" style="height: 500px;">
          <LineChart :labels="props.crypto.labels" :datasets="props.crypto.datasets"/>
        </div>
        <div v-else>No Data!</div>
      </div>
    </v-container>
  </MainLayout>

</template>

<script setup lang="ts">
import LineChart from '@/Components/Charts/LineChart.vue';
import Breadcrumbs from '@/Components/Other/Breadcrumbs.vue';
import { AlphaVantageFiltersForm, BreadcrumbsType, LineChartProps } from '@/Composables/types';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { monthsObject, monthNames } from '@/Composables/data';

const props = defineProps<{
  crypto: LineChartProps,
  filters: AlphaVantageFiltersForm  
}>();

const breadcrumbs: BreadcrumbsType[] = [
  {
    title: 'Home',
    disabled: false,
    to: 'home'
  },
  {
    title: 'Cryptocurrencies',
    disabled: true,
    to: 'crypto.index'
  }
]

const monthValue = (monthTitle: string) => {
  let month = monthsObject.find(month => monthTitle == month.title);

  if (month) return month.title;
}

const form = useForm<AlphaVantageFiltersForm>({
  symbol: props.filters?.symbol ?? 'BTC',
  year: props.filters?.year ?? new Date().getFullYear().toString(),
  month: props.filters?.month ?? monthValue(monthNames[new Date().getMonth()]),
})

const submit = () => {
  form.get(route('crypto.index'))
}


</script>