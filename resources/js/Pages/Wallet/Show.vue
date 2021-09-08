<template>

<div>
    <img class="h-7 w-6 object-contain mr-4" :src="'/images/logo/'+ purchases[0].logo" alt="logo">

    <h2>{{ purchases[0].name }}</h2><span>{{ purchases[0].tag }}</span>

    <table class="table text-gray-400 border-separate space-y-6 text-sm w-full">
        <thead class="bg-gray-300 text-gray-500">
            <tr>
                <th class="p-3 text-left pl-8">Date</th>
                <th class="p-3 text-center">Amount</th>
                <th class="p-3 text-center">Units</th>
                <th class="p-3 text-center">Open</th>
                <th class="p-3 text-center">Current</th>
                <th class="p-3 text-center">P/L(€)</th>
                <th class="p-3 text-center">P/L(%)</th>
                <th class="p-3 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </th>
            </tr>
        </thead>
        <tbody class="font-bold">
            <tr v-for="purchase in purchases" :key="purchase.id">
                <td class="p-3 text-center">{{  purchase.bought_at }}</td>
                <td class="p-3 text-center">{{  totalPrice(purchase.quantity, purchase.price) }} €</td>
                <td class="p-3 text-center">{{  purchase.quantity  }}</td>
                <td class="p-3 text-center">{{ purchase.price }}</td>
                <td class="p-3 text-center">
                    <dynamic-value>{{ getLastMarket(purchase.cryptocurrencie_id).price }}</dynamic-value>
                </td>
                <td class="p-3 text-center" :class="[differenceCurrency(purchase.price, purchase.quantity) >= 0 ? 'text-green-500' : 'text-red-500']">{{ differenceCurrency(purchase.price, purchase.quantity) }}</td>
                <td class="p-3 text-center" :class="[differencePercentage(purchase.price) >= 0 ? 'text-green-500' : 'text-red-500']">{{ differencePercentage(purchase.price) }} %</td>
                <td class="p-3 text-center">
                    <button type=button class="rounded border border-gray-500 p-1 hover:bg-red-400 hover:text-white hover:border-red-500" @click="showModal(purchase)">Sell</button>
                </td>
            </tr>
        </tbody>
    </table>
    <ConfirmationModal v-if="isModalVisible" @close="closeModal" @delete-confirmation="sell" :title="'Sell ' + purchaseToSell.name " button="SELL" :id="purchaseToSell.id">
        <img :src="'/images/logo/'+ purchaseToSell.logo" class="my-1.5">
        Are you sure you want to sell <strong class="font-bold">{{purchaseToSell.quantity}} {{purchaseToSell.tag}}</strong> for <strong class="font-bold">{{purchaseToSell.price}} €</strong>
    </ConfirmationModal>
</div>
</template>

<script>
import DynamicValue from '@/components/DynamicValue'
import ConfirmationModal from '@/components/ConfirmationModal'
import { mapGetters } from 'vuex'


export default {

    components: {
        DynamicValue,
        ConfirmationModal
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
            isModalVisible: false,
            purchaseToSell: {
                id: '',
                name:'',
                logo: '',
                tag:'',
                price: '',
                quantity: ''
            }
        }
    },

    computed: {
        ...mapGetters({
            lastCryptoMarket: 'markets/lastCryptoMarket'
        }),

        differenceCurrency() {
            return (price,quantity) => {
                return (this.currentLatest.price*quantity - price*quantity).toFixed(2)
            }
        },
        differencePercentage() {
            return (price) => {
                return (((this.currentLatest.price - price)/this.currentLatest.price)*100).toFixed(2)
            }
        },
    },

    methods: {
        totalPrice(quantity, price) {
            return (quantity * price).toFixed(2);
        },

        sell(id) {
            this.$inertia.patch(route('wallet.sell.one', id));
        },


        getLastMarket() {
            return this.currentLatest = this.lastCryptoMarket(this.purchases[0].cryptocurrencie_id, this.initial_latest_markets_values);
        },

        showModal(purchase) {
            console.log(purchase)
            this.purchaseToSell = {
                id: purchase.id,
                name: purchase.name,
                tag: purchase.tag,
                logo: purchase.logo,
                price:  this.totalPrice(purchase.quantity, this.currentLatest.price),
                quantity: purchase.quantity,
            }
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        },
    },

    mounted() {
        this.currentLatest = this.lastCryptoMarket(this.purchases[0].cryptocurrencie_id, this.initial_latest_markets_values);
    }
}
</script>
