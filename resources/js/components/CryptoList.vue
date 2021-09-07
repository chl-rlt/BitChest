<template>

<div class="flex justify-center">
    <div class="overflow-auto lg:overflow-visible md:w-full">
      <table class="table text-gray-400 border-separate space-y-6 text-sm md:w-full">
        <thead class="bg-gray-300 text-gray-500">
            <tr>
                <th class="p-3 text-left pl-8">Crypto</th>
                <th class="p-3 text-center">Last Price</th>
                <th class="p-3 text-center">24 hour change</th>
                <th class="p-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>

            <tr class="bg-white shadow-md" v-for="crypto in initial_latest_markets" :key='crypto.id' >
                <row-link :href="route('markets.show', crypto.cryptocurrencie_id)" class="text-left">
                    <div class="flex align-items-center">
                        <img class="rounded-full h-7 w-6 object-contain" :src="'/images/logo/'+ crypto.logo" alt="logo">
                        <div class="ml-3">
                            <div class="text-gray-500 mt-1.5">{{crypto.name}}</div>
                        </div>
                    </div>
                </row-link>
                <row-link :href="route('markets.show', crypto.cryptocurrencie_id)" class="font-bold text-center">
                    <dynamic-value :data="currentValue(crypto.price, crypto.cryptocurrencie_id)"> €</dynamic-value>
                </row-link>
                <row-link :href="route('markets.show', crypto.cryptocurrencie_id)" class="p-3 font-bold text-center" :class="[dayPriceVariation(crypto.price, crypto.cryptocurrencie_id) > 0 ? 'text-green-500' : 'text-red-500']">
                    <dynamic-value :data="dayPriceVariation(crypto.price, crypto.cryptocurrencie_id)"> %</dynamic-value>
                </row-link>
                <td class="p-3 text-center">
                    <Link class="" :href="route('markets.show', crypto.cryptocurrencie_id)" >
                    <span class="bg-green-400 text-gray-50 rounded-md px-2">Show </span>
                    </Link>
                    <span class="bg-red-400 text-gray-50 rounded-md px-2 ml-1.5"> Buy</span>
                </td>
                <!-- <td class="p-3 text-right">
                    <a href="#" class="text-gray-400 hover:text-gray-100 mr-2">
                    <i class="material-icons-outlined text-base"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-100  mx-2">
                    <i class="material-icons-outlined text-base"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-100  ml-2">
                    <i class="material-icons-round text-base"></i>
                    </a>
                </td> -->
            </tr>

        </tbody>
      </table>
    </div>
</div>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import RowLink from '@/components/RowLink.vue'
import { mapGetters, mapState } from 'vuex'
import DynamicValue from '@/components/DynamicValue'

export default {
    name: 'CryptoList',

    components: {
      Link,
      RowLink,
      DynamicValue,
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


    computed: {

        currentValue() {
            return (price, id) => {
                if(new Date(this.lasts_markets[0]?.date) > new Date(this.initial_latest_markets[0].date)) {
                    return (this.lasts_markets.find(market => market.cryptocurrencie_id === id).price).toFixed(2)
                }
                return price
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

        ...mapGetters('markets', {
            lastCryptoMarket : 'lastCryptoMarket'
        }),

        ...mapState('markets', {
            lasts_markets: state => state.lasts_markets
        }),
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

  .table tr {
    border-radius: 20px;
  }

  tr td:nth-child(n+5),
  tr th:nth-child(n+5) {
    border-radius: 0 .625rem .625rem 0;
  }

  tr td:nth-child(1),
  tr th:nth-child(1) {
    border-radius: .625rem 0 0 .625rem;
  }

</style>
