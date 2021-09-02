<template>

    <div>
    <h1 class="text-gray-800 text-3xl font-semibold py-5 uppercase">My wallet</h1>

    <div class="md:w-auto overflow-hidden mt-3 bg-white p-10 rounded-md shadow-md">
    <h1 class="font-bold">Account details </h1>
    <p class="mt-3">Account balance : {{ totalBTC }} BTC </p>
    <p class="mt-3">Estimated value : {{ totalInvested }} € </p>
    </div>

    <div class="overflow-hidden mt-3 bg-white p-10 rounded-md shadow-md md:w-full">
    <h1 class="font-bold mb-2">Your cryptos </h1>
        <table class="table text-gray-400 border-separate space-y-6 text-sm md:w-full">
            <thead class="bg-gray-300 text-gray-500">
                <tr>
                    <th class="p-3 text-left pl-8">Market ({{ purchases.length }})</th>
                    <th class="p-3 text-left">Quantity</th>
                    <th class="p-3 text-left">Invested</th>
                    <th class="p-3 text-left">Sell</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="purchase in purchases" :key="purchase.crypto_id" class="bg-white">
                    <row-link :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="p-3 flex items-center">
                        <img class="rounded-full h-7 w-6 object-contain mr-4" :src="'/images/logo/'+ purchase.crypto_logo" alt="logo">
                        {{ purchase.crypto_name }}
                    </row-link>
                    <row-link :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="p-3">{{ purchase.prices }} €</row-link>
                    <row-link :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="p-3">{{ purchase.quantity }}</row-link>
                    <td>sell</td>
                </tr>
            </tbody>
        </table>
    </div>

    </div>


</template>

<script>
import RowLink from '@/components/RowLink.vue'

export default {
    props: {
        purchases: Array,
        default: [],
    },
    components: {
        RowLink
    },

    computed: {
        totalBTC() {
            return this.purchases.reduce( (acc, item) => acc + (item.quantity), 0)
        },

        totalInvested() {
            return this.purchases.reduce( (acc, item) =>  acc + (item.prices), 0).toFixed(2)
        }
    }

}
</script>

<style>

</style>
