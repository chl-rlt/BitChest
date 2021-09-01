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

      this.gradient = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450);
      this.gradient.addColorStop(0, 'rgba(247,108,6, 0.9)')
      this.gradient.addColorStop(0.5, 'rgba(247,108,6, 0.25)');
      this.gradient.addColorStop(1, 'rgba(247,108,6, 0)');

    this.renderChart(
        {
            labels: date,
            datasets:[
                {
                    label: 'Price',
                    borderColor: '#FC2525',
                    pointBackgroundColor: '#FC2525',
                    borderWidth: 1,
                    pointBorderColor: 'white',
                    backgroundColor: this.gradient,
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
