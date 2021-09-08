<template>
<div>
<div class="flex align-items-center">
    <img class="h-12 w-12 object-cover" :src="'/images/logo/'+ cryptoShow.logo" alt="logo">
    <div class="ml-3 mt-2">
        <p class="text-3xl font-semibold">{{cryptoShow.name}}<span class="text-gray-500 mt-1.5 ml-1 text-xl font-light"> {{ cryptoShow.tag }}</span></p>
    </div>
</div>
<div class="flex flex-wrap overflow-hidden mt-3">

  <div class="w-full overflow-hidden md:w-8/12 lg:w-8/12 bg-white mb-4 rounded-md p-5 mr-4 bloc-chart">
    <CryptoChart v-bind:chartData="state.chartData" v-bind:chartOptions="state.chartOptions" />
  </div>

  <div class="w-full overflow-hidden  h-full bloc-buy">
    <div class="bg-white rounded-md p-5 mb-3 ml-0.3" v-if="user.role != 'admin'">
      <purchase-form  @on-submit="submit" :purchases="purchases" :errors="$page.props.errors" :user_id="user.id" :market="markets[0]" :crypto="{name:cryptoShow.name, tag:cryptoShow.tag}"/>
    </div>
    <div class="w-full overflow-hidden p-5 bg-white mb-3 rounded-md ml-0.3 h-full mt-4">
      <h1 class="font-bold">About {{cryptoShow.name}}</h1>
      <p class="mt-3 text-gray-500">{{cryptoShow.description}}</p>
    </div>
  </div>

</div>

</div>

</template>

<script>
import { usePage } from '@inertiajs/inertia-vue3';
import { defineComponent } from 'vue';
import CryptoChart from '@/components/CryptoChart.vue';
import PurchaseForm from '@/components/PurchaseForm.vue';
import { mapGetters } from 'vuex';
import { computed } from 'vue'


export default defineComponent ({
    name: 'CryptoShow',

    components: {
        PurchaseForm,
        CryptoChart
    },

    props: {
        cryptoShow: {
            type: Object,
        },

        markets: {
            type: Array,
        },

        purchases: {
            type: Array,
        },
        user: Object
    },

    data () {
        return {
        state: {
            chartData: this.markets,
            chartOptions: {
            responsive: true
            }
        }
        }
    },

    methods: {
        submit(purchase) {
            this.$inertia.post(route('wallet.buy'), purchase);
        },
    },

    computed: {
        ...mapGetters('markets', {
            lastCryptoMarket : 'lastCryptoMarket'
        })
    }, 

     setup() {
        const user = computed(()=> usePage().props.value.auth.user);
        return { user };
    },

})
</script>

<style scoped>
.bloc-buy {
    width: 30%;
}

@media (max-width:700px){
  .bloc-buy {
    width: 100%;
}
.bloc-chart {
  margin-right: 0px;
}
}


</style>
