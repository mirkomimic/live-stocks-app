<template>
  <Head title="Crypto" />

  <MainLayout>
    <v-container>
      <Breadcrumbs :breadcrumbs="breadcrumbs"/>

      <div style="height: 500px;">  
        <v-select
          v-model="form.symbol"
          @update:modelValue="submit"
          label="Symbol"
          :items="['BTC', 'ETH']"
          variant="solo-filled"
        ></v-select>

        <div v-if="lineChartData.labels" style="height: 500px;">
          <LineChart :labels="lineChartData.labels" :datasets="lineChartData.datasets"/>
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
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { Ref } from 'vue';
import { ref } from 'vue';

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
    title: 'Cryptocurrencies Intraday',
    disabled: true,
    to: 'crypto.intraday'
  }
]

const lineChartData: Ref<LineChartProps> = ref(props.crypto)

const form = useForm<{symbol: string}>({
  symbol: props.filters?.symbol ?? 'BTC',
})

const submit = () => {
  form.get(route('crypto.intraday'))
}

window.Echo.channel('crypto-intraday').listen('CryptoIntradayEvent', (e: any) => {
  // console.log(e.array);
  lineChartData.value = e.array;
})

</script>