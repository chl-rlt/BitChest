<template>

<h2 class="font-bold mb-2">Sales History</h2>

<table class="table text-gray-400 border-separate space-y-6 text-sm md:w-full">
    <thead class="bg-gray-300 text-gray-500">
        <tr>
            <th class="p-3 text-left pl-8">Market ({{ sales.length }})</th>
            <th class="p-3 text-center">Sale Date</th>
            <th class="p-3 text-center">Quantity</th>
            <th class="p-3 text-center">Invested</th>
            <th class="p-3 text-center">Opened</th>
            <th class="p-3 text-center">Closed</th>
            <th class="p-3 text-center">Sold For</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="sale in sales" :key="sale.crypto_id" class="bg-white">
            <td class="p-3 flex items-center">
                        <img class="rounded-full h-7 w-6 object-contain mr-4" :src="'/images/logo/'+ sale.market.cryptocurrencie.logo" alt="logo">
                        <span>{{ sale.market.cryptocurrencie.name }}</span>
            </td>
            <td class="p-3 text-center"> {{ sale.updated_at }} </td>
            <td class="p-3 text-center"> {{ sale.quantity.toFixed(2) }} </td>
            <td class="p-3 text-center"> {{ (sale.market.price * sale.quantity).toFixed(2) }} €</td>
            <td class="p-3 text-center"> {{ sale.market.price }} </td>
            <td class="p-3 text-center"> {{ sale.selling_price }} </td>
            <td class="p-3 text-center"
            :class="[ sale.market.price <= sale.selling_price ? 'text-green-500' : 'text-red-500' ]">
                {{ (sale.selling_price * sale.quantity).toFixed(2) }} €
            </td>
        </tr>
    </tbody>
</table>

</template>

<script>
export default {
    name: 'SalesHistory',
    props: {
        sales: Array
    }

}
</script>

<style>

</style>
