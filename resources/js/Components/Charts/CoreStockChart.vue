<template>
  <Line :data="data" :options="options">Chart couldn't be loaded.</Line>
</template>

<script setup lang="ts">
import { Line } from 'vue-chartjs'
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js'

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend)

const props = defineProps<{
  labels: string[],
  datasets: Array<{high: string, low: string}>
}>();

const data = {
  labels: props.labels,
  datasets: [
    {
      label: 'High',
      backgroundColor: 'blue',
      borderColor: 'blue',
      data: props.datasets.map(obj => Number(obj.high))
    },
    {
      label: 'Low',
      backgroundColor: 'red',
      borderColor: 'red',
      data: props.datasets.map(obj => Number(obj.low))
    },
  ],
}

const options = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    title: {
      display: true,
      text: 'Core Stock'
    },
  },
}

</script>