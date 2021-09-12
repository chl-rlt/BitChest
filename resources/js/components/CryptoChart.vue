<template>
    <canvas id="cryptoChart"></canvas>
</template>

<script>
import Chart from 'chart.js/auto';
import 'chartjs-adapter-luxon';
import zoomPlugin from 'chartjs-plugin-zoom';
import { shallowRef } from 'vue';

export default {
    name: 'cryptoChart',

    props: {
        chartData: {
            date: Array,
            prices: Array
        },
        lastValues: Object,
        periodicity: String
    },

    data() {
        return {
            chartOptions: '',
            config: null,
            chart: null
        }
    },

    created() {
        Chart.register(zoomPlugin)
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
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill:false,
                    // pointRadius: 0,
                    // tension: 0.3
                }]
            },
            // ...this.chartOptions
            options: {

                scales: {
                    x: {
                        type: 'time',
                        ticks: {
                            // source: {
                            //     auto: true
                            // }
                            autoSkip: true,
                            autoSkipPadding: 50,
                            maxRotation: 0
                        },
                        time: {
                            stepSize: 1,
                            displayFormats: {
                                // quarter: 'MMM YYYY'

                                hour: 'HH:mm',
                                minute: 'HH:mm',
                                second: 'HH:mm:ss'
                            }
                        }
                    },
                    y: {
                        beginAtZero: false,
                        position: 'right',
                    }
                },

                responsive: true,

                elements: {
                    point:{
                        radius: 0
                    }
                },

                plugins: {
                    zoom: {
                        zoom: {
                            wheel: {
                                enabled: true
                            },
                            // pinch: {
                            //     enabled: true
                            // },
                            mode: 'xy',
                        },
                        pan: {
                            enabled: true,
                            mode: 'xy'
                        },
                        limits: {
                            x: {min: 'original', max:'original'},
                            y: {min: 'original', max:'original'},
                        }
                    }
                },
            }
        }

        this.chart = shallowRef( new Chart(ctx, this.config))
    },

    watch: {
        'lastValues.date'() {
            if(this.periodicity === 'H') { // if chart hourly
                if(new Date(this.config.data.labels[this.config.data.labels.length-1]).getHours() == new Date(this.lastValues.date).getHours()
                    && new Date(this.config.data.labels[this.config.data.labels.length-1]).getDate() == new Date(this.lastValues.date).getDate()
                    ) { // if prev value same date and hour, replace
                    this.config.data.labels[this.config.data.labels.length-1] = this.lastValues.date
                    this.config.data.datasets[0].data[this.config.data.datasets[0].data.length-1] = this.lastValues.price
                }
                else { // else add to the array
                    this.config.data.labels[this.config.data.labels.length] = this.lastValues.date
                    this.config.data.datasets[0].data[this.config.data.datasets[0].data.length] = this.lastValues.price
                }
            }
            else if(this.periodicity === 'D') { // if chart daily
                if(new Date(this.config.data.labels[this.config.data.labels.length-1]).getDate() == new Date(this.lastValues.date).getDate()
                    && new Date(this.config.data.labels[this.config.data.labels.length-2]).getDate() == new Date(this.lastValues.date).getDate())
                { // if 2 lasts values same date, replace la value
                    this.config.data.labels[this.config.data.labels.length - 1] = this.lastValues.date
                    this.config.data.datasets[0].data[this.config.data.datasets[0].data.length - 1] = this.lastValues.price
                }
                else { // else add to the array
                    this.config.data.labels[this.config.data.labels.length] = this.lastValues.date
                    this.config.data.datasets[0].data[this.config.data.datasets[0].data.length] = this.lastValues.price
                }

            }
            else { // chart every minutes, add to the array
                this.config.data.labels[this.config.data.labels.length] = this.lastValues.date
                this.config.data.datasets[0].data[this.config.data.datasets[0].data.length] = this.lastValues.price
            }

            this.chart.update('none')
        },
        'chartData.date'() {
            this.config.data.labels = [...this.chartData.date]
            this.config.data.datasets[0].data = [...this.chartData.prices]
            this.chart.update('none')
        }
    },
}
</script>

<style>

</style>
