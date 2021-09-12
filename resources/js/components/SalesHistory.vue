<template>
<div class="container mx-auto px-2 sm:px-4">
    <div class="py-4">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">Sales History</h2>
        </div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
    <div class="inline-block min-w-full sm:shadow-md rounded-lg overflow-hidden">
    <table class="table min-w-full leading-normal  md:w-full">
        <thead class="thead-mobile">
            <tr class="">
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Market ({{ sales.length }})</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Sale Date</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Quantity</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Invested</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Opened</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Closed</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Sold For</th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="sale in sales" :key="sale.crypto_id" class="bg-white tr-mobile">
            <td data-label="Market" class="flex px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <img class="rounded-full h-7 w-6 object-contain mr-4" :src="'/images/logo/'+ sale.market.cryptocurrencie.logo" alt="logo">
                        <span>{{ sale.market.cryptocurrencie.name }}</span>
            </td>
            <td data-label="Sale Date" class="px-5 py-5 border-b border-gray-200 bg-white text-sm"> {{ sale.updated_at }} </td>
            <td data-label="Quantity" class="px-5 py-5 border-b border-gray-200 bg-white text-sm"> {{ sale.quantity.toFixed(2) }} </td>
            <td data-label="Invested" class="px-5 py-5 border-b border-gray-200 bg-white text-sm"> {{ (sale.market.price * sale.quantity).toFixed(2) }} €</td>
            <td data-label="Opened" class="px-5 py-5 border-b border-gray-200 bg-white text-sm"> {{ sale.market.price }} </td>
            <td data-label="Closed" class="px-5 py-5 border-b border-gray-200 bg-white text-sm"> {{ sale.selling_price }} </td>
            <td data-label="Sold For" class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
            :class="[ sale.market.price <= sale.selling_price ? 'text-green-500' : 'text-red-500' ]">
                {{ (sale.selling_price * sale.quantity).toFixed(2) }} €
            </td>
        </tr>
    </tbody>
</table>
    </div>
    </div>
    </div>
    </div>

</template>

<script>
export default {
    name: 'SalesHistory',
    props: {
        sales: Array
    }

}
</script>

<style scoped>

@media (min-width: 640px) {
    table {
      display: inline-table !important;
    }
    thead tr:not(:first-child) {
      display: none;
    }
}

@media (max-width: 640px){
    .section-cryptos {
        padding: 1rem;
          
    }
    .thead-mobile{
        display: none;
    }

    table tr{
        display: block;
        margin-bottom: 50px;
    }

    table td {
        display: block;
        text-align: right;
        border-bottom: 1px solid;
        border-color: rgba(229, 231, 235, var(--tw-border-opacity)) ;
    }

    table td svg {
        float: right;
    }

    table td img {
        float: right;
    }

    table td:before {
        content: attr(data-label);
        float: left;
        font-weight: bold;
    }

  }
</style>
