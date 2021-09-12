<template>
<div>
<div class="flex align-items-center">
    <img class="h-12 w-12 object-cover" :src="'/images/logo/'+ cryptoShow.logo" alt="logo">
    <div class="ml-3 mt-2">
        <p class="text-3xl font-semibold">{{cryptoShow.name}}<span class="text-gray-500 mt-1.5 ml-1 text-xl font-light"> {{ cryptoShow.tag }}</span></p>
    </div>
</div>
<div class="flex flex-wrap overflow-hidden mt-3">

  <div class="w-full overflow-hidden md:w-8/12 lg:w-8/12 bg-white mb-4 rounded-md p-5 mr-4 bloc-chart relative">

    <div>
        <select v-model="periodicity">
            <option value="D" selected>Daily</option>
            <option value="H">Hourly</option>
        </select>
    </div>

    <CryptoChart  :chartData="chartData" :lastValues="lastValues"/>

  </div>

  <div class="w-full overflow-hidden  h-full bloc-buy">
    <div class="bg-white rounded-md p-5 mb-3 ml-0.3" v-if="user.role != 'admin'">
      <purchase-form  @on-submit="submit" :purchases="purchases" :errors="$page.props.errors" :user_id="user.id" :market="getLatestMarket" :crypto="{name:cryptoShow.name, tag:cryptoShow.tag}"/>
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
import { mapGetters, mapState } from 'vuex';
import { computed } from 'vue'


export default defineComponent ({
    name: 'CryptoShow',

    components: {
        PurchaseForm,
        CryptoChart,
    },

    setup() {
        const user = computed(()=> usePage().props.value.auth.user);
        return { user };
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
            chartData: {
                date: null,
                prices: null,
            },
            chartOptions: {
                responsive: true,
                // type: 'line'
            },
            lastValues: {
                date: null,
                price: null
            },
            periodicity: 'D'
        }
    },

    methods: {
        submit(purchase) {
            this.$inertia.post(route('wallet.buy'), purchase);
        },

        getDailyMarket(key) {
            const marketPerDay = this.markets.reduce((acc, res) => {
                let date = new Date(res.date)
                let cle = date.getMonth()+1 +'-'+ date.getDate()
                if(!acc[cle]) acc[cle] = []
                acc[cle].push(res)
                return acc;
            }, {})

            return Object.keys(marketPerDay).reduce((acc, res) => {
                return acc.concat([ marketPerDay[res][0][key], marketPerDay[res][marketPerDay[res].length-1][key] ])
            }, [])
        },

        getHourlyMarket(key) {
            return this.markets.map(data => key ? Date.parse(data.date) : data.price).reverse()
        }
    },

    computed: {
        ...mapGetters('markets', {
            lastCryptoMarket : 'lastCryptoMarket'
        }),

        ...mapState('markets', {
            last_markets: state => state.lasts_markets
        }),

        getLatestMarket() {
            return this.lastCryptoMarket(this.cryptoShow.id, this.markets)
        },


    },

    created() {
        this.chartData.date = this.getDailyMarket('date').map(date => Date.parse(date))
        this.chartData.prices = this.getDailyMarket('price')
    },

    watch: {
        last_markets() {
            const lastMarket = this.lastCryptoMarket(this.cryptoShow.id)
            this.lastValues.date = Date.parse(lastMarket.date)
            this.lastValues.price = lastMarket.price
        },
        periodicity(e) {
            switch(e) {
                case 'H':
                    this.chartData.date = this.getHourlyMarket(true)
                    this.chartData.prices = this.getHourlyMarket(false)
                    break;
                case 'D':
                    this.chartData.date = this.getDailyMarket('date').map(date => Date.parse(date))
                    this.chartData.prices = this.getDailyMarket('price')
                    break;
                default:
                    break;
            }
        }
    }


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
