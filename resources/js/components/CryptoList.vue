<template>

<div class="flex justify-center">
    <div class="overflow-auto lg:overflow-visible md:w-full">
      <table class="table text-gray-400 border-separate space-y-6 text-sm md:w-full">
        <thead class="bg-gray-200 text-gray-500">
            <tr>
                <th class="p-3 text-left pl-8">Crypto</th>
                <th class="p-3 text-center">Last Price</th>
                <th class="p-3 text-center">24 hour change</th>
                <th class="p-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>

            <tr class="bg-white shadow-md rounded-md" v-for="crypto in initial_latest_markets" :key='crypto.id' >
                <row-link :href="route('markets.show', crypto.cryptocurrencie_id)" class="text-left">
                    <div class="flex align-items-center">
                        <img class="rounded-full h-7 w-6 object-contain" :src="'/images/logo/'+ crypto.logo" alt="logo">
                        <div class="ml-3">
                            <div class="text-gray-500 mt-1.5">{{crypto.name}}</div>
                        </div>
                    </div>
                </row-link>
                <row-link :href="route('markets.show', crypto.cryptocurrencie_id)" class="font-bold text-center">
                    <dynamic-value :data="currentPrice(crypto.cryptocurrencie_id)" class="font-normal text-gray-500"> €</dynamic-value>
                </row-link>
                <row-link :href="route('markets.show', crypto.cryptocurrencie_id)" class="p-3 font-semibold text-center" :class="[dayPriceVariation(crypto.price, crypto.cryptocurrencie_id) > 0 ? 'text-green-400' : 'text-red-400']">
                    <dynamic-value :data="dayPriceVariation(crypto.price, crypto.cryptocurrencie_id)"> %</dynamic-value>
                </row-link>
                <td class="p-3 text-center">
                    <Link class="" :href="route('markets.show', crypto.cryptocurrencie_id)" >
                    <span class="bg-blue-400 text-gray-50 rounded-md px-2 py-0.5">Show </span>
                    </Link>
                    <button class="bg-red-400 text-gray-50 rounded-md px-2 ml-1.5 py-0.5" @click="selectUser(crypto.cryptocurrencie_id)" v-if="user.role != 'admin'"> Buy</button>
                </td>
            </tr>
            <PurchaseModal v-if="isModalVisible" @close="closeModal" :user="user" :crypto_id="idCrypto" :initial_latest_markets="initial_latest_markets"/>
        </tbody>
      </table>
    </div>
</div>

</template>

<script>
import { Link, usePage } from '@inertiajs/inertia-vue3';
import RowLink from '@/components/RowLink.vue'
import PurchaseModal from '@/components/PurchaseModal.vue'
import { mapGetters, mapState } from 'vuex'
import DynamicValue from '@/components/DynamicValue'
import { computed } from 'vue'

export default {
    name: 'CryptoList',

    components: {
      Link,
      RowLink,
      DynamicValue,
      PurchaseModal
    },

	props: {
        initial_latest_markets: {
          type: Array,
        },
        day_markets: {
            type: Array,
        },
        users: {
            type:Object
        }
    },

    setup() {
        const user = computed(()=> usePage().props.value.auth.user);
        return { user };
    },

    data() {
      return {
        isModalVisible: false,
        idUser: null,
        idCrypto: null,
      };
    },

    computed: {

        currentPrice() {
            return (id) => {
                return this.lastPrice(this.initial_latest_markets, id)
            }
        },

        dayPriceVariation() {
            return (price, id) => {
                let last_price = price
                if(new Date(this.lasts_markets[0]?.date) > new Date(this.initial_latest_markets[0].date)) {
                    last_price = (this.lasts_markets.find(market => market.cryptocurrencie_id === id).price).toFixed(2)
                }

                const arr = this.day_markets.filter(market => market.cryptocurrencie_id === id)
                if(arr.length > 0) return (( (last_price - arr[arr.length - 1].price) / last_price ) * 100).toFixed(2)
                return 0
            }
        },

        ...mapGetters({
            lastCryptoMarket : 'markets/lastCryptoMarket',
            lastPrice : 'prices/lastPrice',
            differencePercentage : 'prices/differencePercentage'
        }),

        ...mapState('markets', {
            lasts_markets: state => state.lasts_markets
        }),

    },

    methods: {
        selectUser(cryptoId) {
            this.idCrypto = cryptoId
            this.showModal()
        },
        showModal() {
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        },
         purchaseConfirmation($id) {
            this.idUser = null,
            this.closeModal()
            console.log($id);
        }
    },

}
</script>

<style scoped>

.table {
    border-spacing: 0 15px;
  }

  i {
    font-size: 1rem !important;
  }

</style>
