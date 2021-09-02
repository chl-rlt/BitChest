<template>

<div class="flex justify-center">
    <div class="overflow-auto lg:overflow-visible md:w-full">
      <table class="table text-gray-400 border-separate space-y-6 text-sm md:w-full">
        <thead class="bg-gray-300 text-gray-500">
          <tr>
            <th class="p-3 text-left pl-8">Crypto</th>
            <th class="p-3 text-left">Last Price</th>
            <th class="p-3 text-left">24 hour change</th>
            <th class="p-3 text-left">Actions</th>
			      <th class="p-3 text-left"></th>
          </tr>
        </thead>
        <tbody>
          <tr class="bg-white shadow-md" v-for="crypto in lastCryptos" :key='crypto.id' >
            <row-link :href="route('markets.show', crypto.id)">
              <div class="flex align-items-center">
                <img class="rounded-full h-7 w-6 object-contain" :src="'/images/logo/'+ crypto.logo" alt="logo">
                <div class="ml-3">
                  <div class="text-gray-500 mt-1.5">{{crypto.name}}</div>
                </div>
              </div>
            </row-link>
            <row-link :href="route('markets.show', crypto.id)" class="font-bold">
               {{crypto.price}} €
            </row-link>
            <row-link :href="route('markets.show', crypto.id)" class="p-3 font-bold" :class="[priceVariation[crypto.id - 1]>0 ? 'text-green-500' : 'text-red-500']">
               {{ priceVariation[crypto.id - 1] }} %
            </row-link>
            <td class="p-3">
              <Link class="" :href="route('markets.show', crypto.id)" >
              <span class="bg-green-400 text-gray-50 rounded-md px-2">Show </span>
              </Link>
              <span class="bg-red-400 text-gray-50 rounded-md px-2 ml-1.5"> Buy</span>
            </td>
            <td class="p-3 ">
              <a href="#" class="text-gray-400 hover:text-gray-100 mr-2">
                <i class="material-icons-outlined text-base"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-gray-100  mx-2">
                <i class="material-icons-outlined text-base"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-gray-100  ml-2">
                <i class="material-icons-round text-base"></i>
              </a>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
</div>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import RowLink from '@/components/RowLink.vue'

export default {
    name: 'CryptoList',

    components: {
      Link,
      RowLink
    },

	props: {
        cryptos: {
          type: Array,
        },
    },

  computed: {
      lastCryptos() {
          return this.cryptos.slice(0,10);
      },
      priceVariation() {
        const reducedCryptos = this.cryptos.reduce((acc, curr)=> {
            let cle = curr['cryptocurrencie_id'];
            if(!acc[cle]) acc[cle] = [];
            acc[cle].push(curr)
            return acc;
          }, {})
        return Object.keys(reducedCryptos).map(el => {
            return Number(reducedCryptos[el].reduce((acc, curr) => {
                if(acc !== 0) return acc = ((acc - Number(curr.price))/acc) * 100
                return acc = Number(curr.price)
            }, 0).toFixed(2))
        })
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
