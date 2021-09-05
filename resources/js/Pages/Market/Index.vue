<template>

        <div>
            <toast :message="$page.props.flash.message" />
            <h1 class="text-gray-800 text-3xl font-semibold py-5 uppercase">Markets</h1>
            <CryptoList :initial_latest_markets="initial_latest_markets_values" :day_markets="markets"/>
        </div>
</template>

<script>
import CryptoList from '@/components/CryptoList.vue';
import Toast from '@/components/Toast.vue'

export default {
    name: 'Markets',
    components: {
        CryptoList,
        Toast
    },
    props: {
       markets: {
           type: Array
       },
       initial_latest_markets_values: {
           type: Array
       },

    },

}
</script>
