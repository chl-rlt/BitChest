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
                        <span class="sellbutton p-1 border-gray-400 border rounded-sm cursor-pointer" @click="showModal(purchase)">
                        {{ currentPrice(purchase.crypto_id)  }}
                        </span> €
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <ConfirmationModal v-if="isModalVisible" @close="closeModal" @delete-confirmation="sell" :title="'Sell ' + purchaseToSell.name " :id="purchaseToSell.id" button="SELL">
        <img :src="'/images/logo/'+ purchaseToSell.logo" class="my-1.5">
        Are you sure you want to sell <strong class="font-bold">{{purchaseToSell.quantity}} {{purchaseToSell.tag}}</strong> for <strong class="font-bold">{{purchaseToSell.price}} €</strong>
    </ConfirmationModal>
</div>


</template>

<script>
import RowLink from '@/components/RowLink.vue'
import { mapGetters } from 'vuex'
import Toast from '@/components/Toast.vue'
import ConfirmationModal from '@/components/ConfirmationModal'


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
        RowLink,
        ConfirmationModal
    },

    data() {
        return {
            isModalVisible: false,
            purchaseToSell: {
                id: '',
                name: '',
                logo: '',
                tag:'',
                price: '',
                quantity: ''
            }
        }
    },

    computed: {
        totalBTC() {
            return this.purchases.reduce( (acc, item) => acc + (item.quantity), 0)
        },

        totalInvested() {
            return this.purchases.reduce( (acc, item) =>  acc + (item.prices), 0).toFixed(2)
        },

        currentPrice() {
            return (id) => {
                return this.lastPrice(this.initial_latest_markets_values, id)
            }
        },

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
            closeModal();
        },
        showModal(purchase) {
            this.purchaseToSell = {
                id: purchase.crypto_id,
                name: purchase.crypto_name,
                tag: purchase.crypto_tag,
                logo: purchase.crypto_logo,
                price:  this.currentPrice(purchase.crypto_id) * purchase.quantity,
                quantity: purchase.quantity,
            }
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        },
    }

}
</script>
