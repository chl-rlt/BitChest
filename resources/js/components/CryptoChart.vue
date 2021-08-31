<template>
<div>Graphique</div>
  
</template>

<script>
import { defineComponent } from 'vue'
import { Line } from 'vue3-chart-v2'

export default defineComponent({
  name: 'CryptoChart',
  extends: Line,
  props: {
    chartData: {
      type: Array,
    },
    chartOptions: {
      type: Object,
    },
  },
  mounted () {
    this.renderChart(this.chartData, this.chartOptions)
  }
})
</script>

<style>

</style>