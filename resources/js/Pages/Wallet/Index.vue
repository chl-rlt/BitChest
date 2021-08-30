<template>

    <div>
    <h1 class="text-3xl pt-10 uppercase font-bold px-10 ">My wallet</h1>

    <div class="md:w-auto overflow-hidden mt-3 bg-white p-10 rounded-md mx-10">
    <h1 class="font-bold">Account details </h1>
    <p class="mt-3">Account balance : {{ totalBTC }} BTC </p>
    <p class="mt-3">Estimated value : {{ totalInvested }} € </p>
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
                    <row-link :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="p-3 flex items-center">
                        <img class="rounded-full h-7 w-6 object-contain mr-4" :src="'/images/logo/'+ purchase.crypto_logo" alt="logo">
                        {{ purchase.crypto_name }}
                    </row-link>
                    <row-link :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="p-3">{{ purchase.prices }} €</row-link>
                    <row-link :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="p-3">{{ purchase.quantity }}</row-link>
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
