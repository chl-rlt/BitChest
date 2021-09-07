<template>

<div>
    <img class="h-7 w-6 object-contain mr-4" :src="'/images/logo/'+ purchases[0].logo" alt="logo">

    <h2>{{ purchases[0].name }}</h2><span>{{ purchases[0].tag }}</span>


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
            <th class="p-3 text-left">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="purchase in purchases" :key="purchase.id">
            <td class="p-3">{{  purchase.bought_at }}</td>
            <td class="p-3">{{  totalPrice(purchase) }} €</td>
            <td class="p-3">{{  purchase.quantity  }}</td>
            <td class="p-3">{{ purchase.price }} €</td>
            <td class="p-3"><dynamic-value>{{ currentLatest.price }}</dynamic-value></td>
            <td class="p-3">{{ (currentLatest.price - purchase.price).toFixed(2) }}</td>
            <td class="p-3">{{ (((currentLatest.price - purchase.price)/currentLatest.price)*100).toFixed(2) }} %</td>
            <td class="p-3">
                <button type=button class="rounded border border-gray-500 p-1 hover:bg-red-400 hover:text-white hover:border-red-500" @click="sell(purchase.id)">Sell</button>
            </td>
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
        purchases: {
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
        },

        sell(id) {
            this.$inertia.patch(route('wallet.sell.one', id));
        },
    },

    mounted() {
        this.currentLatest = {...this.initial_latest_markets_values.find(market => market.cryptocurrencie_id === this.purchases[0].cryptocurrencie_id)}
    }
}
</script>
