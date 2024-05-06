<template>
  <Head title="Crypto" />

  <MainLayout>
    <v-container>
      <Breadcrumbs :breadcrumbs="breadcrumbs"/>

      <Notification v-model="notificationProp.isOpen" :message="notificationProp.message"/>

      <div style="height: 500px;">
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

      <v-btn @click="testNotification">Test</v-btn>
    </v-container>
  </MainLayout>

</template>

<script setup lang="ts">
import BarChart from '@/Components/Charts/BarChart.vue';
import Breadcrumbs from '@/Components/Other/Breadcrumbs.vue';
import Notification from '@/Components/Other/Notification.vue';
import { BreadcrumbsType, BarChartProps, UserNotification } from '@/Composables/types';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, router, useForm, usePage } from '@inertiajs/vue3';
import { Ref, ref } from 'vue';

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

const notificationProp: Ref<{
  isOpen: boolean,
  message: string
}> = ref({
  isOpen: false,
  message: ''
})

const form = useForm<{ symbol: string }>({
  symbol: props.filters?.symbol ?? 'IBM',
})

const submit = () => {
  form.get(route('data.earnings'))
}

const testNotification = () => {
  router.post(route('testNotification'));
}

window.Echo.private('App.Models.User.' + usePage().props.auth.user?.id).notification((notification: UserNotification) => {
  notificationProp.value.isOpen = true
  notificationProp.value.message = notification.message
});
</script>