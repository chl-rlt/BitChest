<template>
<div>
<div class="flex align-items-center">
    <img class="rounded-full h-12 w-12 object-cover" :src="'/images/logo/'+ cryptoShow.logo" alt="logo">
    <div class="ml-3 mt-2">
        <p class="text-3xl font-semibold">{{cryptoShow.name}}<span class="text-gray-500 mt-1.5 text-xl font-light"> BTC</span></p>
    </div>
</div>
<div class="flex flex-wrap overflow-hidden mt-3">

  <div class="w-full overflow-hidden md:w-8/12 lg:w-8/12 bg-white mb-3 rounded-md p-5 mr-7">
    <CryptoChart v-bind:chartData="state.chartData" v-bind:chartOptions="state.chartOptions" />
  </div>

  <div class="w-full overflow-hidden p-5 bg-white mb-3 rounded-md ml-0.3 bloc-buy">
    <p class="text-3xl font-semibold">{{cryptoShow.name}}<span class="text-gray-500 mt-1.5 text-xl font-light"> BTC</span></p>
    <purchase-form @on-submit="submit" :purchases="purchases" :errors="$page.props.errors" :user_id="user.id" :market="markets[0]" />
  </div>

</div>
<div class="md:w-auto overflow-hidden mt-3 bg-white p-10 rounded-md">
    <h1 class="font-bold">About {{cryptoShow.name}}</h1>
    <p class="mt-3">Adolescebat autem obstinatum propositum erga haec et similia multa scrutanda, stimulos admovente regina, quae abrupte mariti fortunas trudebat in exitium praeceps, cum eum potius lenitate feminea ad veritatis humanitatisque viam reducere utilia suadendo deberet, ut in Gordianorum actibus factitasse Maximini truculenti illius imperatoris rettulimus coniugem. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquam eius, sapiente optio facere iusto quae explicabo libero culpa expedita possimus architecto assumenda perferendis neque illum labore excepturi maxime repellat. Aperiam?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptas adipisci voluptates culpa rerum quaerat quas dolorem. Fugiat molestiae architecto voluptatibus dolor repellat laboriosam dolore. In enim numquam sit iste expedita?</p>
</div>
</div>

</template>

<script>
import { defineComponent } from 'vue';
import CryptoChart from '@/components/CryptoChart.vue'; 
import PurchaseForm from '@/components/PurchaseForm.vue';


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
        chartData: {},
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

})
</script>

<style scoped>
.bloc-buy {
    width: 30%;
}
</style>
