<template>
<canvas id="cryptoChart" width="400" height="400"></canvas>
</template>

<script>
import Chart from 'chart.js/auto';
import { shallowRef } from 'vue';

export default {
    name: 'cryptoChart',

    props: {
        chartData: {
            date: Array,
            prices: Array
        },
        lastValues: Object
    },

    data() {
        return {
            chartOptions: '',
            config: null,
            chart: null
        }
    },

    mounted() {
        let ctx = document.getElementById('cryptoChart');

        this.config = {
            type: 'line',
            data: {
                labels: this.chartData.date,
                datasets: [{
                    label: 'Prices',
                    data: this.chartData.prices,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            // ...this.chartOptions
            options: {
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        }

        this.chart = shallowRef( new Chart(ctx, this.config))

    },

    watch: {
        'lastValues.date'() {
            this.config.data.labels[this.config.data.labels.length] = this.lastValues.date
            this.config.data.datasets[0].data[this.config.data.datasets[0].data.length] = this.lastValues.price
            this.chart.update()
        }
    },
}
</script>

<style>

</style>
