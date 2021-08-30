<template>

<div>
    <h2>{{ purchase[0].name }}</h2>
    <img class="h-7 w-6 object-contain mr-4" :src="'/images/logo/'+ purchase[0].logo" alt="logo">
</div>

<table class="table text-gray-400 border-separate space-y-6 text-sm w-full">
    <thead class="bg-gray-300 text-gray-500">
        <tr>
            <th class="p-3 text-left pl-8">Date</th>
            <th class="p-3 text-left">Amount</th>
            <th class="p-3 text-left">Units</th>
            <th class="p-3 text-left">Open</th>
            <th class="p-3 text-left">P/L(€)</th>
            <th class="p-3 text-left">P/L(%)</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="crypto in purchase" :key="crypto.id">
            <td class="p-3">{{  crypto.bought_at }}</td>
            <td class="p-3">{{  totalPrice(crypto) }} €</td>
            <td class="p-3">{{  crypto.quantity  }}</td>
            <td class="p-3">{{ crypto.price }} €</td>
            <td class="p-3">***</td>
            <td class="p-3">***</td>
        </tr>
    </tbody>
</table>

</template>

<script>
export default {
    props: {
        purchase: {
            type: Array,
            required: true
        }
    },
    methods: {
        totalPrice(crypto) {
            return (crypto.quantity * crypto.price).toFixed(2);
        }
    }
}
</script>
