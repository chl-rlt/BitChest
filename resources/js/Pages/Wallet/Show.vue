<template>

<div>
    <h2>{{ purchase[0].name }}</h2>
    <img class="h-7 w-6 object-contain mr-4" :src="'/images/logo/'+ purchase[0].logo" alt="logo">


<table class="table text-gray-400 border-separate space-y-6 text-sm w-full">
    <thead class="bg-gray-300 text-gray-500">
        <tr>
            <th class="p-3 text-left pl-8">Date</th>
            <th class="p-3 text-left">Amount</th>
            <th class="p-3 text-left">Units</th>
            <th class="p-3 text-left">Open</th>
            <th class="p-3 text-left">Current</th>
            <th class="p-3 text-left">P/L(€)</th>
            <th class="p-3 text-left">P/L(%)</th>
            <th class="p-3 text-left">Sell</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="crypto in purchase" :key="crypto.id">
            <td class="p-3">{{  crypto.bought_at }}</td>
            <td class="p-3">{{  totalPrice(crypto) }} €</td>
            <td class="p-3">{{  crypto.quantity  }}</td>
            <td class="p-3">{{ crypto.price }} €</td>
            <td class="p-3"><dynamic-value>{{ currentLatest.price }}</dynamic-value></td>
            <td class="p-3">{{ (currentLatest.price - crypto.price).toFixed(2) }}</td>
            <td class="p-3">{{ (((currentLatest.price - crypto.price)/currentLatest.price)*100).toFixed(2) }} %</td>
            <td class="p-3">***</td>
        </tr>
    </tbody>
</table>

</div>
</template>

<script>
import DynamicValue from '@/components/DynamicValue'

export default {

    components: {
        DynamicValue
    },

    props: {
        purchase: {
            type: Array,
            required: true
        },
        initial_latest_markets_values: Array
    },

    data() {
        return {
            currentLatest: {},
        }
    },

    methods: {
        totalPrice(crypto) {
            return (crypto.quantity * crypto.price).toFixed(2);
        }
    },

    mounted() {
        this.currentLatest = {...this.initial_latest_markets_values.find(market => market.cryptocurrencie_id === this.purchase[0].cryptocurrencie_id)}
    }
}
</script>
