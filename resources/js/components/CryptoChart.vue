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
      const date = this.chartData.map(data => data.date).reverse();
      const prices = this.chartData.map(data => data.price).reverse();

    this.renderChart(
        {
            labels: date,
            datasets:[
                {
                    label: 'Price',
                    backgroundColor: '#f87979',
                    data: prices
                }
            ],
        },
        this.chartOptions
    );
    // this.renderChart(this.chartData, this.chartOptions);
  },
})
</script>

<style>

</style>
