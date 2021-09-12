<template>

<div class="">
    <div class="flex">
    <img class="h-7 w-6 object-contain mr-4" :src="'/images/logo/'+ purchases[0].logo" alt="logo">
    <h2 class="mt-1 text-xl font-semibold leading-tight">{{ purchases[0].name }}</h2><span class="mt-1 text-xl font-semibold leading-tight">{{ purchases[0].tag }}</span>
    </div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
    <div class="inline-block min-w-full sm:shadow-md sm:rounded-lg overflow-hidden">
    <table class="table min-w-full leading-normal w-full">
        <thead class="bg-blue-200 text-gray-500 thead-mobile">
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Date</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Amount</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Units</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Open</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Current</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">P/L(€)</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">P/L(%)</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-blue-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </th>
            </tr>
        </thead>
        <tbody class="font-bold">
            <tr v-for="purchase in purchases" :key="purchase.id">
                <td data-label="Date" class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold text-gray-700">{{  purchase.created_at }}</td>
                <td data-label="Amount" class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold text-gray-700">{{  totalPrice(purchase.quantity, purchase.price) }} €</td>
                <td data-label="Units" class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold text-gray-700">{{  purchase.quantity  }}</td>
                <td data-label="Open" class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold text-gray-700" >{{ purchase.price }}</td>
                <td data-label="Current" class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold text-gray-700">
                    <dynamic-value>{{ getLastMarket(purchase.cryptocurrencie_id).price }}</dynamic-value>
                </td>
                <td data-label="P/L(€)" class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold text-gray-700" :class="[differenceCurrency(purchase.price, purchase.quantity) >= 0 ? 'text-green-500' : 'text-red-500']">{{ differenceCurrency(purchase.price, purchase.quantity) }}</td>
                <td data-label="P/L(%)" class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold text-gray-700" :class="[differencePercentage(purchase.price) >= 0 ? 'text-green-500' : 'text-red-500']">{{ differencePercentage(purchase.price) }} %</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold text-gray-700">
                    <button type=button class="rounded border border-gray-500 p-1 hover:bg-red-400 hover:text-white hover:border-red-500" @click="showModal(purchase)">Sell</button>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    </div>
    <ConfirmationModal v-if="isModalVisible" @close="closeModal" @delete-confirmation="sell"
    :title="'Sell ' + purchaseToSell.name " button="SELL" :data="{id:purchaseToSell.id, selling_price:purchaseToSell.selling_price}">
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
                quantity: '',
                selling_price: ''
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

        sell({id, selling_price}) {
            // console.log(selling_price)
            this.$inertia.patch(route('wallet.sell.one',id), {selling_price: selling_price});
        },


        getLastMarket() {
            return this.currentLatest = this.lastCryptoMarket(this.purchases[0].cryptocurrencie_id, this.initial_latest_markets_values);
        },

        showModal(purchase) {
            this.purchaseToSell = {
                id: purchase.id,
                name: purchase.name,
                tag: purchase.tag,
                logo: purchase.logo,
                price:  this.totalPrice(purchase.quantity, this.currentLatest.price),
                quantity: purchase.quantity,
                selling_price: this.currentLatest.price
            }

            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
            this.purchaseToSell= {
                id: '',
                name:'',
                logo: '',
                tag:'',
                price: '',
                quantity: '',
                selling_price: ''
            }
        },
    },

    mounted() {
        this.currentLatest = this.lastCryptoMarket(this.purchases[0].cryptocurrencie_id, this.initial_latest_markets_values);
    }
}
</script>
<style scoped>
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
