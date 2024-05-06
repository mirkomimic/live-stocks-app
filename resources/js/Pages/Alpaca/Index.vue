<template>
  <Head title="Intraday Stocks" />

  <MainLayout>
    <v-container>
      <Breadcrumbs :breadcrumbs="breadcrumbs"/>
      <v-btn @click="ws.close()">Close</v-btn>
      <div>Websocket message: {{ msg }}</div>
      <div>- Monday to Friday 09:30 to 16:30 EST (14:30 to 21:00 GMT)</div>
      
      <div class="d-flex ga-3">
        <v-select
          v-model="form.symbol"
          @update:modelValue="submit"
          label="Symbol"
          :items="['IBM', 'AAPL']"
          variant="solo-filled"
        ></v-select>
      </div>

      <CandleChart :intradayProps="candleChartProps"/>
    </v-container>
  </MainLayout>

</template>

<script setup lang="ts">
import CandleChart from '@/Components/Charts/CandleChart.vue';
import Breadcrumbs from '@/Components/Other/Breadcrumbs.vue';
import { BreadcrumbsType, intradayProps } from '@/Composables/types';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { withCtx } from 'vue';
import { ref, Ref } from 'vue';

const breadcrumbs: BreadcrumbsType[] = [
  {
    title: 'Home',
    disabled: false,
    to: 'home'
  },
  {
    title: 'Alpaca',
    disabled: true,
    to: 'alpaca.index'
  }
]

const props = defineProps<{
  intradayProps: intradayProps[],
  filters: {symbol: string}  
}>()

const msg: Ref<string> = ref('')
const candleChartProps: Ref<intradayProps[]> = ref([])

const form = useForm<{ symbol: string }>({
  symbol: props.filters?.symbol ?? 'IBM',
})

// trading
const ws = new WebSocket('wss://stream.data.alpaca.markets/v2/iex');

const submit = () => {
  ws.close();
  form.get(route('alpaca.index'))
}

ws.onopen = () => {
  console.log('Connected');

  const authData = {
    action: 'auth',
    key: usePage().props.alpaca.key,
    secret: usePage().props.alpaca.secret
  };

  const subscribe = {
    action: 'subscribe',
    trades: [form.symbol],
    // quotes: ['AMD', 'CLDR'],
    bars: [form.symbol],
    // dailyBars: ['AAPL'],
  }
  
  ws.send(JSON.stringify(authData));
  ws.send(JSON.stringify(subscribe));
};

ws.onmessage = (event) => {

  let object = JSON.parse(event.data);
  msg.value = object[0]
  console.log(event);

  if (object[0].T === 'b') {
    candleChartProps.value.push({
      x: new Date(Date.parse(object[0].t)),
      y: [object[0].o, object[0].h, object[0].l, object[0].c]
    })
  }
  
};
</script>