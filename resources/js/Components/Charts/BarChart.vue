<template>
  <Bar :data="data" :options="options">Chart couldn't be loaded.</Bar>
</template>

<script setup lang="ts">
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps<{
  labels: string[],
  datasets: Array<{reportedEPS: string }>
}>();

const data = {
  labels: props.labels,
  datasets: [
    {
      label: 'Earnings',
      backgroundColor: 'gray',
      borderColor: 'gray',
      data: props.datasets
    },
  ],
}

const options = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    title: {
      display: true,
      text: ''
    },
  },
}

</script>