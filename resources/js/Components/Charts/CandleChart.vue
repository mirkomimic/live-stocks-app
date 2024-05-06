<template>
  <div>
    <VueApexCharts :options="data.chartOptions" :series="data.series"/>
  </div>
</template>

<script setup lang="ts">
// https://apexcharts.com/vue-chart-demos/candlestick-charts/basic/
import { intradayProps } from '@/Composables/types';
// @ts-ignore
import VueApexCharts from 'vue3-apexcharts';

const props = defineProps<{
  intradayProps: intradayProps[]
}>()

const data = {
          
  series: [{
    data: props.intradayProps
  }],
  chartOptions: {
    chart: {
      type: 'candlestick',
      height: 350,
      toolbar: {
        show: true,
        tools: {
          download: false,
          zoom: false,
          pan: false,
          reset: false
        }
      }
    },
    title: {
      text: '',
      align: 'left'
    },
    xaxis: {
      type: 'datetime',
      // labels: {
      //   style: {
      //     colors: '#3366cc'
      //   }
      // }
    },
    yaxis: {
      tooltip: {
        enabled: true
      },
      // labels: {
      //   style: {
      //     colors: '#3366cc'
      //   }
      // }
    },
    tooltip: {
      theme: 'dark'
    },



  },  
  
}

</script>