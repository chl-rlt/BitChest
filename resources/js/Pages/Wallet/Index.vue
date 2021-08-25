<template>

    <div>
    <h1 class="text-3xl pt-10 uppercase font-bold px-10 ">My wallet</h1>

    <div class="md:w-auto overflow-hidden mt-3 bg-white p-10 rounded-md mx-10">
    <h1 class="font-bold">Account details </h1>
    <p class="mt-3">Account balance : BTC </p>
    <p class="mt-3">Estimated value : $0.00 </p>
    </div>

    <div class="md:w-auto overflow-hidden mt-3 bg-white p-10 rounded-md mx-10">
    <h1 class="font-bold">Your cryptos </h1>
        <table class="table text-gray-400 border-separate space-y-6 text-sm w-full">
            <thead class="bg-gray-300 text-gray-500">
                <tr>
                    <th class="p-3 text-left pl-8">Market ({{ purchases.length }})</th>
                    <th class="p-3 text-left">Quantity</th>
                    <th class="p-3 text-left">Invested</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="purchase in purchases" :key="purchase.crypto_id" class="bg-white">
                    <td class="p-3 flex items-center">
                        <img class="rounded-full h-7 w-6 object-contain mr-4" :src="'/images/logo/'+ purchase.crypto_logo" alt="logo">
                        {{ purchase.crypto_name }}
                        </td>
                    <td class="p-3">{{ purchase.quantity }}</td>
                    <td class="p-3">{{ purchase.prices }} $</td>
                </tr>
            </tbody>
        </table>
    </div>

    </div>


</template>

<script>
export default {
    props: {
        purchases: Array
    }

}
</script>

<style>

</style>
