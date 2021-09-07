<template>

    <div>
    <toast :message="$page.props.flash.message" />

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
                    <th class="p-3 text-left">P/L(€)</th>
                    <th class="p-3 text-left">P/L(%)</th>
                    <th class="p-3 text-left">Value</th>
                    <th class="p-3 text-left">Sell</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="purchase in purchases" :key="purchase.crypto_id" class="bg-white">
                    <row-link :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="p-3 flex items-center">
                        <img class="rounded-full h-7 w-6 object-contain mr-4" :src="'/images/logo/'+ purchase.crypto_logo" alt="logo">
                        <span>{{ purchase.crypto_name }}</span>
                    </row-link>
                    <row-link :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="p-3">{{ purchase.quantity }}</row-link>
                    <row-link :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="p-3">{{ purchase.prices }} €</row-link>
                    <td>
                        {{ differenceCurrency(initial_latest_markets_values, purchase.crypto_id, purchase.quantity, purchase.prices) }} €
                    </td>
                    <td>
                        {{ differencePercentage(initial_latest_markets_values, purchase.crypto_id, purchase.quantity, purchase.prices) }} %
                    </td>
                    <td>
                        {{ currentPrice(purchase.crypto_id) * purchase.quantity }} €
                    </td>
                    <td>
                        <span class="sellbutton p-1 border-gray-400 border rounded-sm relative" @click="sell(purchase.crypto_id)">
                        {{ currentPrice(purchase.crypto_id)  }}
                        </span> €
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>


</template>

<script>
import RowLink from '@/components/RowLink.vue'
import { mapGetters } from 'vuex'
import Toast from '@/components/Toast.vue'


export default {
    props: {
        purchases: Array,
        default: [],
        initial_latest_markets_values: {
          type: Array,
        },
    },
    components: {
        Toast,
        RowLink
    },

    computed: {
        totalBTC() {
            return this.purchases.reduce( (acc, item) => acc + (item.quantity), 0)
        },

        totalInvested() {
            return this.purchases.reduce( (acc, item) =>  acc + (item.prices), 0).toFixed(2)
        },

        // lastPrice() {
        //     return (id) => {
        //         return this.current_lasts_markets(this.initial_latest_markets_values).find(market => market.cryptocurrencie_id === id).price
        //     }
        // },

        currentPrice() {
            return (id) => {
                return this.lastPrice(this.initial_latest_markets_values, id)
            }
        },

        // differenceCurrency() {
        //     return (id, quantity, prices)=> {
        //         ((this.currentPrice(id) * quantity) - prices).toFixed(2)
        //     }
        // },
        // differencePercentage() {
        //     return (id, quantity, prices) => {
        //         ((((this.currentPrice(id) * quantity) - prices) / (this.currentPrice(id) * quantity)) * 100).toFixed(2)
        //     }
        // },

        ...mapGetters({
            current_lasts_markets : 'markets/getLastsMarkets',
            lastPrice : 'prices/lastPrice',
            differenceCurrency : 'prices/differenceCurrency',
            differencePercentage : 'prices/differencePercentage',
        }),
    },

    methods: {
        sell(id) {
            this.$inertia.patch(route('wallet.sell.all'), {id});
        }
    }

}
</script>
