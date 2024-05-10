<template>
  <Head title="Earnings" />

  <MainLayout>
    <v-container>
      <Breadcrumbs :breadcrumbs="breadcrumbs"/>

      <div>
        <div class="d-flex ga-3">
          <v-select
            v-model="form.symbol"
            @update:modelValue="submit"
            label="Symbol"
            :items="['IBM', 'AAPL']"
            variant="solo-filled"
          ></v-select>
        </div>
  
        <div v-if="props.earnings.labels" style="height: 500px;">
          <BarChart :labels="props.earnings.labels" :datasets="props.earnings.datasets"/>
        </div>
        <div v-else>No Data!</div>
      </div>
    </v-container>
  </MainLayout>

</template>

<script setup lang="ts">
import BarChart from '@/Components/Charts/BarChart.vue';
import Breadcrumbs from '@/Components/Other/Breadcrumbs.vue';
import { BreadcrumbsType, BarChartProps } from '@/Composables/types';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
  earnings: BarChartProps,
  filters: {symbol: string}  
}>();

const breadcrumbs: BreadcrumbsType[] = [
  {
    title: 'Home',
    disabled: false,
    to: 'home'
  },
  {
    title: 'Earnings',
    disabled: true,
    to: 'data.earnings'
  }
]

const form = useForm<{ symbol: string }>({
  symbol: props.filters?.symbol ?? 'IBM',
})

const submit = () => {
  form.get(route('data.earnings'))
}

</script>