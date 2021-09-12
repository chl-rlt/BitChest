<template>

<div>

    <toast :message="$page.props.flash.message" v-if="showToast" @close-toast='closeToast'/>
    <h1 class="text-gray-800 text-3xl font-semibold py-5 uppercase">My wallet</h1>

    <section class="max-w-sm w-full lg:max-w-full lg:flex mx-auto my-10">
        <div class="h-48 lg:p-4 lg:h-auto bg-blue-200 lg:w-32 flex align-middle items-center rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
            <img class="object-cover" src="/images/bitchest_logo2.png" alt="logo">
        </div>
        <div class="border-r border-b border-l border-gray-200 lg:border-l-0 lg:border-t lg:border-gray-200 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4">
            <h2 class="text-2xl font-normal leading-tight pt-9">Account details </h2>
            <p class="mt-3 pb-9">Estimated value : <span class="font-bold">{{ totalInvested }} € </span></p>
            <p class="mt-3"><span class="font-bold">{{ purchases.length }}</span> Cryptocurrencies possessed.</p>
        </div>
    </section>

    <section class="overflow-hidden mt-3 bg-white p-10 sm:rounded-md sm:shadow-md md:w-full section-cryptos">
        <div class="container mx-auto px-2 sm:px-4">
        <div class="py-4">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Your cryptos</h2>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto z-0">
            <div class="inline-block min-w-full sm:shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead class="thead-mobile">
                    <tr class="">
                        <th class=" px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Market ({{ purchases.length }})</th>
                        <th class=" px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Quantity</th>
                        <th class=" px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Invested</th>
                        <th class=" px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">AVG. Open</th>
                        <th class=" px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">P/L(€)</th>
                        <th class=" px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">P/L(%)</th>
                        <th class=" px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Value</th>
                        <th class=" px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Sell</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="purchase in purchases" :key="purchase.crypto_id" class="bg-white tr-mobile">
                        <row-link data-label="Market" :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="td-mobile px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <img class="rounded-full h-7 w-6 object-contain sm:mr-4" :src="'/images/logo/'+ purchase.crypto_logo" alt="logo">
                            <span class="hidden sm:block">{{ purchase.crypto_name }}</span><span class="block sm:hidden">{{ purchase.crypto_tag }}</span>
                        </row-link>
                        <row-link data-label="Quantity" :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="td-mobile px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ purchase.quantity }}</row-link>
                        <row-link data-label="Invested" :href="route('wallet.show',[$page.props.user.id, purchase.crypto_id])" className="td-mobile px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ purchase.prices }} €</row-link>
                        <td data-label="AVG. Open" class="td-mobile px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ (purchase.prices / purchase.quantity).toFixed(4) }}
                        </td>
                        <td data-label="P/L(€)" class="td-mobile px-5 py-5 border-b border-gray-200 bg-white text-sm"
                        :class="[purchase.prices <= (currentPrice(purchase.crypto_id) * purchase.quantity).toFixed(2) ? 'text-green-500' : 'text-red-500']" >
                            {{ differenceCurrency(initial_latest_markets_values, purchase.crypto_id, purchase.quantity, purchase.prices) }} €
                        </td>
                        <td data-label="P/L(%)" class="td-mobile px-5 py-5 border-b border-gray-200 bg-white text-sm"
                        :class="[purchase.prices <= (currentPrice(purchase.crypto_id) * purchase.quantity).toFixed(2) ? 'text-green-500' : 'text-red-500']" >
                            {{ differencePercentage(initial_latest_markets_values, purchase.crypto_id, purchase.quantity, purchase.prices) }} %
                        </td>
                        <td data-label="Value" class="td-mobile px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ (currentPrice(purchase.crypto_id) * purchase.quantity).toFixed(2) }} €
                        </td>
                        <td data-label="Sell" class="td-mobile px-5 py-5 text-sm">
                            <span class="p-1 cursor-pointer"
                            @click="showModal(purchase)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="[purchase.prices <= (currentPrice(purchase.crypto_id) * purchase.quantity).toFixed(2) ? 'hover:border-green-400 hover:bg-green-400 hover:rounded-md' : 'hover:border-red-400 hover:bg-red-400 hover:rounded-md' ]">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z" class="text-gray-700 font-normal" />
                            </svg>
                            <!-- {{ currentPrice(purchase.crypto_id)  }} -->

                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>
            </div>
        </div>
        <SalesHistory :sales="sold"></SalesHistory>
    </section>

    <ConfirmationModal v-if="isModalVisible" @close="closeModal" @delete-confirmation="sell"
    :title="'Sell ' + purchaseToSell.name " :data="{id:purchaseToSell.id, selling_price:purchaseToSell.selling_price}" button="SELL">
        <!-- <img :src="'/images/logo/'+ purchaseToSell.logo" class="my-1.5"> -->
        Are you sure you want to sell <strong class="font-bold">{{purchaseToSell.quantity}} {{purchaseToSell.tag}}</strong> for <strong class="font-bold">{{purchaseToSell.price}} €</strong>
    </ConfirmationModal>
</div>


</template>

<script>
import RowLink from '@/components/RowLink.vue'
import { mapGetters } from 'vuex'
import Toast from '@/components/Toast.vue'
import ConfirmationModal from '@/components/ConfirmationModal'
import SalesHistory from '@/components/SalesHistory'
export default {
    props: {
        purchases: Array,
        sold: Array,
        default: [],
        initial_latest_markets_values: {
          type: Array,
        },
    },
    components: {
        Toast,
        RowLink,
        ConfirmationModal,
        SalesHistory
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
                quantity: '',
                selling_price: '',
            }
        }
    },
    computed: {
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

        showToast() {
            return this.$page.props.flash.message ? true : false
        }
    },
    methods: {
        sell({id, selling_price}) {
            this.$inertia.patch(route('wallet.sell.all'), {id, selling_price});
            this.closeModal();
        },
        closeToast() {
            this.$page.props.flash.message = null
        },
        showModal(purchase) {
            this.purchaseToSell = {
                id: purchase.crypto_id,
                name: purchase.crypto_name,
                tag: purchase.crypto_tag,
                logo: purchase.crypto_logo,
                price:  this.currentPrice(purchase.crypto_id) * purchase.quantity,
                quantity: purchase.quantity,
                selling_price: this.currentPrice(purchase.crypto_id)
            }
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
            this.purchaseToSell =  {
                id: '',
                name: '',
                logo: '',
                tag:'',
                price: '',
                quantity: '',
                initial_price: '',
            }
        },
    },
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