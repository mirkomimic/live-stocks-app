<script setup lang="ts">
import CoreStockChart from '@/Components/Charts/CoreStockChart.vue';
import Breadcrumbs from '@/Components/Other/Breadcrumbs.vue';
import { BreadcrumbsType, CoreStocksProps, CoreStocksForm } from '@/Composables/types';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { monthsObject, monthNames } from '@/Composables/data';

const props = defineProps < {
  coreStocks: CoreStocksProps;
  filters: CoreStocksForm
}>();

const breadcrumbs: BreadcrumbsType[] = [
  {
    title: 'Home',
    disabled: true,
    to: 'home'
  }
]

const monthValue = (monthTitle: string) => {
  let month = monthsObject.find(month => monthTitle == month.title);

  if (month) return month.title;
}

const form = useForm<CoreStocksForm>({
  symbol: props.filters?.symbol ?? 'IBM',
  year: props.filters?.year ?? new Date().getFullYear().toString(),
  month: props.filters?.month ?? monthValue(monthNames[new Date().getMonth()]),
})

const submit = () => {
  form.get(route('home'))
}

// window.Echo.channel('testChannel').listen('testEvent', (e: any) => {
//   console.log(e.message);
// })

</script>

<template>

  <Head title="Home" />

  <MainLayout>
    <v-container>
      <Breadcrumbs :breadcrumbs="breadcrumbs"/>

      <div style="height: 500px;">

        <div class="d-flex ga-3">
          <v-select
            v-model="form.symbol"
            @update:modelValue="submit"
            label="Symbol"
            :items="['IBM', 'AAPL']"
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

        <div v-if="props.coreStocks.labels" style="height: 500px;">
          <CoreStockChart :labels="props.coreStocks.labels" :datasets="props.coreStocks.datasets"/>
        </div>
        <div v-else>No Data!</div>

      </div>
    </v-container>
  </MainLayout>
</template>